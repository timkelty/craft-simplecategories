# Simple Categories plugin for Craft CMS

Categories fieldtype as simple checkboxes.

## Installation

To install Simple Categories, follow these steps:

1. Download & unzip the file and place the `simplecategories` directory into your `craft/plugins` directory
2.  -OR- do a `git clone https://github.com/timkelty/craft-simplecategories.git` directly into your `craft/plugins` folder.  You can then update it with `git pull`
3.  -OR- install with Composer via `composer require timkelty/craft-simplecategories`
4. Install plugin in the Craft Control Panel under Settings > Plugins
5. The plugin folder should be named `simplecategories` for Craft to see it.  GitHub recently started appending `-master` (the branch name) to the name of the folder for zip file downloads.

Simple Categories works on Craft 2.4.x and Craft 2.5.x.

Brought to you by [Tim Kelty](http://fusionary.com/)

## Caveats

"Limit" validation gets a little weird when using categories with multiple levels. When you select nested category, you're also selecting its parent, so with a limit of 1 you wouldn't be able to select anything from a nested level.
