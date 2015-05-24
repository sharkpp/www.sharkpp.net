---
title: "PC-G850S/PC-G850V/PC-G850VS 性能比較"
date: 2009-03-29 23:42:00
tags: [ポケコン]
categories: [ポケコン]

---

## 始めに

この資料は`PC-G850S`と`PC-G850V`、`PC-G850VS`の仕様・性能を比較した非公式な資料ですので、 記述が足りない所や内容が間違っている事があるかもしれません。 そのことを考慮して参照していただければ幸いです。

## 各プログラムの実行方法

### 仕様

<table border="1" summary=""><tr>
<th>
<br />
</th>
<th>
PC-G850S
</th>
<th>
PC-G850V
</th>
<th>
PC-G850VS
</th>
</tr>
<tr>
<th>
定格電圧
</th>
<td colspan="3" align="center">
DC6V
</td>
</tr>
<tr>
<th>
定格消費電力
</th>
<td align="center">
0.4W
</td>
<td colspan="2" align="center">
0.2W
</td>
</tr>
<tr>
<th>
使用電池
</th>
<td colspan="3" align="center">
単４形×4
</td>
</tr>
<tr>
<th>
使用温度
</th>
<td colspan="3" align="center">
0℃〜40℃
</td>
</tr>
<tr>
<th>
電池使用時間
</th>
<td align="center">
約70h
</td>
<td colspan="2" align="center">
約90h
</td>
</tr>
<tr>
<th>
外形寸法(幅×奥行×厚さ)
</th>
<td align="center">
195mm×95mm×20mm
</td>
<td colspan="2" align="center">
196mm×95mm×20mm
</td>
</tr>
<tr>
<th>
質量
</th>
<td colspan="2" align="center">
約270g(乾電池を含み、ハードカバーは除く)
</td>
<td align="center">
約260g(乾電池を含み、ハードカバーは除く)
</td>
</tr>
<tr>
<th>
液晶<br />コントラスト<br />(DARK→LIGHT)
</th>
<td align="center">
<a href="/pokecom/image/850s_lcd.jpg"><img src="/pokecom/image/850s_lcds.jpg" title="PC-G850Sの液晶画面" /></a>
</td>
<td align="center">
<a href="/pokecom/image/850v_lcd.jpg"><img src="/pokecom/image/850v_lcds.jpg" title="PC-G850Vの液晶画面" /></a>
</td>
<td align="center">
<a href="/pokecom/image/850vs_lcd.jpg"><img src="/pokecom/image/850vs_lcds.jpg" title="PC-G850VSの液晶画面" /></a>
</td>
</tr>
<tr>
<th>
梱包箱
</th>
<td align="center">
<a href="/pokecom/image/850s_box.jpg"><img src="/pokecom/image/850s_boxs.jpg" title="PC-G850Sの梱包箱" /></a>
</td>
<td align="center">
<a href="/pokecom/image/850v_box.jpg"><img src="/pokecom/image/850v_boxs.jpg" title="PC-G850Vの梱包箱" /></a>
</td>
<td align="center">
<a href="/pokecom/image/850vs_box.jpg"><img src="/pokecom/image/850vs_boxs.jpg" title="PC-G850VSの梱包箱" /></a>
</td>
</tr>
</table>

### PC-G850S から PC-G850V への変更点

<table border="1" summary=""><tr>
<th>
廃止機能
</th>
<td>
カセットへの記録、読み込み、照合(Cmt)
</td>
</tr>
<tr>
<th>
追加機能
</th>
<td>
PIC書き込み(外付け装置が必要)
</td>
</tr>
<tr>
<th>
追加命令
</th>
<td>
<code>A命令(オート)</code><br /> <code>AUTO命令</code><br /> <code>BLOAD</code><br /> <code>BLOAD M</code><br /> <code>BLOAD?</code><br /> <code>BSAVE</code><br /> <code>BSAVE M</code>
</td>
</tr>
<tr>
<th>
廃止命令
</th>
<td>
<code>CLOAD</code><br /> <code>CLOAD M</code><br /> <code>CLOAD?</code><br /> <code>CSAVE</code><br /> <code>CSAVE M</code>
</td>
</tr>
<tr>
<th>
マニュアルの変更点
</th>
<td>
<ul>
<li>
カセットへの記録、読み込み、照合(テキストエディタ)
</li>
<li>
A命令の説明の追加(テキストエディタ)
</li>
<li>
AUTOの説明の追加(BASICの各命令の説明)
</li>
<li>
fopen()の注意書き(C言語機能)
</li>
<li>
PIC
</li>
<li>
エラーコード表内のカセット読み書き関係の記述(付録)
</li>
</ul>
</td>
</tr>
</table>

### PC-G850V から PC-G850VS への変更点

<table border="1" summary=""><tr>
<th>
外装の変更点
</th>
<td>
<ul>
水色をベースにした箱から白をベースにした箱へ変更
</ul>
</td>
</tr>
<tr>
<th>
マニュアルの変更点
</th>
<td>
<ul>
<li>
機械語モニタとアセンブラ機能の「アセンブラリストをミニI/Oから送出する方法」が削除
</li>
<li>
PICローダーの記述が削除<!-- (指導用マニュアルに移動？) -->
</li>
<li>
付録のPIC関連の記述
</li>
</ul>
</td>
</tr>
</table>

### 処理速度比較

各リストのプログラムは[天つ風(うえのまさひろさん)][1]の所の物を使いました。 表の計測結果は、5回分の平均です。 

 [1]: http://earthgale.ram.ne.jp/

<table border="1" summary=""><tr>
<th>
<br />
</th>
<th>
PC-G850S
</th>
<th>
PC-G850V
</th>
<th>
PC-G850VS
</th>
</tr>
<tr>
<th>
List 1
</th>
<td align="right">
9.47s
</td>
<td align="right">
10.56s
</td>
<td align="right">
10.59s
</td>
</tr>
<tr>
<th>
List 2
</th>
<td align="right">
6.59s
</td>
<td align="right">
6.71s
</td>
<td align="right">
6.77s
</td>
</tr>
<tr>
<th>
List 3
</th>
<td align="right">
2.50s
</td>
<td align="right">
2.58s
</td>
<td align="right">
2.58s
</td>
</tr>
<tr>
<th>
List 4
</th>
<td align="right">
13.88s
</td>
<td align="right">
12.80s
</td>
<td align="right">
12.89s
</td>
</tr>
</table>

### 履歴

2005/07/17
: 公開

2009/03/29
: PC-G850VSの記述を追加

2009/03/31
: PC-G850VSのLCD写真の追加、梱包箱の写真の追加

2010/03/15
: 誤字修正
