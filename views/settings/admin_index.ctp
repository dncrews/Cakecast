<?php
    $setting = $settings[0];
?>
<div class="settings index admin">
<h2><?php __('Settings');?></h2>
    <div class="settingImage">
        <div id="imageDiv"><?php echo $html->image($setting['Setting']['album_art']); ?></div>
        <h4>Author</h4>
        <span><?php echo $setting['Setting']['author']; ?></span>
        <h4>Owner</h4>
        <span><?php echo $setting['Setting']['owner_name']; ?></span>
        <span><?php echo $html->link($setting['Setting']['owner_email'], 'mailto:'.$setting['Setting']['owner_email']); ?></span>
        <h4>Website</h4>
        <span><?php echo $html->link($setting['Setting']['site_url'], $setting['Setting']['site_url'], array('target'=> '_blank')); ?></span>
        <br />
        <span>Explicit: <?php echo $setting['Setting']['explicit']; ?></span>
        <span><?php echo $setting['Setting']['copyright']; ?></span>
    </div>
    <div class="settingInfo">
        <span class="settingTitle"><?php echo $setting['Setting']['title']; ?></span>
        <span class="settingSubtitle"><?php echo $setting['Setting']['subtitle']; ?></span>
        <span class="settingSummary"><?php echo $setting['Setting']['summary']; ?></span>
        <span class="settingDescription"><?php echo nl2br($setting['Setting']['description']); ?></span>
        <div class="settingCategories">
            <h4>Categories</h4>
            <?php echo str_replace('|', '<br /><br />', str_replace(',' , '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $setting['Setting']['category'])); ?>
        </div>
    </div>
</div>
<?php $actions = '
		<ul>
            <li class="menuEditLink">' . $html->link(__('Edit Settings', true), array('action'=>'edit')) . '</li>
		</ul>
';
    $this->set('actionItems', $actions);

?>

