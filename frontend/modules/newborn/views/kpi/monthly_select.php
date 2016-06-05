<?php
use yii\helpers\Html;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'HDC Report';
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['/report/hdc/']];
$this->params['breadcrumbs'][] = date("Y-m-d H:i");

$Action = ($_GET["reportid"]=='Sepsis')? 'diagnosisipd':'procedureipd';
$Action = ($_GET["reportid"]=='None Displaced Fracture')? 'diagnosisopd':$Action;

?>
<h3 class="text-success">Report: <?=$_GET["reportid"];?></h3>
<hr>

<?php
$form = ActiveForm::begin(["action"=>"/report/hdc/".$Action."?reportid=".$_GET["reportid"]]);
echo '<label class="cbx-label" for="kk">ข้อมูลจาก HDC จ. </label>&nbsp;';
echo CheckboxX::widget([
    'name'=>'FormInput[kk]',
    'options'=>['id'=>'kk'],
    'value'=>1,
    'pluginOptions'=>['threeState'=>false]
]);
echo '<label class="cbx-label" for="kk">ขอนแก่น</label> &nbsp; ';

echo CheckboxX::widget([
    'name'=>'FormInput[rt]',
    'options'=>['id'=>'rt'],
    'value'=>0,
    'pluginOptions'=>['threeState'=>false]
]);
echo '<label class="cbx-label" for="rt">ร้อยเอ็ด</label>&nbsp; &nbsp; ';

echo CheckboxX::widget([
    'name'=>'FormInput[ks]',
    'options'=>['id'=>'ks'],
    'value'=>0,
    'pluginOptions'=>['threeState'=>false]
]);
echo '<label class="cbx-label" for="ks">กาฬสินธ์</label>&nbsp; &nbsp; ';

echo CheckboxX::widget([
    'name'=>'FormInput[mk]',
    'options'=>['id'=>'mk'],
    'value'=>0,
    'disabled'=>1,
    'pluginOptions'=>['threeState'=>false]
]);
echo '<label class="cbx-label" for="mk">มหาสารคาม</label>&nbsp; &nbsp; ';

?>
<div class="row">
    <div class="col-md-3">
        <label class="label" for="FormInput[date1]">Start Date </label>
        <input type="date" name="FormInput[date1]" class="form-control" value="2015-10-01">
    </div>
    <div class="col-md-3">
        <label class="label" for="FormInput[date2]">to </label>
        <input type="date" name="FormInput[date2]" class="form-control" value="2016-03-31">
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12 text-center">
        <button class="btn btn-info"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span> Process</button>
        <a href="/report/hdc" class="btn btn-danger"><span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Back</a>
    </div>
</div>
<input type='hidden' name='FormInput[reportid]' value='<?=$_GET["reportid"];?>'>

<?php
ActiveForm::end();
?>
