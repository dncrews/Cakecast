<?php
/* SVN FILE: $Id: bootstrap.php 7945 2008-12-19 02:16:01Z gwoo $ */
/**
 * Short description for file.
 *
 * Long description for file
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
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @version       $Revision: 7945 $
 * @modifiedby    $LastChangedBy: gwoo $
 * @lastmodified  $Date: 2008-12-18 18:16:01 -0800 (Thu, 18 Dec 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 *
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php is loaded
 * This is an application wide file to load any function that is not used within a class define.
 * You can also use this to include or require any files in your application.
 *
 */
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * $modelPaths = array('full path to models', 'second full path to models', 'etc...');
 * $viewPaths = array('this path to views', 'second full path to views', 'etc...');
 * $controllerPaths = array('this path to controllers', 'second full path to controllers', 'etc...');
 *
 */
//EOF
    global $iTunesCats;
    $iTunesCats = array(
        array(
            'Arts',
            'Design',
            'Fashion & Beauty',
            'Food',
            'Literature',
            'Performing Arts',
            'Visual Arts'
        ),
        array(
            'Business',
            'Business News',
            'Careers',
            'Investing',
            'Management & Marketing',
            'Shopping'
        ),
        array(
            'Comedy'
        ),
        array(
            'Education',
            'Education Technology',
            'Higher Education',
            'K-12',
            'Language Courses',
            'Training'
        ),
        array(
            'Games & Hobbies',
            'Automotive',
            'Aviation',
            'Hobbies',
            'Other Games',
            'Video Games'
        ),
        array(
            'Government & Organizations',
            'Local',
            'National',
            'Non-Profit',
            'Regional'
        ),
        array(
            'Health',
            'Alternative Health',
            'Fitness & Nutrition',
            'Self-Help',
            'Sexuality'
        ),
        array(
            'Kids & Family'
        ),
        array(
            'Music'
        ),
        array(
            'News & Politics'
        ),
        array(
            'Religion & Spirituality',
            'Buddhism',
            'Christianity',
            'Hinduism',
            'Islam',
            'Judaism',
            'Other',
            'Spirituality'
        ),
        array(
            'Science & Medicine',
            'Medicine',
            'Natural Sciences',
            'Social Sciences'
        ),
        array(
            'Society & Culture',
            'History',
            'Personal Journals',
            'Philosophy',
            'Places & Travel'
        ),
        array(
            'Sports & Recreation',
            'Amateur',
            'College & High School',
            'Outdoor',
            'Professional'
        ),
        array(
            'Technology',
            'Gadgets',
            'Tech News',
            'Podcasting',
            'Software How-To'
        ),
        array(
            'TV & Film'
        )
    );
?>