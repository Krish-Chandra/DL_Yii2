<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'View Cart';
$this->params['breadcrumbs'][] = $this->title;

	if (isset($dataProvider->totalCount) && !empty($dataProvider->totalCount))
	{

?>	
		<div class="book-index">

		    <div class="panel panel-primary">
		        <div class="panel-heading">
		            Your Request cart
		        </div>
		         <div class="panel-body">
				    <?= GridView::widget([
				        'dataProvider' => $dataProvider,
				        'columns' => [
				            'title',
				            [
				            	'label' => 'ISBN',
				            	'value' => 'isbn',
				            ],
				             
				             'total_copies',
				             'available_copies',
				             [
								'format' => 'raw',
								'value' => function($data) {
									 // return Html::a('<img title="Remove Book from the cart" src="'. \Yii::$app->request->baseUrl . '\images\delete.png"/>', ['remove-from-cart', 'bookId' => $data["id"]], ['data-method' => 'post']);					 			 
									return Html::a("<i aria-hidden='true' class='glyphicon glyphicon-remove'></i>", ['remove-from-cart', 'bookId' => $data["id"]]);									
								}
				             ],
				        ],
				    ]); ?>
				   </div>
		 	        
			</div>
		</div>
        <div style="text-align: center">
<?php
			echo Html::a("<i aria-hidden='true' class='glyphicon glyphicon-arrow-right'></i>", ['checkout'], ['data-method' => 'post']);
?>        	
        </div>

		<?php
	}
	else
	{
		echo '<div class="alert alert-danger">Your request cart is empty!</div>';
	}
