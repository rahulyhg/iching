$(document).ready(function () {

    /* *********************************************************
     * timer to make a div visible after some time
     * *********************************************************/
    /*
    setTimeout( function(){ 
        $('#presentationlayer').css("visiblity","visible");
        }  , 3000 
    );
     */        
    var w = $(window).width();
    var h = $(window).height();
    w = w * .8;
    h = h * .8;
    $("body").css({"max-width": w + "px"});
    $("body").css({"max-height": h + "px"});
//    $("body").css({"border": "3px solid black"});


    
//    $(window).resize(function(){
//        var w = $(window).width();
//        var h = $(window).height();
//w = w*.8;
//h = h*.8;
//
//        $("body").css({"max-width":w + "px"});
//        $("body").css({"border":"3px solid red"});
//    });

    /* *********************************************************
     * change the css if the screen is small
     * *********************************************************/
    if ($(window).width() < 767) {
        console.log("screen x/y: " + $(window).width() + "/" + $(window).height());

        /* below is anotehr way to do the same, but what is the diff? */
        
        
        $("#accordian1").css({
            "min-width": "50% !important"
        });
        $("#accordian2").css({
            "min-width": "50% !important"
        });
        $("#accordian1").css({
            "max-width": "50% !important"
        });
        $("#accordian2").css({
            "max-width": "50% !important"
        });
 
        
//        $(".container").css({
//            "max-width": "344px"
//        });
//        $(".container").css({
//            "max-height": "667px"
//        });
//        
        /*
        $(".carousel-control").css({
            "display": "none"
        })
        */
    }

    /* *********************************************************
     * functions to format and show popup help boxes 
     * *********************************************************/
    $.fn.center = function () {
        this.css("position", "absolute");
        this.css("top", ($(window).height() - this.height()) / 2 + "px");
        this.css("left", ($(window).width() - this.width()) / 2 + "px");
        return this;
    };

    $.fn.recss = function (e) {
        /* ignore function if one of the top buttons were pressed */
        if (e.target.className == "rdbbtns") {
            return(true);
        }
        e.preventDefault();
        var w = $(window).innerWidth();
        var h = $(window).innerHeight();
        console.log(w);


        var top = $(document).scrollTop();

        this.parent().css("width", w*.8);
        this.parent().css("top", top + "px");
        this.parent().css("left", "10%");
        this.parent().css("border", "3px solid red");
        this.parent().css("position", "fixed");

    };

    
    /* *********************************************************
     * How does this work?
     * *********************************************************/
//    $('#download').click(function (e) {
//        e.preventDefault();  //stop the browser from following
//        window.location.href = '/questions';
//    });

    /* *********************************************************
     * detects when leaving the final manually entered number, 
     * and if empty, defaults to the value in placeholder
     * *********************************************************/
    $('#f_final').blur(function ()
    {
        if (!$(this).val()) {
            var v = $("#f_final").attr("placeholder");
            $(this).val(v);
        }
    });

    /* *********************************************************
     * manually creating a SUBMIT button fro the "Tao of Now" 
     * *********************************************************/
    /* JWFIX how to read REQUEST to add debuigging? */
    $("#nowbutton").click(function () {
        $("#qfield").val("Your Tao of Now");
        $("#nowbutton").attr("style","min-width:280px; min-height:80px; background-image: url(/images/newnow_dn.png) !important;background-size: cover !important; border:2px solid darkslategray");

        $.redirect('/index.php', {
            flipped: "1"
            , mode: "astro"
            , trans: "baynes"
//            ,debugon:"1"    
        });
        return(true);
    });

    /* *********************************************************
     * grey the "submit question" until enough chars have been entered
     * *********************************************************/
    $("#castbutton").val("Or Enter Question Below");
    $("#castbutton").css("background-color", "grey");
    $("#qfield").on('input', function (e) {
        $("#castbutton").css("background-color", "green");
        $("#castbutton").val("Cast Hexagram");
    });

    /* *********************************************************
     * grey the "send msg" until enough chars have been entered
     * *********************************************************/
    $("#sugSend").val("Add Msg");
    $("#sugSend").css("background-color", "grey");
    $("#sugField").on('input', function (e) {
        var sterm = $("#sugField").val().toString();
        if (sterm.length > 32) {
            $("#sugSend").css("background-color", "green");
            $("#sugSend").val("SEND");
        }
    });

    /* *********************************************************
     * grey the "submit" until enough chars have been entered
     * *********************************************************/
    $("#manualTossed").attr('disabled', 'disabled');
    $("#manualTossed").val("Enter 2 Nums");
    $("#manualTossed").css("background-color", "#222222");
    $("#manualTossed").change(function () {
        $("#manualTossed").removeAttr('disabled');
        $("#manualTossed").val('Show Hexagrams');
        $("#manualTossed").css("background-color", "green");
    });

    /* *********************************************************
     * update the manual input field as soon as you enter
     * *********************************************************/
    $("#f_final").on('input', function (e) {
        $("#manualTossed").trigger("change");
    });

    /* *********************************************************
     * get the value for the final field as soon as you leave the intital field
     * *********************************************************/
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
                    $("#f_final").attr("placeholder", json['ret']);
//                    $("#f_final").val(json['ret']);
                    //                  $("#manualTossed").trigger("change");
                },
                error: function () {
                    alert("Request Failed");
                }

            });
        }
    });
    
    /* *********************************************************
     * turn debugging on/off
     * *********************************************************/
    $("#debugon").click(function () {
        //console.log($('input[type=checkbox]').prop('checked'));
        if ($('input[type=checkbox]').prop('checked')) {
            $("#qfield").val("debugging...");
            $("#reset").attr("href", "index.php?qfield=debugging&debugon=1");
        } else {
            $("#qfield").val("");
            $("#reset").attr("href", "index.php");
        }

    });

    /* *********************************************************
     * the box dims that hold qbox
     * *********************************************************/
    $("#tosstype").hover(function () {
        turnOffRadio();
//            $("#entropymsg").text("not yet enabled");
    });

    /* *********************************************************
     * disables the abiluty to select a radio button 
     * *********************************************************/
    function turnOffRadio() {
        $("#tosstype  input[id^=entropy]:radio").attr('disabled', true);
        $("#tosstype  input[id^=acultural]:radio").attr('disabled', true);
    }
    
    /* *********************************************************
     * These are all the popup tip/help message functions
     * *********************************************************/
    $(function () {
        $("#xsubtipmsg").dialog({
            autoOpen: false
        });
        $("#xsubtip").on("click", function ($e) {
            var o = $("#xsubtipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });

    $(function () {
        $("#plumtipmsg").dialog({
            autoOpen: false
        });
        $("#plumtip").on("click", function ($e) {
            var o = $("#plumtipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    $(function () {
        $("#tosstypemsg").dialog({
            autoOpen: false
        });
        $("#tosstype").on("click", function ($e) {
            var o = $("#tosstypemsg");
            o.dialog("open");
            o.recss($e);
        });
    });

    $(function () {
        $("#testtipmsg").dialog({
            autoOpen: false
        });
        $("#testtip").on("click", function ($e) {
            var o = $("#testtipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });

    $(function () {
        $("#randomtipmsg").dialog({
            autoOpen: false
        });
        $("#randomtip").on("click", function ($e) {
            var o = $("#randomtipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    $(function () {
        $("#hukuamsg").dialog({
            autoOpen: false
        });
        $("#hukuatip").on("click", function ($e) {
            var o = $("#hukuamsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    $(function () {
        $("#penkuamsg").dialog({
            autoOpen: false
        });
        $("#penkuatip").on("click", function ($e) {
            var o = $("#penkuamsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    
//    currently disableld
//    $(function () {
//        $("#entropytipmsg").dialog({
//            autoOpen: false
//        });
//        $("#entropytip").on("click", function ($e) {
//            var o = $("#entropytipmsg");
//            o.dialog("open");
//            o.recss($e);
//        });
//    });

    $(function () {
        $("#astrotipmsg").dialog({
            autoOpen: false
        });
        $("#astrotip").on("click", function ($e) {
            var o = $("#astrotipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });

    $(function () {
        $("#r-decaytipmsg").dialog({
            autoOpen: false
        });
        $("#r-decaytip").on("click", function ($e) {
            var o = $("#r-decaytipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });

    $(function () {
        $("#baynestipmsg").dialog({
            autoOpen: false
        });
        $("#baynestip").on("click", function ($e) {
            var o = $("#baynestipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    
    $(function () {
        $("#aculturaltipmsg").dialog({
            autoOpen: false
        });
        $("#aculturaltip").on("click", function ($e) {
            var o = $("#aculturaltipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });

    $(function () {
        $("#qtr1tipmsg").dialog({
            autoOpen: false
        });
        $("#qtr1tip").on("click", function ($e) {
            var o = $("#qtr1tipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    $(function () {
        $("#qtr2tipmsg").dialog({
            autoOpen: false
        });
        $("#qtr2tip").on("click", function ($e) {
            var o = $("#qtr2tipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    $(function () {
        $("#qtr3tipmsg").dialog({
            autoOpen: false
        });
        $("#qtr3tip").on("click", function ($e) {
            var o = $("#qtr3tipmsg");
            o.dialog("open");
            o.recss($e);
        });
    });
    
    /* *********************************************************
     * Special case for popup over hover for donate tip
     * *********************************************************/
    $(function () {
        $("#donatemsg").dialog({
            autoOpen: false
        });
        $("#donatetip").hover(
                function ($e) {
                    $(this).css({"background-color": "red"});
                    var o = $("#donatemsg");

                    $e.preventDefault();
                    var top = $(document).scrollTop();

                    //    o.parent().css("width","80%");
                    o.parent().css("top", top + "px");
                    o.parent().css("left", "10%");
                    o.parent().css("border", "3px solid red");
                    o.parent().css("position", "fixed");
                    o.dialog("open");
                },
                function () {
                    //$(this).css({"background-color":"blue"});
                    // $("#donatemsg").dialog("close");
                });
    });
    
    /* *********************************************************
     * add the accordion functionality
     * *********************************************************/
    var headers = $('[id^=accordion] .accordion-header');
    var contentAreas = $('[id^=accordion] .ui-accordion-content ').hide().first().show().end();
    var expandLink = $('.accordion-expand-all');

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

    /* *********************************************************
     * hook up the expand/collapse all
     * *********************************************************/
    expandLink.click(function () {
        var isAllOpen = !$(this).data('isAllOpen');
        console.log({isAllOpen: isAllOpen, contentAreas: contentAreas});

        if (isAllOpen) {
            $("#btnEC").css("color", "darkgreen");
        } else {
            $("#btnEC").css("color", "darkred");
        }
        contentAreas[isAllOpen ? 'slideDown' : 'slideUp']();

        expandLink.text(isAllOpen ? '[-]' : '[+]');
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

});

