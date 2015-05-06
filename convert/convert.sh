#!/bin/bash

if [ ! -e "$(dirname $0)/composer.phar" ];
then
	php -r "readfile('https://getcomposer.org/installer');" | php
fi

if [ ! -e "$(dirname $0)/vendor/pixel418/markdownify/src/Markdownify/Converter.php" ];
then
	php composer.phar install
fi

php convert.php > /dev/null

for I in $( find $(dirname $0)/markdown -name *\.md ) ;
do
	DIR_NAME=$(dirname $I)/$(basename $I .md)
	if [ -e $DIR_NAME ] ;
	then
		echo $I
	fi
done
