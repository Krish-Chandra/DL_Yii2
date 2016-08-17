<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <p>
        <?= Html::a('Add Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Books Catalog
        </div>
        <div class="panel-body">
<?php
		if ($dataProvider->totalCount > 0)
		{
		    echo GridView::widget([
		        'dataProvider' => $dataProvider,
//		        'filterModel' => $searchModel,
		        'columns' => [
/*		            ['class' => 'yii\grid\SerialColumn'],

		            'id',
*/		            'title',
//		            'category_id',
//					'category.categoryname',
		            [
		            	'label' => 'Category',
		            	'value' => 'category.categoryname',
		            ],
					//'author.authorname',
		            [
		            	'label' => 'Author',
		            	'value' => 'author.authorname',
		            ],
		            
//		            'publisher_id',
//					'publisher.publishername',
		            [
		            	'label' => 'Publisher',
		            	'value' => 'publisher.publishername',
		            ],

		             'isbn',
		             'total_copies',
		             'available_copies',
					//['class' => 'yii\grid\ActionColumn'],
		             [
						'format' => 'raw',
						'value' => function($data) {
							 return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['edit', 'id' => $data["id"]], ["title" => "Edit"])
							 . " " . Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data["id"]],
							 	[
							 		'title' => 'Remove',
								 	'data' => [
									                'confirm' => 'Are you sure you want to delete this Book?',
									                'method' => 'post',
									            ],

							 	]
							);					 			 
						}
		             ],

			    ]
		    ]);
		}
		else
			echo '<strong>No Books defined in the system!</strong>' ;
?>        	
        </div>
	</div>
</div>
