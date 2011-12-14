<div class="casts index">
    <h2><?php __('Podcasts');?></h2>
    <?php echo $html->link('Subscribe to this Feed', $this->webroot . 'archive' . DS . 'iTunes.xml', array('onclick'=>'return openUp();', 'id'=>'subscribeLink')); ?>
    <table cellpadding=0 cellspacing=0 class="castList">
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
            <td class="mediaTypeColumn <?php echo $castType; ?>Box"> </td>
            <td class="castTitleColumn">
                <?php echo $html->link(__($cast['Cast']['title'], true), array('action'=>'view', $cast['Cast']['id']), array('class' => 'castTitle')); ?>
                <span class="castSubtitle"><?php echo $cast['Cast']['subtitle']; ?></span>
            </td>
            <td class="castDescriptionColumn">
                <?php echo $text->truncate($cast['Cast']['summary'], 145, '...', false); ?>
            </td>
            <td class="castByColumn">
                <span class="castByLine">Posted by <strong><?php echo $cast['User']['name']; ?></strong></span>
                <span class="castCreated"><?php echo $cast['Cast']['created']; ?></span>
                <span class="castDuration">Duration: <strong><?php echo $cast['Cast']['duration']; ?></strong></span>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div id="archiveLink" class="paging">
    	<?php echo $html->link('Go to Archive', array('action'=>'archive')); ?>
    </div>
</div>