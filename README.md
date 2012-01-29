piwigo-jplayer
==============

jPlayer port for piwigo. Play your videos and audio tracks on your web gallery!

Piwigo-jplayer is a plugin for the [Piwigo](http://piwigo.org/) web gallery that allows you to render various video and audio files within your piwigo install.

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
Basically, medias will be inserted in a same way as standard pictures : 

* Uploads the videos in the `galleries` dir
* The thumbnail is formed as usual `thumbnail/TN-base_name.jpg`
* The HD can be inserted as usual as well in the `pwg_high`
* Finally use the sync button


Credit
------

* [jPlayer](http://jplayer.org/)
* [getid3](http://getid3.sourceforge.net/)

Changelog
---------

### Version 0.2 ()

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
