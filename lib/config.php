<?php
require_once('./lib/functions.php');

// Default Configs
$ConfigDefaults = './lib/defaults.ini';
setEnvironment($ConfigDefaults);
$ProbesConfig='./lib/probes.ini';
$contents = probeHosts($ProbesConfig);
$refeshPageInt = getPageRefresh($ConfigDefaults);
$PageTitle = getPageTitle($ConfigDefaults);
$Email = getEmailAddress($ConfigDefaults);
$Version = getVersion($ConfigDefaults);
?>