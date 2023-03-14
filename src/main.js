const myQuerries = ['searchFile', 'encodeBtn', 'copyEncodeBtn', 'saveEncodeBtn', 'file', 'decodeBtn', 'copyDecodeBtn', 'saveDecodeBtn', 'decodedDiv', 'encodedDiv', 'toEncode', 'toDecode', 'pasteBtnDe', 'pasteBtnEn'];
for (let item of myQuerries) {
	item = document.querySelector('#' + item);
}

// Box oben Links
searchFile.addEventListener('change', () => {
	const fileToLoad = searchFile.files[0];
	const textType = /text.*/;
	if(fileToLoad.type.match(textType)) {
		const myReader = new FileReader();
		myReader.onload = function() {
			toEncode.innerHTML = myReader.result;
		}
		myReader.readAsText(fileToLoad);
	} else {
		toEncode.innerHTML = "Text Files only.. Bitch.."
	}
});

// Box oben Rechts
file.addEventListener('change', () => {
	const fileToLoad = file.files[0];
	const textType = /text.*/;
	if(fileToLoad.type.match(textType)) {
		const myReader = new FileReader();
		myReader.onload = function() {
			toDecode.innerHTML = myReader.result;
		}
		myReader.readAsText(fileToLoad);
	} else {
		toDecode.innerHTML = "Text Files only.. Bitch.."
	}
});

// Copy Button unten Links
copyEncodeBtn.addEventListener("click", () => {
	navigator.clipboard.writeText(encodedDiv.textContent);
	overlayMsg('encoded ')
});

// Copy Button unten Rechts
copyDecodeBtn.addEventListener("click", () => {
	navigator.clipboard.writeText(decodedDiv.textContent);
	overlayMsg('decoded ')
});

// Save Button unten Links
saveEncodeBtn.addEventListener("click", () => {
	let dataStr = "data:text/plain;charset=utf-8," + encodeURIComponent(encodedDiv.innerText);
	let myDownload = document.createElement('a');
	myDownload.setAttribute('href', dataStr);
	let fileName = prompt("Name your file");
	myDownload.setAttribute('download', fileName + '.txt');
	if(!fileName) {
		return
	}
	document.body.append(myDownload);
	myDownload.click();
	myDownload.remove();
})

// Save Button unten Rechts
saveDecodeBtn.addEventListener("click", () => {
	let dataStr = "data:text/plain;charset=utf-8," + encodeURIComponent(decodedDiv.innerText);
	let myDownload = document.createElement('a');
	myDownload.setAttribute('href', dataStr);
	let fileName = prompt("Name your file");
	myDownload.setAttribute('download', fileName + '.txt');
	if(!fileName) {
		return
	}
	document.body.append(myDownload);
	myDownload.click();
	myDownload.remove();
})

// Overlay
function overlayMsg(state) {
  overlay.innerHTML = state + 'text<br><br>COPIED';
  overlay.style.display = 'flex';
  overlay.style.fontWeight = 'bold';
  myInterval = setInterval(() => {
    overlay.style.display = 'none';
    clearInterval(myInterval);
  }, 1500);
}

// Paste Button oben Rechts
pasteBtnDe.addEventListener("click", pasteMyClipboardDe);
async function pasteMyClipboardDe()	{	
	var myClipboard = await navigator.clipboard.readText();
	toDecode.value = myClipboard;
}

// Paste Button oben Links
pasteBtnEn.addEventListener("click", pasteMyClipboardEn);
async function pasteMyClipboardEn()	{	
	var myClipboard = await navigator.clipboard.readText();
	toEncode.value = myClipboard;
}

// Paste Button nur in bestimmten Browsern sichtbar
document.addEventListener("DOMContentLoaded", () => {
	if(!navigator.userAgent.includes("Chrome")) {
		pasteBtnDe.style.display = "none";
		pasteBtnEn.style.display = "none";
	} else {
		pasteBtnDe.style.display = "block";
		pasteBtnEn.style.display = "block";
	}
})