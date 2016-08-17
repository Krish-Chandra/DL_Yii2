<?php

use yii\db\Schema;
use yii\db\Migration;
use backend\models\AdminUser;
use backend\models\Role;

class m150211_150848_create_admin_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(128)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string(50)->notNull(),
            'role_id' => $this->integer()->notNull(),

            'active' => $this->boolean()->notNull()->defaultValue(true),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()
        ], $tableOptions);

		$this->addForeignKey('FK_admin_user_role', 'admin_user', 'role_id',   'role',   'id', 'CASCADE');   

        // echo 'before';
        $librarianRole = Role::findByRolename("librarian");
        $librarian = new AdminUser();
        $librarian->username = "admin";
        $librarian->email = "admin@example.com";
        if ($librarianRole)
            $librarian->role_id = $librarianRole->getId();    
        $librarian->setPassword("password");
        $librarian->generateAuthKey();
        $librarian->save();

        $asstLibrarianRole = Role::findByRolename("assistant_librarian");
        $asstLibrarian = new AdminUser();
        $asstLibrarian->username = "asstAdmin";
        $asstLibrarian->email = "asstAdmin@example.com";
        if ($asstLibrarianRole)
            $asstLibrarian->role_id = $asstLibrarianRole->getId();    
        $asstLibrarian->setPassword("password");
        $asstLibrarian->generateAuthKey();
        $asstLibrarian->save();
        // echo 'after';        
    }

    public function down()
    {
        $this->dropForeignKey('FK_admin_user_role', 'admin_user');        
        $this->dropTable('{{%admin_user}}');
    }
}
