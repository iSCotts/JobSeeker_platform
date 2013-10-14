<?php

Yii::import('application.modules.message.models._base.BaseResponse');

class Response extends BaseResponse
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function relations() {
		return array(
			'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
			'receiver' => array(self::BELONGS_TO, 'User', 'receiver_id'),
			'message' => array(self::BELONGS_TO, 'Message', 'message_id'),
			'responseData' => array(self::HAS_MANY, 'ResponseData', 'response_id'),
		);
	}
        
        public function beforeValidate(){
            if($this->isNewRecord)
            {
               // $this->sender_id= yii::app()->user->id;
                $this->time_sent= new CDbExpression('NOW()');
            }
            
            return parent::beforeValidate();
            
        }
        
        public function afterSave()
        {
            //Message data for sender
                $responseData = new ResponseData;
                $responseData->user_id=$this->sender_id;
                $responseData->response_id=$this->id;
                $responseData->is_read=0;
                $responseData->is_deleted=0;
                $responseData->starred=0;
                $responseData->is_sent=1;
                $responseData->is_received=0;
                $responseData->save();
                
             //Message Data for receiver
                $responseData = new ResponseData;
                $responseData->user_id=$this->receiver_id;
                $responseData->response_id=$this->id;
                $responseData->is_read=0;
                $responseData->is_deleted=0;
                $responseData->starred=0;
                $responseData->is_sent=1;
                $responseData->is_received=1;
                $responseData->save();
                
                return parent::afterSave();
        }
}