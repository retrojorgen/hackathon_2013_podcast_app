<?php
header('Content-type: application/json');


date_default_timezone_set("Europe/Belgrade");

$podcastArray = jsonPodcast("http://localhost/podcast-app/app/rss-feeds/screwattack.rss", $podcastArray);
$podcastArray = jsonPodcast("http://localhost/podcast-app/app/rss-feeds/nerdist.rss", $podcastArray);

print json_encode($podcastArray);

function jsonPodcast($url, $podcastArray) {
$xml = simplexml_load_file($url);
  foreach($xml->children() as $child)
    {
    	foreach($child as $element => $value) {
    		if($element == 'item') {
    			$value_array = xml2array($value);

          $pubDate = strftime("%Y-%m-%d %H:%M:%S", strtotime($value_array['pubDate']));

    			$podcastArray[] = array(
    				"title" => $value_array['title'],
    				"date" => $pubDate,
    				"url" => $value_array['enclosure']['@attributes']['url']
  				);
    		}
    	}
    }
    return $podcastArray;
  
}

function xml2array ( $xmlObject, $out = array () )
{
    foreach ( (array) $xmlObject as $index => $node )
        $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

    return $out;
}
	
?>