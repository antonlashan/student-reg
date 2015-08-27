<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

	<?php
	$form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
	]);
	?>

	<?= $form->field($model, 'search_e_n')->label(false) ?>


	<div class="form-group">
		<?= Html::submitButton('Search', ['class' => 'btn btn-default']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
