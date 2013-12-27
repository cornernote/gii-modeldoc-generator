<?php
Yii::setPathOfAlias('modelDocGenerator', dirname(__FILE__));

/**
 * ModelDocGenerator
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/gii-modeldoc-generator
 * @license BSD-3-Clause https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE
 */
class ModelDocGenerator extends CCodeGenerator
{
    /**
     * @var string
     */
    public $codeModel = 'modelDocGenerator.ModelDocCode';

}