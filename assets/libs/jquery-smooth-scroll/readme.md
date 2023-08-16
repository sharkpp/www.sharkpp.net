<h1 id="smooth-scroll-plugin">Smooth Scroll Plugin</h1>

<p>Allows for easy implementation of smooth scrolling for same-page links.</p>

<p><a href="https://npmjs.org/package/jquery-smooth-scroll"><img src="https://nodei.co/npm/jquery-smooth-scroll.png?compact=true" alt="NPM" /></a></p>

<p>Note: Version 2.0+ of this plugin requires jQuery version 1.7 or greater.</p>

<h2 id="download">Download</h2>

<p>Using npm:</p>

<pre><code class="bash">npm install jquery-smooth-scroll
</code></pre>

<p>The old-fashioned way:</p>

<p>Go to the following URL in your browser and copy/paste the code into your own file:
https://raw.githubusercontent.com/kswedberg/jquery-smooth-scroll/master/jquery.smooth-scroll.js</p>

<h2 id="demo">Demo</h2>

<p>You can try a bare-bones demo at <a href="https://kswedberg.github.io/jquery-smooth-scroll/demo/">kswedberg.github.io/jquery-smooth-scroll/demo/</a></p>

<h2 id="features">Features</h2>

<h3 id="%24.fn.smoothscroll">$.fn.smoothScroll</h3>

<ul>
<li>Works like this: <code>$('a').smoothScroll();</code></li>
<li>Specify a containing element if you want: <code>$('#container a').smoothScroll();</code></li>
<li>Exclude links if they are within a containing element: <code>$('#container a').smoothScroll({excludeWithin: ['.container2']});</code></li>
<li>Exclude links if they match certain conditions: <code>$('a').smoothScroll({exclude: ['.rough','#chunky']});</code></li>
<li>Adjust where the scrolling stops: <code>$('.backtotop').smoothScroll({offset: -100});</code></li>
<li>Add a callback function that is triggered before the scroll starts: <code>$('a').smoothScroll({beforeScroll: function() { alert('ready to go!'); }});</code></li>
<li>Add a callback function that is triggered after the scroll is complete: <code>$('a').smoothScroll({afterScroll: function() { alert('we made it!'); }});</code></li>
<li>Add back button support by using a <a href="https://developer.mozilla.org/en-US/docs/Web/API/HashChangeEvent"><code>hashchange</code> event listener</a>. You can also include a history management plugin such as <a href="http://benalman.com/code/projects/jquery-bbq/docs/files/jquery-ba-bbq-js.html">Ben Alman's BBQ</a> for ancient browser support (IE &lt; 8), but you'll need jQuery 1.8 or earlier. See <a href="demo/hashchange.html">demo/hashchange.html</a> or <a href="demo/bbq.html">demo/bbq.html</a> for an example of how to implement.</li>
</ul>

<h4 id="options">Options</h4>

<p>The following options, shown with their default values, are available for both <code>$.fn.smoothScroll</code> and <code>$.smoothScroll</code>:</p>

<pre><code class="javascript">{
  offset: 0,

  // one of 'top' or 'left'
  direction: 'top',

  // only use if you want to override default behavior or if using $.smoothScroll
  scrollTarget: null,

  // automatically focus the target element after scrolling to it (see readme for details)
  autoFocus: false,

  // string to use as selector for event delegation
  delegateSelector: null,

  // fn(opts) function to be called before scrolling occurs.
  // `this` is the element(s) being scrolled
  beforeScroll: function() {},

  // fn(opts) function to be called after scrolling occurs.
  // `this` is the triggering element
  afterScroll: function() {},

  // easing name. jQuery comes with "swing" and "linear." For others, you'll need an easing plugin
  // from jQuery UI or elsewhere
  easing: 'swing',

  // speed can be a number or 'auto'
  // if 'auto', the speed will be calculated based on the formula:
  // (current scroll position - target scroll position) / autoCoefficient
  speed: 400,

  // autoCoefficent: Only used when speed set to "auto".
  // The higher this number, the faster the scroll speed
  autoCoefficient: 2,

  // $.fn.smoothScroll only: whether to prevent the default click action
  preventDefault: true

}
</code></pre>

