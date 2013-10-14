<?php

Yii::import('application.modules.user.models._base.BaseJobNotification');

class JobNotification extends BaseJobNotification
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}