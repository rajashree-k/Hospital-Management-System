<?php
require('top.inc.php');
isAdmin();
$categories='';
$msg='';
if(isset($_GET['apptID']) && $_GET['apptID']!=''){
	$id=get_safe_value($con,$_GET['apptID']);
	$res=mysqli_query($con,"select * from appointment where apptID='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$apptDate=$row['apptDate'];
		$apptTime=$row['apptTime'];
		$apptFees=$row['apptFees'];
		$docID=$row['docID'];
		$patID=$row['patID'];
	}else{
		header('location:appointment.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$apptDate=get_safe_value($con,$_POST['apptDate']);
    $apptTime=get_safe_value($con,$_POST['apptTime']);
	$apptFees=get_safe_value($con,$_POST['apptFees']);
	$docID=get_safe_value($con,$_POST['docID']);
	$patID=get_safe_value($con,$_POST['patID']);
	$res=mysqli_query($con,"select * from appointment where apptDate='$apptDate'and apptTime='$apptTime'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['apptID']) && $_GET['apptID']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['apptID']){
			
			}else{
				$msg="APPOINTMENT ALREADY EXIST";
			}
		}else{
			$msg="APPOINTMENT ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['apptID']) && $_GET['apptID']!=''){
			mysqli_query($con,"update appointment set apptDate='$apptDate',apptTime='$apptTime',apptFees='$apptFees',docID='$docID',patID='$patID' where apptID='$id'");
		}else{
			mysqli_query($con,"insert into appointment(apptDate,apptTime,apptFees,docID,patID) values('$apptDate','$apptTime','$apptFees','$docID','$patID')");
		}
		header('location:appointment.php');
		die();
	}
}
?>
<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>APPOINTMENT MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="apptDate" class=" form-control-label">ApptDate</label>
									<input type="date" name="apptDate" placeholder="Enter ApptDate" class="form-control" required value="<?php echo $apptDate?>">
								</div>
								<div class="form-group">
									<label for="apptTime" class=" form-control-label">ApptTime</label>
									<input type="time" name="apptTime" placeholder="Enter ApptTime" class="form-control" required value="<?php echo $apptTime?>">
								</div>
								
								<div class="form-group">
									<label for="apptFees" class=" form-control-label">ApptFees</label>
									<input type="number" name="apptFees" placeholder="Enter ApptFees" class="form-control" required value="<?php echo $apptFees?>">
								</div>
								<div class="form-group">
									<label for="docID" class=" form-control-label">DocID</label>
									<input type="number" name="docID" placeholder="Enter DocID" class="form-control" required value="<?php echo $docID?>">
								</div>
								<div class="form-group">
									<label for="patID" class=" form-control-label">patID</label>
									<input type="number" name="patID" placeholder="Enter PatID" class="form-control" required value="<?php echo $patID?>">
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