var request = require('request');
var cheerio = require('cheerio');
var URL = require('url-parse');

var pagesVisited = {};
var numPagesVisited = 0;
var pagesToVisit = [];
var MAX_PAGES_TO_VISIT = 10;
var SEARCH_WORD = "";
var url = "";//new URL(START_URL);
var baseUrl = "";//url.protocol + "//" + url.hostname;

const args = process.argv;

var lurl = args[2];
var lword = args[3];

preCrawl(lurl, lword);


function preCrawl(site, word) {
    var START_URL = site;
    SEARCH_WORD = word;
    pagesVisited = {};
    numPagesVisited = 0;
    pagesToVisit = [];
    url = new URL(START_URL);
    baseUrl = url.protocol + "//" + url.hostname;

    pagesToVisit.push(START_URL);
    crawl();
}

function crawl() {
    if (numPagesVisited >= MAX_PAGES_TO_VISIT) {
        console.log("Reached max limit of number of pages to visit.");
        return;
    }
//    console.log("pagesToVisit: " + pagesToVisit);
//    console.log("pagesToVisit.pop: " + pagesToVisit.pop);

    if (typeof (pagesToVisit) !== "undefined" && pagesToVisit !== null) {

        var nextPage = pagesToVisit.pop();
        if (nextPage in pagesVisited) {
            // We've already visited this page, so repeat the crawl
            crawl();
        } else {
            // New page we haven't visited
            visitPage(nextPage, crawl);
        }
        return;
    }

}


function visitPage(url, callback) {
    // Add page to our set
    pagesVisited[url] = true;
    numPagesVisited++;

    // Make the request
    try {
        request(url, function (error, response, body) {
            // Check status code (200 is HTTP OK)
            console.log("\n\n\n--------------------------------------------------------------------------------------");
            console.log(response.statusCode + "  Visiting page " + url);
            console.log("--------------------------------------------------------------------------------------");
            if (response.statusCode !== 200) {
                callback();
                return;
            }
            // Parse the document body
            var $ = cheerio.load(body);
            var isWordFound = searchForWord($, SEARCH_WORD);

            testPDFfile($, ".pdf");

            if (isWordFound) {
                console.log('[OK] Word "' + SEARCH_WORD + '" FOUND');// + SEARCH_WORD + ' found at page ' + url);
            } else {
                collectInternalLinks($);
                // In this short program, our callback is just calling crawl()
                callback();
            }

        });
    } catch (e) {
    }
}

function testPDFfile($) {
    //var bodyText = $('html > body').text().toLowerCase();
    var dlfilename = "404";
    if ($('#download_file').attr('href')) {
        dlfilename = $('#download_file').attr('href');
        if (dlfilename != "404") {
            console.log("\t--------------------------------------------------------------------------------------");
            console.log("\t" + dlfilename);
            console.log("\t--------------------------------------------------------------------------------------");

            request(dlfilename, function (error, response, body) {
                // Check status code (200 is HTTP OK)
                console.log("[OK]\tStatus code: " + response.statusCode);
                if (response.statusCode !== 200) {
                    //callback();
                    console.log("[!]\t" + response.statusCode);
                }
            });
        } else {
            console.log("\t--------------------------------------------------------------------------------------");
            console.log("\t  PDF is " + dlfilename);
            console.log("\t--------------------------------------------------------------------------------------");
        }
    }
//    console.log(bodyText);
//    console.log("[" + dlfilename + "]");
    return(true);//dlfilename);//bodyText.indexOf(word.toLowerCase()) !== -1);
}

function searchForWord($, word) {
    var bodyText = $('html > body').text().toLowerCase();
    return(bodyText.indexOf(word.toLowerCase()) !== -1);
}

function collectInternalLinks($) {
    var relativeLinks = $("a[href^='/']");
    console.log("Found " + relativeLinks.length + " relative links on page");
    relativeLinks.each(function () {
        pagesToVisit.push(baseUrl + $(this).attr('href'));
    });
}