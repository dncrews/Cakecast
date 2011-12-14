<div class="users form admin">
<?php echo $form->create('User');?>
 	<h3 class="formTitle"><?php __('Edit User');?></h3>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('username');
		echo $form->input('password', array('value' => ''));
		echo $form->input('verify_password', array('type'=>'password'));
		echo $form->input('name');
		echo $form->input('email');
		if ($form->value('User.id') !== $current_id)
            echo $form->input('admin', array('label'=> 'Admin', 'type' => 'checkbox'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php $actions = '
		<ul>
            <li class="menuCancelLink">' . $html->link(__('Cancel', true), array('action'=>'index')) . '</li>
    ';
    if ($form->value('User.id') !== $current_id)
        $actions .= '<li class="menuDeleteLink">' . $html->link(__('Delete', true), array('action'=>'delete', $form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.id'))) . '</li';
    $actions .= "</ul>";
    $this->set('actionItems', $actions);

?>
