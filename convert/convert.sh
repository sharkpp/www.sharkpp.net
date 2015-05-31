#!/bin/bash

cp_statics () {
# $1 : target name
# $2 : permalink
  TARGETNAME=$(ls markdown/_statics/*-${1}.*|head -n 1)
  PERMALINK=$2\\/index.html
  DESTPATH=../source/_statics/$(echo ${2}|sed -e "s/\//-/g").md

  if [ "" == "$TARGETNAME" ] ; then
    exit
  fi

  cat ${TARGETNAME} \
    | sed -e "s/^date: /permalink: ${PERMALINK}$(printf '\\\012d')ate: /g" \
    > $DESTPATH
  rm -f ../source/_posts/$(basename ${TARGETNAME})
}

remove_layout_option () {
# $1 file name
  cat $1 \
    | grep -vE '^layout: .*' \
    > $1~
  mv $1~ $1
}

if [ ! -e "vendor/pixel418/markdownify/src/Markdownify/Converter.php" ];
then
	php ../composer.phar install
fi

rm -rf markdown/*

php convert.php >/dev/null

for I in $( find markdown/blog -name \*\.md ) ;
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
for I in $( find markdown/blog -name \*\.md ) ;
do
	DIR_NAME=$(dirname $I)/$(basename $I .md)
	if [ -e $DIR_NAME ] ;
	then
		rm -f $I >/dev/null 2>&1
	fi
done
find markdown/blog -type d -empty -delete

cp -p markdown/htaccess.twig ../source/
find ../source/_posts -not -name 2015-\* -or -name 2015-0[1234]\* -exec rm -f {} \;
cp -p markdown/blog/*.md ../source/_posts/
cp -p markdown/_statics/*.md ../source/_posts/
#for I in markdown/blog/*.md markdown/_statics/*.md ; do iconv -f UTF8-MAC -t UTF-8 -c $I > ../source/_posts/$(basename $I) ; done

cp_statics about about

rm -f ../source/_posts/1970-01-01-*
for I in $(find ../source/_posts/ -type f) ; do remove_layout_option $I ; done

find ../source/images -maxdepth 1 -name \*.png -delete -or -name \*.jpg -delete -or -name \*.gif -delete
cp -pf markdown/images/* ../source/images/

find ../source/graffiti -type f -maxdepth 1 -delete
mkdir -p ../source/graffiti
for I in $(find html/gallery/scenery -name \*.jpg -and -not -name \*s.jpg) ; do cp -pf $I ../source/graffiti/scenery_$(basename $I) ; done
for I in $(find html/gallery/graffiti -type f -not -name \*128.png) ; do cp -pf $I ../source/graffiti/$(basename $I); done
mkdir -p ../source/graffiti/t
#↓毎回内容が変わるっポイ
#for I in $(ls ./../source/graffiti/{*.png,*.jpg}) ; do convert -resize 200x $I $(dirname $I)/t/$(basename $(basename $(basename $(basename $I .jpg) _512x512.png) _1024x1024.png) .png).png ; done

