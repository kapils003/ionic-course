<?php
ob_start();
session_start();
include_once("include/connection.php");
include('include/function.php');

$obj=new MyClass;
 $uid=$_SESSION['user_id'];
if ($_SESSION['is_logged_in'] != '1') {
    header('location:index.php');
}

extract($_POST);
$msg = '';
if(isset($_GET['edit'])!='' && isset($_POST['submit']) == 'Save')
{
  $queryup = mysql_query("update term_master set name='".mysql_real_escape_string($term_name)."' where term_master_id='".$_GET['edit']."'");
 
      $msg = " <font color='green'>Sucessfully Updated....</font>";
      header('location:term.php?msg='.$msg);
} else{
if (isset($_POST['submit']) == 'Save') {
    
     $select = "select * from term_master where name='".trim($term_name)."' AND schoolId='".$_SESSION['school_id']."' limit 1";
$query = mysql_query($select);
$result = mysql_fetch_array($query);
$numrow = mysql_num_rows($query);

   if($numrow ==1) 
         {
         $msg = " <font color='red'>Level Name Already Exist....</font>";
   }else{
$insert_qry = mysql_query("INSERT INTO term_master(name) VALUES ('$term_name');");

        if($insert_qry){
            $msg = " <font color='green'>Sucessfully Inserted....</font>";
             header('location:term.php?msg='.$msg);
        }
   }

}
}
$res1=mysql_query("select * from term_master where term_master_id='".$_GET['edit']."'");
$re1=mysql_fetch_array($res1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Dashboard</title>
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>


  
  
  <script>
    $(document).ready(function() {
	// validate the comment form when it is submitted
	//$("#commentForm").validate();

	// validate signup form on keyup and submit
	$("#frm").validate({
		rules: {
			term_name: "required"
                         
			
			
		},
		messages: {
			
			term_name: "Enter Term"
                        
			
		}
	});

	
});







</script>
<style type="text/css">

#result { border: 1px solid green; width: 300px; margin: 0 0 35px 0; padding: 10px 20px; font-weight: bold; }
#change-image { font-size: 0.8em; }
td{
	padding:10px;
}
table{
	border-color:#EEE;
}


label.error {
width:auto;
font-size:12px;
color: #b31522;
padding:0px 10px 20px 5px;
border-radius:5px;
float:left;
margin-top:-2px;
margin-bottom:8px;
margin-right:20px;
display:block;
position:absolute;

}
</style>
    </head>

    <body>
        <div class="main">

<?  include('include/header.php'); ?>
    
    <?  if($_SESSION['is_logged_in']=='1'){
    include('include/topmenu.php'); } ?>
    
  <div class="p_mainwrapper">
  <? include('include/left_panel.php');?>
  <div class="p_mainwrapper_rightpanel">
<div class="p_mainwrapper_rightpanel_bradcomb">
<ul>
<li><a href="master.php">Masters</a></li>
<li><span class="glyphicon glyphicon-chevron-right" style="font-size:10px !important;"></span></li>
<li><a href="term.php">Term</a></li>
<li><span class="glyphicon glyphicon-chevron-right" style="font-size:10px !important;"></span></li>
<li><a href="#">Add Term</a></li>
</ul>
</div>
<div class="cl"></div>
<!-- content-->
<div class="cont">
        <h1>Add Term </h1>
              
           
               <?=$msg; ?>
                    <form name="frm" id="frm" method="POST"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #CCC;">


                            <tr>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                              <td bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                            <tr>
                              <td width="24%" bgcolor="#FFFFFF">&nbsp;</td>
                                <td width="17%" bgcolor="#FFFFFF"><?php echo "Term Name"; ?></td>
                                <td width="59%" bgcolor="#FFFFFF"><input type="text" name="term_name" id="term_name" value="<?php echo $re1['name']; ?>" required="true"/></td>

                            </tr>
                            <tr class="evenrow">

                                
                                <tr>
                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                  
                                    <td bgcolor="#FFFFFF" >
                                        <input type="submit" name="submit" id="button" value="Save" class="btn btn-primary">
                                            <input type="reset" name="reset" id="button" value="Cancel" class="btn btn-primary">

                                                </td>
                                                </tr>
                                                <tr>
                                  <td bgcolor="#FFFFFF">&nbsp;</td>
                                  <td bgcolor="#FFFFFF">&nbsp;</td>
                                  <td bgcolor="#FFFFFF" >&nbsp;</td>
                                </tr>

                                                </table>
                                                </form>
                                           
</div>
    
    
   
    
    <!-- Content End -->
</div>


  </div> <?  include('include/footer.php'); ?>
  </div>
                                                </body>
                                                </html>
