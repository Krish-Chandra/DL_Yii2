<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = "Digital Library - View Author";
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="author-view">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>View Author</b>
    	</div>
    	<div class="panel-body">
			<?= DetailView::widget([
			    'model' => $model,
			    'attributes' => [
		            'authorname',
		            'address',
					'city',
					'state',
		            'zip',
					'email_id',
		             'phone',
			    ],
			]) ?>
		    <p>
		        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
		            'class' => 'btn btn-danger',
		            'data' => [
		                'confirm' => 'Are you sure you want to delete this item?',
		                'method' => 'post',
		            ],
		        ]) ?>
		    </p>
    	</div>
    </div>
</div>
