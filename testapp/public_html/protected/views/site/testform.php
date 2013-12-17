
<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h3 id="myModalLabel">Enter test data</h3>
</div>
<div class="modal-body">
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'testfrm',
				'enableAjaxValidation' => true,
				'enableClientValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
				),
			));
    
	echo $form->labelEx($model, 'input');
	echo $form->textField($model, 'input');
	echo $form->error($model, 'input');
    echo "<div>";
	echo CHtml::submitButton("save", array("class"=>"btn btn-primary pull-left"));
	echo "</div>";
	$this->endWidget();
	?>

</div>
