---
title: "インストール: boostで遊ぶ 其の１"
tags: [C++, boost, asio, boostで遊ぶ]
categories: [blog]

---

最近、といっても数日前から[boost][1]を触り始めた。

 [1]: http://www.boost.org/

主に、[Let's boost][2]を参考にしています。

 [2]: http://www.kmonos.net/alang/boost/

まず、

  1. ダウンロードページから boost\_1\_39_0.7z と boost-jam-3.1.17-1-ntx86.zip をダウンロード＆解凍。
  2. bjam.exe は boost と同じフォルダに入れました。
  3. Let's boostのページのページに乗っ取ってインストールフォルダを決めパスをINCLUDEとLIBに設定。
  4. 「Visual Studio 2008 コマンド プロンプト」を起動しインストールフォルダ移動。
  5. <pre>bjam --toolset=msvc link=static,shared release debug stage</pre>と入力してライブラリをビルド。

とここまで来て、[letsboost::asio][3]のサンプルを入力してコンパイルだーと「Visual Studio 2008 コマンド プロンプト」から  


<pre>cl /EHsc asio_sample.cpp
</pre>

  
と入力すると...

 [3]: http://www.kmonos.net/alang/boost/classes/asio.html

<pre>LINK : fatal error LNK1104: ファイル 'libboost_system-vc90-mt-s-1_39.lib' を開くことができません
</pre>

＿|￣|○



  


ライブラリの設定を見直しやり直してもだめ...

ライブラリフォルダを見ると確かに無い...？？？

色々検索してみると今回のビルド方法の場合はどうもbjamのオプションがたりないようなので、

<pre>bjam --toolset=msvc runtime-link=static link=static release debug stage
</pre>

と `runtime-link=static` を追加すると libboost\_system-vc90-mt-s-1\_39.lib が生成されリンクできた。(<a href="#f1" name ="b1" title="IDEの場合のデフォルトは”マルチスレッド デバッグ DLL”で、libboost_system-vc90-mt-gd-1_39.libが必要とされるので、Let's boostの方法でOKです。">*1</a>) 



  


exeが出来た、さー実行...？？あれ？

何も結果が出てこない...

コンパイルオプション変えてもだめ

でそういえばサンプルが入っていたなーと思い出し、boost\libs\asio\example\http\client の sync\_client.cpp と async\_client.cpp をコピーしビルド。

中身見ながら結構面倒なことやってるなーと思いつつ実行！

<pre>Exception: 指定されたクラスが見つかりません。
</pre>

おや？

クラスってなんだーと思い最終的にIDEでステップ実行。

<pre>tcp::resolver::iterator endpoint_iterator = resolver.resolve(query);
</pre>

の行で例外が発生しているみたい。

たどっていくと`getaddrinfo()`から10109が返ってくる。10109ってなんだろーって検索すると WSATYPE\_NOT\_FOUND らしい。

検索で見つかった[getaddrinfo][4]をみながら、うーん WSATYPE\_NOT\_FOUND かーと考えてみると、サービス名に"http"って指定していたなーと思い、"80"にして実行してみるとうまく動いた。

 [4]: http://yanchde.gozaru.jp/winsock2/getaddrinfo.html

asio_sample.cpp の方も "http" から "80" に変えるとこちらも動いた...



  


で結局、`getaddrinfo()`に与える引数でなぜか自分の環境では、"http"がだめみたいってことだった。

なんか設定があるのだろうか？？？

でやっとスタートラインに立てたので今回は終了







  


<a href="#b1" name="f1">*1
</a>: IDEの場合のデフォルトは”マルチスレッド デバッグ DLL”で、libboost\_system-vc90-mt-gd-1\_39.libが必要とされるので、Let's boostの方法でOKです。