#!/bin/bash

if [ ! -e "$(dirname $0)/vendor/pixel418/markdownify/src/Markdownify/Converter.php" ];
then
	php ../composer.phar install
fi

rm -rf $(dirname $0)/markdown/*

php convert.php >/dev/null

for I in $( find $(dirname $0)/markdown/blog -name \*\.md ) ;
do
	DIR_NAME=$(dirname $I)/$(basename $I .md)
	if [ ! -e $DIR_NAME ] ;
	then
		DEST=$(echo $I | sed -E 's=^(.+/)([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+)$=\1\2-\3-\4-\5=g')
		if [ "$MATCH" != "$I" ] ;
		then
			mkdir -p $( dirname $DEST )
			mv $I $DEST
		fi
	fi
done
for I in $( find $(dirname $0)/markdown/blog -name \*\.md ) ;
do
	DIR_NAME=$(dirname $I)/$(basename $I .md)
	if [ -e $DIR_NAME ] ;
	then
		rm -f $I >/dev/null 2>&1
	fi
done
find $(dirname $0)/markdown/blog -type d -empty -delete

rm -f $(dirname $0)../source/_posts/*.md
cp -p $(dirname $0)/markdown/blog/*.md $(dirname $0)/../source/_posts/

cp -pf $(dirname $0)/markdown/about.md $(dirname $0)/../source/

find $(dirname $0)/../source/images -maxdepth 1 -name \*.png -delete -or -name \*.jpg -delete -or -name \*.gif -delete
cp -pf $(dirname $0)/markdown/images/* $(dirname $0)/../source/images/

rm -rf $(dirname $0)/../source/graffiti/*
mkdir -p $(dirname $0)/../source/graffiti
for I in $(find $(dirname $0)/html/gallery/scenery -name \*.jpg -and -not -name \*s.jpg) ; do cp -pf $I $(dirname $0)/../source/graffiti/scenery_$(basename $I) ; done
for I in $(find $(dirname $0)/html/gallery/graffiti -type f -not -name \*128.png) ; do cp -pf $I $(dirname $0)/../source/graffiti/$(basename $I); done
mkdir -p $(dirname $0)/../source/graffiti/t
#for I in $(ls $(dirname $0)/../source/graffiti/*.*) ; do convert -resize 320x -colors 65 -quality 100 -verbose $I $(dirname $I)/t/$(basename $(basename $I .jpg) .png).png ; done
for I in $(ls ./../source/graffiti/{*.png,*.jpg}) ; do convert -resize 200x $I $(dirname $I)/t/$(basename $(basename $(basename $(basename $I .jpg) _512x512.png) _1024x1024.png) .png).png ; done

