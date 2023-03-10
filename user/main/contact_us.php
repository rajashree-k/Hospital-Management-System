<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospital";
$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
$sql="select * from contact_us";
$res=mysqli_query($conn,$sql);



?>
<main>
<div class="content pb-0">
	<div class="orders">
	   <div class="row">
		  <div class="col-xl-12">
			 <div class="card">
			 <div class="card-body">
				   <h4 class="box-title">CONTACT US</h4>
</div>

				<div class="card-body--">
				   <div class="table-stats order-table ov-h">
					  <table class="table ">
						 <thead>
							<tr>
							   <th class="serial"></th>
							   <th>ID</th>
							   <th>NAME</th>
							   <th>EMAIL</th>
							   <th>COMMENT</th>
							   <th>
							</tr>
						 </thead>
						 <tbody>
							<?php 
						
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td class="serial"></td>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><?php echo $row['email']?></td>
							   <td><?php echo $row['comment']?></td>
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
</main>
<style>
main{
				padding:5px;
				font-family:"Helvetica","Arial";
				margin:-8px;
			}
			h2{
				font-size:20px;
				padding:10%;
				display:block;
				color:#262626;
			}
table{
				display:;
				margin:9px;
				width:100%;
				padding:1%;
				margin-top:2%;
                
			}
			table,th,td{
				border-bottom:1px solid;
				font-size:16px;
				border-collapse:collapse;
                
			}
			th,td{
				padding:3%;
				border-spacing 5px;
			}
			th{
				color:#262626;
				background-color:#e6e6e6;
                column-gap:60px;
				border-spacing 5px;
				

			}
			tr:hover{
				background-color:#f2f2f2;
			}
</style>