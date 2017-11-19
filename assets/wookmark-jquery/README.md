<p><a href="https://waffle.io/gbks/wookmark-jquery"><img src="https://badge.waffle.io/gbks/wookmark-jquery.png?label=ready&amp;title=Ready" alt="Stories in Ready" /></a>
<a href="https://gitter.im/germanysbestkeptsecret/Wookmark-jQuery?utm_source=badge&amp;utm_medium=badge&amp;utm_campaign=pr-badge&amp;utm_content=badge"><img src="https://badges.gitter.im/Join%20Chat.svg" alt="Join the chat at https://gitter.im/germanysbestkeptsecret/Wookmark-jQuery" /></a>
<a href="http://wookmark.readthedocs.org/en/latest/"><img src="https://readthedocs.org/projects/wookmark/badge/" alt="Read the docs" /></a>
<a href="https://travis-ci.org/germanysbestkeptsecret/Wookmark-jQuery"><img src="https://travis-ci.org/germanysbestkeptsecret/Wookmark-jQuery.svg" alt="Build Status" /></a></p>

<h1 id="wookmark">Wookmark</h1>

<p>This is a plugin for laying out a dynamic grid of elements.</p>

<p>See the <a href="http://www.wookmark.com/jquery-plugin">documentation page</a> for examples.</p>

<p>The repository also includes many functional examples. All images used in the example are copyrighted
by their respective owners and only included for showcasing plugin functionality.</p>

<p>Do you like this project?
<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&amp;hosted_button_id=TSN2TDYNKZHF4">Buy us a beer</a></p>

<p>This project is kindly supported by
<a href="https://www.browserstack.com"><img src="assets/browserstack.png" alt="Browserstack" /></a></p>

<h1 id="how-to-make-the-examples-work">How to make the examples work</h1>

<p>First download or clone this repository.
Because we use the <code>bower</code> package manager for <code>jQuery</code> and other libraries you currently have to
to install <code>bower</code> <a href="http://bower.io">first</a>.
After that you can run <code>bower install</code> and all necessary libraries for the examples will be installed.</p>

<p>We will provide a special download in the future which contains all necessary packages.</p>

<h1 id="further-documentation">Further documentation</h1>

<p>We are currently creating a new and better documentation at <a href="http://wookmark.readthedocs.org/en/latest/">readthedocs</a>.
Its automatically created by the sources in the <code>doc</code> directory.</p>

<p>The documentation can be rendered locally by installing <code>sphinx</code> and <code>sphinx-autobuild</code> and running <code>sphinx-autobuild . _build</code> in the <code>doc</code> directory.</p>

<h1 id="upgrading-to-version-2.0">Upgrading to version 2.0</h1>

<p>Since version 2.0 of Wookmark, the plugin doesn't depend on jQuery anymore.
This allows you to use Wookmark without the overhead of the jQuery library.</p>

<p>Because this meant a big change to the plugin, we also changed a lot in the code
and tried to make it easier to use. The way you initialize the plugin is now different
and a few options have changend. So if you upgrade you have to adapt your code.
See the examples and this readme on how to do this.</p>

<h2 id="installation">Installation</h2>

<h3 id="install-with-bower">Install with bower</h3>

<pre><code>bower install wookmark-jquery
</code></pre>

<h3 id="jquery-is-optional-and-is-used-in-some-of-the-examples-to-simplify-the-code-a-bit">jQuery is optional and is used in some of the examples to simplify the code a bit</h3>

<ul>
<li><a href="http://www.jquery.com">jQuery</a> - 1.5.3 or better</li>
</ul>

<h3 id="required-files">Required files</h3>

<p>Copy <code>wookmark.js</code> or the minified version <code>wookmark.min.js</code> to your javascript folder.
There are some styles for <code>tiles-wrap</code> in <code>css/main.css</code> you might want to use.</p>

<h2 id="usage">Usage</h2>

<p>The plugin can be intialized in different ways. <code>options</code> are optional.</p>

<h3 id="default-without-jquery">Default without jQuery</h3>

<pre><code>var wookmark = new Wookmark('#myElementContainer'[, options ]);
</code></pre>

<h3 id="jquery-call-with-default-settings%3A">jQuery call with default settings:</h3>

