# Gii ModelDoc Generator for Yii

ModelDoc Generator will extend Gii too allow you to update your existing models with [phpDoc](http://www.phpdoc.org/) compatible documentation.


### Contents

- [Features](#features)
- [Screenshots](#screenshots)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Notes](#notes)
- [Resources](#resources)
- [License](#license)


## Features

- Adds properties for each field in the table.
- Adds a property for each relation.
- Adds methods inherited from CActiveRecord
- Adds methods assigned from each behavior, unless it is defined by the model itself.
- All methods contain full syntax, including params and returns.


## Screenshots

Listing all the models that are going to have phpDocs inserted:
![Files](https://raw.github.com/cornernote/gii-modeldoc-generator/master/screenshot/files.png)

Preview of the model before it gets updated:
![Preview](https://raw.github.com/cornernote/gii-modeldoc-generator/master/screenshot/preview.png)


## Installation

Please download using ONE of the following methods:


### Composer Installation

All requirements are automatically downloaded into the correct location when using composer.  There is no need to download additional files or set paths to third party files.

Get composer:

```
curl http://getcomposer.org/installer | php
```

Install latest release OR development version:

```
php composer.phar require cornernote/gii-modeldoc-generator:*				// latest release
php composer.phar require cornernote/gii-modeldoc-generator:dev-master	// development version
```

Add the `vendor` folder to the `aliases` in your yii configuration:


### Manual Installation

Download the [latest release](https://github.com/cornernote/gii-modeldoc-generator/releases/latest) or [development version](https://github.com/cornernote/gii-modeldoc-generator/archive/master.zip) and move the `audit` folder into your `protected/modules` folder.


## Configuration

Add the path to `gii-modeldoc-generator` to the `generatorPaths` in your gii configuration:

```php
return array(
	'modules' => array(
		'gii' => array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array(
				// use this if you installed with composer
				'/path/to/vendor/cornernote/gii-modeldoc-generator/gii',

				// OR, use this if you downloaded into your extensions folder
				//'ext.gii-modeldoc-generator.gii',
			),
		),
	),
);
```

## Usage

Ensure you have `--- BEGIN ModelDoc ---` and `--- END ModelDoc ---` in each of your models, for example:

```php
/**
 * Your class description that will not be altered by ModelDoc
 *
 * --- BEGIN ModelDoc ---
 *
 *  this section will be replaced by ModelDoc
 *
 * --- END ModelDoc ---
 */
class MyModel extends CActiveRecord { ... }
```

Visit `index.php?r=gii`, then choose ModelDoc from the menu.


## Notes

This extension will not create any new model files.  You should first create them or generate them with a model generator.


## Resources

[![Mr PHP](https://raw.github.com/cornernote/mrphp-assets/master/img/code-banner.png)](http://mrphp.com.au) [![Github Project](https://raw.github.com/cornernote/mrphp-assets/master/vendor/github/github-latest-sourcecode-16.png)](https://github.com/cornernote/gii-modeldoc-generator#gii-modeldoc-generator-for-yii) [![Yii Extension](https://raw.github.com/cornernote/mrphp-assets/master/vendor/yii/yii-extension-16.png)](http://www.yiiframework.com/extension/gii-modeldoc-generator) [![Project Stats](https://www.ohloh.net/p/gii-modeldoc-generator/widgets/project_thin_badge.gif)](https://www.ohloh.net/p/gii-modeldoc-generator)

[![Latest Stable Version](https://poser.pugx.org/cornernote/gii-modeldoc-generator/v/stable.png)](https://packagist.org/packages/cornernote/gii-modeldoc-generator) [![Build Status](https://travis-ci.org/cornernote/gii-modeldoc-generator.png?branch=master)](https://travis-ci.org/cornernote/gii-modeldoc-generator) [![Dependencies Check](https://depending.in/cornernote/gii-modeldoc-generator.png)](https://depending.in/cornernote/gii-modeldoc-generator)


## License

[BSD-3-Clause](https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE), Copyright © 2013-2014 [Mr PHP](mailto:info@mrphp.com.au)
