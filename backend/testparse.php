<?php
namespace Freshteapot\experiment\hnd3;

//Get the file
$fileToLogData = __DIR__ . "/hacker_news.log";

$url = "http://nerdist.libsyn.com/rss";
$html = file_get_contents($url);

//Hopefully this should never happen
if (empty($html)) {
    exit;
}

//Disable error messages.
libxml_use_internal_errors(true);
$dom = new \DOMDocument();
$a = $dom->loadHTML($html);
libxml_clear_errors();
$xpath = new \DOMXpath($dom);

$query = "//item";
$nodes = $xpath->query($query);

//Shared time
$timeStamp = time();
$position = 1;
foreach($nodes as $node) {
    //We only want links.
    //$link = $xpath->evaluate("string(span[@class='comhead'])", $node);
    //if (empty($link)) {
    //    continue;
    //}

    $item = array(
        "title" => $xpath->evaluate("string(title)", $node),
        "pubDate" => $xpath->evaluate("string(pubDate)", $node),
        "link" => $xpath->evaluate("string(link)", $node),
        "description" => $xpath->evaluate("string(description)", $node),
        "url" => $xpath->evaluate("string(enclosure/@length)")
    );
    print_r($item);
    echo "<br><br>";
    
    
    /**
    //Post-processing
    $item["id"] = substr($item["id"], 8);

    list($item["score"], ) = explode(" ", $item["score"], 2);

    $item["domain"] = trim($item["domain"]);
    $item["domain"] = trim($item["domain"], "()");

    //Position on the frontpage
    $item["position"] = $position;

    $data = json_encode($item) . PHP_EOL;
    //error_log($data, "3", $fileToLogData);
    **/
    $position++;
}