<?php

class JobPostController extends GxController {

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
				'actions'=>array('minicreate', 'create','update','awardBid','ViewMyPosts','JobsForMe','jobComplete','dynamicUserWithSkill','loadImage'),
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
			'model' => $this->loadModel($id, 'JobPost'),
		));
	}
        
        public function actionJobComplete($id)
        {
//            $id = null;
//            if(isset($_GET['id']))
//            {
//                $id = $_GET['id'];
//            }
            if($id!=null)
            {
                $model = $this->loadModel($id, 'JobPost');
                $model->job_completed = 1;
                $model->has_review =0;
                if($model->save())
                $this->actionView($id);
            }
            else
            {
                return false;
            }
            
        }
        
        public function actionViewMyPosts() {
            $uid=yii::app()->user->id;
                $dataProvider = new CActiveDataProvider('JobPost',array(
                    'criteria'=>array(
                        'condition'=>"user_id= $uid",
                        ),
                    )
                        
                );
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}
        
        public function actionJobsForMe()
        {
                $uid=yii::app()->user->id;
                $mySkills = CHtml::listData(UserSkill::model()->findAllByAttributes(array('user_id'=>$uid)),'skills_id','skills_id');
                $criteria = new CDbCriteria;
                $criteria->condition = "close_applications=0 AND awarded_to IS NULL AND user_id != $uid";
                $criteria->addInCondition('skill_id',$mySkills);
                
                $dataProvider = new CActiveDataProvider('JobPost',array(
                    'criteria'=>$criteria,
                    )

                );
                $this->render('index', array(
                        'dataProvider' => $dataProvider,
                ));
        }

        public function actionCreate() {
		$model = new JobPost;
                //$image = new Image;

                
		if (isset($_POST['JobPost'])) {
			$model->setAttributes($_POST['JobPost']);
                        //$image = new Image;
                        //$image->image = $_POST['JobPost'];

			if ($model->save()) {
                            
                            //if(!empty($_FILES['JobPost']['tmp_name']['file']))
                            $files = CUploadedFile::getInstancesByName('images');
                            if(!empty($files))
                            {
                                foreach($files as $file)
                                {
                                    $image = new Image;
                                    $image->file_name = $file->name;
                                    $image->file_type = $file->type;
                                    $fp = fopen($file->tempName, 'r');
                                    $content = fread($fp, filesize($file->tempName));
                                    fclose($fp);
                                    $image->image = $content;
                                    $image->job_post_id = $model->id;
                                    $image->save();
                                }
                                
                            }
                            
                            
                            if(isset($_POST['inviteList']))
                            {
                                yii::app()->getModule('user')->inviteUsers($_POST['inviteList'],$model->id);
                            }
                                if (Yii::app()->getRequest()->getIsAjaxRequest())
                                        Yii::app()->end();
                                else
                                        $this->redirect(array('view', 'id' => $model->id));
                            
                            
			}
		}

		$this->render('create', array( 'model' => $model));
	}
        
        public function actionloadImage($id)
        {
            //$model = $this->loadModel($id, 'JobPost');
            $image = Image::model()->findByPk($id);
            $this->renderPartial('image', array('model'=>$image));
        }
        
        public function actionDynamicUserWithSkill()
        {
            
            $skill_id = $_POST['JobPost']['skill_id'];
            $users = UserSkill::model()->findAllByAttributes(array('skills_id'=>$skill_id));
            foreach($users as $user)
            {
                if($user->user->id!=Yii::app()->user->id)
                {
                    echo CHtml::tag('option',array('value'=>$user->user->id),CHtml::encode($user->user->username),true);
                }
                
            }
        }

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'JobPost');


		if (isset($_POST['JobPost'])) {
			$model->setAttributes($_POST['JobPost']);

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
			$this->loadModel($id, 'JobPost')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
                $criteria = new CDbCriteria;
                $criteria->condition = "close_applications=0 AND awarded_to IS NULL";
		$dataProvider = new CActiveDataProvider('JobPost',array(
                    'criteria'=>$criteria,
                    ));
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new JobPost('search');
		$model->unsetAttributes();

		if (isset($_GET['JobPost']))
			$model->setAttributes($_GET['JobPost']);

		$this->render('admin', array(
			'model' => $model,
		));
	}
        
        public function actionAwardBid()
        {
            
            $jid = null;
            if(isset($_GET['jid']))
            {
                $jid=$_GET['jid'];
            }
            else if (isset($_POST['jid']))
            {
                $jid=$_POST['jid'];
            }
            
            $bid = null;
            if(isset($_GET['bid']))
            {
                $bid=$_GET['bid'];
            }
            else if (isset($_POST['bid']))
            {
                $bid=$_POST['bid'];
            }
            
            $jobPost = JobPost::model()->findByAttributes(array('id'=>$jid));
            $bid_user_id = JobResponse::model()->findByPk($bid)->user_id;
            if($jobPost!=NULL)
            {
                
                $jobPost->awarded_to = $bid;
                $jobPost->close_applications = 1;
                $jobPost->save();
//                echo CHtml::errorSummary()
                Yii::app()->getModule('user')->notifyUserAboutJob($jobPost->id,$bid_user_id);
                $this->redirect(array("jobPost/view","id"=>$jid));
            }
                
        }

}