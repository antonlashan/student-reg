<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_qualifications}}".
 *
 * @property integer $user_id
 * @property integer $qualification_id
 *
 * @property User $user
 * @property Qualification $qualification
 */
class UserQualifications extends \yii\db\ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_qualifications}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'qualification_id'], 'integer'],
			[['user_id', 'qualification_id'], 'unique', 'targetAttribute' => ['user_id', 'qualification_id'], 'message' => 'The combination of User ID and Qualification ID has already been taken.']
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'user_id' => 'User ID',
			'qualification_id' => 'Qualification ID',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getQualification()
	{
		return $this->hasOne(Qualification::className(), ['id' => 'qualification_id']);
	}

}
