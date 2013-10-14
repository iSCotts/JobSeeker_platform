<?php $this->pageTitle=UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
?><h2><?php echo UserModule::t('Your Profile'); ?></h2>
<?php echo $this->renderPartial('menu'); ?>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<style>
#ppc {
    float:left;
    border:4px solid #fff;
    box-shadow: inset 20px 20px 60px #A68C00;
    margin:0 20px;
    background-color: gold;
    outline:1px solid #777;
    box-sizing:padding-box
}
#page li {
    display:inline;
    list-style:none;
}
#page li:after {
    content:" | ";
}

td,th,table {
    border: none;
    background-color: transparent !important;
    color: #555 !important;
}
th:after {
    content: ":";
}
table {
    width: 50%;
    float: left;
    margin-left: 10%;
}
table,#ppc {margin-top:20px}
</style>
<img id="ppc" src="images/_dp.png" width="60" height="120"/>
<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?>
</th>
    <td><?php echo CHtml::encode($model->username); ?>
</td>
</tr>
<?php 
		$profileFields=ProfileField::model()->forOwner()->sort()->findAll();
		if ($profileFields) {
			foreach($profileFields as $field) {
				//echo "<pre>"; print_r($profile); die();
			?>
<tr>
	<th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?>
</th>
    <td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?>
</td>
</tr>
			<?php
			}//$profile->getAttribute($field->varname)
		}
?>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>
</th>
    <td><?php echo CHtml::encode($model->email); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('createtime')); ?>
</th>
    <td><?php echo date("d.m.Y H:i:s",$model->createtime); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit')); ?>
</th>
    <td><?php echo date("d.m.Y H:i:s",$model->lastvisit); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>
</th>
    <td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status));
    ?>
</td>
</tr>
</table>