<p>The options object for <code>$.fn.smoothScroll</code> can take two additional properties:
<code>exclude</code> and <code>excludeWithin</code>. The value for both of these is an array of
selectors, DOM elements or jQuery objects. Default value for both is an
empty array.</p>

<h4 id="setting-options-after-initial-call">Setting options after initial call</h4>

<p>If you need to change any of the options after you've already called <code>.smoothScroll()</code>,
you can do so by passing the <code>"options"</code> string as the first argument and an
options object as the second.</p>

<h3 id="%24.smoothscroll">$.smoothScroll</h3>

<ul>
<li>Utility method works without a selector: <code>$.smoothScroll()</code></li>
<li>Can be used to scroll any element (not just <code>document.documentElement</code> /
<code>document.body</code>)</li>
<li>Doesn't automatically fire, so you need to bind it to some other user
interaction. For example:
<code>js
$('button.scrollsomething').on('click', function() {
$.smoothScroll({
  scrollElement: $('div.scrollme'),
  scrollTarget: '#findme'
});
return false;
});</code></li>
<li>The <code>$.smoothScroll</code> method can take one or two arguments.

<ul>
<li>If the first argument is a number or a "relative string," the document is scrolled to that
position. If it's an options object, those options determine how the
document (or other element) will be scrolled.</li>
<li>If a number or "relative string" is provided as the second argument, it will override whatever may have been set for the <code>scrollTarget</code> option.</li>
<li>The relative string syntax, introduced in version 2.1, looks like <code>"+=100px"</code> or <code>"-=50px"</code> (see below for an example).</li>
</ul></li>
</ul>

<h4 id="additional-option">Additional Option</h4>

<p>The following option, in addition to those listed for <code>$.fn.smoothScroll</code> above, is available
for <code>$.smoothScroll</code>:</p>

<pre><code class="javascript">{
  // The jQuery set of elements you wish to scroll.
  //  if null (default), $('html, body').firstScrollable() is used.
  scrollElement: null
}
</code></pre>

<h3 id="%24.fn.scrollable">$.fn.scrollable</h3>

<ul>
<li>Selects the matched element(s) that are scrollable. Acts just like a
DOM traversal method such as <code>.find()</code> or <code>.next()</code>.</li>
<li>The resulting jQuery set may consist of <strong>zero, one, or multiple</strong>
elements.</li>
</ul>

<h3 id="%24.fn.firstscrollable">$.fn.firstScrollable</h3>

<ul>
<li>Selects the first matched element that is scrollable. Acts just like a
DOM traversal method such as <code>.find()</code> or <code>.next()</code>.</li>
<li>The resulting jQuery set may consist of <strong>zero or one</strong> element.</li>
<li>This method is used <em>internally</em> by the plugin to determine which element
to use for "document" scrolling:
<code>$('html, body').firstScrollable().animate({scrollTop: someNumber},
someSpeed)</code></li>
</ul>

<h2 id="examples">Examples</h2>

<h3 id="scroll-down-one-%22page%22-at-a-time-v2.1%2B">Scroll down one "page" at a time (v2.1+)</h3>

<p>With smoothScroll version 2.1 and later, you can use the "relative string" syntax to scroll an element or the document a certain number of pixels relative to its current position. The following code will scroll the document down one page at a time when the user clicks the ".pagedown" button:</p>

<p><code>js
  $('button.pagedown').on('click', function() {
    $.smoothScroll('+=' + $(window).height());
  });</code></p>

<h3 id="smooth-scrolling-on-page-load">Smooth scrolling on page load</h3>

<p>If you want to scroll to an element when the page loads, use <code>$.smoothScroll()</code> in a script at the end of the body or use <code>$(document).ready()</code>. To prevent the browser from automatically scrolling to the element on its own, your link on page 1 will need to include a fragment identifier that does <em>not</em> match an element id on page 2. To ensure that users without JavaScript get to the same element, you should modify the link's hash on page 1 with JavaScript. Your script on page 2 will then modify it back to the correct one when you call <code>$.smoothScroll()</code>.</p>

<p>For example, let's say you want to smooth scroll to <code>&lt;div id="scrolltome"&gt;&lt;/div&gt;</code> on page-2.html. For page-1.html, your script might do the following:</p>

