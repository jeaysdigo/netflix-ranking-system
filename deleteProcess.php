<?php

$xml = new domdocument("1.0");

$xml->load("BSIT3EG1G3.xml");
$netflixOriginals = $xml->getElementsByTagName("topNetflixOriginals");
$searchid = $_POST["id"];

foreach ($netflixOriginals as $topNetflixOriginals) {

    $id = $topNetflixOriginals->getAttribute("id");

    if ($searchid == $id) {

        $xml->getElementsByTagName("netflixOriginals")->item(0)->removeChild($topNetflixOriginals);
        $xml->save("BSIT3EG1G3.xml");

        header('location: index.php');
        break;
        
    } else {
        echo "<center><h3>Cannot delete data. Select to delete. <a href='index.php'>Back to index</a></h3><center>";

    }
}
?>