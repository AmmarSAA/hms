<?php
include("adformheader.php");
require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM treatment_records WHERE appointmentid='$_GET[delid]'";
	$qsql=mysqli_query($conn,$sql);
	if(mysqli_affected_rows($conn) == 1)
	{
		echo "<script>alert('appointment record deleted successfully..');</script>";
	}
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2>View New Treatment Records</h2>

  </div>

  <div class="card">

    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
     	<thead>
     		 <tr>
            <td width="71"	scope="col"><strong>Treatment Type</strong></td>
            <td width="52"	scope="col"><strong>Patient</strong></td>
            <td width="78"	scope="col"><strong>Doctor</strong></td>
            <td width="82"	scope="col"><strong>Treatment Description</strong></td>
            <td width="43"	scope="col"><strong>Treatment Date</strong></td>
            <td width="43"	scope="col"><strong>Treatment Time</strong></td>
     
          </tr>
     	</thead>
        <tbody>
         
          <?php
		$sql ="SELECT * FROM treatment_records where status='Active'";
		if(isset($_SESSION[patientid]))
		{
			$sql = $sql . " AND patientid='$_SESSION[patientid]'"; 
		}
		if(isset($_SESSION[doctorid]))
		{
			$sql = $sql . " AND doctorid='$_SESSION[doctorid]'";
		}
		$qsql = mysqli_query($conn,$sql);
		while($rs = mysqli_fetch_array($qsql))
		{
			$sqlpat = "SELECT * FROM patient WHERE patientid='$rs[patientid]'";
			$qsqlpat = mysqli_query($conn,$sqlpat);
			$rspat = mysqli_fetch_array($qsqlpat);
			
			$sqldoc= "SELECT * FROM doctor WHERE doctorid='$rs[doctorid]'";
			$qsqldoc = mysqli_query($conn,$sqldoc);
			$rsdoc = mysqli_fetch_array($qsqldoc);
			
			$sqltreatment= "SELECT * FROM treatment WHERE treatmentid='$rs[treatmentid]'";
			$qsqltreatment = mysqli_query($conn,$sqltreatment);
			$rstreatment = mysqli_fetch_array($qsqltreatment);
			
        echo "<tr>
          <td>&nbsp;$rstreatment[treatmenttype]</td>
		   <td>&nbsp;$rspat[patientname]</td>
		    <td>&nbsp;$rsdoc[doctorname]</td>
			<td>&nbsp;$rs[treatment_description]</td>
			 <td>&nbsp;$rs[treatment_date]</td>
			  <td>&nbsp;$rs[treatment_time]</td>";  
	
       echo " </tr>";
		}
		?>
        </tbody>
      </table>
</section>
</div>
</div>
<?php
include("adformfooter.php");
?>