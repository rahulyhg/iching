#!/bin/bash

X="/usr/bin/phantomjs $1/js/savepage.js http://slider.com/astro/as.html > $1/js/astrodataJson.html"

${X} >> $1/js/astrodataJson.html 2>&1
#nohup ${X} >>/tmp/getJson.log 2>&1


