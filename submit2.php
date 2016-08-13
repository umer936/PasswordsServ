<table>

<?php 

include 'include.php';

// require_once 'recaptcha.php';

// $recaptcha = new ReCaptchaReCaptcha($secret);

if (mysqli_connect_errno())
{
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$agent = $_SERVER['HTTP_USER_AGENT'];
$ip = $_SERVER['REMOTE_ADDR'];
// $resp = $recaptcha->verify($_POST['g-recaptcha-response'], $ip);

// if ($resp->isSuccess())
if(true)
{
  $stmt = $conn->prepare("INSERT INTO WebsiteReqs (
      Website_Name, 
      URL, 
      Upper, 
      Lower, 
      Numbers, 
      Complex, 
      MinLength, 
      MaxLength, 
      Special, 
      IP, 
      username, 
      email, 
      USERAGENT
      ) 
      VALUES (
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?, 
      ?
      )");
  if (false === $stmt)
  {
    die('prepare() failed: ' . htmlspecialchars($mysqli->error));
  }

  $rc = $stmt->bind_param("ssiiiiiisssss", $Name, $url, $Upper, $Lower, $Numbers, $Complex, $Min, $Max, $comments, $ip, $username, $email, $agent);
  $Name = $_POST['Name'];
  $inputurl = $_POST['url'];
  $inputurl = trim($inputurl, '/');
  // If scheme not included, prepend it
  if (!preg_match('#^http(s)?://#', $inputurl)) {
    $inputurl = 'http://' . $inputurl;
  }
  $urlParts = parse_url($inputurl);
  // remove www
  $url = preg_replace('/^www\./', '', $urlParts['host']);
  $Upper = $_POST['Upper'];
  $Lower = $_POST['Lower'];
  $Numbers = $_POST['Numbers'];
  $Complex = $_POST['Complex'];
  $HasMin = $_POST['HasMin'];
  if ($HasMin)
  {
    $Min = $_POST['Min'];
  }
  else
  {
    $Min = 0;
  }

  $HasMax = $_POST['HasMax'];
  if ($HasMax)
  {
    $Max = $_POST['Max'];
  }

  $username = $_POST['username'];
  $emailinput = $_POST['email'];
  $emailinput = filter_var($emailinput, FILTER_SANITIZE_EMAIL);
  if (filter_var($emailinput, FILTER_VALIDATE_EMAIL)) {
    $email = $emailinput;
  }
  $comments = $_POST['comments'];
  $ip = $_SERVER['REMOTE_ADDR'];
  $agent = $_SERVER['HTTP_USER_AGENT'];
  if (false === $rc)
  {
    die('bind_param() failed: ' . htmlspecialchars($stmt->error));
  }

  $rc = $stmt->execute();
  if (false === $rc)
  {
    die('execute() failed: ' . htmlspecialchars($stmt->error));
  }

  echo "Thank you for your submission";
  
  $stmt->close();
  $conn->close();
}
else
{
  echo "reCAPTCHA was not completed, please go back";
}
?>
</table>