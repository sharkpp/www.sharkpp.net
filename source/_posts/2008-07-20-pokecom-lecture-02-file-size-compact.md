---
title: "C言語講座 第二回 ファイルサイズの縮小"
date: 2008-07-20 23:36:00
tags: [ポケコン]
categories: [ポケコン, ポケコン講座]
redirect:
    - /pokecom/lecture/02_file_size_compact.html
---

## 始めに

<!-- 20050206 -->

第二回のＣ言語 講座は、ファイルサイズの縮小を扱うことにします。 

ポケコンでＣ言語のプログラムを作成するメリットは、「BASICプログラムよりも実行速度が速い」ことが挙げられます。 当然ですが、マシン語には実行速度はかないません(プログラム言語の中では最速です)。<span>←当たり前だ</span>
	  
ただ、Ｃ言語でプログラムを作ったことがある人は、分かると思いますが、BASICに比べてファイルサイズが大きすぎるのです。

## 其の壱

まず、以下のソースを見てください。 

<pre>void main(void)
{
int c;
while(1) {
c = getch();
printf("KEY = %c[%02X] \n", c, c);
}
}
</pre>

プログラム的には、キーを取得し、その値をキャラクタと16進のキャラクタコードを表示するだけのプログラムです。 <!-- まあだいたい、基本的にはこんな感じですね(異論があるかもしれませんが)。 -->

まず、基本的に省略可能な部分から省略していきます。 

  1. void を省略
  2. 見やすいように入れてある空白・改行を削除
  3. 大カッコ( { )を移動
  4. while(1) を for(;;) に(動作結果が同じなので)

<pre>main(){
int c;
for(;;){
c=getch();
printf("KEY = %c[%02X] \n",c,c);
}}
</pre>

でこんな感じです。
	  
これで、だいたい 126byte → 77byte ぐらいです。
	  
ずいぶん見にくくなりました。
	  
さらに、一行にまとめると、 

<pre>main(){int c;for(;;){c=getch();printf("KEY = %c[%02X] \n",c,c);}}
</pre>

結果、126byte から 59byte減って、67byte になりました。
	  
が、エーと、ものすごく見にくいです。
	  
<span>(そのぐらいは、我慢してください...)
</span>

## 其の弐

また、文字の表示位置の変更のために `gotoxy()` などを大量に使っている時に効果的なのが、 `#define` です。
	  
`gotoxy()` を例に、簡単に計算方法を書いてみます。 

<pre>main(){
gotoxy(8,2);putchar(43);gotoxy(3,2);putchar(104);
gotoxy(6,2);putchar(107);gotoxy(4,2);putchar(97);
gotoxy(5,2);putchar(114);gotoxy(7,2);putchar(43);
gotoxy(9,2);putchar(33);gotoxy(2,2);putchar(83);
}
</pre>

上記のプログラムを下のように変更すると 

<pre>#define gxy gotoxy
main(){
gxy(8,2);putchar(43);gxy(3,2);putchar(104);
gxy(6,2);putchar(107);gxy(4,2);putchar(97);
gxy(5,2);putchar(114);gxy(7,2);putchar(43);
gxy(9,2);putchar(33);gxy(2,2);putchar(83);
}
</pre>

で、実際の計算は、`8 × (6 - 3) - 18 - 4 = 2` です。 

だだし、
	  
`&nbsp;8 =` 元の名称の数 → `"gotoxy"` の数
	  
`&nbsp;6 =` 元の名称の文字数
	  
`&nbsp;3 =` 新名称の文字数 → `"gxy"`
	  
`18 =` 追加した行の文字数 → `"#define gxy gotoxy"`
	  
`&nbsp;4 =` 行番号＋改行 

**計算結果の値が、＋の値になったら、減らすことが出来るということです。**
	  
ただし、新名称は、どんな名前でもいいのですが、<span>くれぐれも変数名と重ならないように</span>してください。 

ファイルサイズの縮小は、アイデア次第？でかなり削れます<span>(その分、見にくいですが)</span>。
	  
皆さんも頑張ってください。

## 最後に

<!-- 20050206 -->

最後に、この講座は乗せるかかどうか迷ったんですが <span>(プログラミングスタイルにかかわるので)</span>、 まあ、ヘ～、てな具合に見てくれればいいかなという事を付け足しておきます。
	  
単純に書くことが無いだけだったりして。

## 履歴

2004/03/02
: 公開

2005/02/06
: 構成変更



<div class="siblings_navigation"><a href="/blog/2008/07/20/pokecom-lecture-01-key-input.html" title="C言語講座 第一回 キー入力" >前</a> | C言語講座 第二回 ファイルサイズの縮小 | <a href="/blog/2008/07/20/pokecom-lecture-03-large-size-program-run.html" title="C言語講座 第三回 巨大なプログラムの実行" >次</a>
</div>
