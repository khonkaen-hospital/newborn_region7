<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\newborn\models\PatientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Patients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="patient-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Patient'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hospcode',
            'hn',
            'prename',
            'fname',
            // 'mname',
            // 'lname',
            // 'cid',
            // 'dob',
            // 'sex',
            // 'dead',
            // 'mother_cid',
            // 'mother_name',
            // 'father_cid',
            // 'father_name',
            // 'nation',
            // 'address',
            // 'moo',
            // 'soi',
            // 'road',
            // 'ban',
            // 'addcode',
            // 'zip',
            // 'tel',
            // 'mobile',
            // 'moi_checked',
            // 'serviced',
            // 'remark:ntext',
            // 'inp_id',
            // 'lastupdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
