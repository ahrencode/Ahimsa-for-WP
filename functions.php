<?php
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<fieldset class="sidebarlist">',
        'after_widget' => '</fieldset>',
        'before_title' => '<legend> &sect; ',
        'after_title' => '</legend>',
    ));
    
?>
