
function toggleDisplay(id)
{
    el = document.getElementById(id);
    if( el.style.display == 'block' )
        el.style.display = 'none';
    else
        el.style.display = 'block';
}
