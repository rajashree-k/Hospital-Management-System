<?php
require('top.inc.php');
isAdmin();
$categories='';
$msg='';
$categories1='';
$patAddress='';
if(isset($_GET['patID']) && $_GET['patID']!=''){
	$id=get_safe_value($con,$_GET['patID']);
	$res=mysqli_query($con,"select * from patient where patID='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories=$row['patFname'];
        $categories1=$row['patLname'];
		$patGender=$row['patGender'];
		$patContact=$row['patContact'];
		$patDOB=$row['patDOB'];
		$patAddress=$row['patAddress'];
		$status=$row['status'];
	}else{
		header('location:patient.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['patFname']);
    $categories1=get_safe_value($con,$_POST['patLname']);
    $patGender=get_safe_value($con,$_POST['patGender']);
	$patContact=get_safe_value($con,$_POST['patContact']);
	$patDOB=get_safe_value($con,$_POST['patDOB']);
	$patAddress=get_safe_value($con,$_POST['patAddress']);
	$status=get_safe_value($con,$_POST['status']);
	$res=mysqli_query($con,"select * from patient where patFname='$categories'and patLname='$categories1'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['patID']) && $_GET['patID']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['patID']){
			
			}else{
				$msg="DOCTOR ALREADY EXIST";
			}
		}else{
			$msg="DOCTOR ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['patID']) && $_GET['patID']!=''){
			mysqli_query($con,"update patient set patFname='$categories',patLname='$categories1',patGender='$patGender',patContact='$patContact',patDOB='$patDOB',patAddress='$patAddress',status='$status' where patID='$id'");
		}else{
			mysqli_query($con,"insert into patient(patFname,patLname, patGender,patContact,patDOB,patAddress,status) values('$categories','$categories1','$docContact','$patContact','$patDOB','$patAddress','$status')");
		}
		header('location:patient.php');
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
                        <div class="card-header"><strong>PATIENT MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="patFname" class=" form-control-label">patFname</label>
									<input type="text" name="patFname" placeholder="Enter Firstname" class="form-control" required value="<?php echo $categories?>">
								</div>
								<div class="form-group">
									<label for="patLname" class=" form-control-label">patLname</label>
									<input type="text" name="patLname" placeholder="Enter Lastname" class="form-control" required value="<?php echo $categories1?>">
								</div>
								
								<div class="form-group">
									<label for="patGender" class=" form-control-label">patGender</label>
									<input type="text" name="patGender" placeholder="Enter patGender" class="form-control" required value="<?php echo $patGender?>">
								</div>
								<div class="form-group">
									<label for="patContact" class=" form-control-label">patContact</label>
									<input type="number" name="patContact" placeholder="Enter patContact" class="form-control" required value="<?php echo $patContact?>">
								</div>
								<div class="form-group">
									<label for="patDOB" class=" form-control-label">patDOB</label>
									<input type="date" name="patDOB" placeholder="Enter patDOB" class="form-control" required value="<?php echo $patDOB?>">
								</div>
								<div class="form-group">
									<label for="patAddress" class=" form-control-label">patAddress</label>
									<input type="text" name="patAddress" placeholder="Enter patAddress" class="form-control" required value="<?php echo $patAddress?>">
								</div>
								<div class="form-group">
									<label for="status" class=" form-control-label">Status</label>
									<input type="number" name="status" placeholder="Enter mobile" class="form-control" required value="<?php echo $status?>">
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