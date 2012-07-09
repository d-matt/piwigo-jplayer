#!/bin/bash
# Publish a new version of the piwigo -jplayer plugin. 
#
# Usage 
# -----
#
# In the piwigo-jplayer plugin's dir, do : 
#     ./tools/new_version.sh TAG
# where TAG is the version to be


if [ $# -eq 0 ]; then
echo "Usage: $0 version"
    exit 1
fi

VERSION="$1"

#Check Changelog
#Ajout de la version 
sed -i "s/Version: .*/Version: $VERSION/" main.inc.php
git commit -m "new version $VERSION" main.inc.php
echo "New tag for version $VERSION"
git tag -a $VERSION -m "version $VERSION"

echo "Pushing to github"
git push
git push --tags

git archive --format=zip --prefix=piwigo-jplayer/ $VERSION > /tmp/piwigo-jplayer-$VERSION.zip
#removing extra files from the package
zip /tmp/piwigo-jplayer-$VERSION.zip -d piwigo-jplayer/tools/new_version.sh
echo "zip archive available: /tmp/piwigo-jplayer-$VERSION.zip"

