<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */
use yii\db\Migration;

class m200307_090602_append_data_table__cms_measure extends Migration
{
    public function safeUp()
    {
        $this->insert('{{%cms_measure}}', [
            'code'               => '796',
            'name'               => 'Штука',
            'symbol'             => 'шт',
            'symbol_intl'        => 'pc. 1',
            'symbol_letter_intl' => 'PCE. NMB',
            'priority' => 100,
        ]);


        $this->insert('{{%cms_measure}}', [
            'code'               => '778',
            'name'               => 'Упаковка',
            'symbol'             => 'упак',
            'symbol_letter_intl' => 'NMP',
                        'priority' => 200,

        ]);


        $this->insert('{{%cms_measure}}', [
            'code'               => '003',
            'name'               => 'Миллиметр',
            'symbol'             => 'мм',
            'symbol_intl'        => 'mm',
            'symbol_letter_intl' => 'MMT',
            'priority' => 300,
        ]);

        $this->insert('{{%cms_measure}}', [
            'code'               => '006',
            'name'               => 'Метр',
            'symbol'             => 'м',
            'symbol_intl'        => 'm',
            'symbol_letter_intl' => 'MTR',
            'priority' => 310,
        ]);


        $this->insert('{{%cms_measure}}', [
            'code'               => '163',
            'name'               => 'Грамм',
            'symbol'             => 'г',
            'symbol_intl'        => 'g',
            'symbol_letter_intl' => 'GRM',
            'priority' => 320,
        ]);

        $this->insert('{{%cms_measure}}', [
            'code'               => '166',
            'name'               => 'Килограмм',
            'symbol'             => 'кг',
            'symbol_intl'        => 'kg',
            'symbol_letter_intl' => 'KGM',
            'priority' => 330,
        ]);


        $this->insert('{{%cms_measure}}', [
            'code'               => '112',
            'name'               => 'Литр',
            'symbol'             => 'л',
            'symbol_intl'        => 'l',
            'symbol_letter_intl' => 'LTR',
            'priority' => 340,
        ]);


        $this->insert('{{%cms_measure}}', [
            'code'               => '055',
            'name'               => 'Квадратный метр',
            'symbol'             => 'м2',
            'symbol_intl'        => 'm2',
            'symbol_letter_intl' => 'MTK',
            'priority' => 350,
        ]);

        $this->insert('{{%cms_measure}}', [
            'code'   => '383',
            'name'   => 'Рубль',
            'symbol' => 'руб',
        ]);

    }

    public function safeDown()
    {
        echo "m191204_180601_alter_table__measure cannot be reverted.\n";
        return false;
    }
}