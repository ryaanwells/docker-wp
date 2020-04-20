# Docker WP

## Prerequisites

* Docker Engine
* Docker Compose
* Docker Machine

These can be installed using your system's native package manager or from binaries/installers. See the [Docker docs](https://docs.docker.com/engine/installation/) for details.

## Installation

Clone this repo to the directory you want to use as the root of your site:

```
git clone git@github.com:joshbetz/docker-wp.git --recursive my-site
cd my-site
```

Make sure Docker is running then:

```
./bin/up
```

Once that completes, go to `http://localhost:8000/` to install WordPress.

## Upgrade WordPress

```
docker-wp/bin/up
```

## Sample dashboard
This repo provides a demonstration of how we could get metrics out of WordPress using StatsD. After running `./bin/up` and setting up your site, navigate to `http://localhost:8081/dashboard`, go `Dashboard > Edit Dashboard` and paste the following:
```
[
  {
    "target": [
      "stats.timers.wordpress.admin_web_transaction.upper"
    ],
    "fontSize": "16",
    "hideLegend": "true",
    "drawNullAsZero": "true",
    "yUnitSystem": "msec",
    "title": "admin_web_transaction.upper"
  },
  {
    "target": [
      "stats.timers.wordpress.web_transaction.upper"
    ],
    "fontSize": "16",
    "hideLegend": "true",
    "drawNullAsZero": "true",
    "yUnitSystem": "msec",
    "title": "web_transaction.upper"
  },
  {
    "target": [
      "stats.wordpress.status_code.200"
    ],
    "fontSize": "16",
    "hideLegend": "true",
    "drawNullAsZero": "true",
    "title": "status_code.200"
  }
]
```