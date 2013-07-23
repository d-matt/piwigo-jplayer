<?php 
/*
Version: 0.4
Plugin Name: jplayer
Plugin URI: http://piwigo.org/ext/extension_view.php?eid=594
Author: d-matt
Description: jplayer integration for piwigo
Author URI: https://github.com/d-matt/piwigo-jplayer
*/

// Chech whether we are indeed included by Piwigo.
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

// Define the path to our plugin.
define('JPLAYER_PATH', PHPWG_PLUGINS_PATH . basename(dirname(__FILE__)).'/');

global $conf;

// Register the allowed extentions to the global conf in order
// to sync them with other contents
$jp_extensions = array(
    'mp3', 
    'm4a', 
    'ogg', 
    'oga', 
    'webma', 
    'wav', 
    'fla',
    'mp4', 
    'm4v', 
    'ogv', 
    'webm', 
    'webmv',
    'flv',
);
$conf['file_ext'] = array_merge($conf['file_ext'], $jp_extensions);

// Hook on to an event to display videos as standard images
add_event_handler('render_element_content', 'render_media', 40, 2 );

// Hook to display a fallback thumbnail if not defined
// piwigo < 2.4  
add_event_handler('get_thumbnail_location', 'get_mimetype_icon', 60, 2);
// piwigo > 2.4
add_event_handler('get_mimetype_location', 'get_mimetype_icon', 60, 2);

// Hook on to an event to filter videos that may appear twice (video.webm and video.m4v are the same video)
add_event_handler('loc_end_index_thumbnails', 'filter_duplicates', 40, 2 );

// Hook to a admin config page
add_event_handler('get_admin_plugin_menu_links', 'jplayer_admin_menu' );

function jplayer_admin_menu($menu)
{
  array_push($menu,
      array(
        'NAME' => 'jplayer',
        'URL'  => get_admin_plugin_menu_link(dirname(__FILE__).'/admin.php')
      )
    );
  return $menu;
}

