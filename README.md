# Gii ModelDoc Generator for Yii

ModelDoc Generator will extend Gii too allow you to update your existing models with [phpDoc](http://www.phpdoc.org/) compatible documentation.

[![Mr PHP](https://raw.github.com/cornernote/mrphp-assets/master/img/code-banner.png)](http://mrphp.com.au) [![Project Stats](https://www.ohloh.net/p/gii-modeldoc-generator/widgets/project_thin_badge.gif)](https://www.ohloh.net/p/gii-modeldoc-generator)

[![Latest Stable Version](https://poser.pugx.org/cornernote/gii-modeldoc-generator/v/stable.png)](https://packagist.org/packages/cornernote/gii-modeldoc-generator) [![Build Status](https://travis-ci.org/cornernote/gii-modeldoc-generator.png?branch=master)](https://travis-ci.org/cornernote/gii-modeldoc-generator)


### Contents

[Features](#features)  
[Screenshots](#screenshots)  
[Installation](#installation)  
[Configuration](#configuration)  
[Usage](#usage)  
[Notes](#notes)  
[License](#license)  
[Links](#links) 


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

```
curl http://getcomposer.org/installer | php
php composer.phar require cornernote/gii-modeldoc-generator
```


### Manual Installation

Download the [latest version](https://github.com/cornernote/gii-modeldoc-generator/archive/master.zip) and move the `gii-modeldoc-generator` folder into your `protected/extensions` folder.


## Configuration

Add the path to gii-modeldoc-generator to the `generatorPaths` in your gii configuration:

```php
return array(
	'aliases' => array(
		// set this so Yii knows where composers vendor folder is located
		// only needed if you want to use the composer vendor alias below
		'vendor' => '/path/to/vendor',
	),
	'modules' => array(
		'gii' => array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array(
				// use this if you installed with composer
				'vendor.cornernote.gii-modeldoc-generator.gii',

				// OR, use this if you downloaded into your extensions folder
				//'ext.gii-modeldoc-generator.gii',
			),
		),
	),
);
```

## Usage

Ensure you have `--- BEGIN GenerateProperties ---` and `--- END GenerateProperties ---` in each of your models, for example:

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


## License

- Author: Brett O'Donnell <cornernote@gmail.com>
- Author: Zain Ul abidin <zainengineer@gmail.com>
- Source Code: https://github.com/cornernote/gii-modeldoc-generator
- Copyright © 2013 Mr PHP <info@mrphp.com.au>
- License: BSD-3-Clause https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE



## Links

- [Yii Extension](http://www.yiiframework.com/extension/gii-modeldoc-generator)
- [Composer Package](https://packagist.org/packages/cornernote/gii-modeldoc-generator)
- [MrPHP](http://mrphp.com.au)
