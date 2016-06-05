<?php
use yii\helpers\Html;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;
use yii\widgets\MaskedInput;

$this->title = 'ประวัติ Newborn';
$this->params['breadcrumbs'][] = ['label' => 'Newborn', 'url' => ['/newborn/data']];
$this->params['breadcrumbs'][] = ['label' => 'Detail', 'url' => ['/newborn/data/detail','id'=>$id]];
$this->params['breadcrumbs'][] = 'Edit';
$this->params['breadcrumbs'][] = $id;
$ButtonColor = 'success';

//$FormName = "inputNewborn".rand(1100000,9909999);
$FormName = 'formInput';
$form = ActiveForm::begin([
    'method'=>'post',
    'type' => ActiveForm::TYPE_VERTICAL
    ]);

$Prov = substr($row["addcode"],0,2);
$Amp = substr($row["addcode"],2,2);
$Tambon = substr($row["addcode"],4,2);
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <?=$id==0? 'เพิ่ม':'แก้ไข'?><?=$this->title?>
    </div>
    <div class="panel-body">
<?php
if (isset($_POST) && isset($_POST["id"])){
    echo '<p class="alert alert-warning">'
        .Html::a('<span class="glyphicon glyphicon-circle-arrow-left" aria-hidden="true"></span> Back',
            ['/newborn/data/detail','id'=>$id],['class'=>'btn btn-success btn-md'])
        .' &nbsp; บันทึกเรียบร้อย</p>';
}

