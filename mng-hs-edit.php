<?php 
    include ("library/checklogin.php");
    $operator = $_SESSION['operator_user'];

	include('library/check_operator_perm.php');


	include 'library/opendb.php';

        isset($_REQUEST['name']) ? $name = $_REQUEST['name'] : $name = "";
        isset($_REQUEST['macaddress']) ? $macaddress = $_REQUEST['macaddress'] : $macaddress = "";
        isset($_REQUEST['geocode']) ? $geocode = $_REQUEST['geocode'] : $geocode = "";
        isset($_REQUEST['owner']) ? $owner = $_REQUEST['owner'] : $owner = "";
        isset($_REQUEST['email_owner']) ? $email_owner = $_REQUEST['email_owner'] : $email_owner = "";
        isset($_REQUEST['manager']) ? $manager = $_REQUEST['manager'] : $manager = "";
        isset($_REQUEST['email_manager']) ? $email_manager = $_REQUEST['email_manager'] : $email_manager = "";
        isset($_REQUEST['address']) ? $address = $_REQUEST['address'] : $address = "";
        isset($_REQUEST['company']) ? $company = $_REQUEST['company'] : $company = "";
        isset($_REQUEST['phone1']) ? $phone1 = $_REQUEST['phone1'] : $phone1 = "";
        isset($_REQUEST['phone2']) ? $phone2 = $_REQUEST['phone2'] : $phone2 = "";
        isset($_REQUEST['hotspot_type']) ? $hotspot_type = $_REQUEST['hotspot_type'] : $hotspot_type = "";
        isset($_REQUEST['website']) ? $website = $_REQUEST['website'] : $website = "";

	$logDebugSQL = "";

	if (isset($_REQUEST['submit'])) {

		$name = $_REQUEST['name'];
		$macaddress = $_REQUEST['macaddress'];
		$geocode = $_REQUEST['geocode'];

		if (trim($name) != "") {

				$sql = "UPDATE ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS']." SET mac='$macaddress', geocode='$geocode', 
					owner='$owner', email_owner='$email_owner', manager='$manager', email_manager='$email_manager', 
					address='$address', company='$company', phone1='$phone1', phone2='$phone2', type='$hotspot_type', website='$website'
					WHERE name='$name'";

				$res = $dbSocket->query($sql);
				$logDebugSQL = "";
				$logDebugSQL .= $sql . "\n";
			
			$actionStatus = "success";
			$actionMsg = "Updated attributes for: <b> $name </b>";
			$logAction = "Successfully updates attributes for hotspot [$name] on page: ";
			
		} else {
			$actionStatus = "failure";
			$actionMsg = "no hotspot name was entered, please specify a hotspot name to edit";
			$logAction = "Failed updating attributes for hotspot [$name] on page: ";
		}
		
	}
	

	// fill-in username and password in the textboxes
	$sql = "SELECT * FROM ".$configValues['CONFIG_DB_TBL_DALOHOTSPOTS']." WHERE name='$name'";
	$res = $dbSocket->query($sql);
	$logDebugSQL .= $sql . "\n";

	$row = $res->fetchRow();
	$macaddress = $row[2];
	$geocode = $row[3];
	$owner = $row[4];
	$email_owner = $row[5];
	$manager = $row[6];
	$email_manager = $row[7];
	$address = $row[8];
	$company = $row[9];
	$phone1 = $row[10];
	$phone2 = $row[11];
	$hotspot_type = $row[12];
	$website = $row[13];

	include 'library/closedb.php';


	if (trim($name) == "") {
		$actionStatus = "failure";
		$actionMsg = "no hotspot name was entered, please specify a hotspot name to edit</b>";
	}


	include_once('library/config_read.php');
	$log = "visited page: ";

	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>daloRADIUS</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/1.css" type="text/css" media="screen,projection" />

</head>

<?php
        include_once ("library/tabber/tab-layout.php");
?>
 
<?php

	include ("menu-mng-main.php");
	
