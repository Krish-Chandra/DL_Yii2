<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">

    <p>
        <?= Html::a('Add Role', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<?php
	if (!empty($dataProvider))
	{
?>		
    <div class="panel panel-primary">
        <div class="panel-heading">
            Roles List
        </div>
        <div class="panel-body">

		    <?= GridView::widget([
		        'dataProvider' => $dataProvider,
		        'columns' => [
		             'rolename',
                     //[
                     //    'content' => function($data) {
                     //       return Html::a($data['rolename'], [($data['rolename'] == "member") ? '/member/index' : '/admin/index', 'roleId' => $data["id"]]);											
                     //    }
                     //],

		            'description',

					// ['class' => 'yii\grid\ActionColumn'],
		             [
						'format' => 'raw',
						'value' => function($data) {
	                       if ($data['rolename'] == 'librarian')					
                            return ' ';

							 return Html::a('<span class="glyphicon glyphicon-edit"></span>', ['edit', 'id' => $data["id"]], ["title" => "Edit"])
							 . " " . Html::a('<span class="glyphicon glyphicon-remove"></span>', ['delete', 'id' => $data["id"]],
							 	[
							 		'title' => 'Remove',
								 	'data' => [
									                'confirm' => 'Are you sure you want to delete this Role?',
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
