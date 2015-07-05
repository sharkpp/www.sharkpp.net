---
title: "PHP で日本語を含む HTML から Markdown に変換する方法"
date: 2015-07-05 12:00
tags: [雑記, php, Markdown, Composer]
categories: [ブログ]

---

ホムペを再構築するにあたり[Sculpin でホムペを再構築したときのメモ](/blog/2015/06/28/site-reboot-by-sculpin.html)でもサラッと書いたけど“.html をスクリプトで .md に変換＆リンクを再構成”というのが割と厄介だった。

PHP で Markdown 記法から HTML への変換を行うライブラリ/パッケージは多数見つかるが、その逆の HTML から Markdown 記法への変換を行う物は数えるほどしかありませんでした。

ざっと探した感じでは

* [nickcernis/html-to-markdown](https://github.com/nickcernis/html-to-markdown)
* [Elephant418/Markdownify](https://github.com/Elephant418/Markdownify)

ぐらいのようです。

結局、１番目の `html-to-markdown` は思ったように動いてくれなかったので、２つ目の `Markdownify` を使うようにしたのですがこちらも癖があって意図通りに動かすのは大変でした。

## 準備

とりあえず、ライブラリを使えるように準備をします。

**composer.json**

```json
{
	"require": {
		"pixel418/markdownify": "2.1.*"
	}
}
```

と、先の内容で Composer の設定ファイルを作り、

```bash
$ php -r "readfile('https://getcomposer.org/installer');" | php
$ php composer.phar install
```

Composer のインストール＆ライブラリのインストール。

コレだけで

```php
<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

```

とすると使えるようになります。

`Composer` 便利！

## 実際に使ってみる

```php
<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

$html=<<<'EOD'
<h1>てすとヘッダレベル１</h1>
<p>ぱらぐらふ1234</p>
<p>ABCDE色々いろいろ</p>
EOD;

$md = new Markdownify\Converter();
$markdown = $md->parseString($html . PHP_EOL);
unset($md);

echo $markdown . PHP_EOL;
```

こんな感じの内容でテストしてみましょう。

```markdown
# てすとヘッダレベル１

ぱらぐらふ1234

ABCDE色? いろいろ
```

とりあえず変換できて、、い、、る？

`ABCDE色々いろいろ` が `ABCDE色? いろいろ` と文字化けてしまっています。

今回、ここが手子摺ったっ部分です。

## Markdonify の使い方

簡単な使い方

```php
    $md = new Markdownify\Converter(/* パラメータ */);
    $markdown = $md->parseString($html . PHP_EOL);
    unset($md);
```

たったコレだけです！

### パラメータ

`Markdownify\Converter` クラスのコンストラクタで `Markdownify\Converter($linkPosition = self::LINK_AFTER_CONTENT, $bodyWidth = MDFY_BODYWIDTH, $keepHTML = MDFY_KEEPHTML)` のようにパラメータを与えられるようになっています。

| 引数名 | デフォルト値 |  |
|-------|------------|--|
| `$linkPosition` | `LINK_AFTER_CONTENT` | リンクの位置を定義。<br/>`Markdownify\Converter::LINK_AFTER_CONTENT` の場合は末尾にまとめる。<br/>`Markdownify\Converter::LINK_AFTER_PARAGRAPH` の場合は段落ごとにまとめる。<br/>`Markdownify\Converter::LINK_IN_PARAGRAPH` の場合はその場で定義。|
| `$bodyWidth` | `false` | 出力を所定の幅で折り返すかどうか。 `false` もしくは 26 以上の値。 |
| `$keepHTML` | `true` | markdown へ変換できない HTMLを維持するか、それを破棄するかどうか。 |

### $linkPosition パラメータ

リンクの位置を定義するパラメータです。

共通のコードをベースにパラメータを変えて結果を比較してみます。

```php
<?php
require_once(dirname(__FILE__) . '/vendor/autoload.php');

$html=<<<'EOD'
<h1>てすとヘッダレベル１</h1>
<p>ぱらぐらふ<a href="http://example.net/~hoge/">xxxx</a>1234</p>
<p>ABCDE<a href="http://example.net/~fuga/">aaaa</a>いろいろ</p>
<p>いろいろABCDE</p>
<h2>てすとヘッダレベル２</h2>
<p>パラグラフ1234</p>
<p>いろいろ<a href="http://example.net/~foo/">bbbb</a>ABCDE</p>
<h2>てすとヘッダレベル２</h2>
<p>いろいろABCDE</p>
EOD;

$md = new Markdownify\Converter(/* $linkPosition パラメータ */);
echo $md->parseString($html).PHP_EOL;
```

このコードの `/* $linkPosition パラメータ */` の部分を `Markdownify\Converter::LINK_AFTER_CONTENT` や `Markdownify\Converter::LINK_AFTER_PARAGRAPH` に変えた結果を乗せます。

#### LINK_AFTER_CONTENT

の結果は

```markdown
# てすとヘッダレベル１

ぱらぐらふ[xxxx][1]＆[xxx2][2]1234

ABCDE[aaaa][3]いろいろ

いろいろABCDE

## てすとヘッダレベル２

パラグラフ1234

いろいろ[bbbb][4]ABCDE

## てすとヘッダレベル２

いろいろABCDE

 [1]: http://example.net/~hoge/
 [2]: http://example.net/~hoge2/
 [3]: http://example.net/~fuga/
 [4]: http://example.net/~foo/
```

のように、末尾にリンクがまとめて出力されます。

#### LINK_AFTER_PARAGRAPH

の結果は

```markdown
# てすとヘッダレベル１

ぱらぐらふ[xxxx][1]＆[xxx2][2]1234

 [1]: http://example.net/~hoge/
 [2]: http://example.net/~hoge2/

ABCDE[aaaa][3]いろいろ

 [3]: http://example.net/~fuga/

いろいろABCDE

## てすとヘッダレベル２

パラグラフ1234

いろいろ[bbbb][4]ABCDE

 [4]: http://example.net/~foo/

## てすとヘッダレベル２

いろいろABCDE
```

のように、段落ごとににリンクがまとめて出力されます。

#### LINK_IN_PARAGRAPH

の結果は

```markdown
# てすとヘッダレベル１

ぱらぐらふ[xxxx](http://example.net/~hoge/)＆[xxx2](http://example.net/~hoge2/)1234

ABCDE[aaaa](http://example.net/~fuga/)いろいろ

いろいろABCDE

## てすとヘッダレベル２

パラグラフ1234

いろいろ[bbbb](http://example.net/~foo/)ABCDE

## てすとヘッダレベル２

いろいろABCDE
```

のように、リンクはその場で出力されます。

手で記述する場合に近いと思います。

### $bodyWidth

出力を所定の幅で折り返すかどうかを指定するパラメータです。
ソースを確認すると `false` もしくは 26 以上の値が有効なようです。

また、日本語の文字列は容易に文字化けます。

```php
<?php
require_once(dirname(__FILE__) . '/vendor/autoload.php');

$html=<<<'EOD'
<p>government of the people, by the people, for the people</p>
EOD;

$md = new Markdownify\Converter(Markdownify\Converter::LINK_AFTER_CONTENT, false);
echo $md->parseString($html).PHP_EOL;
```

だと、

```markdown
# government of the people, by the people, for the people

government of the people, by the people, for the people
```

こうなりますが、 30 を指定すると

```php
# government of the people, by
the people, for the people

government of the people, by
the people, for the people
```

このようになります。

、、、長いヘッダも折り返されてしまうのでちょっと困りますね。

あまりにも長い内容が無い限り、このパラメータは `false` で問題ないと思います。

### $keepHTML

markdown に変換できないタグを残す(`true`)か残さない(`false`)かを指定するパラメータです。

```php
<?php
require_once(dirname(__FILE__) . '/vendor/autoload.php');

$html=<<<'EOD'
<h1>ほげ</h1>
<p>ふがふがふが <table><tr><td>a</td><td>b</td></tr></table> </p>
EOD;

$md = new Markdownify\Converter(Markdownify\Converter::LINK_AFTER_CONTENT, false, true);
echo $md->parseString($html).PHP_EOL;
```

この結果

```markdown
# ほげ

ふがふがふが 

<table>
  <tr>
    <td>
      a
    </td>
    
    <td>
      b
    </td>
  </tr>
</table>
```

となりますが、`false` を指定すると

```markdown
# ほげ

ふがふがふが 

a

b
```

こうなります。

中身のコンテンツはそのまま残るので`table`タグ等は意図せぬ結果になってしまうかもしれません。

## Markdonify を使うときの注意点

* そのまま使うと日本語文字が化ける場合がある
    解決方法は次の項で
* `parseString` を２回以上呼び出すと結果がおかしくなる
    毎回 `unset` することで解決

## 日本語文の文字化けの解決策

いろいろ試行錯誤はすっ飛ばしますが解決策はこれです。

```php
<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

function text2entities($text)
{
  return preg_replace_callback('/./u', function($m){
        $s = $m[0];
        $len = strlen($s);
        switch ($len) {
        case 1: return $s;
        case 2: return '&#'.(((ord($s[0])&0x1F)<<6)|(ord($s[1])&0x3F)).';';
        case 3: return '&#'.(((ord($s[0])&0xF)<<12)|((ord($s[1])&0x3F)<<6)|(ord($s[2])&0x3F)).';';
        case 4: return '&#'.(((ord($s[0])&0x7)<<18)|((ord($s[1])&0x3F)<<12)|((ord($s[2])&0x3F)<<6)
                             |(ord($s[3])&0x3F)).';';
        case 5: return '&#'.(((ord($s[0])&0x3)<<24)|((ord($s[1])&0x3F)<<18)|((ord($s[2])&0x3F)<<12)
                            |((ord($s[3])&0x3F)<<6)|(ord($s[4])&0x3F)).';';
        case 6: return '&#'.(((ord($s[0])&0x1)<<30)|((ord($s[1])&0x3F)<<24)|((ord($s[2])&0x3F)<<18)
                            |((ord($s[3])&0x3F)<<12)|((ord($s[4])&0x3F)<<6)|(ord($s[5])&0x3F)).';';
        }
        return $s;
      }, $text);
}

function entities2text($text)
{
  return
    preg_replace_callback('/&#([0-9]+);/u', function($m){
        $u = intval($m[1]);
             if (0x00000000 <= $u && $u <= 0x0000007F) { return chr($u); }
        else if (0x00000080 <= $u && $u <= 0x000007FF) { return chr(0xC0|($u>>6)).chr(0x80|($u&0x3F)); }
        else if (0x00000800 <= $u && $u <= 0x0000FFFF)
             { return chr(0xE0|($u>>12)).chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
        else if (0x00010000 <= $u && $u <= 0x001FFFFF)
             { return chr(0xF0|($u>>18)).chr(0x80|(($u>>12)&0x3F)).chr(0x80|(($u>>6)&0x3F))
                     .chr(0x80|($u&0x3F)); }
        else if (0x00200000 <= $u && $u <= 0x03FFFFFF)
             { return chr(0xF8|($u>>24)).chr(0x80|(($u>>18)&0x3F)).chr(0x80|(($u>>12)&0x3F))
                     .chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
        else if (0x04000000 <= $u && $u <= 0x04000000)
             { return chr(0xFC|($u>>30)).chr(0x80|(($u>>24)&0x3F)).chr(0x80|(($u>>18)&0x3F))
                     .chr(0x80|(($u>>12)&0x3F)).chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
        return $s;
      }, $text);
}

$html=<<<'EOD'
<h1>てすとヘッダレベル１</h1>
<p>ぱらぐらふ1234<p/>
<p>ABCDE色々いろいろ<p/>
EOD;

$md = new Markdownify\Converter();
$markdown = entities2text( $md->parseString( text2entities( $html ) . PHP_EOL) );
unset($md);


echo $markdown . PHP_EOL;
```

結局のところ、 `々` などの文字を `&#12293;` のような数値文字参照に一旦変換し、 Makrdown に変換後にもとに戻すようにしました。

おそらくは、ライブラリの中の文字読み取り処理が ASCII 文字のみ処理することを前提として組んであるのでうまく行かないのではないかと予想できるのですが、変換を間に挟むことでとりあえずうまく動いてしまったので深くは辿ってはいません。

## まとめ

とりあえず、まとめとして、 php を使い日本語を含む HTML を Markdown に変換するには、数値文字参照に変換した後 [Markdownify](https://github.com/Elephant418/Markdownify) を使い、元に戻すことで出来る！

## 参考

* [Introduction - Composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx)
* [文字参照 - Wikipedia](https://ja.wikipedia.org/wiki/%E6%96%87%E5%AD%97%E5%8F%82%E7%85%A7)
* [Elephant418/Markdownify](https://github.com/Elephant418/Markdownify)

