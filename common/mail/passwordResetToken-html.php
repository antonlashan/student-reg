<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Dear <?= $user->getTitleLabel() ?> <?= Html::encode($user->full_name) ?>,</p>

    <p>Please follow the link below to reset your password:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>

    <p>Regards</p>
    <p>Admin</p>
    <p><?= Yii::$app->name ?></p>
</div>
