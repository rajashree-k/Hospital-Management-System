<?php
require('top.inc.php');
isAdmin();
if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['roomID']);
		
		$update_status_sql="update room set status='$status' where roomID='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['roomID']);
		$delete_sql="delete from room where roomID='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select * from room order by roomID asc";
$res=mysqli_query($con,$sql);



?>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
				<div class="card-body">
				   <h4 class="box-title">ROOM</h4>
				   <h4 class="box-link"><a href="manage_room.php">ADD ROOM</a> </h4>
				</div>
				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial">#</th>
							   <th>ID</th>
							   <th>RoomBlock</th>
                               <th>RoomFloor</th>
                               <th>RoomNo</th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
							$i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"><?php echo $i?></td>
							   <td><?php echo $row['roomID']?></td>
							   <td><?php echo $row['roomBlock']?></td>
                               <td><?php echo $row['roomFloor']?></td>
                               <td><?php echo $row['roomNo']?></td>
							   <td>
								<?php
								echo "<span class='badge badge-edit'><a href='manage_room.php?roomID=".$row['roomID']."'>Edit</a></span>&nbsp;";
								
								echo "<span class='badge badge-delete'><a href='?type=delete&roomID=".$row['roomID']."'>Delete</a></span>";
								
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