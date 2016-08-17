<?php

use yii\db\Schema;
use yii\db\Migration;

class m160801_152327_create_request_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%request}}', [
            // 'id' => Schema::TYPE_PK,
            // 'book_id' => Schema::TYPE_INTEGER . ' NOT NULL ',            
            // 'user_id' => Schema::TYPE_INTEGER . ' NOT NULL ',
            // 'request_date' => Schema::TYPE_DATE . '  NOT NULL ',
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'request_date' => $this->date()->notNull(),

        ], $tableOptions);

		$this->addForeignKey('FK_request_book', 'request', 'book_id',   'book',   'id', 'CASCADE');   
		$this->addForeignKey('FK_request_user', 'request', 'user_id',   'user',   'id', 'CASCADE');   


    }

    public function down()
    {
        $this->dropForeignKey('FK_request_user', 'request');    	
        $this->dropForeignKey('FK_request_book', 'request');    	
        $this->dropTable('{{%request}}');    	
    }
}
