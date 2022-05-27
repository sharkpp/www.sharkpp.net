---
title: "Synology のパッケージのビルド方法について調べてみた"
date: 2021-09-07 22:05
tags: [Synology, NAS, DSM, Linux, Docker]
categories: [ブログ]

---

Synology の NAS で利用可能なパッケージを作ってみようと思い、色々と調べてみました。
調べている最中に DSM 7.0 も正式リリースされたので、合わせてそのバージョンも調査の対象としました。

また、macOSでパッケージを作る場合の方法についても書きました。

[<img src="{{ thumbnail('/images/20210907_dsm7_pkg_install_wizard_04.png', 640, 640) }}" alt="パッケージインストールウィザード4">](/images/20210907_dsm7_pkg_install_wizard_04.png)

## パッケージのビルドに必要な環境

ほぼ同じですが例としてあげられているUbuntuのLTSバージョンに変更がされているようです。

||6.2|7.0|
|-|-|-|
|OS|64bitの一般的なLinux環境</br>(例として Ubuntu 16.04 LTS)|64bitの一般的なLinux環境とルート権限</br>(例として Ubuntu 18.04 LTS)|
|bash|>= 4.1.5|>= 4.1.5|
|Python|>= 2.7.3|>= 2.7.3|

どちらも、NASに直接インストールすることはせず、必要であれば Docker パッケージをインストールしてツールキットを動かしてほしいと書かれています。

