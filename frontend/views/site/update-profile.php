<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $userDetail common\models\UserDetail */
/* @var $form ActiveForm */
$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = ['label' => $user->full_name, 'url' => ['view-profile', 'id' => $user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-profile-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($user, 'title')->dropDownList($user->getTitleLabels(), ['prompt' => '- select title -']) ?>
	<?= $form->field($user, 'full_name') ?>
	<?= $form->field($userDetail, 'membership_number') ?>
	<?= $form->field($userDetail, 'member_category_id')->dropDownList($memberCategoryList, ['prompt' => '- Select category -']) ?>
	<?= $form->field($userDetail, 'present_position') ?>
	<?= $form->field($userDetail, 'affiliation') ?>
	<?= $form->field($userDetail, 'phone_office') ?>
	<?= $form->field($userDetail, 'phone_residence') ?>
	<?= $form->field($userDetail, 'phone_mobile') ?>
	<?= $form->field($userDetail, 'official_address')->textarea() ?>
	<?= $form->field($userDetail, 'permanent_address')->textarea() ?>
	<?= $form->field($userDetail, 'professional_qualifications')->textarea() ?>
	<?=
	$form->field($userDetail, 'qualifications')->widget(Select2::classname(), [
		'data' => $qualificationList,
		'options' => [
			'placeholder' => 'Select qualifications ...',
			'multiple' => true,
		],
		'pluginOptions' => [
			'allowClear' => true
		],
	])
	?>
	<?=
	$form->field($userDetail, 'specializations')->widget(Select2::classname(), [
		'data' => $specializationList,
		'options' => [
			'placeholder' => 'Select specializations ...',
			'multiple' => true,
		],
		'pluginOptions' => [
			'allowClear' => true
		],
	])
	?>

        <div class="form-group">
		<?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
		<?= Html::a('Cancel', ['view-profile'], ['class' => 'btn btn-primary']) ?>
        </div>
	<?php ActiveForm::end(); ?>

</div><!-- site-profile-update -->