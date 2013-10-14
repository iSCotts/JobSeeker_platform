<?php

Yii::import('application.modules.job.models._base.BaseJobPost');

class JobPost extends BaseJobPost
{
        
        public $file;
        public $images;
    
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

        
        public function rules() {
		return array(
                        array('response_cut_date','compare','compareAttribute'=>'job_start_date','operator'=>'<','allowEmpty'=>false,'message'=>'{attribute} must come before {compareValue}.'),
                        array('job_start_date','compare','compareAttribute'=>'job_end_date','operator'=>'<','allowEmpty'=>false,'message'=>'{attribute} must come before {compareValue}.'),
			array('user_id, skill_id, name, response_cut_date, job_start_date, job_end_date, city, town', 'required'),
			array('user_id, skill_id, awarded_to, negotiable, close_applications, job_completed, has_review', 'numerical', 'integerOnly'=>true),
			array('budget', 'numerical'),
			array('name, city, town, suburb, street', 'length', 'max'=>45),
			array('hours_per_day, street_num', 'length', 'max'=>10),
			array('Desc, extra_directions', 'safe'),
                        array('file','file',
                            'types'=>'jpg, gif, png, bmp, jpeg',
                            'maxSize'=>1024 * 1024 * 10,
                            'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                            'allowEmpty' => true),
			array('Desc, budget, awarded_to, negotiable, hours_per_day, close_applications, suburb, street, street_num, extra_directions, job_completed, has_review', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, skill_id, name, Desc, budget, awarded_to, negotiable, response_cut_date, hours_per_day, job_start_date, job_end_date, close_applications, city, town, suburb, street, street_num, extra_directions, job_completed, has_review', 'safe', 'on'=>'search'),
		);
	}
        
        public function searchMyPosts() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', yii::app()->user->id);
		$criteria->compare('skill_id', $this->skill_id);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('Desc', $this->Desc, true);
		$criteria->compare('budget', $this->budget);
		$criteria->compare('awarded_to', $this->awarded_to);
		$criteria->compare('negotiable', $this->negotiable);
		$criteria->compare('response_cut_date', $this->response_cut_date, true);
		$criteria->compare('hours_per_day', $this->hours_per_day, true);
		$criteria->compare('job_start_date', $this->job_start_date, true);
		$criteria->compare('job_end_date', $this->job_end_date, true);
		$criteria->compare('close_applications', $this->close_applications);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('town', $this->town, true);
		$criteria->compare('suburb', $this->suburb, true);
		$criteria->compare('street', $this->street, true);
		$criteria->compare('street_num', $this->street_num, true);
		$criteria->compare('extra_directions', $this->extra_directions, true);
		$criteria->compare('job_completed', $this->job_completed);
		$criteria->compare('has_review', $this->has_review);
		$criteria->compare('paid', $this->paid);
                $criteria->compare('user_id', yii::app()->user->id);
                $criteria->compare('job_Completed',1);
                $criteria->compare('paid', 0);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
        
//        public function attributeLabels() {
//		return array(
//			'id' => Yii::t('app', 'ID'),
//			'user_id' => null,
//			'skill_id' => null,
//			'name' => Yii::t('app', 'Name'),
//			'Desc' => Yii::t('app', 'Desc'),
//			'invite_user_id' => Yii::t('app', 'Invite Contractors'),
//			'budget' => Yii::t('app', 'Budget'),
//			'awarded_to' => null,
//			'negotiable' => Yii::t('app', 'Negotiable'),
//			'response_cut_date' => Yii::t('app', 'Response Cut Date'),
//			'hours_per_day' => Yii::t('app', 'Hours Per Day'),
//			'job_start_date' => Yii::t('app', 'Job Start Date'),
//			'job_end_date' => Yii::t('app', 'Job End Date'),
//			'close_applications' => Yii::t('app', 'Close Applications'),
//			'city' => Yii::t('app', 'City'),
//			'town' => Yii::t('app', 'Town'),
//			'suburb' => Yii::t('app', 'Suburb'),
//			'street' => Yii::t('app', 'Street'),
//			'street_num' => Yii::t('app', 'Street Num'),
//			'extra_directions' => Yii::t('app', 'Extra Directions'),
//			'job_completed' => Yii::t('app', 'Job Completed'),
//			'has_review' => Yii::t('app', 'Has Review'),
//			'inviteUser' => null,
//			'awardedTo' => null,
//			'skill' => null,
//			'user' => null,
//			'jobResponses' => null,
//			'notifications' => null,
//			'reviews' => null,
//		);
//	}

        
        public function attributeLabels() {
		return array(
			'name' => 'Skill Required'
                );
        }
        
        public function getAddressModel()
        {
            return JobAddress::model()->findByPk($this->id);
        }
        
        public function beforeValidate()
        {
            if($this->isNewRecord)
            {
                $this->user_id = yii::app()->user->id;
            }
            
            return parent::beforeValidate();
        }
        
}