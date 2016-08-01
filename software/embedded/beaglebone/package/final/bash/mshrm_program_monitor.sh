#!/bin/sh

#sleep for 10 minute
sleep 10m

#get program location from argument
program_location="/opt/mshrm"
program_name=$1
full_program_location="$program_location/$program_name"

process_count=$(pgrep -c $program_name)	

if [ "$process_count" -gt 1 ]
then
	echo "Killing all $program_name $process_count process"
    kill $(pgrep $program_name)
fi

if pgrep $program_name > /dev/null
then
        echo "$program_name process found"
        exit 0
else
        echo "$program_name process not found"
        echo "runnning $program_name"
        $full_program_location > /dev/null &
        exit 0
fi
