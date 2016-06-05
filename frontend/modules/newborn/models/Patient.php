<?php

namespace app\modules\newborn\models;

use Yii;

/**
 * This is the model class for table "patient".
 *
 * @property integer $id
 * @property string $hospcode
 * @property string $hn
 * @property string $prename
 * @property string $fname
 * @property string $mname
 * @property string $lname
 * @property string $cid
 * @property string $dob
 * @property string $sex
 * @property string $dead
 * @property string $mother_cid
 * @property string $mother_name
 * @property string $father_cid
 * @property string $father_name
 * @property string $nation
 * @property string $address
 * @property string $moo
 * @property string $soi
 * @property string $road
 * @property string $ban
 * @property string $addcode
 * @property string $zip
 * @property string $tel
 * @property string $mobile
 * @property integer $moi_checked
 * @property integer $serviced
 * @property string $remark
 * @property string $inp_id
 * @property string $lastupdate
 *
 * @property PatientSp[] $patientSps
 * @property Serviceplan[] $sps
 */
class Patient extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'patient';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hospcode', 'hn'], 'required'],
            [['dob', 'dead', 'lastupdate'], 'safe'],
            [['sex', 'remark'], 'string'],
            [['moi_checked', 'serviced'], 'integer'],
            [['hospcode', 'prename', 'zip'], 'string', 'max' => 5],
            [['hn'], 'string', 'max' => 15],
            [['fname', 'mname', 'lname'], 'string', 'max' => 30],
            [['cid', 'mother_cid', 'father_cid', 'address', 'tel', 'mobile'], 'string', 'max' => 20],
            [['mother_name', 'father_name', 'ban'], 'string', 'max' => 50],
            [['nation', 'moo'], 'string', 'max' => 4],
            [['soi', 'road'], 'string', 'max' => 40],
            [['addcode'], 'string', 'max' => 6],
            [['inp_id'], 'string', 'max' => 10],
            [['hospcode', 'hn'], 'unique', 'targetAttribute' => ['hospcode', 'hn'], 'message' => 'The combination of Hospcode and Hn has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hospcode' => Yii::t('app', 'Hospcode'),
            'hn' => Yii::t('app', 'Hn'),
            'prename' => Yii::t('app', 'Prename'),
            'fname' => Yii::t('app', 'Fname'),
            'mname' => Yii::t('app', 'Mname'),
            'lname' => Yii::t('app', 'Lname'),
            'cid' => Yii::t('app', 'Cid'),
            'dob' => Yii::t('app', 'Dob'),
            'sex' => Yii::t('app', 'Sex'),
            'dead' => Yii::t('app', 'Dead'),
            'mother_cid' => Yii::t('app', 'Mother Cid'),
            'mother_name' => Yii::t('app', 'Mother Name'),
            'father_cid' => Yii::t('app', 'Father Cid'),
            'father_name' => Yii::t('app', 'Father Name'),
            'nation' => Yii::t('app', 'Nation'),
            'address' => Yii::t('app', 'Address'),
            'moo' => Yii::t('app', 'Moo'),
            'soi' => Yii::t('app', 'Soi'),
            'road' => Yii::t('app', 'Road'),
            'ban' => Yii::t('app', 'Ban'),
            'addcode' => Yii::t('app', 'Addcode'),
            'zip' => Yii::t('app', 'Zip'),
            'tel' => Yii::t('app', 'Tel'),
            'mobile' => Yii::t('app', 'Mobile'),
            'moi_checked' => Yii::t('app', 'Moi Checked'),
            'serviced' => Yii::t('app', 'Serviced'),
            'remark' => Yii::t('app', 'Remark'),
            'inp_id' => Yii::t('app', 'Inp ID'),
            'lastupdate' => Yii::t('app', 'Lastupdate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatientSps()
    {
        return $this->hasMany(PatientSp::className(), ['hospcode' => 'hospcode', 'hn' => 'hn']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSps()
    {
        return $this->hasMany(Serviceplan::className(), ['code' => 'sp'])->viaTable('patient_sp', ['hospcode' => 'hospcode', 'hn' => 'hn']);
    }

    /**
     * @inheritdoc
     * @return PatientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PatientQuery(get_called_class());
    }
}
