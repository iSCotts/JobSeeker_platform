<?php

/**
 * This is the model base class for the table "tbl_image".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Image".
 *
 * Columns in table "tbl_image" available as properties of the model,
 * followed by relations of table "tbl_image" available as properties of the model.
 *
 * @property integer $id
 * @property string $image
 * @property string $file_name
 * @property string $file_type
 * @property integer $job_post_id
 *
 * @property JobPost $jobPost
 */
abstract class BaseImage extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'tbl_image';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Image|Images', $n);
	}

	public static function representingColumn() {
		return 'image';
	}

	public function rules() {
		return array(
			array('id, image, job_post_id', 'required'),
			array('id, job_post_id', 'numerical', 'integerOnly'=>true),
			array('file_name', 'length', 'max'=>100),
			array('file_type', 'length', 'max'=>45),
			array('file_name, file_type', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, image, file_name, file_type, job_post_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'jobPost' => array(self::BELONGS_TO, 'JobPost', 'job_post_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'image' => Yii::t('app', 'Image'),
			'file_name' => Yii::t('app', 'File Name'),
			'file_type' => Yii::t('app', 'File Type'),
			'job_post_id' => null,
			'jobPost' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('image', $this->image, true);
		$criteria->compare('file_name', $this->file_name, true);
		$criteria->compare('file_type', $this->file_type, true);
		$criteria->compare('job_post_id', $this->job_post_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}