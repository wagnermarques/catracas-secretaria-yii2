<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UsuariosSistema;

/**
 * UsuariosSistemaSearchModel represents the model behind the search form of `app\models\UsuariosSistema`.
 */
class UsuariosSistemaSearchModel extends UsuariosSistema
{
    public $pessoa_nome;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pessoa_id'], 'integer'],
            [['loginname', 'password', 'auth_key', 'access_token', 'pessoa_nome'], 'safe'],
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
        $query = UsuariosSistema::find();
        $query->joinWith(['pessoa']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['pessoa_nome'] = [
            'asc' => ['pessoas.firstname' => SORT_ASC],
            'desc' => ['pessoas.firstname' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'usuarios_sistema.id' => $this->id,
            'pessoa_id' => $this->pessoa_id,
        ]);

        $query->andFilterWhere(['like', 'loginname', $this->loginname])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'access_token', $this->access_token])
            ->andFilterWhere(['or', 
                ['like', 'pessoas.firstname', $this->pessoa_nome],
                ['like', 'pessoas.lastname', $this->pessoa_nome]
            ]);

        return $dataProvider;
    }
}
