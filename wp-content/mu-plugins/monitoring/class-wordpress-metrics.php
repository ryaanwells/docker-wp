<?php
namespace Monitoring;
use Domnikl\Statsd\Client;

class WordpressMetrics {

    private Client $client;

    public function __construct( Client $client ) {
        $this->client = $client;
    }

    public function startTiming( string $name ) {
        $this->client->startTiming( $name );
    }

    public function endTiming( string $name ) {
        $this->client->endTiming( $name );
    }

    public function increment( string $name ) {
        $this->client->increment( $name );
    }

    public function decrement( string $name ) {
        $this->client->decrement( $name );
    }

    public function count( string $name ) {
        $this->client->count( $name );
    }

    public function markAdminWebTransactionStart() {
        $this->startTiming( 'admin_web_transaction' );
    }

    public function markAdminWebTransactionEnd() {
        $this->endTiming( 'admin_web_transaction' );
    }

    public function markWebTransactionStart() {
        $this->startTiming( 'web_transaction' );
    }

    public function markWebTransactionEnd() {
        $this->endTiming( 'web_transaction' );
    }


}

?>