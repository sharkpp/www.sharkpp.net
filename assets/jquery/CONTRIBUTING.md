<h1 id="contributing-to-jquery">Contributing to jQuery</h1>

<ol>
<li><a href="#getting-involved">Getting Involved</a></li>
<li><a href="#discussion">Discussion</a></li>
<li><a href="#how-to-report-bugs">How To Report Bugs</a></li>
<li><a href="#jquery-core-style-guide">Core Style Guide</a></li>
<li><a href="#tips-for-bug-patching">Tips For Bug Patching</a></li>
</ol>

<h2 id="getting-involved">Getting Involved</h2>

<p>There are a number of ways to get involved with the development of jQuery core. Even if you've never contributed code to an Open Source project before, we're always looking for help identifying bugs, writing and reducing test cases and documentation.</p>

<p>This is the best way to contribute to jQuery core. Please read through the full guide detailing <a href="#how-to-report-bugs">How to Report Bugs</a>.</p>

<h2 id="discussion">Discussion</h2>

<h3 id="forum-and-irc">Forum and IRC</h3>

<p>The jQuery core development team frequently tracks posts on the <a href="http://forum.jquery.com/developing-jquery-core">jQuery Development Forum</a>. If you have longer posts or questions please feel free to post them there. If you think you've found a bug please <a href="#how-to-report-bugs">file it in the bug tracker</a>.</p>

<p>Additionally most of the jQuery core development team can be found in the <a href="http://webchat.freenode.net/?channels=jquery-dev">#jquery-dev</a> IRC channel on irc.freenode.net.</p>

<h3 id="weekly-status-meetings">Weekly Status Meetings</h3>

<p>Every week (unless otherwise noted) the jQuery core dev team has a meeting to discuss the progress of current work and to bring forward possible new blocker bugs for discussion.</p>

<p>The meeting is held in the <a href="http://webchat.freenode.net/?channels=jquery-meeting">#jquery-meeting</a> IRC channel on irc.freenode.net at <a href="http://www.timeanddate.com/worldclock/fixedtime.html?month=1&amp;day=17&amp;year=2011&amp;hour=12&amp;min=0&amp;sec=0&amp;p1=43">Noon EST</a> on Mondays.</p>

<p><a href="https://docs.google.com/document/d/1MrLFvoxW7GMlH9KK-bwypn77cC98jUnz7sMW1rg_TP4/edit?hl=en">Past Meeting Notes</a></p>

<h2 id="how-to-report-bugs">How to Report Bugs</h2>

<h3 id="make-sure-it-is-a-jquery-bug">Make sure it is a jQuery bug</h3>

<p>Many bugs reported to our bug tracker are actually bugs in user code, not in jQuery code. Keep in mind that just because your code throws an error and the console points to a line number inside of jQuery, this does <em>not</em> mean the bug is a jQuery bug; more often than not, these errors result from providing incorrect arguments when calling a jQuery function.</p>

<p>If you are new to jQuery, it is usually a much better idea to ask for help first in the <a href="http://forum.jquery.com/using-jquery">Using jQuery Forum</a> or the <a href="http://webchat.freenode.net/?channels=%23jquery">jQuery IRC channel</a>. You will get much quicker support, and you will help avoid tying up the jQuery team with invalid bug reports. These same resources can also be useful if you want to confirm that your bug is indeed a bug in jQuery before filing any tickets.</p>

<h3 id="disable-any-browser-extensions">Disable any browser extensions</h3>

<p>Make sure you have reproduced the bug with all browser extensions and add-ons disabled, as these can sometimes cause things to break in interesting and unpredictable ways. Try using incognito, stealth or anonymous browsing modes.</p>

<h3 id="try-the-latest-version-of-jquery">Try the latest version of jQuery</h3>

<p>Bugs in old versions of jQuery may have already been fixed. In order to avoid reporting known issues, make sure you are always testing against the <a href="http://code.jquery.com/jquery.js">latest build</a>.</p>

<h3 id="try-an-older-version-of-jquery">Try an older version of jQuery</h3>

<p>Sometimes, bugs are introduced in newer versions of jQuery that do not exist in previous versions. When possible, it can be useful to try testing with an older release.</p>

<h3 id="reduce%2C-reduce%2C-reduce%21">Reduce, reduce, reduce!</h3>

<p>When you are experiencing a problem, the most useful thing you can possibly do is to <a href="http://webkit.org/quality/reduction.html">reduce your code</a> to the bare minimum required to reproduce the issue. This makes it <em>much</em> easier to isolate and fix the offending code. Bugs that are reported without reduced test cases take on average 9001% longer to fix than bugs that are submitted with them, so you really should try to do this if at all possible.</p>

<h2 id="jquery-core-style-guide">jQuery Core Style Guide</h2>

<p>See: <a href="http://contribute.jquery.org/style-guide/">jQuery's Style Guides</a></p>

<h2 id="tips-for-bug-patching">Tips For Bug Patching</h2>

<h3 id="environment%3A-localhost-w%2F-php%2C-node-%26-grunt">Environment: localhost w/ PHP, Node &amp; Grunt</h3>

