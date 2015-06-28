<?php                                                                                                                                     
$showMe=escapeshellarg($_GET["display"]);                                                                                                 
$intShowMe=intval(str_replace('\'', '', $showMe));                                                                                        
if ( $intShowMe <= 0 ) { $showMe=10; }                                                                                                    
                                                                                                                                          
if ( $intShowMe > 100 ) { echo "Error! You cannot view more than 100 images.."; }                                                         
else {                                                                                                                                    
$page=shell_exec('for i in $(cat imgur.db | sort -R | head -' . $showMe . '); do echo "<a href=$i><img src=$i height=250 width=250></a>";done'); 
echo "<html><head><title>Random imgur images...</title>";                                                                                                                               
echo "<link rel=stylesheet type=text/css href=imgur.css></head><body>";                                                                                                                 
echo "<center><b><div id=header>The images below are randomly pulled from imgur.. <br/></div>";                                                                                         
echo "<a href=https://github.com/subv32/Blamend.com-imgur.htm>GitHub</a> ";                                                                                                             
echo "<a href=https://hightechlowlife.eu/board/threads/random-imgur-image-by-bruteforcing-img-id.790/>HTLL Thread</a>";                                                                 
echo "</br>";                                                                                                                                                                           
echo "<div id=displayControls>Show me: ";                                                                                                                                               
$displayControls=shell_exec('echo "10 20 30 40 50 60 70 80 90 100" | for i in $(cat /dev/stdin); do echo "<a href=?display=$i>$i</a>"; done');                                          
echo $displayControls;                                                                                                                                                                  
$numberOfImages=shell_exec('cat imgur.db | wc -l');                                                                                                                                     
echo "</div></b><br/> " .  $numberOfImages . " images found so far!</center><br/>";                                                                                                     
echo $page;                                                                                                                                                                             
echo "</body></html>";                                                                                                                                                                  
}                                                                                                                                                                                       
?>    
