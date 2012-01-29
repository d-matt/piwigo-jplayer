<?php
function plugin_install()
{
    if (!isset($conf['jplayer_skin'])) {
        $q = 'INSERT INTO '.CONFIG_TABLE.' (param,value,comment) 
              VALUES ("jplayer_skin", "bm", "Skin used by the piwigo-jplayer plugin");';
        pwg_query( $q );
    }
    if (!isset($conf['jplayer_autoplay'])) {
        $q = 'INSERT INTO '.CONFIG_TABLE.' (param,value,comment) 
              VALUES ("jplayer_autoplay", "false", "autoplay media in jplayer plugin");';
        pwg_query( $q );
    }
}

function plugin_uninstall() 
{
    $q = 'DELETE FROM '.CONFIG_TABLE.' WHERE param = "jplayer_skin";';
    pwg_query( $q );

    $q = 'DELETE FROM '.CONFIG_TABLE.' WHERE param = "jplayer_autoplay";';
    pwg_query( $q );

    // TODO : Do we need to purge the videos from the images table? 
}
?>
