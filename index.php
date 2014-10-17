<html>
	<head>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script>
		$(function(){
			pullNotification();
		});
		function pullNotification(timestamp){
			var data = {};
			if(typeof timestamp!='undefined')
				data.timestamp = timestamp;
			else
				data.timestamp = '';
			$.post('longpoll.php',data,function(msg){
		 
				var newData = '';
				for(i in msg.notifications){
					newData+=msg.notifications[i].message+'\n';
				}
				if(newData!='')
				{
					alert(newData);
					pullNotification(msg.timestamp);
				}	
				//alert(msg.timestamp);
			},'json');
		}
		</script>
	</head>
	<body>
	</body>
</html>
