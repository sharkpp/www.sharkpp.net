---
title: "テンプレート構文メモ tag/TemplateParserの構文に関してのメモ"
date: 2009-01-10 18:37:00
tags: [php, rhaco]
categories: [php, rhaco]

---


  
参考:[rhacoアプリ開発日誌 - 逆引きrhaco53: rhacoのテンプレートで使用するタグまとめ][1]

  
※整形中orz 

<pre>ループ
構文
&lt;rt:loop&gt;
?
&lt;/rt:loop&gt;
パラメータ
param	ループ対象の変数を指定、{$hoge}、hoge、など、省略値はparam
var		ループ内で要素を割り当てる変数名を指定、fuga、など、省略値はvar
counter	ループ内で要素のキーを割り当てる変数名を指定、key、など、省略値はcounter
first	ループの先頭要素かの判断に使用する変数名を指定、is_first、など、省略値はfirst
last	ループの末尾要素かの判断に使用する変数名を指定、is_last、など、省略値はlast
offset	ループの開始オフセットの指定、省略値は1
limit	ループ回数の指定、省略値は0(無制限)
サンプル
ソース
※ $parser-&gt;setVariable('hoge',array("a","b","c"));
&lt;rt:loop param="{$hoge}" var="fuga" counter="key"&gt;
hoge[{$key}] = '{$fuga}'&lt;br&gt;
&lt;/rt:loop&gt;
実行結果
hoge[0] = 'a'&lt;br&gt;
hoge[1] = 'b'&lt;br&gt;
hoge[2] = 'c'&lt;br&gt;
説明
ループ
構文
&lt;rt:for&gt;
～
&lt;/rt:for&gt;
パラメータ
counter	ループ内で現在のカウンタ値を割り当てる変数名を指定、i、など、省略値はcounter
start	ループの初期値を指定、省略値は0
end		ループの終了値を指定、省略値は10
step	ループ増分を指定、省略値は1
サンプル
ソース
&lt;rt:for counter="i" start="0" end="5" step="2"&gt;
i = {$i}&lt;br&gt;
&lt;/rt:for&gt;
実行結果
i = 0&lt;br&gt;
i = 2&lt;br&gt;
i = 4&lt;br&gt;
説明
条件分岐
構文
&lt;rt:if&gt;
～
&lt;rt:else /&gt;
～
&lt;/rt:if&gt;
パラメータ
param	条件の判断に使用する変数を指定、{$hoge}、など、省略値はfalse
value	条件の判断に使用する値を指定、5、など
サンプル
ソース
※ $parser-&gt;setVariable('hoge',"a"));
&lt;rt:if param="{$hoge}" value="a"&gt;
hoge is 'a'&lt;br&gt;
&lt;/rt:else /&gt;
hoge is not 'a'&lt;br&gt;
&lt;/rt:if&gt;
実行結果
hoge is 'a'&lt;br&gt;
説明
&lt;rt:ifnot&gt;の反対の動作、条件がtrueになる場合に動作するのが&lt;rt:if&gt;
&lt;rt:else /&gt;は省略が可能です
条件分岐(否定)
構文
&lt;rt:ifnot&gt;
～
&lt;rt:else /&gt;
～
&lt;/rt:ifnot&gt;
サンプル
ソース
※ $parser-&gt;setVariable('hoge',"a"));
&lt;rt:ifnot param="{$hoge}" value="a"&gt;
hoge is not 'a'&lt;br&gt;
&lt;/rt:else /&gt;
hoge is 'a'&lt;br&gt;
&lt;/rt:ifnot&gt;
実行結果
hoge is 'a'&lt;br&gt;
説明
&lt;rt:if&gt;の反対の動作、条件がfalseになる場合に動作するのが&lt;rt:ifnot&gt;
&lt;rt:else /&gt;は省略が可能です
存在確認
構文
&lt;rt:has&gt;
～
&lt;/rt:has&gt;
パラメータ
param	条件の判断に使用する変数を指定、{$hoge}、など、省略値はparam
サンプル
ソース
※ $parser-&gt;setVariable('hoge',"a"));
&lt;rt:has param="{$hoge}"&gt;
hoge is not empty&lt;br&gt;
&lt;/rt:has&gt;
実行結果
hoge is not empty&lt;br&gt;
説明
paramにarray(),null,""を指定すると&lt;rt:has&gt; ～ &lt;/rt:has&gt;は実行されない
存在確認(否定)
構文
&lt;rt:hasnot&gt;
～
&lt;/rt:hasnot&gt;
パラメータ
param	条件の判断に使用する変数を指定、{$hoge}、など、省略値はparam
サンプル
ソース
※ $parser-&gt;setVariable('hoge',""));
&lt;rt:has param="{$hoge}"&gt;
hoge is empty&lt;br&gt;
&lt;/rt:has&gt;
実行結果
hoge is empty&lt;br&gt;
説明
paramにarray(),null,""を指定すると&lt;rt:hasnot&gt; ～ &lt;/rt:hasnot&gt;が実行される
差込
構文
&lt;rt:include /&gt;
パラメータ
href	現在のテンプレートに差し込む別のテンプレートへのパスを指定します。
サンプル
ソース
&lt;rt:include href="./hoge.html" /&gt;
説明
hrefで指定したテンプレートが現在のテンプレートに読み込まれて表示されます
継承
構文
&lt;rt:extends /&gt;
パラメータ
href	現在のテンプレート継承元テンプレートのパスを指定します。
サンプル
ソース
&lt;rt:extends href="./hoge.html" /&gt;
説明
hrefで指定したテンプレートから現在のテンプレートが派生していることを宣言します
&lt;rt:block&gt;で継承元の同じ名前のブロックを置き換えることが出来ます
ブロック指定
構文
&lt;rt:setblock /&gt;
パラメータ
href	
サンプル
ソース
&lt;rt:setblock href="./hoge.html" /&gt;
説明
ブロック
構文
&lt;rt:block&gt;
～
&lt;/rt:block&gt;
パラメータ
name	ブロック名を指定します、省略値はname
サンプル
ソース
&lt;rt:block name="hoge" /&gt;
～
&lt;/rt:block&gt;
説明
&lt;rt:extends /&gt;で指定したテンプレート内に存在する同じ名前のブロックを置き換えます
置換
構文
&lt;rt:replace /&gt;
パラメータ
src		置換対象の文字列を指定します。
dest	置換文字列を指定します。
サンプル
ソース
&lt;rt:replace src="hoge" dest="fuga" /&gt;
実行結果
説明
&lt;rt:extends /&gt;で指定したテンプレート内に存在する同じ名前のブロックを置き換えます
コメント
構文
&lt;rt:invalid /&gt;
パラメータ
name	指定した名前の疑似Exceptionのみを対象にします、初期値は、exceptions(全ての疑似Exception)
var		疑似Exceptionメッセージの列挙に使用する変数名を指定します、初期値は、errors
type	出力のフォーマットを指定します、
ulかplainのどちらかを指定できます、
ulはulタグでフォーマッティングします、
plainはそのまま出力されます、
初期値は、ul
サンプル
説明
ExceptionTrigger::raise()で疑似Exceptionが発行されている場合はそれを表示します
コメント
構文
&lt;rt:comment&gt;
～
&lt;/rt:comment&gt;
パラメータ
なし
サンプル
ソース
hoge&lt;br&gt;
&lt;rt:comment&gt;
fuga&lt;br&gt;
&lt;/rt:comment&gt;
moga&lt;br&gt;
実行結果
hoge&lt;br&gt;
moga&lt;br&gt;
説明
囲まれた文字列をコメントとして処理して結果に出力しないようにします
</pre>

 [1]: http://blog.shigepon.com/snippet53 "rhacoアプリ開発日誌 - 逆引きrhaco53: rhacoのテンプレートで使用するタグまとめ"
