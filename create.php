<?php

shell_exec("sed s/'<\/body><\/html>'\/\/ imgur.htm > imgur.htm2; mv imgur.htm2 imgur.htm");

$urla = escapeshellarg($_GET["url"]);
$command = "echo '<a href=" . $urla . "><img src=" . $urla . " height=250 width=250/></a>' >> imgur.htm";

//<a href="https://i.imgur.com/SBZTpLf.jpg/"><img src=https://i.imgur.com/SBZTpLf.jpg/ height=250 width=250></a>

shell_exec($command);

shell_exec("echo '</body></html>' >> imgur.htm");

// Loggging.. 
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');

shell_exec("echo " . escapeshellarg($ip) . " sent us " . $urla . " >> ip.log");

?>


