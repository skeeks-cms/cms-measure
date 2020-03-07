<?php
/**
 * @link https://cms.skeeks.com/
 * @copyright Copyright (c) 2010 SkeekS
 * @license https://cms.skeeks.com/license/
 * @author Semenov Alexander <semenov@skeeks.com>
 */
namespace skeeks\cms\measure\models;

use skeeks\cms\base\ActiveRecord;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cms_measure".
 *
 * @property int $id
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string $code
 * @property string $name
 * @property string|null $symbol
 * @property string|null $symbol_intl
 * @property string|null $symbol_letter_intl
 * @property int $priority
 *
 * @property string $asShortText
 */
class CmsMeasure extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_measure';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'priority'], 'integer'],
            [['code', 'name'], 'required'],
            [['name'], 'string', 'max' => 128],
            [['code'], 'string', 'max' => 20],
            [['symbol', 'symbol_intl', 'symbol_letter_intl'], 'string', 'max' => 20],
            [['code'], 'unique'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'code' => 'Код',
            'name' => 'Наименование',
            'symbol' => 'Условное обозначение',
            'symbol_intl' => 'Условное обозначение международное',
            'symbol_letter_intl' => 'Кодовое буквенное обозначение международное',
            'priority' => 'Сортировка',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeHints()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'code' => 'Уникальный код единицы измерения, обычно берется из классификатора',
            'symbol' => 'Короткое обозначение единицы измерения. Например шт. упак и т.д.',
        ]);
    }

    /**
     * @return string
     */
    public function asText()
    {
        $result = "#" . $this->code . "#" . $this->name;

        if ($this->symbol) {
            $result = $result . " ($this->symbol)";
        }

        return $result;
    }

    /**
     * @return string
     */
    public function getAsShortText()
    {
        if ($this->symbol) {
            return $this->symbol;
        }

        return $this->name;
    }
}