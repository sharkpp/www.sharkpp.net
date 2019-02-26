---
layout: post
title: "Franz 5 のレシピの一覧"
date: 2019-02-07 00:10
tags: [Franz, Javascript]
categories: [ブログ]

---

Franz 5 用のレシピではどんなサービスがサポートされているのだろうと思ったので一覧にまとめてみました。

現状 [Issue](https://github.com/meetfranz/plugins/issues) に登録済みのものは自分でインストールするしかない状態ですが、それでも様々なサービスが開発者によってサポートされるようになっています。

## そもそも Franz とはなんぞや？

簡単にいうと Franz は、各種 SNS をタブでまとめて管理できるデスクトップアプリです。

[Franz – a free messaging app for Slack, Facebook Messenger, WhatsApp, Telegram and more](https://meetfranz.com/) からダウンロードできますが、利用するにはアカウント登録が必要です。

特徴として

* レシピ（＝拡張）を追加することで様々な SNS などの Webサービスに対応可能
* レシピごとに複数のアカウントを割り当て可能（＝マルチアカウント対応）
* クロスプラットフォームなデスクトップアプリ

などがあります。

まあ、仕組みとしては Webで提供されているページをタブで表示しているのでブラウザで表示できるページであれば基本はなんでも表示できます。

## レシピ一覧

[Issue](https://github.com/meetfranz/plugins/issues) に登録済みのレシピをサービスごとにまとめてみました。

|GitHub issue|レシピ名|作者|プレミアムライセンスが必要？|対象のサービス|サービスの種別|言語|備考|
|-|-|-|-|-|-|-|-|
|[#48](https://github.com/meetfranz/plugins/issues/48)|[IRCCloud for Franz](https://github.com/eightieskhild/Franz-recipes-irccloud)|[eightieskhild](https://github.com/eightieskhild)|no|[IRCCloud](https://www.irccloud.com/)|IRC|🇺🇸|
|[#208](https://github.com/meetfranz/plugins/issues/208)|[A Kiwi IRC recipe for Franz app.](https://github.com/tralves/franz-kiwiirc)|[tralves](https://github.com/tralves)|no|[Kiwi IRC](https://kiwiirc.com/)|IRC|🇺🇸|
|[#40](https://github.com/meetfranz/plugins/issues/40)|[The Lounge](https://github.com/jonathanjuursema/franz-thelounge)|[jonathanjuursema](https://github.com/jonathanjuursema)|yes|Self-hosted web IRC client|IRC|any|自己ホスト型ウェブIRCクライアント用のrecipe|
|[#95](https://github.com/meetfranz/plugins/issues/95)|[This is a Franz recipe for dbna!](https://github.com/promarcel/franz-recipe-dbna)|[promarcel](https://github.com/promarcel)|no|[dbna](https://www.dbna.com/)|SMS|🇺🇸|
|[#50](https://github.com/meetfranz/plugins/issues/50)|[MightyText recipe for Franz 5.0](https://github.com/atsao72/franz-recipe-mightytext)|[atsao72](https://github.com/atsao72)|no|[MightyText](https://mightytext.net/)|SMS|🇺🇸|
|[#119](https://github.com/meetfranz/plugins/issues/119)|[This is the Franz recipe for Pulse](https://gitlab.com/lonestone/open-source/franz-pulse)|[lonestone](https://gitlab.com/lonestone)|no|[Pulse](https://messenger.klinkerapps.com)|SMS|🇺🇸|
|[#128](https://github.com/meetfranz/plugins/issues/128)|[Franz SendLeap Plugin](https://github.com/badetitou/franz-textto)|[badetitou](https://github.com/badetitou)|no|[SendLeap](https://sendleap.com/)|SMS|🇺🇸|以前は TextTo.io でアドレスが変わったので動作しない|
|[#124](https://github.com/meetfranz/plugins/issues/124)|[TextNow.com recipe for Franz 5](https://github.com/austinhuang0131/franz-recipe-textnow)|[austinhuang0131](https://github.com/austinhuang0131)|no|[TextNow](https://textnow.com/)|SMS|🇺🇸|
|[#70](https://github.com/meetfranz/plugins/issues/70)|[This is the unofficial Franz recipe for Facebook](https://github.com/htkoca/franz-recipe-facebook)|[htkoca](https://github.com/htkoca)|no|[Facebook](https://www.facebook.com/)|SNS|any|
|[#23](https://github.com/meetfranz/plugins/issues/23)|[Franz 5+ recipe for GaduGadu](https://github.com/W-Zieciak/recipe-franz-gadugadu)|[W-Zieciak](https://github.com/W-Zieciak)|no|[GaduGadu](http://www.gg.pl/)|SNS|🇵🇱|2000年代のポーランド語で最も人気のあるコミュニケーションツール、のようだ|
|[#30](https://github.com/meetfranz/plugins/issues/30)|[Franz 5 Instagram Recipe](https://github.com/adambirds/recipe-instagram)|[adambirds](https://github.com/adambirds)|no|[Instagram](https://www.instagram.com/)|SNS|any|
|[#137](https://github.com/meetfranz/plugins/issues/137)|[Franz 5 recipe for Mastodon](https://github.com/sharkpp/franz-recipe-mastodon)|[sharkpp](https://github.com/sharkpp)|no|[Mastodon](https://en.wikipedia.org/wiki/Mastodon_(software))|SNS|any|
|[#274](https://github.com/meetfranz/plugins/issues/274)|[This is a Franz recipe for a Mastodon instance](https://github.com/julianwki/franz-recipe-mastodon)|[julianwki](https://github.com/julianwki)|yes|Mastodon|SNS|any|
|[#194](https://github.com/meetfranz/plugins/issues/194)|[Franz 5 recipe for Misskey](https://github.com/sharkpp/franz-recipe-misskey)|[sharkpp](https://github.com/sharkpp)|no|[Misskey](https://joinmisskey.github.io/)|SNS|any|
|[#278](https://github.com/meetfranz/plugins/issues/278)|[GitLab.com](https://gitlab.com/davereid/franz-recipe-nextdoor)|[Dave Reid](https://gitlab.com/davereid)|no|[Nextdoor](https://nextdoor.com/)|SNS|any|
|[#166](https://github.com/meetfranz/plugins/issues/166)|[PlanetRomeo for Franz](https://github.com/einfallstoll/franz-recipe-planetromeo)|[einfallstoll](https://github.com/einfallstoll)|no|[PlanetRomeo](https://www.planetromeo.com/)|SNS|🇺🇸|
|[#73](https://github.com/meetfranz/plugins/issues/73)|[Plurk receipt for Franz](https://github.com/irvin/Plurk-for-Franz)|[irvin](https://github.com/irvin)|no|[Plurk](https://plurk.com/)|SNS|any|
|[#149](https://github.com/meetfranz/plugins/issues/149)|[Simultima Recipe for Franz](https://bitbucket.org/Reaxx/franz-recipe-simultima)|[Reaxx](https://bitbucket.org/Reaxx/)|no|[Simultima](http://www.simultima.se/)|SNS|🇸🇪|
|[#34](https://github.com/meetfranz/plugins/issues/34)|[TickTick recipe for Franz](https://github.com/jonhil/recipe-franz-ticktick)|[jonhil](https://github.com/jonhil)|no|[TickTick](https://www.ticktick.com)|SNS|🇺🇸|
|[#63](https://github.com/meetfranz/plugins/issues/63)|[Unofficial Franz plugin for Yammer](https://gitlab.com/davereid/franz-recipe-yammer)|[davereid](https://gitlab.com/davereid)|no|[Yammer](https://www.yammer.com/)|SNS|any|
|[#186](https://github.com/meetfranz/plugins/issues/186)|[A Dynalist service for MeetFranz.](https://github.com/ktawaststjerna/recipe-dynalist)|[ktawaststjerna](https://github.com/ktawaststjerna)|no|[Dynalist](https://dynalist.io/)|アウトライナー|🇺🇸|
|[#215](https://github.com/meetfranz/plugins/issues/215)|[Workflowy recipe for Franz 5](https://github.com/arvindamirtaa/recipe-workflowy)|[arvindamirtaa](https://github.com/arvindamirtaa)|no|[Workflowy](https://workflowy.com)|アウトライナー|🇺🇸|
|[#126](https://github.com/meetfranz/plugins/issues/126)|[Custom Office 365 Outlook Web App for Franz](https://github.com/nud3l/recipe-custom-office365-owa)|[nud3l](https://github.com/nud3l)|yes|Microsoft Office 365(Custom URL)|オフィス|any|
|[#293](https://github.com/meetfranz/plugins/issues/293)|[Franz 5 recipe for Outlook.com Calendar](https://github.com/michael-garland/franz-recipe-outlook-calendar)|[michael-garland](https://github.com/michael-garland)|no|[Outlook.com Calendar](https://outlook.office.com/calendar)|カレンダー|🇺🇸|
|[#52](https://github.com/meetfranz/plugins/issues/52)|[Adds a recipe for Upwork to Franz](https://github.com/Tribex/franz-recipe-upwork)|[Tribex](https://github.com/Tribex)|no|[Upwork](https://www.upwork.com/)|クラウドソーシング|🇺🇸|
|[#86](https://github.com/meetfranz/plugins/issues/86)|[Franz 5 recipe for Zeplin](https://github.com/adgllorente/recipe-franz-zeplin)|[adgllorente](https://github.com/adgllorente)|no|[Zeplin](https://zeplin.io/)|コラボレーションツール|any|
|[#165](https://github.com/meetfranz/plugins/issues/165)|[Franz Recipe for Fruux Calendar](https://github.com/s-ayush/recipe-franz-fruux)|[s-ayush](https://github.com/s-ayush)|no|[Fruux Calendar](https://fruux.com/)|スケジュール管理|🇺🇸|
|[#9](https://github.com/meetfranz/plugins/issues/9)|[Google Calendar recipe for Franz 5](https://github.com/rherwig/franz-5-googlecalendar)|[rherwig](https://github.com/rherwig)|no|[Google Calendar](https://calendar.google.com/)|スケジュール管理|any|
|[#248](https://github.com/meetfranz/plugins/issues/248)|[Anydo for Franz](https://github.com/Baboo7/recipe-anydo)|[Baboo7](https://github.com/Baboo7)|no|[Anydo](https://www.any.do/)|タスク管理|🇺🇸|
|[#51](https://github.com/meetfranz/plugins/issues/51)|[A Franz plugin for anydo](https://github.com/s00500/recipe-anydo/)|[s00500](https://github.com/s00500)|no|[Anydo](https://web.any.do/)|タスク管理|🇺🇸|
|[#80](https://github.com/meetfranz/plugins/issues/80)|[Recipe to connect with Bring! service](https://github.com/dunkelgeist/BringShoppingList_FranzRecipe)|[dunkelgeist](https://github.com/dunkelgeist)|no|[Bring!](https://getbring.com/)|タスク管理|🇩🇪🇺🇸|買い物リスト管理|
|[#120](https://github.com/meetfranz/plugins/issues/120)|[This is the Franz recipe for Harvest](https://gitlab.com/lonestone/open-source/franz-harvest)|[lonestone](https://gitlab.com/lonestone)|no|[Harvest](https://www.harvestapp.com/)|タスク管理|🇺🇸|
|[#177](https://github.com/meetfranz/plugins/issues/177)|[This is Franz 5 Recipe for Meister Task](https://github.com/marcinjak9/franz-recipe-meistertask)|[marcinjak9](https://github.com/marcinjak9)|no|[MeisterTask](https://www.meistertask.com/)|タスク管理|any|
|[#37](https://github.com/meetfranz/plugins/issues/37)|[MeisterTask Franz Plugin](https://github.com/T-800a/recipe-meistertask)|[T-800a](https://github.com/T-800a)|no|[MeisterTask](https://www.meistertask.com/)|タスク管理|any|
|[#195](https://github.com/meetfranz/plugins/issues/195)|[This is a Franz recipe for Microsoft Todo](https://github.com/sujithgokul/franz-recipe-ms-todo)|[sujithgokul](https://github.com/sujithgokul)|no|[Microsoft To-do](https://todo.microsoft.com)|タスク管理|any|
|[#60](https://github.com/meetfranz/plugins/issues/60)|[Unofficial Franz plugin for SpikeTime](https://github.com/foss-haas/franz-spiketime)|[foss-haas](https://github.com/foss-haas)|no|[SpikeTime](https://www.spiketime.de/)|タスク管理|🇺🇸|ドメインが変更されているので多分動作しない|
|[#116](https://github.com/meetfranz/plugins/issues/116)|[Recipe for Todoist integration with Franz 5](https://github.com/avatarkava/recipe-todoist)|[avatarkava](https://github.com/avatarkava)|no|[Todoist](http://www.todoist.com)|タスク管理|any|
|[#18](https://github.com/meetfranz/plugins/issues/18)|[Franz recipe for Trello](https://github.com/Thomvh/recipe-franz-trello)|[Thomvh](https://github.com/Thomvh)|no|[Trello](https://trello.com/)|タスク管理|any|
|[#260](https://github.com/meetfranz/plugins/issues/260)|[WunderList for Franz](https://github.com/TVJunkie724/Own/tree/master/Franz_Plugins/wunderlist)|[TVJunkie724](https://github.com/TVJunkie724)|no|[Wunderlist](https://www.wunderlist.com/)|タスク管理|any|
|[#56](https://github.com/meetfranz/plugins/issues/56)|[This is a Franz recipe for Wunderlist!](https://github.com/promarcel/franz-recipe-wunderlist)|[promarcel](https://github.com/promarcel)|no|[Wunderlist](https://www.wunderlist.com/)|タスク管理|any|
|[#222](https://github.com/meetfranz/plugins/issues/222)|[A &quot;Franz&quot; messanger plugin to support Domo&#39;s Buzz](https://github.com/fieldaware/franz-plugin-domo-buzz)|[fieldaware](https://github.com/fieldaware)|no|[Domo Buzz](https://www.domo.com/buzz)|チームコラボレーション|🇺🇸|
|[#238](https://github.com/meetfranz/plugins/issues/238)|[a Franz recipe for Kaizala](https://github.com/alossar/recipe-kaizala)|[alossar](https://github.com/alossar)|no|[Microsoft Kaizala](https://www.kaiza.la/)|チームコラボレーション|🇺🇸|
|[#218](https://github.com/meetfranz/plugins/issues/218)|[Franz plugin for Pivotal Tracker.](https://github.com/acidstudios/franz-pivotal)|[acidstudios](https://github.com/acidstudios)|no|[Pivotal Tracker](https://www.pivotaltracker.com/)|チームコラボレーション|🇺🇸|
|[#219](https://github.com/meetfranz/plugins/issues/219)|[Un-Official Franz Recipe for Sococo](https://github.com/klcodanr/recipe-sococo)|[klcodanr](https://github.com/klcodanr)|no|[Sococo](https://www.sococo.com/)|チームコラボレーション|🇺🇸|
|[#228](https://github.com/meetfranz/plugins/issues/228)|[Swat.io for Franz](https://github.com/dwd0tcom/franz-swat-io)|[dwd0tcom](https://github.com/dwd0tcom)|no|[Swat.io](https://swat.io/)|チームコラボレーション|🇺🇸|
|[#259](https://github.com/meetfranz/plugins/issues/259)|[Airbnb Messages for Franz](https://github.com/TVJunkie724/Own/tree/master/Franz_Plugins/airbnb)|[TVJunkie724](https://github.com/TVJunkie724)|no|[Airbnb Chat](https://www.airbnb.at/)|チャット|🇺🇸|
|[#164](https://github.com/meetfranz/plugins/issues/164)|[Franz Recipe for Android Messages](https://github.com/michaelsouellette/recipe-androidMessages)|[michaelsouellette](https://github.com/michaelsouellette)|no|[Android Messages](https://messages.android.com/)|チャット|any|
|[#170](https://github.com/meetfranz/plugins/issues/170)|[Android Messages for Franz](https://github.com/HatBeardMe/franz-android-messages)|[HatBeardMe](https://github.com/HatBeardMe)|no|[Android Messages](https://messages.android.com/)|チャット|any|
|[#192](https://github.com/meetfranz/plugins/issues/192)|[Franz Recipe for Android Messages](https://github.com/dweinber/franz-recipe-android-messages)|[dweinber](https://github.com/dweinber)|no|[Android Messages](https://messages.android.com/)|チャット|any|
|[#198](https://github.com/meetfranz/plugins/issues/198)|[Recipe for Android Messages integration with Franz 5](https://github.com/Ammonious/recipe-android-messages)|[Ammonious](https://github.com/Ammonious)|no|[Android Messages](https://messages.android.com/)|チャット|any|
|[#38](https://github.com/meetfranz/plugins/issues/38)|[Unofficial Franz recipe for Atlassian Stride](https://github.com/Tobi042/franz-recipe-stride)|[Tobi042](https://github.com/Tobi042)|no|[Atlassian Stride](https://app.stride.com)|チャット|any|
|[#20](https://github.com/meetfranz/plugins/issues/20)|[Recipe for Chatwork integration with Franz 5](https://github.com/koma-private/recipe-chatwork)|[koma-private](https://github.com/koma-private)|no|[Chatwork](https://go.chatwork.com)|チャット|🇺🇸|
|[#140](https://github.com/meetfranz/plugins/issues/140)|[XMPP Plugin for Franz](https://github.com/alexander-schranz/franz-xmpp-client)|[alexander-schranz](https://github.com/alexander-schranz)|no|[Converse](https://conversejs.org/)|チャット|any|
|[#118](https://github.com/meetfranz/plugins/issues/118)|[Crisp-Chat integration for Franz](https://github.com/goinnovative/recipe-franz-crisp)|[goinnovative](https://github.com/goinnovative)|no|[Crisp Chat](https://crisp.chat/en/)|チャット|🇺🇸|
|[#236](https://github.com/meetfranz/plugins/issues/236)|[Official plugin for Franz](https://github.com/devhubapp/devhub-franz-recipe)|[devhubapp](https://github.com/devhubapp)|no|[DevHub](https://devhubapp.com/)|チャット|🇺🇸|GitHub用TweetDeck|
|[#148](https://github.com/meetfranz/plugins/issues/148)|[Franz 5 recipe for dialpad.com](https://github.com/TheKevJames/franz-recipe-dialpad)|[TheKevJames](https://github.com/TheKevJames)|no|[Dialpad](https://dialpad.com)|チャット|🇺🇸|
|[#90](https://github.com/meetfranz/plugins/issues/90)|[Franz 5 recipe for Flock chat](https://github.com/jereddowden/franz-recipe-flock)|[jereddowden](https://github.com/jereddowden)|no|[Flock](https://flock.com)|チャット|🇺🇸|
|[#69](https://github.com/meetfranz/plugins/issues/69)|[A recipe to add support for Glowing Bear to Franz.](https://github.com/jonathanjuursema/franz-glowingbear)|[jonathanjuursema](https://github.com/jonathanjuursema)|no|[Glowing Bear](https://www.glowing-bear.org)|チャット|🇺🇸|WeeChat web frontend|
|[#5](https://github.com/meetfranz/plugins/issues/5)|[Franz Recipe for Google Allo](https://github.com/SiloCityLabs-Franz/recipe-franz-googleallo)|[SiloCityLabs](https://github.com/SiloCityLabs)|no|[Google Allo](https://allo.google.com/)|チャット|any|Google Alloは2019年3月に終了|
|[#53](https://github.com/meetfranz/plugins/issues/53)|[Franz recipe for Riot](https://github.com/SylvainCecchetto/recipe-riot)|[SylvainCecchetto](https://github.com/SylvainCecchetto)|no|[Riot](https://riot.im/)|チャット|🇺🇸|
|[#209](https://github.com/meetfranz/plugins/issues/209)|[Ryver integration for Franz App](https://github.com/juanse417/franz_ryver)|[juanse417](https://github.com/juanse417)|no|[Ryver](https://ryver.com/)|チャット|🇺🇸|
|[#82](https://github.com/meetfranz/plugins/issues/82)|[Unofficial Franz recipe for Ryver](https://github.com/hyubs/franz-ryver)|[hyubs](https://github.com/hyubs)|no|[Ryver](https://ryver.com/)|チャット|🇺🇸|
|[#188](https://github.com/meetfranz/plugins/issues/188)|[An unofficial Franz recipe for Steam Chat](https://github.com/kevinoes/franz-plugin-steam-chat)|[kevinoes](https://github.com/kevinoes)|no|[Steam Chat](https://steamcommunity.com/chat)|チャット|any|
|[#147](https://github.com/meetfranz/plugins/issues/147)|[A Franz recipe for Stitch](https://github.com/MarZab/franz-recipe-stitch)|[MarZab](https://github.com/MarZab)|no|[Stitch](https://teamstitch.com/)|チャット|🇺🇸|
|[#224](https://github.com/meetfranz/plugins/issues/224)|[Franz Recipe for Symphony](https://github.com/austince/recipe-symphony)|[austince](https://github.com/austince)|no|[Symphony Secure Messenger](https://symphony.com/)|チャット|any|
|[#46](https://github.com/meetfranz/plugins/issues/46)|[Franz Recipe for Tawk.to](https://github.com/solutosoft/franz-recipe-tawkto)|[solutosoft](https://github.com/solutosoft)|no|[Tawk.to ](https://www.tawk.to/)|チャット|🇺🇸|
|[#106](https://github.com/meetfranz/plugins/issues/106)|[Franz plug-in for Teamwork Chat](https://github.com/krischer/franz-recipe-teamwork-chat)|[krischer](https://github.com/krischer)|no|[Teamwork Chat](https://www.teamwork.com/chat)|チャット|🇺🇸|
|[#131](https://github.com/meetfranz/plugins/issues/131)|[Teamwork Chat Franz Plugin](https://github.com/Neayto/teamwork-chat_franz-plugin)|[Neayto](https://github.com/Neayto)|no|[Teamwork Chat](https://www.teamwork.com/chat)|チャット|🇺🇸|
|[#54](https://github.com/meetfranz/plugins/issues/54)|[A recipe for franz for the Threema messenger](https://github.com/Arany/franz-recipe-threema)|[Arany](https://github.com/Arany)|no|[Threema](https://threema.ch)|チャット|🇺🇸|
|[#76](https://github.com/meetfranz/plugins/issues/76)|[Typetalk for Franz 5](https://github.com/nulab/franz-recipe-typetalk)|[nulab](https://github.com/nulab)|no|[Typetalk](https://typetalk.com/)|チャット|any|
|[#172](https://github.com/meetfranz/plugins/issues/172)|[Userlike plugin for Franz messaging app](https://github.com/reyneke-vosz/franz-recipe-userlike)|[reyneke-vosz](https://github.com/reyneke-vosz)|no|[Userlike](https://www.userlike.com/)|チャット|🇺🇸|ライブチャット|
|[#43](https://github.com/meetfranz/plugins/issues/43)|[Recipe for WeChat integration with Franz 5](https://github.com/koma-private/recipe-wechat)|[koma-private](https://github.com/koma-private)|no|[WeChat](http://www.wechat.com)|チャット|🇨🇳🇺🇸|
|[#8](https://github.com/meetfranz/plugins/issues/8)|[Workplace by facebook for Franz 5](https://github.com/rherwig/franz-5-workplace)|[rherwig](https://github.com/rherwig)|no|[Workplace Chat](https://www.facebook.com/workplace/chat-app)|チャット|any|
|[#68](https://github.com/meetfranz/plugins/issues/68)|[XING Messenger integration for Franz](https://github.com/volkert/franz-xing)|[volkert](https://github.com/volkert)|no|[XING Messenger](https://www.xing.com)|チャット|🇺🇸|
|[#155](https://github.com/meetfranz/plugins/issues/155)|[Yahoo Messenger for Franz](https://github.com/levifuksz/franz-recipe-yahoo)|[levifuksz](https://github.com/levifuksz)|no|[Yahoo Messenger](https://messenger.yahoo.com/)|チャット|any|
|[#135](https://github.com/meetfranz/plugins/issues/135)|[Zalo plugin for Franz](https://github.com/JohnnyBui/franz-zalo-plugin)|[JohnnyBui](https://github.com/JohnnyBui)|no|[Zalo](https://zalo.me/)|チャット|🇻🇳|
|[#98](https://github.com/meetfranz/plugins/issues/98)|[Zalo for Franz](https://github.com/laituanmanh32/franz-recipe-zalo)|[laituanmanh32](https://github.com/laituanmanh32)|no|[Zalo](https://zalo.me/)|チャット|🇻🇳|
|[#13](https://github.com/meetfranz/plugins/issues/13)|[Franz 5 Recipe for Zulip](https://github.com/adambirds/recipe-zulip)|[adambirds](https://github.com/adambirds)|yes|[Zulip](https://zulipchat.com/)|チャット|🇺🇸|
|[#152](https://github.com/meetfranz/plugins/issues/152)|[customer service system for Livecrowd](https://bitbucket.org/iam_tony/livecrowd-faq-franz)|[iam_tony](https://bitbucket.org/iam_tony/)|no|[Livecrowd](https://livecrowd.help/)|ナレッジデータベース|🇺🇸|
|[#229](https://github.com/meetfranz/plugins/issues/229)|[Franz recipe for KeeWeb](https://github.com/vallahaye/franz-recipe-keeweb)|[vallahaye](https://github.com/vallahaye)|no|[KeeWeb](https://keeweb.info)|パスワードマネージャ|🇺🇸|KeePass互換のオンラインパスワードマネージャ|
|[#269](https://github.com/meetfranz/plugins/issues/269)|[Buffer](https://github.com/jooray/franz-recipes/tree/master/buffercom)|[jooray](https://github.com/jooray)|no|[Buffer](https://buffer.com/)|ブックマーク|🇺🇸|
|[#212](https://github.com/meetfranz/plugins/issues/212)|[Franz recipe for Feedly](https://github.com/ferrarodav/recipe-feedly)|[ferrarodav](https://github.com/ferrarodav)|no|[Feedly](https://feedly.com/)|ブックマーク|🇺🇸|
|[#91](https://github.com/meetfranz/plugins/issues/91)|[Feedly recipe for Franz](https://github.com/alphamyd/meetfranz-recipe-feedly)|[alphamyd](https://github.com/alphamyd)|no|[Feedly](https://feedly.com/)|ブックマーク|🇺🇸|
|[#35](https://github.com/meetfranz/plugins/issues/35)|[Instapaper recipe for Franz](https://github.com/jonhil/recipe-franz-instapaper)|[jonhil](https://github.com/jonhil)|no|[Instapaper](https://www.instapaper.com)|ブックマーク|🇺🇸|
|[#26](https://github.com/meetfranz/plugins/issues/26)|[Pocket Recipe for Franz](https://github.com/diegobersanetti/recipe-franz-pocket)|[diegobersanetti](https://github.com/diegobersanetti)|no|[Pocket](https://getpocket.com)|ブックマーク|any|
|[#199](https://github.com/meetfranz/plugins/issues/199)|[Asana Recipe for Franz 5](https://github.com/Ammonious/Asana)|[Ammonious](https://github.com/Ammonious)|no|[Asana](https://asana.com/)|プロジェクト管理|any|
|[#206](https://github.com/meetfranz/plugins/issues/206)|[Add Asana to Franz](https://github.com/congamble/franz-recipe-asana)|[congamble](https://github.com/congamble)|no|[Asana](http://asana.com)|プロジェクト管理|any|
|[#231](https://github.com/meetfranz/plugins/issues/231)|[This is a Franz recipe/plugin for Asana](https://github.com/sharvit/franz-recipe-asana)|[sharvit](https://github.com/sharvit)|no|[Asana](http://asana.com)|プロジェクト管理|any|
|[#237](https://github.com/meetfranz/plugins/issues/237)|[Asana recipe for franz](https://github.com/LTKort/Asana-Franz)|[LTKort](https://github.com/LTKort)|no|[Asana](https://asana.com/)|プロジェクト管理|any|
|[#84](https://github.com/meetfranz/plugins/issues/84)|[Franz recipe for Asana](https://github.com/meqabayt/franz-recipe-asana)|[meqabayt](https://github.com/meqabayt)|no|[Asana](https://asana.com/)|プロジェクト管理|any|
|[#159](https://github.com/meetfranz/plugins/issues/159)|[Jira Plugin for Franz](https://github.com/meswapnilwagh/recipe-jira)|[meswapnilwagh](https://github.com/meswapnilwagh)|no|[Atlassian Jira](https://atlassian.net/)|プロジェクト管理|🇺🇸|
|[#213](https://github.com/meetfranz/plugins/issues/213)|[Basecamp recipe for Franz](https://github.com/bradymholt/franz-recipe-basecamp)|[bradymholt](https://github.com/bradymholt)|no|[Basecamp](http://basecamp.com)|プロジェクト管理|🇺🇸|
|[#294](https://github.com/meetfranz/plugins/issues/294)|[Franz plugin for ClickUp Support](https://github.com/gengue/franz-recipe-clickup)|[gengue](https://github.com/gengue)|no|[ClickUp](https://app.clickup.com)|プロジェクト管理|🇺🇸|
|[#136](https://github.com/meetfranz/plugins/issues/136)|[Glip for Franz](https://github.com/HsuTing/franz-glip)|[HsuTing](https://github.com/HsuTing)|no|[glip](https://glip.com/)|プロジェクト管理|🇺🇸|
|[#171](https://github.com/meetfranz/plugins/issues/171)|[Franz 5 Intercom plugin](https://github.com/dwalkr/franz-recipe-intercom)|[dwalkr](https://github.com/dwalkr)|no|[Intercom](https://www.intercom.com/)|プロジェクト管理|any|
|[#284](https://github.com/meetfranz/plugins/issues/284)|[Monday.com recipe for Franz](https://github.com/WilhelmHjelm/recipe-monday)|[WilhelmHjelm](https://github.com/WilhelmHjelm)|no|[Monday.com](https://monday.com)|プロジェクト管理|🇺🇸|
|[#121](https://github.com/meetfranz/plugins/issues/121)|[This is the Franz recipe for Notion](https://gitlab.com/lonestone/open-source/franz-notion)|[lonestone](https://gitlab.com/lonestone)|no|[Notion](https://www.notion.so/)|プロジェクト管理|🇺🇸|
|[#253](https://github.com/meetfranz/plugins/issues/253)|[A Franz recipe to add https://notion.so support](https://github.com/AndrewLeedham/recipe-notion)|[AndrewLeedham](https://github.com/AndrewLeedham)|no|[Notion](https://notion.so)|プロジェクト管理|🇺🇸|
|[#99](https://github.com/meetfranz/plugins/issues/99)|[Notion recipe for Franz 5](https://github.com/lmnet/franz-recipe-notion)|[lmnet](https://github.com/lmnet)|no|[Notion](https://www.notion.so/)|プロジェクト管理|🇺🇸|
|[#102](https://github.com/meetfranz/plugins/issues/102)|[Unofficial Pipefy recipe for Franz](https://github.com/CavalcanteLeo/franz-pipefy)|[CavalcanteLeo](https://github.com/CavalcanteLeo)|no|[Recipe Pipefy](https://app.pipefy.com)|プロジェクト管理|🇺🇸|
|[#174](https://github.com/meetfranz/plugins/issues/174)|[Franz 5 recipe for Scrumpy](https://github.com/scrumpy/franz-recipe-scrumpy)|[scrumpy](https://github.com/scrumpy)|no|[Scrumpy](https://scrumpy.io/)|プロジェクト管理|🇺🇸|
|[#200](https://github.com/meetfranz/plugins/issues/200)|[Smallinvoice integration for Franz](https://github.com/s4mpl3d/Franz-SmallInvoice)|[s4mpl3d](https://github.com/s4mpl3d)|no|[Smallinvoice](https://smallinvoice.com/)|プロジェクト管理|🇺🇸|
|[#156](https://github.com/meetfranz/plugins/issues/156)|[This is the official Franz recipe for Teamleader](https://github.com/teamleadercrm/integration-franz)|[teamleadercrm](https://github.com/teamleadercrm)|no|[Teamleader](https://teamleader.eu)|プロジェクト管理|🇺🇸|
|[#234](https://github.com/meetfranz/plugins/issues/234)|[This is a Franz recipe/plugin for Teamline](https://github.com/Radstake/franz-teamline-recipe)|[Radstake](https://github.com/Radstake)|no|[Teamline](https://www.teamline.app/)|プロジェクト管理|🇺🇸|Slack用のシンプルなプロジェクト管理ツール|
|[#19](https://github.com/meetfranz/plugins/issues/19)|[Recipe for Teamwork Projects integration with Franz 5](https://github.com/koma-private/recipe-teamwork-projects)|[koma-private](https://github.com/koma-private)|no|[Teamwork Projects](https://www.teamwork.com/)|プロジェクト管理|🇺🇸|
|[#295](https://github.com/meetfranz/plugins/issues/295)|[Waffle.io for Franz](https://github.com/willis7/recipe-waffleio)|[willis7](https://github.com/willis7)|no|[Waffle.io](http://Waffle.io)|プロジェクト管理|🇺🇸|
|[#111](https://github.com/meetfranz/plugins/issues/111)|[A recipe for Franz 5 to bring in IBM Watson Workspace](https://github.com/edm00se/franz-recipe-watson-workspace)|[edm00se](https://github.com/edm00se)|no|[Watson Workspace](https://workspace.ibm.com/)|プロジェクト管理|🇺🇸|
|[#257](https://github.com/meetfranz/plugins/issues/257)|[Franz 5 recipe for Webex teams](https://github.com/bnjjj/recipe-webex-teams)|[bnjjj](https://github.com/bnjjj)|no|[webex teams](https://www.webex.com/team-collaboration.html)|プロジェクト管理|🇺🇸|
|[#39](https://github.com/meetfranz/plugins/issues/39)|[Recipe for Wrike integration with Franz 5](https://github.com/koma-private/recipe-wrike)|[koma-private](https://github.com/koma-private)|no|[Wrike](https://www.wrike.com/)|プロジェクト管理|any|
|[#187](https://github.com/meetfranz/plugins/issues/187)|[Google Voice Plugin for Franz](https://github.com/oneguynick/franz-recipe-voice)|[oneguynick](https://github.com/oneguynick)|no|[Google Voice](https://google.com/voice)|ボイスチャット|any|
|[#87](https://github.com/meetfranz/plugins/issues/87)|[A recipe for Franz for Google Voice](https://github.com/BehindTheMath/franz-recipe-google-voice)|[BehindTheMath](https://github.com/BehindTheMath)|no|[Google Voice](https://www.google.com/voice)|ボイスチャット|any|
|[#104](https://github.com/meetfranz/plugins/issues/104)|[Google Analytics Franz Recipe](https://github.com/CavalcanteLeo/franz-Google-Analytics)|[CavalcanteLeo](https://github.com/CavalcanteLeo)|no|[Google Analytics](https://analytics.google.com)|マーケティング|🇺🇸|
|[#271](https://github.com/meetfranz/plugins/issues/271)|[Bumble pluggin for Franz](https://github.com/Choromanski/Franz-Bumble)|[Choromanski](https://github.com/Choromanski)|no|[Bumble](https://bumble.com)|マッチング|any|
|[#94](https://github.com/meetfranz/plugins/issues/94)|[This is a Franz recipe for LOVOO!](https://github.com/promarcel/franz-recipe-lovoo)|[promarcel](https://github.com/promarcel)|no|[LOVOO](https://www.lovoo.com/)|マッチング|any|日本語は未サポート|
|[#97](https://github.com/meetfranz/plugins/issues/97)|[franz-recipe-tinder](https://github.com/mszczepanczyk/franz-recipe-tinder)|[mszczepanczyk](https://github.com/mszczepanczyk)|no|[Tinder](https://tinder.com/)|マッチング|🇺🇸|
|[#250](https://github.com/meetfranz/plugins/issues/250)|[A simple recipe to add Apple iCloud to Franz.](https://github.com/bgibson72/franz-icloud/)|[bgibson72](https://github.com/bgibson72)|no|[Apple iCloud](https://www.icloud.com/#mail)|メール|any|
|[#178](https://github.com/meetfranz/plugins/issues/178)|[This is an unofficial Franz recipe for email.seznam.cz](https://github.com/TerezaLic/franz-recipe-email.cz)|[TerezaLic](https://github.com/TerezaLic)|no|[email.seznam.cz](http://email.seznam.cz/)|メール|🇨🇿|
|[#59](https://github.com/meetfranz/plugins/issues/59)|[Unofficial Franz plugin for FastMail](https://github.com/foss-haas/franz-fastmail)|[foss-haas](https://github.com/foss-haas)|no|[FastMail](https://www.fastmail.com)|メール|🇺🇸|
|[#204](https://github.com/meetfranz/plugins/issues/204)|[Franz Recipe for GMX](https://github.com/oliver-gramberg/recipe-gmx)|[oliver-gramberg](https://github.com/oliver-gramberg)|no|[GMX](http://gmx.net/)|メール|🇺🇸|
|[#33](https://github.com/meetfranz/plugins/issues/33)|[mailbox.org recipe for Franz](https://github.com/jonhil/recipe-franz-mailbox.org)|[jonhil](https://github.com/jonhil)|no|[mailbox.org](https://www.mailbox.org)|メール|🇩🇪🇺🇸|
|[#62](https://github.com/meetfranz/plugins/issues/62)|[Unofficial Franz plugin for Office 365 Deutschland Outlook](https://github.com/foss-haas/franz-outlookde)|[foss-haas](https://github.com/foss-haas)|no|[Microsoft Office 365 Outlook (Deutschland)](https://products.office.com/de-de/office-365-deutschland/office-365-deutschland)|メール|🇩🇪|
|[#14](https://github.com/meetfranz/plugins/issues/14)|[Franz 5 Recipe for Office 365 OWA](https://github.com/adambirds/recipe-office365-owa)|[adambirds](https://github.com/adambirds)|no|[Microsoft Office 365 Outlook Web App](https://outlook.office365.com/)|メール|any|
|[#71](https://github.com/meetfranz/plugins/issues/71)|[MeetFranz/Outlook](https://github.com/woutervs/MeetFranz-Outlook)|[woutervs](https://github.com/woutervs)|no|[Microsoft Outlook](https://outlook.live.com/)|メール|any|
|[#160](https://github.com/meetfranz/plugins/issues/160)|[Franz plugin for Migadu web mail](https://github.com/jonizen/migadu)|[jonizen](https://github.com/jonizen)|no|[Migadu](https://www.migadu.com/)|メール|🇺🇸|
|[#189](https://github.com/meetfranz/plugins/issues/189)|[Franz Recipe for Missive integration](https://github.com/Mumrau/franz-missive-recipe)|[Mumrau](https://github.com/Mumrau)|no|[Missive App](https://missiveapp.com/)|メール|🇺🇸|
|[#167](https://github.com/meetfranz/plugins/issues/167)|[ProtonMail recipe for Franz](https://github.com/jaswdr/recipe-protonmail)|[jaswdr](https://github.com/jaswdr)|no|[ProtonMail](https://protonmail.com)|メール|any|
|[#57](https://github.com/meetfranz/plugins/issues/57)|[This is a Franz recipe for RainLoop!](https://github.com/promarcel/franz-recipe-rainloop)|[promarcel](https://github.com/promarcel)|yes|[RainLoop](https://www.rainloop.net/)|メール|any|
|[#41](https://github.com/meetfranz/plugins/issues/41)|[A recipe to add Roundcube support to Franz.](https://github.com/jonathanjuursema/franz-roundcube)|[jonathanjuursema](https://github.com/jonathanjuursema)|yes|[Roundcube](https://roundcube.net/)|メール|any|
|[#214](https://github.com/meetfranz/plugins/issues/214)|[A Tutanota Recipe for Franz](https://gitlab.com/ComicSads/tutanota-recipe)|[ComicSads](https://gitlab.com/ComicSads)|no|[Tutanota](https://tutanota.com/)|メール|🇺🇸|
|[#130](https://github.com/meetfranz/plugins/issues/130)|[A Franz plugin for ud-mail](https://github.com/seeebiii/franz-ud-mail)|[seeebiii](https://github.com/seeebiii)|no|[united-domains Webmailer](https://www.ud-mail.de)|メール|🇩🇪🇺🇸|
|[#205](https://github.com/meetfranz/plugins/issues/205)|[Franz Recipe for web.de](https://github.com/oliver-gramberg/recipe-web.de)|[oliver-gramberg](https://github.com/oliver-gramberg)|no|[WEB.DE](http://web.de/)|メール|🇺🇸|
|[#132](https://github.com/meetfranz/plugins/issues/132)|[Yandex Mail recipe for Franz](https://github.com/mskonovalov/franz-yandex-mail-recipe)|[mskonovalov](https://github.com/mskonovalov)|no|[Yandex Mail](https://mail.yandex.ru)|メール|🇷🇺|
|[#251](https://github.com/meetfranz/plugins/issues/251)|[Franz recipe for Zoho Mail](https://github.com/paulbennet/franz-recipe-zoho-mail)|[paulbennet](https://github.com/paulbennet)|no|[Zoho Mail](https://www.zoho.com/mail/)|メール|🇺🇸|
|[#47](https://github.com/meetfranz/plugins/issues/47)|[Zoho for Franz](https://github.com/eightieskhild/Franz-recipes-Zoho)|[eightieskhild](https://github.com/eightieskhild)|no|[Zoho Mail](https://www.zoho.com/)|メール|🇺🇸|
|[#176](https://github.com/meetfranz/plugins/issues/176)|[This is the Franz 5 Recipe for Zoho Mail](https://github.com/muhammaddadu/franz-recipe-zoho-mail)|[muhammaddadu](https://github.com/muhammaddadu)|no|[Zoho Mail(EU)](https://www.zoho.eu/)|メール|🇪🇺🇺🇸|
|[#207](https://github.com/meetfranz/plugins/issues/207)|[Add Evernote to Franz](https://github.com/congamble/franz-recipe-evernote)|[congamble](https://github.com/congamble)|no|[Evernote](https://evernote.com/)|メモ|any|
|[#6](https://github.com/meetfranz/plugins/issues/6)|[Franz Recipe for Google Keep](https://github.com/SiloCityLabs-Franz/recipe-franz-googlekeep)|[SiloCityLabs](https://github.com/SiloCityLabs)|no|[Google Keep](https://keep.google.com/)|メモ|any|
|[#179](https://github.com/meetfranz/plugins/issues/179)|[Scarlet Notes recipe for Franz](https://github.com/jonhil/recipe-franz-scarletnotes)|[jonhil](https://github.com/jonhil)|no|[Scarlet Notes](https://scarlet.maubis.com)|メモ|🇺🇸|
|[#264](https://github.com/meetfranz/plugins/issues/264)|[StandardNotes recipe for Franz](https://github.com/vantezzen/franz-recipe-standardnotes)|[vantezzen](https://github.com/vantezzen)|no|[StandardNotes](https://standardnotes.org/)|メモ|🇺🇸|
|[#12](https://github.com/meetfranz/plugins/issues/12)|[Franz Recipe for iHeart Radio](https://github.com/SiloCityLabs-Franz/recipe-franz-iheart)|[SiloCityLabs](https://github.com/SiloCityLabs)|no|[iHeart Radio](https://www.iheart.com/)|ラジオ|🇺🇸|
|[#143](https://github.com/meetfranz/plugins/issues/143)|[A RauteMusik.FM Plugin for the Franz multimessenger](https://github.com/RauteMusik/rm-franz-plugin)|[RauteMusik](https://github.com/RauteMusik)|no|[RauteMusik.FM](http://RauteMusik.FM)|ラジオ|🇺🇸|
|[#85](https://github.com/meetfranz/plugins/issues/85)|[Franz 5 recipe for Bitbucket](https://github.com/adgllorente/recipe-franz-bitbucket)|[adgllorente](https://github.com/adgllorente)|no|[Bitbucket](https://bitbucket.org/)|レポジトリホスティング|🇺🇸|
|[#7](https://github.com/meetfranz/plugins/issues/7)|[Franz Recipe for GitHub](https://github.com/redsox2002/recipe-franz-github)|[redsox2002](https://github.com/redsox2002)|no|[GitHub](https://github.com/)|レポジトリホスティング|🇺🇸|
|[#211](https://github.com/meetfranz/plugins/issues/211)|[Franz recipe for GitLab](https://github.com/zigang93/franz-gitlab)|[zigang93](https://github.com/zigang93)|no|[GitLab](https://gitlab.com)|レポジトリホスティング|🇺🇸|
|[#66](https://github.com/meetfranz/plugins/issues/66)|[GitLab notifications for Franz](https://github.com/shramee/franz-gitlab)|[shramee](https://github.com/shramee)|no|[GitLab](https://gitlab.com)|レポジトリホスティング|🇺🇸|
|[#139](https://github.com/meetfranz/plugins/issues/139)|[Recipe to add Eat This Much support to Franz](https://github.com/banjomancer/recipe-eatthismuch)|[banjomancer](https://github.com/banjomancer)|no|[Eat This Much](http://www.eatthismuch.com)|栄養アプリ|🇺🇸|
|[#3](https://github.com/meetfranz/plugins/issues/3)|[Franz Recipe for Google Play Music](https://github.com/SiloCityLabs-Franz/recipe-franz-googleplay)|[SiloCityLabs](https://github.com/SiloCityLabs)|no|[Google Play Music](https://play.google.com/music)|音楽配信|any|
|[#181](https://github.com/meetfranz/plugins/issues/181)|[Franz recipe for soundcloud](https://github.com/j0weiss/franz-recipe-soundcloud)|[j0weiss](https://github.com/j0weiss)|no|[SoundCloud](https://soundcloud.com/)|音楽配信|🇺🇸|
|[#183](https://github.com/meetfranz/plugins/issues/183)|[YouTube Music for Franz](https://github.com/badetitou/franz-youtube-music)|[badetitou](https://github.com/badetitou)|no|[YouTube Music](https://music.youtube.com/)|音楽配信|any|
|[#270](https://github.com/meetfranz/plugins/issues/270)|[Purse](https://github.com/jooray/franz-recipes/tree/master/purse)|[jooray](https://github.com/jooray)|no|[purse.io](http://purse.io)|家計簿|🇺🇸|
|[#144](https://github.com/meetfranz/plugins/issues/144)|[Spendee Franz Plugin](https://github.com/gabrielecanepa/recipe-spendee)|[gabrielecanepa](https://github.com/gabrielecanepa)|no|[Spendee](https://spendee.com/)|家計簿|🇺🇸|
|[#216](https://github.com/meetfranz/plugins/issues/216)|[Unofficial Franz plugin for YNAB (You Need A Budget)](https://gitlab.com/davereid/franz-recipe-ynab)|[davereid](https://gitlab.com/davereid)|no|[YNAB](https://www.ynab.com/)|家計簿|🇺🇸|
|[#96](https://github.com/meetfranz/plugins/issues/96)|[This is a Franz recipe for ParcelTrack!](https://github.com/promarcel/franz-recipe-parceltrack)|[promarcel](https://github.com/promarcel)|no|[ParcelTrack](https://www.parceltrack.de/)|荷物管理|🇩🇪|
|[#105](https://github.com/meetfranz/plugins/issues/105)|[A Franz 5 plugin for the Amazing Marvin Task Manager](https://github.com/underyx/franz-recipe-amazingmarvin)|[underyx](https://github.com/underyx)|no|[Amazing Marvin](https://amazingmarvin.com/)|開発ツール|🇺🇸|
|[#221](https://github.com/meetfranz/plugins/issues/221)|[This is the unofficial Franz recipe for AWS Console](https://github.com/derevandal/aws-console-recipe)|[derevandal](https://github.com/derevandal)|no|[AWS Console](http:////console.aws.amazon.com)|開発ツール|🇺🇸|
|[#103](https://github.com/meetfranz/plugins/issues/103)|[fabric.io Franz Recipe](https://github.com/CavalcanteLeo/franz-fabric.io)|[CavalcanteLeo](https://github.com/CavalcanteLeo)|no|[Fabric.io](http://Fabric.io)|開発ツール|🇺🇸|
|[#113](https://github.com/meetfranz/plugins/issues/113)|[Franz recipe for Bitrise](https://github.com/danielbayley/franz-recipe-bitrise)|[danielbayley](https://github.com/danielbayley)|no|[Bitrise CI](https://bitrise.io)|継続的インテグレーション|🇺🇸|
|[#42](https://github.com/meetfranz/plugins/issues/42)|[Franz recipe for CircleCI](https://github.com/danielbayley/franz-recipe-circleci)|[danielbayley](https://github.com/danielbayley)|no|[CircleCI](https://circleci.com)|継続的インテグレーション|🇺🇸|
|[#67](https://github.com/meetfranz/plugins/issues/67)|[Franz recipe for Travis CI](https://github.com/danielbayley/franz-recipe-travis-ci)|[danielbayley](https://github.com/danielbayley)|no|[Travis CI](https://travis-ci.org)|継続的インテグレーション|🇺🇸|
|[#276](https://github.com/meetfranz/plugins/issues/276)|[A Franz recipe for 200 Words a Day](https://github.com/m1guelpf/franz-200wad)|[m1guelpf](https://github.com/m1guelpf)|no|[200 Words a Day](https://200wordsaday.com)|小説|🇺🇸|
|[#44](https://github.com/meetfranz/plugins/issues/44)|[Franz recipe for Octobox](https://github.com/danielbayley/franz-recipe-octobox)|[danielbayley](https://github.com/danielbayley)|no|[Octobox](https://octobox.io)|通知|🇺🇸|GitHub用の通知管理ツール|
|[#27](https://github.com/meetfranz/plugins/issues/27)|[Pushbullet Recipe for Franz](https://github.com/diegobersanetti/recipe-franz-pushbullet)|[diegobersanetti](https://github.com/diegobersanetti)|no|[Pushbullet](https://pushbullet.com)|通知|🇺🇸|
|[#89](https://github.com/meetfranz/plugins/issues/89)|[meetfranz.com (Franz 5) recipe for Pushover](https://github.com/jantman/franz-recipe-pushover)|[jantman](https://github.com/jantman)|no|[Pushover](https://pushover.net/)|通知|🇺🇸|
|[#49](https://github.com/meetfranz/plugins/issues/49)|[Restream for Franz](https://github.com/eightieskhild/Franz-recipes-restream.io)|[eightieskhild](https://github.com/eightieskhild)|no|[Restream.io](http://Restream.io)|配信|🇺🇸|
|[#36](https://github.com/meetfranz/plugins/issues/36)|[Twitch recipe for Franz 5](https://github.com/colinodell/franz-twitch)|[colinodell](https://github.com/colinodell)|no|[Twitch Chat](https://www.twitch.tv)|配信|any|
|[#182](https://github.com/meetfranz/plugins/issues/182)|[Google Translate for Franz](https://github.com/badetitou/franz-google-translate)|[badetitou](https://github.com/badetitou)|no|[Google Translate](https://translate.google.co.jp/)|翻訳|any|
|[#22](https://github.com/meetfranz/plugins/issues/22)|[A Franz 5.0 recipe to show a custom website](https://github.com/jvdmeij/recipe-franz-website)|[jvdmeij](https://github.com/jvdmeij)|yes|Custom website|any|どんなページでも表示可能なrecipe|

## 参考

* [Issues · meetfranz/plugins](https://github.com/meetfranz/plugins/issues?utf8=%E2%9C%93&q=%5BDeploy%5D)
