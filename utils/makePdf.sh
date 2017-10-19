#!/bin/sh
export DISPLAY=':0.0'
#echo "reading ${1}"
#echo "writing ${2}"
/usr/bin/wkhtmltopdf $1 $2
#/usr/bin/wkhtmltopdf $1 $2 


