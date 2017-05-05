<h1 id="magnific-popup-repository">Magnific Popup Repository</h1>

<p><a href="https://travis-ci.org/dimsemenov/Magnific-Popup"><img src="https://travis-ci.org/dimsemenov/Magnific-Popup.png" alt="Build Status" /></a> 
<a href="https://flattr.com/thing/1310305/Magnific-Popup-by-dimsemenov"><img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr" /></a></p>

<p>Fast, light and responsive lightbox plugin, for jQuery and Zepto.js.</p>

<ul>
<li><a href="http://dimsemenov.com/plugins/magnific-popup/documentation.html">Documentation and getting started guide</a>.</li>
<li><a href="http://dimsemenov.com/plugins/magnific-popup/">Examples and plugin home page</a>.</li>
<li>More examples in <a href="http://codepen.io/collection/nLcqo">CodePen collection</a>.</li>
</ul>

<p>Optionally, install via Bower <code>bower install magnific-popup</code> or npm: <code>npm install magnific-popup</code>.
<a href="https://rubygems.org/gems/magnific-popup-rails">Ruby gem</a>: <code>gem install magnific-popup-rails</code>.</p>

<h2 id="extensions">Extensions</h2>

<ul>
<li>WordPress plugin - <a href="http://dimsemenov.com/plugins/magnific-popup/wordpress.html">under development</a>.</li>
<li><a href="https://drupal.org/project/magnific_popup">Drupal module</a>.</li>
<li><a href="https://github.com/cdowdy/concrete5-Magnific-Popup">Concrete5 add-on</a>.</li>
<li><a href="http://www.redaxo.org/de/download/addons/?addon_id=1131">Redaxo add-on</a>.</li>
<li><a href="https://github.com/fritzmg/contao-magnific-popup">Contao extension</a>.</li>
</ul>

<p>If you created an extension for some CMS, email me and I'll add it to this list.</p>

<h2 id="location-of-stuff">Location of stuff</h2>

<ul>
<li>Generated popup JS and CSS files are in folder <a href="https://github.com/dimsemenov/Magnific-Popup/tree/master/dist">dist/</a>. (Online build tool is on <a href="http://dimsemenov.com/plugins/magnific-popup/documentation.html">documentation page</a>).</li>
<li>Source files are in folder <a href="https://github.com/dimsemenov/Magnific-Popup/tree/master/src">src/</a>. They include <a href="https://github.com/dimsemenov/Magnific-Popup/blob/master/src/css/main.scss">Sass CSS file</a> and js parts (edit them if you wish to submit commit).</li>
<li>Website (examples &amp; documentation) is in folder <a href="https://github.com/dimsemenov/Magnific-Popup/tree/master/website">website/</a>.</li>
<li>Documentation page itself is in <a href="https://github.com/dimsemenov/Magnific-Popup/blob/master/website/documentation.md">website/documentation.md</a> (contributions to it are very welcome).</li>
</ul>

<h2 id="using-magnific-popup%3F">Using Magnific Popup?</h2>

<p>If you used Magnific Popup in some interesting way, or on site of popular brand, I'd be very grateful if you <a href="mailto:diiiimaaaa@gmail.com?subject="Site that uses Magnific Popup"">shoot me</a> a link to it.</p>

<h2 id="build">Build</h2>

<p>To compile Magnific Popup by yourself, first of make sure that you have <a href="http://nodejs.org/">Node.js</a>, <a href="https://github.com/cowboy/grunt">Grunt.js</a>, <a href="http://www.ruby-lang.org/">Ruby</a> and <a href="https://github.com/mojombo/jekyll/">Jekyll</a> installed, then:</p>

<p>1) Copy repository</p>

<pre><code>git clone https://github.com/dimsemenov/Magnific-Popup.git
</code></pre>

<p>2) Go inside Magnific Popup folder that you fetched and install Node dependencies</p>

<pre><code>cd Magnific-Popup &amp;&amp; npm install
</code></pre>

<p>3) Now simply run <code>grunt</code> to generate JS and CSS in folder <code>dist</code> and site in folder <code>_site/</code>.</p>

<pre><code>grunt
</code></pre>

<p>Optionally:</p>

<ul>
<li>Run <code>grunt watch</code> to automatically rebuild script when you change files in <code>src/</code> or in <code>website/</code>.</li>
<li>If you don't have and don't want to install Jekyll, run <code>grunt nosite</code> to just build JS and CSS files related to popup in <code>dist/</code>.</li>
</ul>

<h2 id="changelog"><a href="https://github.com/dimsemenov/Magnific-Popup/releases">Changelog</a></h2>

<h2 id="license">License</h2>

<p>Script is MIT licensed and free and will always be kept this way. But has a small restriction from me - please do not create public WordPress plugin based on it(or at least contact me before creating it), because I will make it and it'll be open source too (<a href="http://dimsemenov.com/subscribe.html">want to get notified?</a>).</p>

<p>Created by <a href="http://twitter.com/dimsemenov">@dimsemenov</a> &amp; <a href="https://github.com/dimsemenov/Magnific-Popup/contributors">contributors</a>.</p>

<p><a href="https://bitdeli.com/free" title="Bitdeli Badge"><img src="https://d2weczhvl823v0.cloudfront.net/dimsemenov/magnific-popup/trend.png" alt="Bitdeli Badge" /></a></p>

<h2 id="bugs-%26-contributing">Bugs &amp; contributing</h2>

<p>Please report bugs via GitHub and ask general questions through <a href="http://stackoverflow.com/questions/tagged/magnific-popup">StackOverflow</a>. Feel free to submit commit <a href="https://github.com/dimsemenov/Magnific-Popup/pulls">pull-request</a>, even the tiniest contributions to the script or to the documentation are very welcome.</p>
