
jQuery(document).ready
(
    function()
    {
        // IE specific hacks for curved corners
        if( jQuery.browser.msie )
        {
            // using two different jQuery extensions here since each of them does some
            // things better than the other.

            jQuery('#main').corners('30px bottom-right');
            jQuery('.post > fieldset').corners('15px');
            jQuery('blockquote').corners('15px');
            jQuery('ul').corners('15px');
            jQuery('ol').corners('15px');
            jQuery('.postcattags').corners('10px');

            var bgtopcolour = jQuery('#bgtop').css('background-color');
            jQuery('#header').corner('top 30px cc:' + bgtopcolour);

            //
            /*
            jQuery('#main').css('background-color', jQuery('#bgtop').css('background-color'));
            jQuery('.sidebarlist').corner('15px');
            //jQuery('#sidebar').corner('bl 30px');
            //jQuery('#content').corner('br 30px');
            //jQuery('blockquote').corner('15px');
            //jQuery('ul').corner('15px');
            //jQuery('ol').corner('15px');
            //jQuery('fieldset').corner('15px');
            //jQuery('.capsule').corner('6px');
            //jQuery('.actbubble').corner('6px');
            */
        }
    }
);

