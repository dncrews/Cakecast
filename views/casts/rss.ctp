<?php
    echo "<?xml version='1.0' encoding='UTF-8'?>";
?>
    
    <rss xmlns:itunes='http://www.itunes.com/dtds/podcast-1.0.dtd' version='2.0'>
        <channel>
<?php
    foreach($settings as &$setting) {
        $setting = htmlentities($setting);
    }
    foreach ($casts as &$cast) {
        foreach ($cast['User'] as &$user) {
            $user = htmlentities($user);
        }
        foreach ($cast['Cast'] as &$podcast) {
            $podcast = htmlentities($podcast);
        }
    }
    unset($cast);
    $realUrl = 'http://' . $_SERVER['HTTP_HOST'];
?>

        <title><?php echo $settings['title'];?></title>
        <link><?php echo $settings['site_url'];?></link>
        <copyright><?php echo $settings['copyright'];?></copyright>
        <itunes:subtitle><?php echo $settings['subtitle'];?></itunes:subtitle>
        <itunes:author><?php echo $settings['author'];?></itunes:author>
        <itunes:summary><?php echo $settings['summary'];?></itunes:summary>
        <description><?php echo $settings['description'];?></description>
        <itunes:owner>
            <itunes:name><?php echo $settings['owner_name'];?></itunes:name>
            <itunes:email><?php echo $settings['owner_email'];?></itunes:email>
        </itunes:owner>
        <itunes:image href='<?php echo $realUrl . $this->webroot . 'img/' . $settings['album_art'];?>' />
<?php
            $categoryArray = explode('|', $settings['category']);
            array_pop($categoryArray);
            $catHTML = '';
            foreach($categoryArray as $mainCat) {
                if (strstr($mainCat, ',')) {
                    $subCatArray = explode (',', $mainCat);
                    $mainCat = array_shift($subCatArray);
                    $catHTML .= 
'        <itunes:category text="'. $mainCat .'">';
                    foreach ($subCatArray as $subCat) {
                        $catHTML .= '
            <itunes:category text="'. $subCat .'" />';
                    }
                    $catHTML .= '
        </itunes:category>
';
                }
                else {
                    $catHTML .= 
'        <itunes:category text="'. $mainCat .'" />
';
                }
            }
            echo $catHTML;
?>
        <itunes:explicit><?php echo $settings['explicit']?></itunes:explicit>
<?php foreach ($casts as $cast) { ?>
        

            <item>
                <title><?php echo $cast['Cast']['title'];?></title>
                <itunes:author><?php echo $cast['User']['name'];?></itunes:author>
                <artist><?php echo $cast['User']['name'];?></artist>
                <itunes:subtitle><?php echo $cast['Cast']['subtitle'];?></itunes:subtitle>
                <itunes:summary><?php echo $cast['Cast']['summary'];?></itunes:summary>
                <enclosure url='<?php echo $realUrl . $this->webroot . 'archive/' . $cast['Cast']['filename'];?>' length='<?php echo $cast['Cast']['length'];?>' type='<?php echo $cast['Cast']['mime_type'];?>' />
                <guid><?php echo $realUrl . $this->webroot . 'archive/' . $cast['Cast']['filename'];?></guid>
                <pubDate><?php echo $cast['Cast']['created'];?></pubDate>
                <itunes:duration><?php echo $cast['Cast']['duration'];?></itunes:duration>
                <itunes:keywords><?php echo $cast['Cast']['keywords'];?></itunes:keywords>
            </item>
<?php } ?>
        </channel>
    </rss>
