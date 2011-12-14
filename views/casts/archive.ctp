<div class="casts archive">
    <h2><?php __('Podcast Archive');?></h2>
    <?php echo $html->link('Subscribe to this Feed', $this->webroot . 'archive' . DS . 'iTunes.xml', array('onclick'=>'return openUp();', 'id'=>'subscribeLink')); ?>
    <table cellpadding=0 cellspacing=0 class="archiveList">
        <?php
        $i = 0;
        foreach ($casts as $cast):
        	$castType = array_shift(explode('/', $cast['Cast']['mime_type']));
            $class = null;
        	if ($i++ % 2 == 0) {
        		$class = ' altrow';
        	}
        ?>
        <tr class="castRow<?php echo $class; ?>">
            <td class="castTitleColumn">
                <?php echo $html->link(__($cast['Cast']['title'], true), array('action'=>'view', $cast['Cast']['id'])); ?>
            </td>
            <td class="castByColumn">
                Posted by <strong><?php echo $cast['User']['name']; ?></strong>
            </td>
            <td class="castCreatedColumn">
                <?php echo $cast['Cast']['created']; ?>
            </td>
            <td class="castDurationColumn">
                Duration: <strong><?php echo $cast['Cast']['duration']; ?></strong>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>