<h1 id="lightbox2">Lightbox2</h1>

<p>The original lightbox script. Eight years later — still going strong!</p>

<p>Lightbox is small javascript library used to overlay images on top of the current page. It's a snap to setup and works on all modern browsers.</p>

<p>For demos and usage instructions, visit <a href="http://lokeshdhakar.com/projects/lightbox2/">lokeshdhakar.com/projects/lightbox2/</a>.</p>

<p>by <a href="http://www.lokeshdhakar.com">Lokesh Dhakar</a></p>

<h2 id="roadmap">Roadmap</h2>

<ul>
<li><strong>Maintenance.</strong> No substantial features are being worked on till all open Pull Requests and Issues have been reviewed.</li>
<li><strong>Documentation.</strong> Main features and options need to be documented.</li>
</ul>

<h2 id="changelog">Changelog</h2>

<h3 id="v2.8.0---unreleased">v2.8.0 - UNRELEASED</h3>

<ul>
<li>[ ] Document options.</li>
<li>[ ] Add build steps to readme.</li>
<li>[ ] Add module compatibility (AMD, etc).</li>
</ul>

<h3 id="v2.7.4---2015-06-23">v2.7.4 - 2015-06-23</h3>

<ul>
<li>[Change] Revert jquery dep version to 2.x from 1.x. Added note to Lightbox page about using jQuery 1.x to get IE6, 7, and 8 support.</li>
</ul>

<h3 id="v2.7.3---2015-06-22">v2.7.3 - 2015-06-22</h3>

<ul>
<li>[Add] Barebone HTML file with examples /examples/index.html.</li>
<li>[Add] jquery.lightbox.js which concatenates jQuery and Lightbox. This is for those who are Bower averse or want an extra easy install.</li>
</ul>

<h3 id="v2.7.2---2015-06-16">v2.7.2 - 2015-06-16</h3>

<ul>
<li>[Add] maxWidth and maxHeight options added <a href="https://github.com/lokesh/lightbox2/pull/197">#197</a></li>
<li>[Add] Enable target attribute in caption links <a href="https://github.com/lokesh/lightbox2/pull/299">#299</a></li>
<li>[Change] Switched to The MIT License from  Creative Commons Attribution 4.0 International License.</li>
<li>[Change] Add CSS and images to bower.json main property.</li>
<li>[Change] Dropped version property from bower.json. <a href="https://github.com/lokesh/lightbox2/pull/453">#453</a></li>
<li>[Change] Use src -> dist folder structure for build.</li>
<li>[Fix] Remove empty src attribute from img tag <a href="https://github.com/lokesh/lightbox2/pull/287">#287</a></li>
<li>[Fix] Correct grammatical error in comment <a href="https://github.com/lokesh/lightbox2/pull/224">#224</a></li>
<li>[Fix] Clear the jquery animation queue before hiding the .lb-loader <a href="https://github.com/lokesh/lightbox2/pull/309">#309</a></li>
<li>[Remove] Remove releases's zips from repo.</li>
</ul>

<h3 id="v2.7.1---2014-03-30">v2.7.1 - 2014-03-30</h3>

<ul>
<li>[Fix] Enable links in captions</li>
</ul>

<h3 id="v2.7.0---2014-03-29">v2.7.0 - 2014-03-29</h3>

<ul>
<li>[Add] Support for data-title attribute for the caption - Thanks https://github.com/copycut</li>
<li>[Add] New option to enable always visible prev and next arrows</li>
<li>[Change] Rewrite Coffeescript code into plain ole Javascript</li>
<li>[Change] Updated jQuery to v1.10.2</li>
<li>[Fix] prev/next arrows not appearing in IE9 and IE 10 - Thanks https://github.com/rebizu</li>
<li>[Fix]  Support wrap around option w/keyboard actions. Thanks https://github.com/vovayatsyuk</li>
</ul>

<h3 id="v2.6.0---2013-07-06">v2.6.0 - 2013-07-06</h3>

<ul>
<li>[Add] Added wraparound option</li>
<li>[Add] Added fitImagesInViewport option - now mobile friendly</li>
<li>[Add] Added showImageNumber label</li>
<li>[Add] Compatibility with html5shiv</li>
<li>[Add] Html5 valid using new data-lightbox attribute</li>
<li>[Add] Compatibility with hmtl5shiv and modernizr</li>
<li>[Add] Support jquery 1.9+</li>
<li>[Change] Move reference to loading and close images into css</li>
<li>[Change] Cache jquery objects</li>
</ul>

<h3 id="v2.5.0---2012-04-11">v2.5.0 - 2012-04-11</h3>

<ul>
<li>[Change] Switch to jQuery from Prototype and Scriptaculous</li>
<li>[Change] Switch from Javacript to Coffeescript</li>
<li>[Change] Switch from CSS to SASS</li>
<li>[Add] Repo created on Github</li>
</ul>
