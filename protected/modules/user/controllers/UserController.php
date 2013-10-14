<?php

class UserController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(),array(
			'accessControl', // perform access control for CRUD operations
		));
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','viewAccount','ViewContractors','JobHistory','ViewJobsPendingDecesion','ViewActiveJobsAsEmployer','ViewActiveJobsAsContractor'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        public function actionViewMySkills()
        {
            $criteria=new CDbCriteria;
                
                $uid =yii::app()->user->id;
                $criteria->compare('user_id',yii::app()->user->id,false);
                $dataProvider = new CActiveDataProvider('Userskill', array(
			'criteria'=>$criteria,
                    ));
                $this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
        }
        
        public function actionJobHistory($id)
        {
            
            
            //dataprovider
            $criteria=new CDbCriteria;
                $criteria->compare('to_user_id',$id,false);
                $dataProvider = new CActiveDataProvider('Review', array(
			'criteria'=>$criteria,
                    ));
            $average = null;    
            if(count($dataProvider->getData())>0)
            {
                //:Looking for the overall average
                $reviews = $dataProvider->getData();
                
                $sum=null;
                $count = count($reviews);
                foreach($reviews as $review)
                {
                    $sum += $review->avg;
                }
                $average = ($sum/$count);
            }
            
            
            //loading the view
                $this->render('viewJobHistory',array(
			'dataProvider'=>$dataProvider,
                        'average'=>$average,
		));
        }
        
        public function actionViewActiveJobsAsContractor()
         {
             $uid=yii::app()->user->id;
             $jResp = JobResponse::model()->findAllByAttributes(array('user_id'=>$uid));
                $criteria = new CDbCriteria;
//                $criteria->with='jobResponses';
//                $criteria->together=true;
                $criteria->condition = "job_Completed IS NULL";
                $criteria->addInCondition('awarded_to',$jResp);
                
                $activeJobData = new CActiveDataProvider('JobPost',array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                                'pageSize'=>'2',
                    ),
                    )

                );
                
                $this->render('viewActivejobs',array(
			'dataProvider'=>$activeJobData,
		));
                
                
         }
         
         public function actionViewActiveJobsAsEmployer()
         {
             $uid=yii::app()->user->id;
                $criteria = new CDbCriteria;
                $criteria->condition = "job_Completed IS NULL AND user_id=$uid AND awarded_to IS NOT NULL";
                
                $activeJobData = new CActiveDataProvider('JobPost',array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                                'pageSize'=>'2',
                    ),
                    )

                );
                
                $this->render('viewActivejobs',array(
			'dataProvider'=>$activeJobData,
		));
                
                
         }
         
         public function actionViewJobsPendingDecesion()
         {
             $uid=yii::app()->user->id;
                $criteria = new CDbCriteria;
                $criteria->condition = "user_id=$uid AND awarded_to IS NULL OR job_completed IS NULL OR has_review NOT IN ($uid,3)";
                
                $activeJobData = new CActiveDataProvider('JobPost',array(
                    'criteria'=>$criteria,
                    'pagination'=>array(
                                'pageSize'=>'2',
                    ),
                    )

                );
                
                $this->render('viewActivejobs',array(
			'dataProvider'=>$activeJobData,
		));
                
                
         }

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
                $criteria=new CDbCriteria;
                $uid =yii::app()->user->id;
                $criteria->compare('user_id',$_GET['id']);
                $dataProvider = new CActiveDataProvider('Userskill', array(
			'criteria'=>$criteria,
                    ));
                
		$model = $this->loadModel();
		$this->render('view',array(
			'model'=>$model,
                        'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>array(
		        'condition'=>'status>'.User::STATUS_BANED,
		    ),
				
			'pagination'=>array(
				'pageSize'=>Yii::app()->controller->module->user_page_size,
			),
		));

		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        
        public function actionViewAccount()
        {
            $user = $this->loadUser(yii::app()->user->id); //User::model()->findByPk(yii::app()->user->id);
            if(false)
            {
                $newAcc = new Account;
                $newAcc->balance=0.0;
                $newAcc->save();
                $user->account_id = $newAcc->id;
                $user->save();
            }
            //$user = User::model()->findByPk(yii::app()->user->id);
            $this->render('account',array('model'=>$user));
            
        }
        
        public function actionViewContractors()
        {
          
                
            $dataProvider = new CActiveDataProvider('User',array(
               'criteria'=>array(
                   'with'=>array('profile'),
                   'condition'=>'profile.is_job_seeker=1',
                   'together'=>true,
               ) 
            ));
            
            $user = new User;
            
            $this->render('viewContractors',array(
               'dataProvider'=>$dataProvider, 
            ));
        }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
	 */
	public function loadUser($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=User::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
}
