piwigo-jplayer
==============

jPlayer port for piwigo. Play your videos and audio tracks on your web gallery!

Piwigo-jplayer is a plugin for the [Piwigo](http://piwigo.org/) web gallery that allows you to render various video and audio files within your piwigo install.

See it in action [here] (http://dev.chezmatthi.eu/piwigo-jplayer/)

Installation
------------

This plugin needs to be uploaded in the ``your-gallery/plugins/`` dir.

* get it directly from the plugin section of the admin site or grab it from the [Piwigo website](http://piwigo.org/ext/extension_view.php?eid=594)

* download the archive from github (https://github.com/d-matt/piwigo-jplayer/downloads) 

        wget -O piwigo-jplayer.tar.gz https://github.com/d-matt/piwigo-jplayer/tarball/master

* or clone the project 

        git clone git://github.com/d-matt/piwigo-jplayer.git

Then, go to the admin site, in the plugin section and activate it.

Supported formats
-----------------

### Videos ###

* wevm
* ogv
* m4v
* flv

### Audios ###

* mp3
* ogg
* oga
* m4a
* webma
* fla
* wav


<u>Note</u> : for piwigo-jplayer to work with Firefox, you should also make sure that the webserver is sending the correct type for the given file.

Please read the documentation on jplayer website : http://jplayer.org/latest/developer-guide/

Usage
-----

Basically, medias will be added to your gallery just like standard pictures: 

* Uploads the videos in the `galleries` dir
* In piwigo < 2.4, the thumbnail is named `thumbnail/TN-base_name.jpg`
* In piwigo > 2.4, the thumbnail is named `pwg_representative/base_name.jpg`
* Finally use the sync button


Credit
------

* [jPlayer](http://jplayer.org/)
* [getid3](http://getid3.sourceforge.net/)

Changelog
---------

### Version 0.3 (2012/07/09)

- Add a tool to publish new versions
- Add a tool to convert thumbnails to representatives

### Version 0.2 (2012/07/08)

- Piwigo 2.4 compatibility
- Add a parameter to use representative image in the video player
- Add autoplay parameter

### Version 0.1 (2012/01/02)
	
- Initial release 

Licence
-------
The piwigo-jplayer plugin for Piwigo is free software:  you can redistribute it
and/or  modify  it under  the  terms  of the  GNU  General  Public License  as
published by the Free Software Foundation.

This program  is distributed in the hope  that it will be  useful, but WITHOUT
ANY WARRANTY; without even the  implied warranty of MERCHANTABILITY or FITNESS
FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

See <http://www.gnu.org/licenses/gpl.html>.
