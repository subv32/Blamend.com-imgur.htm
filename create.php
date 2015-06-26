<?php

shell_exec("sed s/'<\/body><\/html>'\/\/ imgur.htm > imgur.htm2; mv imgur.htm2 imgur.htm");

$urla = escapeshellarg($_GET["url"]);
$command = "echo '<a href=" . $urla . "><img src=" . $urla . " height=250 width=250/></a>' >> imgur.htm";

//<a href="https://i.imgur.com/SBZTpLf.jpg/"><img src=https://i.imgur.com/SBZTpLf.jpg/ height=250 width=250></a>

shell_exec($command);

shell_exec("echo '</body></html>' >> imgur.htm");

?>
