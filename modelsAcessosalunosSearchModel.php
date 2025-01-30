<?php

namespace app;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Acessosalunos;

/**
 * modelsAcessosalunosSearchModel represents the model behind the search form of `app\models\Acessosalunos`.
 */
class modelsAcessosalunosSearchModel extends Acessosalunos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_aluno'], 'integer'],
            [['timestampdapassagem', 'timestampdoupdatepranuvem', 'timestampdoupdatepranuvemAtUploading'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Acessosalunos::find();

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
            'id_aluno' => $this->id_aluno,
            'timestampdapassagem' => $this->timestampdapassagem,
            'timestampdoupdatepranuvem' => $this->timestampdoupdatepranuvem,
            'timestampdoupdatepranuvemAtUploading' => $this->timestampdoupdatepranuvemAtUploading,
        ]);

        return $dataProvider;
    }
}
