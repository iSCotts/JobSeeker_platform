<?php

Yii::import('application.modules.job.models._base.BaseReview');

class Review extends BaseReview
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			array('quality, cost, expertise, schedule, response, professionalism,is_paid', 'required'),
			array('from_user_id, to_user_id, job_post_id, quality, cost, expertise, schedule, response, professionalism', 'numerical', 'integerOnly'=>true),
			array('review', 'safe'),
			array('quality, cost, expertise, schedule, response, professionalism, review', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, from_user_id, to_user_id, job_post_id, quality, cost, expertise, schedule, response, professionalism, review', 'safe', 'on'=>'search'),
		);
	}
        
        public static function ratingScale()
        {
            return array(1=>'1',2=>'2',3=>'3',4=>'4',5=>'5');
        }
        
        public function beforeSave()
        {
            $avg = (($this->quality + $this->cost + $this->expertise + $this->schedule + $this->response + $this->professionalism)/6);
            $this->avg = $avg;    
            return parent::beforeSave();
        }
        
       
}