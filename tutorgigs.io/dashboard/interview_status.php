<?php
/*****
 @Step 3: Interview

****/
 include("header.php");
 $step_2_url='quiz.php'; //QUIZ Button
 $step_3_url='interview.php'; //Interview Button




 $tutor_det=mysql_fetch_assoc(mysql_query("SELECT * FROM `gig_teachers` WHERE id=".$_SESSION['ses_teacher_id']));

//Signup State
  $get_state_arr=unserialize($tutor_det['signup_state']);
  //print_r($get_state_arr);
  // Can access web site.
$_SESSION['ses_access_website']='no'; // 1==if all 4 step completed by user
  $_SESSION['ses_access_website']; 

 $data2=mysql_fetch_assoc(mysql_query("SELECT * FROM `tutor_profiles` WHERE tutorid=".$_SESSION['ses_teacher_id']));

$edit=unserialize($data2['profile_1']);
 //print_r($edit);

//////Add profile 1///////


 echo  'Interview status ';


 ?>
<link type="text/css" href="css/home-page.css" rel="stylesheet" />
<style>
.btn-green
	{
	    background: #5cb85c;
		padding:40px 70px;
		text-center:center;
		font-size:30px;
		color:#fff;
		margin-bottom:20px;
	}
</style>
<div id="main" class="clear fullwidth">
	<div class="container">
		<div class="row">
			<?php  //include("sidebar.php"); ?>    
                        
			<!-- <div id="content" class="col-md-8 col-md-offset-2"> -->
			<div id="content" class="col-md-12">
				
				<div class="page-content" style="background-image: url('images/wizard-v3.jpg')">
					<div class="wizard-v3-content">
						<div class="wizard-form">
							<div class="wizard-header">
								<h3 class="heading">Complete your Registration</h3>
								<p>Fill all form field to go next step</p>
							</div>
							<form class="form-register" action="" method="post">
								<div id="xxform-total">
                                         
                          <div class="steps clearfix"><ul role="tablist"><li role="tab" aria-disabled="false" class="first done" aria-selected="false"><a id="form-total-t-0" href="#form-total-h-0" aria-controls="form-total-p-0"><div class="title">
										<span class="step-icon"><i class="zmdi zmdi-account"></i></span>
										<span class="step-text">Application</span>
									</div></a></li><li role="tab" aria-disabled="false" class="done" aria-selected="false"><a id="form-total-t-1" href="#form-total-h-1" aria-controls="form-total-p-1"><div class="title">
										<span class="step-icon"><i class="zmdi zmdi-lock"></i></span>
										<span class="step-text">Quiz</span>
									</div></a></li><li role="tab" aria-disabled="false" class="current" aria-selected="true"><a id="form-total-t-2" href="#form-total-h-2" aria-controls="form-total-p-2"><span class="current-info audible"> </span><div class="title">
										<span class="step-icon"><i class="zmdi zmdi-card"></i></span>
										<span class="step-text">Interview</span>
									</div></a></li><li role="tab" aria-disabled="false"><a id="form-total-t-3" href="#form-total-h-3" aria-controls="form-total-p-3"><div class="title">
										<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
										<span class="step-text">Payment Info </span>
									</div></a></li><li role="tab" aria-disabled="false"><a id="form-total-t-4" href="#form-total-h-4" aria-controls="form-total-p-4"><div class="title">
										<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
										<span class="step-text">Legal Stuff </span>
									</div></a></li><li role="tab" aria-disabled="false" class="last"><a id="form-total-t-5" href="#form-total-h-5" aria-controls="form-total-p-5"><div class="title">
										<span class="step-icon"><i class="zmdi zmdi-receipt"></i></span>
										<span class="step-text">Training </span>
									</div></a></li></ul></div>


									<!-- SECTION 1 -->
									<!-- Tutor Side – After quiz completed Next button should advance to schedule Tutor
									interview schedule button -->
									
									<section>
										<div class="inner">
											<!-- <h3 class="text-center text-primary">Interview</h3> -->

									<!-- <p class="text-primary">Note- Interview step approved , you can login . !</p> -->

											<div class="form-row">


												<!-- <p class="text-primary text-center">Status- <a href="application_status.php" class="btn btn-sm btn-danger">Pending</a></p> -->

												<p class="text-primary text-center">Your interview is scheduled and to check back after interview to see if they were approved.</p>



												

											</div>
											<br/>

											

											
										</div>

									</section>
									<!-- SECTION 2 -->



								


								</div>
							</form>
						</div>
					</div>
				</div>
			</div>		<!-- /#content -->
			<div class="clearnone">&nbsp;</div>
		</div>
	</div>
</div>		<!-- /#main -->

<?php include("footer.php"); ?>

<?php 
 print_r($_SESSION);
?>