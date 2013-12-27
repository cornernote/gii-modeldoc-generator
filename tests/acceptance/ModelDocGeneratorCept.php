<?php
/**
 * ModelDocGenerator Test
 *
 * @var $scenario \Codeception\Scenario
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/gii-modeldoc-generator
 * @license BSD-3-Clause https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE
 *
 * @package gii-modeldoc-generator
 */

$I = new WebGuy($scenario);
$I->wantTo('ensure ModelDocGenerator works');

$I->amOnPage('gii');
$I->see('Welcome to Yii Code Generator!');
$I->see('ModelDoc Generator');

$I->click('ModelDoc Generator');
$I->see('Model Class');
