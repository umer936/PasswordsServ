<?
include 'include.php';

// $site = $_GET['url'];
// echo $site;
// $parse = parse_url($site);
// $site = $parse['host'];
// echo "<hr />";
// echo $site;

$inputurl = $_GET['url'];
$inputurl = trim($inputurl, '/');
// If scheme not included, prepend it
if (!preg_match('#^http(s)?://#', $inputurl)) {
$inputurl = 'http://' . $inputurl;
}
$urlParts = parse_url($inputurl);
// remove www
$site = preg_replace('/^www\./', '', $urlParts['host']);
function isempty($variable) {
	if (empty($variable) || ($variable == 0)) {
		echo "Not required";
	}
	elseif ($variable == 1) {
		echo "Required";
	}
	else {
		echo $variable;
	}
}


$resource = $conn->query("SELECT * FROM WebsiteReqs WHERE URL LIKE '%" . $site . "%'");

if ($resource->num_rows > 0) {
    while($row = mysqli_fetch_assoc($resource))
    {
        $Website_Name = $row['Website_Name'];
        $Upper = $row['Upper'];
        $Lower = $row['Lower'];
        $Numbers = $row['Numbers'];
        $Complex = $row['Complex'];
        $MinLength = $row['MinLength'];
        $MaxLength = $row['MaxLength'];
        $Special = $row['Special'];
        $username = $row['username'];
        $email = $row['email'];

        echo "<b>";
		echo $Website_Name;
        echo "<br />
        Uppercase: </b>"; isempty($Upper); 
        echo "<br /><b>
        Lowercase: </b>"; isempty($Lower); 
        echo "<br /><b>
        Numbers: </b>"; isempty($Numbers); 
        echo "<br /><b>
        Complex: </b>"; isempty($Complex); 
        echo "<br /><b>
        MinLength: </b>"; isempty($MinLength); 
        if (!empty($MaxLength)) {
	        echo "<br /><b>
	        MaxLength: </b>"; isempty($MaxLength); 
        }
		if (!empty($Special)) {
	        echo "<br /><b>
	        Notes: </b>"; echo $Special;
        }
		if (!empty($username) || !empty($email)) {
	        echo "<br />
	        Submitted by: ";  
	        if(!empty($username)) {
	        	echo $username;
	        }
	        if(!empty($email)) {
	        	echo " - "; echo $email;
	        }
        }
        echo "<br />
        <hr>";
    }
} else {
     echo "Password requirements for this website were not found! Help us out!";
}

$conn->close();
?>
