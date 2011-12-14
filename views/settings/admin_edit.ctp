<?php
    $preCatArray = explode('|', $this->data['Setting']['category']);
    $selectedArray = array();
    foreach ($preCatArray as $preCat) {
        if (strstr($preCat, ',')) {
            $preCat = explode(',', $preCat);
            foreach ($preCat as $cat) {
                $selectedArray[] = $cat;
            }
        }
        else {
            $selectedArray[] = $preCat;
        }
    }
    array_pop($selectedArray);
?>

<?php global $iTunesCats; ?>
<div class="settings form admin">
<?php echo $form->create('Setting', array('type'=>'file'));?>
	<h3 class="formTitle"><?php __('Edit Settings');?></h3>
    <fieldset>
        <div id="mainForm">
    	<?php
    		echo $form->input('id');
    		echo $form->input('new_album_art', array('type'=>'file'));
    		echo $form->input('title');
    		echo $form->input('subtitle', array('type'=>'text'));
    		echo $form->input('summary');
    		echo $form->input('description');
    		echo $form->input('owner_name', array('type'=>'text'));
    		echo $form->input('owner_email', array('type'=>'text'));
    		echo $form->input('copyright', array('type'=>'text'));
    		echo $form->input('author', array('type'=>'text'));
    		echo $form->input('site_url', array('type'=>'text'));
    	?>
    	<h4>Explicit</h4>
        <?php
    		echo $form->input('explicit', array(
                                            'type'=>'radio', 'legend' => false, 'options' => array(
                                                'Yes' => 'Yes',
                                                'No' => 'No',
                                                'Clean' => 'Clean'
                                            )
                                        ), array('legend' => false));
    	?>
        </div>
	    <h4>Categories</h4>
	    <div id="categoriesDiv">
            <ul id="categories">
    	<?php
        		foreach($iTunesCats as $category) {
                    if (in_array($category[0], $selectedArray)) {
                        $checked = true;
                    } else {
                        $checked = false;
                    }
                        
                    echo '<li class="category">' . $form->input("category.$category[0].main", array('type'=>'checkbox', 'label'=>$category[0], 'checked' => $checked));
                    if(isset($category[1])) {
                        echo '<ul>
                            ';
                        $catTitle = array_shift($category);
                        foreach($category as $subCategory) {
                        if(in_array($subCategory, $selectedArray)){
                            $checked = true;
                        }else{
                            $checked = false;
                        }
                            echo '<li>' . $form->input("category.$catTitle.$subCategory", array('type'=>'checkbox','checked' => $checked)) . '</li>
                            ';
                        }
                        echo '</ul>';
                    }
                    echo "</li>";
                }
        ?>
            </ul>
        </div>
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
