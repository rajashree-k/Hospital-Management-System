<?php
require('top.inc.php');
isAdmin();
$categories='';
$msg='';
$categories1='';
if(isset($_GET['docID']) && $_GET['docID']!=''){
	$id=get_safe_value($con,$_GET['docID']);
	$res=mysqli_query($con,"select * from doctor where docID='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories=$row['docFname'];
        $categories1=$row['docLname'];
		$docContact=$row['docContact'];
		$specID=$row['specID'];
		$roomID=$row['roomID'];
		$status=$row['status'];
	}else{
		header('location:doctor.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['docFname']);
    $categories1=get_safe_value($con,$_POST['docLname']);
    $docContact=get_safe_value($con,$_POST['docContact']);
	$specID=get_safe_value($con,$_POST['specID']);
	$roomID=get_safe_value($con,$_POST['roomID']);
	$status=get_safe_value($con,$_POST['status']);
	$res=mysqli_query($con,"select * from doctor where docFname='$categories'and docLname='$categories1'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['docID']) && $_GET['docID']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['docID']){
			
			}else{
				$msg="DOCTOR ALREADY EXIST";
			}
		}else{
			$msg="DOCTOR ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['doctID']) && $_GET['docID']!=''){
			mysqli_query($con,"update doctor set docFname='$categories',docLname='$categories1',docContact='$docContact',specID='$specID',roomID='$roomID',status='$status' where docID='$id'");
		}else{
			mysqli_query($con,"insert into doctor(docFname,docLname, docContact,specID,roomID,status) values('$categories','$categories1','$docContact','$specID','$roomID','$status')");
		}
		header('location:doctor.php');
		die();
	}
}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "hospital";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>DOCTOR MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="docFname" class=" form-control-label">DocFname</label>
									<input type="text" name="docFname" placeholder="Enter Firstname" class="form-control" required value="<?php echo $categories?>">
								</div>
								<div class="form-group">
									<label for="docLname" class=" form-control-label">DocLname</label>
									<input type="text" name="docLname" placeholder="Enter Lastname" class="form-control" required value="<?php echo $categories1?>">
								</div>
								
								<div class="form-group">
									<label for="docContact" class=" form-control-label">DocContact</label>
									<input type="number" name="docContact" placeholder="Enter Contact" class="form-control" required value="<?php echo $docContact?>">
								</div>
								<div class="form-group">
									<label for="specID" class=" form-control-label">SpecID</label>
									<input type="number" name="specID" placeholder="Enter specID" class="form-control" required value="<?php echo $specID?>">
								</div>
								<div class="form-group">
									<label for="roomID" class=" form-control-label">RoomID</label>
									<input type="number" name="roomID" placeholder="Enter roomID" class="form-control" required value="<?php echo $roomID?>">
								</div>
								<div class="form-group">
									<label for="status" class=" form-control-label">Status</label>
									<input type="number" name="status" placeholder="Enter status" class="form-control" required value="<?php echo $status?>">
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