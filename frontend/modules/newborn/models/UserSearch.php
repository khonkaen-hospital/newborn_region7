<?php

namespace app\modules\newborn\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\newborn\models\User;

/**
 * UserSearch represents the model behind the search form about `app\modules\newborn\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'position_type', 'userlevel', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'status'], 'integer'],
            [['employee_no', 'username', 'prename', 'fname', 'lname', 'personid', 'position', 'position_level', 'hcode', 'prov', 'email', 'tel', 'mobile', 'password_hash', 'auth_key', 'unconfirmed_email', 'registration_ip', 'lastupdate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'position_type' => $this->position_type,
            'userlevel' => $this->userlevel,
            'confirmed_at' => $this->confirmed_at,
            'blocked_at' => $this->blocked_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'flags' => $this->flags,
            'status' => $this->status,
            'lastupdate' => $this->lastupdate,
        ]);

        $query->andFilterWhere(['like', 'employee_no', $this->employee_no])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'prename', $this->prename])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'personid', $this->personid])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'position_level', $this->position_level])
            ->andFilterWhere(['like', 'hcode', $this->hcode])
            ->andFilterWhere(['like', 'prov', $this->prov])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'unconfirmed_email', $this->unconfirmed_email])
            ->andFilterWhere(['like', 'registration_ip', $this->registration_ip]);

        return $dataProvider;
    }
}
