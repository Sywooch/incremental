<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Premium Packages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premium-package-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Premium Package', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'image',
            'premiumGained',
            // 'costReal',
            // 'costPoints',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
