<?php

/** Probe Port Latency function
 returns strings **/
function probePort($host, $port, $timeout)
{
	$timeBefore = microtime(true);
	$hostSocket = fSockOpen($host, $port, $errno, $errstr, $timeout);

	if (!$hostSocket) { return "down"; }
	$timeAfter = microtime(true);

	return round ((($timeAfter - $timeBefore) * 1000), 0)." ms";
	fclose($hostSocket);
}

/** Variables **/
$host = "www.google.com";
$port = 80;
$timeout = 10;
$maxLatency = 45;
$probeLatency = probePort($host, $port, $timeout);
$checkLimit = 4;
$makeLine = '---------------------------'."\r\n";

echo '<pre>';
/** Run Program php -q script.php**/
$x = 0;
$count=0;
while ($x <= $checkLimit)
{
	$count++;
	echo 'Check ('.$count.')'.'<br/>';
	echo $makeLine;
	if ($probeLatency <= $maxLatency)
	{
		echo " No Latency: ".$probeLatency."\r\n";
		echo " Threshold: ".$maxLatency." ms\r\n";
		$x = 5;
		echo $makeLine;
	} else {
		echo " Latency high: ".$probeLatency."\r\n";
		$probeLatency = probePort($host, $port, $timeout);
		echo " Current Latency: ".$probeLatency."\r\n";
		echo " Threshold: ".$maxLatency." ms\r\n";
		$x++;
		echo $makeLine;
	}
	sleep(1);
	echo '<br/>';
}
echo '</pre>';
?>