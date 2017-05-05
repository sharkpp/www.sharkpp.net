<h1 id="jquery---new-wave-javascript"><a href="http://jquery.com/">jQuery</a> - New Wave JavaScript</h1>

<h2 id="contribution-guides">Contribution Guides</h2>

<p>In the spirit of open source software development, jQuery always encourages community code contribution. To help you get started and before you jump into writing code, be sure to read these important contribution guidelines thoroughly:</p>

<ol>
<li><a href="http://contribute.jquery.org/">Getting Involved</a></li>
<li><a href="http://contribute.jquery.org/style-guide/js/">Core Style Guide</a></li>
<li><a href="http://contribute.jquery.org/code/">Writing Code for jQuery Foundation Projects</a></li>
</ol>

<h2 id="environments-in-which-to-use-jquery">Environments in which to use jQuery</h2>

<ul>
<li><a href="http://jquery.com/browser-support/">Browser support</a> differs between the master (2.x) branch and the 1.x-master branch. Specifically, 2.x does not support legacy browsers such as IE6-8. The jQuery team continues to provide support for legacy browsers on the 1.x-master branch. Use the latest 1.x release if support for those browsers is required. See <a href="http://jquery.com/browser-support/">browser support</a> for more info.</li>
<li>To use jQuery in Node, browser extensions, and other non-browser environments, use only <strong>2.x</strong> releases. 1.x does not support these environments.</li>
</ul>

<h2 id="what-you-need-to-build-your-own-jquery">What you need to build your own jQuery</h2>

<p>In order to build jQuery, you need to have Node.js/npm latest and git 1.7 or later.
(Earlier versions might work OK, but are not tested.)</p>

<p>For Windows you have to download and install <a href="http://git-scm.com/downloads">git</a> and <a href="http://nodejs.org/download/">Node.js</a>.</p>

<p>Mac OS users should install <a href="http://mxcl.github.com/homebrew/">Homebrew</a>. Once Homebrew is installed, run <code>brew install git</code> to install git,
and <code>brew install node</code> to install Node.js.</p>

<p>Linux/BSD users should use their appropriate package managers to install git and Node.js, or build from source
if you swing that way. Easy-peasy.</p>

<h2 id="how-to-build-your-own-jquery">How to build your own jQuery</h2>

<p>Clone a copy of the main jQuery git repo by running:</p>

<pre><code class="bash">git clone git://github.com/jquery/jquery.git
</code></pre>

<p>Enter the jquery directory and run the build script:</p>

<pre><code class="bash">cd jquery &amp;&amp; npm run build
</code></pre>

<p>The built version of jQuery will be put in the <code>dist/</code> subdirectory, along with the minified copy and associated map file.</p>

<p>If you want create custom build or help with jQuery development, it would be better to install <a href="https://github.com/gruntjs/grunt-cli">grunt command line interface</a> as a global package:</p>

<pre><code>npm install -g grunt-cli
</code></pre>

<p>Make sure you have <code>grunt</code> installed by testing:</p>

<pre><code>grunt -v
</code></pre>

<p>Now by running <code>grunt</code> command, in the jquery directory, you could build full version of jQuery, just like with <code>npm run build</code> command:</p>

<pre><code>grunt
</code></pre>

<p>There are many other tasks available for jQuery Core:</p>

<pre><code>grunt -help
</code></pre>

<h3 id="modules">Modules</h3>

<p>Special builds can be created that exclude subsets of jQuery functionality.
This allows for smaller custom builds when the builder is certain that those parts of jQuery are not being used.
For example, an app that only used JSONP for <code>$.ajax()</code> and did not need to calculate offsets or positions of elements could exclude the offset and ajax/xhr modules.</p>

<p>Any module may be excluded except for <code>core</code>, and <code>selector</code>. To exclude a module, pass its path relative to the <code>src</code> folder (without the <code>.js</code> extension).</p>

<p>Some example modules that can be excluded are:</p>

