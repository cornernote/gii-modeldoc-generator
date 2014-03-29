<?php
/**
 * This is the template for generating the phpdocs of a specified model.
 *
 * @var $this ModelDocCode
 * @var $modelClass string
 * @var $model CActiveRecord
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/gii-modeldoc-generator
 * @license BSD-3-Clause https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE
 */
$properties = array(' *');

// get own methods and properties
$reflection = new ReflectionClass($modelClass);
$selfMethods = CHtml::listData($reflection->getMethods(), 'name', 'name');
$selfProperties = CHtml::listData($reflection->getProperties(), 'name', 'name');

// table fields
$properties[] = ' * Table ' . $model->tableName();
foreach ($model->tableSchema->columns as $column) {
    $type = $column->type;
    if (($column->dbType == 'datetime') || ($column->dbType == 'date')) {
        $type = 'string'; // $column->dbType;
    }
    if (strpos($column->dbType, 'decimal') !== false) {
        $type = 'number';
    }
    if($this->addColumnComments && !empty($column->comment)) {
        $comment = preg_replace('/[\r\n]+/u', ' ', $column->comment);
        $comment = ' ' . mb_substr($comment, 0, 100);
    } else {
        $comment = '';
    }
    $properties[] = ' * @property ' . $type . ' $' . $column->name . $comment;
}
$properties[] = ' *';

// relations
$relations = $model->relations();
if ($relations) {
    $properties[] = ' * Relations';
    foreach ($relations as $relationName => $relation) {
        if (in_array($relation[0], array('CBelongsToRelation', 'CHasOneRelation')))
            $properties[] = ' * @property ' . $relation[1] . ' $' . $relationName;

        elseif (in_array($relation[0], array('CHasManyRelation', 'CManyManyRelation')))
            $properties[] = ' * @property ' . $relation[1] . '[] $' . $relationName;

        elseif (in_array($relation[0], array('CStatRelation')))
            $properties[] = ' * @property integer $' . $relationName;

        else
            $properties[] = ' * @property unknown $' . $relationName;
    }
    $properties[] = ' *';
}

// scopes
$scopes = $model->scopes();
if ($scopes) {
    $properties[] = ' * Scopes';
    foreach (array_keys($scopes) as $scopeName) {
        $properties[] = " * @method {$modelClass} {$scopeName}()";
    }
    $properties[] = ' *';
}

// active record
$properties[] = ' * @see CActiveRecord';
if ($this->addModelMethodDoc)
    $properties[] = " * @method static {$modelClass} model(string \$className = NULL)";
$properties[] = " * @method {$modelClass} find(\$condition = '', array \$params = array())";
$properties[] = " * @method {$modelClass} findByPk(\$pk, \$condition = '', array \$params = array())";
$properties[] = " * @method {$modelClass} findByAttributes(array \$attributes, \$condition = '', array \$params = array())";
$properties[] = " * @method {$modelClass} fndBySql(\$sql, array \$params = array())";
$properties[] = " * @method {$modelClass}[] findAll(\$condition = '', array \$params = array())";
$properties[] = " * @method {$modelClass}[] findAllByPk(\$pk, \$condition = '', array \$params = array())";
$properties[] = " * @method {$modelClass}[] findAllByAttributes(array \$attributes, \$condition = '', array \$params = array())";
$properties[] = " * @method {$modelClass}[] findAllBySql(\$sql, array \$params = array())";
$properties[] = " * @method {$modelClass} with()";
$properties[] = " * @method {$modelClass} together()";
$properties[] = " * @method {$modelClass} cache(\$duration, \$dependency = null, \$queryCount = 1)";
$properties[] = " * @method {$modelClass} resetScope(\$resetDefault = true)";
$properties[] = " * @method {$modelClass} populateRecord(\$attributes, \$callAfterFind = true)";
$properties[] = " * @method {$modelClass}[] populateRecords(\$data, \$callAfterFind = true, \$index = null)";

$properties[] = " *";

// behaviors
$behaviors = $model->behaviors();
if ($behaviors) {
    if ($this->useMixin) {
        foreach ($behaviors as $behavior) {
            $properties[] = ' * @mixin ' . $this->getBehaviorClass($behavior);
        }
        $properties[] = ' *';
    } else {
        $behaviorMethods = array();
        foreach (get_class_methods('CActiveRecordBehavior') as $methodName)
            $behaviorMethods[$methodName] = $methodName;
        $behaviorProperties = array();
        foreach (get_class_vars('CActiveRecordBehavior') as $propertyName)
            $behaviorProperties[$propertyName] = $propertyName;

        foreach ($behaviors as $behavior) {
            $behavior = $this->getBehaviorClass($behavior);

            $behaviorProperties = $this->getBehaviorProperties($modelClass, $behavior, CMap::mergeArray($behaviorMethods, $selfMethods), CMap::mergeArray($behaviorProperties, $selfProperties));
            if ($behaviorProperties) {
                $properties[] = ' * @see ' . $behavior;
                foreach ($behaviorProperties as $behaviorProperty) {
                    $properties[] = $behaviorProperty;
                }
                $properties[] = ' *';
            }
        }
    }
}

// output the contents
$content = $this->getContent($modelClass);
echo $content[0];
echo $this->beginBlock . "\n";
echo implode("\n", $properties) . "\n";
echo $this->endBlock;
echo $content[1];
