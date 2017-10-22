$(document).ready(function () {


    
    $('#download').click(function () {
        e.preventDefault();  //stop the browser from following
        window.location.href = '/questions';
    });

    $('#f_final').blur(function ()
    {
        if (!$(this).val()) {
            var v = $("#f_final").attr("placeholder");
            $(this).val(v);
        }
    });

    $("#castbutton").val("Enter Question");
    $("#castbutton").css("background-color","grey");
    $("#qfield").on('input',function(e){
        $("#castbutton").css("background-color","green");
        $("#castbutton").val("Cast Hexagram");
    });

    
    $("#manualTossed").attr('disabled', 'disabled');
    $("#manualTossed").val("Enter #'s");
    $("#manualTossed").css("background-color","grey");
    $("#manualTossed").change(function () {
        $("#manualTossed").removeAttr('disabled');
        $("#manualTossed").val('Show');
        $("#manualTossed").css("background-color","green");
    });
        
    $("#f_final").on('input',function(e){
        $("#manualTossed").trigger("change");
    });

    
    $("#f_tossed").mouseout(function () {
        if (!($("#f_tossed").val())) {
        } else {
            var pseq = $("#f_tossed").val();
            var durl = "/api/func.php?func=getHexnumOppositeByPseq&pseq=" + pseq;
            $.ajax({
                url: durl,
                data: {
                    format: "json"
                },
                crossDomain: true,
                dataType: 'jsonp',
                jsonpCallback: 'callback',
                type: 'GET',
                success: function (json) {
                    //                $("#f_final").attr("placeholder", json['ret']);
//                    $("#f_final").val(json['ret']);
  //                  $("#manualTossed").trigger("change");
                },
                error: function () {
                    alert("Request Failed");
                }

            });
        }
    });
$("#debugon").click(function () {
    console.log($('input[type=checkbox]').prop('checked'));
    if ($('input[type=checkbox]').prop('checked') ) {
        $("#qfield").val("debugging...");
        $("#reset").attr("href","index.php?qfield=debugging&debugon=1");
    } else {
        $("#qfield").val("");
        $("#reset").attr("href","index.php");
   }

    });
    

    $("#tosstype").hover(function () {
        turnOffRadio();
//            $("#entropymsg").text("not yet enabled");
    });

//jQuery("#tosstype").click(writeData);        
    function turnOffRadio() {
//        $("#tosstype  input[id^=r-decay]:radio").attr('disabled',true);
        $("#tosstype  input[id^=entropy]:radio").attr('disabled', true);
        $("#tosstype  input[id^=acultural]:radio").attr('disabled', true);
    }

//    $("#xsubtip").qtip({
//        content: 'This is the transitional hexagram that is the difference between the original and the resulting hexagram.  Typically this transition is represented only by the moving lines of the original hexagram.  We rrive at this transition hexagram by subtracting the binary value of the original hex from the final hex (andd add 63 is less that zer0)final hexagram.  In this way, this transitional hex is the hexagram verion of the movong lines.',
//    
//    $("#plumtip").qtip({
//        content: 'The Modern Plum technique is based on the ancient Mei Hua ("Plum Blossom") method of the Sung Synasty (920-1279ad).  It uses the current time as the "seed" for the casting.  This modern version also uses the current time of number of milliseconds since Jan. 1, 1970. An algorithm takes that number, <a href="/book/ichingbook/_book/instructions.html">transforms it to simulate three coins</a>.  This is done six time, with a random numner of milliseconds between each "toss".',
//    
//    $("#testtip").qtip({
//        content: 'This randomly generates hexagrams using the PHP rand() function.  Mainly used for its speed as it does not access any services. Not a good option for proper use.',

    $(function () {
        $("#xsubtipmsg").dialog({
            autoOpen: false
        });
        $("#xsubtip").on("click", function () {
            $("#xsubtipmsg").dialog("open");
        });
    });

    $(function () {
        $("#plumtipmsg").dialog({
            autoOpen: false
        });
        $("#plumtip").on("click", function () {
            $("#plumtipmsg").dialog("open");
        });
    });
    $(function () {
        $("#tosstypemsg").dialog({
            autoOpen: false
        });
        $("#tosstypemsg").on("click", function () {
            $("#tosstype").dialog("open");
        });
    });


    $(function () {
        $("#testtipmsg").dialog({
            autoOpen: false
        });
        $("#testtip").on("click", function () {
            $("#testtipmsg").dialog("open");
        });
    });

//            $("#randomtip").qtip({
//        content: 'The "flipping" is actually being done by Random.Org, who are so meticulous about the quality and integrity of their randomness that they actually have different result based on the type of coin you use. For now, we are using three Bronze Sestertius coins from the Roman Empire of Antoninus Pius<img src="/images/reverse.png" style="width:60px;height:60px;passing 5px;float:right;"><img src="/images/obverse.png" style="width:60px;height:60px;passing 5px;float:right;">',
    $(function () {
        $("#randomtipmsg").dialog({
            autoOpen: false
        });
        $("#randomtip").on("click", function () {
            $("#randomtipmsg").dialog("open");
        });
    });
    $(function () {
        $("#hukuamsg").dialog({
            autoOpen: false
        });
        $("#hukuatip").on("click", function () {
            $("#hukuamsg").dialog("open");
        });
    });
    $(function () {
        $("#penkuamsg").dialog({
            autoOpen: false
        });
        $("#penkuatip").on("click", function () {
            $("#penkuamsg").dialog("open");
        });
    });

    //    
//    
//    $("#entropytip").qtip({
//        content: 'CURRENTY DISABLED - Entropy is how random numbers are genenrated for encruption purposed.  This randomness is often collected from hardware sources (variance in fan noise or HDD), either pre-existing ones such as mouse movements or specially provided randomness generators.  The problem with this method is it takes time to "collect" entropy.  If it is all used up, it could take many minutes to collect enough too throw the I Ching.',
    $(function () {
        $("#entropytipmsg").dialog({
            autoOpen: false
        });
        $("#entropytip").on("click", function () {
            $("#entropytipmsg").dialog("open");
        });
    });
//    
//    $("#r-decaytip").qtip({
//        content: 'CURRENTY DISABLED - This is the "real" random, as it is theoretically impossible to predict decay.  The only problem with this memthod is I would need actually radioactive material to  get it to work, or find a source, like the old Fermi Lab service, which provides these types of randm numbers',
//    
    $(function () {
        $("#astrotipmsg").dialog({
            autoOpen: false
        });
        $("#astrotip").on("click", function () {
            $("#astrotipmsg").dialog("open");
        });
    });
    
    $(function () {
        $("#r-decaytipmsg").dialog({
            autoOpen: false
        });
        $("#r-decaytip").on("click", function () {
            $("#r-decaytipmsg").dialog("open");
        });
    });
//    $("#baynestip").qtip({
//        content: 'This is the popular, traditional English translation of the German translation of the original Chinese text brougt back from China by the Jesuits',
    $(function () {
        $("#baynestipmsg").dialog({
            autoOpen: false
        });
        $("#baynestip").on("click", function () {
            $("#baynestipmsg").dialog("open");
        });
    });
//    
//    $("#aculturaltip").qtip({
//        content: 'CURRENTLY UNAVAILABLE - This is for the upcoming new translation that redefines the structure and the relationship of the hexagrams outside of the highly moral Confucian version, which is the only one that survided to this day.  The Lao Tzu version, undoubtedly less moralistic and judgemental, did not',
    $(function () {
        $("#aculturaltipmsg").dialog({
            autoOpen: false
        });
        $("#aculturaltip").on("click", function () {
            $("#aculturaltipmsg").dialog("open");
        });
    });

// ajust foro screen


    //   if ($(window).width() < 767) {
//        $(".awrapper").css({
//            "width": "95%"
//        });
    //   }



    var headers = $('[id^=accordion] .accordion-header');
    var contentAreas = $('[id^=accordion] .ui-accordion-content ').hide().first().show().end();
    var expandLink = $('.accordion-expand-all');

// add the accordion functionality
    headers.click(function () {
        // close all panels
        contentAreas.slideUp();
        // open the appropriate panel
        $(this).next().slideDown();
        // reset Expand all button
        expandLink.text('[+]')
                .data('isAllOpen', false);
        // stop page scroll
        return false;
    });

// hook up the expand/collapse all
    expandLink.click(function () {
        var isAllOpen = !$(this).data('isAllOpen');
        console.log({isAllOpen: isAllOpen, contentAreas: contentAreas})
        
        if (isAllOpen) {
            $("#btnEC").css("color","darkgreen");
        } else {
            $("#btnEC").css("color","darkred");
        }
        contentAreas[isAllOpen ? 'slideDown' : 'slideUp']();

        expandLink.text(isAllOpen ? '[-]' : '[+]')
        contentAreas[isAllOpen ? 'slideDown' : 'slideUp']();

        expandLink.text(isAllOpen ? '[-]' : '[+]')
                .data('isAllOpen', isAllOpen);
    });

    $("#larger1").click(function () {
        $("p").css("font-size", "large");
    });
    $("#larger1").hover(function () {
        $('#larger1').css("cursor", "hand");
    });

    $("#larger2").click(function () {
        $("p").css("font-size", "x-large");
    });
    $("#larger2").hover(function () {
        $('#larger2').css("cursor", "hand");
    });

    $("#larger3").click(function () {
        $("p").css("font-size", "xx-large");
    });
    $("#larger3").hover(function () {
        $('#larger3').css("cursor", "hand");
    });

//    
//
//    $("#expand1").click(function () {
////        $('#accordion1 .ui-accordion-content').show();
////        $('#accordion2 .ui-accordion-content').show();
// $("#accordion1").accordion("destroy");
// $("#accordion2").accordion("destroy");
//    });
//    $("#expand1").hover(function () {
//        $('#expand1').css("cursor","hand");
//    });
//    $("#collapse1").click(function () {
//        $("#accordion1").accordion();
//        $("#accordion2").accordion();
//    });
//    $("#collapse1").hover(function () {
//        $('#collapse1').css("cursor","hand");
//    });

//    $("#grab").click(function () {
//        var node = document.getElementById('qfield');
//        domtoimage.toPng(node)
//                .then(function (dataUrl) {
//                    var img = new Image();
//                    img.src = dataUrl;
//                    document.body.appendChild(img);
//                })
//                .catch(function (error) {
//                    console.error('oops, something went wrong!', error);
//                });
//    });
});