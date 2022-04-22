<?php
include("adformheader.php");
require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM department WHERE departmentid='$_GET[delid]'";
	$qsql=mysqli_query($conn,$sql);
	if(mysqli_affected_rows($conn) == 1)
	{
		echo "<script>
    Swal.fire({
      title: 'Done!',
      text: 'department deleted successfully',
      type: 'success',
      
    })</script>";
  }
}
?>


<div class="container-fluid">
  <div class="block-header">
    <h2>View Departments</h2>
    
  </div>
  <div class="card">
    
    <section class="container">
     <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
      <tbody>
        <tr>
          <td><strong>Department Name</strong></td>
          <td><strong>Department Description</strong></td>          
          <td><strong>Status</strong></td>
          <?php
          if(isset($_SESSION[adminid]))
          {
            ?>
            <td><strong>Action</strong></td>
            <?php
          }
          ?>
        </tr>
        <?php
        $sql ="SELECT * FROM department";
        $qsql = mysqli_query($conn,$sql);
        while($rs = mysqli_fetch_array($qsql))
        {
          echo "<tr>
          <td>$rs[departmentname]</td>
          <td> $rs[description]</td>
          
          <td>&nbsp;$rs[status]</td>";
          if(isset($_SESSION[adminid]))
          {
            echo "<td>&nbsp;
          <a href='department.php?editid=$rs[departmentid]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a> <a href='viewdepartment.php?delid=$rs[departmentid]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a> </td>";
          }
          echo "</tr>";
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