<h1 id="sheetrock">Sheetrock</h1>

<p><a href="https://travis-ci.org/chriszarate/sheetrock"><img src="https://travis-ci.org/chriszarate/sheetrock.svg?branch=master" alt="Build status" /></a>
<a href="https://codeclimate.com/github/chriszarate/sheetrock/coverage"><img src="https://codeclimate.com/github/chriszarate/sheetrock/badges/coverage.svg" alt="Test coverage" /></a>
<a href="https://codeclimate.com/github/chriszarate/sheetrock/code"><img src="https://codeclimate.com/github/chriszarate/sheetrock/badges/gpa.svg" alt="Code climate" /></a>
<a href="https://badge.fury.io/js/sheetrock"><img src="https://badge.fury.io/js/sheetrock.svg" alt="NPM version" /></a></p>

<p><a href="https://saucelabs.com/u/sheetrock"><img src="https://saucelabs.com/browser-matrix/sheetrock.svg" alt="SauceLabs status" /></a></p>

<p>Sheetrock is a JavaScript library for querying, retrieving, and displaying data
from Google Sheets. In other words, use a Google spreadsheet as your database!
Load entire worksheets or leverage SQL-like queries to sort, group, and filter
data. All you need is the URL of a public Google Sheet.</p>

<p>Sheetrock can be used in the browser or on the server (Node.js). It has no
dependencies—but if jQuery is available, it will register as a plugin.</p>

<p>Basic retrieval is a snap but you can also:</p>

<ul>
<li><p>Query sheets using the SQL-like <a href="https://developers.google.com/chart/interactive/docs/querylanguage">Google Visualization query language</a>
(filters, pivots, sorting, grouping, and more)</p></li>
<li><p>Lazy-load large data sets (infinite scroll with ease)</p></li>
<li><p>Easily mix in your favorite templating system (<a href="http://handlebarsjs.com">Handlebars</a>,
<a href="http://underscorejs.org">Underscore</a>, etc.)</p></li>
<li><p>Customize to your heart’s content with your own callbacks</p></li>
</ul>

<h2 id="browser">Browser</h2>

<p>Grab the <a href="http://chriszarate.github.io/sheetrock/dist/sheetrock.min.js">latest version of Sheetrock</a> for your project. Here’s an
example request (using jQuery):</p>

<pre><code class="html">&lt;table id="my-table"&gt;&lt;/table&gt;
&lt;script src="jquery.min.js"&gt;&lt;/script&gt;
&lt;script src="sheetrock.min.js"&gt;&lt;/script&gt;
</code></pre>

<pre><code class="javascript">$("#my-table").sheetrock({
  url: "https://docs.google.com/spreadsheets/d/1qT1LyvoAcb0HTsi2rHBltBVpUBumAUzT__rhMvrz5Rk/edit#gid=0",
  query: "select A,B,C,D,E,L where E = 'Both' order by L desc"
});
</code></pre>

<p>For many more examples and accompanying jsFiddles, visit
<strong><a href="http://chriszarate.github.io/sheetrock/">chriszarate.github.io/sheetrock</a></strong>.</p>

<h2 id="server">Server</h2>

<p>Sheetrock can also be used with Node.js:</p>

<pre><code class="bash">npm install sheetrock
</code></pre>

<pre><code class="javascript">var sheetrock = require('sheetrock');

var myCallback = function (error, options, response) {
  if (!error) {
    /*
      Parse response.data, loop through response.rows, or do something with
      response.html.
    */
  }
};

sheetrock({
  url: "https://docs.google.com/spreadsheets/d/1qT1LyvoAcb0HTsi2rHBltBVpUBumAUzT__rhMvrz5Rk/edit#gid=0",
  query: "select A,B,C,D,E,L where E = 'Both' order by L desc",
  callback: myCallback
});
</code></pre>

<h2 id="version-1.0">Version 1.0</h2>

<p>In version 1.0, Sheetrock has introduced a few backwards-incompatible changes,
although most basic requests will still work. These changes make it simpler to
use; read the options below or the <a href="https://github.com/chriszarate/sheetrock/blob/master/CHANGELOG.md">CHANGELOG</a> for more details.</p>

