<?php
$urla = escapeshellarg($_GET["url"]);
$urla = trim($urla);
echo $urla;
if (strpos($urla,'imgur.com/') !== false && substr($urla,0,5) == '\'http') {
	shell_exec("echo " . $urla . " >> imgur.db");
}

// Loggging.. 
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

shell_exec("echo " . escapeshellarg($ip) . " sent us " . $urla . " >> ip.log");

?>
