<html>
	<script src="https://code.jquery.com/jquery-latest.js"></script>
		<script>
		function get_ddc()
		{
			var isbn=$("#isbn").val();
			var title=$("#title").val();
			var author=$("#author").val();
			alert(isbn);
			alert(title);
			$.get("form_get.php",{isbn:isbn,title:title,author:author},
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
				ISBN number *not needed*: <input name="isbn" id="isbn" type="text" /> <br />  <!-- Not Compusary -->
				Title *compulsary*: <input name="title" id="title" type="text" /> <br />  <!-- Compusary -->
				Author*compulsary*: <input name="author" id="author" type="text" /> <br />  <!-- Compusary -->
				<input type="button" value="Submit" onclick="get_ddc()"/>
			</form>
			<br>----------------------------------------------
			<div id="json_response"></div>
		</center>
	</body>
</html>




