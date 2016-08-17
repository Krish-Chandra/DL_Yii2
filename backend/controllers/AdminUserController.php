<?php

namespace backend\controllers;

use Yii;
use Yii\helpers\ArrayHelper;
use backend\models\AdminUser;
use backend\models\Role;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AdminUserController implements the CRUD actions for AdminUser model.
 */

class AdminUserController extends BaseController
{

    /**
     * Lists all AdminUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $auth = 
        return $this->render('index', [
            'dataProvider' => AdminUser::getActiveDataQuery(),
        ]);
    }

    /**
     * Creates a new AdminUser model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
         $model = new AdminUser(['scenario' => 'Create']);

        // if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     return ActiveForm::validate($model);
        // }
         if ($model->load(Yii::$app->request->post()))
         {

             if ($model->validate())
             {
                 if (isset($model->password) && !empty($model->password))
                 {
                     $model->setPassword($model->password);
                     $model->generateAuthKey();
                 }
                 if ($model->save())
                 {
                     $auth = Yii::$app->authManager;
                     $newRoleName = Role::getRolenameById($model->role_id);
                     $newRole = $auth->getRole($newRoleName);
                     //$auth->revokeAll($model->getId());
                     $auth->assign($newRole, $model->getId());        	
                     return $this->redirect(['index']);
                     
                 }
             } 
             else
             {
                 //print_r($model->errors);
                 //return;
             }
        }
		$roles    = self::getRoles();        
		return $this->render('create', ['model' => $model, 'roles' => $roles ]);
    }

    /**
     * Edits an existing AdminUser model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post()))
         {
             if ($model->validate())
             {
                 if (isset($model->password) && !empty($model->password))
                 {
                     $model->setPassword($model->password);
                 }

                 if ($model->save())
                 {
                     $auth = Yii::$app->authManager;
                     $newRoleName = Role::getRolenameById($model->role_id);
                     $newRole = $auth->getRole($newRoleName);
                     $auth->revokeAll($model->getId());
                     $auth->assign($newRole, $model->getId());        	
                     return $this->redirect(['index']);
                 }

             }
         }
	    $roles = self::getRoles();        
	    $permissions = Yii::$app->authManager->getPermissions();
        	
        return $this->render('edit', ['model' => $model, 'roles' => $roles, 'permissions' => $permissions]);
    }

	
    /**
     * Deletes an existing AdminUser model.
     * @return mixed
     */
    public function actionDelete($id)
    {
		$auth = Yii::$app->authManager;
        $model = $this->findModel($id);
		$auth->revokeAll($model->getId());        
        $model->delete();

         return $this->redirect(['index']);
    }

    /**
     * Finds the AdminUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Gets a list of roles assigned to the AdminUser
     * @return List of all roles
     */
    public static function getRoles()
    {
        return Role::getAll();

    }

    /**
     * Retruns a string that identifies this controller class
     * @return String key
     */

    public static function getKey()
    {
        return 'AdminUser';
    }

}

