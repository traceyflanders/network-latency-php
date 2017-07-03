<?php
/** All functions **/

/**
 * Set the current environment based on setting in the config.ini file
 */
function setEnvironment($config) {
	$config = $config;
	$config = parse_ini_file($config, TRUE);
	$env = $config['Environment']['debug'];
	if( $env == 1) {
		ini_set( "display_errors", "1" );
		error_reporting( E_ALL & ~E_NOTICE );
	} else {
		error_reporting( 0 );
	}
}

/**
 * Probes a specified hostname and port
 * @param Hostname $host
 * @param TCP Port $port
 * @param Time in seconds $timeout
 * @return string
 * @example: probePort(www.google.com, 443, 1)
 */
function probePort($host, $port, $timeout) {
	$timeBefore = microtime(true);
	$hostSocket = fSockOpen($host, $port, $errno, $errstr, $timeout);

	if (!$hostSocket) { return FALSE; }
	$timeAfter = microtime(true);

	return round ((($timeAfter - $timeBefore) * 1000), 0);
	fclose($hostSocket);
}


/**
 * Probe network latency of hosts configured in the config file specified
 * @param Config ini file $config
 * @return Array
 * @example probeLatency($inifile);
 */
function probeHosts($config) {
	$config = $config;
	$hosts = parse_ini_file($config, TRUE);
// 	print_r($hosts);
	$defaults = parse_ini_file("defaults.ini", TRUE);
	
	foreach ($hosts as $host) {

		// Set host
		if (isset($host['host'])) {
			$hostname = $host['host'];
		} else {
			return "Host invalid ".$host['host'];
			exit;
		}
		
		// Set port if not specified
		if (!isset($host['port'])) {
			$port = $defaults['Port']['port'];
			//echo 'Default port '.$port.'<br/>';
		} else {
			$port = $host['port'];
			//echo 'port '.$port.'<br/>';
		}

		// Set timeout if not specified
		if (!isset($host['timeout'])) {
			$timeout = $defaults['Timeout']['timeout'];
			//echo 'Default timeout '.$timeout.'<br/>';
		} else {
			$timeout = $host['timeout'];
			//echo 'timeout '.$timeout.'<br/>';
		}
		
		// Set max latency if not specified
		if (!isset($host['maxlatency'])) {
			$maxlatency = $defaults['Latency']['maxlatency'];
			//echo 'Default Max latency '.$maxlatency.'<br/>';
		} else {
			$maxlatency = $host['maxlatency'];
			//echo 'Max latency '.$maxlatency.'<br/>';
		}

		// Probe host
		$latency = probePort($hostname, $port, $timeout);

		// Put all of our results into an array
		$resultsProbe[$hostname] = array('hostname'=>$hostname,'port'=>$port,'timeout'=>$timeout,'latency'=>$latency,'maxlatency'=>$maxlatency);
		
	}
	return $resultsProbe;
}


/**
 * Formats the results of the probe
 * @param Array $display
 * @return Array
 * @example displayResults($array);
 */
function displayResults($display)
{
	echo '<div class="maintable">';
		// Build table
		echo '<table>';
		
			// Build table headers
			echo '<tr>';
				echo '<th align="left">Status</th>'; 
				echo '<th align="left">Hostname</th>';
				echo '<th>Latency</th>';
				echo '<th>Max Latency</th>';
				echo '<th>TCP Port</th>';
				echo '<th>Timeout</th>';
			echo '</tr>';
		
			// Put results into a table
				foreach ($display as $field) {
					echo '<tr>';
						echo checkLatency($field['latency'],$field['maxlatency']);
						echo '<td><a href="http://'.$field['hostname'].'" target="_blank">'.$field['hostname'].'</a></td>';
						echo '<td>'.$field['latency'].'</td>';
						echo '<td>'.$field['maxlatency'].'</td>';
						echo '<td>'.$field['port'].'</td>';
						echo '<td>'.$field['timeout'].'</td>';
					echo '</tr>';
				}
		echo '</table>';
		echo '</div>';
	return $array;
}

/**
 * Check Latency to see if its higher than max
 * @param int $latency
 * @param int $maxlatency
 */
function checkLatency($latency,$maxlatency) {
	
	$latency = $latency;
	$maxlatency = $maxlatency;
	
	if (!$latency) {
		return '<td class="red"><span class="red">DOWN</span></td>';
	}
	
	if ($latency <= $maxlatency) {
		return '<td class="green"><span class="green">OK</span></td>';
	} else {
		return '<td class="amber"><span class="amber">ALERT</span></td>';
	}
}

/**
 * Get the Page Refresh Interval Setting
 * @param Config ini file $config
 */
function getPageRefresh($config) {
	$config = $config;
	$defaults = parse_ini_file($config, TRUE);
	return $defaults['Page']['refresh'];
}

/**
 * Get the Page Title Setting
 * @param Config ini file $config
 */
function getPageTitle($config) {
	$config = $config;
	$defaults = parse_ini_file($config, TRUE);
	return $defaults['Page']['title'];
}


/**
 * Get the Page Title Setting
 * @param Config ini file $config
 */
function getEmailAddress($config) {
	$config = $config;
	$defaults = parse_ini_file($config, TRUE);
	return $defaults['Page']['email'];
}

/**
 * Get the Page Title Setting
 * @param Config ini file $config
 */
function getVersion($config) {
	$config = $config;
	$defaults = parse_ini_file($config, TRUE);
	return $defaults['Page']['version'];
}

?>