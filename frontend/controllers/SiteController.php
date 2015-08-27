<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\Qualification;
use common\models\User;
use common\models\UserCategory;
use common\models\UserDetail;
use common\models\UserQualifications;
use frontend\models\UserSearch;
use common\models\UserSpecializations;
use common\models\Specialization;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller {

	public $defaultAction = 'login';

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new UserSearch();
		if (Yii::$app->request->queryParams)
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		else
			$dataProvider = null;

		return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			if (UserDetail::find()->where(['user_id' => Yii::$app->user->id])->count()) {
				return $this->goBack();
			}
			return $this->redirect(['site/update-profile']);
		} else {
			return $this->render('login', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending email.');
			}

			return $this->refresh();
		} else {
			return $this->render('contact', [
					'model' => $model,
			]);
		}
	}

	/**
	 * Displays about page.
	 *
	 * @return mixed
	 */
	public function actionAbout()
	{
		return $this->render('about');
	}

	/**
	 * Signs user up.
	 *
	 * @return mixed
	 */
	public function actionSignup()
	{
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($user = $model->signup()) {
				Yii::$app->session->setFlash('info', 'Activate later, check your inbox.');
				if (Yii::$app->getUser()->login($user)) {
					return $this->goHome();
				}
			}
		}

		return $this->render('signup', [
				'model' => $model,
		]);
	}

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionRequestPasswordReset()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail()) {
				Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

				return $this->goHome();
			} else {
				Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
			}
		}

		return $this->render('requestPasswordResetToken', [
				'model' => $model,
		]);
	}

	/**
	 * Resets password.
	 *
	 * @param string $token
	 * @return mixed
	 * @throws BadRequestHttpException
	 */
	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->session->setFlash('success', 'New password was saved.');

			return $this->goHome();
		}

		return $this->render('resetPassword', [
				'model' => $model,
		]);
	}

	public function actionUpdateProfile()
	{
		$user = $this->findUserModel(Yii::$app->user->id);

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
					return $this->redirect(['view-profile']);
				}
			}
		}

		$memberCategoryList = ArrayHelper::map(UserCategory::findAll(['status' => UserCategory::STATUS_ACTIVE]), 'id', 'name');
		$qualificationList = ArrayHelper::map(Qualification::findAll(['status' => Qualification::STATUS_ACTIVE]), 'id', 'name');
		$specializationList = ArrayHelper::map(Specialization::findAll(['status' => Specialization::STATUS_ACTIVE]), 'id', 'name');

		return $this->render('update-profile', [
				'user' => $user,
				'userDetail' => $userDetail,
				'memberCategoryList' => $memberCategoryList,
				'qualificationList' => $qualificationList,
				'specializationList' => $specializationList,
		]);
	}

	public function actionViewProfile()
	{
		$user = $this->findUserModel(Yii::$app->user->id);

		return $this->render('view-profile', [
				'user' => $user,
				'canManage' => TRUE,
		]);
	}

	protected function findUserModel($id)
	{
		if (($model = User::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionViewMember($id)
	{
		$user = $this->findUserModel($id);

		return $this->render('view-profile', [
				'user' => $user,
				'canManage' => FALSE,
		]);
	}

}
