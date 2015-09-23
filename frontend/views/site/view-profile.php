<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserDetail;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$this->title = 'Profile - ' . $user->full_name;
$this->params['breadcrumbs'][] = $this->title;
$userId = \Yii::$app->user->id;
?>
<div class="user-category-view">


	<?php if ($canManage) { ?>
		<p>
		    <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update-profile'], ['class' => 'btn btn-primary']) ?>
		    <?= Html::a('<span class="glyphicon glyphicon-asterisk"></span> Change Password', ['change-password'], ['class' => 'btn btn-primary']) ?>
		</p>
	<?php } ?>

	<?=
	DetailView::widget([
		'model' => $user,
		'attributes' => [
			[
				'attribute' => 'title',
				'value' => $user->getTitleLabel(),
			],
			'full_name',
			[
				'attribute' => 'email',
				'value' => $user->email,
				'format' => 'email',
				'visible' => (($user->id == $userId) || $user->id != $userId && $user->userDetail && $user->userDetail->visibility_email == UserDetail::VISIBILITY_EMAIL_YES)
			],
		],
	])
	?>

	<?php if ($user->userDetail) { ?>
		<p>Member Details</p>
		<?=
		DetailView::widget([
			'model' => $user->userDetail,
			'attributes' => [
				'membership_number',
				[
					'attribute' => 'member_category_id',
					'value' => $user->userDetail->memberCategory->name,
					'visible' => $canManage
				],
				'present_position',
				'affiliation',
				[
					'attribute' => 'phone_office',
					'value' => $user->userDetail->phone_office,
					'visible' => (($user->id == $userId) || $user->userDetail->visibility_phone_office == UserDetail::VISIBILITY_PHONE_OFFICE_YES)
				],
				[
					'attribute' => 'phone_residence',
					'value' => $user->userDetail->phone_residence,
					'visible' => (($user->id == $userId) || $user->userDetail->visibility_phone_residence == UserDetail::VISIBILITY_PHONE_RESIDENCE_YES)
				],
				[
					'attribute' => 'phone_mobile',
					'value' => $user->userDetail->phone_mobile,
					'visible' => (($user->id == $userId) || $user->userDetail->visibility_phone_mobile == UserDetail::VISIBILITY_PHONE_MOBILE_YES)
				],
				[
					'attribute' => 'official_address',
					'value' => $user->userDetail->official_address,
					'visible' => (($user->id == $userId) || $user->userDetail->visibility_official_address == UserDetail::VISIBILITY_OFFICIAL_ADDRESS_YES)
				],
				[
					'attribute' => 'permanent_address',
					'value' => $user->userDetail->permanent_address,
					'visible' => (($user->id == $userId) || $user->userDetail->visibility_permanent_address == UserDetail::VISIBILITY_PERMANENT_ADDRESS_YES)
				],
				'professional_qualifications',
				[
					'attribute' => 'qualifications',
					'value' => $user->userDetail->getFormattedMQualifications(),
				],
				[
					'attribute' => 'specializations',
					'value' => $user->userDetail->getFormattedMSpecializations(),
				],
			],
		])
		?>

		<?php if ($user->id == $userId) { ?>
			<p>Visibility</p>
			<?=
			DetailView::widget([
				'model' => $user->userDetail,
				'attributes' => [
					[
						'attribute' => 'visibility_email',
						'value' => $user->userDetail->getVisibilityEmailLabel(),
					],
					[
						'attribute' => 'visibility_official_address',
						'value' => $user->userDetail->getVisibilityOfficialAddressLabel(),
					],
					[
						'attribute' => 'visibility_permanent_address',
						'value' => $user->userDetail->getVisibilityPermanentAddressLabel(),
					],
					[
						'attribute' => 'visibility_phone_office',
						'value' => $user->userDetail->getVisibilityPhoneOfficeLabel(),
					],
					[
						'attribute' => 'visibility_phone_residence',
						'value' => $user->userDetail->getVisibilityPhoneResidenceLabel(),
					],
					[
						'attribute' => 'visibility_phone_mobile',
						'value' => $user->userDetail->getVisibilityPhoneMobileLabel(),
					],
				],
			])
			?>
		<?php } ?>
	<?php } ?>

</div>
