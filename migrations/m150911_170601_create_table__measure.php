<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */
use yii\db\Schema;
use yii\db\Migration;

class m150911_170601_create_table__measure extends Migration
{
    public function safeUp()
    {
        $tableExist = $this->db->getTableSchema("{{%measure}}", true);
        if ($tableExist)
        {
            return true;
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%measure}}", [
            'id'                    => $this->primaryKey(),

            'created_by'            => $this->integer(),
            'updated_by'            => $this->integer(),

            'created_at'            => $this->integer(),
            'updated_at'            => $this->integer(),

            'code'                  => $this->integer()->notNull()->unique(),
            'name'                  => $this->string(500),

            'symbol_rus'            => $this->string(20),
            'symbol_intl'           => $this->string(20),

            'symbol_letter_intl'    => $this->string(20),

            'def'                   => $this->string(1)->notNull()->defaultValue('N'),


        ], $tableOptions);


        $this->createIndex('updated_by', '{{%measure}}', 'updated_by');
        $this->createIndex('created_by', '{{%measure}}', 'created_by');
        $this->createIndex('created_at', '{{%measure}}', 'created_at');
        $this->createIndex('updated_at', '{{%measure}}', 'updated_at');

        $this->createIndex('name', '{{%measure}}', 'name');
        $this->createIndex('symbol_rus', '{{%measure}}', 'symbol_rus');
        $this->createIndex('symbol_intl', '{{%measure}}', 'symbol_intl');
        $this->createIndex('symbol_letter_intl', '{{%measure}}', 'symbol_letter_intl');
        $this->createIndex('def', '{{%measure}}', 'def');

        $this->execute("ALTER TABLE {{%measure}} COMMENT = 'Единицы измерения';");

        $this->addForeignKey(
            'measure_created_by', "{{%measure}}",
            'created_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );

        $this->addForeignKey(
            'measure_updated_by', "{{%measure}}",
            'updated_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );


        $this->insert('{{%measure}}', [
            'code'                  => 006,
            'symbol_intl'           => 'm',
            'symbol_letter_intl'    => 'MTR',
        ]);

        $this->insert('{{%measure}}', [
            'code'                  => 112,
            'symbol_intl'           => 'l',
            'symbol_letter_intl'    => 'LTR',
        ]);

        $this->insert('{{%measure}}', [
            'code'                  => 163,
            'symbol_intl'           => 'g',
            'symbol_letter_intl'    => 'GRM',
        ]);

        $this->insert('{{%measure}}', [
            'code'                  => 166,
            'symbol_intl'           => 'kg',
            'symbol_letter_intl'    => 'KGM',
        ]);

        $this->insert('{{%measure}}', [
            'code'                  => 796,
            'symbol_intl'           => 'pc. 1',
            'symbol_letter_intl'    => 'PCE. NMB',
            'def'                   => 'Y',
        ]);

        $this->insert('{{%measure}}', [
            'code'                  => 3,
            'symbol_intl'           => 'mm',
            'symbol_letter_intl'    => 'MMT',
        ]);

    }

    public function safeDown()
    {
        $this->dropForeignKey("measure_updated_by", "{{%measure}}");
        $this->dropForeignKey("measure_updated_by", "{{%measure}}");

        $this->dropTable("{{%measure}}");
    }
}