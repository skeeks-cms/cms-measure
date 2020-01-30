<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */

namespace skeeks\cms\measure\controllers;

use skeeks\cms\backend\BackendController;
use skeeks\cms\backend\ViewBackendAction;
use skeeks\cms\kladr\models\KladrLocation;
use skeeks\cms\measure\models\Measure;
use yii\helpers\ArrayHelper;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class AdminMeasureController extends BackendController
{
    public function init()
    {
        $this->name = \Yii::t('skeeks/measure', 'Units of measurement');
        /*$this->name = \Yii::t('skeeks/measure', 'Units of measurement');
        $this->modelShowAttribute = "code";
        $this->modelClassName = Measure::className();

        $this->generateAccessActions = false;*/

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'class' => ViewBackendAction::class,
            ]
            /*'index' => [
                'filters' => [
                    'visibleFilters' => [
                        'name',
                    ],
                ],

                'grid' => [
                    "visibleColumns" => [
                        'checkbox',
                        'actions',

                        'code',
                        'name',

                        'symbol',
                        'symbol_intl',
                        'symbol_letter_intl',
                    ],
                ],
            ],


            "create" => [
                'fields' => [$this, 'updateFields'],
            ],

            "update" => [
                'fields' => [$this, 'updateFields'],
            ],*/
        ]);
    }


    public function updateFields()
    {
        return [
            'code',
            'name',
            'symbol',
            'symbol_intl',
            'symbol_letter_intl',
        ];
    }

}
