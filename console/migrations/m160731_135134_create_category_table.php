<?php

use yii\db\Schema;
use yii\db\Migration;

class m160731_135134_create_category_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'categoryname' => $this->string(50)->notNull(),
            'description' => $this->string()->notNull()

        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%category}}');    	    	
    }
}
