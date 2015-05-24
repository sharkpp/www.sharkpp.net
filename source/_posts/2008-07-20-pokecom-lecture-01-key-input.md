---
title: "C言語講座 第一回 キー入力"
date: 2008-07-20 23:36:00
tags: [ポケコン]
categories: [ポケコン, ポケコン講座]

---

## 始めに

<!-- 20050206 -->

ポケコンの、BASIC には INKEY$ があるのに、Ｃ言語には、`getch()` と `kbhit()` しかないんじゃ? というわけで、第一回のＣ言語 講座は、キー入力を扱うことにします。

## 其の壱

<!-- 20050206 -->

まず、`getch()` と `kbhit()` を組み合わせて、 

<pre>int inkey()
{
if(kbhit())
return getch();
return 0;
}
main()
{
int c;
while(1) {
c = inkey();
printf("KEY = %c[%02X] \n", c, c);
}
}
</pre>

として、キーを入力しようとしても、なぜキーを入力すると表示がとまってしまうのかというと、 おそらく `getch()` が内部でキー入力を待っているので停止しているからなのだと考えられます。

## 其の弐

<!-- 20050206 -->

そこで、Ｃ言語でキーを入力するために `call()` 命令を<!-- 20050206:実現して -->使ってみようという事になります。


	  
以下は、[「未完成な張りぼて」][1]からの引用です ^_^;
	  
`main()` は上のプログラムを使ってください。 

 [1]: http://freett.com/hazy/

<pre>char inkeyt1(void){	<span>/*キー入力関数軽量型（不都合あり）*/</span>
static char *p="へSセヘVセ2ェ□ノ";	<span>/*□はスペース*/</span>
call((unsigned)p ,0);
return (peek(0x20aa));
}
</pre>

「未完成な張りぼて」では詳しく触れられていないようなので、逆アセして解析してみます。
	  
`call()` で呼び出している、`p` が一番肝心なプログラムです。 

<pre>ORG   100H
CALL  0BE53H      <span>;  0xBE53 をコール</span>
CALL  0BE56H      <span>;  0xBE56 をコール</span>
LD    (20AAH),A   <span>;  0x20AA 番地に A レジスタ値を書き出し</span>
RET               <span>;  戻る</span>
END
</pre>

てな具合です。
	  
`0xBE53` は キー入力 の ROM 内関数で、
	  
`0xBE56` は `0xBE53` からの戻り値を "アスキーコードに変換" する ROM 内関数<del>のよう</del>です。
	  
<del>(‥のようです、というのは、どこにも記載がないからです。結果からするとおそらく、ということです。)
</del>
	  
<span>(2005/02/06)教員用の指導書に記載がありました。
</span> 

で、どんな不具合が発生するかというと、`0x20AA` 番地に書き出すことが曲者であって、 もし `0x20AA` 番地に他のプログラムがあった場合にはそれと書きつぶしてしまうことが問題なのです。
	  
そこで、`LD (20AAH),A` を `LD (0FFH),A` にしてみたら、 

<pre>int inkey()
{
static char *p="へSセヘVセ2\xff\0ノ";
call((unsigned)p ,0);
return peek(0x20aa);
}
</pre>

こうなりました。
	  
しかし、これでもまだ、不安が残ります。 もし、`0xFF` 番地にステータスを記録するプログラムだった場合は？  


## 其の参

<!-- 20050206 -->

そこで、`call()` をおさらいしてみます。 

<pre>unsigned call(unsigned adr, void * arg_HL);
adr    : 機械語の先頭アドレス
arg_HL : HL レジスタに渡される値
戻り値 : HL レジスタの値
</pre>

だそうです。
	  
そこで、この戻り値を利用し値を返すことにします。
	  
まず、アセンブラソースです。 

