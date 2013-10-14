<?php

Yii::import('application.modules.user.models._base.BaseInvitedUser');

class InvitedUser extends BaseInvitedUser
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}