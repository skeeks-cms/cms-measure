<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */

namespace skeeks\cms\measure\controllers;

use skeeks\cms\backend\BackendAction;
use skeeks\cms\backend\BackendController;
use skeeks\cms\backend\controllers\BackendModelStandartController;
use skeeks\cms\backend\ViewBackendAction;
use skeeks\cms\components\Cms;
use skeeks\cms\grid\BooleanColumn;
use skeeks\cms\helpers\RequestResponse;
use skeeks\cms\kladr\models\KladrLocation;
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
class AdminMeasureController extends BackendController
{
    use AdminModelEditorStandartControllerTrait;

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
                'class' => ViewBackendAction::class
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
