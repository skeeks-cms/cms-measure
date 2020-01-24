<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 10.09.2015
 */

namespace skeeks\cms\measure\components;

use skeeks\cms\base\Component;
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
        ]);
    }

    public $default_measure_code = "796"; //шт.


    public $active_measure_codes = [
        "796",
        
        "112",
        "163",
        "166",
        
        "003",
        "006",
    ];

    /*public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
             
        ]);
    }*/



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
            'active_measure_codes' => [
                'class' => SelectField::class,
                'multiple' => true,
                'items' => function() {
                    return \Yii::$app->measureClassifier->getDataForSelect();
                }
            ],
        ];
    }


    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['default_measure_code'], 'string'],
            [['active_measure_codes'], 'safe'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'default_measure_code'    => 'Единица по умолчанию',
            'active_measure_codes'    => 'Валюты по умолчанию',
        ]);
    }
    
    public function attributeHints()
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'active_measure_codes'    => 'Валюты которые показываются первыми при выборе в списке',
        ]);
    }



    /**
     * @return Measure[]
     */
    public function getActiveMeasures()
    {
        $result = [];
        
        foreach ((array) $this->active_measure_codes as $key => $code)
        {
            if ($model = \Yii::$app->measureClassifier->getMeasureByCode($code)) {
                $result[$code] = $model;
            }
        }
        
        return $result;
    }
    
    public function getDataForSelect()
    {
        $result = [];

        $first = [];
        foreach ((array) $this->active_measure_codes as $key => $code)
        {
            if ($model = \Yii::$app->measureClassifier->getMeasureByCode($code)) {
                $first[$code] = $model->name . " (" . $model->symbol . ") " . "[" . $model->code . "]";
            }
        }
        
        $result["По умолчанию"] = $first;
        
        foreach (\Yii::$app->measureClassifier->data as $key => $data)
        {
            $title1 = ArrayHelper::getValue($data, 'title');
            ArrayHelper::remove($data, 'title');
            
            foreach ($data as $subKey => $subData)
            {
                $title = ArrayHelper::getValue($subData, 'title') . " - " . $title1;
                ArrayHelper::remove($subData, 'title');
                $tmpArr = [];
                
                foreach ((array) $subData as $measureKey => $measure)
                {
                    if (!in_array(ArrayHelper::getValue($measure, 'code'), $this->active_measure_codes)) {
                        $tmpArr[ArrayHelper::getValue($measure, 'code')] = ArrayHelper::getValue($measure, 'name') . " (" . ArrayHelper::getValue($measure, 'symbol') . ") " . "[" . ArrayHelper::getValue($measure, 'code') . "]";
                    }
                }
                
                $result[$title] = $tmpArr;
            }
        }

        return $result;
    }
}