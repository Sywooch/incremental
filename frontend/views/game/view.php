<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Game */

$this->title = User::findOne($model->user)->username;
$this->params['breadcrumbs'][] = ['label' => 'Games', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$model->updatePoints();

//$model->purchasePremiumPackage(1);
$success = $model->purchasePremiumProduct(1);
if($success)
    echo "-=-=-SUCCESS";
else
    echo "=-=-=FAILURE";
?>
<div class="game-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?= $this->render('/widgets/counter/_mainCounter', [
        'game' => $model,
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user',
            'created_at',
            'updated_at',
            'points',
            'lastIncrease',
        ],
    ]) ?>
    
</div>
