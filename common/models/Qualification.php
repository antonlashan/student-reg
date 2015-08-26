<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%qualification}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 *
 * @property UserQualifications[] $userQualifications
 */
class Qualification extends \yii\db\ActiveRecord {

	//status
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%qualification}}';
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
	public function getUserQualifications()
	{
		return $this->hasMany(UserQualifications::className(), ['qualification_id' => 'id']);
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
