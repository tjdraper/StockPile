#StockPile 1.0.0 for Statamic

A Statamic plugin to set content in a template and retrieve it in the layout (or at any point after it’s set.).

## Usage:

Set the content in your template:

	{{ stockpile:set name="my_content" content="Hello World" }}

or

	{{ stockpile:set name="my_content" }}Hello World{{ /stockpile:set }}

And then get the content:

	{{ stockpile:get name="my_content" }}

Note that you have to get the content at a point **after** it has been set. You cannot have a get before the set. Templates are always parsed first, partials in templates are parsed in place (so gets in partials have to come after sets in templates), then layouts are parsed. So you can have a set anywhere in a template, then get that content in a layout, or a partial in a layout.

## {{ stockpile:set }}

This is the tag used to set data. If you are manually setting text (no variables), then you can use the content="Hello World" parameter instead of the tag pair like this:

	{{ stockpile:set name="my_content" content="Hello World" }}

For more complicated needs, use the tag pair:

	{{ stockpile:set name="my_content" }}Hello World{{ /stockpile:set }}

This will let you parse variables within the tag pair. Speaking of which:

### parse_tags="yes"

It is more efficient to leave this parameter off if you do not need it. However, if you need to parse the content you are setting (which is probably more often the case than not), use this parameter.

### name="" (required)

You have to give your content a name so you can get it.

## {{ stockpile:get }}

Use this tag to retrieve the contents of your set tag. This tag has only one parameter:

### name="my_content" (required)

This is the only parameter and it is required. Stockpile needs to know what content to get.

## Example

In my workflow, I have several templates, a couple of layouts, and a common header and footer partial. This allows me to be extremely dry and always use the same header and footer. The trouble is that on a few occasions here and there, I need to pass a page title to the &lt;title&gt; tag in the header partial. The primary use case for this is a taxonomy page. So here is how I did it:

First I set my title in the taxonomy template:

	{{ stockpile:set name="meta_title" parse_tags="yes" }}{{ segment_2|deslugify|title }}{{ /stockpile:set }}

Then I get it conditionally in my header partial:

	<title>{{ if title }}{{ title }}{{ else }}{{ stockpile:get name="meta_title" }}{{ endif }}{{ if get:page != "" }}{{ get_content from="/" }} | {{ meta_title_suffix|smartypants }}{{ /get_content }}</title>

That's my primary use case right now, but I'm sure there's a lot of other uses this can be put to.

## License

Copyright 2014 TJ Draper.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.