<pre><code>$('#myElementContainer').wookmark(options);
</code></pre>

<p>Where <code>myElementContainer</code> is the class or id of the element or elements wrapping your tiles. A Wookmark instance will be created for each element.</p>

<h3 id="options">Options</h3>

<pre><code>{
  align: 'center',
  autoResize: false,
  comparator: null,
  container: $('body'),
  direction: undefined,
  ignoreInactiveItems: true,
  itemWidth: 0,
  fillEmptySpace: false,
  flexibleWidth: 0,
  offset: 2,
  onLayoutChanged: undefined,
  outerOffset: 0,
  possibleFilters: [],
  resizeDelay: 50,
  verticalOffset: undefined
}
</code></pre>

<p>See the <a href="http://www.wookmark.com/jquery-plugin">documentation page</a> for details on available options.</p>

<h4 id="itemwidth-and-flexiblewidth">itemWidth and flexibleWidth</h4>

<p>These values can be given as numbers which will be interpreted as pixels or you can use percentage strings like '20%'.
You can also provide a function which should return either a number or a percentage string.
When <code>flexibleWidth</code> is set and <code>itemWidth</code> is not 0 <code>itemWidth</code> used as minimum item width.
As example using a <code>flexibleWidth</code> of 40% will result in two columns with 10% space to the sides of the container.</p>

<h4 id="offset%2C-outeroffset-and-verticaloffset">offset, outerOffset and verticalOffset</h4>

<p><code>offset</code> is the horizontal and vertical space between two tiles.
<code>outerOffset</code> is the space between the outer tiles and the parent container.
<code>verticalOffset</code> is optional and can be set to achieve a vertical offset between two tiles which is different from <code>offset</code>.</p>

<h4 id="fillemptyspace">fillEmptySpace</h4>

<p>This creates placeholders at the bottom of each column to create an even layout. See <code>example-placeholder</code> on how to use it. These placeholders use the css class <code>wookmark-placeholder</code>. You can overwrite it in your own css to fit your needs.</p>

<h4 id="ignoreinactiveitems">ignoreInactiveItems</h4>

<p>When set to <code>false</code> inactive items will still be shown when filtered. This can be used to fade out filtered items. See the example-filter/fade.html example.</p>

<h4 id="comparator">comparator</h4>

<p>You can use this option to provide a custom comparator function which the plugin will use to sort the tiles. See example-sort or example-stamp on how to use it.</p>

<h3 id="refresh-trigger">Refresh trigger</h3>

<p>Elements which are hidden have cannot be laid out until they are visible. If you use wookmark on a hidden tab layout will not be immediately performed. When the tab is made visible you can manually refresh Wookmark using a trigger on your container.</p>

<pre><code>wookmark.layout(true);
</code></pre>

<p>or</p>

<pre><code>$('#myElementContainer').trigger('refreshWookmark');
</code></pre>

<h3 id="filter">Filter</h3>

<p>You can filter all items of the handler when they have filters specified. See <code>example-filter</code> for details how to do this.
The call to filter will also return the resulting list of items.</p>

<pre><code>wookmark.filter([filters=[]][,mode='or'][,dryRun=false]);
</code></pre>

<p>If you just want to check if there would be a resulting list of items you can call filter with the <code>dryRun</code> option set to <code>true</code>.</p>

<h2 id="annotated-code">Annotated code</h2>

<p>See our <a href="doc/wookmark.html">docco</a>.</p>

<h2 id="included-examples">Included examples</h2>

<p>Some of the examples need the jQuery or imagesLoaded plugins. Be sure to run bower install to have them working.</p>

<h3 id="example">example</h3>

<p>Is the preferred setup. In this scenario the width and height of all images is set in the HTML img attributes.
The grid layout can be performed as soon as the document is rendered, BEFORE images are loaded.</p>

<h3 id="example-load-images">example-load-images</h3>

<p>In this example, the width and height of the images is not known. Via Paul Irish's imagesLoaded plugin (slightly
modified by desandro). The grid layout is performed after all images are loaded and their dimensions can be
retrieved. This approach is much slower. The imagesLoaded plugin can also be found on github right here:
https://github.com/desandro/imagesloaded</p>

<h3 id="example-amd">example-amd</h3>

