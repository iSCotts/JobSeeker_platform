<?php

class ReviewController extends GxController {

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
			'model' => $this->loadModel($id, 'Review'),
		));
	}

	public function actionCreate() {
		$model = new Review;
                $model->is_paid=0;
                $jid = null;
                $eid = null;
                $cid = null;
                 
                //get job Id
                if(isset($_GET['jid']))
                {
                    $jid=$_GET['jid'];
                }
                else if (isset($_POST['jid']))
                {
                    $jid=$_POST['jid'];
                }

                //get employer id
                if(isset($_GET['eid']))
                {
                    $eid=$_GET['eid'];
                }
                else if (isset($_POST['eid']))
                {
                    $eid=$_POST['eid'];
                }
                
                //getcontractor id
                if(isset($_GET['cid']))
                {
                    $cid=$_GET['cid'];
                }
                else if (isset($_POST['cid']))
                {
                    $cid=$_POST['cid'];
                }


		if (isset($_POST['Review'])) {
                        $model->job_post_id = $jid;
                        //$empRev = Review::model()->exists(array('job_post_id'=>$jid,)) check if review already exists
                        $x = $_POST['Review']['is_paid'];
                        $model->is_paid=$_POST['Review']['is_paid'];
                        $job = JobPost::model()->findByPk($jid);
                        If($eid == yii::app()->user->id)
                        {
                            $model->from_user_id=$eid;
                            $model->to_user_id=$cid;
                            $this->actionIsReviewed($job);
                        }
                        elseif($cid == yii::app()->user->id)
                        {
                            $model->from_user_id=$cid;
                            $model->to_user_id=$eid;
                            $this->actionIsReviewed($job);
                        }
                        
			$model->setAttributes($_POST['Review']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
        
        public function actionIsReviewed($jobModel)
        {
            if($jobModel->has_review == NULL || $jobModel->has_review == 0 )
            {
                $jobModel->has_review = yii::app()->user->id;
            }
            elseif($jobModel->has_review != NULL || $jobModel->has_review!=0)
            {
                $jobModel->has_review = 3;
            }
            return $jobModel->save();
        }

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Review');


		if (isset($_POST['Review'])) {
			$model->setAttributes($_POST['Review']);

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
			$this->loadModel($id, 'Review')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Review');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Review('search');
		$model->unsetAttributes();

		if (isset($_GET['Review']))
			$model->setAttributes($_GET['Review']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}