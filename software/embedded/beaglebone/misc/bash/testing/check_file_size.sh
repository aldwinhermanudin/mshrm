#!/bin/sh

#set program location here
program_location="/home/aldwinakbar/test/build"
program_name=$1
full_program_location="$program_location/$program_name"

#set logging location here
log_location="/home/aldwinakbar/test/log"
log_name="mshrm_$program_name.log"
full_log_location="$log_location/$log_name"

#set maximum bytes
minimumlogsize=10000000

if [ -f "$full_log_location" ]
then
	echo "$full_log_location found."
	echo "checking file size"
	actualsize=$(wc -c <"$full_log_location")
	if [ $actualsize -ge $minimumlogsize ]; then
    		echo size is over $minimumlogsize bytes
		rm $full_log_location
		touch $full_log_location
	else
		echo size is under $minimumlogsize bytes
	fi

else
	echo "$full_log_location not found."
	echo "creating file"
	touch $full_log_location
fi

if pgrep $program_name > /dev/null
then
        echo "$program_name process found"
        echo "killing $program_name process"
        kill $(pgrep $program_name)
        exit 0
else
        echo "$program_name process not found"
        echo "runnning $program_name"
        date >> $full_log_location
        #not working, figure out something else
        $full_program_location >> $full_log_location &
        exit 0
fi
