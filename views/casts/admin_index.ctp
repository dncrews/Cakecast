<?php
    $sort = '';
    $dir = '';
    if (isset($this->params['named']['sort'])) {
        $sort = $this->params['named']['sort'];
        $dir = $this->params['named']['direction'];
    }
?>

<div class="casts index admin">
<h2><?php __('Podcasts');?></h2>
<table cellpadding="0" cellspacing="0" class="castList">
<tr>
	<th<?php if ($sort == 'title') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('title');?></th>
	<th<?php if ($sort == 'user_id') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('user_id');?></th>
	<th<?php if ($sort == 'subtitle') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('subtitle');?></th>
	<th<?php if ($sort == 'created') { echo ' class="selected ' . $dir . '"'; } elseif ($sort == '') { echo ' class="selected desc"'; } ?>><?php echo $paginator->sort('created');?></th>
	<th<?php if ($sort == 'duration') { echo ' class="selected ' . $dir . '"'; } ?>><?php echo $paginator->sort('duration');?></th>
	<th class="actions"><a><?php __('Actions');?></a></th>
</tr>
<?php
$i = 0;
foreach ($casts as $cast):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $cast['Cast']['title']; ?>
		</td>
		<td>
			<?php echo $cast['User']['name']; ?>
		</td>
		<td>
			<?php echo $cast['Cast']['subtitle']; ?>
		</td>
		<td>
			<?php echo $cast['Cast']['created']; ?>
		</td>
		<td>
			<?php echo $cast['Cast']['duration']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Info', true), array('action'=>'view', $cast['Cast']['id']), array('class' => 'infoLink')); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $cast['Cast']['id']), array('class' => 'editLink')); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $cast['Cast']['id']), array('class' => 'deleteLink'), sprintf(__('Are you sure you want to delete # %s?', true), $cast['Cast']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<?php $actions = '
		<ul>
            <li class="menuNewLink">' . $html->link(__('New Podcast', true), array('action'=>'add')) . '</li>
        </ul>
';
    $this->set('actionItems', $actions);

?>
