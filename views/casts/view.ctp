<div class="casts view">
    <div class="viewByInfo">
        <span class="castByLine">Posted by <strong><?php echo $cast['User']['name']; ?></strong></span>
        <span class="castCreated"><?php echo $cast['Cast']['created']; ?></span>
        <span class="castDuration">Duration: <strong><?php echo $cast['Cast']['duration']; ?></strong></span>
        
    </div>
    <div class="castBox">
        <div class="castPlayer">
            <?php echo $javascript->link('audioPlayer/audio-player.js'); ?>
            
            <object type="application/x-shockwave-flash" data="<?php echo $html->url('/js/audioPlayer/player.swf'); ?>" id="audioplayer1" height="24" width="290">
                <param name="movie" value="<?php echo $html->url('/js/audioPlayer/player.swf'); ?>">
                <param name="FlashVars" value="playerID=1&amp;soundFile=<?php echo $html->url('/archive/'.$cast['Cast']['filename']); ?>&amp;bg=0xf8f8f8&amp;leftbg=0xeeeeee&amp;lefticon=0x666666&amp;rightbg=0xcccccc&amp;rightbghover=0x999999&amp;righticon=0x666666&amp;righticonhover=0xffffff&amp;text=0x666666&amp;slider=0x666666&amp;track=0xFFFFFF&amp;border=0x666666&amp;loader=0x9FFFB8&amp;loop=no&amp;autostart=<?php echo ($cast['Setting']['autoplay'] == '1' ? 'yes' : 'no'); ?>">
                <param name="quality" value="high">
                <param name="menu" value="false">
                <param name="wmode" value="transparent">
            </object> 
            <br />
            <?php echo $html->link('Download', '/archive/'.$cast['Cast']['filename'], array('class'=>'downloadLink')); ?>
        </div>
        <h2 class="castTitle"><?php echo $cast['Cast']['title']; ?></h2>
        <h3 class="castSubtitle"><?php echo $cast['Cast']['subtitle']; ?></h3>
        <p class="castDescription"><?php echo nl2br($cast['Cast']['summary']); ?></p>
    </div>
    <br style="clear: both;" />
</div>


<?php $actions = '
		<ul>
            <li class="menuBackLink">' . $html->link(__('Back to Podcasts', true), array('action'=>'index')) . '</li>
        </ul>
';
    $this->set('actionItems', $actions);

?>

