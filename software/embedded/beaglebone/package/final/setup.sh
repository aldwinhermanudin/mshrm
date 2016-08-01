#!/bin/sh

echo ""
echo "creating system folder in /opt/mshrm"
mkdir -p /opt/mshrm/src
mkdir -p /opt/mshrm/src/include
mkdir -p /opt/mshrm/bin

echo "building mshrm program"
./build.sh
chmod +x *
echo "finished building"
echo ""
echo ""
echo "Installing program to /opt/mshrm"
cp *.c /opt/mshrm/src/
cp include/* /opt/mshrm/src/include/
cp data_logger /opt/mshrm/bin/
cp dev_info_synzr /opt/mshrm/bin/
cp employee_synzr /opt/mshrm/bin/
cp employee_verf /opt/mshrm/bin/
cp worklog_synzr /opt/mshrm/bin/
cp bash/mshrm_program_monitor.sh /opt/mshrm/
chmod +x /opt/mshrm/*
chmod +x /opt/mshrm/bin/*
echo "program installed"
echo ""
echo ""
echo "writing cron jobs"
#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "@reboot /opt/mshrm/mshrm_program_monitor.sh data_logger &" >> mycron
echo "@reboot /opt/mshrm/mshrm_program_monitor.sh dev_info_synzr &" >> mycron
echo "@reboot /opt/mshrm/mshrm_program_monitor.sh employee_synzr &" >> mycron
echo "@reboot /opt/mshrm/mshrm_program_monitor.sh employee_verf &" >> mycron
echo "@reboot /opt/mshrm/mshrm_program_monitor.sh worklog_synzr &" >> mycron
echo "0,15,30,45 * * * * /opt/mshrm/mshrm_program_monitor.sh data_logger &" >> mycron
echo "0,15,30,45 * * * * /opt/mshrm/mshrm_program_monitor.sh dev_info_synzr &" >> mycron
echo "0,15,30,45 * * * * /opt/mshrm/mshrm_program_monitor.sh employee_synzr &" >> mycron
echo "0,15,30,45 * * * * /opt/mshrm/mshrm_program_monitor.sh employee_verf &" >> mycron
echo "0,15,30,45 * * * * /opt/mshrm/mshrm_program_monitor.sh worklog_synzr &" >> mycron
#install new cron file
crontab mycron
rm mycron
echo "crontab done."
