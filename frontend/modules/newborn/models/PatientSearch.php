<?php

namespace app\modules\newborn\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\newborn\models\Patient;

/**
 * PatientSearch represents the model behind the search form about `app\modules\newborn\models\Patient`.
 */
class PatientSearch extends Patient
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'moi_checked', 'serviced'], 'integer'],
            [['hospcode', 'hn', 'prename', 'fname', 'mname', 'lname', 'cid', 'dob', 'sex', 'dead', 'mother_cid', 'mother_name', 'father_cid', 'father_name', 'nation', 'address', 'moo', 'soi', 'road', 'ban', 'addcode', 'zip', 'tel', 'mobile', 'remark', 'inp_id', 'lastupdate'], 'safe'],
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
        $query = Patient::find();

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
            'dob' => $this->dob,
            'dead' => $this->dead,
            'moi_checked' => $this->moi_checked,
            'serviced' => $this->serviced,
            'lastupdate' => $this->lastupdate,
        ]);

        $query->andFilterWhere(['like', 'hospcode', $this->hospcode])
            ->andFilterWhere(['like', 'hn', $this->hn])
            ->andFilterWhere(['like', 'prename', $this->prename])
            ->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'mname', $this->mname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'cid', $this->cid])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'mother_cid', $this->mother_cid])
            ->andFilterWhere(['like', 'mother_name', $this->mother_name])
            ->andFilterWhere(['like', 'father_cid', $this->father_cid])
            ->andFilterWhere(['like', 'father_name', $this->father_name])
            ->andFilterWhere(['like', 'nation', $this->nation])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'moo', $this->moo])
            ->andFilterWhere(['like', 'soi', $this->soi])
            ->andFilterWhere(['like', 'road', $this->road])
            ->andFilterWhere(['like', 'ban', $this->ban])
            ->andFilterWhere(['like', 'addcode', $this->addcode])
            ->andFilterWhere(['like', 'zip', $this->zip])
            ->andFilterWhere(['like', 'tel', $this->tel])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'inp_id', $this->inp_id]);

        return $dataProvider;
    }
}
