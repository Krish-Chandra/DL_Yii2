<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Library';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
-->
    <div class="panel panel-primary">
        <div class="panel-heading">
            Books Catalog
        </div>
        <div class="panel-body">

		    <?= GridView::widget([
		        'dataProvider' => $dataProvider,
//		        'filterModel' => $searchModel,
		        'columns' => [
		            ['class' => 'yii\grid\SerialColumn'],

		            'title',
		            [
		            	'label' => 'Category',
		            	'value' => 'category.categoryname',
		            ],
		            
		            [
		            	'label' => 'Author',
		            	'value' => 'author.authorname',
		            ],
		            [
		            	'label' => 'Publisher',
		            	'value' => 'publisher.publishername',
		            ],
		            
		             'isbn',
		             'total_copies',
		             'available_copies',
		             [
		/*             	'format' => 'image',
		             	'value' =>   function($data) { return $data->imageurl; },
		*/             	
						'format' => 'raw',
						'value' => function($data) {
		//					 return '<a href="/book/addToCart"><img src="'. \Yii::$app->request->baseUrl . '\images\msg-ok.gif"/>' . '</a>';	
							return Html::a("<i aria-hidden='true' class='glyphicon glyphicon-plus'></i>", ['add-to-cart', 'bookId' => $data["id"]]);											
							 // return Html::a('<img title="Add Book to the cart" src="'. \Yii::$app->request->baseUrl . '\images\msg-ok.gif"/>', ['add-to-cart', 'bookId' => $data["id"]]);					 			 
						}
		             ],
		//            ['class' => 'yii\grid\ActionColumn'],
		        ],
		    ]);
?>
        <div style="text-align: center">
<?php
			echo Html::a("<i aria-hidden='true' class='glyphicon glyphicon-shopping-cart'></i>", ['view-cart']);
?>        	
        </div>

	</div>
</div>
