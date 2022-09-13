# timeago: a jQuery plugin

[![NPM](https://img.shields.io/npm/v/timeago.svg)](https://www.npmjs.com/package/timeago)
[![Bower](https://img.shields.io/bower/v/jquery-timeago.svg)](http://bower.io/search/?q=jquery-timeago)

Timeago is a jQuery plugin that makes it easy to support automatically updating
fuzzy timestamps (e.g. "4 minutes ago" or "about 1 day ago") from ISO 8601
formatted dates and times embedded in your HTML (à la microformats).

## Usage

First, load jQuery and the plugin:

```html
<script src="jquery.min.js" type="text/javascript"></script>
<script src="jquery.timeago.js" type="text/javascript"></script>
```

Now, let's attach it to your timestamps on DOM ready - put this in the head
section:

```html
<script type="text/javascript">
   jQuery(document).ready(function() {
     $("time.timeago").timeago();
   });
</script>
```

This will turn all `<time>` elements with a class of `timeago` and a
`datetime` attribute formatted according to the
[ISO 8601](http://en.wikipedia.org/wiki/ISO_8601) standard:

```html
<time class="timeago" datetime="2011-12-17T09:24:17Z">December 17, 2011</time>
```

into something like this:

```html
<time class="timeago" datetime="2011-12-17T09:24:17Z" title="December 17, 2011">about 1 day ago</time>
```

`<abbr>` elements (or any other HTML elements) are also supported (this is for
[legacy microformat support](http://microformats.org/wiki/datetime-design-pattern)
and was originally supported by the library before the `time` element was
introduced to HTML5):

```html
<abbr class="timeago" title="2011-12-17T09:24:17Z">December 17, 2011</abbr>
```

As time passes, the timestamps will automatically update.

If you want to update a timestamp programatically later, call the `update`
function with a new ISO8601 timestamp of `Date` object. For example:

```javascript
$("time#some_id").timeago("update", "2013-12-17T09:24:17Z");
// or
$("time#some_id").timeago("update", new Date());
```

**For different language configurations**: visit the [`locales`](https://github.com/rmm5t/jquery-timeago/tree/master/locales) directory.

## Settings

**`cutoff`** : Return the original date if time distance is older than `cutoff` (miliseconds).

```javascript
// Display original dates older than 24 hours
jQuery.timeago.settings.cutoff = 1000*60*60*24;
```

## Changes
