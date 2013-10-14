<?php

Yii::import('application.modules.user.models._base.BaseNotifications');

class Notifications extends BaseNotifications
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}