<p>Starting in jQuery 1.8, a newly overhauled development workflow has been introduced. In this new system, we rely on node &amp; gruntjs to automate the building and validation of source code—while you write code.</p>

<p>The Ajax tests still depend on PHP running locally*, so make sure you have the following installed:</p>

<ul>
<li>Some kind of localhost server program that supports PHP (any will do)</li>
<li>Node.js</li>
<li>NPM (comes with the latest version of Node.js)</li>
<li>Grunt (install with: <code>npm install grunt -g</code></li>
</ul>

<p>Maintaining a list of platform specific instructions is outside of the scope of this document and there is plenty of existing documentation for the above technologies.</p>

<ul>
<li>The PHP dependency will soon be shed in favor of an all-node solution.</li>
</ul>

<h3 id="build-a-local-copy-of-jquery">Build a Local Copy of jQuery</h3>

<p>Create a fork of the jQuery repo on github at http://github.com/jquery/jquery</p>

<p>Change directory to your web root directory, whatever that might be:</p>

<pre><code class="bash">$ cd /path/to/your/www/root/
</code></pre>

<p>Clone your jQuery fork to work locally</p>

<pre><code class="bash">$ git clone git@github.com:username/jquery.git
</code></pre>

<p>Change directory to the newly created dir jquery/</p>

<pre><code class="bash">$ cd jquery
</code></pre>

<p>Add the jQuery master as a remote. I label mine "upstream"</p>

<pre><code class="bash">$ git remote add upstream git://github.com/jquery/jquery.git
</code></pre>

<p>Get in the habit of pulling in the "upstream" master to stay up to date as jQuery receives new commits</p>

<pre><code class="bash">$ git pull upstream master
</code></pre>

<p>Run the Grunt tools:</p>

<pre><code class="bash">$ grunt &amp;&amp; grunt watch
</code></pre>

<p>Now open the jQuery test suite in a browser at http://localhost/test. If there is a port, be sure to include it.</p>

<p>Success! You just built and tested jQuery!</p>

<h3 id="fix-a-bug-from-a-ticket-filed-at-bugs.jquery.com%3A">Fix a bug from a ticket filed at bugs.jquery.com:</h3>

<p><strong>NEVER write your patches to the master branch</strong> - it gets messy (I say this from experience!)</p>

<p><strong>ALWAYS USE A "TOPIC" BRANCH!</strong> Like so (#### = the ticket #)...</p>

<p>Make sure you start with your up-to-date master:</p>

<pre><code class="bash">$ git checkout master
</code></pre>

<p>Create and checkout a new branch that includes the ticket #</p>

<pre><code class="bash">$ git checkout -b bug_####

# ( Explanation: this useful command will:
# "checkout" a "-b" (branch) by the name of "bug_####"
# or create it if it doesn't exist )
</code></pre>

<p>Now you're on branch: bug_####</p>

<p>Determine the module/file you'll be working in...</p>

<p>Open up the corresponding /test/unit/?????.js and add the initial failing unit tests. This may seem awkward at first, but in the long run it will make sense. To truly and efficiently patch a bug, you need to be working against that bug.</p>

<p>Next, open the module files and make your changes</p>

<p>Run http://localhost/test --> <strong>ALL TESTS MUST PASS</strong></p>

<p>Once you're satisfied with your patch...</p>

<p>Stage the files to be tracked:</p>

<pre><code class="bash">$ git add filename
# (you can use "git status" to list the files you've changed)
</code></pre>

<p>( I recommend NEVER, EVER using "git add . " )</p>

<p>Once you've staged all of your changed files, go ahead and commit them</p>

<pre><code class="bash">$ git commit -m "Brief description of fix. Fixes #0000"
</code></pre>

<p>For a multiple line commit message, leave off the <code>-m "description"</code>.</p>

<p>You will then be led into vi (or the text editor that you have set up) to complete your commit message.</p>

<p>Then, push your branch with the bug fix commits to your github fork</p>

<pre><code class="bash">$ git push origin -u bug_####
</code></pre>

<p>Before you tackle your next bug patch, return to the master:</p>

<pre><code class="bash">$ git checkout master
</code></pre>

<h3 id="test-suite-tips...">Test Suite Tips...</h3>

<p>During the process of writing your patch, you will run the test suite MANY times. You can speed up the process by narrowing the running test suite down to the module you are testing by either double clicking the title of the test or appending it to the url. The following examples assume you're working on a local repo, hosted on your localhost server.</p>

<p>Example:</p>

<p>http://localhost/test/?filter=css</p>

<p>This will only run the "css" module tests. This will significantly speed up your development and debugging.</p>

<p><strong>ALWAYS RUN THE FULL SUITE BEFORE COMMITTING AND PUSHING A PATCH!</strong></p>

<h3 id="browser-support">Browser support</h3>

<p>Remember that jQuery supports multiple browsers and their versions; any contributed code must work in all of them. You can refer to the <a href="http://jquery.com/browser-support/">browser support page</a> for the current list of supported browsers.</p>

<p>Note that browser support differs depending on whether you are targeting the <code>master</code> or <code>1.x-master</code> branch.</p>
