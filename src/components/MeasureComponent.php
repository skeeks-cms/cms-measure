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
            'name'          => \Yii::t('skeeks/measure', 'Units of measurement'),
        ]);
    }
}