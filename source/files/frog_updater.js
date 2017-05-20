/*******************************************************************************
  The MIT License

  Copyright (c) 2008-2009 Shark++ Software.

  Permission is hereby granted, free of charge, to any person obtaining a copy
  of this software and associated documentation files (the "Software"), to deal
  in the Software without restriction, including without limitation the rights
  to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  copies of the Software, and to permit persons to whom the Software is
  furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in
  all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
  IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
  FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
  AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
  LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
  OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
  THE SOFTWARE.

 ==============================================================================
  参考として The MIT License の日本語訳を下記に併記しますが、頒布条件としては、
  上記原文に従ってください。
 ==============================================================================

  The MIT License

  Copyright (c) 2008-2009 Shark++ Software.

  以下に定める条件に従い、本ソフトウェアおよび関連文書のファイル
  （以下「ソフトウェア」）の複製を取得するすべての人に対し、ソフトウェアを
  無制限に扱うことを無償で許可します。これには、ソフトウェアの複製を使用、
  複写、変更、結合、掲載、頒布、サブライセンス、および/または販売する権利、
  およびソフトウェアを提供する相手に同じことを許可する権利も無制限に含まれ
  ます。

  上記の著作権表示および本許諾表示を、ソフトウェアのすべての複製または重要
  な部分に記載するものとします。

  ソフトウェアは「現状のまま」で、明示であるか暗黙であるかを問わず、何らの
  保証もなく提供されます。ここでいう保証とは、商品性、特定の目的への適合性、
  および権利非侵害についての保証も含みますが、それに限定されるものではあり
  ません。作者または著作権者は、契約行為、不法行為、またはそれ以外であろう
  と、ソフトウェアに起因または関連し、あるいはソフトウェアの使用またはその
  他の扱いによって生じる一切の請求、損害、その他の義務について何らの責任も
  負わないものとします。 
 *******************************************************************************/

function toggle_frog_updater_lightbox()
{
	var body = document.getElementsByTagName('body').item(0);
	var lightbox = $('frog-updater-lightbox');

	if( lightbox ) {
		body.removeChild(lightbox);
	} else {
		lightbox = document.createElement('div');
		lightbox.id = 'frog-updater-lightbox';
		body.appendChild(lightbox);
	}
}

function toggle_frog_updater_popup(id)
{
	var body = document.getElementsByTagName('body').item(0);
	var content = $('content');

	toggle_frog_updater_lightbox();

	content.appendChild($('popups'));
	var popup = $(id);

	popup.style.width = Element.getDimensions(popup).width + 'px';
	center(popup);
	Element.toggle(popup);
}

function frog_upgrade_complete(o)
{
	var json; eval('json='+o.responseText);
	if( 'successful' == json.status ) {
		toggle_frog_updater_popup('frog-updater-popup-updating');
		toggle_frog_updater_popup('frog-updater-popup-upgrade-successful');
		var result = $('frog-updater-popup-upgrade-successful-summary');
		for(var i = 0, summary, summarys = json.summary.split(/[\n\r]+/);
			summary = summarys[i]; i++) {
			result.appendChild( document.createElement('li') ).innerHTML = summary;
		}
	} else if( 'continues' == json.status ) {
		var result = $('frog-updater-popup-updating-message');
		result.innerHTML = json.summary;
		do_frog_upgrade_core(json.next);
	} else {
		frog_upgrade_failure(o);
	}
}

function frog_upgrade_failure(o)
{
	var json; eval('json='+o.responseText);
	if( 'undefind' == typeof json.summary )
		json.summary = 'Unknown error';
	toggle_frog_updater_popup('frog-updater-popup-updating');
	toggle_frog_updater_popup('frog-updater-popup-upgrade-failure');
	var result = $('frog-updater-popup-upgrade-failure-message');
	result.innerHTML = json.summary;
	Element.toggle($('frog-updater-popup-upgrade-faild-title'));
}

function frog_upgrade_exception(o, exception)
{
//	var json; eval('json='+o.responseText);
	toggle_frog_updater_popup('frog-updater-popup-updating');
	toggle_frog_updater_popup('frog-updater-popup-upgrade-failure');
	var result = $('frog-updater-popup-upgrade-failure-message');
	result.innerHTML = exception.toString();
	Element.toggle(result);
}

function do_frog_upgrade_core(url) {
	return new Ajax.Request(
			url,
				{
					method: 'get',
					onComplete: frog_upgrade_complete,
					onFailure: frog_upgrade_failure,
					onException: frog_upgrade_exception
				}
		);
}

function do_frog_upgrade() {
	toggle_frog_updater_popup('frog-updater-popup');
	toggle_frog_updater_popup('frog-updater-popup-updating');
	Element.toggle($('busy'));
	return do_frog_upgrade_core(location.href+'/activate_plugin/frog_updater/1');
}

if( 'undefined' != typeof Event.observe )
{
	Event.observe(window, 'load', function() {
		var body = document.getElementsByTagName('body').item(0);
		var head = document.getElementsByTagName('head').item(0);
		var html = body.parentNode;

		toggle_frog_updater_popup('frog-updater-popup');

		// CSS読み込み
		var link = document.createElement('link');
		link.type = 'text/css';
		link.rel  = 'Stylesheet';
		link.media= 'screen';
		link.href = '../frog/plugins/frog_updater/frog_updater.css';
		head.appendChild(link);
	});
}

