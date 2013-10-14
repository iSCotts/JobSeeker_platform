<?php

Yii::import('application.modules.user.models._base.BaseUserSkill');

class UserSkill extends BaseUserSkill
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}