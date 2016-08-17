<?php

namespace backend\controllers;

use Yii;
use Yii\helpers\ArrayHelper;
use backend\models\Book;
use backend\models\Author;
use backend\models\Category;
use backend\models\Publisher;
use backend\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\controllers\BaseController;
/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends BaseController
{

    /**
     * Lists all Book models.
     * @return the result of render method
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $publishers = self::getPublishers();
        $categories = self::getCategories();
        $authors    = self::getAuthors();
		$pubarray = $catarray = $autharray = array();       
		$errorMsg = '';
        if (empty($publishers) || empty($categories) || empty($authors))
        	$errorMsg = "Couldn't add a Book now! Please add atleast one Author, Publisher, and Category first!!";      
        	
		$model = new Book();

        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['index']);
        }
        else
        {
            return $this->render('create', [
                'model' => $model, 'categoryModels' => $categories, 'authorModels' => $authors,
                'publisherModels' => $publishers, 'errorMsg' => $errorMsg
            ]);
        }

    }

    /**
     * Edits an existing Book.
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
            return $this->render('edit', [
                'model' => $model, 'categoryModels' => self::getCategories(), 'authorModels' => self::getAuthors(),
                'publisherModels' => self::getPublishers()
            ]);
        }
    }

    /**
     * Returns a list of all Categories.
     * @return Category model List
     */

	public static function getCategories()
	{
		return Category::getAll();
	}

    /**
     * Returns a list of all Authors.
     * @return Author model List
     */

	public static function getAuthors()
	{
		return Author::getAll();
	}
    /**
     * Returns a list of all Publishers.
     * @return Publisher model List
     */

	public static function getPublishers()
	{
		return Publisher::getAll();
	}
	
    /**
     * Deletes an existing Book model and redirects the user to the 'index' page.
     * @return 
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } 
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Returns a unique string that identifies the Book controller
     * @return String the unique key
     */
    public static function getKey()
    {
        return 'Books';
    }
}
