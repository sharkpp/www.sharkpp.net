---
title: "OpenHSP #modcfuncパッチ"
tags: [hsp, OpenHSP]
categories: [blog]

---

OpenHSP用の#modcfuncパッチを作ってみた。

コンパイルは出来たのでそんなには間違っていないと思うが未保障。

はて、fujidigさんのコンパイルの実装で変更前と結果が同じかチェックするコンパイラテスタ？はどこへ行ったのだろう？

パッチ

<pre>Index: hspcmp/hspcmd.cpp
===================================================================
--- hspcmp/hspcmd.cpp	(リビジョン 323)
+++ hspcmp/hspcmd.cpp	(作業コピー)
@@ -322,6 +322,7 @@
 	"$000 0 #ifndef",
 	"$000 0 #include",
 	"$000 0 #modfunc",
+	"$000 0 #modcfunc",
 	"$000 0 #modinit",
 	"$000 0 #modterm",
 	"$000 0 #module",
Index: hspcmp/token.cpp
===================================================================
--- hspcmp/token.cpp	(リビジョン 323)
+++ hspcmp/token.cpp	(作業コピー)
@@ -2177,6 +2177,8 @@
 ppresult_t CToken::PP_Defcfunc( int mode )
 {
 	//		#defcfunc解析
+	//			mode : 0 = 通常cfunc
+	//			       1 = modcfunc
 	//
 	int i,id;
 	char *word;
@@ -3014,6 +3016,10 @@
 		res = PP_Deffunc(1);
 		return res;
 	}
+	if (tstrcmp(word,"modcfunc")) {		// module function (2)
+		res = PP_Defcfunc(1);
+		return res;
+	}
 	if (tstrcmp(word,"modinit")) {		// module function (3)
 		res = PP_Deffunc(2);
 		return res;
</pre>