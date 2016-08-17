<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Members List
        </div>
        <div class="panel-body">
<?php
		if ($dataProvider->totalCount > 0)
		{

		    echo GridView::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		            'username',
                    //'active',
		            [
		            	'label' => 'Active?',
		            	'value' => function($data) { return $data['active'] ? 'Yes' : 'No';}
		            	
		            ],

					// ['class' => 'yii\grid\ActionColumn'],
		             [
						'format' => 'raw',
						'value' => function($data) {
							 return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['edit', 'id' => $data["id"]], ["title" => "Edit"])
							 . " " . Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data["id"]],
							 	[
							 		'title' => 'Remove',
								 	'data' => [
									                'confirm' => 'Are you sure you want to delete this Member?',
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
			echo '<strong>No Member signed up in the system!</strong>' ;
?>
	</div>
</div>

