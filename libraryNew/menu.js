$(document).ready(function(){
	
	//alert("hi start ...");
	console.log("hiiiiiiiiiiiiiii");
		
	$(".startPage").click(function(){
		
		console.log("startPage click");
		
    	let id = $(this).prop("id");
    	
    	console.log("startPage click id ",id);
    	
		functionRouter(id);
		 
	});
	
		
});  





function functionRouter(id){

	if(id == "adminAddBook") {
		console.log("admin add...........");
		alert("hi adminAddBook");
        //window.location="yourphppage.php";
        location.href = "add.php";
        //location.href = "refund.php?transaction_id="+transaction_id; 
	}else if(id=="adminIssueBook"){
		console.log("admin issue.........");
		alert("hi adminIssueBook");
		location.href = "issue.php";
		
	}else if(id=="adminReturnBook"){
		
		console.log("admin return.........");
		alert("hi adminReturnBook");
		location.href = "return.php";
	}else{
			console.log("something bad happened functionRouter");
		}
}