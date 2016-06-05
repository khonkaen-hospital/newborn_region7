<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'username') ?>
                    </div>
                    <div class="col-md-6">
                        <?php if ($module->enableGeneratingPassword == false): ?>
                            <?= $form->field($model, 'password')->passwordInput() ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'prov')->dropDownList(Yii::$app->params["provinceName"]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'hcode')->textInput(['placeholder'=>'เช่น 10670'])  ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'email') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <?= $form->field($model, 'prename') ?>
                    </div>
                    <div class="col-md-5">
                        <?= $form->field($model, 'fname') ?>
                    </div>
                    <div class="col-md-5">
                        <?= $form->field($model, 'lname') ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'position')->textInput(['placeholder'=>'เจ้าพนักงานเวชสถิติ, นักวิชาการ...']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'position_level')->textInput(['placeholder'=>'ชำนาญการ, ปฏิบัติงาน,..']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'position_type')->dropDownList($PositionTypes) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'personid')->textInput(['placeholder'=>'เลขที่บัตรประชาชน']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'tel')->textInput(['placeholder'=>'ที่ทำงาน หรือ ที่ติดต่อได้']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'mobile') ?>
                    </div>
                </div>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>
