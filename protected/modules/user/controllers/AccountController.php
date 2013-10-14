<?php

class AccountController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index', 'view','ViewAccount','Deposit','ManagePayments','MakePayment'),
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
    
        public function actionDeposit()
        {
            $uid=yii::app()->user->id;
            $model = Account::model()->findByAttributes(array('user_id'=>$uid));

		if (isset($_POST['Account'])) {
			//$model->setAttributes($_POST['Account']);
                        
                        $model->balance =$model->balance + $_POST['Account']['deposit'];
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('deposit', array('model' => $model,));
        }
        
        public function actionPayUser($uid,$pay)
        {
            $user = User::model()->findByPk($uid);
            $user->account->balance = $user->account->balance + $pay;
            if($user->account->save())
            {
                return true;
            }
            
            return false;
        }
        
        public function actionManagePayments()
        {
                $model = new JobPost('search');
		$model->unsetAttributes();
                if (isset($_GET['JobPost']))
			$model->setAttributes($_GET['JobPost']);
                
                if(isset($_POST['JobPost']))
                {
                    if(isset($_POST['checkBoxValue']))
                    {
                        foreach($_POST['checkBoxValue'] as $job_id)
                        {
                            $user = User::model()->findByPk(yii::app()->user->id);
                           $job = JobPost::model()->findByPk($job_id);
                           if($job->budget < $user->account->balance)
                           {
                               $user->account->balance = $user->account->balance - $job->budget;
                               $user->account->save();
                               $job->paid =1;
                               $job->save();
                               $uid = $job->awardedTo->user_id;
                               if($this->actionPayUser($uid,$job->budget))
                               {
                                   yii::app()->getModule('user')->notifyUserAboutPayment($job_id,$uid);
                               }
                           }
                        }
                        
                    }
                    else
                    {
                        
                    }
                }
                
                $dataProvider = new CActiveDataProvider('JobPost',array(
                    //'criteria'=>$criteria,
                    )

                );
                
                $this->render('managePayments',array(
			'dataProvider'=>$dataProvider,
                        'model'=>$model,
		));
        }
        
        public function actionViewAccount()
        {
            $uid = yii::app()->user->id;
            $acc = Account::model()->findByAttributes(array('user_id'=>$uid));
            if($acc==null)
            {
                $newAcc = new Account;
                $newAcc->user_id = $uid;
                $newAcc->save();
                $acc = Account::model()->findByAttributes(array('user_id'=>$uid));
//                $newAcc->balance = 0.0;
            }
            
            $this->render('view', array('model' => $acc));
        }

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Account'),
		));
	}

	public function actionCreate() {
		$model = new Account;


		if (isset($_POST['Account'])) {
			$model->setAttributes($_POST['Account']);

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
		$model = $this->loadModel($id, 'Account');


		if (isset($_POST['Account'])) {
			$model->setAttributes($_POST['Account']);

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
			$this->loadModel($id, 'Account')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Account');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Account('search');
		$model->unsetAttributes();

		if (isset($_GET['Account']))
			$model->setAttributes($_GET['Account']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}