<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <p>
        <?= Html::a('Add Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="panel panel-primary">
        <div class="panel-heading">
            Authors List
        </div>
        <div class="panel-body">
<?php
		if ($dataProvider->totalCount > 0)
		{

		    echo GridView::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		            'authorname',
		            'address',
					'city',
					'state',
		            'zip',
					'email_id',
		             'phone',
					// ['class' => 'yii\grid\ActionColumn'],
		             [
						'format' => 'raw',
						'value' => function($data) {
							 return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['edit', 'id' => $data["id"]], ["title" => "Edit"])
							 . " " . Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data["id"]],
							 	[
							 		'title' => 'Remove',
								 	'data' => [
									                'confirm' => 'Are you sure you want to delete this Author?',
									                'method' => 'post',
									            ],

							 	]
							);					 			 
						}
		             ],

		        ],
		    ]); 
		}
		else
			echo '<strong>No Authors defined in the system!</strong>' ;
?>		
		</div>
	</div>	
</div>
