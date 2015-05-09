---
title: "Microsoft Visual C++ 2008 Express Edition で64ビット版のプログラムを作る方法"
tags: [VC++, x64]
categories: [blog]

---

とあるソフトのシェル拡張が64bitに対応しておらず使いづらかったので、誰も作っていないようなので作ってみようかなと思い Visual C++ Express Edition で64ビット版のプログラムを作る方法がないか調べてみました。

すると Visual C++ 2008 Express Edition であれば出来そうなのでやってみました。

  * 準備

  1. [Microsoft Visual Studio 2008 製品ラインの概要][1]
  2. [Windows SDK for Windows Server 2008 and .NET Framework 3.5][2]
  3. [Visual C++ 2008 Express Edition And 64-Bit Targets][3] から64ビットプログラムの有効化ツール http://suma.soulogic.com/dl/VCE64BIT.zip

をそれぞれダウンロード

  * 手順

  1. Visual C++ 2008 Express Edition をインストール
  2. Windows SDK をインストール
  3. VCE64BIT.zip を展開して動かしているOSにあったバッチファイルを実行

  * 64ビットプラットフォームの有効化

ウィザードから作るとWin32のプログラムがデフォルトで作られるので手動でプラットフォームを追加する必要があります。

  1. メニューから「ビルド」→「構成マネージャ」を開く
  2. 「プラットフォーム」カラムで「新規作成」→「新しいプラットフォーム」から「x64」を選択

これでx64を選択してビルドを行うと64ビット版のアプリケーションが生成されます。

  * 参考

  1. [Visual C++ 2008 Express Edition And 64-Bit Targets][3]

 [1]: http://www.microsoft.com/japan/msdn/vstudio/express/
 [2]: http://www.microsoft.com/downloads/details.aspx?displaylang=en&FamilyID=f26b1aa4-741a-433a-9be5-fa919850bdbf
 [3]: http://jenshuebel.wordpress.com/2009/02/12/visual-c-2008-express-edition-and-64-bit-targets/