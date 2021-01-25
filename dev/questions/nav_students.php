<style>
p.page-title{
	font-size: 19px;
    font-weight: bold;
    background-color: aliceblue;
    border-bottom: 1px solid;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.list-item{
  background:white;
  padding:10px;
    width:100%;
  display:inline-block;
  text-align:left;
}
.nav-tabs{
  margin:40px 0px 0px;  
}
.tab-content{
  background:#ddd;
  padding:20px 20px;
  margin:10px 0px 0px;
}
.nav-tabs>li>a {
  padding:10px 30px;
  font-size:20px;
}
.dropdown {
  position: relative;
  display: inline-block; 
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 300px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
  margin:0px 0px 0px;
  padding:20px; 
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

a.dropbtn{cursor: pointer !important;}
.nav-tabs>li>a:hover {
    border-color: #eee #eee #ddd;
	border-bottom-color: transparent;
}
.nav>li{
	margin-bottom:-1px;
}
.nav>li>a:focus, .nav>li>a:hover {
    text-decoration: none;
	background-color: #fff;	
}
</style>
<?php 
$count_arr=array();
$count_arr['pending_quiz']=get_count_incomplete_quiz($num=1);
$count_arr['pending_assessments']=get_count_pending_assessments($num=1);
// upcoming_sessions.php
$count_arr['upcoming_sessions']=0;
$count_arr['completed_quiz']=$result_opn1=get_completed_quiz($num=1);
$count_arr['completed_assessments']=$result_opn2=get_completed_assessments($num=1);
 
 //print_r($count_arr);
/* tel pas login*/

$str = "SELECT * FROM `Tel_UserDetails` WHERE  `IntervenID`='".$_SESSION['student_id']."' ORDER BY ID DESC
		LIMIT 1";

$moodle_data = mysql_fetch_assoc(mysql_query($str));
$TeluserName =base64_encode($moodle_data['UesrName']);
$TelPas  =   base64_encode($moodle_data['PassWord']);
if($moodle_data['TelUserID']>0){

	
	$url= "http://ec2-35-165-58-67.us-west-2.compute.amazonaws.com/dev/telpasLoginByStu.php?username=".$TeluserName."&password=".$TelPas."&uiId=".$_SESSION['student_id'];
}
else{
	$url= "https://englishpro.us/questions/telpas_student_regis.php?uiId=".$_SESSION['student_id'];
}
?>
<ul class="nav nav-tabs ">
					<li class="dropdown" >
					   <a class="dropbtn" href="pending_assessments.php" style="display:none;" >Tests 1</a>
					    <?php if($count_arr['pending_assessments']>0){?>
						<div class="dropdown-content tab-content-2" style="display:none;">
						
						   <div class="row">
								<div class="col-md-12">
									<div class="list-item">
										<?php if($count_arr['pending_assessments']>0):?>
											<p><a href="pending_assessments.php">Assigned Data Dash Tests</a></p>
										<?php endif;?>
									</div>
								   
								</div>
						   </div>
						</div> <?php } //  ?>
					</li>
					<li class="dropdown" >
					    <a class="dropbtn" href="student_pendings.php">Tutoring</a>
						<div class="dropdown-content tab-content-2">
						   <div class="row">
								<div class="col-md-12">
									<div class="list-item">
										<p><a href="student_pendings.php">Upcoming Tutorial session</a></p>										 
									</div>
									<div class="list-item">
										<p><a href="recorded_sessions.php">Recorded Tutoring Sessions</a></p>										 
									</div>
								</div>
							</div>
						</div>
					</li>
					<li class="dropdown">
					    <a class="dropbtn" href="incomplete_quiz.php">Quiz</a>
					    <?php  if($count_arr['pending_quiz']>0){?>
						<div class="dropdown-content tab-content-2">
						   <div class="row">
								<div class="col-md-12">
									<div class="list-item">
									 <?php  if($count_arr['pending_quiz']>0): ?>
									<p><a href="incomplete_quiz.php">Incomplete Exit Quiz</a></p>
									<?php endif;?>
									</div>
								</div>
						   </div>
						</div>
						<?php   }//endif;?>
					</li>
					<li class="dropdown">
					    <a class="dropbtn" href="completed_quiz.php">Results</a>
					    <?php if($count_arr['completed_quiz']>0||$count_arr['completed_assessments']>0){?>
						<div class="dropdown-content tab-content-2">
						   <div class="row">
								<div class="col-md-12">
									<div class="list-item">
									<?php   if($count_arr['completed_quiz']>0):?>
										<p><a href="completed_quiz.php">Quiz Results</a></p>
										<?php  endif;?>
										 <?php if($count_arr['completed_assessments']>0):?>
						 				<p><a href="completed_assessments.php">Data Dash Results</a></p>
										<?php endif;?>
									</div>
								</div>
						   </div>
						</div>  <?php  }//endif;?>
					</li>
					<?php 
					if(_CheckTelpassPermissionStudent()==1){ ?>
					<li>
					   <a class="dropbtn" href="<?php echo $url?>">TELPAS Pro-Practice</a></li>
				<?php } ?>
				</ul>