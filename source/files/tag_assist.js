/*******************************************************************************
  The MIT License

  Copyright (c) 2009 Shark++ Software.

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

  Copyright (c) 2009 Shark++ Software.

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

var TagAssist = Class.create();
TagAssist.prototype = {
	initialize: function(tagInput, tagSeparator, tagList)
		{
			tagInput = $(tagInput);
			if( 'undefined' == typeof tagSeparator )
				tagSeparator = ',';
			this.tagList      = tagList;
			this.tagListEnable= 'undefined' != typeof tagList;
			this.tagSeparator = tagSeparator;
			this.tagInput     = tagInput;
			var tagContainer = document.createElement('span');
			this.tagInput.parentNode.insertBefore(tagContainer, this.tagInput);
			this.tagInput.style.cssText = "display: none;";
			tagContainer.className = "tag-container";
			var innerContainer = tagContainer.appendChild(document.createElement('span'));
			innerContainer.className = "tag-inner-container";
			var innerContainer2 = innerContainer.appendChild(document.createElement('span'));
			innerContainer2.className = "tag-inner-container2";
			Event.observe(innerContainer2, 'click', this.onFocus.bindAsEventListener(this));
			this.tagInputbox = innerContainer2.appendChild(document.createElement('input'));
			this.tagInputbox.className = "last";
			this.tagInputbox.type = "text";
			this.tagInputbox.style.cssText = "border: 0px none black;";
			Event.observe(this.tagInputbox, 'keydown',  this.onKeyDown.bindAsEventListener(this));
			Event.observe(this.tagInputbox, 'keypress', this.onKeyPress.bindAsEventListener(this));
			Event.observe(this.tagInputbox, 'blur',     this.onBlurIb.bindAsEventListener(this));
			Event.observe(this.tagInputbox, 'focus',    this.onFocusIb.bindAsEventListener(this));
			Event.observe(this.tagInputbox, 'click',    this.onFocusIb.bindAsEventListener(this));
			var initTags = "" != this.tagInput.defaultValue ? this.tagInput.defaultValue
			                                                : this.tagInput.value;
			initTags = initTags.split(this.tagSeparator);
			this.tagInput.value = "";
			this.tagInput.defaultValue = "";
			for(var i = 0, tag; tag = initTags[i]; i++)
				this.tagAppend(this.tagInputbox, tag);
			this.tagUpdate();
			// タグリスト
			this.tagListSelectIndex = -1;
			this.tagListBase = innerContainer.parentNode.appendChild(document.createElement('div'));
			this.tagListBase.className = "tag-list";
			var ul = this.tagListBase.appendChild(document.createElement('ul'));
			if( this.tagListEnable )
			{
				for(var i = 0, tag; tag = tagList[i]; i++) {
					var li = ul.appendChild(document.createElement('li'));
					li.innerHTML = tag;
					Event.observe(li, 'click',     this.onClickTl.bindAsEventListener(this));
					Event.observe(li, 'mouseover', this.onMouseOverTl.bindAsEventListener(this));
					Event.observe(li, 'mouseout',  this.onMouseOutTl.bindAsEventListener(this));
				}
			}
			Element.hide(this.tagListBase);
		},
	tagUpdate: function()
		{
			var innerContainer = this.tagInputbox.parentNode;
			var tag = "";
			for(var i = 0, elm, nodes = innerContainer.childNodes;
				elm = nodes[i]; i++)
			{
				if( "tag-node" == elm.className ) {
					tag += ("" == tag ? "" : this.tagSeparator);
					tag += elm.firstChild.nodeValue;
				}
			}
			this.tagInput.value = tag;
			this.tagInput.defaultValue = tag;
		},
	tagAppend: function(baseNode, tagText)
		{
			var tagNode = baseNode.parentNode.insertBefore(document.createElement('span'), baseNode);
			tagNode.className = "tag-node";
			tagNode.appendChild(document.createTextNode(tagText.strip()));
			var tagNodeDelete = tagNode.appendChild(document.createElement('a'));
			tagNodeDelete.className = "tag-node-delete";
			tagNodeDelete.href = "javascript:void(0);";
			tagNodeDelete.title = "delete";
			Event.observe(tagNodeDelete, 'mousedown', this.onTagDelete.bindAsEventListener(this));
			Event.observe(tagNodeDelete, 'focus',     this.onFocus.bindAsEventListener(this));
			this.tagUpdate();
		},
	tagDelete: function(node)
		{
			node.parentNode.removeChild(node);
			this.tagInputbox.focus();
			this.tagUpdate();
		},
	ensureVisible: function(element)
		{
			if( null != element &&
				null != element.parentNode &&
				null != element.parentNode.parentNode )
			{
				var parent = element.parentNode.parentNode;
				var parentPos = Element.cumulativeOffset(parent);
				var elementPos = Element.cumulativeOffset(element);
				var elementTop = elementPos.top - parentPos.top;
				var elementHeight = Element.getHeight(element);
				var parentHeight = Element.getHeight(parent);
				if( elementTop < parent.scrollTop ) {
					do {
						parent.scrollTop -= elementHeight;
					} while( elementTop < parent.scrollTop - elementHeight );
				} else if( parent.scrollTop + parentHeight < elementTop + elementHeight ) {
					do {
						parent.scrollTop += elementHeight;
					} while( parent.scrollTop + parentHeight < elementTop );
				}
			}
		},
	tagListSearch: function(tagTarget)
		{
			for(var i = 0, tag; tag = this.tagList[i]; i++) {
				if( tagTarget.match(tag) ) {
					return i;
				}
			}
			return -1;
		},
	tagListSelect: function(index)
		{
			this.tagListSelectIndex = -1;
			var tagValue = "";
			var elmTagList = this.tagListBase.firstChild.childNodes;
			var elmTag = null;
			for(var i = 0, elm; elm = elmTagList[i]; i++) {
				if( i == index ) {
					this.tagListSelectIndex = index;
					elm.className = "select";
					tagValue = elm.innerHTML;
					elmTag   = elm;
				} else {
					elm.className = "";
				}
			}
			this.ensureVisible(elmTag);
			return tagValue;
		},
	onTagDelete: function(e)
		{
			var elm = Event.element(e);
			this.tagDelete(elm.parentNode);
		},
	onBlurIb: function(e)
		{
			var elm = this.tagInputbox;
			if( this.tagListEnable )
			{
				this.onBlurIbDelay.cancel = false;
				this.onBlurIbDelay.bind(this).delay(0.2);
				return;
			}
			if( "" != elm.value )
				this.tagAppend(elm, elm.value);
			elm.value = "";
		},
	onBlurIbDelay: function()
		{
			var elm = this.tagInputbox;
			if( this.onBlurIbDelay.cancel )
				return;
			if( this.tagListEnable )
			{
				Element.hide(this.tagListBase);
			}
			if( "" != elm.value )
				this.tagAppend(elm, elm.value);
			elm.value = "";
		},
	onFocusIb: function(e)
		{
			if( this.tagListEnable )
			{
				this.tagListSelect(-1);
				Element.show(this.tagListBase);
			}
		},
	onFocus: function(e)
		{
			this.tagInputbox.focus();
		},
	onClickTl: function(e)
		{
			var elm = Event.element(e);
			this.onBlurIbDelay.cancel = true;
			this.tagAppend(this.tagInputbox, elm.innerHTML);
			this.tagInputbox.value = "";
			this.tagInputbox.focus();
			if( Prototype.Browser.IE )
				Element.hide.delay(0.2, this.tagListBase);
			else
				Element.hide(this.tagListBase);
		},
	onMouseOverTl: function(e)
		{
			var elm = Event.element(e);
			elm.className = "select";
		},
	onMouseOutTl: function(e)
		{
			var elm = Event.element(e);
			elm.className = "";
		},
	onKeyDown: function(e)
		{
			var elm = Event.element(e);
			switch( e.keyCode ) {
			default:
				if( this.tagListEnable ) {
					var selectIndex = this.tagListSearch(elm.value);
					this.tagListSelect(selectIndex);
				}
				return;
			case Event.KEY_RETURN:
				if( "" != elm.value )
					this.tagAppend(elm, elm.value);
				if( this.tagListEnable ) {
					this.tagListSelect(-1);
				}
				elm.value = "";
				break;
			case Event.KEY_BACKSPACE:
				if( "" != elm.value )
					return;
				if( null != elm.previousSibling)
					this.tagDelete(elm.previousSibling);
				break;
			case Event.KEY_DELETE:
				if( "" != elm.value )
					return;
				if( null != elm.nextSibling )
					this.tagDelete(elm.nextSibling);
				break;
			case Event.KEY_LEFT:
				if( "" != elm.value )
					return;
				var tagNode = elm.previousSibling;
				if( null == tagNode  )
					return;
				var tagInputbox = elm;
				tagNode.parentNode.insertBefore(tagNode, tagInputbox.nextSibling);
				tagInputbox.className = "";
				tagInputbox.focus();
				break;
			case Event.KEY_RIGHT:
				if( "" != elm.value )
					return;
				var tagNode = elm.nextSibling;
				if( null == tagNode )
					return;
				var tagInputbox = elm;
				elm.parentNode.removeChild(tagNode);
				elm.parentNode.insertBefore(tagNode, tagInputbox);
				if( null == tagInputbox.nextSibling )
					tagInputbox.className = "last";
				tagInputbox.focus();
				break;
			case Event.KEY_UP:
				if( !this.tagListEnable )
					return;
				var selectIndex = this.tagListSelectIndex;
				selectIndex--;
				elm.value = this.tagListSelect(selectIndex);
				elm.selectionStart = 0;
				elm.selectionEnd   = elm.value.length;
				break;
			case Event.KEY_DOWN:
				if( !this.tagListEnable )
					return;
				var selectIndex = this.tagListSelectIndex;
				selectIndex++;
				if( selectIndex < this.tagList.length )
					elm.value = this.tagListSelect(selectIndex);
				elm.selectionStart = 0;
				elm.selectionEnd   = elm.value.length;
				break;
			}
			Event.stop(e);
		},
	onKeyPress: function(e)
		{
			var elm = Event.element(e);
			switch( e.keyCode ) {
			default:
				if( this.tagSeparator == String.fromCharCode(e.charCode) ||
					'\"' == String.fromCharCode(e.charCode) )
					break;
				return;
			}
			Event.stop(e);
		}
};
