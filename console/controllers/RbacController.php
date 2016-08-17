<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\common\models\User;
use backend\models\AdminUser;


class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        // $rule = new backendUsersRule;
        // $auth->add($rule);

        print_r($auth);

        //All Author-related activities
        $author = $auth->createPermission('Authors');
        $author->description = 'View/Add/Delete Authors';
        $auth->add($author);

        //All Book-related activities
        $book = $auth->createPermission('Books');
        $book->description = 'View/Add/Delete Books';
        $auth->add($book);

        //All Category-related activities
        $category = $auth->createPermission('Categories');
        $category->description = 'View/Add/Delete Categories';
        $auth->add($category);

        //All Publisher-related activities
        $publisher = $auth->createPermission('Publishers');
        $publisher->description = 'View/Add/Delete Publishers';
        $auth->add($publisher);

        // add "author" role and give this role the "createPost" permission
        $asstLibr = $auth->createRole('assistant_librarian');
        // $asstLibr->ruleName = $rule->name;                
        $auth->add($asstLibr);
        $auth->addChild($asstLibr, $author);
        $auth->addChild($asstLibr, $book);
        $auth->addChild($asstLibr, $category);
        $auth->addChild($asstLibr, $publisher);

        //All regiestered member related activities
        $member = $auth->createPermission('Members');
        $member->description = 'View/Add/Delete Members in the System';
        $auth->add($member);

        //Manage roles in the system
        $role = $auth->createPermission('Roles');
        $role->description = 'View/Add/Delete Roles in the System';
        $auth->add($role);

        //All Admin-related activities
        $admin = $auth->createPermission('AdminUsers');
        $admin->description = 'View/Add/Delete Admin Users in the System';
        $auth->add($admin);

        //Deal with reuests for books
        $requests = $auth->createPermission('Requests');
        $requests->description = 'View/Delete requests and issue books';
        $auth->add($requests);

        //Deal with issued books
        $issues = $auth->createPermission('Issues');
        $issues->description = 'View issues and return books';
        $auth->add($issues);

        //Assistant librarians also have access to requests and issues
        $auth->addChild($asstLibr, $requests);
        $auth->addChild($asstLibr, $issues);

        // add "librarian" role and give this role permissions to manage members and admins
        // as well as the permissions of the "assistant_librarian" role
        $librarian = $auth->createRole('librarian');
        // $librarian->ruleName = $rule->name;                
        $auth->add($librarian);
        $auth->addChild($librarian, $member);
        $auth->addChild($librarian, $role);
        $auth->addChild($librarian, $admin);
        $auth->addChild($librarian, $asstLibr);


        //The Librarian user name is admin
        $adminUser = AdminUser::findByUsername("admin");
        if ($adminUser)
            $auth->assign($librarian, $adminUser->getId());

        //Assistant Librarian's name is asst_admin        
        $asstAdminUser = AdminUser::findByUsername("asstAdmin");
        if ($asstAdminUser)
            $auth->assign($asstLibr, $asstAdminUser->getId());
         
    }
}