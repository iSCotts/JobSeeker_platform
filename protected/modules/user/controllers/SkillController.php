<?php

class SkillController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Skill'),
		));
	}

	public function actionCreate() {
		$model = new Skill;


		if (isset($_POST['Skill'])) {
			$model->setAttributes($_POST['Skill']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
                                {
					$this->redirect(array('view', 'id' => $model->id));
                                }
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Skill');


		if (isset($_POST['Skill'])) {
			$model->setAttributes($_POST['Skill']);

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
			$this->loadModel($id, 'Skill')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
                $criteria = new CDbCriteria;
                $uid=yii::app()->user->id;
                $mySkills = CHtml::listData(UserSkill::model()->findAllByAttributes(array('user_id'=>$uid)),'skills_id','skills_id');
                $criteria->condition = "approved=1";
                $criteria->addNotInCondition('id',$mySkills);
		$dataProvider = new CActiveDataProvider('Skill',array(
                        'criteria'=>$criteria,
                )
                        
                        );
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Skill('search');
		$model->unsetAttributes();

		if (isset($_GET['Skill']))
			$model->setAttributes($_GET['Skill']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}