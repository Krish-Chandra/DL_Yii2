<?php

use yii\db\Schema;
use yii\db\Migration;

class m160731_140903_create_publisher_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%publisher}}', [
            'id' => $this->primaryKey(),
            'publishername' => $this->string(128)->notNull(),
            'address' => $this->string()->notNull(),
            'city' => $this->string(50)->notNull(),
            'state' => $this->string(10)->notNull(),
            'zip' => $this->string(10)->notNull(),
            'email_id' => $this->string(50)->notNull(),
            'phone' => $this->string(15)->notNull()

        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%publisher}}');    	
    }
}
