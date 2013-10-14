<?php

class NotificationsController extends GxController {

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
                $model = $this->loadModel($id, 'Notifications');
                $model->is_read = 1;
                $model->save();
                //make sure you load different view for every type of notification
                if($model->notificationType->type=="awarded_job")
                {
                    $this->render('view', array('model' => $model,));
                }
                elseif($model->notificationType->type=="job_invite")
                {
                    $this->render('view', array('model' => $model,));
                }
                elseif($model->notificationType->type=="skill_approved")
                {
                    $this->render('view', array('model' => $model,));
                }
                elseif($model->notificationType->type=="pay_received")
                {
                    $this->render('view', array('model' => $model,));
                }
                else
                {
                    $this->actionIndex();
                }
		
	}

	public function actionCreate() {
		$model = new Notifications;


		if (isset($_POST['Notifications'])) {
			$model->setAttributes($_POST['Notifications']);

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
		$model = $this->loadModel($id, 'Notifications');


		if (isset($_POST['Notifications'])) {
			$model->setAttributes($_POST['Notifications']);

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
			$this->loadModel($id, 'Notifications')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
                $criteria =new CDbCriteria;
                $uid = yii::app()->user->id;
                $criteria->condition = "receiver_id = $uid";
                $criteria->order = "time_sent desc";
		$dataProvider = new CActiveDataProvider('Notifications',array('criteria'=>$criteria));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Notifications('search');
		$model->unsetAttributes();

		if (isset($_GET['Notifications']))
			$model->setAttributes($_GET['Notifications']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}