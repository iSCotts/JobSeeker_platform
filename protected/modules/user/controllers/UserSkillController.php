<?php

class UserSkillController extends GxController {

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
				'actions'=>array('minicreate', 'create','update','SelectUserSkill','ViewMySkills','removeUserSkill'),
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
			'model' => $this->loadModel($id, 'UserSkill'),
		));
	}

	public function actionCreate() {
		$model = new UserSkill;


		if (isset($_POST['UserSkill'])) {
			$model->setAttributes($_POST['UserSkill']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
        
        public function actionSelectUserSkill()
        {
            $sid = null;
            if(isset($_GET['sid']))
            {
                $sid=$_GET['sid'];
            }
            else if (isset($_POST['sid']))
            {
                $sid=$_POST['sid'];
            }
            
            $record = UserSkill::model()->exists("skills_id =:sid AND user_id =:user_id",array(':sid'=>$sid,':user_id'=>yii::app()->user->id));
            
            if(!$record)
            {
                $skill = new UserSkill;
                $skill->skills_id=$sid;
                $skill->user_id = Yii::app()->user->id;
                $skill->save();

                $user = User::model()->active()->findbyPk(Yii::app()->user->id);
                $user->profile->has_selected_skills=1;
                $user->profile->is_job_seeker=1;
                $user->profile->save();
                
                Yii::app()->user->setFlash('success', "You have succesfully selected a skill");
                $this->redirect(array('/user/skill'));                
            }
            else
            {
                Yii::app()->user->setFlash('error', "You have already selected this skill");
                $this->redirect(array('/user/skill'));
            }
        }
        
        public function actionRemoveUserSkill()
        {
            $sid = null;
            if(isset($_GET['sid']))
            {
                $sid=$_GET['sid'];
            }
            else if (isset($_POST['sid']))
            {
                $sid=$_POST['sid'];
            }
            
            $userSkill = UserSkill::model()->findByPk($sid);
            if($userSkill!=null)
            {
                $userSkill->delete();
                
                Yii::app()->user->setFlash('success', "You have succesfully removed a skill");
                $this->redirect(array('/user/profile'));
            }
            else
            {
                Yii::app()->user->setFlash('Error', "You do not have such a skill");
                $this->redirect(array('/user/profile'));
            }
            
        }

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'UserSkill');


		if (isset($_POST['UserSkill'])) {
			$model->setAttributes($_POST['UserSkill']);

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
			$this->loadModel($id, 'UserSkill')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('UserSkill');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}
        
        public function actionViewMySkills()
        {
            $criteria=new CDbCriteria;
                
                $uid =yii::app()->user->id;
                $criteria->compare('user_id',yii::app()->user->id,false);
                $dataProvider = new CActiveDataProvider('Userskill', array(
			'criteria'=>$criteria,
                    ));
                if(empty($dataProvider->data)) {
                    
                    $this->redirect(array('/user/skill'));Yii::app()->user->setFlash('Error', "You do not have any skills");
                } else $this->render('index',array(
                            'dataProvider'=>$dataProvider,
                 ));
                
        }

	public function actionAdmin() {
		$model = new UserSkill('search');
		$model->unsetAttributes();

		if (isset($_GET['UserSkill']))
			$model->setAttributes($_GET['UserSkill']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}