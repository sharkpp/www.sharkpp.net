<h1 id="changes">Changes</h1>

<h2 id="2.0.1">2.0.1</h2>

<ul>
<li>CHG: !!! We start to rename the plugin to <code>wookmark</code> instead of <code>wookmark-jquery</code>. Also the repository moved to https://github.com/germanysbestkeptsecret/Wookmark-jQuery.</li>
<li>CHG: Cleanup of package files, readme, plugin name</li>
<li>FIX: Correct filename in <code>main</code> property in bower.json</li>
<li>FIX: Error when creating more than one grid with jQuery</li>
<li>FIX: Use proper update function. Patch by Raik Osiablo. Thanks!</li>
<li>FIX: Replaced some strange unicode characters by spaces. Patch by weberho. Thanks!</li>
<li>FIX: Remove active filters on click again in filter example. Patch by Patrick Ludewig. Thanks!</li>
<li>FIX: Remove moot <code>version</code> property from bower.json. Patch by Kevin Kirsche. Thanks!</li>
<li>ADD: Basic rtfd.org integration to render documentation</li>
<li>ADD: Basic travis-ci integration to show build results</li>
<li>ADD: Gitter integration to create a community space</li>
<li>ADD: Inital browserstack integration for cross browser testing</li>
</ul>

<h2 id="2.0.0">2.0.0</h2>

<ul>
<li>CHG: !!! Rewrite of plugin to work without jQuery</li>
<li>CHG: !!! New initialization code (see the readme)</li>
<li>CHG: !!! jQuery and imagesloaded plugins are now installed with bower</li>
<li>CHG: Source is now lint-free and much more optimized for speed</li>
<li>CHG: Ignoring most files when installing with bower</li>
<li>ADD: itemWidth and flexibleWidth can now be functions returning a number or percentage</li>
</ul>

<h2 id="1.4.8">1.4.8</h2>

<ul>
<li>FIX: In jQuery amd dependency. Patch by Guido Contreras Woda. Thanks!</li>
<li>ADD: Waffle.io badge. Will check out if it's cool to manage issues there.</li>
<li>CHG: Using MagnificPopup instead of Colorbox in examples. Works better with endless scroll and filtering.</li>
</ul>

<h2 id="1.4.7">1.4.7</h2>

<ul>
<li>ADD: <code>example-api</code> now has an additional example for a custom php based server app</li>
<li>FIX: Example amd was missing required shim so imagesLoaded plugin attaches itself to jQuery</li>
<li>ADD: "Mentioned or used by others" section to readme</li>
<li>ADD: dryRun feature for filtering and the filter call will return the list resulting list of items as jQuery object</li>
<li>CHG: Small optimization for window object</li>
<li>CHG: Starting opacity for list items in examples is now 1 so opacity animations have a starting point</li>
</ul>

<h2 id="1.4.6">1.4.6</h2>

<ul>
<li>New option 'verticalOffset'. Old option 'offset' still defines the horizontal offset between tiles.</li>
<li>Added 'Reset filters' button to filter examples.</li>
<li>'flexibleWidth' will now be handled a bit differently. When set the plugin will try to fit as many columns into the container as possible. <code>itemWidth</code> is then the minimum width of those columns.</li>
</ul>

<h2 id="1.4.5">1.4.5</h2>

<ul>
<li>Fix for placeholders in non-chrome browsers.</li>
<li>The clear method of the wookmark instance will remove the instance itself.</li>
<li>New introduction page with links to examples. Will work on that further on the way to 1.5.0.</li>
<li>Fixed bug in example-amd with requirejs.</li>
<li>CSS changes will be executed as bulk with requestAnimationFrame when available.</li>
<li>Added progressbar to imagesloaded example.</li>
<li>Filterclasses can be updated via the wookmarkInstance of the handler.</li>
</ul>

<h2 id="1.4.4">1.4.4</h2>

<ul>
<li>Wookmark layouting won't break when container isn't visible at the start. But you should call 'refreshWookmark' after making it visible.</li>
<li>Added 'possibleFilters' option. With this you can have filter even when no items fit. Patch by Aakash Goel. Thanks!</li>
<li>Fix when filtering and no items match. Patch by Gabriel Kaam. Thanks!</li>
</ul>

<h2 id="1.4.3">1.4.3</h2>

<ul>
<li>Enabled option 'direction'. This was an internal setting and can now be overriden to order the items from one direction but align them to a different side.</li>
</ul>

<h2 id="1.4.2">1.4.2</h2>

<ul>
<li>'flexibleWidth' now works as expected when it's greater than 50% or more than half of the containers width in pixels.</li>
</ul>

<h2 id="1.4.1">1.4.1</h2>

<ul>
<li>New option 'outerOffset'. Optional offset to the sides of the tiles. The old 'offset' will only be used between tiles.</li>
</ul>

<h2 id="1.4.0">1.4.0</h2>

<ul>
<li>New option 'comparator'. A comparison function which can be used to sort the items before they are positioned in the layout.</li>
<li>Offset for first column is now correctly set when align is 'left' or 'right'.</li>
<li>Column count behaviour improved, when browser window is resized.</li>
</ul>

<h2 id="1.3.1">1.3.1</h2>

<ul>
<li>New option 'ignoreInactiveItems'. When set to 'false' inactive items will still be shown when filtered. This can be used to fade out filtered items. See the example-filter/fade.html example.</li>
</ul>

<h2 id="1.3.0">1.3.0</h2>

<ul>
<li>New option 'fillEmptySpace' which creates placeholders at the bottom of the columns to create an even layout. See 'example-placeholder' on how to use it.</li>
</ul>

<h2 id="1.2.3">1.2.3</h2>

<ul>
<li>FIX: layout now checks if active item count has changed and does a full relayout when that happens</li>
</ul>

<h2 id="1.2.2">1.2.2</h2>

<ul>
<li>ADD: Wookmark can now be loaded as amd module</li>
<li>FIX: Using load images function in all examples, so no specific load images example has been removed</li>
<li>CHG: Some refactoring and cleanup in all examples</li>
</ul>

<h2 id="1.2.1">1.2.1</h2>

<ul>
<li>ADD: Include filtering capability, see the examples in the example-filter folder</li>
<li>FIX: Error when the layout tries to render less than 1 column</li>
</ul>
