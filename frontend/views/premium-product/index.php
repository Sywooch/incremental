<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Premium Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="premium-product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Premium Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'image',
            'costPremium',
            // 'pointsGained',
            // 'efficiencyGained',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
