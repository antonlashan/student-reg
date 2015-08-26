<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Home';
?>
<div class="user-index">

	<h1>Search existing members </h1>
	<?php echo $this->render('_search', ['model' => $searchModel]); ?>


	<?php if ($dataProvider) { ?>
		<?=
		ListView::widget([
			'dataProvider' => $dataProvider,
			'itemOptions' => ['class' => 'item'],
			'itemView' => function ($model, $key, $index, $widget) {
			return Html::a(Html::encode($model->full_name), ['view-member', 'id' => $model->id]);
		},
		])
		?>
	<?php } ?>

</div>
