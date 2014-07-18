<link href="css/bootstrap.css" rel="stylesheet">
<div class="container">
<center>
<br><br>
<form action="post.php" method="post">
	<input class="form-control" type="text" name="number" id="number"><br>
	<label><h3 id="result"></h3></label><br>
  <label><input type="checkbox" id="condition">Agree</label><br>
	<input type="BUTTON" id="submit"value="Submit" disabled class="btn btn-lg btn-success"><br>

</form>

</center>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script>

$("#condition").change(function(){
    if (this.checked) {
$("#submit").removeAttr("disabled");
}
else{
  $("#submit").attr("disabled", "disabled");
}
});
	$("#submit").click(function(){

		var number=$("#number").val();
		$.post( "post.php", { number: number })
  .done(function( data ) {
    // alert( "Data Loaded: " + data );
    if(data==1){
    		$("#result").empty();
    	$("#result").append('nodata');
    }
    else if(data==2){
    	$("#result").empty();
    	$("#result").append('Enter a 10 Digit Number');
    }
     else if(data==5){
     		$("#result").empty();
    	$("#result").append('data not found');
    }

     else if(data==6){
        $("#result").empty();
      $("#result").append('Coupon Used');
    }
      else {
      	$("#result").empty();
    	$("#result").append(data);
    }
    
    
  });

});

</script>