?>
<input type="hidden" name="id" value="<?=$id?>">
<input type="hidden" name="inputName" value="<?=$FormName?>">

        <div class="row">
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'hospcode','type'=>'text','label'=>'HCode','value'=>$row[hcode],'options'=>['readonly'=>true]])?>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'prov','type'=>'text','label'=>'จ.','value'=>$row[prov],'options'=>['readonly'=>true]])?>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'an','label'=>'AN','options'=>['onchange'=>'"CheckAN(this.value)"',]])?>
            <div class="col-md-4">
                <label for="formInput-cid">เลขที่บัตรประชาชน</label><br>
            <?=MaskedInput::widget([
                'name' => 'formInput[cid]',
                'id' => 'formInput-cid',
                'mask' => '9-9999-99999-99-9',
                'value'=>$row["cid"],
                'options'=>[
                    'class'=>'form-control',
                    'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                    'required'=>true,
                    'onchange'=>'CheckCID(this.value)',
                ]
            ]); ?>
            </div>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'hn','type'=>'text','label'=>'HN','value'=>$row[hn],'options'=>['placeholder'=>'ระบุ HN','required'=>true]])?>
            <?php //myInputRender($FormName,$row,['col'=>4,'name'=>'cid','type'=>'text','label'=>'CID','value'=>$row[cid],'options'=>['placeholder'=>'ระบุเลขที่บัตรประชาชน','required'=>true]])?>
        </div>
        <div class="row">
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'prename','type'=>'text','label'=>'คำนำหน้า','options'=>['placeholder'=>'ระบุคำนำหน้า']])?>
            <?=myInputRender($FormName,$row,['col'=>3,'name'=>'fname','type'=>'text','label'=>'ชื่อ','options'=>['placeholder'=>'ระบุชื่อ','required'=>true]])?>
            <?=myInputRender($FormName,$row,['col'=>3,'name'=>'lname','type'=>'text','label'=>'สกุล','options'=>['placeholder'=>'ระบุสกุล','required'=>true]])?>
            <?=myInputRender($FormName,$row,['col'=>1,'name'=>'sex','type'=>'select','label'=>'เพศ','items'=>[1=>'ชาย',2=>'หญิง']])?>
            <?=myInputRender($FormName,$row,['col'=>3,'name'=>'dob','type'=>'date','label'=>'วันเกิด'])?>
        </div>
        <h5 class="text-primary">ที่อยู่</h5>
        <div class="row">
            <?=myInputRender($FormName,$row,['col'=>1,'name'=>'address','type'=>'text','label'=>'บ้านเลขที่'])?>
            <?=myInputRender($FormName,$row,['col'=>1,'name'=>'moo','type'=>'text','label'=>'หมู่'])?>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'soi','type'=>'text','label'=>'ชื่อซอย'])?>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'road','type'=>'text','label'=>'ชื่อถนน'])?>
            <?php //=myInputRender($FormName,$row,['col'=>2,'name'=>'prov','type'=>'select','label'=>'จ.','items'=>$ProvCode])?>
            <div class="col-md-2">
                <label for="formInput-prov">จ.</label><br>
                <select name="formInput-prov" id="formInput-prov" class="form-control">
                    <?php
                    foreach ($ProvCode as $key => $value) {
                        echo '<option value="'.$key.'"'.($key==substr($row["addcode"],0,2)? ' selected':'').'>'.$value.' ('.$key.')</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="formInput-amp">อ.</label><br>
                <select name="formInput-amp" id="formInput-amp" class="form-control">
                    <?php
                    foreach ($AmpCode as $key => $value) {
                        echo '<option value="'.$key.'"'.($key==substr($row["addcode"],2,2)? ' selected':'').'>'.$value.' ('.$key.')</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <label for="formInput-tam">ต.</label><br>
                <select name="formInput-tam" id="formInput-tam" class="form-control">
                    <?php
                    foreach ($TamCode as $key => $value) {
                        echo '<option value="'.$key.'"'.($key==substr($row["addcode"],4,2)? ' selected':'').'>'.$value.' ('.$key.')</option>';
                    }
                    ?>
                </select>
            </div>

            <?php //=myInputRender($FormName,$row,['col'=>4,'name'=>'addcode','type'=>'text','label'=>'จังหวัด'])?>
        </div>
        <div class="row">
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'zip','type'=>'text','label'=>'รหัสไปรษณีย์'])?>
            <?php //=myInputRender($FormName,$row,['col'=>2,'name'=>'tel','type'=>'text','label'=>'โทร'])?>
            <div class="col-md-3">
                <label for="formInput-tel">โทรศัพท์</label><br>
            <?=MaskedInput::widget([
                'name' => 'formInput[tel]',
                'id' => 'formInput-tel',
                'mask' => '99-999-9999',
                'value'=>$row["tel"],
                'options'=>[
                    'class'=>'form-control',
                    'placeholder'=>'หมายเลขโทรศัพท์',
                ]
            ]); ?>
            </div>
            <?php //=myInputRender($FormName,$row,['col'=>8,'name'=>'mobile','type'=>'text','label'=>'มือถือ'])?>
            <div class="col-md-7">
                <label for="formInput-mobile">มือถือ</label><br>
            <?=MaskedInput::widget([
                'name' => 'formInput[mobile]',
                'id' => 'formInput-mobile',
                'mask' => '999-999-9999',
                'value'=>$row["mobile"],
                'options'=>[
                    'class'=>'form-control',
                    'placeholder'=>'หมายเลขโทรศัพท์มือถือ',
                ]
            ]); ?>
            </div>
        </div>
        <h5 class="text-primary">บิดา/มารดา</h5>
        <div class="row">
            <?php //=myInputRender($FormName,$row,['col'=>2,'name'=>'mother_cid','type'=>'text','label'=>'เลขที่บัตรประชาชนมารดา'])?>
            <div class="col-md-3">
                <label for="formInput-mother_cid">เลขที่บัตรประชาชนมารดา</label><br>
            <?=MaskedInput::widget([
                    'name' => 'formInput[mother_cid]',
                    'id' => 'formInput-mother_cid',
                    'mask' => '9-9999-99999-99-9',
                    'value'=>$row["mother_cid"],
                    'options'=>[
                        'class'=>'form-control',
                        'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                        'onchange'=>'GetMotherName(this.value)',
                    ]
                ]);
            ?>
            </div>
            <?=myInputRender($FormName,$row,['col'=>5,'name'=>'mother_name','type'=>'text','label'=>'ชื่อมารดา'])?>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'mother_an','type'=>'text','label'=>'AN มารดา'])?>

            <div class="col-md-2">
                <label for="formInput-mother_age">อายุมารดา (ปี)</label><br>
                <?=MaskedInput::widget([
                    'name' => 'formInput[mother_age]',
                    'id' => 'formInput-mother_age',
                    'mask' => 'i',
                    'value'=>$row["mother_age"],
                    'definitions' => ['i' => [
                       'validator' => '[0-9\(\)\.\+/ ]',
                       'cardinality' => 2,
                       'prevalidator' =>  [
                           ['validator' => '[12345]', 'cardinality' => 1],
                           ['validator' => '(11|59)', 'cardinality' => 2],
                       ]
                   ]],
                    'options'=>[
                        'class'=>'form-control',
                        //'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                    ]
                ]); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label for="formInput-father_cid">เลขที่บัตรประชาชนบิดา</label><br>
                <?=MaskedInput::widget([
                    'name' => 'formInput[father_cid]',
                    'id' => 'formInput-father_cid',
                    'mask' => '9-9999-99999-99-9',
                    'value'=>$row["father_cid"],
                    'options'=>[
                        'class'=>'form-control',
                        'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                        'onchange'=>'GetFatherName(this.value)',
                    ]
                ]); ?>
            </div>

            <?php //=myInputRender($FormName,$row,['col'=>2,'name'=>'father_cid','type'=>'text','label'=>'เลขที่บัตรประชาชนบิดา'])?>
            <?=myInputRender($FormName,$row,['col'=>5,'name'=>'father_name','type'=>'text','label'=>'ชื่อบิดา'])?>
        </div>

        <h5 class="text-primary">รายละเอียดการคลอด (ข้อมูลการมา รพ.ครั้งแรก)</h5>
        <div class="row">
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'seq','label'=>'VisitNo (SEQ)'])?>
            <div class="col-md-2">
                <label for="formInput-weight">น้ำหนัก (กรัม)</label><br>
            <?=MaskedInput::widget([
                'name' => 'formInput[weight]',
                'id' => 'formInput-weight',
                'mask' => '9999',
                'value'=>$row["weight"],
                'options'=>[
                    'class'=>'form-control',
                    //'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                ]
            ]); ?>
            </div>
            <div class="col-md-2">
                <label for="formInput-ga">GA (wks)</label><br>
            <?=MaskedInput::widget([
                'name' => 'formInput[ga]',
                'id' => 'formInput-ga',
                'mask' => 'g',
                'value'=>$row["ga"],
                'definitions' => ['g' => [
                   'validator' => '[0-9\(\)\.\+/ ]',
                   'cardinality' => 2,
                   'prevalidator' =>  [
                       ['validator' => '[1234]', 'cardinality' => 1],
                   ]
               ]],
                'options'=>[
                    'class'=>'form-control',
                    //'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                ]
            ]); ?>
            </div>
            <div class="col-md-2">
                <label for="formInput-apgar">Apgar (นาทีที่ 5)</label><br>
            <?=MaskedInput::widget([
                'name' => 'formInput[apgar]',
                'id' => 'formInput-apgar',
                'mask' => '99',
            'value'=>$row["apgar"],
                'options'=>[
                    'class'=>'form-control',
                    //'placeholder'=>'ระบุเลขที่บัตรประชาชน',
                ]
            ]); ?>
            </div>
            <?php
                $LrType = ["NL"=>'NL','CS'=>'C/S','FC'=>'forcep'] ;
            ?>
            <?=myInputRender($FormName,$row,['col'=>2,'name'=>'lr_type','type'=>'select','label'=>'ลักษณะการคลอด','items'=>$LrType])?>
        </div>
        <div class="row">
            <?php $FormName1="formPDxInput" ?>
            <?=myInputRender($FormName1, $row, ['col'=>2,'name'=>'pdx','label'=>'PDx','options'=>['placeholder'=>'โรคหลัก']])?>
            <?php $FormName1="formccDxInput" ?>
            <?=myInputRender($FormName1, $row, ['col'=>2,'name'=>'sdx1','label'=>'cc Dx1'])?>
            <?=myInputRender($FormName1, $row, ['col'=>2,'name'=>'sdx2','label'=>'cc Dx2'])?>
            <?=myInputRender($FormName1, $row, ['col'=>2,'name'=>'sdx3','label'=>'cc Dx3'])?>
            <?=myInputRender($FormName1, $row, ['col'=>2,'name'=>'sdx4','label'=>'cc Dx4'])?>
            <?=myInputRender($FormName1, $row, ['col'=>2,'name'=>'sdx5','label'=>'cc Dx5'])?>
        </div>
        <div class="row">
            <?php $FormName2="formProcInput" ?>
            <?=myInputRender($FormName2, $row, ['col'=>2,'name'=>'proc1','label'=>'Proc.1'])?>
            <?=myInputRender($FormName2, $row, ['col'=>2,'name'=>'proc2','label'=>'Proc.2'])?>
            <?=myInputRender($FormName2, $row, ['col'=>2,'name'=>'proc3','label'=>'Proc.3'])?>
            <?=myInputRender($FormName2, $row, ['col'=>2,'name'=>'proc4','label'=>'Proc.4'])?>
            <?=myInputRender($FormName2, $row, ['col'=>2,'name'=>'proc5','label'=>'Proc.5'])?>
            <?=myInputRender($FormName2, $row, ['col'=>2,'name'=>'proc6','label'=>'Proc.6'])?>
        </div>

        <div class="row">
            <div class="col-md-12"><br>
                <p class="pull-right"><button type="submit" class="btn-success"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> <?=$id==0? 'เพิ่ม':'บันทึกการแก้ไข'?></button></p>
            </div>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>

<?php
//==============================
function myInputRender($FormName,$row,$Form)
//==============================
{
    $Form["type"] = (isset($Form["type"]) && $Form["type"]!="")? $Form["type"]:'text';
    $FormName = $FormName==""? 'formInput':$FormName;
    $PrefixRender = '<div class="col-md-'.$Form["col"].'">';
    $SuffixRender = '</div>';

    $Lebel = '<label for="'.$FormName.'-'.$Form[name].'">'.$Form[label].'</label> ';
    $Options = '';
    $pValue = (isset($row[$Form[name]]) && $row[$Form[name]]!="")? $row[$Form[name]]:'';
    if (isset($Form["options"])){
        foreach ($Form["options"] as $key => $value) {
            $Options .= ' '.$key.'='.$value;
        }
    }
    switch ($Form["type"]) {
        case 'select':
            $Items = '';
            foreach ($Form["items"] as $key => $value) {
                $Items .= ' <option value="'.$key.'"'.($pValue==$key? ' selected':'').'>'.$value.'</option> ';
            }
            return $PrefixRender.$Lebel. '<select name="'.$FormName.'['.$Form[name].']" '
                . $Options
                . ' id="'.$FormName.'-'.$Form[name].'"'
                . ' class="form-control">'
                . $Items
                . ' </select>'
                . $SuffixRender ;
            break;

        default:
            return $PrefixRender.$Lebel. '<input type="'.$Form[type].'" name="'.$FormName.'['.$Form[name].']" '
                . $Options
                . (isset($Form["value"])? (' value="'.$Form["value"].'"'):($pValue==""? '':(' value="'.$pValue.'"')))
                . ' id="'.$FormName.'-'.$Form[name].'"'
                . ' class="form-control">'
                . $SuffixRender;
            break;
    }
}

?>

<script type="text/javascript">
//======================================================
    function CheckAN(lcAN)
//======================================================
    {
        GetFromHDC('AN',lcAN);
    }

//======================================================
    function CheckCID(lcPID)
//======================================================
    {
        GetFromHDC('CID',lcPID);
    }

//======================================================
function GetFromHDC(cType,cValues) {
//======================================================
    if (cType=='CID'){
        var lcPID = cValues ;
        var lcAN = "" ;
    } else {
        var lcPID = "" ;
        var lcAN = cValues ;
    }
	if (lcPID.length > 5 || lcAN.length>3) {
        var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        		var jsonReturn = xmlhttp.responseText;
			    var HDCData = JSON.parse(jsonReturn);
                if (HDCData.PID){
                    document.getElementById("formInput-cid").value = HDCData.CID;
                    document.getElementById("formInput-hn").value = HDCData.PID;
                    document.getElementById("formInput-an").value = HDCData.AN;
                    document.getElementById("formInput-prename").value = HDCData.titlename;
                    document.getElementById("formInput-fname").value = HDCData.NAME;
    				document.getElementById("formInput-lname").value = HDCData.LNAME;
                    document.getElementById("formInput-sex").value = HDCData.SEX;
                    document.getElementById("formInput-prov").value = HDCData.ADDCODE.substr(0,2);
                    document.getElementById("formInput-amp").value = HDCData.ADDCODE.substr(2,2);
                    document.getElementById("formInput-dob").value = HDCData.BIRTH;
                    document.getElementById("formInput-address").value = HDCData.HOUSE;
                    document.getElementById("formInput-moo").value = HDCData.VILLAGE;
                    document.getElementById("formInput-soi").value = HDCData.SOIMAIN;
                    document.getElementById("formInput-road").value = HDCData.ROAD;
                    document.getElementById("formInput-father_cid").value = HDCData.FATHER;
                    document.getElementById("formInput-mother_cid").value = HDCData.MOTHER;
                    document.getElementById("formInput-tel").value = HDCData.TEL;
                    document.getElementById("formInput-mobile").value = HDCData.MOBILE;
                    document.getElementById("formInput-weight").value = HDCData.admitweight*1000;
                    document.getElementById("formInput-seq").value = HDCData.SEQ;

                    //calage(document.getElementById("formInput-dob").value,cAge,nAge_type);
                    //document.getElementById("serverip").value = HDCData.client_ip;

                    GetFatherName(HDCData.FATHER);
                    GetMotherName(HDCData.MOTHER);
                } else {
                    //document.getElementById("formInput-cid").value = '';
                    document.getElementById("formInput-hn").value = '';
                    //document.getElementById("formInput-an").value = '';
                    document.getElementById("formInput-hn").value = '';
                    document.getElementById("formInput-prename").value = '';
                    document.getElementById("formInput-fname").value = '';
    				document.getElementById("formInput-lname").value = '';
                    document.getElementById("formInput-dob").value = '';
                    document.getElementById("formInput-address").value = '';
                    document.getElementById("formInput-moo").value = '';
                    document.getElementById("formInput-soi").value = '';
                    document.getElementById("formInput-road").value = '';
                    document.getElementById("formInput-mother_cid").value = '';
                    document.getElementById("formInput-mother_name").value = '';
                    document.getElementById("formInput-mother_an").value = '';
                    document.getElementById("formInput-father_cid").value = '';
                    document.getElementById("formInput-father_name").value = '';
                    document.getElementById("formInput-tel").value = '';
                    document.getElementById("formInput-mobile").value = '';
                    document.getElementById("formInput-seq").value = '';
                }
	        }
	    }
        xmlhttp.open("GET", "/newborn/data/gethdc?cid="+lcPID+"&an="+lcAN, true);
//        xmlhttp.open("GET", "/newborn/data/gethdc?cid="+lcPID, true);
	    xmlhttp.send();
	}
}
//======================================================
function GetMotherName(lcPID) {
//======================================================
	if (lcPID.length >=13) {
        var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        		var jsonReturn = xmlhttp.responseText;
			    var HDCData = JSON.parse(jsonReturn);
                if (HDCData.PID){
                    document.getElementById("formInput-mother_name").value = HDCData.titlename+HDCData.NAME+' '+HDCData.LNAME;
                    document.getElementById("formInput-mother_an").value = HDCData.AN;
                } else {
                    document.getElementById("formInput-mother_name").value = '';
                    document.getElementById("formInput-mother_an").value = '';
                }
	        }
	    }
        xmlhttp.open("GET", "/newborn/data/gethdc?cid="+lcPID, true);
	    xmlhttp.send();
	}
}
//======================================================
function GetFatherName(lcPID) {
//======================================================
	if (lcPID.length >=13) {
        var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function() {
        	if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        		var jsonReturn = xmlhttp.responseText;
			    var HDCData = JSON.parse(jsonReturn);
                if (HDCData.PID){
                    document.getElementById("formInput-father_name").value = HDCData.titlename+HDCData.NAME+' '+HDCData.LNAME;
                } else {
                    document.getElementById("formInput-father_name").value = '';
                }
	        }
	    }
        xmlhttp.open("GET", "/newborn/data/gethdc?cid="+lcPID, true);
	    xmlhttp.send();
	}
}
</script>

