<?php

namespace backend\controllers;

use Yii;
use backend\models\Request;
use backend\models\AdminModel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
// use yii\filters\VerbFilter;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends BaseController
{
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'issue-book' => ['post'],
    //             ],
    //         ],
    //     ];
    // }

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Request::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

		public function actionIssueBook($id, $bookId, $userId)	
		{
		    {
				$adminModel = new AdminModel;
				if ($adminModel === NULL)
				{
					$type = "message";
					$msg = "Couldn't complete The operation! Please try again!!";		
				}
				else
				{
					try
					{
				        $retVal = $adminModel->issueBook($id, $bookId, $userId);
						if ($retVal)
						{
							$type = "message";
							$msg = "The book has been issued to the user!";		
		
						}
						else
						{
							$type = "message";
							$msg = "Couldn't issue the book to the user! Please try again!!";
						}
					}
					catch (CDebException $ex)
					{
						$msg = "Couldn't issue the book to the user! Please try again!!";	
					}
				}
	
	            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	            if(!isset($_GET['ajax']))
				{
					Yii::$app->session->setFlash($type, $msg);		
					//$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : ['index']);
					$this->redirect(['index']);					
				}
				else
			        echo "<div class='msg msg-ok push-1 span-21  prepend-top'><p><strong>".$msg."</strong></p></div>";									
		    }
				
		}


    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function getKey()
    {
        return 'Requests';
    }
    
}
