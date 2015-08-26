<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$this->title = 'Profile - ' . $user->full_name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-category-view">


	<?php if ($canManage) { ?>
		<p>
		    <?= Html::a('Update', ['update-profile', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
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
			'email:email',
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
				'phone_office',
				'phone_residence',
				'phone_mobile',
				'official_address',
				'permanent_address',
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
	<?php } ?>

</div>
