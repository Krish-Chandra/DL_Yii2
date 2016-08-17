<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */ 

$this->title = 'Add Category';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Add';
?>
<div class="book-create" style="width:700px;">

    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>Add Category</b>
    	</div>
    	<div class="panel-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
    	</div>
    </div>
</div>
<?php

?>