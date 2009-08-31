// as per jQuery folks, it is quite fine to call $(document).ready() multiple times;
// in our case here and in ahimsa.js
//
$(document).ready
(
    function()
    {
        // IE specific hacks for curved corners
        if( jQuery.browser.msie )
        {
            // using two different jQuery extensions here since each of them does some
            // things better than the other.

            $('#main').corners('30px bottom-right');
            $('.post > fieldset').corners('15px');
            $('blockquote').corners('15px');
            $('ul').corners('15px');
            $('ol').corners('15px');
            $('.postcattags').corners('10px');

            var bgtopcolour = $('#bgtop').css('background-color');
            $('#header').corner('top 30px cc:' + bgtopcolour);

            //
            /*
            $('#main').css('background-color', $('#bgtop').css('background-color'));
            $('.sidebarlist').corner('15px');
            //$('#sidebar').corner('bl 30px');
            //$('#content').corner('br 30px');
            //$('blockquote').corner('15px');
            //$('ul').corner('15px');
            //$('ol').corner('15px');
            //$('fieldset').corner('15px');
            //$('.capsule').corner('6px');
            //$('.actbubble').corner('6px');
            */
        }
    }
);

