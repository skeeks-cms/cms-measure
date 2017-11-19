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
 * @property integer $code
 * @property string $name
 * @property string $symbol_rus
 * @property string $symbol_intl
 * @property string $symbol_letter_intl
 * @property string $def
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

        $this->on(self::EVENT_BEFORE_INSERT, [$this, 'beforeInsertChecks']);
        $this->on(self::EVENT_BEFORE_UPDATE, [$this, 'beforeUpdateChecks']);
        $this->on(self::EVENT_AFTER_FIND, [$this, 'afterFindInit']);
    }

    public function afterFindInit(Event $e)
    {
        $libsInfo = $this->getMeasureClassifierInfo();

        if (!$this->name)
        {
            $this->name = ArrayHelper::getValue($libsInfo, 'MEASURE_TITLE');
        }

        if (!$this->symbol_rus)
        {
            $this->symbol_rus = ArrayHelper::getValue($libsInfo, 'SYMBOL_RUS');
        }

        if (!$this->symbol_intl)
        {
            $this->symbol_intl = ArrayHelper::getValue($libsInfo, 'SYMBOL_INTL');
        }

        if (!$this->symbol_letter_intl)
        {
            $this->symbol_letter_intl = ArrayHelper::getValue($libsInfo, 'SYMBOL_LETTER_INTL');
        }
    }
    /**
     * @param Event $e
     * @throws Exception
     */
    public function beforeUpdateChecks(Event $e)
    {
        //Если этот элемент по умолчанию выбран, то все остальны нужно сбросить.
        if ($this->def == Cms::BOOL_Y)
        {
            static::updateAll(
                [
                    'def' => Cms::BOOL_N
                ],
                ['!=', 'id', $this->id]
            );
        }

    }
    /**
     * @param Event $e
     * @throws Exception
     */
    public function beforeInsertChecks(Event $e)
    {
        //Если этот элемент по умолчанию выбран, то все остальны нужно сбросить.
        if ($this->def == Cms::BOOL_Y)
        {
            static::updateAll([
                'def' => Cms::BOOL_N
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'code'], 'integer'],
            [['code'], 'required'],
            [['name'], 'string', 'max' => 500],
            [['symbol_rus', 'symbol_intl', 'symbol_letter_intl'], 'string', 'max' => 20],
            [['def'], 'string', 'max' => 1],
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
            'symbol_rus' => \Yii::t('skeeks/measure', 'Conventional symbol'),
            'symbol_intl' => \Yii::t('skeeks/measure', 'Conventional symbol (international)'),
            'symbol_letter_intl' => \Yii::t('skeeks/measure', 'The code letter of symbol (international)'),
            'def' => \Yii::t('skeeks/measure', 'Default'),
        ];
    }


    /**
     * @return array
     */
    public function getMeasureClassifierInfo()
    {
        return (array) MeasureClassifier::getMeasureInfoByCode($this->code);
    }
}