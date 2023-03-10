<?php
require('top.inc.php');
isAdmin();
$categories='';
$msg='';

$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hospital";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
if(isset($_GET['roomID']) && $_GET['roomID']!=''){
	$id=get_safe_value($con,$_GET['roomID']);
	$res=mysqli_query($con,"select * from room where roomID='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories=$row['roomBlock'];
		$roomFloor=$row['roomFloor'];
		$roomNo=$row['roomNo'];
	}else{
		header('location:room.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['roomBlock']);
    $roomFloor=get_safe_value($con,$_POST['roomFloor']);
    $roomNo=get_safe_value($con,$_POST['roomNo']);
	$res=mysqli_query($con,"select * from room where roomBlock='$categories'and roomFloor='$roomFloor'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['roomID']) && $_GET['roomID']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['roomID']){
			
			}else{
				$msg="ROOM ALREADY EXIST";
			}
		}else{
			$msg="ROOM ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['roomID']) && $_GET['roomID']!=''){
			mysqli_query($con,"update room set roomBlock='$categories',roomFloor='$roomFloor' where roomID='$id'");
		}else{
			mysqli_query($con,"insert into room(roomBlock,roomFloor,roomNo) values('$categories','$roomFloor','$roomNo')");
		}
		header('location:room.php');
		die();
	}
}

	
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>ROOMS MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="roomBlock" class=" form-control-label">ROOMBLOCK</label>
									<input type="text" name="roomBlock" placeholder="Enter roomblock" class="form-control" required value="<?php echo $categories?>">
								</div>
								<div class="form-group">
									<label for="roomFloor" class=" form-control-label">ROOMFLOOR</label>
									<input type="number" name="roomFloor" placeholder="Enter roomfloor" class="form-control" required value="<?php echo $roomFloor?>">
								</div>
								<div class="form-group">
									<label for="roomNo" class=" form-control-label">ROOMNO</label>
									<input type="number" name="roomNo" placeholder="Enter roomno" class="form-control" required value="<?php echo $roomNo?>">
								</div>
								
								
							   <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
							   <span id="payment-button-amount">SUBMIT</span>
							   </button>
							   <div class="field_error"><?php echo $msg?></div>
							</div>
						</form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<?php
require('footer.inc.php');
?>