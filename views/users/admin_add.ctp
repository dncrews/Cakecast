<div class="users form admin">
<?php echo $form->create('User');?>
	<h3 class="formTitle"><?php __('Add User');?></h3>
    <fieldset>
	<?php
		echo $form->input('username');
		echo $form->input('password');
		echo $form->input('verify_password', array('type'=>'password'));
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('admin', array('type'=>'checkbox'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php $actions = '
		<ul>
            <li class="menuCancelLink">' . $html->link(__('Cancel', true), array('action'=>'index')) . '</li>
		</ul>
';
    $this->set('actionItems', $actions);

?>
