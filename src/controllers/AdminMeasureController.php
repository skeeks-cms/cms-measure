<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */

namespace skeeks\cms\measure\controllers;

use skeeks\cms\backend\controllers\BackendModelStandartController;
use skeeks\cms\backend\grid\DefaultActionColumn;
use skeeks\cms\backend\ViewBackendAction;
use skeeks\cms\kladr\models\KladrLocation;
use skeeks\cms\measure\models\CmsMeasure;
use skeeks\yii2\form\fields\FieldSet;
use skeeks\yii2\form\fields\NumberField;
use yii\helpers\ArrayHelper;

/**
 * @author Semenov Alexander <semenov@skeeks.com>
 */
class AdminMeasureController extends BackendModelStandartController
{
    public function init()
    {
        $this->name = \Yii::t('skeeks/measure', 'Units of measurement');

        $this->modelShowAttribute = "asText";
        $this->modelClassName = CmsMeasure::class;

        $this->generateAccessActions = false;

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'classifier' => [
                'class' => ViewBackendAction::class,
                'name' => 'Классификатор',
                'icon' => 'fa fa-list'
            ],
            'index'      => [
                'filters' => [
                    'visibleFilters' => [
                        'code',
                        'name',
                    ],
                ],
                'grid' => [
                    'defaultOrder' => [
                        //'def' => SORT_DESC,
                        'priority' => SORT_ASC
                    ],
                    "visibleColumns" => [
                        'checkbox',
                        'actions',

                        'customName',

                        'priority',
                    ],
                    'columns' => [
                        'customName' => [
                            'attribute' => 'name',
                            'class' => DefaultActionColumn::class,
                            'viewAttribute' => 'asText'
                        ]
                    ]
                ],
            ],


            "create" => [
                'fields' => [$this, 'updateFields'],
            ],

            "update" => [
                'fields' => [$this, 'updateFields'],
            ],
        ]);
    }


    public function updateFields()
    {
        return [
            'main' => [
                'class' => FieldSet::class,
                'name' => 'Основные данные',
                'fields' => [
                    'code',
                    'name',
                    'symbol',
                ]
            ],
            'second' => [
                'class' => FieldSet::class,
                'elementOptions' => ['isOpen' => false],
                'name' => 'Дополнительно',
                'fields' => [
                    'symbol_intl',
                    'symbol_letter_intl',
                    'priority' => [
                        'class' => NumberField::class
                    ]
                ]
            ],
        ];
    }

}
