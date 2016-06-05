<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\ActiveForm;

$this->title = 'ข้อมูล Newborn';
$this->params['breadcrumbs'][] = ['label' => 'Newborn', 'url' => ['/newborn/data/']];
$this->params['breadcrumbs'][] = 'List';
$this->params['breadcrumbs'][] = 'ณ เวลา '.date("H:i:s");
$ButtonColor = 'success';

//Id	Sp	Sp Name	Hospcode	Hn	Prename	Fname	Mname	Lname	Cid	Dob	Sex	Dead	Mother Cid	Mother Name	Father Cid	Father Name	Nation	Address	Moo	Soi	Road	Ban	Addcode	Zip	Tel	Mobile	Moi Checked	Serviced	Remark	Inp Id	Lastupdate
$Columns = [
    [
        'label'=>'จังหวัด',
        'attribute'=>'prov',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:center;'],
    ] ,
    [
        'label'=>'HN',
        'attribute'=>'hn',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:center;'],
    ] ,
    [
        'label'=>'บัตรประชาชน',
        'attribute'=>'cid',
        'headerOptions' => ['style'=>'text-align:center'],
    ] ,
    [
        'label'=>'ชื่อ',
        'attribute'=>'name',
        'value'=>function($data){
            return $data["prename"].$data["fname"].' '.$data["lname"];
        },
        'headerOptions' => ['style'=>'text-align:center'],
    ],
    [
        'label'=>'เพศ',
        'value'=>function($data){
            return $data["sex"]==1? 'ชาย':($data["sex"]==2? 'หญิง':'');
        },
        'headerOptions' => ['style'=>'text-align:center'],
    ],
    [
        'label'=>'วันเกิด',
        'headerOptions' => ['style'=>'text-align:center; color:#0130f7 '],
        'contentOptions' => ['style'=>'text-align:center; color:#0130f7'],
        'value'=>function($data){
            return substr($data["dob"],8,2).'/'.Yii::$app->params["thMonthAbbr"][substr($data["dob"],5,2)+0]
                .'/'.(substr($data["dob"],0,4)+543-2500);
        }
    ],
    [
        'label'=>'มารดา',
        'attribute'=>'mother_name',
        'headerOptions' => ['style'=>'text-align:center'],
    ] ,
    [
        'label'=>'บิดา',
        'attribute'=>'father_name',
        'headerOptions' => ['style'=>'text-align:center'],
    ] ,
    [
        'label'=>'',
        'format'=>'raw',
        'value'=>function($data){
            return Html::a('รายละเอียด',['/newborn/data/detail','id'=>$data["id"]],['class'=>'btn btn-warning btn-xs'] );
        },
    ] ,

] ;

$SearchType = isset($_POST[searchtype])? $_POST[searchtype]:'hn';
$SearchText = isset($_POST[searchtext])? $_POST[searchtext]:'';

$form = ActiveForm::begin([
    'method'=>'post',
    'type' => ActiveForm::TYPE_VERTICAL
    ]);

echo GridView::widget([
    'dataProvider'=> $dataProvider,
    'export' => false,
    'containerOptions' => ['style'=>'overflow: auto'],
    'panel' => [
        'heading'=>'<h2 class="panel-title"><i class="glyphicon glyphicon-user"></i> '.$this->title.' '.$rawData[0]["hname"].'</h2>',
        'type' => GridView::TYPE_DEFAULT,
        'before'=>'<select name="searchtype"><option value="hn"'.($SearchType=='hn'? ' selected':'')
                    . '>HN</option><option value="fname"'.($SearchType=='fname'? ' selected':'').'>ชื่อ</option>'
                    . '<option value="lname"'.($SearchType=='lname'? ' selected':'').
                    ' >สกุล</option><option value="cid"'.($SearchType=='cid'? ' selected':'').'>บัตรประชาชน &nbsp;  &nbsp; </option>'
                    . '</select>&nbsp; &nbsp; '
                    . '<input type="text" name="searchtext" value="'.$SearchText.'">&nbsp; &nbsp; '
                    . '<button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>',
    ],
    'toolbar'=> [
        ['content'=>
            Html::a('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> &nbsp; เพิ่ม ',
                    ['/newborn/data/edit','id'=>0],['class'=>'btn btn-warning btn-sm']).
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>1, 'class'=>'btn btn-primary btn-sm', 'title'=>'Refresh Grid'])
        ],
        'options' => ['class' => 'btn-group-sm'],
        //'{export}',
        //'{toggleData}',
    ],
    'beforeHeader'=>[
            [
                'options'=>['class'=>'skip-export'] // remove this row from export
            ]
    ],
    'headerRowOptions'=>['class'=>'default'],
    'responsive'=>false,
//    'condensed' => false,
//    'striped' => false,
//    'floatHeader' => true,
    'hover'=>true,
    'pjax'=>true,
    'columns'=>$Columns,
]);

ActiveForm::end();
