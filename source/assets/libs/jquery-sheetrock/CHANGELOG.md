<h2 id="change-log">Change Log</h2>

<h3 id="v1.2.0">v1.2.0</h3>

<ul>
<li>Trigger event on element when data is loaded (#145).</li>
<li>Update dependencies and switch to Rollup (#144).</li>
</ul>

<h3 id="v1.1.4">v1.1.4</h3>

<ul>
<li>Allow default callback to be overridden. (#113).</li>
</ul>

<h3 id="v1.1.3">v1.1.3</h3>

<ul>
<li>Don't catch errors thrown in user template (#111).</li>
</ul>

<h3 id="v1.1.2">v1.1.2</h3>

<ul>
<li>Fix by @papoms for requests that fail after use of reset option (#104).</li>
</ul>

<h3 id="v1.1.1">v1.1.1</h3>

<ul>
<li>Fix error when parsing null cell values (fixes #101).</li>
<li>Better error handling of invalid URLs.</li>
</ul>

<h3 id="v1.1.0">v1.1.0</h3>

<ul>
<li>Rewritten in ES2015.</li>
<li>Changes to API:

<ul>
<li>removed non-authoritative <code>.environment</code></li>
</ul></li>
<li>Standard UMD provided by Webpack.</li>
</ul>

<h3 id="v1.0.1">v1.0.1</h3>

<ul>
<li>Webpack support.</li>
<li>Use formatted numbers (percentages, x decimal places) when available. (@niceandserious)</li>
<li>Smaller minified dist version.</li>
</ul>

<h3 id="v1.0.0">v1.0.0</h3>

<ul>
<li>No longer depends on jQuery</li>
<li>Use in browser or on server (with or without virtual DOM)</li>
<li>Module renamed from jquery-sheetrock to sheetrock</li>
<li>Now expects a single header row in row 1</li>
<li>Passes consistent row numbers to the row template, starting at <code>1</code></li>
<li>Changes to API:

<ul>
<li>added <code>.environment</code> to expose detected features to user</li>
<li>renamed <code>.options</code> to <code>.defaults</code></li>
<li>removed <code>.promise</code> (requests are no longer chained)</li>
<li>removed <code>.working</code> (use callback function to determine request status)</li>
</ul></li>
<li>Changes to defaults:

<ul>
<li>added <code>target</code> as alternative to jQuery's <code>this</code></li>
<li>renamed <code>sql</code> to <code>query</code></li>
<li>renamed <code>chunkSize</code> to <code>fetchSize</code></li>
<li>renamed <code>resetStatus</code> to <code>reset</code></li>
<li>renamed <code>rowHandler</code> to <code>rowTemplate</code></li>
<li>renamed <code>userCallback</code> to <code>callback</code> (but passes different paramaters)</li>
<li>removed <code>server</code> (pass bootstrapped data instead)</li>
<li>removed <code>columns</code> (always use column letters in query)</li>
<li>removed <code>cellHandler</code> (use rowTemplate for text formatting)</li>
<li>removed <code>errorHandler</code> (errors are passed to callback function)</li>
<li>removed <code>loading</code> (use callback function to manipulate UI)</li>
<li>removed <code>rowGroups</code> (<code>&amp;lt;thead&amp;gt;</code> and <code>&amp;lt;tbody&amp;gt;</code> are added when
<code>target</code> is a <code>&amp;lt;table&amp;gt;</code>)</li>
<li>removed <code>formatting</code> (almost useless, impossible to support)</li>
<li>removed <code>headers</code> (multiple header rows cause myriad problems)</li>
<li>removed <code>headersOff</code> (use rowTemplate to show or hide rows)</li>
<li>removed <code>debug</code> (compiled messages are passed to callback function)</li>
</ul></li>
</ul>

<h3 id="v0.3.0">v0.3.0</h3>

<ul>
<li>Published as NPM module (can be required and Browserified).</li>
<li>Better loading default prevents option being set to empty string.</li>
</ul>

<h3 id="v0.2.4">v0.2.4</h3>

<ul>
<li>Avoid reserved keyword "new" to satisfy YUI compressor.</li>
</ul>

<h3 id="v0.2.3">v0.2.3</h3>

<ul>
<li>CommonJS support.</li>
<li>Move minified files to /dist.</li>
<li>Load Prism JS and CSS from CloudFlare's CDN.</li>
</ul>

<h3 id="v0.2.2">v0.2.2</h3>

<ul>
<li>Improved error handling and provide failure tests.</li>
</ul>

<h3 id="v0.2.1">v0.2.1</h3>

<ul>
<li>Handle null cell values (#37).</li>
</ul>

<h3 id="v0.2.0">v0.2.0</h3>

<ul>
<li>Compatibility with the new version of Google Spreadsheets! (#33)</li>
<li>Add <code>errorHandler</code> option to allow user to do something with AJAX errors.</li>
<li>Simple tests using QUnit.</li>
</ul>

<h3 id="v0.1.10">v0.1.10</h3>

<ul>
<li>Update key extraction to work with the new version of Google Spreadsheets
(see #31).</li>
<li>Add note about (hopefully temporary) incompatibility with the new version of
Google Spreadsheets (see #31).</li>
</ul>

<h3 id="v0.1.9">v0.1.9</h3>

<ul>
<li>Avoid array-like cell values (see #23).</li>
</ul>

<h3 id="v0.1.8">v0.1.8</h3>

<ul>
<li>Moved caching of row offset to options validation function (see #18).</li>
</ul>

<h3 id="v0.1.7">v0.1.7</h3>

<ul>
<li>Added change log.</li>
<li>Move plugin code into <code>src</code> subfolder.</li>
<li>New <code>resetStatus</code> option resets the row offest, loaded, and error indicators
on a per-unique-request basis. This is useful if you want to reload data,
retry after an error, or load data in another context.</li>
<li>Row offest, loaded, and error indicators were previously stored as data
attributes on the target DOM element. This created an undesirable 1:1
correspondence between requests and DOM elements. These indicators are now
stored internally and indexed per unique request. They can be reset using
the <code>resetStatus</code> option.</li>
<li>Default for <code>rowGroups</code> options is now <code>true</code>. When using the default row
handler, table tags <code>&amp;lt;thead&amp;gt;</code> and <code>&amp;lt;tbody&amp;gt;</code> are used by default.</li>
<li>Moved <code>server</code> option from public property (<code>$.fn.sheetrock.server</code>) to
undocumented option. This allows per-request configuration of the Google API
endpoint.</li>
<li>Public property <code>$.fn.sheetrock.working</code> is now Boolean, since there can
only be one AJAX request at a time.</li>
<li>Consolidate documentation in <code>README.md</code> and examples on <code>gh-pages</code> branch.
On examples page, dynamically load source code from content of page. Check
it out!</li>
<li>Sheetrock now passes linting with JSHint.</li>
<li>Better comments, more descriptive variable names.</li>
</ul>
