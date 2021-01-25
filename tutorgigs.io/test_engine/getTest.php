<?php

    require_once 'includes/db_connect.php';
    
    $test = mysqli_query($connection, "SELECT * FROM tests WHERE ID = '".$_GET['test_id']."'");
    $isTest = $test->num_rows;

    
    if($isTest) {  $testRecord = mysqli_fetch_assoc($test);
?>

 <input type="hidden" id="test_id" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                                                  	<div class="form-group">
								<label>Test Name</label>
                                                                <input type="text" class="form-control" placeholder="Test Name" id="tName" name="tName" required="" value="<?php echo $testRecord['Name'];?>">
							</div>	
                                                       <div class="form-group">
								<label>Passing Percent(%)</label>
                                                                <input id="tMark" name="percent" type="number" min="1" placeholder="e.g-30%" class="form-control" required value="<?php echo $testRecord['PassingMark'];?>">
						       </div>
                                                       <div class="form-group">
								<label>Shown in Test List</label>
									<div class="radio-inline">
															<label class="radio">
                                                                                                                        <input type="radio" name="tIsActive" id="tIsActive-0" value="1" <?php if($testRecord['IsActive'] == 1) { echo 'checked="checked"'; }?> >
															<span></span>Active</label>
															<label class="radio">
                                                                                                                        <input type="radio" name="tIsActive" id="tIsActive-1" value="0" <?php if($testRecord['IsActive'] == 0) { echo 'checked="checked"';}?>>
															<span></span>Not Active</label>
															
														</div>
														
													</div>
    <?php } ?>