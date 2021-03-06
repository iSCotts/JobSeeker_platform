<?php

/**
 * This is the model base class for the table "tbl_response_data".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ResponseData".
 *
 * Columns in table "tbl_response_data" available as properties of the model,
 * followed by relations of table "tbl_response_data" available as properties of the model.
 *
 * @property integer $id
 * @property integer $response_id
 * @property integer $user_id
 * @property integer $is_read
 * @property integer $is_deleted
 * @property integer $starred
 * @property integer $is_sent
 * @property integer $is_received
 *
 * @property User $user
 * @property Response $response
 */
abstract class BaseResponseData extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_response_data';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ResponseData|ResponseDatas', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('id, response_id, user_id', 'required'),
			array('id, response_id, user_id, is_read, is_deleted, starred, is_sent, is_received', 'numerical', 'integerOnly'=>true),
			array('is_read, is_deleted, starred, is_sent, is_received', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, response_id, user_id, is_read, is_deleted, starred, is_sent, is_received', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'response' => array(self::BELONGS_TO, 'Response', 'response_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'response_id' => null,
			'user_id' => null,
			'is_read' => Yii::t('app', 'Is Read'),
			'is_deleted' => Yii::t('app', 'Is Deleted'),
			'starred' => Yii::t('app', 'Starred'),
			'is_sent' => Yii::t('app', 'Is Sent'),
			'is_received' => Yii::t('app', 'Is Received'),
			'user' => null,
			'response' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('response_id', $this->response_id);
		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('is_read', $this->is_read);
		$criteria->compare('is_deleted', $this->is_deleted);
		$criteria->compare('starred', $this->starred);
		$criteria->compare('is_sent', $this->is_sent);
		$criteria->compare('is_received', $this->is_received);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}