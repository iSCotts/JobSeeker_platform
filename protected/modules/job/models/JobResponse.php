<?php

Yii::import('application.modules.job.models._base.BaseJobResponse');

class JobResponse extends BaseJobResponse
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}