<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('index'),
	$model->profile->firstname,
);
?>
<h1><?php echo UserModule::t('View ') . $model->profile->firstname; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link(UserModule::t('List User'),array('index')); ?></li>
</ul><!-- actions -->

<?php 

// For all users
	$attributes = array(
			'username',
	);
	
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'value' => $model->profile->getAttribute($field->varname),
				));
		}
	}
	array_push($attributes,
		array(
			'name' => 'createtime',
			'value' => date("d.m.Y H:i:s",$model->createtime),
		),
		array(
			'name' => 'lastvisit',
			'value' => (($model->lastvisit)?date("d.m.Y H:i:s",$model->lastvisit):UserModule::t('Not visited')),
		)
	);
			
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
        
        $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'user.views.userSkill._view',
        )); 

?>

<?php echo CHtml::link('Job History/Stats',array('user/jobHistory','id'=>$model->id)); ?>
