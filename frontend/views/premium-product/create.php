<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PremiumProduct */

$this->title = 'Create Premium Product';
$this->params['breadcrumbs'][] = ['label' => 'Premium Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premium-product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
