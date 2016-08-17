<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Author */

$this->title = "Edit Author";
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="author-update" style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Edit Author</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
  		
    	</div>
    </div>
</div>

</div>
