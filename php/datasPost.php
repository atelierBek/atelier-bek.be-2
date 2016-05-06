<?php
    
    # dirDatas
    $dirDatas = "../datas";

    # get datas from post
    $authorValue = $_POST['data'][0];    
    $categoryValue = $_POST['data'][1];    
    $textValue = $_POST['data'][2];    
    $dateValue = $_POST['data'][3];    
    $timeValue = $_POST['data'][4];

    $fileCount = count($_FILES['file']['name']);

    $reg_date = '/\b[0-9][0-9]-(0[1-9]|1[0-2])-([0-2][0-9]|3[0-1])\b/';
    $reg_time = '/\b([0-1][0-9]|2[0-3])-[0-5][0-9]-[0-5][0-9]\b/';
    
    # check posted datas or files and error messages
    if (empty($authorValue)) {
	echo "Merci de choisir au moins un auteur.";
    } else if (empty($categoryValue)) {
	echo "Merci de choisir au moins une catégorie.";
    } else if (strlen($textValue) === 0 && $fileCount === 0  ) {
        echo strlen($textValue) . "Vous ne pouvez pas envoyer de post vide. Merci d'écrire un texte ou d'ajouter un fichier.";
    } else if (!preg_match($reg_date, $dateValue) && !empty($dateValue)) {
	echo "Merci de choisir une date au format yy-mm-dd.";
    } else if (!preg_match($reg_time, $timeValue) && !empty($timeValue)) {
	echo "Merci de choisir une heure au format hh-mm-ss.";
    } else {


    # generate send date and time if empty
    if (empty($dateValue)) {
        $dateValue = date('y-m-d');
    }
    if (empty($timeValue)) {
	$timeValue = date('H-i-s');
    }

    $sendDateTimeValue = $dateValue . "_" . $timeValue;

    # explode for check
    $dateArr = explode("-", $dateValue);
    $timeArr = explode("-", $timeValue);

    # check if folder exists
    while (file_exists($dirDatas . "/" . $sendDateTimeValue) && is_dir($dirDatas . "/" . $sendDateTimeValue)) {
	# increment one second if while exists
	$timeArr[2]++;
	$sendDateTimeValue = $dateArr[0] . "-" . $dateArr[1] . "-" . $dateArr[2] . "_" . $timeArr[0] . "-" . $timeArr[1] . "-" . $timeArr[2];
    }

    # create post dir + files dir and move uploaded files
    mkdir($dirDatas . "/" . $sendDateTimeValue, 0777);
    #mkdir($dirDatas . "/" . $sendDateTimeValue . "/" . "files", 0777);
    #mkdir($dirDatas . "/" . $sendDateTimeValue . "/" . "images_sources", 0777);
    #mkdir($dirDatas . "/" . $sendDateTimeValue . "/" . "images_resized", 0777);

    # iterate trough files and move in files dir 
    for($i = 0; $i < $fileCount; $i++) {

	# check if file is images
	$imagesExt ="jpg,JPG,jpeg,JPEG,gif,GIF,png,PNG";
	$imagesExtArr = explode(",", $imagesExt);
		

	# if
	move_uploaded_file($_FILES['file']['tmp_name'][$i],  $dirDatas . "/" . $sendDateTimeValue . "/" . "images_sources" . "/". $_FILES['file']['name'][$i]);

    }

    # xml dom doc and params
    $xml = new DOMDocument('1.0'); # new dom doc
    $xml->formatOutput = true; # format output
    $xml->preserveWhiteSpace = false; # preserve whitespace

    # create post element as root 
    $post = $xml->createElement("post");

    # create elements
    $date = $xml->createElement("date", $dateValue);
    $time = $xml->createElement("time", $timeValue);
    $author = $xml->createElement("author", $authorValue);
    $category = $xml->createElement("category", $categoryValue);
    $text = $xml->createElement("text", $textValue);
    
    # append elements to post 
    $post->appendChild($date);
    $post->appendChild($time);
    $post->appendChild($author);
    $post->appendChild($category);
    $post->appendChild($text);

    # append post to xml
    $xml->appendChild($post);
    
    # save xml
    $file = $dirDatas . "/" . $sendDateTimeValue . "/" . "datas.xml";
    $xml->save($file);
    
    # message 
    echo "Votre post a bien été envoyé. Merci.";
    
    }


?>
