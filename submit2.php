<table>

<?php 
include 'include.php';
require_once 'recaptcha.php';

$recaptcha = new \ReCaptcha\ReCaptcha($secret);

$agent = $_SERVER['HTTP_USER_AGENT']; 
$ip = $_SERVER['REMOTE_ADDR'];

$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $ip);

if ($resp->isSuccess()) {

    foreach ($_POST as $key => $value) {
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $value;
        echo "</td>";
        echo "</tr>";
    }

  }
  else 
  {
  	echo "gg";
  }

?>
</table>