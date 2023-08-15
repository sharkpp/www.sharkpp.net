---
title: "JSDoc を macOS で使ってみる"
date: 2023-01-08 99:99
tags: [雑記, jsdoc, macos, homebrew]
categories: [ブログ]

---

JavaScript で書かれたドキュメントがないライブラリのドキュメントをが必要となったので、ドキュメントジェネレータである JSDoc を試してみる。

インストールは Homebrew で `[brew install jsdoc3](https://formulae.brew.sh/formula/jsdoc3)` としてインストールすれば簡単。

```console
% jsdoc --help
JSDoc 4.0.0 (Thu, 03 Nov 2022 18:37:15 GMT)

Options:
    -a, --access <value>         Only display symbols with the given access: "package", public", "protected", "private" or "undefined", or "all" for
                                 all access levels. Default: all except "private"
    -c, --configure <value>      The path to the configuration file. Default: path/to/jsdoc/conf.json
    -d, --destination <value>    The path to the output folder. Default: ./out/
    --debug                      Log information for debugging JSDoc.
    -e, --encoding <value>       Assume this encoding when reading all source files. Default: utf8
    -h, --help                   Print this message and quit.
    --match <value>              When running tests, only use specs whose names contain <value>.
    --nocolor                    When running tests, do not use color in console output.
    -p, --private                Display symbols marked with the @private tag. Equivalent to "--access all". Default: false
    -P, --package <value>        The path to the project's package file. Default: path/to/sourcefiles/package.json
    --pedantic                   Treat errors as fatal errors, and treat warnings as errors. Default: false
    -q, --query <value>          A query string to parse and store in jsdoc.env.opts.query. Example: foo=bar&baz=true
    -r, --recurse                Recurse into subdirectories when scanning for source files and tutorials.
    -R, --readme <value>         The path to the project's README file. Default: path/to/sourcefiles/README.md
    -t, --template <value>       The path to the template to use. Default: path/to/jsdoc/templates/default
    -T, --test                   Run all tests and quit.
    -u, --tutorials <value>      Directory in which JSDoc should search for tutorials.
    -v, --version                Display the version number and quit.
    --verbose                    Log detailed information to the console as JSDoc runs.
    -X, --explain                Dump all found doclet internals to console and quit.

Visit https://jsdoc.app/ for more information.
```




## 参考

* [JSDoc使い方メモ - Qiita](https://qiita.com/opengl-8080/items/a36679f7926f4cac0a81)
* [Use JSDoc: ES 2015 Classes](https://jsdoc.app/howto-es2015-classes.html)
* [jsdoc3 - How can I omit the source links in JsDoc? - Stack Overflow](https://stackoverflow.com/questions/20907501/how-can-i-omit-the-source-links-in-jsdoc)
