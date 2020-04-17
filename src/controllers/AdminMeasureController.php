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
use skeeks\cms\base\DynamicModel;
use skeeks\cms\helpers\RequestResponse;
use skeeks\cms\kladr\models\KladrLocation;
use skeeks\cms\measure\models\CmsMeasure;
use skeeks\yii2\form\fields\FieldSet;
use skeeks\yii2\form\fields\NumberField;
use skeeks\yii2\form\fields\SelectField;
use yii\base\Event;
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
        $this->accessCallback = function () {
            if (!\Yii::$app->skeeks->site->is_default) {
                return false;
            }
            return \Yii::$app->user->can($this->uniqueId);
        };

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
                'name'  => 'Классификатор',
                'icon'  => 'fa fa-list',
            ],
            'index'      => [
                'filters' => [
                    'visibleFilters' => [
                        'code',
                        'name',
                    ],
                ],
                'grid'    => [
                    'defaultOrder'   => [
                        //'def' => SORT_DESC,
                        'priority' => SORT_ASC,
                    ],
                    "visibleColumns" => [
                        'checkbox',
                        'actions',

                        'customName',

                        'priority',
                    ],
                    'columns'        => [
                        'customName' => [
                            'attribute'     => 'name',
                            'class'         => DefaultActionColumn::class,
                            'viewAttribute' => 'asText',
                        ],
                    ],
                ],
            ],


            "create" => [
                'fields'            => [$this, 'updateFields'],
                'on initFormModels' => function (Event $e) {
                    $model = $e->sender->model;

                    $dm = new DynamicModel(['classifier']);
                    $dm->addRule(['classifier'], 'string');

                    $e->sender->formModels['dm'] = $dm;

                },
            ],

            "update" => [
                'fields' => [$this, 'updateFields'],
            ],
        ]);
    }


    public function updateFields($action)
    {
        $mainFields = [
            'code',
            'name',
            'symbol',
        ];


        /**
         * @var CmsMeasure $model
         */
        $model = $action->model;
        if ($model->isNewRecord) {

            $dm = $action->formModels['dm'];
            if ($dm->classifier) {
                if ($measure = \Yii::$app->measureClassifier->getMeasureByCode($dm->classifier)) {
                    $model->name = $measure->name;
                    $model->symbol = $measure->symbol;
                    $model->symbol_intl = $measure->symbol_intl;
                    $model->symbol_letter_intl = $measure->symbol_letter_intl;
                    $model->code = $measure->code;
                }
            }


            $mainFields = [

                'dm.classifier' => [
                    'class'          => SelectField::class,
                    'items'          => \Yii::$app->measureClassifier->getDataForSelect(),
                    'label'          => 'Базовый классификатор',
                    'hint'           => 'Выберите интересующую единицу измерения и все данные будут заполнены в форме автоматически',
                    'elementOptions' => [
                        RequestResponse::DYNAMIC_RELOAD_FIELD_ELEMENT => 'true',
                    ],
                ],

                'code',
                'name',
                'symbol',
            ];
        }

        $result = [
            'main'   => [
                'class'  => FieldSet::class,
                'name'   => 'Основные данные',
                'fields' => $mainFields,
            ],
            'second' => [
                'class'          => FieldSet::class,
                'elementOptions' => ['isOpen' => false],
                'name'           => 'Дополнительно',
                'fields'         => [
                    'symbol_intl',
                    'symbol_letter_intl',
                    'priority' => [
                        'class' => NumberField::class,
                    ],
                ],
            ],
        ];

        return $result;
    }

}
