<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 10.09.2015
 */

namespace skeeks\cms\measure\components;

use skeeks\cms\base\Component;
use skeeks\cms\measure\assets\Asset;
use skeeks\yii2\form\fields\SelectField;
use skeeks\yii2\measureClassifier\Measure;
use yii\helpers\ArrayHelper;

/**
 * @property Measure[] $measures;
 * 
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class MeasureComponent extends Component
{

    /**
     * Можно задать название и описание компонента
     * @return array
     */
    static public function descriptorConfig()
    {
        return array_merge(parent::descriptorConfig(), [
            'name' => \Yii::t('skeeks/measure', 'Units of measurement'),
            'image' => [
                Asset::class, 'icons/component-icon.png'
            ],
        ]);
    }

    public $default_measure_code = "796"; //шт.


    public function getConfigFormFields()
    {
        return [
            'default_measure_code' => [
                'class' => SelectField::class,
                'multiple' => false,
                'items' => function() {
                    return \Yii::$app->measureClassifier->getDataForSelect();
                }
            ],
            /*'active_measure_codes' => [
                'class' => SelectField::class,
                'multiple' => true,
                'items' => function() {
                    return \Yii::$app->measureClassifier->getDataForSelect();
                }
            ],*/
        ];
    }


    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['default_measure_code'], 'string'],
        ]);
    }


    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'default_measure_code'    => 'Единица по умолчанию',
        ]);
    }


    public function attributeHints()
    {
        return ArrayHelper::merge(parent::attributeHints(), [
        ]);
    }
}