<ul>
<li><strong>ajax</strong>: All AJAX functionality: <code>$.ajax()</code>, <code>$.get()</code>, <code>$.post()</code>, <code>$.ajaxSetup()</code>, <code>.load()</code>, transports, and ajax event shorthands such as <code>.ajaxStart()</code>.</li>
<li><strong>ajax/xhr</strong>: The XMLHTTPRequest AJAX transport only.</li>
<li><strong>ajax/script</strong>: The <code>&lt;script&gt;</code> AJAX transport only; used to retrieve scripts.</li>
<li><strong>ajax/jsonp</strong>: The JSONP AJAX transport only; depends on the ajax/script transport.</li>
<li><strong>css</strong>: The <code>.css()</code> method plus non-animated <code>.show()</code>, <code>.hide()</code> and <code>.toggle()</code>. Also removes <strong>all</strong> modules depending on css (including <strong>effects</strong>, <strong>dimensions</strong>, and <strong>offset</strong>).</li>
<li><strong>deprecated</strong>: Methods documented as deprecated but not yet removed; currently only <code>.andSelf()</code>.</li>
<li><strong>dimensions</strong>: The <code>.width()</code> and <code>.height()</code> methods, including <code>inner-</code> and <code>outer-</code> variations.</li>
<li><strong>effects</strong>: The <code>.animate()</code> method and its shorthands such as <code>.slideUp()</code> or <code>.hide("slow")</code>.</li>
<li><strong>event</strong>: The <code>.on()</code> and <code>.off()</code> methods and all event functionality. Also removes <code>event/alias</code>.</li>
<li><strong>event/alias</strong>: All event attaching/triggering shorthands like <code>.click()</code> or <code>.mouseover()</code>.</li>
<li><strong>offset</strong>: The <code>.offset()</code>, <code>.position()</code>, <code>.offsetParent()</code>, <code>.scrollLeft()</code>, and <code>.scrollTop()</code> methods.</li>
<li><strong>wrap</strong>: The <code>.wrap()</code>, <code>.wrapAll()</code>, <code>.wrapInner()</code>, and <code>.unwrap()</code> methods.</li>
<li><strong>core/ready</strong>: Exclude the ready module if you place your scripts at the end of the body. Any ready callbacks bound with <code>jQuery()</code> will simply be called immediately. However, <code>jQuery(document).ready()</code> will not be a function and <code>.on("ready", ...)</code> or similar will not be triggered.</li>
<li><strong>deferred</strong>: Exclude jQuery.Deferred. This also removes jQuery.Callbacks. <em>Note</em> that modules that depend on jQuery.Deferred(AJAX, effects, core/ready) will not be removed and will still expect jQuery.Deferred to be there. Include your own jQuery.Deferred implementation or exclude those modules as well (<code>grunt custom:-deferred,-ajax,-effects,-core/ready</code>).</li>
<li><strong>exports/global</strong>: Exclude the attachment of global jQuery variables ($ and jQuery) to the window.</li>
<li><strong>exports/amd</strong>: Exclude the AMD definition.</li>
</ul>

<p>Removing sizzle is not supported on the 1.x branch.</p>

<p>The build process shows a message for each dependent module it excludes or includes.</p>

<h5 id="amd-name">AMD name</h5>

<p>As an option, you can set the module name for jQuery's AMD definition. By default, it is set to "jquery", which plays nicely with plugins and third-party libraries, but there may be cases where you'd like to change this. Simply set the <code>"amd"</code> option:</p>

<pre><code class="bash">grunt custom --amd="custom-name"
</code></pre>

<p>Or, to define anonymously, set the name to an empty string.</p>

<pre><code class="bash">grunt custom --amd=""
</code></pre>

<h4 id="custom-build-examples">Custom Build Examples</h4>

<p>To create a custom build of the latest stable version, first check out the version:</p>

<pre><code class="bash">git pull; git checkout $(git describe --abbrev=0 --tags)
</code></pre>

<p>Then, make sure all Node dependencies are installed:</p>

<pre><code class="bash">npm install
</code></pre>

<p>Create the custom build using the <code>grunt custom</code> option, listing the modules to be excluded.</p>

