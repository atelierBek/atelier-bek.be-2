<?php

    $postArr = glob("../datas/*", GLOB_ONLYDIR);
    $reversedPostArr = array_reverse($postArr);

    foreach ($reversedPostArr as $post) {

    $datas = simplexml_load_file($post . "/datas.xml");

    # date time from dir basename
    #$sendDateTimeStr = basename($post);
    #$sendDateTimeArr = explode("_", $sendDateTimeStr);
    #$sendDateStr = $sendDateTimeArr[0];
    #$sendDateArr = explode("-", $sendDateStr);
    #$sendTimeStr = $sendDateTimeArr[1];
    #$sendTimeArr = explode("-", $sendTimeStr);
    
    # date time from xml
    $sendDateStr = $datas->date;
    $sendDateArr = explode("-", $sendDateStr);
    $sendTimeStr = $datas->time;
    $sendDateTimeStr = $sendDateStr . "_" . $sendTimeStr;
    $sendTimeArr = explode("-", $sendTimeStr);

    # div
    echo "<div id=\"" . $sendDateTimeStr . "\" class=\"post\">";

	# text  
	$text = $datas->text;
	$regex = preg_replace(
	  '#((https?|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i',
	  "<a href=\"$1\" target=\"_blank\">$3</a>$4",
	  $text
	);
	echo "<p class=\"text\">" . $regex . "</p>";

	# images
	echo "<div class=\"images\">";
	$imagesExt ="jpg,JPG,jpeg,JPEG,gif,GIF,png,PNG";
	$imagesExtArr = explode(",", $imagesExt);
	$images = glob($post . "/files/*" . "{" . "." . $imagesExt . "}",GLOB_BRACE );
	foreach ($images as $image) {
	    $imageName = basename($image);
	    $imageExt = pathinfo($image, PATHINFO_EXTENSION);
	    $imagePath = substr($image,3);
	    echo "<img class=\"image\" src=\"" . $imagePath . "\">"; 
	}	    
	echo "</div>";
	
	# files
	echo "<div class=\"files\">";
	$files = glob($post . "/files/*");
	foreach ($files as $file) {
		$fileName = basename($file);
		$fileExt = pathinfo($file, PATHINFO_EXTENSION);
		$filePath = substr($file,3);
		if (in_array($fileExt, $imagesExtArr)) {
		} else {
		    echo "<p><a class=\"file\" href=\"" . $filePath . "\">" . $fileName . "</a></p>"; 
		}

	    }
	echo "</div>";

	# other datas
	$categoryStr = $datas->category;
	$categoryArr = explode(",", $categoryStr);
	$authorStr = $datas->author;
	$authorArr = explode(",", $authorStr);

	echo "<p class=\"datas\">";
	echo "Posté le ";
	    echo "<span class=\"sendDateTime\">" . $sendDateArr[0] . "/" . $sendDateArr[1] . "/" . $sendDateArr[2] . " à " . $sendTimeArr[0] . ":" . $sendTimeArr[1] . ":" . $sendTimeArr[2] . "</span>";
	    echo " dans";
	    foreach ($categoryArr as $category) {
		echo " <span data-filterType=\"category\" class=\"category\">$category</span>";
	    }
	    echo " par";
	    foreach ($authorArr as $author) {
		echo " <span data-filterType=\"author\" class=\"author\">$author</span>";
	    }
	    echo ".";	
	echo "</p>";

    echo "</div>";
    }
?>
	   


	   
	
