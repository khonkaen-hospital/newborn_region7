<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\newborn\models\User */

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger text-center"><h3><strong>
        กรุณาใช้ module <?=Html::a('Resgister',['/user/register'])?> เพื่อเพิ่ม user ใหม่
        <br /><br /><h4>(หากมีการ Login เข้าสู่ระบบแล้ว ท่านต้อง Logout ออกจากระบบก่อนการเพิ่ม)</h4>
    </strong></h3></div>
    <?php /* $this->render('_form', [
        'model' => $model,
    ]) */ ?>

</div>
