$(document).ready(function () {
    
    $("#tosstype").hover(function() {
            turnOffRadio();
//            $("#entropymsg").text("not yet enabled");
        });
        
//jQuery("#tosstype").click(writeData);        
    function turnOffRadio() {    
        $("#tosstype  input[id^=r-decay]:radio").attr('disabled',true);
        $("#tosstype  input[id^=entropy]:radio").attr('disabled',true);
        $("#tosstype  input[id^=acultural]:radio").attr('disabled',true);
    }
    

    $("#xsubtip").qtip({
        content: 'This is the transitional hexagram that is the difference between the original and the resulting hexagram.  Typically this transition is represented only by the moving lines of the original hexagram.  We rrive at this transition hexagram by subtracting the binary value of the original hex from the final hex (andd add 63 is less that zer0)final hexagram.  In this way, this transitional hex is the hexagram verion of the movong lines.',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle',
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#plumtip").qtip({
        content: 'The Modern Plum technique is based on the ancient Mei Hua ("Plum Blossom") method of the Sung Synasty (920-1279ad).  It uses the current time as the "seed" for the casting.  This modern version also uses the current time of number of milliseconds since Jan. 1, 1970. An algorithm takes that number, <a href="/book/ichingbook/_book/instructions.html">transforms it to simulate three coins</a>.  This is done six time, with a random numner of milliseconds between each "toss".',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#testtip").qtip({
        content: 'This randomly generates hexagrams using the PHP rand() function.  Mainly used for its speed as it does not access any services. Not a good option for proper use.',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#randomtip").qtip({
        content: 'The "flipping" is actually being done by Random.Org, who are so meticulous about the quality and integrity of their randomness that they actually have different result based on the type of coin you use. For now, we are using three Bronze Sestertius coins from the Roman Empire of Antoninus Pius<img src="/images/reverse.png" style="width:60px;height:60px;passing 5px;float:right;"><img src="/images/obverse.png" style="width:60px;height:60px;passing 5px;float:right;">',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#entropytip").qtip({
        content: 'CURRENTY DISABLED - Entropy is how random numbers are genenrated for encruption purposed.  This randomness is often collected from hardware sources (variance in fan noise or HDD), either pre-existing ones such as mouse movements or specially provided randomness generators.  The problem with this method is it takes time to "collect" entropy.  If it is all used up, it could take many minutes to collect enough too throw the I Ching.',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#r-decaytip").qtip({
        content: 'CURRENTY DISABLED - This is the "real" random, as it is theoretically impossible to predict decay.  The only problem with this memthod is I would need actually radioactive material to  get it to work, or find a source, like the old Fermi Lab service, which provides these types of randm numbers',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#baynestip").qtip({
        content: 'This is the popular, traditional English translation of the German translation of the original Chinese text brougt back from China by the Jesuits',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
    $("#aculturaltip").qtip({
        content: 'CURRENTLY UNAVAILABLE - This is for the upcoming new translation that redefines the structure and the relationship of the hexagrams outside of the highly moral Confucian version, which is the only one that survided to this day.  The Lao Tzu version, undoubtedly less moralistic and judgemental, did not',
        style:
                {
                    name: 'blue',
                    tip: 'leftMiddle'
                },
        position:
                {
                    corner:
                            {
                                target: 'rightMiddle',
                                tooltip: 'leftMiddle'
                            }
                }
    });
});
