var form = null,
	start = 0;

setInterval(function () {
	var adminID = document.getElementById("adminID").value;
	var message = document.getElementsByClassName("msg-bubble");
	var lastid = message[message.length - 1].id;
	
	var formData = new FormData();
	formData.append("lastid", lastid);
	$.ajax({
		type: "POST",
		url: "chat/newMsg.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			if (data) {
				var html = "";
				
				data = JSON.parse(data);
				data.forEach(function (item, index) {
					if (adminID == item.stud_ID) {
						html +=
							`<div class="msg right-msg">
              <div id="` +
							item.id +
							`" class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name">` +
							item.name +
							`</div>
                  <div class="msg-info-time">` +
							item.time +
							`</div>
                </div>

                <div class="msg-text">
                ` +
							item.message +
							`
                </div>
              </div>
            </div>`;
					} else {
						html +=
							`<div class="msg left-msg">
              <div id="` +
							item.id +
							`" class="msg-bubble">
                <div class="msg-info">
                  <div class="msg-info-name">` +
							item.name +
							`</div>
                  <div class="msg-info-time">` +
							item.time +
							`</div>
                </div>

                <div class="msg-text">
                ` +
							item.message +
							`
                </div>
              </div>
            </div>`;
					}
				});
				document.getElementById("chatDB").innerHTML += html;
				var elem = document.getElementById("chatDB");
				elem.scrollTop = elem.scrollHeight;
			}
		},
	});
}, 500);

function sendMsg() {
	var message = document.getElementById("message-to-send").value;
	document.getElementById("message-to-send").value = "";
	var formData = new FormData();
	formData.append("message", message);
	$.ajax({
		type: "POST",
		url: "chat/sendMsg.php",
		data: formData,
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			
		},
	});
}

function blockList() {
	var blockList = document.getElementById("blockList");
	$.ajax({
		type: "POST",
		url: "chat/blockList.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			blockList.options.length = 0;
			if (data) {
				var data = JSON.parse(data);
				var i = 0;
				for (var key in data) {
					blockList.options[i] = new Option(key + " - " + data[key], key);
					i++;
				}
			}
			//$("#bookID option").attr("selected", "selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}
blockList();

function notBlockList() {
	var notBlockList = document.getElementById("notBlockList");
	$.ajax({
		type: "POST",
		url: "chat/notBlockList.php",
		contentType: false, // Dont delete this (jQuery 1.6+)
		processData: false, // Dont delete this
		success: function (data) {
			notBlockList.options.length = 0;
			if(data) {
				var data = JSON.parse(data);
				var i = 0;
				for (var key in data) {
					notBlockList.options[i] = new Option(key + " - " + data[key], key);
					i++;
				}
			}
			//$("#bookID option").attr("selected", "selected");
			$(".selectpicker").selectpicker("refresh");
		},
		//Other options
	});
}
notBlockList();

$('#blockUser').on('click', () => {
	if($('#notBlockList').val().length) {
		var userIDs = JSON.stringify($('#notBlockList').val());
		var formData = new FormData();
		formData.append('userIDs', userIDs);
		$.ajax({
			type: "POST",
			url: "chat/blockUser.php",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function () {
				blockList();
				notBlockList();
			},
			//Other options
		});
	}
})

$('#unblockUser').on('click', () => {
	if($('#blockList').val().length) {
		var userIDs = JSON.stringify($('#blockList').val());
		var formData = new FormData();
		formData.append('userIDs', userIDs);
		$.ajax({
			type: "POST",
			url: "chat/unblockUser.php",
			data: formData,
			contentType: false, // Dont delete this (jQuery 1.6+)
			processData: false, // Dont delete this
			success: function () {
				blockList();
				notBlockList();
			},
			//Other options
		});
	}
})