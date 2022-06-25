<?
include 'includes-class/db.config.class.php';
include 'sessions_file.php';

if(isset($_POST["course_id"]) && !empty($_POST["course_id"])){
   
    $CourseID = $_POST["course_id"];
    //Count total number of rows
    $BatchNum = $Batch->GetBatchByCourseNum($CourseID);
    $BatchRes = $Batch->GetBatchByCourseRes($CourseID);

    if ($BatchNum > 0)
    {
         echo '<option value="">Select batch</option>';
        while ($BatchData = $Batch->dbfetch($BatchRes))
        {
          $BatchID = $BatchData["batchid"];
          $BatchTitle = $BatchData["kk_title"];
          $BatchYearFrom = $BatchData["kk_year_from"];
          $BatchYearTo = $BatchData["kk_year_to"];
        
            echo '<option value="'.$BatchID.'">'.$BatchTitle.'-'.$BatchYearFrom.'</option>';
        }
    }else{
        echo '<option value="">batch not available</option>';
    }
}

if(isset($_POST["batch_id"]) && !empty($_POST["batch_id"])){
    //Get all city data
    $BatchID = $_POST["batch_id"];
    //Count total number of rows
    $BatchSemesterNum = $BatchSemester->GetBatchSemesterByBatchNum($BatchID);
    $BatchSemesterRes = $BatchSemester->GetBatchSemesterByBatchRes($BatchID);

    if ($BatchSemesterNum > 0)
    {
         echo '<option value="">Select semester</option>';
        while ($BatchSemesterData = $BatchSemester->dbfetch($BatchSemesterRes))
        {
          $BatchSemesterID = $BatchSemesterData["batch_semesterid"];
          $BatchSemesterTitle = $BatchSemesterData["kk_title"];
        
            echo '<option value="'.$BatchSemesterID.'">'.$BatchSemesterTitle.'</option>';
        }
    }else{
        echo '<option value="">batch semester not available</option>';
    }
}

if(isset($_POST["batch_semester_id"]) && !empty($_POST["batch_semester_id"])){
    //Get all city data
    $BatchSemesterID = $_POST["batch_semester_id"];
    //Count total number of rows
    $SemStudentNum = $Student->GetStudentBySemesterNum($BatchSemesterID);
    $SemStudentRes = $Student->GetStudentBySemesterRes($BatchSemesterID);
    
    $SubjectRes = $Subject->GetSubjectResBySemesterID($BatchSemesterID);

    if ($SemStudentNum > 0)
    {
         //echo '<option value="">Select semester</option>';


        ?>
          <div class="row ">
              <div class="form-group ">
                
                <div class="col-md-2 student_add-attand">
                     <label for="student">Name</label>
                </div>
                <?
                $ai=0;
                while ($SubjectData = $Subject->dbfetch($SubjectRes))
                {
                  $ai++;
                  $SubjectID = $SubjectData["subjectid"];
                  $SubjectTitle = $SubjectData["sub_title"];
                  $Subjecttotal_lactures = $SubjectData["sub_total_lactures"];
                ?>
                <div class="col-md-1"><label for="student"><?=$SubjectTitle;?></label><BR><?=$Subjecttotal_lactures;?>
                   
                </div>
                <?
                if($SubjectNum == $ai){ $ai=0;}
                  } 
                ?>
                
                
              </div>
            </div>
           <?

                    while ($SemStudentData = $Student->dbfetch($SemStudentRes))
                    {
                      $SemID = $SemStudentData["std_semid"];
                      $SemStudentID = $SemStudentData["sem_student_id"];

                      $StudentData = $Student->GetStudentDetails($SemStudentID);
                      $StudentID = $StudentData["studentid"];
                      $StudentFirstName = $StudentData["std_firstname"];
                      $StudentLastName = $StudentData["std_lastname"];
                      $StudentId_Code = $StudentData["std_id_code"];
                
                    ?>
            <div class="row ">
                <div class="form-group ">
                     
                    <div class="col-md-2 student_add-attand">
                         <label for="student"><?=$StudentFirstName;?> <?=$StudentLastName;?> [ <?=$StudentId_Code;?> ]</label>
                         <input class="form-control-attand" name="student_id[]" value="<?=$StudentID;?>" required type="hidden">
                         <input class="form-control-attand" name="student_semester_id[]" value="<?=$SemID;?>" required type="hidden">
                    </div>

                    <?
                  $ai=0;
                  $SubjectNum = $Subject->GetSubjectNumBySemesterID($BatchSemesterID);
                   $SubjectRes = $Subject->GetSubjectResBySemesterID($BatchSemesterID);
                    while ($SubjectData = $Subject->dbfetch($SubjectRes))
                    {
                      $ai++;
                      $SubjectID = $SubjectData["subjectid"];
                      $SubjectTitle = $SubjectData["sub_title"];
                ?>
                    <div class="col-md-1 student_add-attand">
                      <input class="form-control-attand" name="attid<?=$ai;?>[]" id="attid<?=$ai;?>" value="" required type="text">
                      <input class="form-control-attand" name="subid<?=$ai;?>[]" id="subid<?=$ai;?>" value="<?=$SubjectID;?>" required type="hidden">
                    </div>
                <?
                  if($SubjectNum == $ai){ $ai=0;}
                  } 

                ?>
                    
                  
                </div>
            </div>
            <?
          }
        
    }else{
        echo '<option value="">batch semester not available</option>';
    }

}





