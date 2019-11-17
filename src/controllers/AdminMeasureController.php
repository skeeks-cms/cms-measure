<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */

namespace skeeks\cms\measure\controllers;

use skeeks\cms\backend\controllers\BackendModelStandartController;
use skeeks\cms\components\Cms;
use skeeks\cms\grid\BooleanColumn;
use skeeks\cms\helpers\RequestResponse;
use skeeks\cms\kladr\models\KladrLocation;
use skeeks\cms\measure\libs\MeasureClassifier;
use skeeks\cms\measure\models\Measure;
use skeeks\cms\modules\admin\actions\AdminAction;
use skeeks\cms\modules\admin\actions\modelEditor\AdminMultiModelEditAction;
use skeeks\cms\modules\admin\controllers\AdminModelEditorController;
use skeeks\cms\modules\admin\traits\AdminModelEditorStandartControllerTrait;
use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;

/**
 * Class AdminKladrLocationController
 * @package skeeks\cms\kladr\controllers
 */
class AdminMeasureController extends BackendModelStandartController
{
    use AdminModelEditorStandartControllerTrait;

    public function init()
    {
        $this->name = \Yii::t('skeeks/measure', 'Units of measurement');
        $this->modelShowAttribute = "code";
        $this->modelClassName = Measure::className();

        $this->generateAccessActions = false;

        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(),
            [
                'index' => [
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

                            'symbol_rus',
                            'symbol_intl',
                            'symbol_letter_intl',

                            'def',
                        ],

                        'columns' => [
                            'def' => [
                                'class' => BooleanColumn::class,
                                /*'falseValue' => 0,
                                'trueValue'  => 1,*/
                            ],
                        ],
                    ],
                ],

                "def-multi" => [
                    'class'        => AdminMultiModelEditAction::className(),
                    "name"         => \Yii::t('skeeks/measure', 'Default'),
                    //"icon"              => "glyphicon glyphicon-trash",
                    "eachCallback" => [$this, 'eachMultiDef'],
                    "priority"     => 0,
                ],
            ]
        );
    }


    /**
     * @param $model
     * @param $action
     * @return bool
     */
    public function eachMultiDef($model, $action)
    {
        try {
            $model->def = Cms::BOOL_Y;
            return $model->save(false);
        } catch (\Exception $e) {
            return false;
        }
    }

}
