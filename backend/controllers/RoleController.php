<?php

namespace backend\controllers;

use Yii;
use backend\models\Role;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
// use yii\filters\VerbFilter;
// use yii\filters\AccessControl;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends BaseController
{
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'allow' => true,    
    //                     'roles' => ['librarian'],
    //                 ],

    //             ],
    //         ],
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $auth = Yii::$app->authManager;
        // echo '<pre>';
        // var_dump($auth->getRoles());
        // echo '</pre>';
        // return;
        // $auth = Yii::$app->authManager;        
        // $provider = new ArrayDataProvider([
        //     'allModels' => $auth->roles,
        //     'pagination' => [
        //         'pageSize' => 10,
        //     ],
        // ]);        
        // echo '<pre>';
        // var_dump($provider);
        // echo '</pre>';
        // return;

        return $this->render('index', [
            'dataProvider' => Role::getActiveDataQuery(),
        ]);
        // return $this->render('index', [
        //     'dataProvider' => $provider,
        // ]);

    }

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$author = $this->findModel($id);
        return $this->render('view', ['model' => $author]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
        	$auth = Yii::$app->authManager;
	        $newRole = $auth->createRole($model->rolename);

	        $auth->add($newRole);
            //Use this code if there can be only one permission assigned to the role
            //In the view, it'll be radio buttons
	        // $auth->addChild($newRole, $auth->getPermission(Yii::$app->request->post('permission')));
            $permissions = Yii::$app->request->post('permission');
            if (isset($permissions))
            {
                foreach($permissions as $per)
                {
	               $auth->addChild($newRole, $auth->getPermission($per));                    
                }                
            }
        	
            return $this->redirect(['index']);
        }
        else
        {
	        $permissions = Yii::$app->authManager->getPermissions();        	
            return $this->render('create', ['model' => $model, 'permissions' => $permissions]);
        }
    }

    /**
     * Edits an existing Role model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            //return $this->redirect(['view', 'id' => $model->id]);
        	$auth = Yii::$app->authManager;
	        $newRole = $auth->getRole($model->rolename);
            $auth->removeChildren($newRole);

            //$auth->add($newRole);
            //Use this code if there can be only one permission assigned to the role
            //In the view, it'll be radio buttons
	        // $auth->addChild($newRole, $auth->getPermission(Yii::$app->request->post('permission')));
            $permissions = Yii::$app->request->post('permission');
            if (isset($permissions))
            {
                foreach($permissions as $per)
                {
                    $auth->addChild($newRole, $auth->getPermission($per));                    
                }                
            }

            return $this->redirect(['index']);
        }
        else
        {
	        $permissions = Yii::$app->authManager->getPermissions();            
            $rolePermissions = Yii::$app->authManager->getPermissionsByRole($model->rolename);        	

            return $this->render('edit', [ 'model' => $model, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions  ]);
        }
    }

    // public function actionEdit($name)
    // {
    //     $auth = Yii::$app->authManager;        
    //     $model = new Role();
    //     $role = $auth->getRole($name);
    //     $model->name = $role->name;
    //     $model->description = $role->description;

    //     if (Yii::$app->request->isPost)
    //     {
    //         //return $this->redirect(['view', 'id' => $model->id]);
    //         $auth = Yii::$app->authManager;
    //         $newRole = $auth->getRole($name);
    //         $auth->removeChildren($newRole);

    //         //$auth->add($newRole);
    //         //Use this code if there can be only one permission assigned to the role
    //         //In the view, it'll be radio buttons
    //         // $auth->addChild($newRole, $auth->getPermission(Yii::$app->request->post('permission')));
    //         $permissions = Yii::$app->request->post('permission');
    //         if (isset($permissions))
    //         {
    //             foreach($permissions as $per)
    //             {
    //                 $auth->addChild($newRole, $auth->getPermission($per));                    
    //             }                
    //         }

    //         return $this->redirect(['index']);
    //     }
    //     else
    //     {
    //         $permissions = Yii::$app->authManager->getPermissions();            
    //         $rolePermissions = Yii::$app->authManager->getPermissionsByRole($name);          

    //         return $this->render('edit', [ 'model' => $model, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    //     }
    // }
	
    /**
     * Deletes an existing Role model.
     * @return mixed
     */
    public function actionDelete($id)
    {

        $auth = Yii::$app->authManager;
        $model = $this->findModel($id);

        $roleToDel = $auth->getRole($model->rolename);        
        $auth->remove($roleToDel);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getKey()
    {
        return 'Roles';
    }

}
