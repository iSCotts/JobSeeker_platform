<?php

class JobResponseController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update','applyForJob'),
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
			'model' => $this->loadModel($id, 'JobResponse'),
		));
	}
        
        
	public function actionCreate() {
		$model = new JobResponse;


		if (isset($_POST['JobResponse'])) {
			$model->setAttributes($_POST['JobResponse']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
        
        public function actionApplyForJob()
        {
            $model = new JobResponse;
            
            
            $jid = null;
            if(isset($_GET['jid']))
            {
                $jid=$_GET['jid'];
            }
            else if (isset($_POST['jid']))
            {
                $jid=$_POST['jid'];
            }
            $jobPost = JobPost::model()->findByAttributes(array('id'=>$jid));
            
            if($jobPost!=NULL)
            {
                if($jobPost->close_applications == 0)
                {
                    $record = JobResponse::model()->exists("job_post_id =:jid AND user_id =:user_id",array(':jid'=>$jid,':user_id'=>yii::app()->user->id));
                    
                    if(!$record)
                    {
                        $model->job_post_id = $jid;
                        $model->user_id = yii::app()->user->id;
                        $user =  User::model()->findByPk(yii::app()->user->id);
                        $user->profile->is_job_seeker = 1;
                        if($model->save() && $user->profile->save())
                        {
                            
                            Yii::app()->user->setFlash('success', "application successful");
                            $this->redirect(array("jobPost/view","id"=>$jid));
                        }
                        else
                        {
                            Yii::app()->user->setFlash('error', "Something when wrong with you application");
                            $this->redirect(array("jobPost/view","id"=>$jid));
                        }
                    }
                    else
                    {
                        Yii::app()->user->setFlash('info', "You have already applied for this job");
                        $this->redirect(array("jobPost/view","id"=>$jid));
                    }
                }
                else
                {
                    Yii::app()->user->setFlash('info', "Sorry applications for this job have already closed");
                    $this->redirect(array("jobPost/view","id"=>$jid));
                }
                
            }
                
        }

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'JobResponse');


		if (isset($_POST['JobResponse'])) {
			$model->setAttributes($_POST['JobResponse']);

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
			$this->loadModel($id, 'JobResponse')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('JobResponse');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new JobResponse('search');
		$model->unsetAttributes();

		if (isset($_GET['JobResponse']))
			$model->setAttributes($_GET['JobResponse']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}