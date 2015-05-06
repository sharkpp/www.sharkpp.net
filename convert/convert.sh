#!/bin/bash

if [ ! -e "$(dirname $0)/composer.phar" ];
then
	php -r "readfile('https://getcomposer.org/installer');" | php
fi

if [ ! -e "$(dirname $0)/vendor/pixel418/markdownify/src/Markdownify/Converter.php" ];
then
	php composer.phar install
fi

rm -rf $(dirname $0)/markdown/*

php convert.php >/dev/null

for I in $( find $(dirname $0)/markdown -name *\.md ) ;
do
	DIR_NAME=$(dirname $I)/$(basename $I .md)
	if [ -e $DIR_NAME ] ;
	then
		echo $I >/dev/null
	fi
done

for I in $( find $(dirname $0)/markdown/blog -name *\.md ) ;
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
for I in $( find $(dirname $0)/markdown/blog -name *\.md ) ;
do
	DIR_NAME=$(dirname $I)/$(basename $I .md)
	if [ -e $DIR_NAME ] ;
	then
		rm -f $I >/dev/null 2>&1
	fi
done
find $(dirname $0)/markdown/blog -type d -empty -delete
