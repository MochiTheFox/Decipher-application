<?php
if (file_exists('chiffre.json')) {
	$myChiffreArr = mb_str_split(json_decode(file_get_contents('chiffre.json'))[0]->chiffreLetters);
	$myChiffreLen = count($myChiffreArr);
} else {
	header('Location: error.php');
}

// Encoding
if (isset($_POST["toEncode"]) && $_POST["toEncode"] !== "") {
	$mySalt = rand(0, $myChiffreLen -1);
	$arrToEncode = mb_str_split(nl2br(htmlspecialchars($_POST['toEncode'])));
	$encodingLen = count($arrToEncode);
	$myCounter = 1;
	for ($i = 0; $i < $encodingLen; $i++) {
		$myIndex = array_search($arrToEncode[$i], $myChiffreArr);
		$myCypher = ($myIndex + $mySalt + $myCounter);
		$shiftedIndex = $myCypher % $myChiffreLen;
		array_splice($arrToEncode, $i, 1, $myChiffreArr[$shiftedIndex]);
		$myCounter++;
	}
	array_unshift($arrToEncode, $myChiffreArr[$mySalt]);
	$encryptedWord = str_replace("<", "&#60;", implode($arrToEncode));
}

// Decoding
if (isset($_POST["toDecode"]) && $_POST["toDecode"] !== "") {
	$arrToDecode = mb_str_split($_POST['toDecode']);
	$mySalt = array_search($arrToDecode[0], $myChiffreArr);
	array_shift($arrToDecode);
	$decodingLen = count($arrToDecode);
	$myCounter = 1;
	for ($i = 0; $i < $decodingLen; $i++) {
		$myIndex = array_search($arrToDecode[$i], $myChiffreArr);
		$myCypher = ($myIndex - $mySalt - $myCounter);
		while($myCypher < 0) {
			$myCypher += count($myChiffreArr);
		}
		$shiftedIndex = $myCypher % $myChiffreLen;
		array_splice($arrToDecode, $i, 1, $myChiffreArr[$shiftedIndex]);
		$myCounter++;
	}
	$decryptedWord = str_replace('&#60;br />aa', "<br>", str_replace("<", "&#60;", implode($arrToDecode)));
}