<pre>ORG     100H
CALL    0BE53H      <span>;  0xBE53 をコール</span>
CALL    0BE56H      <span>;  0xBE56 をコール</span>
LD      L,A         <span>;  L レジスタに A レジスタ値を書き出し</span>
RET                 <span>;  戻る</span>
END
</pre>

根本的には、変化していないのですが、`LD (0FFH),A` の部分を変更しました。
	  
なんか使い方が間違っているような気もしますが、Ｃ言語のソースは、こうなりました。 

<pre>int inkey()
{
static char *p="ヘＳセヘＶセｏノ"; <span>/* 全て全角にしてあります */</span>
return call((unsigned)p,0);
}
</pre>

結構すっきりしたと思います。
	  
**ちなみに、このプログラムは、同時にはキーを取得できません。** 

`call()` で機械語を呼び出し、結果を HL レジスタを戻り値としてキーコードを返しています。
	  
H レジスタは、呼び出し時に 0 になっているので結果的に L レジスタの値が戻ってくるわけです。

## 最後に

<!-- 20050206 -->

長々と<!-- 20050206:講座をやってきた -->書いた割には、重要なのは、上のプログラムだけ(しかも、他人のふんどしで相撲を取っているし)。


	  
まあ、第一回の講座は、これでお開きです。
	  
最後に、プログラムとキーコード表をのせたいと思います。
	  
長々とお付き合いありがとうございました。 

プログラム [inkey.h][2] 

 [2]: /files/inkey.h

　名前を inkey.h に変え、
  
　`#include "inkey.h"`
  
　として読込むか、直接記述してお使いください。

