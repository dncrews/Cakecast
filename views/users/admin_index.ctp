<?php
    $sort = '';
    $dir = '';
    if (isset($this->params['named']['sort'])) {
        $sort = $this->params['named']['sort'];
        $dir = $this->params['named']['direction'];
    }
?>

<div class="users index admin">
<h2><?php __('Users');?></h2>
<table cellpadding="0" cellspacing="0" class="castList">
<tr>
	<th<?php if ($sort == 'username') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('username');?></th>
	<th<?php if ($sort == 'name') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('name');?></th>
	<th<?php if ($sort == 'email') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('email');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
    if (($is_admin === '1') || ($user['User']['id'] === $current_id)) {
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['username']; ?>
		</td>
		<td>
			<?php echo $user['User']['name']; ?>
		</td>
		<td>
			<?php echo $user['User']['email']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $user['User']['id']), array('class' => 'editLink')); ?>
			<?php if (($is_admin === '1') && ($user['User']['id'] !== $current_id)) echo $html->link(__('Delete', true), array('action'=>'delete', $user['User']['id']), array('class' => 'deleteLink'), sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
		</td>
	</tr>
	<?php } ?>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<?php 
    if ($is_admin === '1')
        $actions = '
    		<ul>
                <li class="menuNewLink">' . $html->link(__('New User', true), array('action'=>'add')) . '</li>
            </ul>
        ';
    $this->set('actionItems', $actions);

?>