if(isset($_POST["att_monthsid"]) && !empty($_POST["att_monthsid"]) && !empty($_POST["attsemesterid"])){
    //Get all city data
    $att_monthsid = $_POST["att_monthsid"];
    $BatchSemesterID = $_POST["attsemesterid"];
    //Count total number of rows
    $StudentAttendanceNum = $StudentAttendance->GetStudentAttendanceBySemesterMonthNum($BatchSemesterID, $att_monthsid);
    $StudentAttendanceRes = $StudentAttendance->GetStudentAttendanceBySemesterMonthRes($BatchSemesterID, $att_monthsid);
    
    $SubjectRes = $Subject->GetSubjectResBySemesterID($BatchSemesterID);

    if ($StudentAttendanceNum > 0)
    {
         //echo '<option value="">Select semester</option>';


        ?>
          <div class="row ">
              <div class="form-group ">
                
                <div class="col-md-2 student_add-attand">
                     <label for="student">Name</label>
                </div>
                <?
                $ai=0;
                while ($SubjectData = $Subject->dbfetch($SubjectRes))
                {
                  $ai++;
                  $SubjectID = $SubjectData["subjectid"];
                  $SubjectTitle = $SubjectData["sub_title"];
                  $Subjecttotal_lactures = $SubjectData["sub_total_lactures"];
                ?>
                <div class="col-md-1"><label for="student"><?=$SubjectTitle;?></label><BR><?=$Subjecttotal_lactures;?>
                   
                </div>
                <?
                if($SubjectNum == $ai){ $ai=0;}
                  } 
                ?>
                
                
              </div>
            </div>
           <?

                    while ($StudentAttendanceData = $StudentAttendance->dbfetch($StudentAttendanceRes))
                    {
                      $AttID = $StudentAttendanceData["attid"];
                      $StudentID = $StudentAttendanceData["student_id"];
                      $subid1 = $StudentAttendanceData["subid1"];
                      $subid2 = $StudentAttendanceData["subid2"];
                      $subid3 = $StudentAttendanceData["subid3"];
                      $subid4 = $StudentAttendanceData["subid4"];
                      $subid5 = $StudentAttendanceData["subid5"];
                      $subid6 = $StudentAttendanceData["subid6"];
                      $subid7 = $StudentAttendanceData["subid7"];
                      $subid8 = $StudentAttendanceData["subid8"];
                      $subid9 = $StudentAttendanceData["subid9"];
                      $subid10 = $StudentAttendanceData["subid10"];
                      $subid11 = $StudentAttendanceData["subid11"];


                      $att1 = $StudentAttendanceData["att1"];
                      $att2 = $StudentAttendanceData["att2"];
                      $att3 = $StudentAttendanceData["att3"];
                      $att4 = $StudentAttendanceData["att4"];
                      $att5 = $StudentAttendanceData["att5"];
                      $att6 = $StudentAttendanceData["att6"];
                      $att7 = $StudentAttendanceData["att7"];
                      $att8 = $StudentAttendanceData["att8"];
                      $att9 = $StudentAttendanceData["att9"];
                      $att10 = $StudentAttendanceData["att10"];
                      $att11 = $StudentAttendanceData["att11"];

                      $StudentData = $Student->GetStudentDetails($StudentID);
                      $StudentID = $StudentData["studentid"];
                      $StudentFirstName = $StudentData["std_firstname"];
                      $StudentLastName = $StudentData["std_lastname"];
                      $StudentId_Code = $StudentData["std_id_code"];
                
                    ?>
            <div class="row ">
                <div class="form-group ">
                     
                    <div class="col-md-2 student_add-attand">
                         <label for="student"><?=$StudentFirstName;?> <?=$StudentLastName;?> [ <?=$StudentId_Code;?> ]</label>
                         <input class="form-control-attand" name="AttID[]" value="<?=$AttID;?>" required type="hidden">
                         <input class="form-control-attand" name="student_id[]" value="<?=$StudentID;?>" required type="hidden">
                         <input class="form-control-attand" name="student_semester_id[]" value="<?=$SemID;?>" required type="hidden">
                    </div>
                    <?
                  $ai=0;
                  $SubjectNum = $Subject->GetSubjectNumBySemesterID($BatchSemesterID);
                   $SubjectRes = $Subject->GetSubjectResBySemesterID($BatchSemesterID);
                    while ($SubjectData = $Subject->dbfetch($SubjectRes))
                    {
                      $ai++;
                      $SubjectID = $SubjectData["subjectid"];
                      $SubjectTitle = $SubjectData["sub_title"];

                      if($SubjectID == $subid1){ $att_value= $att1;}
                      if($SubjectID == $subid2){ $att_value= $att2;}
                      if($SubjectID == $subid3){ $att_value= $att3;}
                      if($SubjectID == $subid4){ $att_value= $att4;}
                      if($SubjectID == $subid5){ $att_value= $att5;}
                      if($SubjectID == $subid6){ $att_value= $att6;}
                      if($SubjectID == $subid7){ $att_value= $att7;}
                      if($SubjectID == $subid8){ $att_value= $att8;}
                      if($SubjectID == $subid9){ $att_value= $att9;}
                      if($SubjectID == $subid10){ $att_value= $att10;}
                      if($SubjectID == $subid11){ $att_value= $att11;}
                ?>
                    <div class="col-md-1 student_add-attand">
                      <input class="form-control-attand" name="attid<?=$ai;?>[]" id="attid<?=$ai;?>" value="<?=$att_value;?>" required type="text">
                      <input class="form-control-attand" name="subid<?=$ai;?>[]" id="subid<?=$ai;?>" value="<?=$SubjectID;?>" required type="hidden">
                    </div>
                <?
                  if($SubjectNum == $ai){ $ai=0;}
                  } 

                ?>

                  

                  
                </div>
            </div>
            <?
          }
        
    }else{
        echo '<option value="">Attendance not available this month</option>';
    }

}




