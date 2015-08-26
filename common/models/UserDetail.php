<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_detail}}".
 *
 * @property integer $user_id
 * @property string $membership_number
 * @property integer $member_category_id
 * @property string $present_position
 * @property string $affiliation
 * @property string $official_address
 * @property string $permanent_address
 * @property string $phone_office
 * @property string $phone_residence
 * @property string $phone_mobile
 * @property string $professional_qualifications
 *
 * @property User $user
 * @property UserCategory $memberCategory
 * @property Qualification[] $mQualifications
 * @property Specialization[] $mSpecializations
 */
class UserDetail extends \yii\db\ActiveRecord {

	public $qualifications;
	public $specializations;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_detail}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['user_id', 'membership_number', 'member_category_id', 'present_position', 'permanent_address', 'phone_office', 'phone_mobile', 'professional_qualifications', 'qualifications', 'specializations'], 'required'],
			[['user_id', 'member_category_id'], 'integer'],
			[['professional_qualifications'], 'string'],
			[['membership_number', 'present_position'], 'string', 'max' => 50],
			[['affiliation', 'official_address', 'permanent_address'], 'string', 'max' => 200],
			[['phone_office', 'phone_residence', 'phone_mobile'], 'string', 'max' => 15]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'user_id' => 'User ID',
			'membership_number' => 'Membership Number',
			'member_category_id' => 'Member Category ID',
			'present_position' => 'Present Position',
			'affiliation' => 'Affiliation',
			'official_address' => 'Official Address',
			'permanent_address' => 'Permanent Address',
			'phone_office' => 'Phone Office',
			'phone_residence' => 'Phone Residence',
			'phone_mobile' => 'Phone Mobile',
			'professional_qualifications' => 'Professional Qualifications',
			'qualifications' => 'Academic Qualifications',
			'specializations' => 'Area of Specialization',
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
	public function getMemberCategory()
	{
		return $this->hasOne(UserCategory::className(), ['id' => 'member_category_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMQualifications()
	{
		return $this->hasMany(Qualification::className(), ['id' => 'qualification_id'])
				->viaTable(UserQualifications::tableName(), ['user_id' => 'user_id']);
	}

	public function getFormattedMQualifications()
	{
		$stringQ = '';
		foreach ($this->mQualifications as $q) {
			$stringQ .= $q->name . ', ';
		}
		return rtrim($stringQ, ', ');
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMSpecializations()
	{
		return $this->hasMany(Specialization::className(), ['id' => 'specialization_id'])
				->viaTable(UserSpecializations::tableName(), ['user_id' => 'user_id']);
	}

	public function getFormattedMSpecializations()
	{
		$stringS = '';
		foreach ($this->mSpecializations as $s) {
			$stringS .= $s->name . ', ';
		}
		return rtrim($stringS, ', ');
	}

}
