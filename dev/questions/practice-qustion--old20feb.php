<?php
include("iframe-telpass-header.php");
if (!$_SESSION['student_id'])
{
    header('Location: login.php');
    exit;
} 
?>
<style>
.p-20 .image-hotspot-question {
    text-align:center ;
}
.p-20 .h5p-image-hotspot-question .image-wrapper {
    text-align: initial;
}
</style>
<div id="home main" class="clear fullwidth tab-pane fade in active">
    <div class="container">
      <div class="row"> <div class="clear" style="padding: 15px"></div>
      </div>
    </div>
  <div class="container">
      <div class="row .d-inline-block inlincss">
        <div class="col-md-6 col-sm-6" style="padding:10px;">
        <?php
          $page=$_GET['q'];
          $couserID = $_GET['c'];
          require_once'MoodleWebServices/get-course-content.php';
         // print_r($respons);
          $next=1;
          /* this is question instant ID */
          $instanceID = $instance[$Qustion[$page]];
          $dataString="?question_id=".$instanceID."&course_id=".$couserID;
          require_once'MoodleWebServices/get-course-intro.php';
          //print_r($responseData);
          $pre=count($Qustion);
          if(isset($page)) 
            {
                  if($page < $pre )
                  {
                     $next = $page+1;
                  } 

                  if($page > 1)
                  {
                      $pre = $page-1;
                  }
           }  

          $phpself   = $_SERVER['PHP_SELF'];
          $next      = $phpself."?q=".$next.'&c='.$couserID;
          $prev      = $phpself."?q=".$pre.'&c='.$couserID;
          if($page > 1){ ?>
<a class="next-ques" 
href="<?php echo $prev?>"><img src="https://www.intervene.io/images/arrowleft.png" width="70" height="55"></a>
<?php } 
if($page < count($Qustion)){
?>
<a  class="next-ques2"
href="<?php echo $next?>"><img src="https://www.intervene.io/images/arrowright.png" width="70" height="55"></a>
<?php }
require_once'MoodleWebServices/get-coursename.php';
$cat_id=$responsName['courses'][0]['categoryid']; ?> 
<div class="row" style="margin-left: 1px;">
    <strong> Category : <?php echo $responsName['courses'][0]['categoryname']; ?> </strong> &nbsp;&nbsp;&nbsp;
     <strong>Assignment : <?php echo $responsName['courses'][0]['displayname'];?></strong>
</div>
</div>
<div class="col-md-6 col-sm-6" style="padding: 20px;text-align: right;">
<?php if($page==count($Qustion)){?>
<a  href="javascript:void(0)" class="btn next-done" data_id="<?php echo $couserID?>" id="IScomp">Complete</a>
<br>
<?php }?>
</div> 
</div>
<?php if(count($Qustion) > 0){ ?>
 <div class="row inline2" >
<?php if(!empty($introOfQuestion)){?>
<div class="col-12 content" style="text-align: left;padding: 20px;">
    <?php echo $introOfQuestion;?>
  </div>
<?php
} 
if (strpos($questionName, 'Record') !== false) {
    require 'audio/record.php';
}
else if (strpos($questionName, 'Writing') !== false) {
require 'writing_text.php';
}
else{ ?>
    <iframe class="p-20" src="https://ellpractice.com/intervene/moodle/mod/hvp/embed.php?id=<?php echo $Qustion[$page];?>" width="100%" height="100%" frameborder="0" allowfullscreen="allowfullscreen" allow="microphone ; camera ;">
      </iframe>
      <?php } ?>
    </div> 
     <?php } 
     else{ ?>
      <div class="row inline3">
        <div class="alert alert-warning alert-dismissible">
    <a href="https://intervene.io/questions/telpas_practice.php" class="close" aria-label="close">&times;</a>
    <strong>Opps! </strong> In this course not added any question  till Now.
  </div>
</div> 
<?php }?>
</div>
</div>
<script src="../iframeTemplate/vendor/jquery/jquery.slim.min.js"></script>
<script src="../iframeTemplate/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" type="text/css" href="audio/style-min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script> 
  $('#IScomp').click(function(){
    $(this).attr('disabled','disabled');
    $.ajax({
              type: 'POST',
              url: 'is_compelete_ajax.php',
              timeout: 3000,
              data:{course_id:$(this).attr('data_id'),iscom:'yes',course_cat_id: +'<?php echo $cat_id; ?>' },
              success: function (data) {
                if(data > 0 )
                {

                   window.location='https://intervene.io/questions/telpas_practice.php';}
                   console.log(data);

              }

          });

  });</script>