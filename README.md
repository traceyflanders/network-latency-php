# Network Latency php #

A php page that shows network latency from the web server it is hosted on. Customizable ini file for the hostnames you would like to test.

#### Demo Screenshot ####
![Demo screenshot of page](http://alphamusk.com/img/demo_network_latency.jpg)

## How to add hosts to probe ##
Modify the lib/probes.ini file to add hosts. You will need to add the unique [title] field, where title is the name of the host.

Then add the remaining fields that are required, in the specified order below.
 
#### Required fields ####
- host - The DNS hostname or IP Address of the site.
 
#### Optional (Defaults will be used) ####
- port - The TCP port of the site to be probed. (Default: TCP 80)
- maxlatency - The maxmimum allowed network latency measured in milliseconds. (Default: 200 ms)
- timeout - The default amount of seconds to wait if host is not reachable or slow to respond. (Default: 2 seconds)

### Example of a fully configured host ###

    [www.example.com]
    host=www.example.com
    port=8888
    maxlatency=150
    timeout=2

### Example of a minimally configured host ###

    [www.test.local]
    host=www.test.local

### Example of commenting out hosts options ###
Use semicolons to comment out options, defaults located in defaults.ini take precedence if options are not set.

    [www.google.com]
    host=www.example.com
    port=8888
    ;maxlatency=150
    ;timeout=2