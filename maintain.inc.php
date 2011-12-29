<?php
function plugin_install()
{
    $q = 'INSERT INTO '.CONFIG_TABLE.' (param,value,comment) 
          VALUES ("jplayer_skin", "bm", "Skin used by the piwigo-jplayer plugin");';
    pwg_query( $q );
}

function plugin_uninstall() 
{
    $q = 'DELETE FROM '.CONFIG_TABLE.' WHERE param = "jplayer_skin";';
    pwg_query( $q );

    // TODO : Do we need to purge the videos from the images table? 
}
?>
