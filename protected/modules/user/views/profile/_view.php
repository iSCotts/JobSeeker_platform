<div class="row">
    <?php //echo GxHtml::link(ucwords(GxHtml::encode($data->skills)));//, array('/user/skill/view', 'id' => $data->skills->id)); ?>
    <?php echo GxHtml::encode($data->skills);//, array('/user/skill/view', 'id' => $data->skills->id)); ?>
    <span class ="alert-error"><?php echo CHtml::link('remove skill', array('/user/UserSkill/removeUserSkill', 'sid' => $data->id)); ?></span>
</div>
