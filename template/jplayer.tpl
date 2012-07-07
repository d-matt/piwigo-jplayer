<script type="text/javascript">
  {literal}
  //<![CDATA[
  $(document).ready(function() {
    $("#jquery_jplayer_1").jPlayer( {
      ready: function () {
        $(this).jPlayer("setMedia", {
          {/literal}{$TYPE}{literal}: {/literal}"{$JP_MEDIA_URL}"{literal},
          {/literal}{if $JP_POSTER}{literal}
          poster: {/literal}"{$JP_POSTER}"{literal},
          {/literal}{/if}{literal}
        }).jPlayer({/literal}"{$AUTOPLAY}"{literal});
      },
      supplied: {/literal}"{$TYPE}"{literal},
      swfPath: {/literal}"{$JPLAYER_PATH}/js/"{literal},
      {/literal}{if $IS_VIDEO}{literal}
      size: {
        width: {/literal}"{$WIDTH}"{literal},
        height: {/literal}"{$HEIGHT}"{literal},
      }
      {/literal}{else}{literal}
      wmode: "window",
      {/literal}{/if}{literal}
    });
  });
  //]]>
{/literal}
</script>
