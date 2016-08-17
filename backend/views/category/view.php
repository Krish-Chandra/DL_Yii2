<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = "Digital Library - View Ctegory";
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="author-view">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>View Category</b>
    	</div>
    	<div class="panel-body">
			<?= DetailView::widget([
			    'model' => $model,
			    'attributes' => [
		            'categoryname',
		            'description',
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