<p>The previous <code>0.3.x</code> branch is <a href="https://github.com/chriszarate/sheetrock/tree/0.3.0">still available</a> and maintained.</p>

<h2 id="expectations">Expectations</h2>

<p>Sheetrock is designed to work with any Google Sheet, but makes some assumptions
about the format and availability.</p>

<ul>
<li><p><strong>Public.</strong> In order for others to access the data in your Sheet with
Sheetrock, the Sheet must be public. (<a href="https://support.google.com/drive/bin/answer.py?hl=en&amp;answer=2494822">How do I make a spreadsheet public?</a>)
It is possible to use Sheetrock to access a private Sheet for your own use if
you are logged in to your Google account in the same browser session, but
this is not a supported use case.</p></li>
<li><p><strong>One header row.</strong> Sheetrock expects a single header row of column labels in
the first row of the Sheet. Any other configuration (e.g., no header row,
multiple or offset header rows) can cause problems with the request and
complicates templating. The header row values are used as keys in the cell
object unless you override them using the <code>labels</code> option.</p></li>
<li><p><strong>Plain text.</strong> Sheetrock doesn’t handle formatted text. Any formatting
you’ve applied to your data—including hyperlinks—probably won’t show up.</p></li>
</ul>

<h2 id="options">Options</h2>

<p>Sheetrock expects a hash map of options as a parameter, e.g.:</p>

<pre><code class="javascript">sheetrock({/* options */});
</code></pre>

<p>Your options override Sheetrock’s defaults on a per-request basis. You can also
globally override defaults like this:</p>

<pre><code class="javascript">sheetrock.defaults.url = "https://docs.google.com/spreadsheets/d/1qT1LyvoAcb0HTsi2rHBltBVpUBumAUzT__rhMvrz5Rk/edit#gid=0";
</code></pre>

<h3 id="url">url</h3>

<ul>
<li>Expects string</li>
</ul>

<p>The URL of a public Google Sheet. (<a href="https://support.google.com/drive/bin/answer.py?hl=en&amp;answer=2494822">How do I make a spreadsheet public?</a>)
Make sure you include the <code>#gid=X</code> portion of the URL; it identifies the
specific worksheet you want to use. If you want to access data from multiple
worksheets, you will need to make multiple Sheetrock requests.</p>

<h3 id="query">query</h3>

<ul>
<li>Expects string</li>
<li>Renamed from <code>sql</code> in 1.0.0</li>
</ul>

<p>A <a href="https://developers.google.com/chart/interactive/docs/querylanguage">Google Visualization API query</a> string. Use column letters in your
queries (e.g., <code>select A,B,D</code>).</p>

<h3 id="target">target</h3>

<ul>
<li>Expects DOM element</li>
</ul>

<p>A DOM element that Sheetrock should append HTML output to. In a browser, for
example, you can use <code>document.getElementById</code> to reference a single element.
If you are using Sheetrock with jQuery, you can use the jQuery plugin syntax
(e.g., <code>$('#my-table').sheetrock({/* options */})</code>) and ignore this option.</p>

<h3 id="fetchsize">fetchSize</h3>

<ul>
<li>Expects non-negative integer</li>
<li>Renamed from <code>chunkSize</code> in 1.0.0</li>
</ul>

<p>Use this option to load a portion of the available rows. When set to <code>0</code> (the
default), Sheetrock will fetch all available rows. When set to <code>10</code>, it will
fetch ten rows and keep track of how many rows have been requested. On the next
request with the same query, it will pick up where it left off.</p>

<h3 id="labels">labels</h3>

<ul>
<li>Expects array of strings</li>
</ul>

<p>Override the returned column labels with an array of strings. Without this
option, if you use your own <code>rowTemplate</code>, you must reference column labels
exactly as they are returned by Google’s API. If your <code>sql</code> query uses <code>group</code>,
<code>pivot</code>, or any of the [manipulation functions][manip], you will notice that
Google’s returned column labels can be hard to predict. In those cases, this
option can prove essential. The length of this array must match the number of
columns in the returned data.</p>

<h3 id="rowtemplate">rowTemplate</h3>

<ul>
<li>Expects function</li>
<li>Renamed from <code>rowHandler</code> in 1.0.0</li>
</ul>

