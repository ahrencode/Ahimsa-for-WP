
function toggleDisplay(id)
{
    el = document.getElementById(id);
    if( el.style.display != 'none' )
        el.style.display = 'none';
    else
        el.style.display = 'block';
}

function fadeBlock(id)
{
    if( $('#'+id).is(':visible') )
        $('#'+id).fadeOut(1200);
    else
        $('#'+id).fadeIn(1200);

    return;
}

var tdsbBackground = "";
function fadeSideBar(side)
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

    fadeBlock('sidebar'+side);
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

