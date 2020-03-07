<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */
use yii\db\Migration;

class m200307_090601_create_table__cms_measure extends Migration
{
    public function safeUp()
    {
        $tableExist = $this->db->getTableSchema("{{%cms_measure}}", true);
        if ($tableExist) {
            return true;
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%cms_measure}}", [

            'id' => $this->primaryKey(),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),

            'code' => $this->string(20)->notNull()->unique(),
            'name' => $this->string(128)->notNull(),

            'symbol' => $this->string(20),

            'symbol_intl'        => $this->string(20),
            'symbol_letter_intl' => $this->string(20),

            'priority' => $this->integer()->notNull()->defaultValue(500),

        ], $tableOptions);


        $this->createIndex('cms_measure__updated_by', '{{%cms_measure}}', 'updated_by');
        $this->createIndex('cms_measure__created_by', '{{%cms_measure}}', 'created_by');
        $this->createIndex('cms_measure__created_at', '{{%cms_measure}}', 'created_at');
        $this->createIndex('cms_measure__updated_at', '{{%cms_measure}}', 'updated_at');

        $this->createIndex('cms_measure__name', '{{%cms_measure}}', 'name');

        $this->createIndex('cms_measure__code', '{{%cms_measure}}', 'code');
        $this->createIndex('cms_measure__symbol', '{{%cms_measure}}', 'symbol');
        $this->createIndex('cms_measure__symbol_intl', '{{%cms_measure}}', 'symbol_intl');
        $this->createIndex('cms_measure__symbol_letter_intl', '{{%cms_measure}}', 'symbol_letter_intl');
        $this->createIndex('cms_measure__priority', '{{%cms_measure}}', 'priority');

        $this->addForeignKey(
            'cms_measure_created_by', "{{%cms_measure}}",
            'created_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );

        $this->addForeignKey(
            'cms_measure_updated_by', "{{%cms_measure}}",
            'updated_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );


    }

    public function safeDown()
    {
        echo "m191204_180601_alter_table__measure cannot be reverted.\n";
        return false;
    }
}