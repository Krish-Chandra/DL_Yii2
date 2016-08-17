<?php

namespace backend\controllers;

use Yii;
use backend\models\Publisher;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;
// use yii\filters\AccessControl;

/**
 * PublisherController implements the CRUD actions for Publisher model.
 */
class PublisherController extends BaseController
{
    // public function behaviors()
    // {
    //     return [
    //         'access' => [
    //             'class' => AccessControl::className(),
    //             'rules' => [
    //                 [
    //                     'allow' => true,    
    //                     'roles' => ['librarian', 'assistant_librarian'],
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
     * Lists all Publisher models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => Publisher::getActiveDataQuery(),
        ]);
    }

    /**
     * Displays a single Publisher model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$publisher = $this->findModel($id);
        return $this->render('view', ['model' => $publisher]);
    }

    /**
     * Creates a new Publisher model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publisher();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
        }
        else
        {
            return $this->render('create', ['model' => $model]);
        }
    }

    /**
     * Edits an existing Publisher model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionEdit($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
            //return $this->redirect(['view', 'id' => $model->id]);
        }
        else
        {
            return $this->render('edit', ['model' => $model ]);
        }
    }

	
    /**
     * Deletes an existing Publisher model.
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Publisher model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Publisher the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publisher::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getKey()
    {
        return 'Publishers';
    }

}
