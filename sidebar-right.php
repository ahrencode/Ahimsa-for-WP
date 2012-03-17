<td id='tdsidebarright' class='tdsidebar'  valign='top'>
    <!-- inline style required for easy JavaScript mods, without getting computed styles -->
    <div id='sidebarright' class='sidebar' style='display: block; opacity: 1.0;'>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('rightbar') ) : ?>
        <?php endif; ?>
    </div>
</td>
