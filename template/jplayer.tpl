<script type="text/javascript">
  {literal}
  //<![CDATA[
  $(document).ready(function() {
    $("#jquery_jplayer_1").jPlayer( {
      ready: function () {
        $(this).jPlayer("setMedia", {
          {/literal}{$TYPE}{literal}: {/literal}"{$JP_MEDIA_URL}"{literal},
        }).jPlayer({/literal}"{$AUTOPLAY}"{literal});
      },
      supplied: {/literal}"{$TYPE}"{literal},
      swfPath: {/literal}"{$JPLAYER_PATH}/js/"{literal},
      wmode: "window",
      size: {
        width: {/literal}"{$WIDTH}"{literal},
        height: {/literal}"{$HEIGHT}"{literal},
      }
    });
  });
  //]]>
{/literal}
</script>
