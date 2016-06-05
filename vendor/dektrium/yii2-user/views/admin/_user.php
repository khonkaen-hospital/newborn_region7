<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

/**
 * @var yii\widgets\ActiveForm 		$form
 * @var dektrium\user\models\User 	$user
 */
?>

<?php
/*    echo $form->field($user, 'email')->textInput(['maxlength' => 255]);
    echo $form->field($user, 'username')->textInput(['maxlength' => 255]);
    echo $form->field($user, 'password')->passwordInput();
*/
$Prov = ["40"=>"ขอนแก่น","44"=>"มหาสารคาม","45"=>"ร้อยเอ็ด","46"=>"กาฬสินธุ์","R7"=>"เขต 7"]
?>

<div class="row">
    <div class="col-md-4">
        <?= $form->field($user, 'prov')->dropDownList($Prov) ?>
    </div>
    <div class="col-md-8">
        <?= $form->field($user, 'hcode')->dropDownList($hospName) ?>
        <?php exit ?>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($user, 'password')->passwordInput(['placeholder'=>'กรณีต้องการเปลี่ยน']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <?= $form->field($user, 'prename') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($user, 'fname') ?>
    </div>
    <div class="col-md-4">
        <?= $form->field($user, 'lname') ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($user, 'position')->textInput(['placeholder'=>'เช่น เจ้าพนักงานเวชสถิติ, นักวิชาการ...']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($user, 'position_level')->textInput(['placeholder'=>'เช่น ชำนาญการ, ปฏิบัติงาน,..']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($user, 'position_type')->dropDownList($posType) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($user, 'personid')->textInput(['placeholder'=>'ระบุเลขที่บัตรประชาชน']) ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <?= $form->field($user, 'tel')->textInput(['placeholder'=>'ระบุเลขหมายที่ทำงาน หรือ ที่ติดต่อได้']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($user, 'mobile') ?>
    </div>
</div>
