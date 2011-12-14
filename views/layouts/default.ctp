<?php
/* SVN FILE: $Id: default.ctp 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>SyntaxError Podcast ~ <?php echo $title_for_layout; ?></title>
	<?php
		echo $html->meta('icon');

		echo $html->css('cake.generic');
		echo $html->css('podcast');

		echo $scripts_for_layout;
	?>	
	<link rel="alternate" type="application/rss+xml" title="RSS Feed for this Podcast" href="<?php echo $this->webroot . 'archive' . DS . 'iTunes.xml'; ?>" />
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('user_nav'); ?>
		</div>
		<div id="content">
            <div class="navBar" id="subNav">    
                <?php
                    if (isset($actionItems)) {
                        echo $actionItems;
                    }
                ?>
            </div>

			<?php $session->flash(); ?>
			
            <?php echo $content_for_layout; ?>

		</div>
        <div id="footer"> </div>
	</div>
    <div id="overlay" style="display: none;">
        <div id="subscribeInformation">
                Subscription URL: <?php echo 'http://' . $_SERVER['HTTP_HOST'] . $this->webroot . 'archive' . DS . 'iTunes.xml'; ?><br />
                <a href="itpc://<?php echo $_SERVER['HTTP_HOST'] . $this->webroot . 'archive' . DS . 'iTunes.xml'; ?>">Open with iTunes</a>
                <div id="x">x</div>
        </div>
    </div>
    <?php echo $javascript->link('overlay.js'); ?>
	<?php echo $cakeDebug; ?>
</body>
</html>
