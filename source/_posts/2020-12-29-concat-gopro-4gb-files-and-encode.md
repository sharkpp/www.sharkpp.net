---
layout: post
title: "GoPro HERO 6 で撮影した結果 4GB で分割されてしまった映像を繋げ Full HD H264 へエンコードする方法"
date: 2020-12-29 17:12
tags: [macOS, ffmpeg, h265, hevc, h264, exiftool, GoPro]
categories: [ブログ]

---

さてさて、超お久しぶりにブログを書いている sharkpp です。

半年以上更新が止まってしまいましたが、ぼちぼちと再開をさせたいなと思ってる次第...

とりあえず、今回は GoPro HERO 6 で撮影した結果 4GB で分割されてしまった映像を繋げ Full HD H264 へエンコードする方法を忘れないように残しておきたいと思います。

## 要約

分割された 4K 動画から、結合された Full HD 動画への変換（メタ情報を含む）は

1. `ls GX0[0-9]*.MP4 | while read L ; do echo file $L ; done > list.txt`
2. `ffmpeg -y -f concat -i list.txt -bsf:v h264_mp4toannexb -vcodec libx264 -vf scale=1920:-1 -r 29.97 -map 0:v -map 0:a -map 0:d -copy_unknown GX0Y0000.MP4`
3. `exiftool -tagsfromfile $(cat list.txt | cut -d " " -f 2 | tail -n 1) "-gps*" -unsafe GX0Y0000.MP4`

このような感じでコマンドを打てば変換できそう。

## はじめに

久しぶりに GoPro HERO 6 を引っ張り出してきて、よーし張り切って 4K 60fps で撮影しちゃうぞ！みたいなことをしちゃったわけです。

で、結果として...

```console
$ ls -lh
total 52606864
-rwxrwxrwx@ 1 user  staff   3.7G 12 13 12:17 GX012316.MP4
-rwxrwxrwx  1 user  staff   3.7G 12 13 12:24 GX022316.MP4
-rwxrwxrwx  1 user  staff   3.7G 12 13 12:31 GX032316.MP4
-rwxrwxrwx  1 user  staff   3.7G 12 13 12:38 GX042316.MP4
-rwxrwxrwx  1 user  staff   3.7G 12 13 12:45 GX052316.MP4
-rwxrwxrwx  1 user  staff   3.7G 12 13 12:52 GX062316.MP4
-rwxrwxrwx  1 user  staff   1.0G 12 13 12:54 GX072316.MP4
```

約 4GB に分割されたファイルができるわけです。

そして、手元には空き容量と性能が乏しいPCがあり、とてもそのまま再生できる感じではない、さてこれをどうやって素材として使おうか、と...

## 目標

目指すべき目標をまず設定します。

|項目|元素材|目標|
|-|-|-|
|ファイル|最大約 4GB に分割された複数のファイル|1 ファイル|
|コンテナ|MP4|変更なし|
|映像|H265 3840 x 2160 59.94 fps|H264 1920 x 1080 29.97 fps|
|音声|AAC (LC) 48000 Hz, stereo, 128 kb/s|変更なし|

あとは、埋め込まれているメタ情報もなるべくそのままにしたい。

## やり方

4 GB で分割されたファイルを単純に結合すると結合部分が無音になるという情報があったので色々試してみる。

とりあえず、空き容量も少ないので mp4box で２ファイルを結合してみる。

```console
$ mp4box
-bash: mp4box: command not found
```

...の前に mp4box がないので Homebrew でインストール

```console
$ brew install mp4box
```

で、改めて...

```console
$ mp4box -add GX010000.MP4 -cat GX020000.MP4 -new GX0X0000.MP4
$ ffmpeg -y -i GX0X0000.MP4 -ab 192 GX0X0000.mp3
```

そして ffmpeg でも

```console
$ echo file GX010000.MP4 >list.txt
$ echo file GX020000.MP4 >>list.txt
$ ffmpeg -f concat -i list.txt -c copy GX0Y0000.MP4
$ ffmpeg -y -i GX0Y0000.MP4 -ab 192 GX0Y0000.mp3
```

それぞれ結合した映像の音声部分を mp3 形式で抜き出し Audacity で波形を確認結果...

mp4box を使わず ffmpeg 単体でもとくに音声の途切れもなさそう、ということがわかった。

なので、

```console
$ ls GX0[0-9]*.MP4 | while read L ; do echo file $L ; done > list.txt
$ ffmpeg -y -f concat -i list.txt -bsf:v h264_mp4toannexb -vcodec libx264 -vf scale=1920:-1 -r 29.97 \
         -map 0:v -map 0:a -map 0:d -copy_unknown GX0Y0000.MP4
```

||速度｜45分の動画のエンコード時間|
|60 fps|約 0.150 倍|約5時間|
|30 fps|約 0.165 倍|約4時間30分|

あと、どうしてもGPSの情報がコピーできなかったので exiftool でコピーする

```console
$ exiftool -tagsfromfile $(cat list.txt | cut -d " " -f 2 | tail -n 1) "-gps*" -unsafe GX0Y0000.MP4
```

蛇足として [GoPro HERO7 で撮影した動画からGPS情報をgpxファイルとして抜き出す方法 – Bang's Tmp returned](https://code.g-nab.net/archives/73) にて知りましたが、 [GitHub - juanmcasillas/gopro2gpx: Parse the gpmd stream for GOPRO moov track (MP4) and extract the GPS info into a GPX (and kml) file.](https://github.com/juanmcasillas/gopro2gpx) なるツールで GoPro で撮影した動画からGPS情報を抜き出すことができるようですね。

# まとめ

1. `ls GX0[0-9]*.MP4 | while read L ; do echo file $L ; done > list.txt`
2. `ffmpeg -y -f concat -i list.txt -bsf:v h264_mp4toannexb -vcodec libx264 -vf scale=1920:-1 -r 29.97 -map 0:v -map 0:a -map 0:d -copy_unknown GX0Y0000.MP4`
3. `exiftool -tagsfromfile $(cat list.txt | cut -d " " -f 2 | tail -n 1) "-gps*" -unsafe GX0Y0000.MP4`

この手順で、 分割された 4K 動画から Full HD 動画へ含まれるメタ情報も含めいい感じにエンコードすることができました。

## 参考

* [Import and export of metadata](https://exiftool.org/forum/index.php?topic=1424.msg15307#msg15307)
* [Using ffmpeg to copy metadata from one file to another - Super User](https://superuser.com/questions/996223/using-ffmpeg-to-copy-metadata-from-one-file-to-another)
* [フレームレート及び画面サイズを指定する：tech.ckme.co.jp](http://tech.ckme.co.jp/ffmpeg_frate.shtml)
* [command line - Batch convert H.265 mkv to H.264 with ffmpeg to make files compatible for re-encoding - Ask Ubuntu](https://askubuntu.com/questions/707397/batch-convert-h-265-mkv-to-h-264-with-ffmpeg-to-make-files-compatible-for-re-enc)
* [【ffmpeg】動画の解像度を指定してリサイズ、アスペクト比を維持したまま解像度を変更する、回転する - Qiita](https://qiita.com/riversun/items/d09d8e596a20ec1798f3)
* [FFmpeg Formats Documentation](https://www.ffmpeg.org/ffmpeg-formats.html#Metadata-1)
* [exiftoolを使って画像のIPTC情報をcsvでまとめて設定する - Qiita](https://qiita.com/tzhaya/items/6b423872d2ab9f31bf30)
* [ExifTool FAQ](https://exiftool.org/faq.html)
