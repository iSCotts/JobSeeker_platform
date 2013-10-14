<?php

$this->breadcrumbs = array(
	Skill::label(2),
	Yii::t('app', 'Select'),
);
if(UserModule::isAdmin())
{
    $this->menu = array(
            array('label'=>Yii::t('app', 'Add new') . ' ' . Skill::label(), 'url' => array('create')),
            array('label'=>Yii::t('app', 'Manage') . ' ' . Skill::label(2), 'url' => array('admin')),
    );
}
else
{
    $this->menu = array(
            array('label'=>Yii::t('app', 'Add new') . ' ' . Skill::label(), 'url' => array('create')),
    );
}
?>

<h1><?php echo GxHtml::encode(Skill::label(2)); ?></h1>

        <?php if(Yii::app()->user->hasFlash('success')): ?>
            <div class="alert-success ">
            <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php elseif(Yii::app()->user->hasFlash('error')):?>
            <div class="alert-error ">
            <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
        <?php elseif(Yii::app()->user->hasFlash('info')):?>
            <div class="alert-info ">
            <?php echo Yii::app()->user->getFlash('info'); ?>
            </div>
        <?php endif; ?>
    

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'skill-grid',
	'dataProvider' => $dataProvider,
	//'filter' => $model,
	'columns' => array(
		//'id',
		array(
                    'name'=>'name',
                    //'value'=>  ucwords($dataProvider->data->)
                 ),
		array(
			'class' => 'CButtonColumn',
                        'template'=>'{Select}',
                        'buttons'=>array
                        (
                            'Select' => array
                            (
                                'label'=>'Select this skill',
                                //'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
                                'url'=>'Yii::app()->createUrl("user/UserSkill/selectUserSkill", array("sid"=>$data->id))',
                            ),
                        ),
                    ),
))); ?>