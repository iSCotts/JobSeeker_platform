<div class="well view">
	<?php echo
            CHtml::link(ucwords($data->skills), array('/user/userSkill/view', 'id' => $data->id), array('class'=>'pull-left', 'title'=>'view description')),//. $data->skills->desc user.views.userSkill.
            CHtml::link(CHtml::tag('span',array('class'=>'button pull-right', 'title'=>'remove skill'),'X'), array('/user/UserSkill/removeUserSkill', 'sid' => $data->id));
        ?>
</div>