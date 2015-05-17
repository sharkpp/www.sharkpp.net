---
title: "Safari 3とSafari 4をWindowsで共存させる方法"
tags: [Safari ブラウザ]
categories: [blog]

---

巷では、Safari 4<sup>BATA</sup>が公開されたことでお祭りムードになっているようでそれに便乗してみます。

MacOS X ではSafariを共存させる方法として[Multi-Safari][1]見たいなものがあります。

 [1]: http://michelf.com/projects/multi-safari/

また、IEもIETesterなどがあるのですがWindowsのSafariには無いようです。

でさくっと試してみたら多少おかしなところはありますが、ウェブページの見栄え確認ぐらいには使える方法を見つけたので書いてみます。

#### 動作画面

**Safari 3**

User-Agent:**Mozilla/5.0 (Windows; U; Windows NT 5.2; ja-JP) AppleWebKit/525.28 (KHTML, like Gecko) Version/3.2.2 Safari/525.28.1**

[![2009_0226_safari3_acid3][2]][3]

 [2]: /images/2009_0226_safari3_acid3_s.jpg
 [3]: /images/2009_0226_safari3_acid3.png

**Safari 4<sup>BATA</sup>**

User-Agent:**Mozilla/5.0 (Windows; U; Windows NT 5.2; ja-JP) AppleWebKit/528.16 (KHTML, like Gecko) Version/4.0 Safari/528.16**

[![2009_0226_safari4_acid3][4]][5]

 [4]: /images/2009_0226_safari4_acid3_s.jpg
 [5]: /images/2009_0226_safari4_acid3.png

#### そのまえに

<span class="warning">Safari 3をメインとして使用している人は環境が壊れる可能性があるので今回の手段は使用しないほうが良い思います。At your own riskってことでよろしくです。
</span>

#### 準備

方法は簡単です。

まず必要なものを準備

  * Safari 4<sup>BATA</sup>のインストーラー([Download Safari][6])
  * Safari 3のインストーラー([Safari 3.2.2 for Windows][7])

 [6]: http://www.apple.com/safari/download/
 [7]: http://support.apple.com/downloads/Safari_3_2_2_for_Windows

をそれぞれ用意します。

#### 手順

  1. 普通にSafari 4<sup>BATA</sup>をインストール
  2. インストール先のフォルダを開き中身を別のフォルダにコピー。例えば、C:\Program Files\SafariにインストールしたらC:\Program Files\Safari4に丸ごとコピー
  3. Safari 4<sup>BATA</sup>をアンインストール
  4. Safari 3をインストール、例えば、C:\Program Files\Safari4にインストール
  5. それぞれのEXEへのショートカットを作成

これで完了

あとは、作ったショートカットから起動すればOK

#### 注意点

  * Safari 3をメインとして使用している人は環境が壊れる可能性があるので今回の手段は使用しないほうが良い
  * Safari 3とSafari 4<sup>BATA</sup>のブックマークや履歴などは共有されているみたい
  * Safari 4<sup>BATA</sup>を起動するとブラウザ起動時に表示されるホームページの設定がSafari 3ともども書き変わる
  * Safari 3とSafari 4<sup>BATA</sup>とを同時には起動できない

あまり調べていないですがこんな感じでしょうか？

#### ？？？

しかし、安定版のダウンロードリンクがBETA版のダウンロードリンクよりも分かりにくいのは何か間違っている気がする...