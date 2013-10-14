<?php

/**
 * This is the model base class for the table "tbl_job_post".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "JobPost".
 *
 * Columns in table "tbl_job_post" available as properties of the model,
 * followed by relations of table "tbl_job_post" available as properties of the model.
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $skill_id
 * @property string $name
 * @property string $Desc
 * @property double $budget
 * @property integer $awarded_to
 * @property integer $negotiable
 * @property string $response_cut_date
 * @property string $hours_per_day
 * @property string $job_start_date
 * @property string $job_end_date
 * @property integer $close_applications
 * @property string $city
 * @property string $town
 * @property string $suburb
 * @property string $street
 * @property string $street_num
 * @property string $extra_directions
 * @property integer $job_completed
 * @property integer $has_review
 * @property integer $paid
 *
 * @property Image[] $images
 * @property InvitedUser[] $invitedUsers
 * @property User $user
 * @property Skill $skill
 * @property JobResponse $awardedTo
 * @property JobResponse[] $jobResponses
 * @property Notifications[] $notifications
 * @property Review[] $reviews
 */
abstract class BaseJobPost extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_job_post';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Job Post|Jobs', $n);
	}

	public static function representingColumn() {
		return 'name';
	}

	public function rules() {
		return array(
			array('user_id, skill_id, name, response_cut_date, job_start_date, job_end_date, city, town', 'required'),
			array('user_id, skill_id, awarded_to, negotiable, close_applications, job_completed, has_review, paid', 'numerical', 'integerOnly'=>true),
			array('budget', 'numerical'),
			array('name, city, town, suburb, street', 'length', 'max'=>45),
			array('hours_per_day, street_num', 'length', 'max'=>10),
			array('Desc, extra_directions', 'safe'),
			array('Desc, budget, awarded_to, negotiable, hours_per_day, close_applications, suburb, street, street_num, extra_directions, job_completed, has_review, paid', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, user_id, skill_id, name, Desc, budget, awarded_to, negotiable, response_cut_date, hours_per_day, job_start_date, job_end_date, close_applications, city, town, suburb, street, street_num, extra_directions, job_completed, has_review, paid', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'images' => array(self::HAS_MANY, 'Image', 'job_post_id'),
			'invitedUsers' => array(self::HAS_MANY, 'InvitedUser', 'job_post_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'skill' => array(self::BELONGS_TO, 'Skill', 'skill_id'),
			'awardedTo' => array(self::BELONGS_TO, 'JobResponse', 'awarded_to'),
			'jobResponses' => array(self::HAS_MANY, 'JobResponse', 'job_post_id'),
			'notifications' => array(self::HAS_MANY, 'Notifications', 'job_post_id'),
			'reviews' => array(self::HAS_MANY, 'Review', 'job_post_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'user_id' => null,
			'skill_id' => null,
			'name' => Yii::t('app', 'Name'),
			'Desc' => Yii::t('app', 'Desc'),
			'budget' => Yii::t('app', 'Budget'),
			'awarded_to' => null,
			'negotiable' => Yii::t('app', 'Negotiable'),
			'response_cut_date' => Yii::t('app', 'Response Cut Date'),
			'hours_per_day' => Yii::t('app', 'Hours Per Day'),
			'job_start_date' => Yii::t('app', 'Job Start Date'),
			'job_end_date' => Yii::t('app', 'Job End Date'),
			'close_applications' => Yii::t('app', 'Close Applications'),
			'city' => Yii::t('app', 'City'),
			'town' => Yii::t('app', 'Town'),
			'suburb' => Yii::t('app', 'Suburb'),
			'street' => Yii::t('app', 'Street'),
			'street_num' => Yii::t('app', 'Street Num'),
			'extra_directions' => Yii::t('app', 'Extra Directions'),
			'job_completed' => Yii::t('app', 'Job Completed'),
			'has_review' => Yii::t('app', 'Has Review'),
			'paid' => Yii::t('app', 'Paid'),
			'images' => null,
			'invitedUsers' => null,
			'user' => null,
			'skill' => null,
			'awardedTo' => null,
			'jobResponses' => null,
			'notifications' => null,
			'reviews' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('user_id', $this->user_id);
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

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}