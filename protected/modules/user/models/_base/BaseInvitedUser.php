<?php

/**
 * This is the model base class for the table "tbl_invited_user".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "InvitedUser".
 *
 * Columns in table "tbl_invited_user" available as properties of the model,
 * followed by relations of table "tbl_invited_user" available as properties of the model.
 *
 * @property integer $id
 * @property integer $job_post_id
 * @property integer $user_id
 *
 * @property JobPost $jobPost
 * @property User $user
 */
abstract class BaseInvitedUser extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_invited_user';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'InvitedUser|InvitedUsers', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('job_post_id, user_id', 'required'),
			array('job_post_id, user_id', 'numerical', 'integerOnly'=>true),
			array('id, job_post_id, user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'jobPost' => array(self::BELONGS_TO, 'JobPost', 'job_post_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'job_post_id' => null,
			'user_id' => null,
			'jobPost' => null,
			'user' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('job_post_id', $this->job_post_id);
		$criteria->compare('user_id', $this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}