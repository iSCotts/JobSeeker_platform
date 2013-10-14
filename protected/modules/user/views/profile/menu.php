<div class="column s">
    <img id="ppc" src="images/_dp.png" width="60" height="120"/><?php 
if(UserModule::isAdmin()) {
?>
<?php echo CHtml::link(UserModule::t('Manage User'),array('/user/admin')); ?>
<?php 
}
echo    
    CHtml::link(UserModule::t('Edit My Profile'),array('edit')),
    CHtml::link(UserModule::t('Change Password'),array('changepassword')),
    CHtml::link('My Stats',array('/user/user/jobHistory','id'=>yii::app()->user->id)),
    CHtml::link('Help Guide',array('/site/helpguide'), array('target'=>'blank')),
    CHtml::link('Active Jobs'/* as Contractor'*/,array('/user/user/viewActiveJobsAsContractor','id'=>yii::app()->user->id)),
    //CHtml::link('Active Jobs as Employer',array('/user/user/viewActiveJobsAsEmployer','id'=>yii::app()->user->id)),
    CHtml::link('Jobs Pending Decision',array('/user/user/ViewJobsPendingDecesion','id'=>yii::app()->user->id)),
    CHtml::link(UserModule::t('Logout'),array('/user/logout'));
?></div>