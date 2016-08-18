<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Issues';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <div class="panel panel-primary">
        <div class="panel-heading">
            Issues List
        </div>
        <div class="panel-body">
<?php
        if ($dataProvider->totalCount > 0)
        {

            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'book.title',
                    [
                        'label' => 'Author',
                        'value' => 'book.author.authorname'
                    ],
                    
                    [
                    	'attribute' => 'user.username',
                    	'label' => 'Issued To',
                    ],
                    //'user.username',
                    [
                    	'attribute' => 'issue_date',
                    	'label' => 'Issued On',
                    	'format' => ['date', 'long']
                    	
                    ],
                    [
                    	'attribute' => 'due_date',
                    	'label' => 'Due On',
                    	'format' => ['date', 'long']
                    	
                    ],
                    
        //            'requesteddate',

                    // ['class' => 'yii\grid\ActionColumn'],
                             [
                /*              'format' => 'image',
                                'value' =>   function($data) { return $data->imageurl; },
                */              
                				'label' => 'Returned?',
                                'format' => 'raw',
                                'value' => function($data) {
                //                   return '<a href="/book/addToCart"><img src="'. \Yii::$app->request->baseUrl . '\images\msg-ok.gif"/>' . '</a>';    
                                    return Html::a("<i aria-hidden='true' class='glyphicon glyphicon-ok'></i>", ['return-book', 'id' => $data["id"], 'bookId' => $data["book_id"], 'userId' => $data["user_id"]],
                                        [
                                            'data' => [
                                                            'method' => 'post',
                                                        ],

                                        ]

                                        );                                            
                                    return Html::a("<i aria-hidden='true' class='glyphicon glyphicon-remove'></i>", ['remove-request', 'bookId' => $data["id"]]);                                            
                                     // return Html::a('<img title="Add Book to the cart" src="'. \Yii::$app->request->baseUrl . '\images\msg-ok.gif"/>', ['add-to-cart', 'bookId' => $data["id"]]);                                 
                                }
                             ],

                ],
            ]); 
        }
        else
            echo '<strong>No Books issued to Members!</strong>' ;
?>
    </div>
</div>    
