<?php

Yii::import('application.modules.message.models._base.BaseResponseData');

class ResponseData extends BaseResponseData
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}