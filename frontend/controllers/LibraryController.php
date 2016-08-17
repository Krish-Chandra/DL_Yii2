<?php

namespace frontend\controllers;

use Yii;
use app\models\Book;
use app\models\Request;
use app\models\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class LibraryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['checkout'],
                'rules' => [
                    [
                        'actions' => ['checkout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Display the books catalog.
     * @return mixed
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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionAddToCart($bookId)
    {
        if ((Yii::$app->session['reqCart'] !== null) && Yii::$app->session->has('reqCart'))
        {
            $reqCart = Yii::$app->session['reqCart'];
        }
        else
        {
            $reqCart = array(); 
        }
        
            $index = array_search($bookId, $reqCart);                   
            if ($index === FALSE) //Add the book to the cart if only it's not there already
            {
                $reqCart[] = $bookId;
            }
            
        Yii::$app->session['reqCart'] = $reqCart;
        Yii::$app->session->setFlash('message', "Selected books have been successfully added to the request cart!");      
        return $this->redirect(['index']);        
    }

	public function actionRemoveFromCart($bookId)
	{
				
		if ($this->removeBookFromRequestCart($bookId))
        	Yii::$app->session->setFlash('message', "Successfully removed the book from the request cart!");      		
        else
        	Yii::$app->session->setFlash('message', "Couldn't' remove the book from the request cart! Please try again!!");
        $this->redirect(\Yii::$app->urlManager->createUrl("library/view-cart"));
	}

	private function removeBookFromRequestCart($bookId)	
	{
        if ((Yii::$app->session['reqCart'] !== null) && isset(Yii::$app->session['reqCart']))
        {
            $reqCart = Yii::$app->session['reqCart'];
        }
		
		if (isset($reqCart) && ($reqCart !== NULL))
		{
			$index = array_search($bookId, $reqCart);					
			if ($index !== FALSE)
			{
				unset($reqCart[$index]);
				$reqCart = array_values($reqCart);
				Yii::$app->session['reqCart'] = $reqCart;				
				return TRUE;
			}
		}
		return FALSE;
	}
    
    public function actionViewCart()
    {
    	
    	// $bookModel = new Book;
        $reqBooks = Book::getRequestedBooks(); //Get all the books that have been added to the cart
        
        if ($reqBooks != NULL)
        {
            return $this->render('viewcart', ['dataProvider' => $reqBooks]);
        }
        else
        {
            // Yii::$app->session->setFlash('msg_error', "Your request cart is empty!");             
            return $this->render('viewcart', ['dataProvider' => $reqBooks]);
        }
    }   

    public function actionCheckout()
    {
        $reqCart = Yii::$app->session['reqCart'];
        $isError = false;
        if ($reqCart != NULL)
        {
            $message = "Couldn't process the request for the following book(s): <br />";
            for ($i = 0; $i < sizeof($reqCart); $i++)           
            {
                $bookId = $reqCart[$i];
                try
                {
                    $bookName = Book::getBookNameById($bookId);
                    $model = new Request;
                    if (!$model->addRequest($bookId))
                    {
                        $message .= "{$bookName} <br/>";
                        $isError = TRUE;
                    }
                    else
                    {
                        //Request for the book is successfully processed. We need to remove the book ($bookId) from the cart
                        $this->removeBookFromRequestCart($bookId);
                    }
                }
                catch (CDbException $ex)
                {
                    $message .= "{$bookName} <br/>";
                    $isError = TRUE;
                }
            }
            if (!$isError)
            {
                Yii::$app->session->removeAll();
                Yii::$app->session->setFlash('message', "All your requests have been successfully processed!");               
                return $this->redirect(array('index'));        
            }
        }
        else
        {
//            Yii::$app->session->setFlash('error', "Your request cart is empty!");
            return $this->render('viewcart');
        }
    }   
}
