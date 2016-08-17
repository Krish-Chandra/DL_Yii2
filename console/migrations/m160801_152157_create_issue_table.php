<?php

use yii\db\Schema;
use yii\db\Migration;

class m160801_152157_create_issue_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%issue}}', [
            // 'id' => Schema::TYPE_PK,
            // 'user_id' => Schema::TYPE_INTEGER . ' NOT NULL ',
            // 'book_id' => Schema::TYPE_INTEGER . ' NOT NULL ',
            // 'issue_date' => Schema::TYPE_DATE . '  NOT NULL ',
            // 'due_date' => Schema::TYPE_DATE . ' NOT NULL ',
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
            'issue_date' => $this->date()->notNull(),
            'due_date' => $this->date()->notNull()

        ], $tableOptions);

		$this->addForeignKey('FK_user_issue', 'issue', 'user_id',   'user',   'id', 'CASCADE');   
		$this->addForeignKey('FK_book_issue', 'issue', 'book_id',   'book',   'id', 'CASCADE');   
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_issue', 'issue');    	
        $this->dropForeignKey('FK_book_issue', 'issue');    	
        $this->dropTable('{{%issue}}');    	
    }
}
