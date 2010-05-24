<!-- TODO: move to jQuery calls -->

<style type='text/css'>

    <?php if( preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT']) ) : ?>

        fieldset.sidebarlist
        {
            margin-bottom: 15px !important;
        }

        fieldset.comment
        {
            margin-top: 15px;
        }

    <?php endif; ?>

    <?php if( preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']) ) : ?>

        /* hack to get fieldset background and legend position working right in IE */
        FIELDSET
        {
            position: relative;
            margin: 0 0 1em 0;
        }

        FIELDSET LEGEND
        {
            position: absolute;
            top: -15px;
            left: 3%;
        }
        /* end hack */

        .sidebar
        {
            padding-top: 30px;
        }

        .sidebartab
        {
            font-family: Arial;
            padding: 5px 10px;
            /* width needs to be set for rotate to work in IE! */
            width: 80px;
        }

        #sidebartableftrotated
        {
            margin-left: 0px;
            margin-right: -75px;
        }

        #sidebartabrightrotated
        {
            margin-right: -75px;
        }

        .post fieldset legend.title,
        fieldset#comments legend,
        fieldset.comment legend,
        fieldset#responsebox legend
        {
            font-size: 10pt !important;
        }

        .capsule
        {
            font-size: 8pt;
        }

        fieldset.comment,
        fieldset#responsebox
        {
            padding-top: 25px;
        }

        #respond INPUT#submit
        {
            font-weight: normal;
            font-size: small;
            padding: 3px 0px;
        }

    <?php endif; ?>

</style>

