<?php

namespace backend\controllers;

use Yii;
use Yii\helpers\ArrayHelper;

use backend\models\Author;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * AuthorController implements the CRUD actions for Author model.
 */
class AuthorController extends BaseController
{
    /**
     * Lists all Author models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', ['dataProvider' => Author::getActiveDataQuery()]);
    }

    // /**
    //  * Displays a single Author model.
    //  * @param string $id
    //  * @return mixed
    //  */
    // public function actionView($id)
    // {
    // 	$author = $this->findModel($id);
    //     return $this->render('view', ['model' => $author]);
    // }

    /**
     * Creates a new Author model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Author();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        else
        {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Edits an existing Author.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        else
        {
            return $this->render('edit', ['model' => $model]);
        }
    }

	
    /**
     * Deletes an existing Author model.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Author model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Author::findOne($id)) !== null) {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Retruns a string that identifies this controller class
     * @return String
     */
    
    public static function getKey()
    {
        return 'Authors';
    }
    
}
