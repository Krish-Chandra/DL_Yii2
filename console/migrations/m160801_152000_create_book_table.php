<?php

use yii\db\Schema;
use yii\db\Migration;

class m160801_152000_create_book_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'category_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'publisher_id' => $this->integer()->notNull(),
            'isbn' => $this->string(20)->notNull(),
            'total_copies' => $this->integer()->notNull(),
            'available_copies' => $this->integer()->notNull()

        ], $tableOptions);

		$this->addForeignKey('FK_book_author', 'book', 'author_id',   'author',   'id', 'CASCADE');   
		$this->addForeignKey('FK_book_category', 'book', 'category_id',   'category',   'id', 'CASCADE');   
		$this->addForeignKey('FK_book_publisher', 'book', 'publisher_id',   'publisher',   'id', 'CASCADE');   
    }

    public function down()
    {
        $this->dropForeignKey('FK_book_author', 'book');    	
        $this->dropForeignKey('FK_book_category', 'book');    	
        $this->dropForeignKey('FK_book_publisher', 'book');    	
        
        $this->dropTable('{{%book}}');    	
    }
}
