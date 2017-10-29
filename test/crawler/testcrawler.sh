#!/bin/sh
SITE=http://slider.com


node ./testcrawler.js "${SITE}"   "acultural" > testserver.log
node ./testcrawler.js "${SITE}/?flipped=1&question=crawlerTest&mode=astro"    "Hu Kua"  >> testserver.log
node ./testcrawler.js "${SITE}/?flipped=1&question=crawlerTest&mode=plum"   "Hu Kua"  >> testserver.log
node ./testcrawler.js "${SITE}/?flipped=1&question=crawlerTest&mode=random.org"   "Hu Kua" >> testserver.log
node ./testcrawler.js "${SITE}/?flipped=1&f_tossed=11&f_final=12&mode=manual"   "Hu Kua" >> testserver.log
node ./testcrawler.js "${SITE}/book/ichingbook/_book/"   "BabelBrowser" >> testserver.log
node ./testcrawler.js "${SITE}/show.php?submit=Bin&hex=1&gotohex=1&bin=0&gotobin=0"   "Turning" >> testserver.log
node ./testcrawler.js "${SITE}/show.php?hex=24&gotohex=24&bin=1&gotobin=1&search=tree&submit=Search"   "Preponderance" >> testserver.log
node ./testcrawler.js "${SITE}/api/func.php?func=getHexnumOppositeByPseq&pseq=11"   "ret\":12,\"error\":null" >> testserver.log

node ./testcrawler200.js "${SITE}"   "acultural" >> testserver.log
node ./testcrawler200.js "${SITE}/?flipped=1&question=crawler200Test&mode=astro"    "Hu Kua"  >> testserver.log
node ./testcrawler200.js "${SITE}/?flipped=1&question=crawler200Test&mode=plum"   "Hu Kua"  >> testserver.log
node ./testcrawler200.js "${SITE}/?flipped=1&question=crawler200Test&mode=random.org"   "Hu Kua" >> testserver.log
node ./testcrawler200.js "${SITE}/?flipped=1&f_tossed=11&f_final=12&mode=manual"   "Hu Kua" >> testserver.log
node ./testcrawler200.js "${SITE}/book/ichingbook/_book/"   "BabelBrowser" >> testserver.log
node ./testcrawler200.js "${SITE}/show.php?submit=Bin&hex=1&gotohex=1&bin=0&gotobin=0"   "Turning" >> testserver.log
node ./testcrawler200.js "${SITE}/show.php?hex=24&gotohex=24&bin=1&gotobin=1&search=tree&submit=Search"   "Preponderance" >> testserver.log
node ./testcrawler200.js "${SITE}/api/func.php?func=getHexnumOppositeByPseq&pseq=11"   "ret\":12,\"error\":null" >> testserver.log


echo "NON 200 Pages"
echo "-------------"
grep Visiting testserver.log|grep -v 200
echo "*************"
echo "Missing PDF pages"
echo "-------------"
grep 404 testserver.log|nl
echo "*************"

