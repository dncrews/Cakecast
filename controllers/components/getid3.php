<?php
class Getid3Component extends Object
{

	var $controller;
	var $result = array();

	function __construct()	{
		set_time_limit(20*3600);
		ignore_user_abort(false);

		App::import('vendor','getid3/getid3');
	}
	
	function info($filename) {
	
		$getid3 = new getID3;
		$getid3->encoding = 'UTF-8';
		
		$ThisFileInfo = $getid3->analyze($filename);
		$songArray = array(
            'duration'=>$ThisFileInfo['playtime_string'], 
            'mimeType'=>$ThisFileInfo['mime_type'],
            'fileSize'=>$ThisFileInfo['filesize']
        );
		return ($songArray);
	}
}
?>