?>		
		<div id="contentnorightbar">
		
				<h2 id="Intro"><?php echo $l['Intro']['mnghsedit.php'] ?></h2>
				
				<p>
				<?php echo $l['captions']['mnghsedit'] ?> 
				</p>

				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<div class="tabber">

     <div class="tabbertab" title="HotSpot Info">
        <br/>

<table border='2' class='table1'>
<tr><td>
                                                <b><?php echo $l['FormField']['mnghsdel.php']['HotspotName'] ?></b>
</td><td>
                                                <input disabled value="<?php echo $name ?>" name="name" tabindex=100 /><br/>
                                                </font>
</td></tr>
<tr><td>
						<b><?php echo $l['FormField']['mnghsedit.php']['MACAddress'] ?></b>
</td><td>
						<input value="<?php echo $macaddress ?>" name="macaddress" tabindex=101 /><br/>
</td></tr>
<tr><td>
						<b><?php echo $l['FormField']['mnghsedit.php']['Geocode'] ?></b>
</td><td>
						<input value="<?php echo $geocode ?>" name="geocode" tabindex=102 /><br/>

</td></tr>
                                                <input type=hidden value="<?php echo $name ?>" name="name"/><br/>
</table>


        </div>

     <div class="tabbertab" title="Contact Info">
        <br/>

<table border='2' class='table1'>
<tr><td>
                                                <?php if (trim($owner) == "") { echo "<font color='#FF0000'>";  }?>
                                                <b>Owner Name</b>
</td><td>
                                                <input value="<?php echo $owner ?>" name="owner" tabindex=300/><br/>
                                                </font>
</td></tr>
<tr><td>
                                                <?php if (trim($email_owner) == "") { echo "<font color='#FF0000'>";  }?>
                                                <b>Owner Email</b>
</td><td>
                                                <input value="<?php echo $email_owner ?>" name="email_owner" tabindex=301 /><br/>
                                                </font>
</td></tr>
<tr><td>
                                                <?php if (trim($manager) == "") { echo "<font color='#FF0000'>";  }?>
                                                <b>Manager Name</b>
</td><td>
                                                <input value="<?php echo $manager ?>" name="manager" tabindex=302 /><br/>
                                                </font>
</td></tr>
<tr><td>
                                                <?php if (trim($email_manager) == "") { echo "<font color='#FF0000'>";  }?>
                                                <b>Manager Email</b>
</td><td>
                                                <input value="<?php echo $email_manager ?>" name="email_manager" tabindex=303 /><br/>
                                                </font>
</td></tr>
<tr><td>
                                                <b>Company</b>
</td><td>
                                                <input value="<?php echo $company ?>" name="company" tabindex=304 /><br/>
</td></tr>
<tr><td>
                                                <b>Address</b>
</td><td>
                                                <input value="<?php echo $address ?>" name="address" tabindex=305 /><br/>
</td></tr>
<tr><td>
                                                <b>Phone 1</b>
</td><td>
                                                <input value="<?php echo $phone1 ?>" name="phone1" tabindex=306 /><br/>
</td></tr>
<tr><td>
                                                <b>Phone 2</b>
</td><td>
                                                <input value="<?php echo $phone2 ?>" name="phone2" tabindex=307 /><br/>
</td></tr>
<tr><td>
                                                <b>HotSpot Type</b>
</td><td>
                                                <input value="<?php echo $hotspot_type ?>" name="hotspot_type" tabindex=308 /><br/>
</td></tr>
<tr><td>
                                                <b>Website</b>
</td><td>
                                                <input value="<?php echo $website ?>" name="website" tabindex=309 /><br/>
</td></tr>

</table>


        </div>

</div>


						<br/><br/>
<center>
						<input type="submit" name="submit" value="<?php echo $l['buttons']['savesettings'] ?>" tabindex=1000 />
</center>
				</form>

<?php
	include('include/config/logging.php');
?>
		
		</div>
		
		<div id="footer">
		
								<?php
        include 'page-footer.php';
?>

		
		</div>
		
</div>
</div>


</body>
</html>





