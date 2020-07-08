document.getElementById("book_audio").addEventListener("change", () =>{
	var book_audio = document.querySelector('input[name="book_audio"]:checked').value;
	if(book_audio == "audio")
		document.getElementById("pageCountGroup").hidden = true;
	else
		document.getElementById("pageCountGroup").hidden = false;
});

document.getElementById("physical_digital").addEventListener("change", () =>{
	var physical_digital = document.querySelector('input[name="physical_digital"]:checked').value;
	if(physical_digital == "digital"){
		document.getElementById("quantityGroup").hidden = true;
		document.getElementById("quantity").required = false;
		document.getElementById("mediaGroup").hidden = false;
		document.getElementById("mediaFile").required = true;
	}
	else {
		document.getElementById("quantityGroup").hidden = false;
		document.getElementById("quantity").required = true;
		document.getElementById("mediaGroup").hidden = true;
		document.getElementById("mediaFile").required = false;
	}
});