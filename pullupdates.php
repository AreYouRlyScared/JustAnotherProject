<?php
include_once "db.php";

$json = file_get_contents('https://multiplayer.factorio.com/get-games?username=AreYouScared&token='. $accesstoken . '');
$conn = mysqli_connect($servername, $username, $password, $dbname);

$decode = json_decode($json, true);
foreach($decode as $server){
	$sql = "INSERT INTO servers (gameid, name, max_players, game_version, game_time_elapsed, has_password, last_heartbeat, has_mods, mod_count) 
			VALUES ('" . $server["game_id"] . "', '" . addslashes($server["name"]) . "', '" . $server["max_players"] . "', '" . $server["application_version"]["game_version"] . "', '" . $server["game_time_elapsed"]. "', '" . $server["has_password"] . "', '" . $server["last_heartbeat"] . "', '" . $server["has_mods"] . "', '" . $server["mod_count"] . "')
			ON DUPLICATE KEY UPDATE
			name = '". addslashes($server["name"]) . "',
			max_players = '". $server["max_players"] . "',
			game_version = '". $server["application_version"]["game_version"] . "',
			game_time_elapsed = '". $server["game_time_elapsed"] . "',
			has_password = '". $server["has_password"] . "',
			last_heartbeat = '". $server["last_heartbeat"] . "',
			has_mods = '". $server["has_mods"] . "',
			mod_count = '". $server["mod_count"] . "'
			;";
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	if (mysqli_query($conn, $sql)){
		//nothing
	}else{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
