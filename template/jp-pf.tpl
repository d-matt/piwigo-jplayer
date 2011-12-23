{html_head}
{combine_script id='jquery' path='themes/default/js/jquery.min.js'}
{combine_script id='jplayer' require='jquery' load='header' path="`$JPLAYER_PATH`/js/jquery.jplayer.min.js"}
{combine_css id="jp_pink_flag" path="`$JPLAYER_PATH`/skin/pink.flag/jplayer.pink.flag.css"}
{combine_css id="jp_common" path="`$JPLAYER_PATH`/skin/jp_common.css"}
{include file="`$JPLAYER_FULLPATH`/template/jplayer.tpl"}
</script>
{/html_head}
<div id="jp_container_1" class="jp-video jp-video-270p" style="width:{$WIDTH}; min-width:480px">
  <div class="jp-type-single">
    <div id="jquery_jplayer_1" class="jp-jplayer"></div>
    <div class="jp-gui">
      <div class="jp-video-play">
        <a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
      </div>
      <div class="jp-interface">
        <div class="jp-progress">
          <div class="jp-seek-bar">
            <div class="jp-play-bar"></div>
          </div>
        </div>
        <div class="jp-current-time"></div>
        <div class="jp-duration"></div>
        <div class="jp-controls-holder">
          <ul class="jp-controls">
            <li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
            <li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
            <li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
            <li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
            <li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
            <li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
          </ul>
          <div class="jp-volume-bar">
            <div class="jp-volume-bar-value"></div>
          </div>
          <ul class="jp-toggles">
            {if $IS_VIDEO}
            <li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="full screen">full screen</a></li>
            <li><a href="javascript:;" class="jp-restore-screen" tabindex="1" title="restore screen">restore screen</a></li>
            {/if}
            <li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
            <li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
          </ul>
        </div>
        <div class="jp-title">
          <ul>
            <li>{$current.TITLE}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="jp-no-solution">
      <span>Update Required</span>
      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
    </div>
  </div>
</div>
