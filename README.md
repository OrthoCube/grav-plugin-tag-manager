# Tag Manager Plugin

The **Tag Manager** Plugin is an extension for [Grav CMS](http://github.com/getgrav/grav) for renaming and deleting tags

## Installation

Installing the Tag Manager plugin can be done in one of three ways: The GPM (Grav Package Manager) installation method lets you quickly install the plugin with a simple terminal command, the manual method lets you do so via a zip file, and the admin method lets you do so via the Admin Plugin.

### GPM Installation (Preferred)

To install the plugin via the [GPM](http://learn.getgrav.org/advanced/grav-gpm), through your system's terminal (also called the command line), navigate to the root of your Grav-installation, and enter:

    bin/gpm install tag-manager

This will install the Tag Manager plugin into your `/user/plugins`-directory within Grav. Its files can be found under `/your/site/grav/user/plugins/tag-manager`.

### Manual Installation

To install the plugin manually, download the zip-version of this repository and unzip it under `/your/site/grav/user/plugins`. Then rename the folder to `tag-manager`. You can find these files on [GitHub](https://github.com/orthocube/grav-plugin-tag-manager) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/tag-manager
	
> NOTE: This plugin is a modular component for Grav which may require other plugins to operate, please see its [blueprints.yaml-file on GitHub](https://github.com/orthocube/grav-plugin-tag-manager/blob/master/blueprints.yaml).

### Admin Plugin

If you use the Admin Plugin, you can install the plugin directly by browsing the `Plugins`-menu and clicking on the `Add` button.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/tag-manager/tag-manager.yaml` to `user/config/plugins/tag-manager.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

Note that if you use the Admin Plugin, a file with your configuration named tag-manager.yaml will be saved in the `user/config/plugins/`-folder once the configuration is saved in the Admin.

## Usage

Choose the taxonomy to operate on, enter the name of the tag you want to delete (or the name of the tag you want to rename and its new name) and click the appropriate button. All pages within the `/blog` directory will be scanned, and if necessary, their tags edited and saved. 

## To Do

- [ ] Make the directory to search for changeable via the plugin configuration.