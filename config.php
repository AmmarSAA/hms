<?php

/****************************
* File Name: config.php 	*
* Author: Ammar S.A.A 		*
* Output: Configuration 	*
****************************/

//error_reporting(0);

// Website Paths
define("WEBSITE_PATH", "C:/xampp1/htdocs/HMS/");
define("WEBSITE_URL", "http://localhost/HMS/");

// Database Configurations
define("DB_SERVER", "localhost");
define("USER", "root");
define("PASS", "");
define("DATABASE_NAME","hms");

// Admin Configuration
define("ADMIN_EMAIL", "s.ammarahmed14@gmail.com");

// Tables' Names
define('TBLADMIN', 'admin');
define('TBLAPPOINTMENT', 'appointment');
define('TBLBILLING', 'billing');
define('TBLBILLINGRECORD', 'billing_records');
define('TBLDEPARTMENT', 'department');
define('TBLDOCTOR', 'doctor');
define('TBLDOCTORTIMING', 'doctor_timings');
define('TBLMEDICINE', 'medicine');
define('TBLORDER', 'orders');
define('TBLPATIENT', 'patient');
define('TBLPAYMENT', 'payment');
define('TBLPRESCRIPTION', 'prescription');
define('TBLPRESCRIPTIONRECORD', 'prescription_records');
define('TBLROOM', 'room');
define('TBLSERVICETYPE', 'service_type');
define('TBLTREATMENT', 'treatment');
define('TBLTREATMENTRECORD', 'treatment_records');
define('TBLUSER', 'user');
