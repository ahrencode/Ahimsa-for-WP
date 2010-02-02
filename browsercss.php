<!-- TODO: move to jQuery calls -->

<style type='text/css'>

    <?php if( preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT']) ) : ?>

        #sidebar fieldset.sidebarlist
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

        #sidebar
        {
            padding-top: 30px;
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

