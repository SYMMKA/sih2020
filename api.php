<html>
	<script src="https://code.jquery.com/jquery-latest.js"></script>
		<script>
		function get_ddc()
		{
			var ip=$("#isbn").val();
			var title=$("#title").val();
			var author=$("#author").val();
			alert(ip);
			alert(title);
			$.get("form_get.php",{ip:ip,title:title,author:author},
			function(data)
			{
				$("#json_response").html(data);
			}

			);
			
		}
	</script>
	<body>
		<center>
			<h3>Write ISBN number </h3>
			<form>
				ISBN number: <input name="isbn" id="isbn" type="text" /> <br />
				Title: <input name="title" id="title" type="text" /> <br />
				Author: <input name="author" id="author" type="text" /> <br />
				<input type="button" value="Submit" onclick="get_ddc()"/>
			</form>
			<br>----------------------------------------------
			<div id="json_response"></div>
		</center>
	</body>
</html>




