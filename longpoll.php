<?php
set_time_limit(0);
// Create connection
$con = mysql_connect('localhost','root','');
$db = mysql_select_db('demo');

$newData = false;
$notifications = array();

if($_POST['timestamp'] != ''){
	$timestamp = $_POST['timestamp'];
}
else{
	$row = mysql_fetch_assoc(mysql_query('SELECT now() as now'));
	$timestamp = $row['now'];
}

while(true){	

	$requestedTimestamp = isset ( $_GET [ 'timestamp' ] ) ? (int)$_GET [ 'timestamp' ] : null;
	clearstatcache();
	
	if ( $requestedTimestamp == null ||   $requestedTimestamp > $timestamp )
	{
		$sql = "SELECT * FROM `notification` WHERE timestamp > '".$timestamp."' ";
		$result = mysql_query($sql);
		
		// check for new data
		
		if(mysql_num_rows($result) > 0)
		{
			while($row = mysql_fetch_assoc($result)){
				$notifications[] = $row;
				$newData = true;
			}
			// get current database time
			$row = mysql_fetch_assoc(mysql_query('SELECT now() as now'));
			$timestamp = $row['now'];
			// output
			if(empty($notifications))
			{
				$notifications  =  '';
			}
			$data = array('notifications'=>$notifications,'timestamp'=>$timestamp);
			echo json_encode($data);
			die;
		}
	}	
	else{
			sleep( 1 );
			continue;
	}
}
