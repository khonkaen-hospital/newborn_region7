<?php
use yii\helpers\Html;
use kartik\grid\GridView;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\HighchartsAsset;
HighchartsAsset::register($this)->withScripts(['highcharts-more','themes/grid']);

$Colors = ["#ef2234","#e49d12",'#91984e','#1daf34','#00ff00'];
$Grp = [
    '40'=>['name'=>'ขอนแก่น','rate'=>53.9],
    '44'=>['name'=>'มหาสารคาม','rate'=>86.9],
    '45'=>['name'=>'ร้อยเอ็ด','rate'=>61.9],
    '46'=>['name'=>'กาฬสินธุ์','rate'=>21.9],
    'r7'=>['name'=>'เขต 7','rate'=>58.1],
];
$nMonth = [10,11,12,1,2,3,4,5,6,7,8,9];

$this->title = 'KPI ID:'.$id;
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/newborn/kpi/list','year'=>$year]];
$this->params['breadcrumbs'][] = 'จ.'.$Grp["$prov"]["name"];
$this->params['breadcrumbs'][] = 'ปีงบ '.$year;

?>
<div class="panel panel-primary">
    <div class="panel-heading">KPI: <?=$rawData["kpi_name"].' จังหวัด '.$Grp["$prov"]["name"]?>
    </div>
    <div class="panel-body">
        <blockquote>
            <h3 class="alert alert-warning">KPI: <strong><?=$rawData["kpi_name"]?></strong></h3>
            <p>หมวด: <strong><?=$rawData["kpi_subgroup"]?></strong></p>
            <p><small>หน่วย: <?=$rawData["unit"]?></small></p>
            <p><small>ตัวตั้ง: <?=$rawData["multiplicand_desc"]?></small></p>
            <p><small>ตัวหาร: <?=$rawData["denominator_desc"]?></small></p>
        </blockquote>
        <hr />
        <div class="row">
            <div class="col-md-2">
                <div id="container40" style="min-width: 100%; height: 170px; max-width: 600px; margin: 0 auto"></div>
            </div>
            <div class="col-md-2">
                <div id="container44" style="min-width: 100%; height: 170px; max-width: 600px; margin: 0 auto"></div>
            </div>
            <div class="col-md-2">
                <div id="container45" style="min-width: 100%; height: 170px; max-width: 600px; margin: 0 auto"></div>
            </div>
            <div class="col-md-2">
                <div id="container46" style="min-width: 100%; height: 170px; max-width: 600px; margin: 0 auto"></div>
            </div>
            <div class="col-md-2">
                <div id="containerr7" style="min-width: 100%; height: 170px; max-width: 600px; margin: 0 auto"></div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr align="center" class="info">
                            <td>HCode</td>
                            <td>HName</td>
                            <td>HType</td>
                            <?php
                            foreach ($nMonth as $Month) {?>
                                <td><?=Yii::$app->params["thMonthAbbr"][$Month]?></td>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                foreach ($hospitals as $hospital) {
                    $Rate = rand(40,99);
                ?>
                    <tr align="right">
                        <td  align="center"><?=$hospital["off_id"]?></td>
                        <td align="left"><?=$hospital["name"]?></td>
                        <td align="center"><?=$hospital["typecode"]?></td>
                        <?php
                        foreach ($nMonth as $Month) {
                            $Url = '/newborn/kpi/edit';
                            $Rate = rand(10,89);
                            $Color =$Rate<25? $Colors[0]:$Colors[1] ;
                            $Color =$Rate>60? $Colors[2]:$Color ;
                            $Color =$Rate>80? $Colors[3]:$Color ;
                        ?>
                            <td bgcolor="<?=$Color?>"><font color="white">
                                <?=Html::a(number_format($Rate,2),[$Url,'id'=>$id,'prov'=>$prov,'year'=>$year,'hcode'=>$hospital["off_id"]])?>
                                </font></td>
                        <?php
                         } ?>
                    </tr>
                <?php } ?>
                </tbody>
                </table>

                <?php
                    //echo GridView::widget([
                    //    'dataProvider'=> $dataProvider,
                    //]);
                ?>
            </div>
        </div>

    </div>
</div>



<?php
foreach ($Grp as $prov => $value) {
    $Rate1 = $value["rate"];
    $Rate2 = 100-$value["rate"];
    $ProvName = $value["name"];
    $Color =$Rate1<25? $Colors[0]:$Colors[1] ;
    $Color =$Rate1>60? $Colors[2]:$Color ;
    $Color =$Rate1>80? $Colors[3]:$Color ;
    $this->registerJs("
    $(function () {
        $('#container$prov').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: '<br>$ProvName',
                align: 'center',
                verticalAlign: 'middle',
                y: 40
            },
            tooltip: {
                pointFormat: '<b>{point.percentage:.1f}%</b>'
            },
            credits: {
                enabled: false
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white',
                            textShadow: '0px 1px 2px black'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%']
                }
            },
            series: [{
                type: 'pie',
                name: 'ผลการดำเนินงาน',
                innerSize: '50%',
                data: [
                    {
                        name: 'ผลงาน',
                        y: $Rate1,
                        color:'$Color',
                        dataLabels: {
                            enabled: false
                        }
                    },
                    {
                        name: '',
                        y: $Rate2,
                        color:'#efefef',
                        dataLabels: {
                            enabled: false
                        }
                    }
                ]
            }]
        });
    });

    ");
}
?>
