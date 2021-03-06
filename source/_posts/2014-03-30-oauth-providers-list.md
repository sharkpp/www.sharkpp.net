---
title: "OAuth 認証を提供しているサービスをまとめてみました"
date: 2014-03-30 23:35:00
tags: [まとめ, php, Develop, OAuth, ウェブサービス]
categories: [まとめ, ウェブサービス]

---

OAuth 認証を提供しているサービスをまとめてみました。

どちらかというと Opauth で使えそうなサービス一覧、が正しいのかもしれません。

ついでに、ステータスやアプリケーションの登録を行うためのサイトも全てではないですが調べてあります。

一覧は [Opauth - Multi-provider authentication framework for PHP][1] や [Packagist][2] などを参考にしています。

 [1]: http://opauth.org/
 [2]: https://packagist.org/packages/opauth/

<table><tr>
<th align="center">
Opauth
</th>
<th align="left">
プロバイダ
</th>
<th align="center">
OAuth
</th>
<th align="left">
開発サイト(アプリ登録など)
</th>
<th align="left">
ステータスの確認ページ
</th>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/asana">○</a>
</td>
<td align="left">
<a href="https://asana.com/">Asana</a>
</td>
<td align="center">
<a href="http://tools.ietf.org/html/draft-ietf-oauth-v2-31">2.0 draft 31</a>
</td>
<td align="left">
<a href="http://developer.asana.com/documentation/#AsanaConnect">API Documentation at Asana Developers</a>
</td>
<td align="left">
<a href="https://asana.com/status">Asana - Status</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/bitbucket">○</a>
</td>
<td align="left">
<a href="https://bitbucket.org/">Bitbucket</a>
</td>
<td align="center">
1.0a
</td>
<td align="left">
<a href="https://confluence.atlassian.com/display/BITBUCKET/OAuth+on+Bitbucket">Atlassian Documentation</a>
</td>
<td align="left">
<a href="http://status.bitbucket.org/">Atlassian Bitbucket Status</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://github.com/rasa/opauth-disqus">○</a>
</td>
<td align="left">
<a href="http://disqus.com/">Disqus</a>
</td>
<td align="center">
<a href="http://tools.ietf.org/html/draft-ietf-oauth-v2-30">2.0 draft 30</a>
</td>
<td align="left">
<a href="http://disqus.com/api/docs/auth/">Authentication - API - Disqus</a>
</td>
<td align="left">
<a href="http://status.disqus.com/">Disqus Status</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://github.com/arbales/opauth-do">○</a>
</td>
<td align="left">
<a href="http://www.do.com/">Do</a>
</td>
<td align="center">
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/evernote">○</a>
</td>
<td align="left">
<a href="http://evernote.com/">Evernote</a>
</td>
<td align="center">
1.0a
</td>
<td align="left">
<a href="http://dev.evernote.com/intl/jp/appcenter/">Evernote Developers</a>
</td>
<td align="left">
<a href="http://status.evernote.com/">Evernote Status | Evernote Corporation</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/facebook">○</a>
</td>
<td align="left">
<a href="https://www.facebook.com/">Facebook</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://developers.facebook.com/apps/">Apps - Facebook Developers</a>
</td>
<td align="left">
<a href="https://developers.facebook.com/status/">プラットフォームの現在の状態</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/flickr">○</a>
</td>
<td align="left">
<a href="https://www.flickr.com/">Flickr</a>
</td>
<td align="center">
1.0a
</td>
<td align="left">
<a href="http://www.flickr.com/services/api/auth.oauth.html">Flickr Services</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/frype">○</a>
</td>
<td align="left">
<a href="http://www.frype.com/">Frype</a>
</td>
<td align="center">
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/foursquare">○</a>
</td>
<td align="left">
<a href="https://ja.foursquare.com/?">Foursquare</a>
</td>
<td align="center">
</td>
<td align="left">
<a href="https://developer.foursquare.com/overview/auth#registration">foursquare for Developers</a>
</td>
<td align="left">
<a href="http://status.foursquare.com/">Foursquare Status</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/github">○</a>
</td>
<td align="left">
<a href="https://github.com/">GitHub</a>
</td>
<td align="center">
</td>
<td align="left">
<a href="https://github.com/settings/applications/new">New OAuth Application</a>
</td>
<td align="left">
<a href="https://status.github.com/">GitHub System Status</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/google">○</a>
</td>
<td align="left">
<a href="https://www.google.com/">Google</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://console.developers.google.com/">Google Cloud Console</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
×
</td>
<td align="left">
<a href="http://gree.jp/">GREE</a>
</td>
<td align="center">
1.0
</td>
<td align="left">
<a href="https://docs.developer.gree.net/ja/globaltechnicalspecs/oauth">GREE Developer Center</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/instagram">○</a>
</td>
<td align="left">
<a href="http://instagram.com/">Instagram</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="http://instagram.com/developer/register/">Instagram開発者ドキュメント</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/linkedin">○</a>
</td>
<td align="left">
<a href="https://www.linkedin.com/">LinkedIn</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://www.linkedin.com/secure/developer">LinkedIn Developer Network</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/live">○</a>
</td>
<td align="left">
<a href="https://www.live.com">Windows Live</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://account.live.com/developers/applications">Live</a>
</td>
<td align="left">
<a href="https://status.live.com">Service Status - Microsoft services</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/mailru">○</a>
</td>
<td align="left">
<a href="http://mail.ru/">Mail.Ru</a>
</td>
<td align="center">
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/meetup">○</a>
</td>
<td align="left">
<a href="http://www.meetup.com/">Meetup</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://secure.meetup.com/meetup_api/oauth_consumers/create">Your OAuth Consumers - Meetup</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/mixi">○</a>
</td>
<td align="left">
<a href="https://mixi.jp/">mixi</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://sap.mixi.jp/home.pl">mixi</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/openid">○</a>
</td>
<td align="left">
OpenID
</td>
<td align="center">
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/paypal">○</a>
</td>
<td align="left">
<a href="https://www.paypal.com/">PayPal</a>
</td>
<td align="center">
</td>
<td align="left">
<a href="https://developer.paypal.com/webapps/developer/applications">PayPal Developer</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/probook">○</a>
</td>
<td align="left">
<a href="http://probook.bg/">Probook</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
×
</td>
<td align="left">
<a href="https://www.tumblr.com/">Tumblr</a>
</td>
<td align="center">
1.0a
</td>
<td align="left">
<a href="https://www.tumblr.com/oauth/apps">Tumblr</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/sinaweibo">○</a>
</td>
<td align="left">
<a href="http://weibo.com/">Sina Weibo (新浪微博)</a>
</td>
<td align="center">
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/thecity">○</a>
</td>
<td align="left">
<a href="http://www.onthecity.org/">The City</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://api.onthecity.org/docs/apps">The City - API Docs</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/twitter">○</a>
</td>
<td align="left">
<a href="https://twitter.com/">Twitter</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://dev.twitter.com/">Twitter Developers</a>
</td>
<td align="left">
<a href="https://dev.twitter.com/status">API Status | Twitter Developers</a>
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/vkontakte">○</a>
</td>
<td align="left">
<a href="https://vk.com/">VKontakte</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="http://vk.com/developers.php">Developers｜VK</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
×
</td>
<td align="left">
<a href="https://www.yahoo.com">Yahoo</a>
</td>
<td align="center">
</td>
<td align="left">
<a href="http://developer.yahoo.com/oauth/">Yahoo! Developer Network</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/yahoojp">○</a>
</td>
<td align="left">
<a href="http://www.yahoo.co.jp/">Yahoo! Japan</a>
</td>
<td align="center">
2.0
</td>
<td align="left">
<a href="https://e.developer.yahoo.co.jp/dashboard/">アプリケーションの管理</a>
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
<a href="https://packagist.org/packages/opauth/yandex">○</a>
</td>
<td align="left">
<a href="http://www.yandex.ru/">yandex</a>
</td>
<td align="center">
</td>
<td align="left">
</td>
<td align="left">
</td>
</tr>
<tr>
<td align="center">
×
</td>
<td align="left">
<a href="http://www.hatena.ne.jp/">はてな</a>
</td>
<td align="center">
</td>
<td align="left">
<a href="http://developer.hatena.ne.jp/ja/documents/auth/apis/oauth/consumer">Hatena Developer Center</a>
</td>
<td align="left">
なし
</td>
</tr>
<tr>
<td align="center">
×
</td>
<td align="left">
<a href="http://www.rakuten.co.jp/">楽天</a>
</td>
<td align="center">
</td>
<td align="left">
<a href="https://webservice.rakuten.co.jp/document/oauth">楽天ウェブサービス(RAKUTEN WEBSERVICE)</a>
</td>
<td align="left">
<a href="https://webservice.rakuten.co.jp/status">楽天ウェブサービス: APIモニター</a>
</td>
</tr>
</table>
