<?php
namespace app\modules\newborn\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use app\modules\newborn\models\Patient;
use app\modules\newborn\models\PatientSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * Default controller for the `newborn` module
 */
class DataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','detail','update','edit','gethdc'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->userlevel<2){
            $Where = 'p.hospcode="'.Yii::$app->user->identity->hcode.'" ';
        } else {
            $Where = 'p.prov="'.Yii::$app->user->identity->prov.'" ';
        }
        if (isset($_POST[searchtext]) && $_POST[searchtext]!="" ){
            $Where .= ' AND p.'.$_POST[searchtype].' LIKE "'.$_POST[searchtext].'%" ';
        }
        $Sql = 'SELECT hosp.name as hname, p.* FROM view_patient_serviceplan p left join lib_hospcode hosp '
                .'on p.hospcode=hosp.off_id WHERE '.$Where.' ORDER BY p.dob DESC LIMIT 250';
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryAll();

        $dataProvider = new ArrayDataProvider([
                'allModels'=>$rawData,
                'pagination'=>['pageSize'=>50],
            ]);

        return $this->render("index",[
            'dataProvider'=>$dataProvider,
            'rawData'=>$rawData,
        ]);
    }

    public function actionDetail($id=0)
    {
        if ($id > 0){
            $Sql = 'SELECT p.*,hosp.name as hname FROM view_patient_serviceplan p left join lib_hospcode hosp '
                    .'on p.hospcode=hosp.off_id '
                    .'WHERE p.hospcode="'.Yii::$app->user->identity->hcode.'" AND p.id='.$id;
            $row = Yii::$app->db_dc->createCommand($Sql)->queryOne();
        } else {
            $row=[];
        }
        $dataProvider = new ArrayDataProvider([
                'allModels'=>$row,
                'pagination'=>['pageSize'=>50],
            ]);

        return $this->render('detail',[
            'id'=>$id,
            'dataProvider'=>$dataProvider,
            'row'=>$row,
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionEdit($id=0)
    {
        if (isset($_POST) && isset($_POST["id"])){
            $row = $_POST[formInput]  ;
            $row[cid] = preg_replace("/\_/","",preg_replace("/\-/","",$row[cid]));
            $row[mother_cid] = preg_replace("/\_/","",preg_replace("/\-/","",$row[mother_cid]));
            $row[father_cid] = preg_replace("/\_/","",preg_replace("/\-/","",$row[father_cid]));
            $row[mobile] = preg_replace("/\_/","",preg_replace("/\-/","",$row[mobile]));
            $row[tel] = preg_replace("/\_/","",preg_replace("/\-/","",$row[tel]));
            $row[addcode] = $_POST["formInput-prov"].$_POST["formInput-amp"].$_POST["formInput-tam"];
            $row["seq"] = $row["seq"]==""? (date("YmdHis")):$row["seq"];
            $HCode = $row["hospcode"];
            $id = $_POST["id"];
            //unset($row["hcode"]);

            $Columns = '';
            $Values = '';
            $Updates = '';
            foreach ($row as $column => $value) {
                if ($id==0){
                    $Columns .= ($Columns==""? '':' , ').$column;
                    $Values .= ($Values==''? '"':' , "').$value.'"';
                } else {
                    $Updates .= ($Updates==''? '':' , ').$column.'="'.$value.'"';
                }
            }

            if ($id==0){
                $Sql = 'INSERT INTO patient ('.$Columns.') VALUES ('.$Values.')';
                Yii::$app->db_dc->createCommand($Sql)->execute();
                $SqlLast = 'SELECT LAST_INSERT_ID() as id';
                $GetLast = Yii::$app->db_dc->createCommand($SqlLast)->queryOne();
                $id = $GetLast["id"];
            } else {
                $Sql = 'UPDATE patient SET '.$Updates.' WHERE id='.$id.' AND hospcode="'.$HCode.'"';
                Yii::$app->db_dc->createCommand($Sql)->execute();
            }

            // บันทึก โรค ================
            $SqlDx = 'DELETE FROM service_diagnosis WHERE hospcode="'.$row["hospcode"].
                        '" AND hn="'.$row["hn"].'" AND seq="'.$row["seq"].'" ';
            Yii::$app->db_dc->createCommand($SqlDx)->execute();

            $Sql1 = '"'.$row["hospcode"].'" , "'.$row["hn"].'" , "'.$row["seq"].'" , "IPD" , ';
            $dx = $_POST[formPDxInput];
            $SqlDx = 'INSERT INTO service_diagnosis (hospcode,hn,seq,patient_type,diagcode,type_dx) VALUES ('
                        . $Sql1.'"'.trim(strtoupper($dx["pdx"])).'" , "1") ';
            $dxs = $_POST[formccDxInput];
            $lcSql = '';
            foreach ($dxs as $dx) {
                if ($dx!=""){
                    $lcSql .= ($lcSql==""? '':',').'('.$Sql1.'"'.trim(strtoupper($dx)).'" , "2")';
                }
            }

            $SqlDx .= ($lcSql==""? '':',').$lcSql ;
            Yii::$app->db_dc->createCommand($SqlDx)->execute();

            // บันทึก หัตถการ ================
            $lcSql = 'DELETE FROM service_procedure WHERE hospcode="'.$row["hospcode"].
                        '" AND hn="'.$row["hn"].'" AND seq="'.$row["seq"].'" ';
            Yii::$app->db_dc->createCommand($lcSql)->execute();

            $Procedures = $_POST[formProcInput];
            $lcSql = '';
            foreach ($Procedures as $Procedure) {
                if ($Procedure!=""){
                    $lcSql .= ($lcSql==""? '':',').'('.$Sql1.'"'.trim(strtoupper($Procedure)).'")';
                }
            }
            if ($lcSql!="") {
                $lcSql = 'INSERT INTO service_procedure (hospcode,hn,seq, patient_type, procedcode) VALUES '.$lcSql;
                Yii::$app->db_dc->createCommand($lcSql)->execute();
            }
            /*echo '<pre>';
            echo $SqlDx;
            print_r($_POST[formPDxInput]);
            print_r($_POST[formccDxInput]);
            print_r($_POST[formProcInput]);
            echo '</pre>';
            exit;*/

            $Sql = 'REPLACE INTO patient_sp (hospcode,sp,hn) VALUES ("'.$row["hospcode"].'","NB","'.$row["hn"].'") ';
            Yii::$app->db_dc->createCommand($Sql)->execute();

        } else {
            if ($id==0) {
                $row = [];
                $row[hospcode] = Yii::$app->user->identity->hcode;
                $row[addcode] = Yii::$app->user->identity->prov;
                $row[prov] = Yii::$app->user->identity->prov;

                $row[prename]='ดญ.';
                $row[sex]=2;
                $row[dob]=date("Y-m-d");
            } else {
                $Sql = 'SELECT * FROM view_patient_serviceplan WHERE hospcode="'.Yii::$app->user->identity->hcode.'" AND id='.$id;
                $row = Yii::$app->db_dc->createCommand($Sql)->queryOne();
            }
        }
        $Sql = 'SELECT substr(code,1,2) as code,name FROM lib_address WHERE substr(code,3,4)="0000" ORDER BY name';
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryAll();
        $ProvCode = ArrayHelper::map($rawData,'code','name');

        $Sql = 'SELECT substr(code,3,2) as code,name FROM lib_address WHERE substr(code,5,2)="00" AND substr(code,1,2)="'.substr($row["addcode"],0,2).'" ORDER BY name';
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryAll();
        $AmpCode = ArrayHelper::map($rawData,'code','name');

        $Sql = 'SELECT substr(code,5,2) as code,name FROM lib_address WHERE substr(code,5,2)!="00" AND substr(code,1,4)="'.substr($row["addcode"],0,4).'" ORDER BY name';
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryAll();
        $TamCode = ArrayHelper::map($rawData,'code','name');

        return $this->render('edit',[
            'id'=>$id,
            'row'=>$row,
            'ProvCode'=>$ProvCode,
            'AmpCode'=>$AmpCode,
            'TamCode'=>$TamCode,
        ]);
    }

    public function actionGethdc($cid = null, $an=null)
    {
        $cid = preg_replace("/\_/","",preg_replace("/\-/","",$cid));
        $Prov = Yii::$app->user->identity->prov;
        $HdcServer = ['40'=>'db_hdc_kk','44'=>'db_hdc_kk','45'=>'db_hdc_rt','46'=>'db_hdc_kk'];
        $Where = ($an=="")? (' person.cid="'.$cid.'" '):(' ipd.AN="'.$an.'" AND person.HOSPCODE="'.Yii::$app->user->identity->hcode.'" ') ;
        $Sql = 'SELECT person.HOSPCODE, person.PID, person.CID, person.PRENAME, ctitle.titlename, person.NAME, person.LNAME,
                    person.HN, person.SEX, person.ABOGROUP, person.BIRTH, person.MSTATUS,
                    person.FATHER, person.MOTHER, person.HID,
                    IF(home.HOUSE="" OR ISNULL(home.HOUSE),addr.HOUSENO,home.HOUSE) as HOUSE,
                    IF(home.SOIMAIN="" OR ISNULL(home.SOIMAIN),addr.SOIMAIN,home.SOIMAIN) as SOIMAIN,
                    IF(home.ROAD="" OR ISNULL(home.ROAD),addr.ROAD,home.ROAD) as ROAD,
                    IF(home.VILLAGE="" OR ISNULL(home.VILLAGE),addr.VILLAGE,home.VILLAGE) as VILLAGE,
                    IF(home.CHANGWAT="" OR ISNULL(home.CHANGWAT),
                        CONCAT(addr.CHANGWAT, addr.AMPUR, addr.TAMBON),
                        CONCAT(home.CHANGWAT, home.AMPUR, home.TAMBON)
                    ) as ADDCODE,
                    addr.telephone as TEL, addr.mobile as MOBILE,person.TYPEAREA,
                    ipd.AN, ipd.DATETIME_ADMIT, ipd.SEQ, ipd.REFERINHOSP, ipd.admitweight,
                    IF(person.HOSPCODE="'.Yii::$app->user->identity->hcode.'",1,9) as mypopulation
                FROM person
                    LEFT JOIN home on person.HOSPCODE=home.HOSPCODE and person.HID=home.HID
                    LEFT JOIN address addr ON person.HOSPCODE=addr.HOSPCODE AND person.PID=addr.PID
                    LEFT JOIN admission ipd ON person.HOSPCODE=ipd.HOSPCODE AND person.PID=ipd.PID
                    LEFT JOIN ctitle ON person.PRENAME=ctitle.titlecode
                WHERE '.$Where.'
                ORDER BY mypopulation,person.TYPEAREA,ipd.DATETIME_ADMIT ';
        //        WHERE person.cid="'.$cid.'" AND person.HOSPCODE="'.Yii::$app->user->identity->hcode.'" ';
        $rawData = Yii::$app->$HdcServer["$Prov"]->createCommand($Sql)->queryOne();
        echo json_encode($rawData);
    }

    public function actionPrefixList($q = null, $id = null){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //กำหนดการแสดงผลข้อมูลแบบ json
        $out = ['results'=>['code'=>'','name'=>'']];
        if(!is_null($q)){
            $query = new \yii\db\Query();
            $query->select('code, name')
                ->from('lib_titles')
                ->where("name LIKE '%".$q."%'")
                ->limit(10);
            $data = Yii::$app->db_dc->createCommand($query)->queryAll();
            $out['results'] = array_values($data);
        }else if($id>0){
            $out['results'] = ['code'=>$code, 'name'=> BasePrefix::find($id)->name];
        }
        return $out;
    }
    // https://www.programmerthailand.com/tutorial/post/view/23/extension-%E0%B8%81%E0%B8%B2%E0%B8%A3%E0%B9%83%E0%B8%8A%E0%B9%89%E0%B8%87%E0%B8%B2%E0%B8%99-kartik-select2-%E0%B9%81%E0%B8%9A%E0%B8%9A-ajax-(%E0%B8%82%E0%B9%89%E0%B8%AD%E0%B8%A1%E0%B8%B9%E0%B8%A5%E0%B9%80%E0%B8%A2%E0%B8%AD%E0%B8%B0)
}
