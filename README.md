# www.sharkpp.net powered by Sculpin [![Build Status](https://travis-ci.org/sharkpp/www.sharkpp.net.svg?branch=master)](https://travis-ci.org/sharkpp/www.sharkpp.net)

www.sharkpp.net for a Sculpin based web site.

Powered by [Sculpin](http://sculpin.io).

## setup

Initilize **Sculpin** and site pages assets.

```bash
# ./site init
```

## generate

Generate site pages by **Sculpin**.

```bash
# ./site generate [OUTPUT_PATH]
```

## test with built-in server

Launch built-in server. Please test the pages that are generated are connected by a browser to http://localhost:8000/.

```bash
# ./site test
```

## broken link check

Launch built-in server and broken link check for all internal links.

```bash
# ./site spider
```

## create new empty page

Create new blog page to `source/_posts/2015-05-30-[STUB].md`

```bash
# ./site new [STUB]
```

## License

&copy; 2004-2015 sharkpp

This page is licensed under a [Creative Commons Attribution 4.0 International License](http://creativecommons.org/licenses/by/4.0/).

Code snippets are additionally licensed under [The MIT License](http://opensource.org/licenses/MIT).
