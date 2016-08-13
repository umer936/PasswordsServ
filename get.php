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

        echo $Website_Name . "<br />
        Uppercase: " . $Upper  ."<br />
        Lowercase: " . $Lower  ."<br />
        Numbers: " . $Numbers  ."<br />
        Complex: " . $Complex  ."<br />
        MinLength: " . $MinLength  ."<br />
        MaxLength: " . $MaxLength  ."<br />
        Notes: " . $Special  ."<br />
        Submitted by: " . $username  ." - " . $email  ."<br />

        <hr>";
    }
} else {
     echo "Password requirements for this website were not found! Help us out and submit them below!";
}

$conn->close();
?>
