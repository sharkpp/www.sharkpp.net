---
title: "HSP3のファイル選択ダイアログで複数ファイルフィルタを指定で出来るように修正"
date: 2008-09-28 15:29:00
tags: [HSP, HSP3, Dialog, Filedialog]
categories: [ブログ]

---

[ファイル保存ダイアログ][1]で話題に上がっているファイル選択ダイアログで複数ファイルフィルタを指定で出来るように修正してみました。

 [1]: http://hsp.tv/play/pforum.php?mode=all&num=19768

<pre>dialog "as",16,"ソーススクリプト"
dialog "txt;*.exe;*.dll", 16, "色々なファイル"
dialog "bmp|jpg;*.jpeg|png", 16, "ビットマップ|JPEG|PNG"
dialog ";a*.txt", 16, "テキストファイル"
dialog "bmp|jpg;*.jpegpng", 16, "ビットマップ|JPEG|PNG"
dialog "bmp|jpg;*.jpeg|png", 16, "ビットマップ|JPEGPNG"
dialog "bmp||jpg;*.jpeg|png", 16, "ビットマップ|aa|JPEG|PNG"
dialog "bmp|*|jpg;*.jpeg|png", 16, "ビットマップ|aa|JPEG|PNG"
dialog "bmp|*|jpg;*.jpeg|png", 16, "ビットマップ||JPEG|PNG"
</pre>

こんな感じで複数フィルタのファイルフィルタを指定します。

なんか、"\n"派の方が多いような気がしないでもないのでプリプロセッサで変更できるようにはしました。

実際どっちがいいのだろう

パッチ

