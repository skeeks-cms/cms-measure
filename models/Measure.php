<?php

namespace skeeks\cms\measure\models;

use skeeks\cms\components\Cms;
use Yii;
use yii\base\Event;

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
            'id' => Yii::t('app', 'ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'code' => Yii::t('app', 'Code'),
            'name' => Yii::t('app', 'Наименование единицы измерения'),
            'symbol_rus' => Yii::t('app', 'Условное обозначение'),
            'symbol_intl' => Yii::t('app', 'Условное обозначение (международное)'),
            'symbol_letter_intl' => Yii::t('app', 'Кодовое буквенное обозначение (международное)'),
            'def' => Yii::t('app', 'Default'),
        ];
    }
}