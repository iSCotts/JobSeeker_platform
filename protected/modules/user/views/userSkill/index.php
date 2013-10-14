<?php

$this->breadcrumbs = array(
	UserSkill::label(2),
	Yii::t('app', 'View'),
);

if(UserModule::isAdmin())
{
    $this->menu = array(
            array('label'=>Yii::t('app', 'Create') . ' ' . UserSkill::label(), 'url' => array('create')),
            array('label'=>Yii::t('app', 'Manage') . ' ' . UserSkill::label(2), 'url' => array('admin')),
    );
}
?>
<h1><?php echo GxHtml::encode(UserSkill::label(2)); ?></h1>
<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));