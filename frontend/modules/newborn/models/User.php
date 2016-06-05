<?php

namespace app\modules\newborn\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $employee_no
 * @property string $username
 * @property string $prename
 * @property string $fname
 * @property string $lname
 * @property string $personid
 * @property string $position
 * @property string $position_level
 * @property integer $position_type
 * @property string $hcode
 * @property string $prov
 * @property integer $userlevel
 * @property string $email
 * @property string $tel
 * @property string $mobile
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property integer $status
 * @property string $lastupdate
 *
 * @property Profile $profile
 * @property Token[] $tokens
 * @property LibPositionType $positionType
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['position_type', 'userlevel', 'flags', 'status'], 'integer'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at'], 'date'],
            [['lastupdate'], 'safe'],
            [['employee_no'], 'string', 'max' => 10],
            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['prename', 'fname', 'lname'], 'string', 'max' => 50],
            [['personid'], 'string', 'max' => 30],
            [['position', 'position_level'], 'string', 'max' => 100],
            [['hcode'], 'string', 'max' => 9],
            [['prov'], 'string', 'max' => 4],
            [['tel', 'mobile'], 'string', 'max' => 18],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['position_type'], 'exist', 'skipOnError' => true, 'targetClass' => LibPositionType::className(), 'targetAttribute' => ['position_type' => 'code']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_no' => Yii::t('app', 'Employee No'),
            'username' => Yii::t('app', 'Username'),
            'prename' => Yii::t('app', 'Prename'),
            'fname' => Yii::t('app', 'Fname'),
            'lname' => Yii::t('app', 'Lname'),
            'personid' => Yii::t('app', 'Personid'),
            'position' => Yii::t('app', 'Position'),
            'position_level' => Yii::t('app', 'Position Level'),
            'position_type' => Yii::t('app', 'Position Type'),
            'hcode' => Yii::t('app', 'Hcode'),
            'prov' => Yii::t('app', 'Prov'),
            'userlevel' => Yii::t('app', 'Userlevel'),
            'email' => Yii::t('app', 'Email'),
            'tel' => Yii::t('app', 'Tel'),
            'mobile' => Yii::t('app', 'Mobile'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'unconfirmed_email' => Yii::t('app', 'Unconfirmed Email'),
            'blocked_at' => Yii::t('app', 'Blocked At'),
            'registration_ip' => Yii::t('app', 'Registration Ip'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'flags' => Yii::t('app', 'Flags'),
            'status' => Yii::t('app', 'Status'),
            'lastupdate' => Yii::t('app', 'Lastupdate'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPositionType()
    {
        return $this->hasOne(LibPositionType::className(), ['code' => 'position_type']);
    }

    /**
     * @inheritdoc
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
