#!/bin/bash
HOST=`hostname`

X=`echo $DISPLAY|awk -F"." '{print $2}'`

#echo $X
#exit

#export DISPLAY=':0.0'
export env_keep="DISPLAY XAUTHORITY"
            
            if [ "D${X}" = "D" ]; then
               /usr/local/bin/wkhtmltopdf $1 $2
            else
               /usr/bin/wkhtmltopdf $1 $2
            fi


#/usr/local/bin/wkhtmltopdf $1 $2


