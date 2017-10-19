#!/bin/sh -x

#export DISPLAY=':0.0'
export env_keep="DISPLAY XAUTHORITY"
#echo "reading ${1}"
#echo "writing ${2}"
/usr/local/bin/wkhtmltopdf $1 $2
#/usr/bin/wkhtmltopdf $1 $2 


