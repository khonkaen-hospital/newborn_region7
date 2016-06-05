<?php

namespace app\modules\newborn\models;

use Yii;

/**
 * This is the model class for table "lib_position_type".
 *
 * @property integer $code
 * @property string $position_type
 * @property integer $active
 * @property string $lastupdate
 */
class Libpositiontype extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lib_position_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['lastupdate'], 'safe'],
            [['position_type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'รหัส'),
            'position_type' => Yii::t('app', 'ประเภทตำแหน่ง'),
            'active' => Yii::t('app', 'Active'),
            'lastupdate' => Yii::t('app', 'Lastupdate'),
        ];
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
