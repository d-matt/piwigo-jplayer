<!-- Show the title of the plugin -->
<div class="titlePage">
  <h2>jplayer</h2>
</div>

<form method="post" action="" class="properties">
  <fieldset>
    <legend>jplayer preferences</legend>
    <ul>
      <li>
        <label>Skin: </label>
        <select name="skin">
          {html_options options=$AVAILABLE_SKINS selected=$SELECTED_SKIN}
        </select>
      </li>
      <li>
        <label>Autoplay:
          <input type="checkbox" name="autoplay" id="autoplay" value="true" {if $AUTOPLAY eq 'true'}checked="checked"{/if}/> 
        </label>  
      </li>
    </ul>
    <input class="submit" type="submit" value="{'Submit'|@translate}" name="submit"/>
  </fieldset>
</form>
