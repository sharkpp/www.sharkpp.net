---
title: "PHP と Sheets API を利用して Google Spread Sheets を操作する方法"
date: 2016-09-22 20:50
tags: [ Google, Google API, Google Spread Sheets, php, How to ]
categories: [ ブログ  ]

---

bot 的な何かで諸々集計して、Google スプレッドシートへ内容を保存しようと思い、いろいろ調べてみたところ、見つかった情報が古くなっていたので多少試行錯誤して動くようにした結果をまとめてみました。

PHP を開発言語としていますが、認証キーの登録などの部分は共通なので、他の言語でも多少参考になると思います。

## 準備

実際のコードを書く前に、認証キーの取得や対象のスプレッドシートの追加などが必要です。

大まかな手順は、

1. [Google API Console](https://console.developers.google.com/) へプロジェクトを追加
2. 認証情報を作成
3. [Google スプレッドシート](https://docs.google.com/spreadsheets/) で対象のスプレッドシートを作成
4. スプレッドシートを読み書きできるように共有を作成
5. [Google Sheets API - API Manager](https://console.developers.google.com/apis/api/sheets.googleapis.com/overview) から API を有効にする
6. 実際にコードを書いて Go !

こんな感じです。

### API Console へプロジェクトを追加

まずは [Google API Console](https://console.developers.google.com/) へアクセスし、プロジェクトを作成します。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_01_api_console.png', 512, 512) }}" alt="API Console">](/images/2016_0922_gsapi_01_api_console.png)

初めて Google API Console へアクセスの場合は、プロジェクトが作成されていないので、どん！と、「プロジェクトの作成」ボタンが表示されます。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_02_add_project_from_menu.png', 512, 512) }}" alt="メニューからのプロジェクトの追加">](/images/2016_0922_gsapi_02_add_project_from_menu.png)

すでに別のプロジェクトがある場合は、そのまま使うか、メニューから「プロジェクトを作成」を選んでください。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_03_add_project_wizard.png', 512, 512) }}" alt="プロジェクトの追加のウィザード">](/images/2016_0922_gsapi_03_add_project_wizard.png)

プロジェクト名などを設定し、「作成」ボタンを押下するとプロジェクトが作成されます。

### 認証情報を作成

[<img src="{{ thumbnail('/images/2016_0922_gsapi_04_add_auth_select_type.png', 512, 512) }}" alt="認証情報の種類の選択肢">](/images/2016_0922_gsapi_04_add_auth_select_type.png)

左側のナビメニューから「認証情報」を選択し、「認証情報の作成」を選ぶと、作成する認証情報の種別が表示されます。

ここでは「サービスアカウント キー」を選びます。

今回作成するキーは

|選択肢|選択内容|
|-|-|
|認証情報(の種類)|サービスアカウント キー|
|サービスアカウント(の種類)|App Engine default service account|
|キーのタイプ|JSON|

です。

その他の種別でのアクセス方法は、[PHP Quickstart  |  Sheets API  |  Google Developers](https://developers.google.com/sheets/quickstart/php) や [API Client Library for PHP (Beta)  |  Google Developers](https://developers.google.com/api-client-library/php/)
 などを参考にしてみてください。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_05_add_auth_select_account_type.png', 512, 512) }}" alt="サービスアカウントの種類の選択肢">](/images/2016_0922_gsapi_05_add_auth_select_account_type.png)

サービスアカウントの種類は、

* App Engine default service account
* Compute Engine default service account

の二種類が今のところ最初から用意されているようです。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_06_add_auth_select_account_type.png', 512, 512) }}" alt="サービスアカウントの種類の選択">](/images/2016_0922_gsapi_06_add_auth_select_account_type.png)

今回選ぶのは「App Engine default service account」で、キーのタイプは「JSON」です。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_07_auth_key_downloaded.png', 512, 512) }}" alt="認証情報のダウンロード">](/images/2016_0922_gsapi_07_auth_key_downloaded.png)

作成すると、キーがダウンロードされるので大切に保管しましょう。

このキーのコピーはサーバー側にもないので、なくした場合は作り直す必要があります。

### スプレッドシートを作成

操作対象のスプレッドシートを [Google スプレッドシート](https://docs.google.com/spreadsheets/) で作成します。

### スプレッドシートの共有を作成

API を経由してスプレッドシートへアクセスできるように共有を作成します。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_08_spreadsheet_share_for_api.png', 512, 512) }}" alt="API 用にスプレッドシートを共有">](/images/2016_0922_gsapi_08_spreadsheet_share_for_api.png)

書き込みしないのであれば、「閲覧者」でも問題ないかもしれませんが、試していません。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_09_service_account_key_email.png', 512, 512) }}" alt="サービスアカウントキーの電子メール">](/images/2016_0922_gsapi_09_service_account_key_email.png)

この時、設定するメールアドレスは、[IAM と管理](https://console.developers.google.com/iam-admin/serviceaccounts/) の「サービスアカウント」メニューから取得できます。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_10_service_account_key_email_from_json.png', 512, 512) }}" alt="認証情報 JSON に書かれたサービスアカウントキーの電子メール">](/images/2016_0922_gsapi_10_service_account_key_email_from_json.png)

ダウンロードした、秘密鍵を含むキーファイルにも書かれているので、JSON を開いた中の `client_email` からも取得できます。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_11_service_account_keys_list.png', 512, 512) }}" alt="サービスアカウントの一覧">](/images/2016_0922_gsapi_11_service_account_keys_list.png)

API Console の「認証情報」メニューを選び「サービス アカウントの管理」のリンクから飛ぶことができます。

### API を有効にする

この状態で、実行するとエラーが結果として帰ってきます。

```json
{
  "error": {
    "code": 403,
    "message": "Google Sheets API has not been used in project {PROJECT_ID} before or it is disabled. Enable it by visiting https://console.developers.google.com/apis/api/sheets.googleapis.com/overview?project={PROJECT_ID} then retry. If you enabled this API recently, wait a few minutes for the action to propagate to our systems and retry.",
    "errors": [
      {
        "message": ...,
        "domain": "global",
        "reason": "forbidden"
      }
    ],
    "status": "PERMISSION_DENIED"
  }
}
```

メッセージの部分はこのように書いてあります。

> Google Sheets API has not been used in project {PROJECT_ID} before or it is disabled. Enable it by visiting https://console.developers.google.com/apis/api/sheets.googleapis.com/overview?project={PROJECT_ID} then retry. If you enabled this API recently, wait a few minutes for the action to propagate to our systems and retry.

訳すと、

> Google Sheets API は、以前のプロジェクト {PROJECT_ID} で使用されていないか、無効になっています。 https://console.developers.google.com/apis/api/sheets.googleapis.com/overview?project={PROJECT_ID} を訪れ、API を有効にした後、再試行してください。最近この API を有効にした場合は、操作が当社のシステムに伝播するまで数分待ち、再試行してください。

と、「API が有効になっていないなどで、操作ができなかったよ」と書かれています。

[<img src="{{ thumbnail('/images/2016_0922_gsapi_12_spreadsheet_api_enable.png', 512, 512) }}" alt="Sheats API を有効に">](/images/2016_0922_gsapi_12_spreadsheet_api_enable.png)

なので、指示に従い [Google Sheets API - API Manager](https://console.developers.google.com/apis/api/sheets.googleapis.com/overview) から API を有効にします。

## サンプルコード

[<img src="{{ thumbnail('/images/2016_0922_gsapi_13_spreadsheet_read_area.png', 512, 512) }}" alt="スプレッドシートの読み取りエリア">](/images/2016_0922_gsapi_13_spreadsheet_read_area.png)

B2:B3 に 値を書き込み、 A1:D5 までを取得するという、簡単なサンプルコードです。

### 準備

PHP 用の Google API クライアントライブラリは [google/google-api-php-client: A PHP client library for accessing Google APIs](https://github.com/google/google-api-php-client) が公式のライブラリとなります。

Composer 経由でインストールできるので、

* `composer.json` の `require` に `"google/apiclient": "^2.0"` を追加して `composer install`
* `composer require google/apiclient:^2.0`

のどちらかの方法でインストールができます。

### コード

サンプルで使う `composer.json` です。
`composer install` してください。

```
{
    "name": "sharkpp/gsapi-example",
    "require": {
        "google/apiclient": "^2.0"
    }
}
```

サンプルコードです。

サンプロコード内で、参照されている環境変数にはそれ添えr次のような値をセットしてください。

|環境変数名|内容|
|-|-|
|`SERVICE_KEY_JSON`|先の手順でダウンロードしたファイル。例えば `My Project-19c43c948fd7.json` のような名前|
|`SPREADSHEET_ID`|スプレッドシートを識別する id。例えば `https://docs.google.com/spreadsheets/d/XXXXX/edit#gid=9999` がスプレッドシートのアドレスだった場合は、`XXXXX` が `SPREADSHEET_ID` で、今開いているシートの id が `9999` となります。|

```
<?php

date_default_timezone_set('Asia/Tokyo');

require 'vendor/autoload.php';

define('CREDENTIALS_PATH', getenv('SERVICE_KEY_JSON'));
define('SPREADSHEET_ID',   getenv('SPREADSHEET_ID'));

putenv('GOOGLE_APPLICATION_CREDENTIALS='.dirname(__FILE__).'/'.CREDENTIALS_PATH);
$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$client->setApplicationName('test');

$service = new Google_Service_Sheets($client);

// B2:B3 を更新
$value = new Google_Service_Sheets_ValueRange();
$value->setValues([ 'values' => [ 'aaaa', 'bbbb' ] ]);
$response = $service->spreadsheets_values->update(SPREADSHEET_ID, 'シート1!B2', $value, [ 'valueInputOption' => 'USER_ENTERED' ] );

// A1:D5 の範囲を取得
$response = $service->spreadsheets_values->get(SPREADSHEET_ID, 'シート1!A1:D5');
foreach ($response->getValues() as $index => $cols) {
	echo sprintf('#%d >> "%s"', $index+1, implode('", "', $cols)).PHP_EOL;
}
```

実行すると、まず

||A|B|C|D|...|
|:-:|-|-|-|-|-|
|**1**|　　　|　　　|　　　|　　　|　|
|**2**||aaaa|bbbb|||
|**3**||||||
|**4**||||||
|**5**||||||
|...||||||

値が書き込まれ、表の範囲が取得されますが、

||A|B|C|D|...|
|:-:|-|-|-|-|-|
|**1**|　　　|　　　|　　　|　　　|　|
|**2**||aaaa|bbbb|||
|**3**||||||
|**4**||||||
|**5**||||||
|...||||||

実際に結果から値として取り出せるのは、セルに値がセットされている

||A|B|C|
|:-:|:-:|:-:|:-:|
|**1**|　☆　|　　　|　　　|
|**2**|☆|☆|☆|

この範囲だけになります。


```bash
$ php test.php 
#1 >> ""
#2 >> "", "aaaa", "bbbb"
```

実際に中身を表示させると、こうなります。

そのため、対象範囲すべてが確保されているものとして、直接添え字を指定しアクセスすると `Notice: Undefined offset: ...` となるので注意が必要です。

## 困った時は

### ◯◯のやり方がわからない

PHP のクライアントライブラリの使い方を懇切丁寧に書いたドキュメントはなさそうなので、

* [google/google-api-php-client](https://github.com/google/google-api-php-client) の README.md
* ライブラリのソースコード `vendor/google/apiclient-services/Google/Service/Sheets/*`
* [PHP Quickstart  |  Sheets API  |  Google Developers](https://developers.google.com/sheets/quickstart/php)
* [Google Sheets API  |  Sheets API  |  Google Developers](https://developers.google.com/sheets/reference/rest/)
* [Stack Overflow](http://stackoverflow.com/)

あたりから、気合て探しましょう！

…まあ基本的に英語です。

### PHP のバージョン

[A PHP client library for accessing Google APIs](https://github.com/google/google-api-php-client) を動かすのに必要な PHP のバージョンは `PHP 5.4.0 or higher` と README に書かれているのですが、正解なようで間違っています。

最新を Composer でインストールすると、依存しているライブラリで [curl_reset](http://php.net/manual/ja/function.curl-reset.php) を利用しているものがあり、しかし、この関数が実装されたのは `PHP 5.5.0` からなので、結果としてエラーで動作しません。

回避手段は、ドキュメントの「ユーザーが投稿した注記」の [#119616](http://php.net/manual/ja/function.curl-reset.php#119616) に書かれているように、

```php
<?php

// ---- 追加開始 ----

if (function_exists('curl_init') &&
	!function_exists('curl_reset')) {
	function curl_reset(&$ch) {
		$ch = curl_init();
	}
}

// ---- 追加終了 ----

require 'vendor/autoload.php';
           :
```

こんな感じの関数を定義してあげれば OK です。

手元では `PHP 5.4.12` で動作しています。

## 参考

* [[Python] Google SpreadSheetをAPI経由で読み書きする - YoheiM .NET](http://www.yoheim.net/blog.php?q=20160205)
* [Python3でGoogle SpreadsheetをDBのように利用する](http://wwld.jp/2015/11/07/spreadsheet-api.html)
* [Google APIs Client Library for PHP を使ってスプレッドシートを読み書きする（1） - Mach3.laBlog](http://blog.mach3.jp/2015/09/16/google-spreadsheet-api-01.html)
* [google/google-api-php-client: A PHP client library for accessing Google APIs](https://github.com/google/google-api-php-client)
* [PHP Quickstart  |  Sheets API  |  Google Developers](https://developers.google.com/sheets/quickstart/php)
* [Request Resource | Sheets API | Google Developers](https://developers.google.com/sheets/reference/rest/v4/spreadsheets/request#UpdateCellsRequest)
* [php - Google Sheet Api Change Sheet's Cell Format - Stack Overflow](http://stackoverflow.com/questions/38949913/google-sheet-api-change-sheets-cell-format)
* [Google spreadsheet API v4 with PHP - how to insert empty row to beginning - Stack Overflow](http://stackoverflow.com/questions/37816307/google-spreadsheet-api-v4-with-php-how-to-insert-empty-row-to-beginning)
* [Trying to append a row to a Google Spreadsheet in PHP - Stack Overflow](http://stackoverflow.com/questions/38025841/trying-to-append-a-row-to-a-google-spreadsheet-in-php)
* [API Client Library for PHP (Beta)  |  Google Developers](https://developers.google.com/api-client-library/php/)