<p>By default, Sheetrock will output your data in simple HTML. Providing your own
row template is an easy way to customize the formatting. Your function should
accept a row object. A row object has four properties:</p>

<ul>
<li><p><code>num</code>: The row number (header = <code>0</code>, first data row = <code>1</code>, and so on).</p></li>
<li><p><code>cells</code>: An object with properties named after the column labels from your
header row or the <code>labels</code> option.</p></li>
<li><p><code>cellsArray</code>: An array of values that matches the column order of your Sheet
or your <code>query</code> option. Provided as an alternative to the <code>cells</code> object.</p></li>
<li><p><code>labels</code>: An array of column labels in the same order as <code>cellsArray</code> that
match the properties of the <code>cells</code> object.</p></li>
</ul>

<p>Your function should return a DOM object or an HTML string that is ready to be
appended to your target element. A very easy way to do this is to provide a
compiled <a href="http://handlebarsjs.com">Handlebars</a> or <a href="http://underscorejs.org">Underscore</a> template (which
is itself a function).</p>

<h3 id="callback">callback</h3>

<ul>
<li>Expects function</li>
<li>Renamed from <code>userCallback</code> in 1.0.0</li>
</ul>

<p>You can provide a function to be called when all processing is complete. The
function will be passed the following parameters, in this order:</p>

<ul>
<li><p>Error (object): If the request failed, this parameter will be a JavaScript
error; otherwise, it will be <code>null</code>. Always test for an error before using
the other parameters.</p></li>
<li><p>Options (object): An object representing the options of the request. The
<code>user</code> property will contain the options you originally provided (useful for
identifying which request the callback is for) and a <code>request</code> property with
information about the HTTP request to Google’s API.</p></li>
<li><p>Response (object): An object containing response data properties:</p>

<ul>
<li><p><code>.attributes</code> (object): An object containing useful information about the
response data, its structure, and its format.</p></li>
<li><p><code>.raw</code> (object): This is the raw response data from Google’s API.</p></li>
<li><p><code>.rows</code> (array): An array of row objects (which are also passed individually to
the <code>rowTemplate</code>, if one is provided).</p></li>
<li><p><code>.html</code> (string): A string of HTML representing the final presentational
output of the request (which is also appended to the <code>target</code> or jQuery
reference, if one was provided).</p></li>
</ul></li>
</ul>

<h3 id="reset">reset</h3>

<ul>
<li>Expects Boolean</li>
</ul>

<p>Reset request status. By default, Sheetrock remembers the row offset of a
request, whether a request has been completely loaded already, or if it
previously failed. Set to <code>true</code> to reset these indicators. This is useful if
you want to reload data or load it in another context.</p>

<h2 id="caching">Caching</h2>

<p>On large spreadsheets (~5,000 rows), the performance of Google’s API when using
the <code>query</code> option can be sluggish and, in some cases, can severely affect the
responsiveness of your application. At this point, consider caching the
responses for reuse via a <code>callback</code> function.</p>

<h2 id="tips-and-troubleshooting">Tips and troubleshooting</h2>

<p>The best first step to troubleshooting problems with Sheetrock is to use a
<code>callback</code> function to inspect any errors and response data. Here’s a simple
example that logs all returned data to the console:</p>

<pre><code class="javascript">sheetrock({
  /* options */
  callback: function (error, options, response) {
    console.log(error, options, response);
  }
});
</code></pre>

<h2 id="projects-using-sheetrock">Projects using Sheetrock</h2>

<p>Tell me about your project on the <a href="https://github.com/chriszarate/sheetrock/wiki/Projects-using-Sheetrock">Wiki</a>!</p>

<h2 id="change-log">Change log</h2>

<p><em>See</em> <a href="https://github.com/chriszarate/sheetrock/blob/master/CHANGELOG.md">CHANGELOG.md</a>.</p>

<h2 id="credits-and-license">Credits and license</h2>

<p>Sheetrock was written by <a href="http://chris.zarate.org">Chris Zarate</a>. It was inspired in part by
<a href="http://builtbybalance.com/Tabletop/">Tabletop.js</a> (which will teach you jazz piano). <a href="http://about.me/john.brecht">John Brecht</a>
came up with the name. Sheetrock is released under the <a href="http://opensource.org/licenses/MIT">MIT license</a>.</p>
