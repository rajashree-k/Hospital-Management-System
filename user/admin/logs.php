<?php
require('top.inc.php');
isAdmin();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";
$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
$sql="select * from logs";
$res=mysqli_query($con,$sql);



?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
			 <div class="card-body">
				   <h4 class="box-title">LOG TABLE</h4>
</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>PID</th>
							   <th>ACTION</th>
							   <th>CURRENTDATE</th>
							   <th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['ID']?></td>
							   <td><?php echo $row['PID']?></td>
							   <td><?php echo $row['action']?></td>
							   <td><?php echo $row['Cdate']?></td>
							   <td>
							</tr>
							<?php } ?>
						 </tbody>
					  </table>
				   </div>
				</div>
			 </div>
		  </div>
	   </div>
	</div>
</div>
<?php
require('footer.inc.php');
?>