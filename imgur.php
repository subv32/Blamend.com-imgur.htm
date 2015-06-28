<?php

$page=shell_exec('for i in $(cat imgur.db | sort -R | head -100); do echo "<a href=$i><img src=$i height=250 width=250></a>";done'); 
echo  "<html><head><title>Random imgur images...</title></head><body>"; 
echo $page; 
echo "</body></html>";

?>
