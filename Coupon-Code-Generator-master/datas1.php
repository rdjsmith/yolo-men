<link href="css/bootstrap.css" rel="stylesheet">
<div class="container">

<center>

<input type="text" id="search-box" class="form-control" >

<div id="result"><h3 id="coupon"></h3></div>

<button id="redeem">Redeem</button><br>
<button class="btn btn-default" id="search-btn">Search</button>


</center>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	$("#redeem").hide();
	$("#search-btn").click(function(){

		var number=$("#search-box").val();
	$.post( "search.php", { number: number })
  		.done(function( data ) {
    		
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
    	$("#result").append('<h3>'+data+'</h3>');
    	$("#redeem").show();
    }
     });
	});

	

</script>
<script>
	$("#redeem").click(function(){
		var number=$("#search-box").val();
		var coupon=$("#coupon").text();
	
		$.post( "redeem.php", { number: number,coupon:coupon })
  		.done(function( data ) {
  			
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
     else if(data==8){
        $("#result").empty();
      $("#result").append('Coupon Verified');
        $("#redeem").hide();

    }
      else {
      	$("#result").empty();
    	
    }
    

    		});
	});

</script>