/// by mode 
if(isset($_POST["mode"]) && !empty($_POST["mode"]) && ($_POST["mode"] =='addnotice'))
{
 
  if(isset($_POST["courseid"]) && !empty($_POST["courseid"])){
     
      $CourseID = $_POST["courseid"];
      //Count total number of rows
      $BatchNum = $Batch->GetBatchByCourseNum($CourseID);
      $BatchRes = $Batch->GetBatchByCourseRes($CourseID);

      if ($BatchNum > 0)
      {
           echo '<option value="">Select batch</option>';
          while ($BatchData = $Batch->dbfetch($BatchRes))
          {
            $BatchID = $BatchData["batchid"];
            $BatchTitle = $BatchData["kk_title"];
            $BatchYearFrom = $BatchData["kk_year_from"];
            $BatchYearTo = $BatchData["kk_year_to"];
          
              echo '<option value="'.$BatchID.'">'.$BatchTitle.'-'.$BatchYearFrom.'</option>';
          }
      }else{
          echo '<option value="">batch not available</option>';
      }
  }


  if(isset($_POST["batchid"]) && !empty($_POST["batchid"])){
    //Get all city data
    $BatchID = $_POST["batchid"];
    
    $StudentBatchNum = $Student->GetStudentByBatchNum($BatchID);
    $StudentBatchRes = $Student->GetStudentByBatchRes($BatchID);

    if ($StudentBatchNum > 0)
    {

    ?>
      <table id="example2" class="table   nowrap table-bordered dataTable" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th width="5%">All <br><input type="checkbox" id="checkAll"></th>
            <th width="15%">Student ID</th>
            <th>Student Name</th>
            <th width="15%">Father Name</th>
            <th width="15%">Father Mobile</th>
          </tr>
        </thead>
       
        <tbody  id="showdata">
       
        <?php
        
       
          while ($StudentBatchData = $Student->dbfetch($StudentBatchRes))
          {
            $StudentID = $StudentBatchData["studentid"];
            $StudentIDCode = $StudentBatchData["std_id_code"];
            $StudentFirstname = $StudentBatchData["std_firstname"];
            $StudentLastname = $StudentBatchData["std_lastname"];
            $StudentFatherName = $StudentBatchData["std_father_name"];
            $StudentParentMobile = $StudentBatchData["std_parent_mobile"];
          ?>
          <tr>
            <td><input type="checkbox" id="checkItem" name="student_id[]"  value="<?=$StudentID;?>"></td>
            <td><?=$StudentIDCode;?></td>
            <td><?=$StudentFirstname;?> <?=$StudentLastname;?></td>
            <td><?=$StudentFatherName;?></td>
            <td><?=$StudentParentMobile;?></td>
           
          </tr>
          <? }
          ?>
          
        </tbody>
      </table>
       <hr>
      <script type="text/javascript">
        $("#checkAll").click(function () {
           $('input:checkbox').not(this).prop('checked', this.checked);
       });

      </script>
<?
    }else{
      echo "<div class='alert alert-danger'>No any record !!</div>";
    }
}




}


/// by mode 
if(isset($_POST["mode"]) && !empty($_POST["mode"]) && ($_POST["mode"] =='addnotice'))
{
 
  
}


/// by mode 



?>