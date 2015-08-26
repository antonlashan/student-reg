<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserCategory */

$this->title = 'Update User Category: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'User Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
