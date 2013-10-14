<?php

Yii::import('application.modules.user.models._base.BaseSkill');

class Skill extends BaseSkill
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}