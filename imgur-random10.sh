urls=$(cat imgur.db | grep imgur | sed s/"<a href="// | cut -d">" -f1 | sort -R | head -10 )
for i in $(echo -e "$urls"); do echo "<a href=$i><img src=$i height=300 width=300></a>"; done
