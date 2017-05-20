/*******************************************************************************
  The MIT License

  Copyright (c) 2008 Shark++ Software.

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

  Copyright (c) 2008 Shark++ Software.

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

function toggle_trackback_lightbox()
{
	var body = document.getElementsByTagName('body').item(0);
	var lightbox;

	lightbox = $('trackback-lightbox');
	if( lightbox ) {
		lightbox.parentNode.removeChild(lightbox);
	} else {
		lightbox = document.createElement('div');
		lightbox.id = 'trackback-lightbox';
		Event.observe(lightbox, 'click', toggle_trackback_delete_popup);
		body.appendChild(lightbox);
	}
}


function toggle_trackback_delete_popup()
{
	var popup = $('trackback-popup-delete');
	var del_link = $('trackback-popup-delete-link');

	toggle_trackback_lightbox();

	if( this.hrefOrg )
		del_link.href = this.hrefOrg;

	center(popup);
	Element.toggle(popup);
}

Event.observe(window, 'load', function() {
	var del_link_list = $$('.trackback-body-col-delete a');
	for(var i = 0, o; o = del_link_list[i]; i++) {
		o.hrefOrg = o.href;
		o.href = "javascript:void(0);";
		Event.observe(o, 'click', toggle_trackback_delete_popup);
	}
});

