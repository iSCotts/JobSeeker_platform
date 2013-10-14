<?php

Yii::import('application.modules.user.models._base.BaseAccount');

class Account extends BaseAccount
{
        public $deposit;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function makeDeposit()
        {
            $this->balance = $this->balance + $this->deposit;
            if($this->save())
            {
                return true;
            }
            return false;
        }


        public function rules() {
		return array(
			//array('user_id', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('balance', 'numerical'),
			array('balance', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, balance, user_id', 'safe', 'on'=>'search'),
		);
	}
}