<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\newborn\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ผู้ใช้งาน');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h2>ทะเบียน<?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- p>
        <?php //echo  Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p -->
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'prov',
            'hcode',
        //    'id',
        //    'employee_no',
            'username',
            [
                'label'=>'ชื่อ',
                'attribute'=>'fname',
                'value'=> function($model){
                    return $model->prename.$model->fname.' '.$model->lname;
                }
            ],
            // 'personid',
            [
                'label'=>'ตำแหน่ง',
                'attribute'=>'position',
                'value'=>function($model){
                    return $model->position.$model->position_level;
                }
            ],
            //'position_level',
            // 'position_type',
            // 'userlevel',
            'email',
            //'email:email',
            //'tel',
            //'mobile',
            // 'password_hash',
            // 'auth_key',
            // 'confirmed_at',
            // 'unconfirmed_email:email',
            // 'blocked_at',
            // 'registration_ip',
            // 'created_at',
            // 'updated_at',
            // 'flags',
            // 'status',
            // 'lastupdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
