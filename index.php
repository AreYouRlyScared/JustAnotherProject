<?php
include_once "db.php";
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<p> Total Servers: <b><? echo $Numservers;?></b></p>

<table cellspacing="2.5">
	<thread>
		<tr>
			<th>Server Name</th>
			<th>Game Version</th>
			<th>Max Players</th>
			<th>Map Time</th>
			<th>Password</th>
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
	<td><?php if($row['game_version'] == '0.17.0'){ echo "	";}else{ echo $row['game_version'];}?></td>
    <td><?php if($row['max_players'] == 0){ echo "∞";}else{ echo $row['max_players'];}?></td>
	<td><?php echo $row['game_time_elapsed'];?></td>
    <td><?php if($row['has_password'] == 0){ echo "No";}else{ echo "Yes";}?></td>
    <td><?php if($row['has_mods'] == 0){ echo "No";}else{ echo "Yes";}?></td>
   </tr>
<?};?>
</tbody>
</html>