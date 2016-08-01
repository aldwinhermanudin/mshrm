#!/bin/sh

ngrok_user_auth="3ZrNHEoYUYwQD6UeRUGGw_5eTB2HmJx1QFP57Vq9uJj"
echo ""
echo "Authenticating ngrok tunnel"
./ngrok authtoken $ngrok_user_auth
