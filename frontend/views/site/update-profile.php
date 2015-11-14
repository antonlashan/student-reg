<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use common\models\UserDetail;

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
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($user, 'title')->dropDownList($user->getTitleLabels(), ['prompt' => '- select title -']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($user, 'full_name') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group field-user-email">
                <label for="user-email" class="control-label">Email</label>
                <label class="form-control"><?= $user->email ?></label>

                <div class="help-block"></div>
            </div>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <?= $form->field($userDetail, 'visibility_email', ['template' => "{input}\n{label}\n{hint}\n{error}"])->checkbox(['value' => UserDetail::VISIBILITY_EMAIL_YES, 'uncheck' => UserDetail::VISIBILITY_EMAIL_NO], false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group field-userdetail-membership_number">
                <label for="userdetail-membership_number" class="control-label">Membership Number</label>
                <input type="text" value="sfgsdgs343234" name="" class="form-control" disabled id="userdetail-membership_number">

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group field-userdetail-member_category_id">
                <label for="userdetail-member_category_id" class="control-label">Member Category</label>
                <select name="" class="form-control" id="userdetail-member_category_id" disabled>
                    <option value=""><?= ($userDetail->memberCategory) ? $userDetail->memberCategory->name : '' ?></option>
                </select>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'present_position') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($userDetail, 'affiliation') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'phone_office') ?>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <?= $form->field($userDetail, 'visibility_phone_office', ['template' => "{input}\n{label}\n{hint}\n{error}"])->checkbox(['value' => UserDetail::VISIBILITY_PHONE_OFFICE_YES, 'uncheck' => UserDetail::VISIBILITY_PHONE_OFFICE_NO], false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'phone_residence') ?>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <?= $form->field($userDetail, 'visibility_phone_residence', ['template' => "{input}\n{label}\n{hint}\n{error}"])->checkbox(['value' => UserDetail::VISIBILITY_PHONE_RESIDENCE_YES, 'uncheck' => UserDetail::VISIBILITY_PHONE_RESIDENCE_NO], false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'phone_mobile') ?>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <?= $form->field($userDetail, 'visibility_phone_mobile', ['template' => "{input}\n{label}\n{hint}\n{error}"])->checkbox(['value' => UserDetail::VISIBILITY_PHONE_MOBILE_YES, 'uncheck' => UserDetail::VISIBILITY_PHONE_MOBILE_NO], false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'official_address')->textarea() ?>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <?= $form->field($userDetail, 'visibility_official_address', ['template' => "{input}\n{label}\n{hint}\n{error}"])->checkbox(['value' => UserDetail::VISIBILITY_OFFICIAL_ADDRESS_YES, 'uncheck' => UserDetail::VISIBILITY_OFFICIAL_ADDRESS_NO], false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'permanent_address')->textarea() ?>
        </div>
        <div class="col-md-6">
            <label>&nbsp;</label>
            <?= $form->field($userDetail, 'visibility_permanent_address', ['template' => "{input}\n{label}\n{hint}\n{error}"])->checkbox(['value' => UserDetail::VISIBILITY_PERMANENT_ADDRESS_YES, 'uncheck' => UserDetail::VISIBILITY_PERMANENT_ADDRESS_NO], false) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($userDetail, 'professional_qualifications')->textarea() ?>
        </div>
        <div class="col-md-6">
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
        </div>
    </div>

</div>
<div class="clearfix"></div>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Cancel', ['view-profile'], ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

</div><!-- site-profile-update -->