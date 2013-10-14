<?php

class JobNotificationController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index', 'view'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create', 'update', 'admin', 'delete'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'JobNotification'),
		));
	}

	public function actionCreate() {
		$model = new JobNotification;


		if (isset($_POST['JobNotification'])) {
			$model->setAttributes($_POST['JobNotification']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'JobNotification');


		if (isset($_POST['JobNotification'])) {
			$model->setAttributes($_POST['JobNotification']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'JobNotification')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
                $criteria =new CDbCriteria;
                $uid = yii::app()->user->id;
                $criteria->condition = "receiver_id = $uid";
                $criteria->order = "time_sent DESC";
		$dataProvider = new CActiveDataProvider('JobNotification',array(
                        'criteria'=>$criteria,
                ));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new JobNotification('search');
		$model->unsetAttributes();

		if (isset($_GET['JobNotification']))
			$model->setAttributes($_GET['JobNotification']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}