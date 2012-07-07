<?php
// Chech whether we are indeed included by Piwigo.
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

// Fetch the template.
global $template, $conf;

// Load parameter
$skin = $conf['jplayer_skin'];
$autoplay = $conf['jplayer_autoplay'];
$poster = $conf['jplayer_representative_as_poster'];

// Available skins
$available_skins = array(
    'bm' => 'Blue Monday',
    'pf' => 'Pink Flag',
    'naive' => 'naive',
);

// Update conf if submitted in admin site
if (isset($_POST['submit'])) { 
    if (!empty($_POST['skin'])) {
        $query = 'UPDATE ' . CONFIG_TABLE . 
                 ' SET value="' . $_POST['skin'] . '" 
                  WHERE param="jplayer_skin"';
        pwg_query($query);
        // keep this selected in the admin form 
        $skin = $_POST['skin'];
    }
    $autoplay = isset($_POST['autoplay']) ? "true" : "false";
    $query = 'UPDATE ' . CONFIG_TABLE .
             ' SET value="' . $autoplay . '" 
              WHERE param="jplayer_autoplay"';
    pwg_query($query);
    $poster = isset($_POST['poster']) ? "true" : "false";
    $query = 'UPDATE ' . CONFIG_TABLE .
             ' SET value="' . $poster . '" 
              WHERE param="jplayer_representative_as_poster"';
    pwg_query($query);
}

// 
$template->assign(array(
    'SELECTED_SKIN'   => $skin,
    'AVAILABLE_SKINS' => $available_skins,
    'AUTOPLAY'        => $autoplay,
    'POSTER'          => $poster,
));

// Add our template to the global template
$template->set_filenames(
  array(
    'plugin_admin_content' => dirname(__FILE__).'/admin.tpl'
  )         
);

// Assign the template contents to ADMIN_CONTENT
$template->assign_var_from_handle('ADMIN_CONTENT', 'plugin_admin_content');
?>
