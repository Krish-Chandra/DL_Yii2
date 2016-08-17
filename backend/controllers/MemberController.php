<?php
    namespace backend\controllers;

    use Yii;
    use backend\models\Member;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;


    class MemberController  extends BaseController
    {
        public function actionIndex()
        {
            return $this->render('index', ['dataProvider' => Member::getActiveDataQuery()]);
        }
     
        /**
         * Edits an existing Member.
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
                        return $this->redirect(['index']);
                    }

                }
            }
        	
            return $this->render('edit', ['model' => $model]);
        }

        /**
         * Finds the Member model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param string $id
         * @return Member the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id)
        {
            if (($model = Member::findOne($id)) !== null) {
                return $model;
            }
            else
            {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

        public static function getKey()
        {
            return 'Members';
        }
        
    }