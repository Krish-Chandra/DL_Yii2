<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admin Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <p>
        <?= Html::a('Add Admin User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
	if (!empty($dataProvider))
	{
?>		
    <div class="panel panel-primary">
        <div class="panel-heading">
            Admin Users List
        </div>
        <div class="panel-body">

		    <?= GridView::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		            'username',
		            'email',
		            [
		            	'label' => 'Role',
		            	'value' => 'role.rolename',
		            ],

		            [
		            	'label' => 'Active?',
		            	'value' => function($data) { return $data['active'] ? 'Yes' : 'No';}
		            	
		            ],
		            // 'active',
//					['class' => 'yii\grid\ActionColumn'],
					[
					'format' => 'raw',
					'value' => function($data) {
	                       if ($data['username'] == 'admin')					
                            return ' ';
						 return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['edit', 'id' => $data["id"]], ['title' => 'Edit']) .
//						 Html::a('<img title="Edit Admin User" src="'. \Yii::$app->request->baseUrl . '\images\edit.gif"/>', ['edit', 'id' => $data["id"]])
						 " " . Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data["id"]],
						 	[
							 	'data' => [
								    'confirm' => 'Are you sure you want to delete this Admin User?',
								    'method' => 'post',
								],

						 	]
						);					 			 
					}
					],

		        ],
		    ]);
?>
	</div>
</div>

<?php		
	}
?>
