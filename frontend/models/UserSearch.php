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

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
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

		if (!$this->validate()) {
			// uncomment the following line if you do not want to return any records when validation fails
			// $query->where('0=1');
			return $dataProvider;
		}

		$query->andFilterWhere([
//			'id' => $this->id,
//			'title' => $this->title,
//			'is_admin' => $this->is_admin,
//			'status' => $this->status,
//			'created_at' => $this->created_at,
//			'updated_at' => $this->updated_at,
		]);

		$query->andFilterWhere(['like', 'auth_key', $this->auth_key])
//			->andFilterWhere(['like', 'password_hash', $this->password_hash])
//			->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
			->andFilterWhere(['like', 'email', $this->email])
			->andFilterWhere(['like', 'full_name', $this->full_name]);

		return $dataProvider;
	}

}
