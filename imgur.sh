#!/bin/bash

imgur () {
        while :
        do
                touch /tmp/imgur.tmp
                #echo $numberOfImages
                #cat /tmp/imgur.tmp | wc -l
                if [ ! -f /tmp/imgur.tmp ]; then exit; fi
                if [[ "$numberOfImages" -eq $(cat /tmp/imgur.tmp | wc -l) ]]; then
                        rm /tmp/imgur.tmp
                        echo "Shutting down..."
                        exit
                fi
                #Generate an ID, 7 characters, a-z A-Z 0-9
                id=$(strings /dev/urandom | grep -o '[[:alnum:]]' | head -n 7 | tr -d '\n'; echo)
                #Construct the URL
                url="http://imgur.com/$id"

                req=$(curl -s -D - $url)
                #echo "Trying.. $url"
                #Make sure we get a 200 Code.. We don't want 404s, 502s, 302s, etc
                isFourOhFor=$(echo -e "$req" | head -1)
                if [[ $isFourOhFor != *200* ]]; then continue; fi

                #Sometimes a blank response might happen.
                #Strange issue and difficult to reproduce so we'll just check for it
                contentLength=$(echo -e "$req" | grep Content-Length | awk {'print $2'} | tr -d [:space:])

                if [[ "$contentLength" -eq "0" ]]; then continue; fi

                #Find the file
                file=$(echo -e "$req" | grep $id | grep content | awk {'print $3'} | sed s/'content="'// | tr -d '"' | grep -v "?" | sed s/"\/>"// | tail -1)

                echo "Found! $file"
                #Download the file
                echo "Downloading $file"
                #wget -q $file 
                echo $file >> /tmp/imgur.tmp
                wget -q -O- http://blamend.com/create.php?url=$file
                #This break means we only download ONE image. Comment the break 
                #for this to continue running after finding one
                break
        done
}


argParse () {
        args=$@
                if [[ "$args" == *"--help"* ]] || [[ "$args" == *"-h"* ]]; then 
                        echo "This script will attempt to download random images from imgur.. "
                        echo "Usage: $0 --threads #"
                        echo "--threads specifies the number of threads to use to download images. Default is 1"
                        echo "Currently --threads also specifies the number of images to download.."
                fi

                if [[ "$args" == *"--threads"* ]]; then
                        numberOfThreads=$(echo -n "$args" | awk '/--threads/ { for (x=1;x<=NF;x++) if ($x~"--threads") print $(x+1) }')
                fi
                if [[ "$args" == *"--images"* ]]; then
                        numberOfImages=$(echo -n "$args" | awk '/--images/ { for (x=1;x<=NF;x++) if ($x~"--images") print $(x+1) }')
                fi


}

## Start the Scrpt
argParse $@
if [[ "$numberOfThreads" -gt 1 ]]; then
        for ((x=0; x<$numberOfThreads;x++)); do 
                imgur &
         done
fi