macOS は残念ながら一般的なLinux環境ではないので [synology-toolkit-for-non-linux](https://github.com/sharkpp/synology-toolkit-for-non-linux) というソリューションを作って開発できるようにしてみました。

## DSM 6 と DSM 7 とのパッケージのビルド手順の違い

どちらも `EnvDeploy` や `PkgCreate․py` への引数の与え方に違いはなさそうです。

ただ、処理の内容には多少の違いがあるようです。

### DSM 6.x

利用可能なプラットフォーム：

> 6281 alpine alpine4k apollolake armada370 armada375 armada37xx armada38x armadaxp avoton braswell broadwell broadwellnk bromolow cedarview comcerto2k denverton dockerx64 evansport geminilake grantley hi3535 kvmx64 monaco purley qoriq rtd1296 v1000 x64

1. `pkgscripts/EnvDeploy -v 6.2 -p x64`
2. `pkgscripts/PkgCreate.py -v 6.2 -p x64 -c ExamplePackage`

### DSM 7.x

利用可能なプラットフォーム：

> bromolow cedarview armadaxp armada370 armada375 evansport comcerto2k avoton alpine braswell apollolake grantley alpine4k monaco broadwell kvmx64 armada38x denverton rtd1296 broadwellnk purley armada37xx geminilake v1000

1. `pkgscripts-ng/EnvDeploy -v 7.0 -p braswell`
2. `pkgscripts-ng/PkgCreate.py -v 7.0 -p braswell -c ExamplePackage`

破壊的変更により署名のフェーズがなくなっているようで指定可能な引数が少し変わっていました。

## パッケージ手動のインストール

出来たパッケージを試すには、Synology NAS にログインし、パッケージセンターから「手動インストール」を行うことで可能です。

[<img src="{{ thumbnail('/images/20210907_dsm7_pkg_install_wizard_01.png', 640, 640) }}" alt="パッケージインストールウィザード1">](/images/20210907_dsm7_pkg_install_wizard_01.png) [<img src="{{ thumbnail('/images/20210907_dsm7_pkg_install_wizard_02.png', 640, 640) }}" alt="パッケージインストールウィザード2">](/images/20210907_dsm7_pkg_install_wizard_02.png) [<img src="{{ thumbnail('/images/20210907_dsm7_pkg_install_wizard_03.png', 640, 640) }}" alt="パッケージインストールウィザード3">](/images/20210907_dsm7_pkg_install_wizard_03.png) [<img src="{{ thumbnail('/images/20210907_dsm7_pkg_install_wizard_04.png', 640, 640) }}" alt="パッケージインストールウィザード4">](/images/20210907_dsm7_pkg_install_wizard_04.png)

インストールすると、試した ExamplePackage では、こんな感じにアイコンなどが設置されました。

[<img src="{{ thumbnail('/images/20210907_dsm7_pkg_installed_01.png', 640, 640) }}" alt="パッケージインストール後1">](/images/20210907_dsm7_pkg_installed_01.png) [<img src="{{ thumbnail('/images/20210907_dsm7_pkg_installed_02.png', 640, 640) }}" alt="パッケージインストール後2">](/images/20210907_dsm7_pkg_installed_02.png) [<img src="{{ thumbnail('/images/20210907_dsm7_pkg_installed_03.png', 640, 640) }}" alt="パッケージインストール後3">](/images/20210907_dsm7_pkg_installed_03.png)

なお、後述のパッケージのお作法がちゃんとされていないと、インストール時に「ファイル形式が正しくありません、パッケージ管理者に連絡してください」("Invalid file format. Please contact the package developer.") と表示されるようです。

[<img src="{{ thumbnail('/images/20210907_dsm7_pkg_invalid_file_type.png', 640, 640) }}" alt="ファイル形式が正しくありません">](/images/20210907_dsm7_pkg_invalid_file_type.png)

## DSM 6.x から 7.0 へ実装を変更する場合の主な変更点

[DSM Developer Guide 7.0 BETA](https://global.download.synology.com/download/Document/Software/DeveloperGuide/Firmware/DSM/7.0/enu/DSM_Developer_Guide_7_0_Beta.pdf) の `Breaking Changes in 7.0` (7.0 での破壊的変更) によると、DSM 6.x から DSM 7.x へは、パッケージフレームワークの次の点が変更されているようです。
下記の内容に従っていないと、パッケージのビルドが成功してもインストールすることができないなどが起こるようです。

|#|項目|DSM 6.x|DSM 7.x|
|-|-|-|-|
|1|[`conf/privilege`](https://help.synology.com/developer-guide/privilege/privilege_config.html)|低い特権での実行をサポートしていないパッケージの場合は必須ではない|必須|
|2|`INFO.sh`|必須ではない|`package`</br>`version`</br>`os_min_ver="7.0-40000"` ※もしくはそれ以上</br>`description`</br>`arch`</br>`maintainer`</br>以上のフィールドが必要。</br>そうでないない場合は、ビルドは成功するがインストール時に「ファイル形式が正しくありません、パッケージ管理者に連絡してください」("Invalid file format. Please contact the package developer.") と表示される。 |
|3|パッケージ署名|必要|不要(つまり、gnupg も不要)|
|4|`conf/privilege` `defaults.run-as`|`"package"`</br>`"system"`</br>`"root"`|`"package"`</br>`"root"`</br>特権操作はリソースワーカー経由での実行へ変更が必要 |
|5|ホームパス|`/var/packages/[package_name]/target`|`/var/packages/[package_name]/home`</br>権限は `0700` `(rwx------)`|
|6|`PACKAGE_ICON.PNG`|72 x 72|64 x 64|
|7|FHS ディレクトリの所有者||`target` などの FHS ディレクトリは `conf/privilege` に従って新しい特権設定が行われます。|
|8|パッケージログの場所|`/var/log/synopkg.log`|パッケージ操作ログ：`/var/log/synopkg.log`</br>コントロールスクリプトログ：`/var/log/packages/[package_name].log`|
|9|システム起動時の開始確認|されない|`INFO.sh`の`precheckstartstop="yes"`の場合にされる|

## PkgCreate․py の使い方

とりあえず `pkgscripts/PkgCreate.py -v {バージョン} -p {プラットフォーム} -c {パッケージ名}` でことは足りる。

```console
usage: PkgCreate.py [-h] [-p PLATFORMS] [-e ENV_SECTION] [-v ENV_VERSION] [-x DEP_LEVEL] [-X PARALLEL_PROJ] [-b BRANCH] [-s SUFFIX] [-c] [--no-collecter] [-L] [-l] [-B] [-I] [-i]
                    [-P PARALLEL] [--build-opt BUILD_OPT] [--install-opt INSTALL_OPT] [--print-log] [--no-tee] [--min-sdk SDK_VER]
                    package

固定引数:
  package               対象のパッケージ

オプションの引数:
  -h, --help            このヘルプメッセージを表示して終了
  -p PLATFORMS          ターゲットプラットフォームを指定。 省略時では、build_env/ 以下の利用可能なプラットフォームを検出。
  -e ENV_SECTION, --env ENV_SECTION
                        環境セクションを SynoBuildConf/depends で指定。省略時は [default] 。
  -v ENV_VERSION, --version ENV_VERSION
                        ターゲットDSMバージョンを手動で指定。
  -x DEP_LEVEL          ビルド依存レベルを指定
  -X PARALLEL_PROJ      SynoBuild　並列ビルドプロジェクト。 0 は 2 つの並列ジョブでビルドすることを意味。
  -b BRANCH             パッケージのブランチを指定。
  -s SUFFIX             ビルド環境のフォルダのサフィックス (build_env/) を指定。
  -c                    パッケージを収集。
  --no-collecter        すべての収集動作をスキップ。
  -L                    プロジェクトをリンクしません。
  -l                    プロジェクトを更新してリンク。
  -B                    プロジェクトを構築しない。
  -I                    プロジェクトをインストールしない。
  -i                    プロジェクトのみをインストール。
  -P PARALLEL           並列プラットフォーム、省略時は 2
  --build-opt BUILD_OPT 
                        SynoBuild への引数パス
  --install-opt INSTALL_OPT
                        SynoInstall への引数パス
  --print-log           SynoBuild/SynoInstall のエラーログを印字。
  --no-tee              stdout/stderr　をログに記録しません。
  --min-sdk SDK_VER     最小 SDK バージョン、省略時=6.2
```

## EnvDeploy や PkgCreate․py などで利用可能なプラットフォーム

型番からプラットフォームを調べる場合は [What kind of CPU does my Synology NAS have?](https://kb.synology.com/en-global/DSM/tutorial/What_kind_of_CPU_does_my_NAS_have) を参照する。

|プラットフォーム|6.2|7.0|
|-|-|-|
|6281       |利用可能|−|
|dockerx64  |利用可能|−|
|hi3535     |利用可能|−|
|qoriq      |利用可能|−|
|x64        |利用可能|−|
|alpine     |利用可能|利用可能|
|alpine4k   |利用可能|利用可能|
|apollolake |利用可能|利用可能|
|armada370  |利用可能|利用可能|
|armada375  |利用可能|利用可能|
|armada37xx |利用可能|利用可能|
|armada38x  |利用可能|利用可能|
|armadaxp   |利用可能|利用可能|
|avoton     |利用可能|利用可能|
|braswell   |利用可能|利用可能|
|broadwell  |利用可能|利用可能|
|broadwellnk|利用可能|利用可能|
|bromolow   |利用可能|利用可能|
|cedarview  |利用可能|利用可能|
|comcerto2k |利用可能|利用可能|
|denverton  |利用可能|利用可能|
|evansport  |利用可能|利用可能|
|geminilake |利用可能|利用可能|
|grantley   |利用可能|利用可能|
|kvmx64     |利用可能|利用可能|
|monaco     |利用可能|利用可能|
|purley     |利用可能|利用可能|
|rtd1296    |利用可能|利用可能|
|v1000      |利用可能|利用可能|

## macOSでパッケージをビルドするには？

macOS で簡単にパッケージがビルドできるように [synology-toolkit-for-non-linux](https://github.com/sharkpp/synology-toolkit-for-non-linux) というソリューションを作りました。

使い方は、まずレポジトリを clone して、環境を構築。

```console
$ git clone https://github.com/sharkpp/synology-toolkit-for-non-linux.git
$ cd synology-toolkit-for-non-linux
$ docker/build.sh
```

次に、 `EnvDeploy` でツールキットをダウンロード

```console
$ pkgscripts/EnvDeploy -v 7.0 -p braswell
```

最後に `source` フォルダにパッケージのソースを入れ `PkgCreate․py` でビルド。
ここでは [`ExamplePackage`](https://github.com/SynologyOpenSource/ExamplePackages/tree/main/ExamplePackage) を利用。

```console
$ git clone https://github.com/SynologyOpenSource/ExamplePackages.git source/ExamplePackages
$ mv source/ExamplePackages/ExamplePackage source
$ pkgscripts/PkgCreate.py -v 7.0 -p braswell -c ExamplePackage
```

`result_spk` フォルダにビルドされたパッケージが置かれます。

## 参考になりそうなパッケージ

[Search · os_min_ver filename:INFO](https://github.com/search?q=os_min_ver+filename%3AINFO&type=Code&ref=advsearch&l=&l=) で適当に検索してリストアップしてみました。

|パッケージ名|DSM|概要|
|-|-|-|
|[`ExamplePackage`](https://github.com/SynologyOpenSource/ExamplePackages/tree/main/ExamplePackage)|7.0|公式サンプルパッケージ|
|[`nmap`](https://github.com/SynologyOpenSource/ExamplePackages/tree/main/nmap)|7.0|公式サンプル nmap パッケージ|
|[`synology-package-template`](https://github.com/prabirshrestha/synology-package-template)|7.0/6.x|サンプルパッケージ|
|[`Tailscale package`](https://github.com/tailscale/tailscale-synology)|7.0/6.x|Tailscale VPN パッケージ？|
|[`TorrServer package`](https://github.com/vladlenas/Synology-TorrServer)|7.0/6.x|TorrServerパッケージ|
|[`WireGuard package`](https://github.com/runfalk/synology-wireguard)|7.0/6.x|WireGuardパッケージ|
|[`autorun`](https://github.com/reidemei/synology-autorun)|7.0/6.x|Synology NASで外付けドライブ（USB / eSATA）を接続するときにスクリプトを実行|

## 参考

* [GitHub - SynologyOpenSource/pkgscripts-ng at DSM6.0](https://github.com/SynologyOpenSource/pkgscripts-ng/tree/DSM6.0)
* [Prepare Envrionment · GitBook](https://help.synology.com/developer-guide/getting_started/prepare_environment.html)
* [Unable to Sign package with GPG key · Issue #5 · SynologyOpenSource/minimalPkg · GitHub](https://github.com/SynologyOpenSource/minimalPkg/issues/5)
* [Docker Ubuntu18.04でtzdataをinstallするときにtimezoneの選択をしないでinstallする - Qiita](https://qiita.com/yagince/items/deba267f789604643bab)
* [Synology NAS に搭載されている CPU の種類は？ - Synology ナレッジセンター](https://kb.synology.com/ja-jp/DSM/tutorial/What_kind_of_CPU_does_my_NAS_have)
* [DSM Developer Guide 7.0 BETA](https://global.download.synology.com/download/Document/Software/DeveloperGuide/Firmware/DSM/7.0/enu/DSM_Developer_Guide_7_0_Beta.pdf)
* [Synology DSM6.0 Developer Guide](https://global.download.synology.com/download/Document/Software/DeveloperGuide/Firmware/DSM/6.0/enu/DSM_Developer_Guide_6_0.pdf)
