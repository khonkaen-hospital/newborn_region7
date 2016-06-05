<?php
use yii\helpers\Html;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'KPI Item';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/newborn/kpi/']];
$this->params['breadcrumbs'][] = ['label' => 'KPI ID:'.$id, 'url' => ['/newborn/kpi/prov','id'=>$id,'prov'=>$prov,'year'=>$year]];
$this->params['breadcrumbs'][] = $UserHCode;

///newborn/kpi/prov?id=32&prov=40
$Grp = [
    '40'=>['name'=>'ขอนแก่น','rate'=>53.9],
    '44'=>['name'=>'มหาสารคาม','rate'=>86.9],
    '45'=>['name'=>'ร้อยเอ็ด','rate'=>61.9],
    '46'=>['name'=>'กาฬสินธุ์','rate'=>21.9],
    'r7'=>['name'=>'เขต 7','rate'=>58.1],
];
$nMonths = [10,11,12,1,2,3,4,5,6,7,8,9];

if (isset($_POST["formInput"])){
    echo '<pre>';
    print_r($_POST["formInput"]);
    echo '</pre>';
}

?>

<blockquote>
    <?=$hospName["name"]?> จังหวัด <?=$Grp["$prov"]["name"]?>
    <h3 class="alert alert-warning">KPI: <strong><?=$Kpi["kpi_name"]?></strong></h3>
    <p>หมวด: <strong><?=$Kpi["kpi_subgroup"]?></strong></p>
    <p><small>หน่วย: <?=$Kpi["unit"]?></small></p>
    <!--p><small>ตัวตั้ง: <?=$Kpi["multiplicand_desc"]?></small></p>
    <p><small>ตัวหาร: <?=$Kpi["denominator_desc"]?></small></p-->
</blockquote>

<table class="table table-bordered table-hover">
    <thead>
        <tr align="center" class="info">
            <td>#</td>
            <td>เดือน</td>
            <td>ตัวตั้ง<br><?=$Kpi["multiplicand_desc"]?></td>
            <td>ตัวหาร<br><?=$Kpi["denominator_desc"]?></td>
            <td>อัตรา</td>
            <td>หน่วย</td>
        </tr>
    </thead>
    <tbody>
<?php
$form = ActiveForm::begin([
//	'action'=>'?r=newborn/kpi/editt',
    'method'=>'post',
    'type' => ActiveForm::TYPE_VERTICAL
    ]);
$Maxmonth = -1;
foreach ($nMonths as $key=>$nMonth) {
    $nYear = $year- ($nMonth>9? 544:543) ;
    $date = date("Y-m-d" , mktime(0,0,0,$nMonth,16, $nYear));
?>
    <tr align="center">
        <td><?=$key+1?></td>
        <td align="left"><?=Yii::$app->params["thMonth"][$nMonth].' '.($nMonth>9? ($year-1):$year)?></td>
        <?php if ($date>date("Y-m-d")){
            echo '<td></td><td></td><td></td>';
        } else {
            $Maxmonth = $key;
        ?>
        <td><input type="number" name="formInput[multiplicand<?=$nMonth?>]" value="0"></td>
        <td><input type="number" name="formInput[denominator<?=$nMonth?>]" value="0"></td>
        <td><input type="number" name="formInput[rate<?=$nMonth?>]" readonly></td>
        <?php } ?>
        <td><?=$Kpi["unit"]?></td>
    </tr>
<?php }
 ?>
 <tr align="center">
     <td colspan="2" align="center">รวม</td>
     <td><input type="number" name="d2" readonly></td>
     <td><input type="number" name="d2" readonly></td>
     <td><input type="number" name="d2" readonly></td>
     <td></td>
</tr>
</tbody>
</table>
<input type="hidden" name="formInput[maxmonth]" value="<?=$Maxmonth?>">
<p class="pull-right"><button type="submit" class="btn-success">บันทึก</button></p>
<?php ActiveForm::end(); ?>