<pre>Index: filedlg.cpp
===================================================================
--- filedlg.cpp	(revision 178)
+++ filedlg.cpp	(working copy)
@@ -7,12 +7,13 @@
#include &lt;stdlib.h&gt;
#include &lt;stdio.h&gt;
#include &lt;string.h&gt;
+#include "../hsp3debug.h"
static HWND hwbak;
static OPENFILENAME ofn ;
static char szFileName[_MAX_PATH] ;
static char szTitleName[_MAX_FNAME + _MAX_EXT] ;
-static char szFilter[128];
+//static char szFilter[128];
void PopFileInitialize (HWND hwnd)
@@ -20,7 +21,7 @@
ofn.lStructSize       = sizeof (OPENFILENAME) ;
ofn.hwndOwner         = hwnd ;
ofn.hInstance         = NULL ;
-     ofn.lpstrFilter       = szFilter ;
+//   ofn.lpstrFilter       = szFilter ;
ofn.lpstrCustomFilter = NULL ;
ofn.nMaxCustFilter    = 0 ;
ofn.nFilterIndex      = 1 ;
@@ -39,42 +40,178 @@
ofn.lpTemplateName    = NULL ;
}
+// SJISの1バイト目か調べる
+#define is_sjis1(c)	 ( ( (c) &gt;= 0x81 && (c) &lt;= 0x9F ) || ( (c) &gt;= 0xE0 && (c) &lt;= 0xFC ) )
void fd_ini( HWND hwnd, char *extname, char *extinfo )
{
-	int a,b;
-/*
-	rev 44
-	sjisの全角判定と判断して修正２。(naznyark)
-*/
-	unsigned char a1;
-	char fext[1024];
-	char finf[1024];
-	hwbak=hwnd;
+	// dialog p1,16,p3/dialog p1,17,p3 と OpenFileDialog/SaveFileDialogに渡すデータの
+	// p1(extname)      p3(extinfo)                    フィルタ用データ 
+	// "txt"            "テキストファイル"              "*.txt\0テキストファイル(*.txt)\0\0"
+	// "txt;*.text"     "テキストファイル"              "*.txt;*.text\0テキストファイル(*.txt;*.text)\0\0"
+	// "txt;*.text|log" "テキストファイル|ログファイル" "*.txt;*.text\0テキストファイル(*.txt;*.text)\0*.log\0ログファイル(*.log)\0\0"
+	// ";a*.txt"        "テキストファイル"              "a*.txt\0テキストファイル(a*.txt)\0\0"
-	szFilter[0]=0;
+	// Shark++
+	// ※ MSも全角を推奨していたし(メニュー文字列だったけど)もう半角捨ててもいいよね...
+	// 　 ってことで"ﾌｧｲﾙ" は "ファイル" にしました。
+
+#define realloc_filter_buffer()                        \
+	pszFilterPtr = (char*)realloc(pszFilter, nFilterLen + 1); \
+	if( NULL == pszFilterPtr ) goto out_of_memory;     \
+	pszFilter = pszFilterPtr
+
+	// 区切り文字
+#if 1
+	static const char DELIMITER[]       = "|";
+	static const int  DELIMITER_LEN     = 1;
+#else  // こっちにするなら\r\nで処理しないとだめ
+	static const char DELIMITER[]       = "\r";
+	static const int  DELIMITER_LEN     = 2;
+#endif
+	static const char DEFAULT_DESC[]    = "ファイル";
+	static const char ALL_FILE_FILTER[] = "すべてのファイル (*.*)";
+
+	char *pszFilter = NULL, *pszFilterPtr;
+	int nFilterLen;
+	int nFilterSeek;
+	char *fext = NULL, *fext_next;
+	char *finf = NULL, *finf_next;
+	int fext_len;
+	int finf_len;
+	bool no_aster;
+	int nFilterIndex;
+
szFileName[0]=0;
szTitleName[0]=0;
-	strcpy( fext,extname );
-	if (fext[0]==0) strcpy( fext,"*" );
-	sprintf( szFileName, "*.%s",fext );
+	fext = extname;
+	finf = extinfo;
-	if (fext[0]!=42) {
-		if (extinfo[0]==0) sprintf( finf,"%sﾌｧｲﾙ",fext );
-					  else strcpy( finf,extinfo );
-		sprintf( szFilter, "%s (*.%s)@*.%s@", finf, fext, fext );
+	nFilterLen = 0;
+	nFilterSeek = 0;
+
+	for(nFilterIndex = 0;;
+		fext = fext_next + DELIMITER_LEN,
+		finf = finf_next + DELIMITER_LEN,
+		nFilterIndex++)
+	{
+		// 区切り文字で分割
+		for(fext_next = fext; *fext_next && *DELIMITER != *fext_next; fext_next++) {
+			// SJISの1バイト目チェック＆2文字目を飛ばすときの'\0'チェック
+			if( is_sjis1(*fext_next) && fext_next[1] )
+				fext_next++;
+		}
+		for(finf_next = finf; *finf_next && *DELIMITER != *finf_next; finf_next++) {
+			// SJISの1バイト目チェック＆2文字目を飛ばすときの'\0'チェック
+			if( is_sjis1(*finf_next) && finf_next[1] )
+				finf_next++;
+		}
+		if( fext_next == fext && finf_next == finf ) {
+			break;
+		}
+
+		fext_len = (int)(fext_next - fext);
+		finf_len = (int)(finf_next - finf);
+
+		if( !*fext_next )
+			fext_next -= DELIMITER_LEN;
+		if( !*finf_next )
+			finf_next -= DELIMITER_LEN;
+
+		// 拡張子の先頭に';'があった場合は"*."を先頭につけないモードにする
+		no_aster = (';' == *fext);
+		if( no_aster ) {
+			fext++;
+			fext_len--;
+		}
+
+		if( 0 == fext_len ||
+			('*' == *fext && 1 == fext_len) )
+		{
+			// 拡張子指定が空文字 or "*" の場合はフィルタに登録をしない
+			continue;
+		}
+
+		// デフォルトファイル名指定
+		if( 0 == nFilterIndex ) {
+			if( !no_aster )
+				strcat(szFileName, "*.");
+			strncat(szFileName, fext, min((size_t)fext_len, _MAX_PATH - 3/* strlen("*.")+sizeof('\0') */));
+		}
+
+		// finf + "(" + "*." + fext + ")" + "\0" + "*." + fext + "\0"
+		nFilterSeek = nFilterLen;
+		nFilterLen += finf_len + 1 + 2 + fext_len + 1 + 1 + 2 + fext_len + 1 + (no_aster ? -4 : 0);
+		if( 0 == finf_len ) {
+			// ファイルの説明が空文字の場合は拡張子+"ファイル"に
+			nFilterLen += fext_len;
+			nFilterLen += (int)strlen(DEFAULT_DESC); // ※
+		}
+		realloc_filter_buffer();
+
+		pszFilterPtr = pszFilter + nFilterSeek;
+		*pszFilterPtr = '\0';
+
+		// フィルタ説明
+		if( 0 == finf_len ) {
+			strncat(pszFilterPtr, fext, (size_t)fext_len);
+			strcat(pszFilterPtr, DEFAULT_DESC); // ※
+		} else {
+			strncat(pszFilterPtr, finf, (size_t)finf_len);
+		}
+
+		strcat(pszFilterPtr,  no_aster ? "(" : "(*.");
+		strncat(pszFilterPtr, fext, (size_t)fext_len);
+		strcat(pszFilterPtr,  ")");
+		strcat(pszFilterPtr,  DELIMITER);
+
+		// フィルタ拡張子
+		if( !no_aster )
+			strcat(pszFilterPtr, "*.");
+		strncat(pszFilterPtr, fext, (size_t)fext_len);
+		strcat(pszFilterPtr,  DELIMITER);
}
-	strcat( szFilter,"すべてのﾌｧｲﾙ (*.*)@*.*@@" );
-	b=(int)strlen(szFilter);
-	for(a=0;a&lt;b;a++) {
-		a1=szFilter[a];
-		if ( ( ( a1 &gt;= 0x81 ) && ( a1 &lt;= 0x9F ) ) || ( ( a1 &gt;= 0xE0 ) && ( a1 &lt;= 0xFC ) ) ) a++;
-		else if (a1=='@') szFilter[a]=0;
+	// "すべてのファイル (*.*)" + "\0" + "*.*" + "\0" + "\0"
+	nFilterSeek = nFilterLen;
+	nFilterLen += (int)strlen(ALL_FILE_FILTER) + 1 + (int)strlen("*.*") + 1 + 1;
+	realloc_filter_buffer();
+
+	pszFilterPtr = pszFilter + nFilterSeek;
+	*pszFilterPtr = '\0';
+
+	// フィルタ説明
+	strcat(pszFilterPtr, ALL_FILE_FILTER); // ※
+	strcat(pszFilterPtr, DELIMITER);
+
+	// フィルタ拡張子
+	strcat(pszFilterPtr, "*.*");
+	strcat(pszFilterPtr, DELIMITER);
+	strcat(pszFilterPtr, DELIMITER);
+
+//	for(int i = 0; i &lt; nFilterLen-1; i++) if('\0'==pszFilter[i]) pszFilter[i] = '|';
+//	MessageBox(NULL,pszFilter,"",0);
+
+	// 区切り文字を'\0'に変換
+	pszFilterPtr = pszFilter;
+	for(nFilterSeek = 0; nFilterSeek &lt; nFilterLen; pszFilterPtr++, nFilterSeek++) {
+		if( is_sjis1(*pszFilterPtr) )
+			pszFilterPtr++;
+		else if( *DELIMITER == *pszFilterPtr )
+			*pszFilterPtr = '\0';
}
+	
+	PopFileInitialize(hwnd);
+	ofn.lpstrFilter = pszFilter;
-	PopFileInitialize(hwnd);
+#undef realloc_filter_buffer
+
+	return;
+
+out_of_memory:
+	free(pszFilter);
+	throw HSPERR_OUT_OF_MEMORY;
}
char *fd_getfname( void )
@@ -84,17 +221,24 @@
BOOL fd_dialog( HWND hwnd, int mode, char *fext, char *finf )
{
+	BOOL bResult = FALSE;
switch(mode) {
case 0:
fd_ini( hwnd, fext, finf );
ofn.Flags = OFN_HIDEREADONLY | OFN_CREATEPROMPT ;
-		return GetOpenFileName (&ofn) ;
+		bResult = GetOpenFileName (&ofn) ;
+		free((void*)ofn.lpstrFilter);
+		ofn.lpstrFilter = NULL;
+		break;
case 1:
fd_ini( hwnd, fext, finf );
ofn.Flags = OFN_OVERWRITEPROMPT | OFN_HIDEREADONLY;
-		return GetSaveFileName (&ofn) ;
+		bResult = GetSaveFileName (&ofn) ;
+		free((void*)ofn.lpstrFilter);
+		ofn.lpstrFilter = NULL;
+		break;
}
-	return 0;
+	return bResult;
}
</pre>