<script type="text/javascript">
            $(document).ready(function() {
                $('#formInput-prov').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {prov: $(this).val()},
                        url: 'include/select_ampur.php',
                        success: function(data) {
                            $('#formInput-amp').html(data);
                        }
                    });
                    return false;
                });
            });
</script>

<script type="text/javascript">
            $(document).ready(function() {
                $('#formInput-amp').change(function() {
                    $.ajax({
                        type: 'POST',
                        data: {prov: $(formInput-prov).val(),amp: $(this).val()},
                        url: 'include/select_tambon.php',
                        success: function(data) {
                            $('#formInput-tam').html(data);
                        }
                    });
                    return false;
                });
            });
</script>

<script type="text/javascript">
    jQuery(function($) {
        jQuery('body').on('change','#formInput-prov',function(){
            jQuery.ajax({
                'type':'POST',
                'url':'include/amp_select.php',
                'cache':false,
                'data':{province:jQuery(this).val()},
                'success':function(html){
                    jQuery("#formInput-amp").html(html);
                }
            });
            return false;
        });
         jQuery('body').on('change','#formInput-amp',function(){
            jQuery.ajax({
                'type':'POST',
                'url':'include/tambon_select.php',
                'cache':false,
                'data':{amphoe:jQuery(this).val()},
                'success':function(html){
                    jQuery("#formInput-tambon").html(html);
                }
            });
            return false;
        });
    });
</script>

<?php
$url = yii\helpers\Url::to('prefix-list');//กำหนด URL ที่จะไปโหลดข้อมูล
//$prefix = empty($patient->prename) ? '' : BasePrefix::findOne($model->prefix_id)->prefix_name;//กำหนดค่าเริ่มต้น
//echo $form->field($patient, 'prename')->widget(Select2::className(),
/*    [
        'initValueText'=>$prename,//กำหนดค่าเริ่มต้น
        'options'=>['placeholder'=>'เลือกคำนำหน้า...'],
        'pluginOptions'=>[
            'allowClear'=>true,
            'minimumInputLength'=>3,//ต้องพิมพ์อย่างน้อย 3 อักษร ajax จึงจะทำงาน
            'ajax'=>[
                'url'=>$url,
                'dataType'=>'json',//รูปแบบการอ่านคือ json
                'data'=>new JsExpression('function(params) { return {q:params.term};}')
            ],
            'escapeMarkup'=>new JsExpression('function(markup) { return markup;}'),
            'templateResult'=>new JsExpression('function(prefix){ return prefix.name;}'),
            'templateSelection'=>new JsExpression('function(prefix) {return prefix.name;}'),
        ]
    ]*/
//);
?>
