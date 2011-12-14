
<?php echo $javascript->link('mootools.js'); ?>
<?php echo $javascript->link('swfupload.js'); ?>
<div class="casts form admin">
 	<?php
        echo $form->create('Cast', array('type' => 'file', 'id'=>'uploadForm'));
    ?>
    <h3 class="formTitle"><?php __('New Podcast');?></h3>
	<fieldset>
    <?php
    	echo $form->input('title');
		echo $form->input('subtitle', array('type'=>'text'));
		echo $form->input('summary');
		echo $form->input('keywords');
		echo $form->input('newFile', array('type'=>'hidden'));
		if(!isset($_POST['data']['Cast']['newFile'])) {
	?>
        <input type='hidden' id='fileInfoInput' name='fid' value='' />
        <noscript>
            <div id='flashUploaderNS'>
                <label for='websiteInputNS'>Testimonial: </label><input type='file' class='file' id='websiteInputNS' name='data[Cast][audio_file]' /> (max 100 MB)
            </div>
            <style type='text/css'>#flashUploader {display: none;}</style>
        </noscript>
        
        <div id='flashUploader'>
            <label>Audio File: </label>
            <span id='uploadButtonSection'></span>
            <div>(max 100 MB)</div>
            
            <br clear="both" />
            
            <table style='width: 100%' class="noBorders">
                <tr>
                    <td>
                        <div id='uploadStatus'></div>
                    </td>
                    <td style='width:25px;'>
                        <div class='uploadCancel' id='uploadCancel' title='Cancel upload'></div>
                    </td>
                </tr>
            </table>
        </div>
        </fieldset>
    	<div class="submit">
            <?php echo $form->button('Submit', array('type'=>'submit', 'disabled'=>true, 'id'=>'submitMe')); ?>
        </div>
        <?php
        } else {
        ?>
        <div class="input textarea error"><div class="error-message">Audio File Already Uploaded</div></div>
        
	</fieldset>
    <?php
        echo $form->button('Submit', array('type'=>'submit', 'id'=>'submitMe'));
    }
    echo $form->end();?>
	
</div>
<?php $actions = '
		<ul>
            <li class="menuCancelLink">' . $html->link(__('Cancel', true), array('action'=>'index')) . '</li>
		</ul>
';
    $this->set('actionItems', $actions);
?>

	<script type="text/Javascript" src="../../js/uploadOnPageAdd.php"></script>