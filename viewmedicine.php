<?php
include("adformheader.php");
require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
if(isset($_GET[delid]))
{
	$sql ="DELETE FROM medicine WHERE medicineid='$_GET[delid]'";
	$qsql=mysqli_query($conn,$sql);
	if(mysqli_affected_rows($conn) == 1)
	{
		echo "<script>alert('Medicine redcord deleted successfully..');</script>";
	}
}
?>
<div class="container-fluid">
  <div class="block-header">
    <h2>View  Medicines</h2>

  </div>
</div>
<div class="card">

  <section class="container">
    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">

          <thead>
            <tr>
              <th>Medicine name</th>
              <th>Medicine cost</th>
              <th>description</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead> 
          <tbody>

            <?php
            $sql ="SELECT * FROM medicine";
            $qsql = mysqli_query($conn,$sql);
            while($rs = mysqli_fetch_array($qsql))
            {
              echo "<tr>
              <td>&nbsp;$rs[medicinename]</td>
              <td>&nbsp;Rs. $rs[medicinecost]</td>
              <td>&nbsp;$rs[description]</td>
              <td>&nbsp;$rs[status]</td>
              <td>&nbsp;
              <a href='medicine.php?editid=$rs[medicineid]' class='btn btn-sm btn-raised g-bg-cyan'>Edit</a> 
              <a href='viewmedicine.php?delid=$rs[medicineid]' class='btn btn-sm btn-raised g-bg-blush2'>Delete</a></td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </section>
     
    </div>
  </div>
</div>

</div>
</div>
<?php
include("adformfooter.php");
?>