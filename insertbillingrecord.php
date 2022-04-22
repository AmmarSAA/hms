<?php
require('config.php');
require(WEBSITE_PATH.'./includes/db_connection.php');
$dt = date("Y-m-d");
$tim = date("H:i:s");
//LAST APPOINTMENT ID
$sqlappointment1 = "SELECT max(appointmentid) FROM appointment where patientid='$_GET[patientid]' AND (status='Active' OR status='Approved')";
$qsqlappointment1 = mysqli_query($conn,$sqlappointment1);
$rsappointment1=mysqli_fetch_array($qsqlappointment1);

//SELECTING LAST APPOINTMENT ID RECORD
$sql ="SELECT * FROM billing WHERE appointmentid='$rsappointment1[0]'";
$qsql=mysqli_query($conn,$sql);
$rsbill = mysqli_fetch_array($qsql);
if(mysqli_num_rows($qsql) ==0)
{
	//Create billing invoice for appointment
	$sql = "INSERT INTO billing( patientid, appointmentid, billingdate, billingtime, discount, taxamount, discountreason, discharge_time, discharge_date) VALUES ('$_GET[patientid]','$rsappointment1[0]','$dt','$tim','0','0','','','')";
	$qsql=mysqli_query($conn,$sql);
	$billid = mysqli_insert_id($conn);
}
else
{
	$billid = $rsbill[0];
}

if($billtype == "Room Rent")
{
	if( $roomid != "" )
	{
		$sqlroomtariff = "SELECT * FROM room WHERE roomid='$roomid'";
		$qsqlroomtariff = mysqli_query($conn,$sqlroomtariff);
		$rsroomtariff = mysqli_fetch_array($qsqlroomtariff);
	//Room tariff
	$sql ="INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$roomid','Room Rent','$rsroomtariff[room_tariff]','$dt','Active')";
	$qsql=mysqli_query($conn,$sql);
	}
}

if($billtype == "Doctor Charge" && $billtype1="Treatment Cost")
{
	//Consultancy Charge
	$sqldoctor = "SELECT * FROM doctor WHERE doctorid='$doctorid'";
	$qsqldoctor = mysqli_query($conn,$sqldoctor);
	$rsdoctor = mysqli_fetch_array($qsqldoctor);
	
	$sqlconsu= "SELECT * FROM billing_records WHERE billingid='$billid' AND bill_type_id='$doctorid' AND bill_type='Consultancy Charge'";
	$qsqlcunsu = mysqli_query($conn,$sqlconsu);
	
	if(mysqli_affected_rows($conn) == 0)
	{
		$sql ="INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$doctorid','Consultancy Charge','$rsdoctor[consultancy_charge]','$dt','Active')";
		$qsql=mysqli_query($conn,$sql);
	}
	
	//Treatment Cost
	$sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$treatmentid'";
	$qsqltreatment = mysqli_query($conn,$sqltreatment);
	$rstreatment = mysqli_fetch_array($qsqltreatment);
	
	$sql ="INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$treatmentid','Treatment','$rstreatment[treatment_cost]','$dt','Active')";
	$qsql=mysqli_query($conn,$sql);
}

if($billtype == "Prescription charge")
{
	$sqltreatment = "SELECT * FROM treatment WHERE treatmentid='$_GET[treatmentid]'";
	$qsqltreatment = mysqli_query($conn,$sqltreatment);
	$rstreatment = mysqli_fetch_array($qsqltreatment);
	//Prescription charge
	 $sql ="INSERT INTO billing_records(billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$prescriptionid','Prescription Charge','$presamt','$dt','Active')";
	$qsql=mysqli_query($conn,$sql);
}

if($billtype == "Prescription update")
{
	$sqlprescription_records = "SELECT sum(cost*unit) FROM prescription_records WHERE prescription_id='$_GET[prescriptionid]'";
	$qsqlprescription_records = mysqli_query($conn,$sqlprescription_records);
	$rsprescription_records = mysqli_fetch_array($qsqlprescription_records);
	//Prescription charge
	$sql ="UPDATE billing_records SET bill_amount='$rsprescription_records[0]' WHERE bill_type_id ='$_GET[prescriptionid]'";
	$qsql=mysqli_query($conn,$sql);
}

if($billtype == "Consultancy Charge")
{
//Consultancy Charge
$sql ="INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$doctorid','Consultancy Charge','$billamt','$dt','Active')";
$qsql=mysqli_query($conn,$sql);
}

if($billtype == "Service Charge")
{
	$sqlservice_type = "SELECT * FROM service_type WHERE service_type_id='$servicetypeid'";
	$qsqlservice_type = mysqli_query($conn,$sqlservice_type);
	$rsservice_type = mysqli_fetch_array($qsqlservice_type);
	$servicecharge = $rsservice_type[servicecharge] + $_POST[amount];
	//Prescription charge
	$sql ="INSERT INTO billing_records( billingid, bill_type_id, bill_type, bill_amount, bill_date, status) VALUES ('$billid','$servicetypeid','Service Charge','$servicecharge','$_POST[date]','Active')";
	$qsql=mysqli_query($conn,$sql);
	echo "<script>alert('Service charge added successfully..');</script>";
}
?>