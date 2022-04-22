<?php
include("adformheader.php");
require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM admin WHERE adminid='$_GET[delid]'";
	$qsql=mysqli_query($conn,$sql);
	if(mysqli_affected_rows($conn) == 1)
	{
		echo "<script>alert('admin record deleted successfully..');</script>";
	}
}
?>

<div class="container-fluid">
  <div class="block-header">
    <h2>View Adminstrators</h2>
  </div>
</div>
<div class="card">
  <section class="container">
   <table class="table table-bordered table-striped table-hover js-basic-example dataTable">


    <thead>
      <tr>
        <td width="12%" height="40"><strong>Admin Name</strong></td>
        <td width="11%"><strong>Login ID</strong></td>
        <td width="12%"><strong>Status</strong></td>
        <td width="10%"><strong>Action</strong></td>
      </tr>
    </thead>
    <tbody>
     <?php
     $sql ="SELECT * FROM admin";
     $qsql = mysqli_query($conn,$sql);
     while($rs = mysqli_fetch_array($qsql))
     {
      echo "<tr>
      <td>$rs[adminname]</td>
      <td>$rs[loginid]</td>
      <td>$rs[status]</td>
      <td>
      <a href='admin.php?editid=$rs[adminid]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a> <a href='viewadmin.php?delid=$rs[adminid]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a> </td>
      </tr>";
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