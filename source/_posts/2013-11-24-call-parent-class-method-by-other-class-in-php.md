---
title: "phpでオブジェクトの継承元のメソッドを別のクラスから呼び出す方法"
date: 2013-11-24 13:40:00
tags: [php, Develop]
categories: [ブログ]

---

phpで実装上どうしてもタイトルのような事をしないといけなかったのでその方法のメモ。 そもそもの話、実装がまずいって事のような気がすご???くするんだけど、それは置いておこう。

## 前提

<blockquote class="twitter-tweet" lang="ja"><p>
ふーむ？ クラスBはクラスAから派生しててクラスBはクラスCを持っているとして、クラスBメソッド→クラスCメソッド→クラスBのインスタンスでクラスAメソッドを呼ぶってPHPだとできないよねーきっと <a href="https://twitter.com/search?q=%23php&src=hash">#php</a>
</p>&mdash; サカサマのさめたすたす (@sharkpp) 
<a href="https://twitter.com/sharkpp/statuses/403886288173932544">2013, 11月 22</a>
</blockquote>

順に挙げると、

  1. クラスA と クラスB と クラスC があります。
  2. クラスB は クラスA を継承しています。
  3. クラスC は クラスA および クラスB とは関連がありません。
  4. この時、クラスC から クラスB のオブジェクトインスタンスを使い、クラスA のメソッドを呼び出すにはどうしたらよいだろうか？
  5. ただし、呼び出すメソッドは クラスB ですでにオーバーライドされていることする。

とりあえず、前提はこんな感じ。

ソースを載せると↓な感じ。

    <?php
    class C {
        private $a;
        function __construct($owner) { $this->a = $owner; }
        public function test($v) {
            // ここで $this->a を使い A::test を呼び出したい！
        }
    }
    class A {
        public function test($v) { return '!' . $v; }
    }
    class B extends A {
        private $c;
        function __construct()   { $this->c = new C($this); }
        public function test($v) { return $this->c->test($v); }
    }
    $b = new B;
    echo $b->test('test') . "\n";
    

つまり、 クラスB::test() → クラスC::test() → クラスA::test() って感じで呼び出したい。

## 試行

色々ググってみる。

リフレクション使ったりとか、 `(array)$hoge` したりで `private` な、メンバ変数が取得出来たりとかアレなことをしていたりしてみた。

けど、ふと `public` なメソッドなら `call_user_func()` で呼び出せるんだから、クラス名付ければ呼び出せないか？と気が付いた。

やってみたら、すんなり行ってしまった。

## 解決

<blockquote class="twitter-tweet" lang="ja"><p>
ふむふむ、call_user_func 使えば あるオブジェクトの親クラスを呼び出すことができるのか <a href="https://t.co/JSy3AsWVqT">https://t.co/JSy3AsWVqT</a> <a href="https://twitter.com/search?q=%23php&src=hash">#php</a>
</p>&mdash; サカサマのさめたすたす (@sharkpp) 
<a href="https://twitter.com/sharkpp/statuses/403901924862218240">2013, 11月 22</a>
</blockquote>

該当部分だけ抜き出すと、

    public function test($v) { // C::test()
        return call_user_func(array($this->a, 'A::test'), $v);
    }
    

って感じ。

クラス名は、 `get_parent_class()` で取得してもいいかもしれない。

完全なソースは [あるオブジェクトの親クラス(派生元クラス)のメソッドを外部から呼び出す - GitHub Gist][1] に置きました。

 [1]: https://gist.github.com/sharkpp/7601323#file-gistfile1-php

実は、[PHP: call\_user\_func - Manual][2]の[このあたり][3]にもさりげなく匂わせる感じでは書いてあったりしたけど、、、見落としていた。

 [2]: http://www.php.net/manual/ja/function.call-user-func.php
 [3]: http://www.php.net/manual/ja/function.call-user-func.php#106391
