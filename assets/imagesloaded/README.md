<h1 id="imagesloaded">imagesLoaded</h1>

<p class="tagline">JavaScript is all like "You images done yet or what?"</p>

<p><a href="http://imagesloaded.desandro.com">imagesloaded.desandro.com</a></p>

<p>Detect when images have been loaded.</p>

<!-- demo -->

<h2 id="install">Install</h2>

<p>Get a packaged source file:</p>

<ul>
<li><a href="http://imagesloaded.desandro.com/imagesloaded.pkgd.min.js">imagesloaded.pkgd.min.js</a></li>
<li><a href="http://imagesloaded.desandro.com/imagesloaded.pkgd.js">imagesloaded.pkgd.js</a></li>
</ul>

<p>Or install via <a href="http://bower.io">Bower</a>:</p>

<pre><code class="bash">bower install imagesloaded
</code></pre>

<p>Or install via <a href="https://github.com/component/component">Component</a>:</p>

<pre><code class="js">component install desandro/imagesloaded
</code></pre>

<h2 id="usage">Usage</h2>

<pre><code class="js">imagesLoaded( elem, callback )
// you can use `new` if you like
new imagesLoaded( elem, callback )
</code></pre>

<ul>
<li><code>elem</code> <em>Element, NodeList, Array, or Selector String</em></li>
<li><code>callback</code> <em>Function</em> - function triggered after all images have been loaded</li>
</ul>

<p>Using a callback function is the same as binding it to the <code>always</code> event (see below).</p>

<pre><code class="js">// element
imagesLoaded( document.querySelector('#container'), function( instance ) {
  console.log('all images are loaded');
});
// selector string
imagesLoaded( '#container', function() {...});
// multiple elements
var posts = document.querySelectorAll('.post');
imagesLoaded( posts, function() {...});
</code></pre>

<h2 id="events">Events</h2>

<p>imagesLoaded is an Event Emitter. You can bind event listeners to events.</p>

<pre><code class="js">var imgLoad = imagesLoaded( elem );
function onAlways( instance ) {
  console.log('all images are loaded');
}
// bind with .on()
imgLoad.on( 'always', onAlways );
// unbind with .off()
imgLoad.off( 'always', onAlways );
</code></pre>

<h3 id="always">always</h3>

<pre><code class="js">imgLoad.on( 'always', function( instance ) {
  console.log('ALWAYS - all images have been loaded');
});
</code></pre>

<p>Triggered after all images have been either loaded or confirmed broken.</p>

<ul>
<li><code>instance</code> <em>imagesLoaded</em> - the imagesLoaded instance</li>
</ul>

<h3 id="done">done</h3>

<pre><code class="js">imgLoad.on( 'done', function( instance ) {
  console.log('DONE  - all images have been successfully loaded');
});
</code></pre>

<p>Triggered after all images have successfully loaded without any broken images.</p>

<h3 id="fail">fail</h3>

<pre><code class="js">imgLoad.on( 'fail', function( instance ) {
  console.log('FAIL - all images loaded, at least one is broken');
});
</code></pre>

<p>Triggered after all images have been loaded with at least one broken image.</p>

<h3 id="progress">progress</h3>

<pre><code class="js">imgLoad.on( 'progress', function( instance, image ) {
  var result = image.isLoaded ? 'loaded' : 'broken';
  console.log( 'image is ' + result + ' for ' + image.img.src );
});
</code></pre>

<p>Triggered after each image has been loaded.</p>

<ul>
<li><code>instance</code> <em>imagesLoaded</em> - the imagesLoaded instance</li>
<li><code>image</code> <em>LoadingImage</em> - the LoadingImage instance of the loaded image</li>
</ul>

<h2 id="properties">Properties</h2>

<h3 id="loadingimage.img">LoadingImage.img</h3>

<p><em>Image</em> - The <code>img</code> element</p>

<h3 id="loadingimage.isloaded">LoadingImage.isLoaded</h3>

<p><em>Boolean</em> - <code>true</code> when the image has succesfully loaded</p>

<h3 id="imagesloaded.images">imagesLoaded.images</h3>

<p>Array of <em>LoadingImage</em> instances for each image detected</p>

<pre><code class="js">var imgLoad = imagesLoaded('#container');
imgLoad.on( 'always', function() {
  console.log( imgLoad.images.length + ' images loaded' );
  // detect which image is broken
  for ( var i = 0, len = imgLoad.images.length; i &lt; len; i++ ) {
    var image = imgLoad.images[i];
    var result = image.isLoaded ? 'loaded' : 'broken';
    console.log( 'image is ' + result + ' for ' + image.img.src );
  }
});
</code></pre>

<h2 id="jquery">jQuery</h2>

<p>If you include jQuery, imagesLoaded can be used as a jQuery Plugin.</p>

<pre><code class="js">$('#container').imagesLoaded( function() {
  // images have loaded
});
</code></pre>

<h3 id="jquery-deferred">jQuery Deferred</h3>

<p>The jQuery plugin returns a <a href="http://api.jquery.com/category/deferred-object/">jQuery Deferred object</a>. This allows you to use <code>.always()</code>, <code>.done()</code>, <code>.fail()</code> and <code>.progress()</code>, similarly to the emitted events.</p>

<pre><code class="js">$('#container').imagesLoaded()
  .always( function( instance ) {
    console.log('all images loaded');
  })
  .done( function( instance ) {
    console.log('all images successfully loaded');
  })
  .fail( function() {
    console.log('all images loaded, at least one is broken');
  })
  .progress( function( instance, image ) {
    var result = image.isLoaded ? 'loaded' : 'broken';
    console.log( 'image is ' + result + ' for ' + image.img.src );
  });
</code></pre>

<h2 id="requirejs">RequireJS</h2>

<p>imagesLoaded works with <a href="http://requirejs.org">RequireJS</a>.</p>

<p>You can require <a href="http://imagesloaded.desandro.com/imagesloaded.pkgd.js">imagesloaded.pkgd.js</a>.</p>

<pre><code class="js">requirejs( [
  'path/to/imagesloaded.pkgd.js',
], function( imagesLoaded ) {
  imagesLoaded( '#container', function() { ... });
});
</code></pre>

<p>Or, you can manage dependencies with <a href="http://bower.io">Bower</a>. Set <code>baseUrl</code> to <code>bower_components</code> and set a path config for all your application code.</p>

<pre><code class="js">requirejs.config({
  baseUrl: 'bower_components/',
  paths: { // path to your app
    app: '../'
  }
});

requirejs( [
  'imagesloaded/imagesloaded',
  'app/my-component.js'
], function( imagesLoaded, myComp ) {
  imagesLoaded( '#container', function() { ... });
});
</code></pre>

<h2 id="contributors">Contributors</h2>

<p>This project has a <a href="https://github.com/desandro/imagesloaded/graphs/contributors">storied legacy</a>. Its current incarnation was developed by <a href="http://darsa.in/">Tomas Sardyha @Darsain</a> and <a href="http://desandro.com">David DeSandro @desandro</a>.</p>

<h2 id="mit-license">MIT License</h2>

<p>imagesLoaded is released under the <a href="http://desandro.mit-license.org/">MIT License</a>. Have at it.</p>
