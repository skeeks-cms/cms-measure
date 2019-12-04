<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */
use yii\db\Schema;
use yii\db\Migration;

class m191204_170601_alter_table__measure extends Migration
{
    public function safeUp()
    {
        $tableName = "{{%measure}}";

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->renameColumn($tableName, "symbol_rus", "symbol");
        $this->alterColumn($tableName, "code", $this->string(3)->notNull()->unique());
    }

    public function safeDown()
    {
        echo "m191204_170601_alter_table__measure cannot be reverted.\n";
        return false;
    }
}