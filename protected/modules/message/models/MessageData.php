<?php

Yii::import('application.modules.message.models._base.BaseMessageData');

class MessageData extends BaseMessageData
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function getUnread()
        {
           return $this->notify;
        }
}