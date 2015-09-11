<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 10.09.2015
 */
namespace skeeks\cms\measure\components;
use skeeks\cms\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class MeasureComponent
 * @package skeeks\cms\measure\components
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
            'name'          => 'Единицы измерений',
        ]);
    }

    /**
     * @var string
     */
    public $kladrApiToken               = "55ef04730a69de3d758b456a";

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['kladrApiToken'], 'string'],
        ]);
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'kladrApiToken'                     => 'Токен с kladr-api.ru',
        ]);
    }

}