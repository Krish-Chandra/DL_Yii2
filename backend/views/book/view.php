<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = "Digital Library - View Book";
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">
    <div class="panel panel-primary">
    	<div class="panel-heading">
    		<b>View Book</b>
    	</div>
    	<div class="panel-body">
			<?= DetailView::widget([
			    'model' => $model,
			    'attributes' => [
			        'title',
//			        'author_id',
					[
						'label' => 'Author',
						'value' => $author->authorname,
					],
					
//			        'category_id',
					[
						'label' => 'Category',
						'value' => $category->categoryname,
					],

			        //'publisher_id',
					[
						'label' => 'Publisher',
						'value' => $publisher->publishername,
					],
			        
			        'isbn',
			        'total_copies',
			        'available_copies',
			    ],
			]) ?>
		    <p>
		        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
		            'class' => 'btn btn-danger',
		            'data' => [
		                'confirm' => 'Are you sure you want to delete this Book?',
		                'method' => 'post',
		            ],
		        ]) ?>
		    </p>
    	</div>
    </div>
</div>
