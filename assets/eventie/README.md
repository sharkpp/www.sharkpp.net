<h1 id="eventie---event-binding-helper">eventie - event binding helper</h1>

<p>Makes dealing with events in IE8 bearable. Supported by IE8+ and good browsers.</p>

<pre><code class="js">var elem = document.querySelector('#my-elem');
function onElemClick( event ) {
  console.log( event.type + ' just happened on #' + event.target.id );
  // -&gt; click just happened on #my-elem
}

eventie.bind( elem, 'click', onElemClick );

eventie.unbind( elem, 'click', onElemClick );
</code></pre>

<h2 id="install">Install</h2>

<p>Download <a href="eventie.js">eventie.js</a></p>

<p>Install with <a href="http://bower.io">Bower :bird:</a> <code>bower install eventie</code></p>

<p>Install with npm :truck: <code>npm install eventie</code></p>

<p>Install with <a href="https://github.com/component/component">Component :nut_and_bolt:</a> <code>component install desandro/eventie</code></p>

<h2 id="ie-8">IE 8</h2>

<p>eventie add support for <code>event.target</code> and <a href="https://developer.mozilla.org/en-US/docs/DOM/EventListener#handleEvent&#40;&#41;"><code>.handleEvent</code> method</a> for Internet Explorer 8.</p>

<h2 id="mit-license">MIT license</h2>

<p>eventie is released under the <a href="http://desandro.mit-license.org">MIT license</a>.</p>
