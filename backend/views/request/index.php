<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Requests List
        </div>
        <div class="panel-body">
<?php
        if ($dataProvider->totalCount)
        {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

        			'book.title',
        			[
        				'attribute' => 'book.category.categoryname',
        				'label' => 'Category',
        			],
        			
        			'book.total_copies',
        			'book.available_copies',
                    'user.username',
                    [
                    	'attribute' => 'request_date',
                    	'format' => ['date', 'long']
                    	
                    ],

                    // ['class' => 'yii\grid\ActionColumn'],
                     [
                     	'label' => 'Issue?',
                        'format' => 'raw',
                        'value' => function($data) {
                        	if ($data->book->available_copies > 0)
                        	{

        //                   return '<a href="/book/addToCart"><img src="'. \Yii::$app->request->baseUrl . '\images\msg-ok.gif"/>' . '</a>';    
                            return Html::a("<i aria-hidden='true' class='glyphicon glyphicon-ok'></i>", ['issue-book', 'id' => $data["id"], 'bookId' => $data["book_id"], 'userId' => $data["user_id"]],
                                [
                                    'data' => [
                                                    'method' => 'post',
                                                ],

                                ]

                                );                                            
                            return Html::a("<i aria-hidden='true' class='glyphicon glyphicon-remove'></i>", ['remove-request', 'bookId' => $data["id"]]);                                            
                             // return Html::a('<img title="Add Book to the cart" src="'. \Yii::$app->request->baseUrl . '\images\msg-ok.gif"/>', ['add-to-cart', 'bookId' => $data["id"]]);                                 
                             }
                             else
                             {
        					 	
        					 	return "&nbsp;";
        					 }
                        }
                     ],

                ],
            ]);
        }
        else
            echo '<strong>No Requests from Members!</strong>' ;
?>    
        </div>
    </div>
</div>    

