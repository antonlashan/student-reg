<?php

namespace backend\controllers;

use Yii;
use backend\models\UserSearch;
use common\models\Qualification;
use common\models\UserQualifications;
use common\models\User;
use common\models\UserCategory;
use common\models\UserDetail;
use common\models\UserSpecializations;
use common\models\Specialization;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller {

	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all User models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new UserSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single User model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
				'model' => $this->findModel($id),
		]);
	}

	/**
	 * Updates an existing User model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$user = $this->findModel($id);
		
		$userDetail = $user->userDetail;
		if (!$userDetail)
			$userDetail = new UserDetail();

		$userDetail->qualifications = ArrayHelper::map(UserQualifications::findAll(['user_id' => $user->id]), 'qualification_id', 'qualification_id');
		$userDetail->specializations = ArrayHelper::map(UserSpecializations::findAll(['user_id' => $user->id]), 'specialization_id', 'specialization_id');

		if ($user->load(Yii::$app->request->post()) && $user->save()) {
			if ($userDetail->load(Yii::$app->request->post())) {
				$userDetail->user_id = $user->id;
				if ($userDetail->save()) {
					
					//delete insert qualifications
					UserQualifications::deleteAll(['user_id' => $user->id]);
					if (!empty($userDetail->qualifications)) {

						foreach ($userDetail->qualifications as $qualificationId) {
							$uQualifications = new UserQualifications();
							$uQualifications->qualification_id = $qualificationId;
							$uQualifications->user_id = $user->id;
							$uQualifications->save();
						}
					}

					//delete insert specializations
					UserSpecializations::deleteAll(['user_id' => $user->id]);
					if (!empty($userDetail->specializations)) {

						foreach ($userDetail->specializations as $specializationId) {
							$uSpecializations = new UserSpecializations();
							$uSpecializations->specialization_id = $specializationId;
							$uSpecializations->user_id = $user->id;
							$uSpecializations->save();
						}
					}
					return $this->redirect(['view', 'id' => $user->id]);
				}
			}
		}

		$memberCategoryList = ArrayHelper::map(UserCategory::findAll(['status' => UserCategory::STATUS_ACTIVE]), 'id', 'name');
		$qualificationList = ArrayHelper::map(Qualification::findAll(['status' => Qualification::STATUS_ACTIVE]), 'id', 'name');
		$specializationList = ArrayHelper::map(Specialization::findAll(['status' => Specialization::STATUS_ACTIVE]), 'id', 'name');

		return $this->render('update', [
				'user' => $user,
				'userDetail' => $userDetail,
				'memberCategoryList' => $memberCategoryList,
				'qualificationList' => $qualificationList,
				'specializationList' => $specializationList,
		]);
	}
	
	public function actionUpdateStatus($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			if ($model->status == User::STATUS_ACTIVE)
				\Yii::$app->mailer->compose(['html' => 'activateMember-html', 'text' => 'activateMember-text'], ['user' => $model])
					->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name])
					->setTo($model->email)
					->setSubject('Profile activated')
					->send();

			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update_status', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing User model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the User model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return User the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
