<script type="text/javascript">

			$('#employee').on('change', function(e) {
				
				var employee = $("#employee").val();
				var position = $("#position").val();
				var division = $("#division").val();
				var section = $("#section").val();
				var unit = $("#unit").val();
				
				var dataString = 'employee='+ employee +'&position='+ position +'&division='+ division +'&section='+ section +'&unit='+ unit;

				$.ajax ({
				
					type: "GET",
					url: "{{ route('ajax.get.employee.order') }}",
					data: dataString,
					cache: false,
					success: function(html)
				
					{
					
					$("#order_from").html(html);
					$("#order_to").html(html);
				
					} 
				});

				
			});

</script>

