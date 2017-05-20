/**
 * Original author: Naoki Okamura (Nyarla) <thotep@nyarla.net>
 * Adapter: drry
 * This script is in the public domain.
 */
(function() {
  var appxhtml = "application/xhtml+xml";
  if (typeof window.DOMParser == "undefined" ||
      typeof document.contentType == "string" &&
      document.contentType != appxhtml) {
    return;
  }
  var parser = new DOMParser;
  var generateHTMLDOM = function(text) {
    text = '<div xmlns="http://www.w3.org/1999/xhtml">' + text + "</div>";
    var dom, root;
    try {
      dom  = parser.parseFromString(text, appxhtml);
      root = dom.documentElement;
    } catch (e) {
      return null;
    }
    if (root.nodeName == "parsererror") {
      return null;
    }
    return root;
  };
  var lastNode         = null;
  var getReferenceNode = function(node) {
    if (node && node.nodeName && node.nodeName == "script") {
      return node;
    }
    var element;
    if (node.lastChild && (element = arguments.callee(node.lastChild))) {
      return element;
    }
    return lastNode;
  };
  var buffer    = [];
  var writeHTML = function(contents, refNode) {
    if (lastNode && lastNode != refNode) {
      refNode = lastNode;
    }
    buffer = buffer.concat(contents);
    var dom = generateHTMLDOM(buffer.join(""));
    var parent, node, length, i = 0;
    if (dom) {
      buffer = [];
      parent = refNode.parentNode;
      length = dom.childNodes.length;
      while (i < length) {
        if (node = dom.childNodes.item(i++).cloneNode(true)) {
          parent.insertBefore(node, refNode.nextSibling);
          refNode = node;
        }
      }
    }
    lastNode = refNode;
  };
  document.write = function() {
    writeHTML(Array.prototype.slice.call(arguments),
              getReferenceNode(document));
  };
  document.writeln = function() {
    writeHTML(Array.prototype.slice.call(arguments).concat("\n"),
              getReferenceNode(document));
  };
})();
