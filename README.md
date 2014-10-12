# Gii ModelDoc Generator for Yii

ModelDoc Generator will extend Gii allowing an update to existing models with [phpDoc](http://phpdoc.org/docs/latest/index.html) compatible documentation.


## Features

- **Table Fields**
  - Adds properties for each field.
  - Properties are annotated with field comments from the database.
- **Relations**
  - Adds a property with a return type for each relation.
- **CActiveRecord Inheritance**
  - Adds methods inherited from CActiveRecord including: find(), findByPk(), findByAttributes(), fndBySql(), findAll(), findAllByPk(), findAllByAttributes(), findAllBySql(), with(), together(), cache(), resetScope(), populateRecord() and populateRecords().
- **Behaviors** 
  - Adds a property with a return type for each behavior.
  - Adds methods assigned for behaviors, unless it is defined by the model itself.
  - Optionally uses @mixin for behaviors.
- **Scopes**
  - Adds a method for each scope.
- **Full Syntax**
  - All PHPDoc tags contain full syntax including: method params and return types.
  - All returned models have namespace support.


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

Download the [latest release](https://github.com/cornernote/gii-modeldoc-generator/releases/latest) or [development version](https://github.com/cornernote/gii-modeldoc-generator/archive/master.zip) and move the `gii-modeldoc-generator` folder into your `protected/modules` folder.


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

- **[Documentation](http://cornernote.github.io/gii-modeldoc-generator)**
- **[GitHub Project](https://github.com/cornernote/gii-modeldoc-generator)**
- **[Yii Extension](http://www.yiiframework.com/extension/gii-modeldoc-generator)**


## Support

- Does this README need improvement?  Go ahead and [suggest a change](https://github.com/cornernote/gii-modeldoc-generator/edit/master/README.md).
- Found a bug, or need help using this project?  Check the [open issues](https://github.com/cornernote/gii-modeldoc-generator/issues) or [create an issue](https://github.com/cornernote/gii-modeldoc-generator/issues/new).


## License

[BSD-3-Clause](https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE), Copyright © 2013-2014 [Mr PHP](mailto:info@mrphp.com.au)


[![Mr PHP](https://raw.github.com/cornernote/mrphp-assets/master/img/code-banner.png)](http://mrphp.com.au) [![Project Stats](https://www.ohloh.net/p/gii-modeldoc-generator/widgets/project_thin_badge.gif)](https://www.ohloh.net/p/gii-modeldoc-generator)

[![Latest Stable Version](https://poser.pugx.org/cornernote/gii-modeldoc-generator/v/stable.png)](https://github.com/cornernote/gii-modeldoc-generator/releases/latest) [![Total Downloads](https://poser.pugx.org/cornernote/gii-modeldoc-generator/downloads.png)](https://packagist.org/packages/cornernote/gii-modeldoc-generator) [![Monthly Downloads](https://poser.pugx.org/cornernote/gii-modeldoc-generator/d/monthly.png)](https://packagist.org/packages/cornernote/gii-modeldoc-generator) [![Latest Unstable Version](https://poser.pugx.org/cornernote/gii-modeldoc-generator/v/unstable.png)](https://github.com/cornernote/gii-modeldoc-generator) [![Build Status](https://travis-ci.org/cornernote/gii-modeldoc-generator.png?branch=master)](https://travis-ci.org/cornernote/gii-modeldoc-generator) [![License](https://poser.pugx.org/cornernote/gii-modeldoc-generator/license.png)](https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE)
