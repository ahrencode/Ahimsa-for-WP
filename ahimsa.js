
function toggleDisplay(id)
{
    el = document.getElementById(id);
    if( el.style.display != 'none' )
        el.style.display = 'none';
    else
        el.style.display = 'block';
}


var fadingBlocks = new Array();

function fadeBlock(id)
{
    if( fadingBlocks[id] )
        return;

    ctr = 0;

    function doFade()
    {
        ctr++;

        opacity = el.style.opacity;
        //alert("Fading... opacity = " + opacity + ", delta = " + delta);
        opacity = parseFloat(opacity) + delta;

        if( opacity > 0.9  || opacity < 0.1 || ctr > 10 )
        {
            clearInterval(intervalId);
            opacity = Math.round(opacity, 0);
            if( delta < 0 )
                toggleDisplay(id);
            fadingBlocks[id] = 0;
        }

        el.style.opacity = opacity;
    }

    fadingBlocks[id] = 1;
    el = document.getElementById(id);
    delta = ( el.style.display != 'none' ) ? -0.1 : 0.1;
    if( delta > 0 )
        toggleDisplay(id);
    intervalId = setInterval(doFade, 50);
}

var tdsbBackground = "";
function fadeSideBar()
{
    tdsb = document.getElementById('tdsidebar');
    sb = document.getElementById('sidebar');
    divcont = document.getElementById('content');

    // I am not sure how the below works to toggle the background on and off
    // for the container cell. tdsbBackground, as set below, doesn't work!!!
    // It's empty, I guess because sb.style.backgroundColor is computer and
    // not available here. But the below logic, to toggle the background from
    // transparent to colour and back works magically!!!

    if( tdsbBackground == "" )
        tdsbBackground = sb.style.backgroundColor;

    if( sb.style.display == 'none' )
    {
        divcont.style.borderRadiusBottomleft = '0px';
        divcont.style.webkitBorderBottomLeftRadius = '0px';
        divcont.style.MozBorderRadiusBottomleft = '0px';
        tdsb.style.backgroundColor = tdsbBackground;
    }
    else
    {
        divcont.style.borderRadiusBottomleft = '30px';
        divcont.style.webkitBorderBottomLeftRadius = '30px';
        divcont.style.MozBorderRadiusBottomleft = '30px';
        tdsb.style.backgroundColor = 'transparent';
    }

    fadeBlock('sidebar');
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