function render_media($content, $picture)
{
    global $template, $picture, $page, $conf, $user, $refresh;

    // do nothing if the current picture is actually an image !
    if ( // piwigo < 2.4
         @$picture['current']['is_picture'] ||
         // piwigo > 2.4 
         ( array_key_exists('src_image', @$picture['current']) 
           && @$picture['current']['src_image']->is_original() )
       ) {
        return $content;
    }
    // In case, the we handle a large video, we define a MAX_WIDTH
    // variable to limit the display size.
    if (isset($user['maxwidth']) and $user['maxwidth']!='') {
        $MAX_WIDTH = $user['maxwidth'];
    }
    else {
        $MAX_WIDTH = '720';
    }

    // Get video infos with getID3 lib
    require_once(dirname(__FILE__) . '/include/getid3/getid3.php');
    $getID3 = new getID3;
    $fileinfo = $getID3->analyze($picture['current']['path']);

    $extension = strtolower(get_extension($picture['current']['path']));
    $basename = strtolower(get_filename_wo_extension($picture['current']['path']));
    $is_video = False;


    if(isset($fileinfo['video'])) {
        // -- video file --
        $is_video = True;
        if ($extension == 'webm') $extension = 'webmv'; 
        if ($extension == 'mp4')  $extension = 'm4v';

        // guess resolution
        if (isset($fileinfo['video']['resolution_x']) ) {
            $width  = $fileinfo['video']['resolution_x'];
        }
        if (isset($fileinfo['video']['resolution_y']) ) {
            $height = $fileinfo['video']['resolution_y'];
        }
        if ( ! isset($width) || ! isset($height)) {
            // If guess was unsuccessful, fallback to default 16/9 resolution
            // This is the case for ogv video for example. 
            $width = $MAX_WIDTH;
            $height = intval( 9 * ($width / 16 ));
        } 
    }
    else {
        // -- audio only file --
        if ($extension == 'webm') $extension = 'webma';
        if ($extension == 'mp4')  $extension = 'm4a';
        if ($extension == 'ogg')  $extension = 'oga';
        $width  = '0';
        $height = '0';
    }

    // Resize if video is too large
    if ( $width > $MAX_WIDTH ) {
        $height = intval($height * ($MAX_WIDTH / $width ));
        $width  = $MAX_WIDTH;
    }

    // Slideshow : The video needs to be launch automatically in
    // slideshow mode. The refresh of the page is set to the
    // duration of the video.
    if (isset($conf['jplayer_autoplay']) && $conf['jplayer_autoplay']) {
        $AUTOPLAY =  'play';
    }
    else {
        $AUTOPLAY = '';
    }
    if ( $page['slideshow'] ) {
        $refresh = $fileinfo['playtime_seconds'];
        $AUTOPLAY = 'play';
    }

    // Picture representative to be used as poster image in the player 
    $poster_url = NULL;
    if ( isset($picture['current']['src_image'])
         && isset($conf['jplayer_representative_as_poster']) 
         && $conf['jplayer_representative_as_poster'] ) {
        $poster_url = $picture['current']['src_image']->get_url();
        $poster_url = embellish_url(get_gallery_home_url() . $poster_url);
        if ( strpos($poster_url, "mimetype") ) {
            // Ignore mimetype representatives because they're too small
            $poster_url = NULL;
        }
    }

    // Load parameter, fallback to blue monday if unset 
    $skin = isset($conf['jplayer_skin']) ? $conf['jplayer_skin'] : 'bm';

    // Select the template
    $template->set_filenames(
        array('jp_content' => dirname(__FILE__)."/template/jp-". $skin .".tpl")
    );

    $alternate_media_url = '';
    $alternate_type = '';

    if ($extension == 'webmv') {
        if(file_exists($basename . '.m4v')) {
            $alternate_media_url = str_replace('webm', 'm4v', $picture['current']['element_url']);
            $alternate_type = 'm4v';
        }
    } else if ($extension == 'm4v') {
        if(file_exists($basename . '.webm')) {
            $alternate_media_url = str_replace('m4v', 'webm', $picture['current']['element_url']);
            $alternate_type = 'webmv';
        }
    }

    // Assign the template variables
    // We use here the piwigo's get_gallery_home_url function to build 
    // the full URL as suggested by jplayer for flash fallback compatibility
    $template->assign(
        array(
            'JP_MEDIA_URL'     => embellish_url(get_gallery_home_url() . $picture['current']['element_url']),
            'ALT_JP_MEDIA_URL' => embellish_url(get_gallery_home_url() . $alternate_media_url),
            'JP_POSTER'        => $poster_url,
            'JPLAYER_PATH'     => JPLAYER_PATH,
            'JPLAYER_FULLPATH' => realpath(dirname(__FILE__)),
            'WIDTH'            => $width . 'px',
            'HEIGHT'           => $height . 'px',
            'TYPE'             => $extension,
            'ALT_TYPE'         => $alternate_type,
            'AUTOPLAY'         => $AUTOPLAY,
            'IS_VIDEO'         => $is_video,
        )
    );

    // Return the rendered html
    $jp_content = $template->parse('jp_content', true);
    return $jp_content;
}

function filter_duplicates($tpl_thumbnails_var) {
    $GLOBALS['video_unique_names'] = array();

    function unique($var) {
        if(in_array($var['name'],$GLOBALS['video_unique_names'])) {
            return false;
        } else {
            if(get_extension($var['file']) == "m4v" || get_extension($var['file']) == "webm" ) {
                array_push($GLOBALS['video_unique_names'],$var['name']);
            }
            return true;
        }
    }
    $filtered_array = array_filter($tpl_thumbnails_var,"unique");
    $GLOBALS['video_unique_names'] = null;
    return $filtered_array;
}

function get_mimetype_icon ($location, $element_info)
{
    if ( is_array($element_info) ) {
        // Piwigo < 2.4
        if ( empty( $element_info['representative_ext'] )  ) {
            $extension = strtolower(get_extension($element_info['path']));
            $location= 'plugins/'
                       . basename(dirname(__FILE__))
                       . '/mimetypes/' . $extension . '.png';
       }
    } 
    else {
        // Piwigo > 2.4
        $location= 'plugins/'
                   . basename(dirname(__FILE__))
                   . '/mimetypes/' . $element_info . '.png';
    }

    return $location;
}

?>