<table style="sont-size: small;" summary="inkey.h で取得できるキーのコード表"><caption>キーコード表</caption> 
<tr>
<th>
下位?上位
</th>
<th style="width: 1em">
</th>
<th style="width: 1em">
1
</th>
<th style="width: 1em">
2
</th>
<th style="width: 1em">
3
</th>
<th style="width: 1em">
4
</th>
<th style="width: 1em">
5
</th>
<th style="width: 1em">
6
</th>
<th style="width: 1em">
7
</th>
<th style="width: 1em">
?
</th>
<th style="width: 1em">
D
</th>
<th style="width: 1em;">
?
</th>
<th style="width: 1em;">
F
</th>
</tr>
<tr>
<th>
</th>
<td>
入力なし
</td>
<td>
<span>2ndF</span>
</td>
<td>
スペース
</td>
<td>
</td>
<td>
@
</td>
<td>
P
</td>
<td>
</td>
<td>
p
</td>
<td rowspan="16">
</td>
<td rowspan="15">
</td>
<td rowspan="16">
</td>
<td>
<span>ASMBL</span>
</td>
</tr>
<tr>
<th>
1
</th>
<td>
<span>BASIC</span>
</td>
<td>
<span>カナ</span>
</td>
<td>
!
</td>
<td>
1
</td>
<td>
A
</td>
<td>
Q
</td>
<td>
a
</td>
<td>
q
</td>
<td>
<span>BASE-n</span>
</td>
</tr>
<tr>
<th>
2
</th>
<td>
<span>TEXT</span>
</td>
<td>
<span>INS</span>
</td>
<td>
"
</td>
<td>
2
</td>
<td>
B
</td>
<td>
R
</td>
<td>
b
</td>
<td>
r
</td>
<td>
<span>コントラスト</span>
</td>
</tr>
<tr>
<th>
3
</th>
<td>
<span>C</span>
</td>
<td>
<span>DRG</span>
</td>
<td>
#
</td>
<td>
3
</td>
<td>
C
</td>
<td>
S
</td>
<td>
c
</td>
<td>
s
</td>
<td>
</td>
</tr>
<tr>
<th>
4
</th>
<td>
<span>STAT</span>
</td>
<td>
<span>CAPS</span>
</td>
<td>
$
</td>
<td>
4
</td>
<td>
D
</td>
<td>
T
</td>
<td>
d
</td>
<td>
t
</td>
<td>
</td>
</tr>
<tr>
<th>
5
</th>
<td>
</td>
<td>
<span>ANS</span>
</td>
<td>
%
</td>
<td>
5
</td>
<td>
E
</td>
<td>
U
</td>
<td>
e
</td>
<td>
u
</td>
<td>
</td>
</tr>
<tr>
<th>
6
</th>
<td>
<span>OFF</span>
</td>
<td>
(-)
</td>
<td>
&
</td>
<td>
6
</td>
<td>
F
</td>
<td>
V
</td>
<td>
f
</td>
<td>
v
</td>
<td>
</td>
</tr>
<tr>
<th>
7
</th>
<td>
<span>P⇔NP</span>
</td>
<td>
<span>CONST</span>
</td>
<td>
'
</td>
<td>
7
</td>
<td>
G
</td>
<td>
W
</td>
<td>
g
</td>
<td>
w
</td>
<td>
</td>
</tr>
<tr>
<th>
8
</th>
<td>
<span>BS</span>
</td>
<td>
<span>(CONST)</span>
</td>
<td>
(
</td>
<td>
8
</td>
<td>
H
</td>
<td>
X
</td>
<td>
h
</td>
<td>
x
</td>
<td>
</td>
</tr>
<tr>
<th>
9
</th>
<td>
<span>DEL</span>
</td>
<td>
<span>R・CM</span>
</td>
<td>
)
</td>
<td>
9
</td>
<td>
I
</td>
<td>
Y
</td>
<td>
i
</td>
<td>
y
</td>
<td>
</td>
</tr>
<tr>
<th>
A
</th>
<td>
<span>TAB</span>
</td>
<td>
<span>M+</span>
</td>
<td>
*
</td>
<td>
:
</td>
<td>
J
</td>
<td>
Z
</td>
<td>
j
</td>
<td>
z
</td>
<td>
</td>
</tr>
<tr>
<th>
B
</th>
<td>
<span>CA</span>
</td>
<td>
<span>M-</span>
</td>
<td>
+
</td>
<td>
;
</td>
<td>
K
</td>
<td>
[
</td>
<td>
k
</td>
<td>
{
</td>
<td>
”
</td>
</tr>
<tr>
<th>
C
</th>
<td>
<span>CLS</span>
</td>
<td>
→
</td>
<td>
,
</td>
<td>
<
</td>
<td>
L
</td>
<td>
\
</td>
<td>
l
</td>
<td>
|
</td>
<td>
</td>
</tr>
<tr>
<th>
D
</th>
<td>
<i class="fa fa-reply fa-flip-vertical"></i>
</td>
<td>
←
</td>
<td>
-
</td>
<td>
=
</td>
<td>
M
</td>
<td>
]
</td>
<td>
m
</td>
<td>
}
</td>
<td>
</td>
</tr>
<tr>
<th>
E
</th>
<td>
<span>DIGIT</span>
</td>
<td>
↑
</td>
<td>
.
</td>
<td>
>
</td>
<td>
N
</td>
<td>
^
</td>
<td>
n
</td>
<td>
~
</td>
<td>
他のキー
</td>
</tr>
<tr>
<th>
F
</th>
<td>
<span>F⇔E</span>
</td>
<td>
↓
</td>
<td>
/
</td>
<td>
?
</td>
<td>
O
</td>
<td>
_
</td>
<td>
o
</td>
<td>
</td>
<td>
゜
</td>
<td>
</td>
</tr>
</table>

※<span>色</span>文字 特殊なキーの名前
  
※<span>色</span>文字 [2ndF] または [SHIFT] を押したときの名前 

## 履歴

2004/02/24
: 公開

2005/02/06
: 注釈追加<br />構成変更



<div class="siblings_navigation">前 | C言語講座 第一回 キー入力 | <a href="/blog/2008/07/20/pokecom-lecture-02-file-size-compact.html" title="C言語講座 第二回 ファイルサイズの縮小" >次</a>
</div>
