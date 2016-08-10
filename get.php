Some example data here. 
Spec: Yes 
Length: 18

<?
	$site = $_GET['url'];
	echo $site;
	$parse = parse_url($site);
	$site = $parse['host'];
	echo "<hr />";
	echo $site;
?>
Password requirements for this website were not found! Help us out and submit them below!