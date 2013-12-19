# Gii ModelDoc Generator for Yii

ModelDoc Generator will extend Gii too allow you to update your existing models with phpDoc compatible documentation.  The phpDoc comments greatly assist with phpStorm's code completion.

It will not create any new files.  It will only update your existing models.


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

Download the [latest version](https://github.com/cornernote/yii-dressing/archive/master.zip) and move the `gii-modeldoc-generator` folder into your `protected/extensions` folder.


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

```
/**
 * This comment will not be altered.
 *
 * --- BEGIN GenerateProperties ---
 * properties will be inserted here
 * --- END GenerateProperties ---
 */
```

Visit `index.php?r=gii`, then choose ModelDoc from the menu.


## License

- Author: Brett O'Donnell <cornernote@gmail.com>
- Author: Zain Ul abidin <zainengineer@gmail.com>
- Source Code: https://github.com/cornernote/gii-modeldoc-generator
- Copyright © 2013 Mr PHP <info@mrphp.com.au>
- License: BSD-3-Clause https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE
