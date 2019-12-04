<?php

namespace skeeks\cms\measure\models;

use skeeks\cms\components\Cms;
use skeeks\cms\measure\libs\MeasureClassifier;
use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%measure}}".
 *
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property string $code
 * @property string $name
 * @property string $symbol
 * @property string $symbol_intl
 * @property string $symbol_letter_intl
 */
class Measure extends \skeeks\cms\models\Core
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%measure}}';
    }


    //TODO: надо вынести в трейт
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_AFTER_FIND, [$this, 'afterFindInit']);
    }

    public function afterFindInit(Event $e)
    {
        $libsInfo = $this->getMeasureClassifierInfo();

        if (!$this->name)
        {
            $this->name = ArrayHelper::getValue($libsInfo, 'name');
        }

        if (!$this->symbol)
        {
            $this->symbol = ArrayHelper::getValue($libsInfo, 'symbol');
        }

        if (!$this->symbol_intl)
        {
            $this->symbol_intl = ArrayHelper::getValue($libsInfo, 'symbol_intl');
        }

        if (!$this->symbol_letter_intl)
        {
            $this->symbol_letter_intl = ArrayHelper::getValue($libsInfo, 'symbol_letter_intl');
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['code'], 'required'],
            [['name'], 'string', 'max' => 500],
            [['code'], 'string', 'max' => 3],
            [['symbol', 'symbol_intl', 'symbol_letter_intl'], 'string', 'max' => 20],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('skeeks/measure', 'ID'),
            'created_by' => \Yii::t('skeeks/measure', 'Created By'),
            'updated_by' => \Yii::t('skeeks/measure', 'Updated By'),
            'created_at' => \Yii::t('skeeks/measure', 'Created At'),
            'updated_at' => \Yii::t('skeeks/measure', 'Updated At'),
            'code' => \Yii::t('skeeks/measure', 'Code'),
            'name' => \Yii::t('skeeks/measure', 'Unit of measure'),
            'symbol' => \Yii::t('skeeks/measure', 'Conventional symbol'),
            'symbol_intl' => \Yii::t('skeeks/measure', 'Conventional symbol (international)'),
            'symbol_letter_intl' => \Yii::t('skeeks/measure', 'The code letter of symbol (international)'),
        ];
    }


    /**
     * @return array
     */
    public function getMeasureClassifierInfo()
    {
        return (array) \Yii::$app->measureClassifier->getMeasureInfoByCode($this->code);
    }
}