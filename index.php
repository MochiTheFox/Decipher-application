<!DOCTYPE html>
<?php
	if (file_exists('main.php')) {
		require_once 'main.php';
	} else {
		header('Location: error.php');
	}
	?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/main.css">
	<title>Encoder/Decoder</title>
</head>
<body>
	<header>
		<h1>Encoding/Decoding cipher engine</h1>
	</header>

	<main>

		<!-- Encoding -->
		<div class="codeBox">
			<form action="index.php" method="post">
				<p>Encoding Box</p>
				<textarea name="toEncode" id="toEncode" class="textArea" rows="10" placeholder="Please enter your secrets"><?php if(isset($_POST["toEncode"])){echo $_POST["toEncode"];}?></textarea>
				<div class="buttons">
					<input type="file" name="searchFile" id="searchFile">
					<input type="submit" value="Encode" id="encodeBtn">
				</div>
			</form>
			<button class="buttons" id="pasteBtnEn">Paste</button>
			<hr>
			<p>Secrets secrets..</p>
			<div><div class="resultOutput" id="encodedDiv"><?php
					if (isset($_POST['toEncode']) && $_POST['toEncode'] !== "") {
							echo $encryptedWord;
					}
					?></div>
			</div>
			<div class="resultBox"></div>
			<div class="buttons">
				<button id="copyEncodeBtn">Copy</button>
				<button id="saveEncodeBtn">Save</button>
			</div>
		</div>


		<!-- Decoding -->
		<div class="codeBox">
			<form action="index.php" method="post">
				<p>Do you want to decode?</p>
				<textarea name="toDecode" id="toDecode" class="textArea" rows="10" placeholder="Type Text, upload file or Strg+V.. for the lazy ones.."><?php if(isset($_POST["toDecode"])){echo $_POST["toDecode"];}?></textarea>
				<div class="buttons">
					<input type="file" name="file" id="file">
					<input type="submit" id="decodeBtn" value="Decode">
				</div>
			</form>
			<button class="buttons" id="pasteBtnDe">Paste</button>
			<hr>
			<p>Alakazam yourself!</p>
			<div class="resultOutput" id="decodedDiv"><div><?php
					if (isset($_POST['toDecode']) && $_POST['toDecode'] !== "") {
							echo $decryptedWord;
					}
					?></div>
			</div>
			<div class="resultBox"></div>
			<div class="buttons">
				<button id="copyDecodeBtn">Copy</button>
				<button id="saveDecodeBtn">Save</button>
			</div>
		</div>
		</div>
	</main>
	<div id="overlay"></div>
</body>
<script src="src/main.js"></script>

</html>