#!/bin/sh

if ps auxw | grep -v grep | grep cron_test > /dev/null ; then
        echo cron job found
	exit 0
else
	echo cron job not found 
        echo creating cron job
	./cron_test &
	exit 0
fi
