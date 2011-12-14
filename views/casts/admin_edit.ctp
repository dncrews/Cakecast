<div class="casts form admin">
<?php echo $form->create('Cast', array('type' => 'file'));?>
	<h3 class="formTitle"><?php __('Edit Podcast');?></h3>
    <fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('title');
		echo $form->input('subtitle', array('type'=>'text'));
		echo $form->input('summary');
		echo $form->input('keywords');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<?php $actions = '
		<ul>
            <li class="menuCancelLink">' . $html->link(__('Cancel', true), array('action'=>'index')) . '</li>
            <li class="menuDeleteLink">' . $html->link(__('Delete', true), array('action'=>'delete', $form->value('Cast.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Cast.id'))) . '</li>
		</ul>
';
    $this->set('actionItems', $actions);

?>