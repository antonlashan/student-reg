<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * UserSearch represents the model behind the search form about `common\models\User`.
 */
class UserSearch extends User {

	public $search_e_n;//search by email an name
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['search_e_n'], 'required'],
			[['id', 'title', 'is_admin', 'status'], 'integer'],
			[['auth_key', 'password_hash', 'password_reset_token', 'email', 'full_name', 'created_at', 'updated_at'], 'safe'],
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
	
	public function attributeLabels()
	{
		return [
			'search_e_n' => 'Search Field'
		];
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

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		$this->load($params);
		if (empty($this->search_e_n)) {
			return null;
		}

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere(['like', 'email', $this->search_e_n])
			->orFilterWhere(['like', 'full_name', $this->search_e_n]);

		return $dataProvider;
	}

}
