<?php

/**
 * ModelDocCode
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/gii-modeldoc-generator
 * @license BSD-3-Clause https://raw.github.com/cornernote/gii-modeldoc-generator/master/LICENSE
 */
class ModelDocCode extends CCodeModel
{
    /**
     * @var string
     */
    public $modelClass;

    /**
     * @var string
     */
    public $modelPath = 'application.models';

    /**
     * @var int
     */
    public $addModelMethodDoc;

    /**
     * @var string
     */
    public $beginBlock = ' * --- BEGIN ModelDoc ---';

    /**
     * @var string
     */
    public $endBlock = ' * --- END ModelDoc ---';

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), array(
            array('modelClass, modelPath', 'filter', 'filter' => 'trim'),
            array('modelPath', 'required'),
            array('modelPath', 'match', 'pattern' => '/^(\w+[\w\.]*)$/', 'message' => '{attribute} should only contain word characters and dots.'),
            array('modelClass', 'match', 'pattern' => '/^[a-zA-Z_]\w*$/', 'message' => '{attribute} should only contain word characters.'),
            array('modelPath', 'validateModelPath', 'skipOnError' => true),
            array('modelPath,addModelMethodDoc', 'sticky'),
            array('addModelMethodDoc', 'numerical', 'integerOnly' => true),
        ));
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), array(
            'modelPath' => 'Model Path',
            'modelClass' => 'Model Class',
        ));
    }

    /**
     * @inheritdoc
     */
    public function requiredTemplates()
    {
        return array(
            'model.php',
        );
    }

    /**
     *
     */
    public function validateModelPath()
    {
        if (Yii::getPathOfAlias($this->modelPath) === false)
            $this->addError('modelPath', 'Model Path must be a valid path alias.');
    }

    /**
     * @inheritdoc
     */
    public function prepare()
    {
        $this->files = array();
        $templatePath = $this->templatePath;
        foreach ($this->getModels() as $model) {
            $reflection = new ReflectionClass($model);
            $params = array(
                'model' => $model,
                'reflection' => $reflection,
            );

            //wrap the lines below in a try..catch block so execution
            //continues with next model file if an error occurs
            try {
                $this->files[] = new CCodeFile(
                    $reflection->getFileName(),
                    $this->render($templatePath . '/model.php', $params)
                );
            } catch (Exception $ex) {
                // continue with next model file, we could also do some logging here
                continue;
            }
        }
    }

    /**
     * Tricky way to get correct model class from file name.
     * @param string $fileName
     * @return string
     */
    public function getModelClass($fileName)
    {
        $modelClass = '\\' . str_replace('.', '\\', $this->modelPath . '.' . $fileName);
        if (class_exists($modelClass, false)) {
            return $modelClass;
        } elseif (class_exists($fileName, false)) {
            return $fileName;
        } elseif (Yii::autoload($modelClass)) {
            return $modelClass;
        } else {
            return $fileName;
        }
    }

    /**
     * @return array
     */
    public function getModels()
    {
        if ($this->modelClass) {
            $modelClass = $this->getModelClass($this->modelClass);
            return array(CActiveRecord::model($modelClass));
        }
        $modelList = array();
        $files = CFileHelper::findFiles(Yii::getPathOfAlias($this->modelPath), array('fileTypes' => array('php'), 'level' => 0));
        foreach ($files as $file) {
            $fileName = basename($file, '.php');

            // there is a dot in file name, probably a version conflict file
            if (strpos($fileName, '.') !== false)
                continue;

            $modelClass = $this->getModelClass($fileName);

            //use reflection to check if class is instantiable
            $reflectedClass = new ReflectionClass($modelClass);
            if ($reflectedClass->isInstantiable() === false)
                continue; //continue if this class is not instantiable

            // load the model
            try {
                $model = new $modelClass;
            } catch (Exception $e) {
                $model = null;
            }
            if (!$model || !is_subclass_of($model, 'CActiveRecord'))
                continue;

            // everything passes, add it to the list
            $modelList[] = $model;
        }
        return $modelList;
    }

    /**
     * @param string $file
     * @throws CException
     * @return string
     */
    public function getContent($file)
    {
        if (!file_exists($file))
            throw new CException(strtr(Yii::t('modelDocGenerator', 'File :file was not found.'), array(':file' => $file)));
        $content = file_get_contents($file);
        $content = explode($this->beginBlock, $content);
        if (!isset($content[1]))
            throw new CException(strtr(Yii::t('modelDocGenerator', 'File :file does not contain the beginBlock :beginBlock.'), array(':file' => $file, ':beginBlock' => $this->beginBlock)));
        $content[1] = explode($this->endBlock, $content[1]);
        if (!isset($content[1][1]))
            throw new CException(strtr(Yii::t('modelDocGenerator', 'File :file does not contain the endBlock :endBlock.'), array(':file' => $file, ':endBlock' => $this->endBlock)));
        $content[1] = $content[1][1];
        return $content;
    }

    /**
     * @param array|string $behavior
     * @return string
     */
    public function getBehaviorClass($behavior)
    {
        if (is_array($behavior))
            $behavior = $behavior['class'];
        $behavior = explode('.', $behavior);
        $behavior = $behavior[count($behavior) - 1];
        return $behavior[0] ==  '\\' ? $behavior : '\\' . $behavior;
    }

    /**
     * @param string $contents
     * @param int $start
     * @param int $end
     * @param bool $removeStart
     * @param bool $removeEnd
     * @return string
     */
    static public function getBetweenString($contents, $start, $end, $removeStart = true, $removeEnd = true)
    {
        $startPos = $start ? strpos($contents, $start) : 0;
        if ($startPos === false)
            return false;

        if ($end) {
            $endPos = strpos($contents, $end, $startPos);
            if ($endPos === false) {
                $endPos = $endPos = strlen($contents);
            }
        }
        else {
            $endPos = strlen($contents);
        }

        if ($removeStart) {
            $startPos += strlen($start);
        }
        $len = $endPos - $startPos;
        if (!$removeEnd && $end && $endPos) {
            $len = $len + strlen($end);
        }
        return substr($contents, $startPos, $len);
    }

}