<p>This example shows how to load and initialize the plugin when using <code>require.js</code> or a different amd loading method.</p>

<h3 id="example-api">example-api</h3>

<p>This example shows how to load the tile data from a remote api and layout it.</p>

<h3 id="example-endless-scroll">example-endless-scroll</h3>

<p>This example shows how to add new tiles at runtime and refresh the layout.</p>

<h3 id="example-filter">example-filter</h3>

<p>This example shows to use the <code>filter</code> feature of the plugin to show just the tiles the user wants.</p>

<h3 id="example-flexible">example-flexible</h3>

<p>This example shows how to use the <code>flexibleWidth</code> option. This option allows your tiles to grow a certain amount, as long as there is room. When using percentage values for the width options you can create a fixed column count layout.</p>

<h3 id="example-lightbox">example-lightbox</h3>

<p>This example shows you how to include a lightbox.</p>

<h3 id="example-placeholder">example-placeholder</h3>

<p>This example shows you how to enable placeholders at the bottom of the tile layout to create an even footer.</p>

<h3 id="example-sort">example-sort</h3>

<p>This example shows how the <code>sort</code> feature works. This option allows you to specify a sorting function which will rearrange your tiles.
For example you can use it to sort your tiles containing products by price, popularity or name.</p>

<h2 id="faq">FAQ</h2>

<h3 id="the-tiles-overlap-after-loading.">The tiles overlap after loading.</h3>

<p>You should use the 'imagesloaded' plugin. Most the examples in this package include the code how to use it.</p>

<h3 id="the-tiles-overlap-after-their-height-is-changed.">The tiles overlap after their height is changed.</h3>

<p>Use the 'finished'-callback of your animation/effect to trigger 'refreshWookmark' on the container element supplied to the plugin.</p>

<h3 id="the-placeholders-at-the-end-of-each-column-have-wrong-heights-or-positions.">The placeholders at the end of each column have wrong heights or positions.</h3>

<p>Set 'position: relative' on your container element and check if there are other elements in the container before your tiles.</p>

<h3 id="my-question-isn%27t-answered-here.">My question isn't answered here.</h3>

<p>Send us some feedback or create an issue on github.</p>

<h2 id="mentioned-or-used-by-others">Mentioned or used by others</h2>

<p>Beware: These links lead to sites which are not necessarily related to the authors of the Wookmark plugin so we don't have any control over their content.</p>

<ul>
<li><a href="http://bitconfig.com/woomark/bitconfig_woomark.html">Customize the plugin online with bitconfig</a></li>
<li><a href="http://typo3.org/extensions/repository/view/yag_themepack_jquery">TYPO3 extension for YAG</a></li>
<li><a href="https://drupal.org/project/views_wookmark">Drupal Wookmark plugin</a></li>
<li><a href="http://theme-hunter.tumblr.com/post/31126746878/creating-tumblr-grid-layouts-with-wookmark">Tumblr template example</a></li>
</ul>

<p>Send a <a href="&#x6d;&#97;&#x69;&#108;&#x74;&#111;:&#x73;&#101;&#x62;&#97;&#x73;&#116;&#105;&#x61;&#110;&#x40;&#104;e&#x6c;&#122;&#x6c;&#101;&#x2e;&#110;e&#x74;">message</a> if you want to be included with your site on this list!</p>

<h2 id="feedback">Feedback</h2>

<p>Please send code specific questions and feedback to <a href="&#x6d;&#97;&#x69;&#108;&#x74;&#111;:&#x73;&#101;&#x62;&#97;&#x73;&#116;&#105;&#x61;&#110;&#x40;&#104;e&#x6c;&#122;&#x6c;&#101;&#x2e;&#110;e&#x74;">Sebastian</a> or contact him on <a href="http://twitter.com/sebobo">twitter</a>.</p>

<p>If you have other questions and feedback which is for example related to Wookmark send a mail to <a href="&#109;&#97;&#x69;&#x6c;&#x74;&#111;&#58;&#99;&#x68;&#x72;i&#64;&#115;&#x74;&#x6f;.&#112;&#104;">Christoph</a> or contact him on <a href="https://twitter.com/gbks">twitter</a>.</p>

<h2 id="contributing">Contributing</h2>

<p>Contribute!</p>
