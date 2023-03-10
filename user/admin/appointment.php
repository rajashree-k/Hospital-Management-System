<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['specID']);
		
		$update_status_sql="update spec set status='$status' where specID='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['apptID']);
		$delete_sql="delete from appointment where apptID='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from appointment order by apptID asc";
$res=mysqli_query($con,$sql);



?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">APPOINTMENT</h4>
				   <h4 class="box-link"><a href="manage_appointment.php">ADD APPOINTMENT FEES</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>ApptDate</th>
							   <th>ApptTime</th>
                               <th>ApptFees</th>
                               <th>DocID</th>
                               <th>PatID</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['apptID']?></td>
							   <td><?php echo $row['apptDate']?></td>
                               <td><?php echo $row['apptTime']?></td>
                               <td><?php echo $row['apptFees']?></td>
                               <td><?php echo $row['docID']?></td>
                               <td><?php echo $row['patID']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-edit'><a href='manage_appointment.php?apptID=".$row['apptID']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&apptID=".$row['apptID']."'>Delete</a></span>";
								
								?>
							   </td>
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