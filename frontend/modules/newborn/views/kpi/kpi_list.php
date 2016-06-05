<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;

$this->title = 'KPI Item';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = date("Y-m-d H:i");

$Colors = ["#6375F9","#FF6310",'#91984e','#61ff3e','#f13831'];

// Generate a bootstrap responsive striped table with row highlighted on hover
//	Detail	Period	Type Input	Multiplicand	Multiplicand Desc	Denominator	Denominator Desc	Decimal	Target	Pcu	Hosp F	Hosp M1	Hosp M2	Hosp S	Hosp A	Hosp O	Inp Id	Remark	Lastupdate

$Columns = [
/*    [
        'label'=>'#',
        'format' =>'raw',
        'value'=>function($data){
            return Html::a('<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>',["/newborn/kpi/input","id"=>$data["kpi_id"]],["class"=>"btn btn-xs"] );
        },
    ],
    [
        'label'=>'รหัส',
        'value'=>'kpi_id',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:center;'],
    ],*/
/*    [
        'label'=>'หมวด',
        'value'=>'kpi_subgroup',
        'headerOptions' => ['style'=>'text-align:center'],
        'group'=>true,
    ],*/
    [
        'label'=>'หัวข้อ',
        'format' => 'raw',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:left;'],
        'value'=>function($data){
            return $data["kpi_name"].'<br><small> หมวด: '.$data["kpi_subgroup"].'</small>';
        }
    ],
    [
        'label'=>'Unit',
        'value'=>'unit',
        'headerOptions' => ['style'=>'text-align:center'],
    ],
    [
        'label'=>'เป้าหมาย',
        'value'=>'target',
        'headerOptions' => ['style'=>'text-align:center'],
    ],
    [
        'label'=>'เขต',
        'format' => ['decimal',2],
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:right;'],
        'value'=>function($data){
            return 0;
        }
    ],
    [
        'label'=>'ขก',
        'format' => 'raw',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:right;'],
        'value'=>function($data){
            return Html::a(number_format(0.00,2),['/newborn/kpi/prov','id'=>$data["kpi_id"],'prov'=>'40' ] );
        }
    ],
    [
        'label'=>'มค',
        'format' => 'raw',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:right;'],
        'value'=>function($data){
            return Html::a(number_format(0.00,2),['/newborn/kpi/prov','id'=>$data["kpi_id"],'prov'=>'44' ] );
        }
    ],
    [
        'label'=>'รอ',
        'format' => 'raw',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:right;'],
        'value'=>function($data){
            return Html::a(number_format(0.00,2),['/newborn/kpi/prov','id'=>$data["kpi_id"],'prov'=>'45' ] );
        }
    ],
    [
        'label'=>'กส',
        'format' => 'raw',
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:right;'],
        'value'=>function($data){
            return Html::a(number_format(0.00,2),['/newborn/kpi/prov','id'=>$data["kpi_id"],'prov'=>'46' ] );
        }
    ],
/*    [
        'label'=>'ตัวตั้ง',
        'value'=>'multiplicand_desc',
        'headerOptions' => ['style'=>'text-align:center'],
    ],
    [
        'label'=>'ตัวหาร',
        'value'=>'denominator_desc',
        'headerOptions' => ['style'=>'text-align:center'],
    ],
    [
        'label'=>'ตัวคูณ',
        'value'=>'multiplier',
        'format' => ['decimal',0],
        'headerOptions' => ['style'=>'text-align:center'],
        'contentOptions' => ['style'=>'text-align:right; color:#23509e '],
    ],*/
];
    echo GridView::widget([
        'dataProvider'=> $dataProvider,
        'export' => false,
        'containerOptions' => ['style'=>'overflow: auto'],
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-file"></i>'.$this->title.'</h3>',
            'type' => GridView::TYPE_PRIMARY
        ],
        'beforeHeader'=>[
                [
                    'columns'=>[
                        ['content'=>'รายละเอียด', 'options'=>['colspan'=>3, 'class'=>'text-center primary']],
                        ['content'=>'ผลการดำเนินงาน', 'options'=>['colspan'=>5, 'class'=>'text-center primary']],
                    ],
                    'options'=>['class'=>'skip-export'] // remove this row from export
                ]
        ],
        'toolbar' =>  [
            '{export}',
            '{toggleData}'
        ],
        'headerRowOptions'=>['class'=>'success'],
        'responsive'=>true,
        'condensed' => false,
        'striped' => false,
        'floatHeader' => true,
        //'floatHeaderOptions' => ['scrollingTop' => 50],
        'hover'=>true,
        'pjax'=>true,
        'columns'=>$Columns,
    ]);


    ?>
