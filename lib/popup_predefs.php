<?php /* wrap all these in a hidden div so they don't show up for a split secnd on the homepage */ ?>
<div style="display:none"> 
    
    <!-- ----------------------------------------------------------------------->
    <div id="xsubtipmsg" title="Transitional Hexagram">
        <p>
            This is the transitional hexagram that is the difference between the original and the resulting hexagram.  Typically this transition is represented only by the moving lines of the original hexagram.  We 
            arrive at this transition hexagram by subtracting the binary value of 
            the original hex from the final hex (and add 63 is less than zero) 
            final hexagram.  In this way, this transitional hex is the hexagram version of the moving lines.
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="plumtipmsg" title="Modern 'Plum Blossom'">
        <p>
            The Modern Plum technique is based on the ancient Mei Hua ("Plum Blossom") 
            method of the Sung Dynasty (920-1279ad).  It uses the current time as the "seed" for the casting.  This modern version also uses the current time of a number of milliseconds since Jan. 1, 1970. An 
            algorithm takes that number, <a href="/book/ichingbook/_book/instructions.html">
                transforms it to simulate three coins</a>.  This is done six time, 
            with a random number of milliseconds between each "toss".
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="testtipmsg" title="Test Data">
        <p>
            This randomly generates hexagrams using the PHP rand() function.  Mainly used for its speed as it does not access any services. Not a good option for proper use.
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="randomtipmsg" title="Better Random Numbers">
        <p>
            The "flipping" is actually being done by Random.Org, who are so meticulous 
            about the quality and integrity of their randomness that they actually have 
            different result based on the type of coin you use. For now, we are using 
            three Bronze Sestertius coins from the Roman Empire of Antoninus Pius
            <img src="/images/reverse.png" style="width:60px;height:60px;padding:5px;float:right;">
            <img src="/images/obverse.png" style="width:60px;height:60px;padding:5px;float:right;">
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="entropytipmsg" title="Entropy">
        <p>
            CURRENTLY DISABLED - Entropy is how random numbers are generated for encryption 
            purposed.  This randomness is often collected from hardware sources (variance in fan noise or HDD), either pre-existing ones such as mouse movements or specially provided randomness generators.  The problem with this method is it takes time to "collect" entropy.  If it is all used up, it could take many 
            minutes to collect enough too throw the I Ching
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="r-decaytipmsg" title="True Random Numbers">
        <p>
            This is the "real" random, as it is theoretically impossible to predict decay.  We use the 
            <a href="http://www.fourmilab.ch/">Fermi Lab</a> 'HotBits' service, which provides these types of random numbers.
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="baynestipmsg" title="Wilhelm / Baynes Translation">
        <p>
            This is the popular, traditional English translation of the German translation 
            of the original Chinese text brought back from China by the Jesuits
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="aculturaltipmsg" title="Acultural Interpretation">
        <p>
            CURRENTLY UNAVAILABLE - This is for the upcoming new translation that redefines 
            the structure and the relationship of the hexagrams outside of the highly moral 
            Confucian version, which is the only one that survived to this day.  The Lao Tzu 
            version, undoubtedly less moralistic and judgmental, did not
        </p>
    </div>    <!-- ----------------------------------------------------------------------->
    <div id="astrotipmsg" title="Planetary Positions">
        <p>
            These are numbers generated from the current, exacxt, location of the planets. 
           We use the classical astrological assignment the six planets that make up teh zodiac.  
           For more on this see the 
           <a href="/book/ichingbook/_book/instructions.html#planetary">documentation</a>. 
           <br>
           This option is also a good choice for throwing the hexagrams of "now".
            
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="hukuamsg" title="The Hu Kua">
        <p>
            The typical hexagrams (the "Pen Kua") show the beginning, middle, and end of a situation, but there is another, hidden, story to be told.  We can see this hidden story in the "Hu Kua".  This is where we take the 2nd, 3rd, and 4th lines and make the lower trigram of a new hexagram, and then take the 3rd, 4th, and 5th lines to create an upper trigram.  This newly created hexagram is the "Hu Kua".
            <img src="/images/hukua.png">
        </p>
    </div>
    <!-- ----------------------------------------------------------------------->
    <div id="penkuamsg" title="The Hu Kua">
        <p>
            The "Pen Kua" are the hexagrams arrived at by tossing coins or yarrow sticks, etc. This is the most common form of the hexagrams; the ones we usually think of when he think of the I Ching.
        </p>
    </div>


</div>
