<?php

Yii::import('application.modules.user.models._base.BaseNotificationType');

class NotificationType extends BaseNotificationType
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}