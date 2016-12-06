<?php 
	include('config.php');
	$timezone = "Asia/Kolkata";
  date_default_timezone_set($timezone);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FTA HSRP Solution Pvt. Ltd.</title>
<style type="text/css">
fieldset{width:500px;height:250px;border-radius:20px;background-color:#900;}
legend{border-radius:20px;border-style:groove;background-color:#C0C0C0;}
table{font-family:"Courier New", Courier, monospace;}
th{}
td{text-align:center;color:#FFF}
</style>
</head>

<body>
<?php 
	//********************* Name of RTO *****************************
	$qry_rto_name="SELECT RTO_CD FROM hsrp_dtls";
	$rslt_rto_name=mysql_query($qry_rto_name);
	$row_rto_name=mysql_fetch_object($rslt_rto_name);
	$rto_id=$row_rto_name->RTO_CD;
	$rto_name='RTO BHUJ';
	/*$rto = array(1=>"RTO AHMEDABAD","RTO MEHSANA","RTO RAJKOT","RTO BHAVNAGAR","RTO SURAT","RTO VADODARA","RTO NADIAD","RTO PALANPUR","RTO HIMMATNAGAR","RTO JAMNAGAR","RTO JUNAGADH","RTO BHUJ","RTO SURENDRANAGAR","RTO AMARELI","RTO VALSAD","RTO BHARUCH","RTO GODHARA","RTO GANDHINAGAR","RTO BARDOLI","RTO DAHOD","RTO NAVSARI","RTO RAJPIPLA","RTO ANAND","RTO PATAN","RTO PORBANDAR","RTO VYARA","RTO VASTRAL",30=>"RTO AHWA");
	foreach($rto as $id=>$name)
	{
		if($rto_id==$id)
			$rto_name=$name;
	}
	*/
	//********************* Total Pushed by NIC *********************************
	$qry_total_pushed_by_nic_today="select count(*) AS num_records from hsrp_dtls where DATE(OP_DT)=CURDATE()";
	$rslt_total_pushed_by_nic_today=mysql_query($qry_total_pushed_by_nic_today) or die();
	$row_total_pushed_by_nic_today=mysql_fetch_object($rslt_total_pushed_by_nic_today);
	  
	//******************** Today Pulled By NIC **********************************
	$qry_pulled_by_nic_today="select count(*) AS num_records from hsrp_dtls_hist WHERE DATE(MOVED_ON)=CURDATE()";
	$rslt_pulled_by_nic_today=mysql_query($qry_pulled_by_nic_today) or die();
	$row_pulled_by_nic_today=mysql_fetch_object($rslt_pulled_by_nic_today);
	
	//************************** Today Pending to pulled ***************************
	$qry_pending_to_pulled_today="SELECT COUNT(*) AS num_records FROM hsrp_dtls WHERE HSRP_NO_FRONT IS NOT NULL AND HSRP_NO_BACK IS NOT NULL  AND DATE(HSRP_ISSUE_DT) AND HSRP_FIX_AMT IS NOT NULL AND HSRP_AMT_TAKEN_ON IS NOT NULL AND DATE(HSRP_FIX_DT) IS NOT NULL AND DATE(OP_DT)=CURDATE()";
	$rslt_pending_to_pulled_today=mysql_query($qry_pending_to_pulled_today) or die();
	$row_pending_to_pulled_today=mysql_fetch_object($rslt_pending_to_pulled_today);
	
	//************************** Today Embossed at RTO ***************************
	$qry_embossed_today="SELECT COUNT(*) AS num_records FROM hsrp_dtls WHERE HSRP_NO_FRONT IS NOT NULL AND HSRP_NO_BACK IS NOT NULL AND DATE(HSRP_ISSUE_DT) IS NOT NULL AND HSRP_FIX_AMT IS NOT NULL  AND HSRP_AMT_TAKEN_ON IS NOT NULL AND DATE(HSRP_ISSUE_DT)=CURDATE()";
	$rslt_embossed_today=mysql_query($qry_embossed_today) or die();
	$row_embossed_today=mysql_fetch_object($rslt_embossed_today);
 
	//***************** Total Pushed by NIC *******************************
	$qry_total_pushed_by_nic_till="select count(*) AS num_records from hsrp_dtls";
	$rslt_total_pushed_by_nic_till=mysql_query($qry_total_pushed_by_nic_till) or die();
	$row_total_pushed_by_nic_till=mysql_fetch_object($rslt_total_pushed_by_nic_till);
	
	//******************** Total Pulled By NIC **********************************
	$qry_pulled_by_nic_till="select count(*) AS num_records from hsrp_dtls_hist";
	$rslt_pulled_by_nic_till=mysql_query($qry_pulled_by_nic_till) or die();
	$row_pulled_by_nic_till=mysql_fetch_object($rslt_pulled_by_nic_till);
	
	//************************** Total Pending to pulled ***************************
	$qry_pending_to_pulled_till="SELECT COUNT(*) AS num_records FROM hsrp_dtls WHERE HSRP_NO_FRONT IS NOT NULL AND HSRP_NO_BACK IS NOT NULL AND DATE(HSRP_ISSUE_DT) IS NOT NULL AND HSRP_FIX_AMT IS NOT NULL AND DATE(HSRP_FIX_DT) IS NOT NULL AND HSRP_AMT_TAKEN_ON IS NOT NULL";
	//"SELECT COUNT(*) AS num_records FROM hsrp_dtls WHERE HSRP_NO_FRONT IS NOT NULL AND HSRP_NO_BACK IS NOT NULL  AND DATE(HSRP_ISSUE_DT) AND HSRP_FIX_AMT IS NOT NULL AND HSRP_AMT_TAKEN_ON IS NOT NULL";
	$rslt_pending_to_pulled_till=mysql_query($qry_pending_to_pulled_till) or die();
	$row_pending_to_pulled_till=mysql_fetch_object($rslt_pending_to_pulled_till);
	
	$qry_embossed_till="SELECT COUNT(*) AS num_records FROM hsrp_dtls WHERE HSRP_NO_FRONT IS NOT NULL AND HSRP_NO_BACK IS NOT NULL AND DATE(HSRP_ISSUE_DT) IS NOT NULL AND HSRP_FIX_AMT IS NOT NULL  AND HSRP_AMT_TAKEN_ON IS NOT NULL";
	$rslt_embossed_till=mysql_query($qry_embossed_till) or die();
	$row_embossed_till=mysql_fetch_object($rslt_embossed_till);
?>
<center>
<fieldset style="width:600px;height:250px;border-radius:20px;background-color:#900;">
	<legend>NIC Auto Push Pull Status</legend>
	<table cellpadding="2" border="">
		<tr bgcolor="#66CCCC">
				<th scope="col" colspan="5"><?php echo $rto_name;?></th>
		</tr>
		<tr bgcolor="#FFFF00">
				<th scope="col" colspan="5">&nbsp;&nbsp;As on <?php echo date('d M Y');?></th>
		</tr>
		<tr bgcolor="#66CC33">
			<th scope="col">Total Pushed by NIC</th>
			<th scope="col">Total Pushed by HSRP</th>
			<th scope="col">Pulled By NIC</th>
			<th scope="col">Pending to pulled</th>
			<th scope="col">Embossed</th>
		</tr>
		<tr>
			<td scope="col">
				<?php 
				echo $pushed_by_nic_till=$row_pulled_by_nic_till->num_records+$row_total_pushed_by_nic_till->num_records;?>
			</td>
			<td scope="col">
				<?php 
				echo $pushed_by_hsrp_till=$row_pulled_by_nic_till->num_records+$row_pending_to_pulled_till->num_records;?>
			</td>
			<td scope="col">
				<?php echo $pulled_by_nic_till=$row_pulled_by_nic_till->num_records;?>
			</td>
			<td scope="col">
				<?php echo $pending_to_pulled_till=$row_pending_to_pulled_till->num_records;?>
			</td>
			<td scope="col">up_to
				<?php echo $embossed_till=$row_embossed_till->num_records;?>
			</td>
		</tr>
		
		<tr bgcolor="#FFFF00">
				<th scope="col" colspan="5">&nbsp;&nbsp;Todays(<?php echo date('d M Y');?>)</th>
		</tr>
		<tr bgcolor="#66CC33">
			<th scope="col">Total Pushed by NIC</th>
			<th scope="col">Total Pushed by HSRP</th>
			<th scope="col">Pulled By NIC</th>
			<th scope="col">Pending to pulled</th>
			<th scope="col">Embossed</th>
		</tr>
		<tr>
			<td scope="col">
				<?php 
				echo $pushed_by_nic_today=$row_total_pushed_by_nic_today->num_records;?>
			</td>
			<td scope="col">
				<?php 
				echo $pushed_by_hsrp_today=$row_pulled_by_nic_today->num_records+$row_pending_to_pulled_today->num_records;	?>
			</td>
			<td scope="col">
				<?php echo $pulled_by_nic_today=$row_pulled_by_nic_today->num_records;	?>
			</td>
			<td scope="col">
				<?php echo $pending_to_pulled_today=$row_pending_to_pulled_today->num_records;?>
			</td>
			<td scope="col"><?php echo $embossed_today=$row_embossed_today->num_records;?></td>
		</tr>
</table>
</fieldset>
<?php
mysql_close($conn_local);

$dbhost2 = '27.109.22.130';

$dbuser = 'auto_push_pull';
$dbpass = 'auto_push_pull';
$dbname = 'suraksha_14_15';

$connt = mysql_connect($dbhost2,$dbuser,$dbpass)
or die('Error connecting to mysql');
mysql_select_db($dbname)  or die(mysql_error());
//************************************************* Check duplicate auto push pull records **********************************
$qry_check_dup="SELECT COUNT(*) FROM hsrp_dtls a INNER JOIN hsrp_dtls_hist b ON a.AUTH_NO=b.AUTH_NO";
$rslt_check_dup=mysql_query($qry_check_dup);
$num_dup=mysql_num_rows($rslt_check_dup);
if($num_dup<1)
	$dup_flag=0;
else
	$dup_flag=1;

//************************************************* Check Record need to be inserte/update at today **********************************
$qry_rec="select rec_date from nic_auto_push_pull where rto_name='".$rto_name."' AND rec_date=CURDATE()";
$rslt_rec=mysql_query($qry_rec);
$num=mysql_num_rows($rslt_rec);

if($num==0)
{
	$qry="insert into nic_auto_push_pull(rto_name,rec_date,total_pushed_by_nic,total_pushed_by_hsrp,pulled_by_nic,pending_to_pulled,dup_flag) value('".$rto_name."',date(now()),".$pushed_by_nic_till.",".$pushed_by_hsrp_till.",".$pulled_by_nic_till.",".$pending_to_pulled_till.",".$dup_flag.")";
	//mysql_query($qry) or die(mysql_error().'Insertion Failed');
}
else
{
	$qry="UPDATE nic_auto_push_pull set rto_name='".$rto_name."',rec_date=date(now()),total_pushed_by_nic=".$pushed_by_nic_till.",total_pushed_by_hsrp=".$pushed_by_hsrp_till.",pulled_by_nic=".$pulled_by_nic_till.",pending_to_pulled=".$pending_to_pulled_till.",dup_flag=".$dup_flag." WHERE rto_name='".$rto_name."' AND rec_date=date(now())";
//mysql_query($qry) or die('Updation Failed');
}
mysql_query($qry) or die(mysql_error());
//include'up_to_req_slip.php';
?>
</center>
</body>
</html>