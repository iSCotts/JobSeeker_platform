<?php

class MessageController extends GxController {

    public $defaultAction = 'Inbox';
    
    
    
    public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view','inbox','outbox'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update','delete'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}
    
	public function actionView($id) {
            
            $message=$this->loadModel($id,'Message');
            if($message!=null)
            {
                $message->markAsRead();
            }
            $response = $this->createResponse($message);
		$this->render('view',array(
			'model'=>$message,
                        'response'=>$response,
		));
	}
        
        protected function createResponse($message)
        {
            $response=new Response;
            if(isset($_POST['Response']))
            {
                $response->attributes=$_POST['Response'];
                $message->updated_message_time= new CDbExpression('NOW()');
                if($message->addResponse($response)) //makes sure response gets its message_id
                {
                    //$message->notify();
                    Yii::app()->user->setFlash('success',"<strong>Your reply has been sent.</string>" );
                    $this->refresh();
                    
                }
            }
            return $response;
        }

	public function actionCreate() {
		$model = new Message;


		if (isset($_POST['Message'])) {
			$model->setAttributes($_POST['Message']);
			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}
        
        /*
         * will be used to filter the messages to only the inbox
         */
        public function actionInbox()
        {
            $criteria=new CDbCriteria;
                
                $uid =yii::app()->user->id;
                
		$criteria->with='messageData';
                $criteria->compare('receiver_id',yii::app()->user->id,false);
                $criteria->compare('messageData.is_received',1,false,'or');
                $criteria->compare('messageData.user_id',$uid,false,'and');
                $criteria->compare('messageData.is_deleted',0,false,'and');
                $criteria->order = "updated_message_time DESC";
                $criteria->together=true;
                   
                //$messageData=MessageData::model()->findbyAttributes(array('user_id'=>yii::app()->user->id));
                $dataProvider = new CActiveDataProvider('Message', array(
			'criteria'=>$criteria,
                        
                        /*'pagination'=>(array(
                            'pageSize'=>1,
                        ))*/
		));
                $this->render('inbox',array(
			'dataProvider'=>$dataProvider,//'messageData'=>$messageData,
		));
        }
        
        /*
         * will be used to filter the messages to only the outbox
         */
        public function actionOutbox()
        {
            $criteria=new CDbCriteria;
                
                $uid =yii::app()->user->id;
                
		$criteria->with='messageData';
                $criteria->compare('sender_id',yii::app()->user->id,false);
                $criteria->compare('messageData.is_sent',1,false,'or');
                $criteria->compare('messageData.user_id',$uid,false,'and');
                $criteria->compare('messageData.is_deleted',0,false,'and');
                $criteria->order = "updated_message_time DESC";
                $criteria->together=true;
                        
                $dataProvider = new CActiveDataProvider('Message', array(
			'criteria'=>$criteria,
                        /*'pagination'=>(array(
                            'pageSize'=>1,
                        ))*/
		));
                $this->render('outbox',array(
			'dataProvider'=>$dataProvider,
		));
        }

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Message');


		if (isset($_POST['Message'])) {
			$model->setAttributes($_POST['Message']);

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
			$this->loadModel($id, 'Message')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
            $this->actionInbox();
	/*	$dataProvider = new CActiveDataProvider('Message');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));*/
	}

	public function actionAdmin() {
		$model = new Message('search');
		$model->unsetAttributes();

		if (isset($_GET['Message']))
			$model->setAttributes($_GET['Message']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}