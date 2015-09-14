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
 * @property string $payment_due_date
 * @property integer $payment_overdue
 * @property integer $visibility_email
 * @property integer $visibility_official_address
 * @property integer $visibility_permanent_address
 * @property integer $visibility_phone_office
 * @property integer $visibility_phone_residence
 * @property integer $visibility_phone_mobile
 *
 * @property User $user
 * @property UserCategory $memberCategory
 * @property Qualification[] $mQualifications
 * @property Specialization[] $mSpecializations
 */
class UserDetail extends \yii\db\ActiveRecord {

	public $qualifications;
	public $specializations;

	//overdue
	const OVERDUE_YES = 1;
	const OVERDUE_NO = 0;
	//visibility of email
	const VISIBILITY_EMAIL_YES = 1;
	const VISIBILITY_EMAIL_NO = 0;
	//visibility of email
	const VISIBILITY_OFFICIAL_ADDRESS_YES = 1;
	const VISIBILITY_OFFICIAL_ADDRESS_NO = 0;
	//visibility of permanent address
	const VISIBILITY_PERMANENT_ADDRESS_YES = 1;
	const VISIBILITY_PERMANENT_ADDRESS_NO = 0;
	//visibility of phone office
	const VISIBILITY_PHONE_OFFICE_YES = 1;
	const VISIBILITY_PHONE_OFFICE_NO = 0;
	//visibility of phone residence
	const VISIBILITY_PHONE_RESIDENCE_YES = 1;
	const VISIBILITY_PHONE_RESIDENCE_NO = 0;
	//visibility of phone mobile
	const VISIBILITY_PHONE_MOBILE_YES = 1;
	const VISIBILITY_PHONE_MOBILE_NO = 0;

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
			[['user_id', 'member_category_id', 'payment_overdue', 'visibility_email', 'visibility_official_address', 'visibility_permanent_address', 'visibility_phone_office', 'visibility_phone_residence', 'visibility_phone_mobile'], 'integer'],
			[['professional_qualifications'], 'string'],
			[['payment_due_date'], 'safe'],
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
			'member_category_id' => 'Member Category',
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
			'payment_due_date' => 'Payment Due Date',
			'payment_overdue' => 'Payment Overdue',
			'visibility_email' => 'Visibility Email',
			'visibility_official_address' => 'Visibility Official Address',
			'visibility_permanent_address' => 'Visibility Permanent Address',
			'visibility_phone_office' => 'Visibility Phone Office',
			'visibility_phone_residence' => 'Visibility Phone Residence',
			'visibility_phone_mobile' => 'Visibility Phone Mobile',
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

	public function getOverdueLabels()
	{
		return [
			self::OVERDUE_YES => 'Yes',
			self::OVERDUE_NO => 'No',
		];
	}

	public function getOverdueLabel()
	{
		return $this->getOverdueLabels()[$this->payment_overdue];
	}

	public function getVisibilityEmailLabels()
	{
		return [
			self::VISIBILITY_EMAIL_YES => 'Yes',
			self::VISIBILITY_EMAIL_NO => 'No',
		];
	}

	public function getVisibilityEmailLabel()
	{
		return $this->getVisibilityEmailLabels()[$this->visibility_email];
	}

	public function getVisibilityOfficialAddressLabels()
	{
		return [
			self::VISIBILITY_OFFICIAL_ADDRESS_YES => 'Yes',
			self::VISIBILITY_OFFICIAL_ADDRESS_NO => 'No',
		];
	}

	public function getVisibilityOfficialAddressLabel()
	{
		return $this->getVisibilityOfficialAddressLabels()[$this->visibility_official_address];
	}

	public function getVisibilityPermanentAddressLabels()
	{
		return [
			self::VISIBILITY_PERMANENT_ADDRESS_YES => 'Yes',
			self::VISIBILITY_PERMANENT_ADDRESS_NO => 'No',
		];
	}

	public function getVisibilityPermanentAddressLabel()
	{
		return $this->getVisibilityPermanentAddressLabels()[$this->visibility_permanent_address];
	}

	public function getVisibilityPhoneOfficeLabels()
	{
		return [
			self::VISIBILITY_PHONE_OFFICE_YES => 'Yes',
			self::VISIBILITY_PHONE_OFFICE_NO => 'No',
		];
	}

	public function getVisibilityPhoneOfficeLabel()
	{
		return $this->getVisibilityPhoneOfficeLabels()[$this->visibility_phone_office];
	}

	public function getVisibilityPhoneResidenceLabels()
	{
		return [
			self::VISIBILITY_PHONE_RESIDENCE_YES => 'Yes',
			self::VISIBILITY_PHONE_RESIDENCE_NO => 'No',
		];
	}

	public function getVisibilityPhoneResidenceLabel()
	{
		return $this->getVisibilityPhoneResidenceLabels()[$this->visibility_phone_residence];
	}

	public function getVisibilityPhoneMobileLabels()
	{
		return [
			self::VISIBILITY_PHONE_MOBILE_YES => 'Yes',
			self::VISIBILITY_PHONE_MOBILE_NO => 'No',
		];
	}

	public function getVisibilityPhoneMobileLabel()
	{
		return $this->getVisibilityPhoneMobileLabels()[$this->visibility_phone_mobile];
	}

}
