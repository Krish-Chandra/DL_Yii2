<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = "Edit Book";
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Edit Book</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', [
		    	'categoryModels' => $categoryModels,
		    	'authorModels' => $authorModels,
		    	'publisherModels' => $publisherModels,
		        'model' => $model,
		    ]) ?>
  		
    	</div>
    </div>
</div>

</div>
