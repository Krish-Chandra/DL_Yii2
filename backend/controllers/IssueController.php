<?php
	namespace backend\controllers;

	use Yii;
	use backend\models\Issue;
	use backend\models\AdminModel;
	use yii\data\ActiveDataProvider;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	class IssueController extends BaseController
	{
	    // public function behaviors()
	    // {
	    //     return [
	    //         'verbs' => [
	    //             'class' => VerbFilter::className(),
	    //             'actions' => [
	    //                 'return-book' => ['post'],
	    //             ],
	    //         ],
	    //     ];
	    // }
	
		public function actionIndex()
		{
/*	        $dataProvider = Issue::model()->getAllIssues();
			$issues = $dataProvider->data;

			if (empty($issues))
			{
				Yii::app()->user->setFlash('error', "No book has been issued to Members!");	
			}
	        $this->render('index', array('dataProvider' => $dataProvider));
*/			
	        $dataProvider = new ActiveDataProvider([
	            'query' => Issue::find(),
	        ]);

	        return $this->render('index', [
	            'dataProvider' => $dataProvider,
	        ]);

		}
		
		public function actionReturnBook($bookId, $userId)		
		{
			$adminModel = new AdminModel;
			if ($adminModel === NULL)
			{
				$type = "message";
				$msg = "Couldn't complete the operation! Please try again!!";		
			}
			else
			{
		        $retVal = $adminModel->returnBook($bookId, $userId);
				if ($retVal)
				{
					$type = "message";
					$msg = "The operation completed successfully!!";		

				}
				else
				{
					$type = "message";
					$msg = "Couldn't complete the Operation! Please try again!!";
				}
			}

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
			{
				Yii::$app->session->setFlash($type, $msg);		
/*				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));*/
				$this->redirect(['index']);
			}
			else
		        echo "<div class='msg msg-ok push-1 span-21  prepend-top'><p><strong>".$msg."</strong></p></div>";									
		}

	    public static function getKey()
	    {
	        return 'Issues';
	    }
		
		
	}
?>