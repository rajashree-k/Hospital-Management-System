<?php
require('top.inc.php');
isAdmin();
$categories='';
$msg='';
if(isset($_GET['specID']) && $_GET['specID']!=''){
	$id=get_safe_value($con,$_GET['specID']);
	$res=mysqli_query($con,"select * from specialty where specID='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$specDesc=$row['specDesc'];
		$specTrmtCost=$row['specTrmtCost'];
		$status=$row['status'];
	}else{
		header('location:specialty.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories=get_safe_value($con,$_POST['specDesc']);
    $specTrmtCost=get_safe_value($con,$_POST['specTrmtCost']);
	$status=get_safe_value($con,$_POST['status']);
	$res=mysqli_query($con,"select * from specialty where specDesc='$categories'and specTrmtCost='$specTrmtCost'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['specID']) && $_GET['specID']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id==$getData['specID']){
			
			}else{
				$msg="SPECIALTY ALREADY EXIST";
			}
		}else{
			$msg="SPECIALTY ALREADY EXIST";
		}
	}
	
	if($msg==''){
		if(isset($_GET['specID']) && $_GET['specID']!=''){
			mysqli_query($con,"update specialty set specDesc='$categories',specTrmtCost='$specTrmtCost',status='$status' where specID='$id'");
		}else{
			mysqli_query($con,"insert into specialty(specDesc,specTrmtCost,status) values('$categories','$specTrmtCost','$status')");
		}
		header('location:specialty.php');
		die();
	}
}
?>
			<div class="content pb-0">
            <div class="animated fadeIn">
               <div class="row">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-header"><strong>SPECIALTY MANAGEMENT FORM</strong><small> </small></div>
                        <form method="post" enctype="multipart/form-data">
							<div class="card-body card-block">
							   
								
								<div class="form-group">
									<label for="specDesc" class=" form-control-label">specDesc</label>
									<input type="text" name="specDesc" placeholder="Enter specDesc" class="form-control" required value="<?php echo $categories?>">
								</div>
								<div class="form-group">
									<label for="specTrmtCost" class=" form-control-label">specTrmtCost</label>
									<input type="number" name="specTrmtCost" placeholder="Enter specTrmtCost" class="form-control" required value="<?php echo $specTrmtCost?>">
								</div>
								
								<div class="form-group">
									<label for="status" class=" form-control-label">status</label>
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