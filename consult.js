$(document).ready(function () {
    $("#flipdesc").qtip({
        content: 'The "flipping" is actually being done by Random.Org, who are so meticulous about the quality and integrity of their randomness that they actually have different result based on the type of coin you use.',
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
});
