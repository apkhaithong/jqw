<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle='ลงชื่อเข้าใช้ระบบ - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<div class="box box-info">
    <div class="box-header">
        <i class="fa fa-bullhorn"></i>
        <h3 class="box-title">Login</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <p>กรุณากรอกข้อมูลต่อไปนี้ เพื่อการเข้าสู่ระบบ:</p>
	<p class="note">โปรดระบุ <span class="required">*</span> ให้ครบถ้วน</p>

	<div class="form-group">
		<?php echo $form->labelEx($model,'username', array('label' => 'ชื่อผู้ใช้งาน','for' => 'edit2')); ?>
		<?php echo $form->textField($model,'username', array('id' => 'edit2','class' => 'form-control','placeholder' => 'Enter Username','autocomplete' => 'off')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'password', array('label' => 'รหัสผ่าน','for' => 'edit1')); ?>
		<?php echo $form->passwordField($model,'password', array('id' => 'edit1','class' => 'form-control','placeholder' => 'Password')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
	<div class="form-group">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

    </div><!-- /.box-body -->
    <div class="box-footer">
        <?php echo CHtml::submitButton('Login',array('class' => 'btn btn-lg btn-primary')); ?>
    </div>    
</div>    


<?php $this->endWidget(); ?>
</div><!-- form -->
<script>
$('#edit2').keyup(function(){
    this.value = this.value.toUpperCase();
});
</script>
