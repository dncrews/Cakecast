<?php
class Setting extends AppModel {

	var $name = 'Setting';
	var $validate = array(
	
        'title' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
        'subtitle' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
        'summary' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
        'description' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
		'category' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '|', '&')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
		
        'owner_name' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
		'owner_email' => array(
            'rule' => 'email',
            'message' => 'Please use a valid email address.'
        ),
        
		'album_art' => array(
            'rule'=>'isUploadedFile',
            'message'=>'Make sure this is a valid format.'
        ),
        
		'new_album_art' => array(
			'newFile' => array(
				'rule' => 'isNewUploadedFile',
				'message'=>'Make sure this is a valid format.',
				'allowEmpty'=>true
				// extra keys like on, required, etc. go here...
			)
		),
		
        'copyright' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '-', ',')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
        'author' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '-', ',')),
            'allowEmpty' => false,
            'message' => 'No special characters allowed.'
        ),
        
        'site_url' => array(
            'rule' => array('alnumWhitelist', array(':', '\/', '\-', '\_', '.')),
            'allowEmpty' => false,
            'message' => 'Valid URL Only'
        )
	);

	function isUploadedFile($params)
	 {
         $val = array_shift($params);
		 $ext = strtolower(substr(strrchr($val['name'], "."), 1));
		 
		 switch($ext)
		 {
			//To allow more types, make a new line, dont use a '.' in the name
			//To dissalow a certain type, simply remove it.	
			case 'jpg';
			case 'jpeg';
			case 'gif';
				break;
			default;
				return false;
				break; 	
		 }
		 
		 if ((isset($val['error']) && $val['error'] == 0) || (!empty($val['tmp_name']) && $val['tmp_name'] != 'none'))
		 {
			 return is_uploaded_file($val['tmp_name']);
		 }
		 else
		 {
		 	 return false;
	 	 }
	 }
	 
	 function isNewUploadedFile($params)
	 {
		 $val = array_shift($params);
		 $ext = strtolower(substr(strrchr($val['name'], "."), 1));
		 if($val['error'] == '4')
		 {
		 	return true;
		 }
		 
		 switch($ext)
		 {
			//To allow more types, make a new line, dont use a '.' in the name
			//To dissalow a certain type, simply remove it.	
			case 'jpg';
			case 'jpeg';
			case 'gif';
				break;
			default;
				return false;
				break; 	
		 }
		 
		 if ((isset($val['error']) && $val['error'] == 0) || (!empty($val['tmp_name']) && $val['tmp_name'] != 'none'))
		 {
			 return is_uploaded_file($val['tmp_name']);
		 }
		 else
		 {
		 	 return false;
	 	 }
	}
	 
    function beforeValidate() {
        $categoriesArray = $this->data['category'];
        $categoryString = '';
        foreach ($categoriesArray as $catKey => $catValue) {
            if (in_array('1', $catValue)){
                $categoryString .= $catKey;
                unset($categoriesArray[$catKey]['main']);
                unset($catValue['main']);
                $i = 0;
                foreach ($catValue as $subKey => $subValue) {
                    if ($subValue === '1') {
                        $categoryString .= ','.$subKey;
                        $i++;
                    }
                }
                $categoryString .= "|";
            }
            else {
                unset ($categoriesArray[$catKey]);
            }
        }
//         pr($categoriesArray);
//         echo $categoryString;
//         die();
        $this->data['Setting']['category'] = $categoryString;
    }
	 
	function beforeSave()
	{
		if(isset($this->data['Setting']['new_album_art']['name']))
		{
			if($this->data['Setting']['new_album_art']['error'] == 4)
			{
				return true;
			}
			elseif($this->data['Setting']['new_album_art']['error'] == 0)
			{
				//find old file and delete it.
				$findinfo = $this->findById($this->id);
				$file = WWW_ROOT.'img'.DS.$findinfo['Setting']['album_art'];
				
				if(!empty($findinfo['Setting']['album_art']) && (!file_exists($file) || unlink($file)))
				{
					//generate a new name for the file
					$new_name = 'albumArt';
					//get the extension of the file, so we can append it to the end of the new file
					$ext = strtolower(substr(strrchr($this->data['Setting']['new_album_art']['name'], "."), 1));
					//move the file to the webroot/img/ folder
					if(move_uploaded_file($this->data['Setting']['new_album_art']['tmp_name'], WWW_ROOT.'img'.DS.$new_name.'.'.$ext))
					{
						$this->data['Setting']['album_art'] = $new_name.'.'.$ext;	
						return true;
					}
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
        if(isset($this->data['Setting']['album_art']['name']))
		{
			//generate a new name for the file
			$new_name = 'albumArt';
			//get the extension of the file, so we can append it to the end of the new file
			$ext = strtolower(substr(strrchr($this->data['Setting']['album_art']['name'], "."), 1));
			//move the file to the webroot/img/ folder
			if(move_uploaded_file($this->data['Setting']['album_art']['tmp_name'], WWW_ROOT.'img'.DS.$new_name.'.'.$ext))
			{
				$this->data['Setting']['album_art'] = $new_name.'.'.$ext;
				
				return true;
			}
		}
		else
		{
			return true;
		}
	}


}
?>