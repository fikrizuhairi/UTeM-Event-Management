<?php
if (isset($_POST['search'])) {
        $search = htmlentities($_POST['search']);
 
$db = mysql_connect('localhost','root','',''); //Don't forget to change
mysql_select_db('event_management', $db);             //theses parameters
$sql = "SELECT * from program WHERE program_name LIKE '$search%'";
$req = mysql_query($sql) or die();
?>
<table data-toggle="table" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="asc">
	<thead>
		<tr>
										      
			<th class="text-center">Requested Date</th> 
			<th class="text-center">Staff Name</th> 
			<th class="text-center">Product Requested</th>


		</tr>
	</thead>
 <tbody>
<?php 
while ($data = mysql_fetch_array($req))
{
      //echo '<li><a href="#" onclick="selected(this.innerHTML);">'.htmlentities($data['program_name']).'</a></li>';
	  echo '<tr>';
		echo '<td>';
		echo '<center>';
		echo $data['program_name'];
		echo '</center>';
		echo '</td>';
		echo '<td>';
		echo '<center>';
		echo $data['start_date'];
		echo '</center>';
		echo '</td>';
		echo '<td>';
		echo '<center>';
		echo $data['end_date'];
		echo '</center>';
		echo '</td>';

	echo '</tr>';	
}
echo '</ul>';
mysql_close();
exit;
}
?>


										 <?php
											
											while($objResult = mysqli_fetch_array($objQuery))
											{
											
										}
										?>
										</tbody>
										</table>