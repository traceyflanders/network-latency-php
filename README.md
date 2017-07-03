# Network Latency php #

A php page that shows network latency from the web server it is hosted on. Customizable ini file for the hostnames you would like to test.

Release: 1.0, Date: 03.21.2013

#### Demo Screenshot ####
![Demo screenshot of page](http://alphamusk.com/img/demo_network_latency.jpg)

### HOW TO ADD HOSTS ###
Modify the lib/probes.ini file.
In order to add hosts you will need to add the unique [title] field, where title is the name of the host.

Then add the remaining fields that are required, in the specified order below.
 
*Required fields
	host - The DNS hostname or IP Address of the site.
 
Optional (Defaults will be used)
	port - The TCP port of the site to be probed. (Default: TCP 80)
	maxlatency - The maxmimum allowed network latency measured in milliseconds. (Default: 200 ms)
	timeout - The default amount of seconds to wait if host is not reachable or slow to respond. (Default: 2 seconds)
 

### Example of a fully configured host ###
<pre>
[www.example.com]
host=www.example.com
port=8888
maxlatency=150
timeout=2
</pre>

Example: Minimally configure host

[www.test.local]
host=www.test.local


Semicolons comment out options specified at which time the defaults located in defaults.ini take precedence.

Example : Host optional parameters commented out, taking on the default max latency setting and timeout.

- [www.google.com]
- host=www.example.com
port=8888
;maxlatency=150
;timeout=2