<p>Exclude all <strong>ajax</strong> functionality:</p>

<pre><code class="bash">grunt custom:-ajax
</code></pre>

<p>Excluding <strong>css</strong> removes modules depending on CSS: <strong>effects</strong>, <strong>offset</strong>, <strong>dimensions</strong>.</p>

<pre><code class="bash">grunt custom:-css
</code></pre>

<p>Exclude a bunch of modules:</p>

<pre><code class="bash">grunt custom:-ajax,-css,-deprecated,-dimensions,-effects,-event/alias,-offset,-wrap
</code></pre>

<p>For questions or requests regarding custom builds, please start a thread on the <a href="https://forum.jquery.com/developing-jquery-core">Developing jQuery Core</a> section of the forum. Due to the combinatorics and custom nature of these builds, they are not regularly tested in jQuery's unit test process.</p>

<h2 id="running-the-unit-tests">Running the Unit Tests</h2>

<p>Make sure you have the necessary dependencies:</p>

<pre><code class="bash">npm install
</code></pre>

<p>Start <code>grunt watch</code> or <code>npm start</code> to auto-build jQuery as you work:</p>

<pre><code class="bash">cd jquery &amp;&amp; grunt watch
</code></pre>

<p>Run the unit tests with a local server that supports PHP. Ensure that you run the site from the root directory, not the "test" directory. No database is required. Pre-configured php local servers are available for Windows and Mac. Here are some options:</p>

<ul>
<li>Windows: <a href="http://www.wampserver.com/en/">WAMP download</a></li>
<li>Mac: <a href="http://www.mamp.info/en/index.html">MAMP download</a></li>
<li>Linux: <a href="https://www.linux.com/learn/tutorials/288158-easy-lamp-server-installation">Setting up LAMP</a></li>
<li><a href="http://code.google.com/p/mongoose/">Mongoose (most platforms)</a></li>
</ul>

<h2 id="building-to-a-different-directory">Building to a different directory</h2>

<p>To copy the built jQuery files from <code>/dist</code> to another directory:</p>

<pre><code class="bash">grunt &amp;&amp; grunt dist:/path/to/special/location/
</code></pre>

<p>With this example, the output files would be:</p>

<pre><code class="bash">/path/to/special/location/jquery.js
/path/to/special/location/jquery.min.js
</code></pre>

<p>To add a permanent copy destination, create a file in <code>dist/</code> called ".destination.json". Inside the file, paste and customize the following:</p>

<pre><code class="json"><br />{
  "/Absolute/path/to/other/destination": true
}
</code></pre>

<p>Additionally, both methods can be combined.</p>

<h2 id="essential-git">Essential Git</h2>

<p>As the source code is handled by the Git version control system, it's useful to know some features used.</p>

<h3 id="cleaning">Cleaning</h3>

