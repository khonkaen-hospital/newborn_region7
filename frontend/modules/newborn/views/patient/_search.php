<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\newborn\models\PatientSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hospcode') ?>

    <?= $form->field($model, 'hn') ?>

    <?= $form->field($model, 'prename') ?>

    <?= $form->field($model, 'fname') ?>

    <?php // echo $form->field($model, 'mname') ?>

    <?php // echo $form->field($model, 'lname') ?>

    <?php // echo $form->field($model, 'cid') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'sex') ?>

    <?php // echo $form->field($model, 'dead') ?>

    <?php // echo $form->field($model, 'mother_cid') ?>

    <?php // echo $form->field($model, 'mother_name') ?>

    <?php // echo $form->field($model, 'father_cid') ?>

    <?php // echo $form->field($model, 'father_name') ?>

    <?php // echo $form->field($model, 'nation') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'moo') ?>

    <?php // echo $form->field($model, 'soi') ?>

    <?php // echo $form->field($model, 'road') ?>

    <?php // echo $form->field($model, 'ban') ?>

    <?php // echo $form->field($model, 'addcode') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'tel') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'moi_checked') ?>

    <?php // echo $form->field($model, 'serviced') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'inp_id') ?>

    <?php // echo $form->field($model, 'lastupdate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
