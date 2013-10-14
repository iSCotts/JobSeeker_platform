<?php

class MessageModule extends CWebModule
{
        public $inboxUrl = array("/message/message");
        public $defaultController = "Message";
        
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'message.models.*',
			'message.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
        
        public function getNewMessageCount()
        {
            $criteria = new CDbCriteria;
            $criteria->compare('user_id',yii::app()->user->id,false);
            $criteria->compare('notify',1,false);
            
            $data= new CActiveDataProvider('MessageData',array(
                        'criteria'=>$criteria,
                    ));
            $count = count($data->getData());
            if($count > 0)
            {
                return CHtml::tag('span', array('class' => 'notif'), $count);
            }
            else{
                return '';
            }
        }
        
        
}
