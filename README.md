# Gii ModelDoc Generator for Yii

ModelDoc Generator will extend Gii too allow you to update your existing models with [phpDoc](http://www.phpdoc.org/) compatible documentation.


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
php composer.phar require mrphp/gii-modeldoc-generator
```


### Manual Installation

Download the [latest version](https://github.com/cornernote/gii-modeldoc-generator/archive/master.zip) and move the `gii-modeldoc-generator` folder into your `protected/extensions` folder.


## Configuration

Add the path to gii-modeldoc-generator to the `generatorPaths` in your gii configuration:

```php
return array(
	'modules' => array(
		'gii' => array(
			'class'=>'system.gii.GiiModule',
			'generatorPaths' => array(
				'vendor.mrphp.gii-modeldoc-generator',
				//'ext.gii-modeldoc-generator', // if you downloaded into ext
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
- [Composer Package](https://packagist.org/packages/mrphp/gii-modeldoc-generator)
- [MrPHP](http://mrphp.com.au)
