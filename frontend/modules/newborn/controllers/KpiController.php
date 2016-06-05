<?php

namespace app\modules\newborn\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;

/**
 * Default controller for the `newborn` module
 */
class KpiController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */

     public function behaviors()
     {
         return [
             'access' => [
                 'class' => AccessControl::className(),
                 'only' => ['index', 'list','input','prov','edit'],
                 'rules' => [
                     [
                         'actions' => ['index','list','input','prov','edit'],
                         'allow' => true,
                         'roles' => ['@'],
                     ],
                 ],
             ],
             'verbs' => [
                 'class' => VerbFilter::className(),
                 'actions' => [
                     'edit1' => ['post'],
                 ],
             ],
         ];
     }

    public function actionIndex()
    {
        return $this->redirect(Url::to('/newborn/kpi/list'));
    }

    public function actionEdit($id=null, $prov=null, $year=0, $hcode=null)
    {
        $year = ($year<2558 || $year>date("Y")+543)? (date("Y")+543):$year;
        $UserHCode = $this->getLoginData("hcode");
        $Month1 = ($year-1).'10' ;
        $Month2 = $year.'09' ;
        $Sql = 'SELECT * FROM view_kpi_data WHERE hcode="'.$hcode.
                '" and kpi_id="'.$id.'" and monthly between "'.$Month1.'" and "'.$Month2.
                '" ORDER BY monthly';
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryAll();

        $Sql = 'SELECT * '.
            'FROM lib_hospcode WHERE off_id="'.$hcode.
            '" AND typecode NOT IN ("01","02","03","04","16","17") ORDER BY typecode,name';
        $hospName = Yii::$app->db_dc->createCommand($Sql)->queryOne();

        $Sql = 'SELECT * FROM kpi_item WHERE kpi_id="'.$id.'" AND isactive=1 ORDER BY kpi_subgroup,kpi_id';
        $Kpi = Yii::$app->db_dc->createCommand($Sql)->queryOne();

        return $this->render("edit",[
            'rawData'=>$rawData,
            'Kpi'=>$Kpi,
            'hcode'=>$hcode,
            'hospName'=>$hospName,
            'id'=>$id,
            'prov'=>$prov,
            'year'=>$year,
            'HCode'=>$HCode,
            'UserHCode'=>$UserHCode,
        ]);
    }

    public function actionList($year=0)
    {
        $year = ($year<2558 || $year>date("Y")+543)? (date("Y")+543):$year;
        $Sql = "SELECT * FROM kpi_item WHERE isactive=1 ORDER BY kpi_subgroup,kpi_id";
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryAll();
        $dataProvider = new ArrayDataProvider([
                'allModels'=>$rawData,
                'pagination'=>['pageSize'=>100],
            ]);

        return $this->render("kpi_list",[
            'dataProvider'=>$dataProvider,
            'rawData'=>$rawData,
            'year'=>$year,
        ]);
    }

    public function actionProv($id=null, $prov=null, $year=0)
    {
        $year = ($year<2558 || $year>date("Y")+543)? (date("Y")+543):$year;
        $Sql = 'SELECT * FROM kpi_item WHERE kpi_id="'.$id.'" AND isactive=1 ORDER BY kpi_subgroup,kpi_id';
        $rawData = Yii::$app->db_dc->createCommand($Sql)->queryOne();

        $Sql = 'SELECT *,0 as m10,0 as m11,0 as m12,0 as m1,0 as m2,0 as m3,0 as m4,0 as m5,0 as m6,0 as m7,0 as m8,0 as m9 '.
            'FROM lib_hospcode WHERE changwat="'.$prov.
            '" AND typecode NOT IN ("01","02","03","04","16","17") ORDER BY typecode,name';
        $hospName = Yii::$app->db_dc->createCommand($Sql)->queryAll();

        $dataProvider = new ArrayDataProvider([
                'allModels'=>$hospName,
                'pagination'=>['pageSize'=>100],
            ]);

        return $this->render("kpi_list_prov",[
            'dataProvider'=>$dataProvider,
            'rawData'=>$rawData,
            'hospitals'=>$hospName,
            'id'=>$id,
            'prov'=>$prov,
            'year'=>$year,
        ]);
    }

    private function getLoginData($columnReturn){
        if (isset(Yii::$app->user->identity->username) && Yii::$app->user->identity->username!=""){
            $Sql = 'SELECT * FROM user WHERE username="'.Yii::$app->user->identity->username.'" ';
            $User = Yii::$app->db->createCommand($Sql)->queryOne();
            return $User["hcode"];
        } else {
            return '';
        }
    }
}
