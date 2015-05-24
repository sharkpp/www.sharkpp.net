---
title: "バックアップファイルからSVNのダンプファイルへの変換スクリプト その２"
date: 2009-12-27 13:49:00
tags: [php, Subversion]
categories: [ブログ]

---

[フォルダまるごとのバックアップからSubversionのリポジトリを作るツールを作ってみた。][1]の続き。

 [1]: /blog/2009/12/13/backup-to-svn-dump-convert-script.html

trunkフォルダの自動生成とチープコピー機能をつけた。

さらに、マージしてみたらSvnDumpToolではダンプ中に同じパスの追加などをフィルタしてくれなくてload時にエラーになってしまうのでそういう操作のフィルタスクリプトも作った。

[backup2svn-dump_20091227.zip][2]

 [2]: /files/backup2svn-dump_20091227.zip

これもダウンロード先は取り敢えずで、どこに置こうか考え中。
