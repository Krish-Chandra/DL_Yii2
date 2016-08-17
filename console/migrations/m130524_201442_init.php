<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            // 'id' => Schema::TYPE_PK,
            // 'username' => Schema::TYPE_STRING . ' NOT NULL',
            // 'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            // 'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            // 'password_reset_token' => Schema::TYPE_STRING,
            // 'email' => Schema::TYPE_STRING . ' NOT NULL',
            // // 'role' => Schema::TYPE_SMALLINT . ' UNSIGNED NOT NULL ',
            // 'role' => Schema::TYPE_INTEGER . ' NOT NULL ',

            // 'active' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT true',
            // 'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            // 'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'id' => $this->primaryKey(),
            'username' => $this->string(128)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string(128)->notNull()->unique(),
            'role' => $this->integer()->notNull(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

        ], $tableOptions);
        
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
