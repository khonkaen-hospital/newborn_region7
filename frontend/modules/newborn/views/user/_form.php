<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\newborn\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-warning">
    <div class="panel-heading"><?=$this->title?></div>
    <div class="panel-body">
<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class-"row">
        <div class="col-md-1">
            <?= $form->field($model, 'prov')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'hcode')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'personid')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class-"row">
        <div class="col-md-3">
            <?= $form->field($model, 'prename')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class-"row">
        <div class="col-md-3">
            <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'position_level')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'position_type')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'userlevel')->textInput() ?>
        </div>
    </div>
    <div class-"row">
        <div class="col-md-6">
            <?= $form->field($model, 'tel')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class-"row">
        <div class="col-md-2">
            <label for="confirmed_at">confirmed</label>
            <input type="datetime" name="confirmed_at" class="form-control" value="<?=date("Y-m-d",$model->confirmed_at)?>" readonly>
        </div>
        <div class="col-md-2">
            <label for="blocked_at">blocked</label>
            <input type="text" name="blocked_at" class="form-control" value="<?=date("Y-m-d",$model->blocked_at)?>" readonly>
        </div>
        <div class="col-md-2">
            <label for="created_at">created</label>
            <input type="text" name="lastupdate" class="form-control" value="<?=date("Y-m-d",$model->created_at)?>" readonly>
        </div>
        <div class="col-md-2">
            <label for="updated_at">updated</label>
            <input type="text" name="updated_at" class="form-control" value="<?=date("Y-m-d",$model->updated_at)?>" readonly>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'unconfirmed_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class-"row">
        <div class="col-md-3">
            <?= $form->field($model, 'registration_ip')->textInput(['maxlength' => true,'readonly'=>true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'flags')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
        <div class="col-md-3">
            <label for="lastupdate">LastUpdate</label>
            <input type="text" name="lastupdate" class="form-control" value="<?=$model->lastupdate?>" readonly>
        </div>
        <div class="col-md-2">
            <br />
            <div class="form-group pull-right">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
