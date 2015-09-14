<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
	<h1><?= Html::encode($this->title) ?></h1>

	<p>Please fill out the following fields to signup:</p>

	<div class="row">
		<div class="col-lg-5">
		    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>


			<?= $form->field($model, 'title')->dropDownList(User::instantiate(null)->getTitleLabels(), ['prompt' => '- select title -']) ?>
			<?= $form->field($model, 'full_name') ?>
			<?= $form->field($model, 'email') ?>

			<?= $form->field($model, 'password')->passwordInput() ?>
			<?php // $form->field($model, 'is_public')->checkbox(['value' => User::IS_PUBLIC_YES, 'uncheck' => User::IS_PUBLIC_NO], false) ?>

			<div class="form-group">
				<?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
			</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
