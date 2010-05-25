
function fadeBlock(id)
{
    if( jQuery(id).is(':visible') )
        jQuery(id).fadeOut(500);
    else
        jQuery(id).fadeIn(500);

    return;
}

function slideBlock(id, side)
{
    if( jQuery(id).is(':visible') )
        jQuery(id).hide("slide", { direction: side }, 600);
    else
        jQuery(id).show("slide", { direction: side }, 600);

    return;
}


var tdsbBackground = "";
function slideSideBar(side)
{
    if( ! document.getElementById('sidebar'+side) )
        return;

    tdsb = document.getElementById('tdsidebar'+side);
    sb = document.getElementById('sidebar'+side);

    // I am not sure how the below works to toggle the background on and off
    // for the container cell. tdsbBackground, as set below, doesn't work!!!
    // It's empty, I guess because sb.style.backgroundColor is computed and
    // not available here. But the below logic, to toggle the background from
    // transparent to colour and back works magically!!!

    if( tdsbBackground == "" )
        tdsbBackground = sb.style.backgroundColor;

    if( sb.style.display == 'none' )
    {
        contentCurve(side, '0px');
        tdsb.style.backgroundColor = tdsbBackground;
    }
    else
    {
        contentCurve(side, '30px');
        tdsb.style.backgroundColor = 'transparent';
    }

    slideBlock('#sidebar'+side, side);
}

function contentCurve(side, size)
{
    divcont = document.getElementById('content');
    if( side == 'left' )
    {
        divcont.style.borderRadiusBottomleft = size;
        divcont.style.webkitBorderBottomLeftRadius = size;
        divcont.style.MozBorderRadiusBottomleft = size;
    }
    else
    {
        divcont.style.borderRadiusBottomright = size;
        divcont.style.webkitBorderBottomRightRadius = size;
        divcont.style.MozBorderRadiusBottomright = size;
    }
}

function toggleDelicious()
{
    recent = document.getElementById('recent');
    rechdr = document.getElementById('recentheader');
    reclist = document.getElementById('recentlist');
    recmore = document.getElementById('recentmore');

    if( reclist.style.display == 'block' )
    {
        recmore.style.display = 'none';
    }
    else
    {
        recmore.style.display = 'block';
    }

    fadeBlock('recentlist');
}


function recalcBlocks()
{
    document.getElementById("container").style.height = getWinHeight() + "px";
}


// code borrowed from: http://www.howtocreate.co.uk/tutorials/javascript/browserwindow
function getWinHeight()
{
    var myHeight = 0;
    if( typeof( window.innerHeight ) == 'number' )
    {
        //Non-IE
        myHeight = window.innerHeight;
    }
    else
    if( document.documentElement && document.documentElement.clientHeight )
    {
        //IE 6+ in 'standards compliant mode'
        myHeight = document.documentElement.clientHeight;
    }
    else
    if( document.body && document.body.clientHeight )
    {
        //IE 4 compatible
        myHeight = document.body.clientHeight;
    }

    return(myHeight);
}

function getWinWidth()
{
    var myWidth = 0;
    if( typeof( window.innerWidth ) == 'number' )
    {
        //Non-IE
        myWidth = window.innerWidth;
    }
    else
    if( document.documentElement && document.documentElement.clientWidth )
    {
        //IE 6+ in 'standards compliant mode'
        myWidth = document.documentElement.clientWidth;
    }
    else
    if( document.body && document.body.clientWidth )
    {
        //IE 4 compatible
        myWidth = document.body.clientWidth;
    }

    return(myWidth);
}

jQuery(document).ready
(
    function()
    {
        // display vertical or rotated text depending on browser support
        // test in the order of browser popularity to save a few cycles ;-)
        if( jQuery('#sidebartableft').length > 0 )
            tab = '#sidebartableft';
        else
        if( jQuery('#sidebartabright').length > 0 )
            tab = '#sidebartabright';
        else
            tab = "";
        if( tab != "" )
        {
            // safari returns the CSS property even if it doesn't implement it
            // so we have a special check below for safari3 which does not
            // support CSS transform
            var safari3re = /Version\/3\.0.*Safari/;
            if( !safari3re.test(navigator.appVersion) &&
                ((jQuery(tab).css('filter') != '' &&
                    jQuery(tab).css('filter') != 'none') ||
                (jQuery(tab).css('-moz-transform') != '' &&
                    jQuery(tab).css('-moz-transform') != 'none') ||
                (jQuery(tab).css('-webkit-transform') != '' &&
                    jQuery(tab).css('-webkit-transform') != 'none') ||
                (jQuery(tab).css('-o-transform') != '' &&
                    jQuery(tab).css('-o-transform') != 'none')) )
            {
                jQuery('#sidebartableft').addClass('sidebartableftrotated');
                jQuery('#sidebartabright').addClass('sidebartabrightrotated');
                jQuery('.sidebartabnorotatetext').hide();
                jQuery('.sidebartabrotatedtext').show();
            }
            else
            {
                jQuery('.sidebartab').addClass('sidebartabnorotate');
                jQuery('#sidebartableft').addClass('sidebartableftnorotate');
                jQuery('#sidebartabright').addClass('sidebartabrightnorotate');
                jQuery('.sidebartabrotatedtext').hide();
                jQuery('.sidebartabnorotatetext').show();
            }
            jQuery('.sidebartab').show();
        }
        

        // display tags permitted in comments when focus is on response box
        jQuery('#replytext').focus(function() { jQuery('#commenthint').fadeIn(); });
        jQuery('#replytext').blur(function() { jQuery('#commenthint').fadeOut(); });
    }
);
