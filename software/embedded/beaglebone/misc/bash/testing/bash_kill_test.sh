#!/bin/sh

if ps auxw | grep -v grep | grep cron_test > /dev/null ; then
	echo cron job found
	echo killing cron job
	kill $(ps aux | grep '[c]ron_test' | awk '{print $2}')
	exit 0
else
	echo cron job not found 
        echo creating cron job
	./cron_test > /dev/null &
	exit 0
fi
