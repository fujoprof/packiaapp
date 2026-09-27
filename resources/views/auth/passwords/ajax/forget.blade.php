<script type="text/javascript" src="{{ asset('assets/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script>
$(document).on('click','#getotp',function(e) {
    var phone = $('#your_number').val();
    $.ajax({
         data: {
					type: 2,
					phone: phone,
					_token:'{{ csrf_token() }}'
								
				},
         type: "post",
         url: "{{route('forget-password.store')}}",
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#email_section").show();
						$("#resetpassword").show();
						$("#otp_section").hide();
						$("#getotp").hide();
					}
					else{
					    alert(dataResult);
					}
					
				}
	});
	
});
$(document).on('click','#login',function(e) {
    var otp = $('#otp').val();
    $.ajax({
				data:   {
							type: 3,
							otp: otp
										
						},
				type: "post",
				url : "login_ajax.php",
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						alert("Login successful !");
					}
					else{
					    alert("Invalid OTP !");
					}
					
				}
	});
	
});
</script>