<pre><code class="js">$('a[href="page-2.html#scrolltome"]').attr('href', function() {
  var hrefParts = this.href.split(/#/);
  hrefParts[1] = 'smoothScroll' + hrefParts[1];
  return hrefParts.join('#');
});

</code></pre>

<p>Then for page-2.html, your script would do this:</p>

<pre><code class="js">// Call $.smoothScroll if location.hash starts with "#smoothScroll"
var reSmooth = /^#smoothScroll/;
var id;
if (reSmooth.test(location.hash)) {
  // Strip the "#smoothScroll" part off (and put "#" back on the beginning)
  id = '#' + location.hash.replace(reSmooth, '');
  $.smoothScroll({scrollTarget: id});
}
</code></pre>

<h2 id="focus-element-after-scrolling-to-it.">Focus element after scrolling to it.</h2>

<p>Imagine you have a link to a form somewhere on the same page. When the user clicks the link, you want the user to be able to begin interacting with that form.</p>

<ul>
<li>As of <strong>smoothScroll version 2.2</strong>, the plugin will automatically focus the element if you set the <code>autoFocus</code> option to <code>true</code>.</li>
<li>In the future, versions 3.x and later will have <code>autoFocus</code> set to true <strong>by default</strong>.</li>
<li>If you are using the low-level <code>$.smoothScroll</code> method, <code>autoFocus</code> will only work if you've also provided a value for the <code>scrollTarget</code> option.</li>
<li>Prior to version 2.2, you can use the <code>afterScroll</code> callback function. Here is an example that focuses the first input within the form after scrolling to the form:</li>
</ul>

<pre><code class="js">$('a.example').smoothScroll({
  afterScroll: function(options) {
    $(options.scrollTarget).find('input')[0].focus();
  }
});

</code></pre>

<p>For accessibility reasons, it might make sense to focus any element you scroll to, even if it's not a natively focusable element. To do so, you could add a <code>tabIndex</code> attribute to the target element (this, again, is for versions prior to 2.2):</p>

<pre><code class="js">$('div.example').smoothScroll({
  afterScroll: function(options) {
    var $tgt = $(options.scrollTarget);
    $tgt[0].focus();

    if (!$tgt.is(document.activeElement)) {
      $tgt.attr('tabIndex', '-1');
      $tgt[0].focus();
    }
  }
});
</code></pre>

<h2 id="notes">Notes</h2>

<ul>
<li>To determine where to scroll the page, the <code>$.fn.smoothScroll</code> method looks
for an element with an <em>id</em> attribute that matches the <code>&lt;a&gt;</code> element's hash.
It does <em>not</em> look at the element's <em>name</em> attribute. If you want a clicked link
to scroll to a "named anchor" (e.g. <code>&lt;a name="foo"&gt;</code>), you'll need to use the
<code>$.smoothScroll</code> method instead.</li>
<li>The plugin's <code>$.fn.smoothScroll</code> and <code>$.smoothScroll</code> methods use the
<code>$.fn.firstScrollable</code> DOM traversal method (also defined by this plugin)
to determine which element is scrollable. If no elements are scrollable,
these methods return a jQuery object containing an empty array, just like
all of jQuery's other DOM traversal methods. Any further chained methods,
therefore, will be called against no elements (which, in most cases,
means that nothing will happen).</li>
</ul>

<h2 id="contributing">Contributing</h2>

<p>Thank you! Please consider the following when working on this repo before you submit a pull request:</p>

<ul>
<li>For code changes, please work on the "source" file: <code>src/jquery.smooth-scroll.js</code>.</li>
<li>Style conventions are noted in the <code>jshint</code> grunt file options and the <code>.jscsrc</code> file. To be sure your additions comply, run <code>grunt lint</code> from the command line.</li>
<li>If possible, please use Tim Pope's <a href="http://tbaggery.com/2008/04/19/a-note-about-git-commit-messages.html">git commit message style</a>. Multiple commits in a pull request will be squashed into a single commit. I may adjust the message for clarity, style, or grammar. I manually commit all merged PRs using the <code>--author</code> flag to ensure that proper authorship (yours) is maintained.</li>
</ul>
