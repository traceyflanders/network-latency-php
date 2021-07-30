<?php 
	require_once('./lib/functions.php');
	require_once('./lib/config.php');
?>
<html>
<title><?php echo $PageTitle;?></title>
<head>
	<link href="style.css" rel="stylesheet" type="text/css">
	<META HTTP-EQUIV="refresh" CONTENT="<?php echo $refeshPageInt;?>">
</head>
<body>
	<div id="container">
	  	<div id="content">
				<?php displayResults($contents);?>
	  	</div>
	  	<div id="botnavbar">
  			<ul>
  				<li><?php echo $Version;?></li>
  				<li>&nbsp;</li>
		  		<li><a href="README.md">Readme</a></li>
		  		<li> | </li>
		  		<li><a href="mailto:<?php echo $Email;?>">Contact</a></li>
		  		<li> | </li>
				<li><a href="https:\/\/github.com/traceyflanders/network-latency-php" target="_blank">Source Code</a></li>
	  		</ul>
	  	</div>
  	</div>
</body>
</html>
