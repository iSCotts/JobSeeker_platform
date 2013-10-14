    <?php

    $this->breadcrumbs = array(
            $model->label(2) => array('index'),
            GxHtml::valueEx($model),
    );

    /*
     * Side menu options
     */
    $this->menu=array(
            array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
            array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
            array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
            array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
            array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
            array('label'=>Yii::t('app', 'Apply For Job'), 'url'=>array('jobResponse/applyForJob','jid'=>$model->id),'visible'=>yii::app()->user->id!=$model->user_id && $model->awarded_to==null),
            array('label'=>'Job Complete', 'url'=>array('jobComplete', 'id' => $model->id),'visible'=>yii::app()->user->id==$model->user_id && $model->awarded_to !=null ),         
    );
    ?>
    
    <?php if($model->job_completed==1 && $model->has_review != yii::app()->user->id && $model->has_review !=3):?>
            <div class="alert-info ">
            <?php echo CHtml::link('Leave Review for this job post',array('review/create','jid'=>$model->id,'eid'=>$model->user_id,'cid'=>$model->awardedTo->user_id)); ?>
            </div>
   <?php elseif($model->job_completed==1 && ($model->has_review == yii::app()->user->id || $model->has_review ==3)):?>
        <div class="alert-info ">
            <?php echo 'You have already left a review'; ?>
        </div>
        <?php endif; ?>
    <?php if($model->job_completed==1):?>
        <div class="alert-info ">
        <?php echo 'This Job has been completed'; ?>
        </div>
    <?php endif; ?>
    
    <h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>
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
    
    <div class="images">
    <?php 
        $images = Image::model()->findAllByAttributes(array('job_post_id'=>$model->id));
        if(!empty($images)) {
            foreach($images as $image)
            {
                echo CHtml::link(
                        CHtml::image(Yii::app()->controller->createUrl('JobPost/loadImage', array('id'=>$image->id))),
                        array('loadImage','id'=>$image->id), array('rel'=>'lightbox[post]')
                );    
            }            
        }       
    ?>
    </div>
    
    <?php $this->widget('zii.widgets.CDetailView', array(
            'data' => $model,
            'attributes' => array(
    array(
                            'name' => 'user',
                            'type' => 'raw',
                            'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('user/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
                            ),
    array(
                            'name' => 'skill',
                            'type' => 'raw',
                            'value' => $model->skill !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->skill)), array('skill/view', 'id' => GxActiveRecord::extractPkValue($model->skill, true))) : null,
                            ),
    'name',
    'Desc',
    'budget',
    array(
                            'name' => 'awardedTo',
                            'type' => 'raw',
                            'value' => $model->awardedTo !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->awardedTo)), array('jobResponse/view', 'id' => GxActiveRecord::extractPkValue($model->awardedTo, true))) : null,
                            ),
    'negotiable:boolean',
    'response_cut_date',
    'hours_per_day',
    'job_start_date',
    'job_end_date',
    'close_applications:boolean',
    'city',
    'town',
    'suburb',
    'street',
    'street_num',
    'extra_directions',
            ),
    )); ?>

    <?php if(Yii::app()->user->id===$model->user->id): ?>
    <h2><?php echo GxHtml::encode($model->getRelationLabel('Applications')); ?></h2>
    <?php
            echo GxHtml::openTag('ul');
            foreach($model->jobResponses as $relatedModel) {
                    echo GxHtml::openTag('ol');
                    echo GxHtml::link($relatedModel->model(), array('jobResponse/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
                    echo GxHtml::closeTag('ol');
                    print_r($relatedModel->model()->count());
            }
            echo GxHtml::closeTag('ul');
            
            Yii::app()->clientScript->registerCSSFile('css/lightbox.css');
            Yii::app()->clientScript->registerScriptFile('js/lightbox.js', CClientScript::POS_END);
            Yii::app()->clientScript->registerScriptFile('js/jquery-1.7.2.min.js');
    ?>      
    <?php endif; ?>