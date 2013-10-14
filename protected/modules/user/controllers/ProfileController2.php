<?php

class ProfileController extends Controller
{
	public $defaultAction = 'profile';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
	/**
	 * Shows a particular model.
	 */
	public function actionProfile()
	{
		$model = $this->loadUser();
                $jobPostData=null;
                $uid=yii::app()->user->id;
                $jobPostData= new CActiveDataProvider('JobPost',array(
                    'criteria'=>array(
                        'condition'=>"user_id= $uid",
                        ),
					'pagination'=>array(
						'pageSize'=>'2',
						),
                    )
                        
                );
                
                $userSkills=null;
                $criteria=new CDbCriteria;
                
                $uid =yii::app()->user->id;
                $criteria->compare('user_id',yii::app()->user->id,false);
                $userSkills = new CActiveDataProvider('Userskill', array(
			'criteria'=>$criteria,
                    ));
                
                //$skillCount = $model->skills->count();
                if($model->profile->is_job_seeker==1 && $model->profile->has_selected_skills==0)
                {
                        $this->redirect(array('/user/skill'));
                }
                else
                {
                    $this->render('profile',array(
                            'model'=>$model,
                                    'profile'=>$model->profile,
                                    'skillsData'=>$userSkills,
                                    'jobPostData'=>$jobPostData,
                        ));
                }
	    
           // echo $model->profile->has_selected_skills;
	}
        
        /*
         *Set or update your skills set
         */
         public function actionSelectSkills()
         {
             $this->render('skills');
         }
         


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionEdit()
	{
		$model = $this->loadUser();
		$profile=$model->profile;
		
		// ajax validator
		if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
		
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$model->save();
				$profile->save();
				Yii::app()->user->setFlash('profileMessage',UserModule::t("Changes is saved."));
				$this->redirect(array('/user/profile'));
			} else $profile->validate();
		}

		$this->render('edit',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}
	
	/**
	 * Change password
	 */
	public function actionChangepassword() {
		$model = new UserChangePassword;
		if (Yii::app()->user->id) {
			
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='changepassword-form')
			{
				echo UActiveForm::validate($model);
				Yii::app()->end();
			}
			
			if(isset($_POST['UserChangePassword'])) {
					$model->attributes=$_POST['UserChangePassword'];
					if($model->validate()) {
						$new_password = User::model()->notsafe()->findbyPk(Yii::app()->user->id);
						$new_password->password = UserModule::encrypting($model->password);
						$new_password->activkey=UserModule::encrypting(microtime().$model->password);
						$new_password->save();
						Yii::app()->user->setFlash('profileMessage',UserModule::t("New password is saved."));
						$this->redirect(array("profile"));
					}
			}
			$this->render('changepassword',array('model'=>$model));
	    }
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser()
	{
		if($this->_model===null)
		{
			if(Yii::app()->user->id)
				$this->_model=Yii::app()->controller->module->user();
			if($this->_model===null)
				$this->redirect(Yii::app()->controller->module->loginUrl);
		}
		return $this->_model;
	}
}