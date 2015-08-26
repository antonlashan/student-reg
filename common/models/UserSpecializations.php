<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_specializations}}".
 *
 * @property integer $user_id
 * @property integer $specialization_id
 *
 * @property Specialization $specialization
 * @property User $user
 */
class UserSpecializations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_specializations}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'specialization_id'], 'integer'],
            [['user_id', 'specialization_id'], 'unique', 'targetAttribute' => ['user_id', 'specialization_id'], 'message' => 'The combination of User ID and Specialization ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'specialization_id' => 'Specialization ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
