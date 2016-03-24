<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Achievement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="achievement-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'flavor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'stats')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'incrementable1')->textInput() ?>

    <?= $form->field($model, 'incrementable2')->textInput() ?>

    <?= $form->field($model, 'incrementable3')->textInput() ?>

    <?= $form->field($model, 'value1')->textInput() ?>

    <?= $form->field($model, 'value2')->textInput() ?>

    <?= $form->field($model, 'value3')->textInput() ?>

    <?= $form->field($model, 'usesPercentage')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