<p>If you want to purge your working directory back to the status of upstream, following commands can be used (remember everything you've worked on is gone after these):</p>

<pre><code class="bash">git reset --hard upstream/master
git clean -fdx
</code></pre>

<h3 id="rebasing">Rebasing</h3>

<p>For feature/topic branches, you should always use the <code>--rebase</code> flag to <code>git pull</code>, or if you are usually handling many temporary "to be in a github pull request" branches, run following to automate this:</p>

<pre><code class="bash">git config branch.autosetuprebase local
</code></pre>

<p>(see <code>man git-config</code> for more information)</p>

<h3 id="handling-merge-conflicts">Handling merge conflicts</h3>

<p>If you're getting merge conflicts when merging, instead of editing the conflicted files manually, you can use the feature
<code>git mergetool</code>. Even though the default tool <code>xxdiff</code> looks awful/old, it's rather useful.</p>

<p>Following are some commands that can be used there:</p>

<ul>
<li><code>Ctrl + Alt + M</code> - automerge as much as possible</li>
<li><code>b</code> - jump to next merge conflict</li>
<li><code>s</code> - change the order of the conflicted lines</li>
<li><code>u</code> - undo a merge</li>
<li><code>left mouse button</code> - mark a block to be the winner</li>
<li><code>middle mouse button</code> - mark a line to be the winner</li>
<li><code>Ctrl + S</code> - save</li>
<li><code>Ctrl + Q</code> - quit</li>
</ul>

<h2 id="qunit-reference"><a href="http://api.qunitjs.com">QUnit</a> Reference</h2>

<h3 id="test-methods">Test methods</h3>

<pre><code class="js">expect( numAssertions );
stop();
start();
</code></pre>

<p>Note: QUnit's eventual addition of an argument to stop/start is ignored in this test suite so that start and stop can be passed as callbacks without worrying about their parameters</p>

<h3 id="test-assertions">Test assertions</h3>

<pre><code class="js">ok( value, [message] );
equal( actual, expected, [message] );
notEqual( actual, expected, [message] );
deepEqual( actual, expected, [message] );
notDeepEqual( actual, expected, [message] );
strictEqual( actual, expected, [message] );
notStrictEqual( actual, expected, [message] );
throws( block, [expected], [message] );
</code></pre>

<h2 id="test-suite-convenience-methods-reference-see-test%2Fdata%2Ftestinit.js">Test Suite Convenience Methods Reference (See <a href="https://github.com/jquery/jquery/blob/master/test/data/testinit.js">test/data/testinit.js</a>)</h2>

<h3 id="returns-an-array-of-elements-with-the-given-ids">Returns an array of elements with the given IDs</h3>

<pre><code class="js">q( ... );
</code></pre>

<p>Example:</p>

<pre><code class="js">q("main", "foo", "bar");

=&gt; [ div#main, span#foo, input#bar ]
</code></pre>

<h3 id="asserts-that-a-selection-matches-the-given-ids">Asserts that a selection matches the given IDs</h3>

<pre><code class="js">t( testName, selector, [ "array", "of", "ids" ] );
</code></pre>

<p>Example:</p>

<pre><code class="js">t("Check for something", "//[a]", ["foo", "baar"]);
</code></pre>

<h3 id="fires-a-native-dom-event-without-going-through-jquery">Fires a native DOM event without going through jQuery</h3>

<pre><code class="js">fireNative( node, eventType )
</code></pre>

<p>Example:</p>

<pre><code class="js">fireNative( jQuery("#elem")[0], "click" );
</code></pre>

<h3 id="add-random-number-to-url-to-stop-caching">Add random number to url to stop caching</h3>

<pre><code class="js">url( "some/url.php" );
</code></pre>

<p>Example:</p>

<pre><code class="js">url("data/test.html");

=&gt; "data/test.html?10538358428943"


url("data/test.php?foo=bar");

=&gt; "data/test.php?foo=bar&amp;10538358345554"
</code></pre>

<h3 id="load-tests-in-an-iframe">Load tests in an iframe</h3>

<p>Loads a given page constructing a url with fileName: <code>"./data/" + fileName + ".html"</code>
and fires the given callback on jQuery ready (using the jQuery loading from that page)
and passes the iFrame's jQuery to the callback.</p>

<pre><code class="js">testIframe( fileName, testName, callback );
</code></pre>

<p>Callback arguments:</p>

<pre><code class="js">callback( jQueryFromIFrame, iFrameWindow, iFrameDocument );
</code></pre>

<h3 id="load-tests-in-an-iframe-window.iframecallback">Load tests in an iframe (window.iframeCallback)</h3>

<p>Loads a given page constructing a url with fileName: <code>"./data/" + fileName + ".html"</code>
The given callback is fired when window.iframeCallback is called by the page.
The arguments passed to the callback are the same as the
arguments passed to window.iframeCallback, whatever that may be</p>

<pre><code class="js">testIframeWithCallback( testName, fileName, callback );
</code></pre>

<h2 id="questions%3F">Questions?</h2>

<p>If you have any questions, please feel free to ask on the
<a href="http://forum.jquery.com/developing-jquery-core">Developing jQuery Core forum</a> or in #jquery on irc.freenode.net.</p>
