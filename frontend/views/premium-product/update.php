<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PremiumProduct */

$this->title = 'Update Premium Product: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Premium Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="premium-product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>