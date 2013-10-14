<?php

Yii::import('application.modules.job.models._base.BaseImage');

class Image extends BaseImage
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        public function rules() {
		return array(
			//array('id, image', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
                        array('image','file',
                            'types'=>'jpg, gif, png, bmp, jpeg',
                            'maxSize'=>1024 * 1024 * 10,
                            'tooLarge'=>'The file was larger than 10MB. Please upload a smaller file.',
                            'allowEmpty' => true),
			array('file_name', 'length', 'max'=>100),
			array('file_type', 'length', 'max'=>45),
			array('file_name, file_type', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, image, file_name, file_type', 'safe', 'on'=>'search'),
		);
	}
        
//        public function afterSave()
//        {
//            $this->job_post_id = $this->jobPost->id;
//            $thid->save();
//            return parent::afterSave();
//        }
}