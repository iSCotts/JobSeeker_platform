<?php

Yii::import('application.modules.message.models._base.BaseMessage');

class Message extends BaseMessage
{
    
    protected $isUnread =true;
    
    public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function relations() {
		return array(
			'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
			'receiver' => array(self::BELONGS_TO, 'User', 'receiver_id'),
			'messageData' => array(self::HAS_MANY, 'MessageData', 'message_id'),
			'responses' => array(self::HAS_MANY, 'Response', 'message_id'),
		);
	}
        
        
        public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'title' => Yii::t('app', 'Title'),
			'message' => Yii::t('app', 'Message'),
			'sender_id' => Yii::t('app', 'Sender'),
			'receiver_id' => Yii::t('app', 'receiver'),
			'time_sent' => Yii::t('app', 'Time Sent'),
			'updated_message_time' => Yii::t('app', 'Updated Message Time'),
			'sender' => 'sender',
			'receiver' => 'receiver',
			'messageData' => null,
			'responses' => null,
		);
	}
        
        public function rules() {
		return array(
			array('message,title, receiver_id', 'required'),
			array('sender_id, receiver_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>45),
			array('time_sent, updated_message_time', 'safe'),
			array('title, time_sent, updated_message_time', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, title, message, sender_id, receiver_id, time_sent, updated_message_time', 'safe', 'on'=>'search'),
		);
	}
        
        public function beforeValidate(){
            if($this->isNewRecord)
            {
                $this->sender_id= yii::app()->user->id;
                $this->time_sent= new CDbExpression('NOW()');
                $this->updated_message_time= new CDbExpression('NOW()');
            }
            else
            {
                $this->updated_message_time= new CDbExpression('NOW()');
            }
            
            return parent::beforeValidate();
            
        }
        
        public function afterSave()
        {
           if($this->isNewRecord)
           {
               //Message data for sender
                $messageData = new MessageData;
                $messageData->user_id=$this->sender_id;
                $messageData->message_id=$this->id;
                $messageData->is_read=0;
                $messageData->is_deleted=0;
                $messageData->starred=0;
                $messageData->is_sent=1;
                $messageData->is_received=0;
                $messageData->notify=0;
                $messageData->save();
                
             //Message Data for receiver
                $messageData = new MessageData;
                $messageData->user_id=$this->receiver_id;
                $messageData->message_id=$this->id;
                $messageData->is_read=0;
                $messageData->is_deleted=0;
                $messageData->starred=0;
                $messageData->is_sent=0;
                $messageData->is_received=1;
                $messageData->notify=1;
                $messageData->save();
           }
                return parent::afterSave();
        }
        
        /*
         * marks message as read
         */
        public function markAsRead()
        {
            $messageData=MessageData::model()->findbyAttributes(array('user_id'=>yii::app()->user->id,'message_id'=>$this->id));
            $messageData->is_read=1;
            $messageData->notify=0;
            $messageData->save();
        }
        
        /*
         * Adds a response to a particular message
         */
        public function addResponse($response)
        {
            //added some logic so the sender and receiver swap
            if($this->sender_id===yii::app()->user->id)
            {
                $response->message_id=$this->id;
                $response->sender_id=$this->sender_id;
                $response->receiver_id=$this->receiver_id;
                $this->updated_message_time = new CDbExpression('NOW()');
                $this->setNotification($this->receiver_id);
            }
            else if($this->receiver_id===yii::app()->user->id)
            {
                // This swaps the sender and receiver id so its not alawys the same sender and receiver
                //try and find a more elegent way to do this
                $response->message_id=$this->id;
                $response->sender_id=$this->receiver_id;
                $response->receiver_id=$this->sender_id;
                $this->updated_message_time = new CDbExpression('NOW()');
                $messageData=MessageData::model()->findbyAttributes(array('user_id'=>$this->sender_id,'message_id'=>$this->id));
                $messageData->is_received = 1;
                $messageData->save();
                $this->setNotification($this->sender_id);
                
            }
           if($response->save()&&$this->save())
           {
               return true;
           }
           else{
               return false;
           }
        }
        
        public function setNotification($uid)
        {
           $newMsg = MessageData::model()->findbyAttributes(array('user_id'=>$uid,'message_id'=>$this->id));
           $newMsg->notify = 1;
           $newMsg->save();
        }
        
        public function getUnread()
        {
           $newMsg = MessageData::model()->findbyAttributes(array('user_id'=>yii::app()->user->id,'message_id'=>$this->id));
           return ($newMsg->notify == 1)? true:false;
          //return $this->messageData->notify;
        }
        
        
        
        
}