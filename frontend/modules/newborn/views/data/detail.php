<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\tabs\TabsX;

$this->title = 'ประวัติ Newborn';
$this->params['breadcrumbs'][] = ['label' => 'Newborn', 'url' => ['/newborn/data/']];
$this->params['breadcrumbs'][] = 'Detail';
$this->params['breadcrumbs'][] = $id;
$ButtonColor = 'success';

//echo DetailView::widget([
//    'dataProvider'=>$dataProvider,
//]);

$Color = 'success';
$Headwidth = '90';
$PersonalData = '<h5>ข้อมูลทั่วไป '.Html::a('<i class="glyphicon glyphicon-pencil"></i> แก้ไข',['/newborn/data/edit','id'=>$row["id"]],['class'=>'btn btn-warning btn-sm'] ).'</h5>'
                    . '<table class="table table-hover table-bordered">'
                    . '<tr><td class="'.$Color.'" width="'.$Headwidth.'">Hospcode: </td><td>'.$row["hospcode"].' &nbsp;&nbsp;'.$row["hname"].'</td>'
                    .  '<td class="'.$Color.'" width="'.$Headwidth.'"> จังหวัด: </td><td><strong>'.$row["prov"].'</strong></td></tr>'
                    . '<tr><td class="success">ชื่อ: </td><td colspan="3"><h5>'.$row["prename"].$row["fname"].' '.$row["lname"].'</h5></td></tr>'
                    .  '<tr><td class="success"> เพศ: </td><td>'.($row["sex"]==1? 'ชาย':($row["sex"]==2? 'หญิง':'')).'</td>'
                    .  '<td class="success"> วันเกิด: </td><td>'.substr($row["dob"],8,2).'/'.Yii::$app->params["thMonthAbbr"][substr($row["dob"],5,2)+0]
                    . '/'.(substr($row["dob"],0,4)+543).'</td></tr>'
                    .  '<tr><td class="success"> HN: </td><td><strong>'.$row["hn"].'</strong></td>'
                    .  '<td class="success"> Person ID: </td><td><strong>'.$row["cid"].'</strong></td></tr>'
                    .  '<tr><td class="success"> มารดา: </td><td><strong>'.$row["mother_name"].'</strong></td>'
                    .  '<td class="success"> บิดา: </td><td><strong>'.$row["father_name"].'</strong></td></tr>'
                    .  '<tr><td class="success"> โทร: </td><td><strong>'.$row["tel"].'</strong></td>'
                    .  '<td class="success"> มือถือ: </td><td><strong>'.$row["mobile"].'</strong></td></tr>'
                    . '</table>';

$LrDetail = '<div>'
                    . '<h5>ข้อมูลการคลอด</h5>'
//                    . '<div class="pull-right">'.Html::a('<i class="glyphicon glyphicon-pencil"></i> แก้ไข',['/newborn/data/edit','id'=>$row["id"]],['class'=>'btn btn-warning btn-sm'] ).'</div>'
                    . '</div> ';

$ServiceData = '<div>'
                    . '<h5>ข้อมูลการรับบริการ</h5>'
//                    . '<div class="pull-right">'.Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่มข้อมูลบริการ',['/newborn/data/edit','id'=>$row["id"],'vn'=>''],['class'=>'btn btn-warning btn-sm'] )
//                    . ' '.Html::a('<i class="glyphicon glyphicon-pencil"></i> แก้ไขข้อมูลบริการ',['/newborn/data/edit','id'=>$row["id"]],['class'=>'btn btn-warning btn-sm'] ).'</div>'
                    . '</div> ';
$FUData = '<div>'
                    . '<h5>ข้อมูลการนัด</h5>'
//                    . '<div class="pull-right">'.Html::a('<i class="glyphicon glyphicon-pencil"></i> แก้ไข',['/newborn/data/edit','id'=>$row["id"]],['class'=>'btn btn-warning btn-sm'] ).'</div>'
                    . '</div> ';
$OtherService = '<div>'
                    . '<h5>ข้อมูลการรับบริการจากสถานพยาบาลอื่น</h5>'
//                    . '<div class="pull-right">'.Html::a('<i class="glyphicon glyphicon-pencil"></i> แก้ไข',['/newborn/data/edit','id'=>$row["id"]],['class'=>'btn btn-warning btn-sm'] ).'</div>'
                    . '</div> ';

$items = [
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> ข้อมูลทั่วไป',
        'content'=>$PersonalData,
        'active'=>true
    ],
/*    [
        'label'=>'<i class="glyphicon glyphicon-file"></i> รายละเอียดการคลอด',
        'content'=>$LrDetail,
    ],*/
    [
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> ข้อมูลการรับบริการ',
        'content'=>$ServiceData,
    //    'linkOptions'=>['data-url'=>\yii\helpers\Url::to(['/newborn/data/edit','id'=>$id])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-calendar"></i> ข้อมูลการนัด',
        'content'=>$FUData,
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-link"></i> ข้อมูลจากสถานพยาบาลอื่น',
        'content'=>$OtherService,
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-camera"></i> ภาพ/เอกสาร',
        'content'=>$OtherService,
    ],
];

echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);
