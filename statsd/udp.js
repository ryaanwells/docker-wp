{
    "graphiteHost": "127.0.0.1",
    "backends": [ "./backends/custom-backend", "./backends/graphite" ],
    "graphitePort": 2003,
    "port": 8125,
    "flushInterval": 10000,
    "servers": [
      { server: "./servers/udp", address: "0.0.0.0", port: 8125 }
    ]
  }