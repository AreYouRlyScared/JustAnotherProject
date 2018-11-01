<?php
include_once "db.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$Numservers = "1";

function hour_min($minutes){
	if($minutes <= 0) return '0h 0m';
else
	return sprintf("%02d",floor($minutes / 60)). 'h '.sprintf("%02d",str_pad(($minutes % 60), 2, "0", STR_PAD_LEFT)). "m";
}?>
<html>
<table cellspacing="2.5">
	<thread>
		<tr>
			<th>Server Name</th>
			<th>Game Version</th>
			<th><img src="images/players.png"></th>
			<th width="80px"><img src="images/time.png"></th>
			<th><img src="images/password.png"></th>
			<th>Mods</th>
		</tr>
	</thread>
	<tfoot>
		<th>Name</th>
		<th>Game Version</th>
		<th>Max Players</th>
		<th>Map Time</th>
		<th>Password</th>
		<th>Mods</th>
	</tfoot>
	<tbody>
<?php
$read = mysqli_query($conn, "SELECT * FROM servers;");
while ($row = mysqli_fetch_array($read)){?>
	<tr>
    <td><?php echo $row['name'];?></td>
	<td align="center"><?php if($row['game_version'] == '0.17.0'){ echo "	";}else{ echo $row['game_version'];}?></td>
    <td align="center"><?php if($row['max_players'] == 0){ echo "∞";}else{ echo $row['max_players'];}?></td>
	<td align="center"><?php echo hour_min($row['game_time_elapsed']);?></td>
    <td align="center"><?php if($row['has_password'] == 0){ echo '<img src="images/no.png"></img>';}else{ echo '<img src="images/yes.png"></img>';}?></td>
    <td align="center"><?php if($row['has_mods'] == 0){ echo '<img src="images/no.png"></img>';}else{ echo '<img src="images/yes.png"></img>';}?></td>
   </tr>
<?
	$total += $Numservers;
	};?>
</tbody>
<p> Total Servers: <b><? echo $total;?></b></p>
</html>