<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\db\Expression;

class m150205_134948_create_role_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%role}}', [
            // 'id' => 'SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'id' => $this->primaryKey(),
            'rolename' => $this->string(50)->notNull(),
            'description' => $this->string()->notNull(),            
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], $tableOptions);
  
        //Add a FK constraint to the user table
        $this->addForeignKey('FK_user_role', 'user', 'role',   'role',   'id', 'CASCADE');

		
		Yii::$app->db->createCommand()->insert('role', [
          'rolename' => 'librarian',
          'description' => 'Omnipotent user in system!',
          'created_at' => new Expression('NOW()'),
          'updated_at' => new Expression('NOW()')
      ])->execute();

    Yii::$app->db->createCommand()->insert('role', [
          'rolename' => 'assistant_librarian',
          'description' => 'Less powerful than the librarian',
          'created_at' => new Expression('NOW()'),
          'updated_at' => new Expression('NOW()')
      ])->execute();

		Yii::$app->db->createCommand()->insert('role', [
          'rolename' => 'member',
          'description' => 'Members in the system!',
          'created_at' => new Expression('NOW()'),
          'updated_at' => new Expression('NOW()')
      ])->execute();

    }

    public function down()
    {
        $this->dropForeignKey('FK_user_role', 'user');
        $this->dropTable('{{%role}}');
    }}
