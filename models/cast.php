<?php
class Cast extends AppModel {

	var $name = 'Cast';
	var $validate = array(
	
        'title' => array(
            array (
                'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',')),
                'allowEmpty' => false,
                'message' => 'No special characters allowed.'
            ),
            array (
                'rule' => 'notEmpty',
                'message' => 'Title is required.'
            )
        ),
	
        'subtitle' => array(
            array (
                'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.', '!')),
                'allowEmpty' => false,
                'message' => 'No special characters allowed.'
            ),
            array (
                'rule' => 'notEmpty',
                'message' => 'Subtitle is required.'
            )
        ),
	
        'summary' => array(
            array (
                'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',', '.', '!')),
                'allowEmpty' => false,
                'message' => 'No special characters allowed.'
            ),
            array (
                'rule' => 'notEmpty',
                'message' => 'Summary is required.'
            )
        ),
	
        'keywords' => array(
            'rule' => array('alnumWhitelist', array(' ', '\'', '\"', '\-', ',')),
            'allowEmpty' => true,
            'message' => 'No special characters allowed.'
        ),
	
    	'filename' => array(
            'rule'=>'isUploadedFile',
            'message'=>'Make sure this is a valid format.'
        ),
        
		'new_filename' => array(
			'newFile' => array(
				'rule' => 'isNewUploadedFile',
				'message'=>'Make sure this is a valid format.',
				'allowEmpty'=>true
			)
		),
	
    	'length' => array('numeric'),
	
    	'duration' => array('alphanumeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
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
			case 'mp3';
			case 'm4a';
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
			case 'mp3';
			case 'm4a';
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
	 
	function uploadFile() {
        if(isset($this->data['Cast']['audio_file']['name']))
        {
            //generate a new name for the file
        	$new_name = date('mdy').'_'.substr(md5('ilikecake'.rand(20,65)), 1, 8);
        	//get the extension of the file, so we can append it to the end of the new file
        	$ext = strtolower(substr(strrchr($this->data['Cast']['audio_file']['name'], "."), 1));
        	//move the file to the webroot/img/ folder
        	if(move_uploaded_file($this->data['Cast']['audio_file']['tmp_name'], WWW_ROOT.'archive'.DS.$new_name.'.'.$ext))
        	{
                $newFormData['Cast']['audio_file'] = $new_name.'.'.$ext;
        		
        		return $newFormData;
        	}
        }
        return array();
    }
    function beforeSave()
    {
        unset($this->data['fid']);
        if(isset($this->data['Cast']['newFile']))
		{
            $songArray = $this->Getid3->info(WWW_ROOT.'archive'.DS.$this->data['Cast']['newFile']);
            $this->data['Cast']['filename'] = $this->data['Cast']['newFile'];
			$this->data['Cast']['length'] = $songArray['fileSize'];
			$this->data['Cast']['duration'] = $songArray['duration'];
			$this->data['Cast']['mime_type'] = $songArray['mimeType'];
		}
        if(isset($this->data['Cast']['new_filename']['name']))
		{
			if($this->data['Cast']['new_filename']['error'] == 4)
			{
				return true;
			}
			elseif($this->data['Cast']['new_filename']['error'] == 0)
			{
				//find old file and delete it.
				$findinfo = $this->findById($this->id);
				$file = WWW_ROOT.'archive'.DS.$findinfo['Cast']['filename'];
				
				if(!empty($findinfo['Cast']['filename']) && (!file_exists($file) || unlink($file)))
				{
					//generate a new name for the file
			        $new_name = date('mdy').'_'.substr(md5('ilikecake'.rand(20,65)), 1, 8);
					//get the extension of the file, so we can append it to the end of the new file
					$ext = strtolower(substr(strrchr($this->data['Cast']['new_filename']['name'], "."), 1));
					//move the file to the webroot/img/ folder
					if(move_uploaded_file($this->data['Cast']['new_filename']['tmp_name'], WWW_ROOT.'archive'.DS.$new_name.'.'.$ext))
					{
						$this->data['Cast']['filename'] = $new_name.'.'.$ext;
						$this->data['Cast']['length'] = $this->data['Cast']['new_filename']['size'];
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
        if(isset($this->data['Cast']['filename']['name']))
		{
            //generate a new name for the file
			$new_name = date('mdy').'_'.substr(md5('ilikecake'.rand(20,65)), 1, 8);
			//get the extension of the file, so we can append it to the end of the new file
			$ext = strtolower(substr(strrchr($this->data['Cast']['filename']['name'], "."), 1));
			//get the size of the file
			$size = $this->data['Cast']['filename']['size'];
			//test
			$songArray = $this->Getid3->info($this->data['Cast']['filename']['tmp_name']);
			//move the file to the webroot/img/ folder
			if(move_uploaded_file($this->data['Cast']['filename']['tmp_name'], WWW_ROOT.'archive'.DS.$new_name.'.'.$ext))
			{
				$this->data['Cast']['filename'] = $new_name.'.'.$ext;
				$this->data['Cast']['length'] = $size;
				$this->data['Cast']['duration'] = $songArray[0];
				$this->data['Cast']['mime_type'] = $songArray[1];
				
				return true;
			}
		}
        if(isset($this->data['Cast']['audio_file']['name']))
		{
			/*echo "<pre>";
            print_r($this->data['Cast']['filename']);
			die();*/
            //generate a new name for the file
			$new_name = date('mdy').'_'.substr(md5('ilikecake'.rand(20,65)), 1, 8);
			//get the extension of the file, so we can append it to the end of the new file
			$ext = strtolower(substr(strrchr($this->data['Cast']['audio_file']['name'], "."), 1));
			//get the size of the file
			$size = $this->data['Cast']['audio_file']['size'];
			//test
			$songArray = $this->Getid3->info($this->data['Cast']['audio_file']['tmp_name']);
			//move the file to the webroot/img/ folder
			if(move_uploaded_file($this->data['Cast']['audio_file']['tmp_name'], WWW_ROOT.'archive'.DS.$new_name.'.'.$ext))
			{
				$this->data['Cast']['audio_file'] = $new_name.'.'.$ext;
				$this->data['Cast']['length'] = $size;
				$this->data['Cast']['duration'] = $songArray[0];
				$this->data['Cast']['mime_type'] = $songArray[1];
				
				return true;
			}
		}
		else
		{
			//return var_dump($_FILES);
			return true;
		}
	}
	function beforeDelete() {
        $data = $this->read('filename');
        $filename = WWW_ROOT . 'archive' . DS . $data[$this->alias]['filename'];
        if (is_file($filename))
            unlink($filename);
        return true;
    }
}
?>