<?php
require __DIR__ . '/monitoring/class-wordpress-metrics.php';

use Domnikl\Statsd\Connection\UdpSocket;
use Domnikl\Statsd\Connection\TcpSocket;
use Domnikl\Statsd\Client;
use Monitoring\WordpressMetrics;

$connection = new UdpSocket( 'graphite-statsd', 8125 );
$statsd = new Client( $connection, "wordpress" );
$statsd->setNamespace("wordpress");

$wp_metrics = new WordpressMetrics( $statsd );

// Demonstration of timing the "Web Transaction" time. This is purely illustrative.
// Time admin and non-admin separately to differentiate between internal/external experience.
if ( is_admin() ) {
    add_action( 'muplugins_loaded', array( $wp_metrics, 'markAdminWebTransactionStart' ) );
    add_action( 'shutdown', array( $wp_metrics, 'markAdminWebTransactionEnd' ) );
} else {
    add_action( 'muplugins_loaded', array( $wp_metrics, 'markWebTransactionStart' ) );
    add_action( 'shutdown', array( $wp_metrics, 'markWebTransactionEnd' ) );
}

// Establish actions that can be used by other plugins/custom code.
add_action('wp_metrics_start_timing', array( $wp_metrics, 'startTiming' ), 10, 1 );
add_action('wp_metrics_end_timing', array( $wp_metrics, 'endTiming' ), 10, 1 );
add_action('wp_metrics_increment', array( $wp_metrics, 'increment' ), 10, 1 );
add_action('wp_metrics_count', array( $wp_metrics, 'count' ), 10, 1 );

// Demo the above actions to inspect the outgoing status code and log it.
function status_code_filter( string $status_header, int $code, string $description, string $protocol ) {
    do_action( 'wp_metrics_increment', "status_code.$code" );
    return $status_header;
}
add_filter('status_header', 'status_code_filter', 10, 4);