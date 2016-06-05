<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\newborn\models\Patient */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Patients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'hospcode',
            'hn',
            'prename',
            'fname',
            'mname',
            'lname',
            'cid',
            'dob',
            'sex',
            'dead',
            'mother_cid',
            'mother_name',
            'father_cid',
            'father_name',
            'nation',
            'address',
            'moo',
            'soi',
            'road',
            'ban',
            'addcode',
            'zip',
            'tel',
            'mobile',
            'moi_checked',
            'serviced',
            'remark:ntext',
            'inp_id',
            'lastupdate',
        ],
    ]) ?>

</div>
