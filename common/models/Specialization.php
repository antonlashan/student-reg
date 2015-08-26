<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%specialization}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property UserSpecializations[] $userSpecializations
 */
class Specialization extends \yii\db\ActiveRecord {

	//status
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%specialization}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['status'], 'integer'],
			[['name'], 'string', 'max' => 50]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'status' => 'Status',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserSpecializations()
	{
		return $this->hasMany(UserSpecializations::className(), ['specialization_id' => 'id']);
	}

	public function getStatusLabels()
	{
		return [
			self::STATUS_ACTIVE => 'Active',
			self::STATUS_INACTIVE => 'Inactive',
		];
	}

	public function getStatusLabel()
	{
		return $this->getStatusLabels()[$this->status];
	}

}
