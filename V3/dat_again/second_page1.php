<?php
require 'db_conn.php';
session_start();
?>

<html lang="en">
<title> Second_page </title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="w3css.css">
<link rel="stylesheet" href="fonts">
<style>
body,h1 {font-family: "Raleway", sans-serif}
th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px dotted #000;
}
body, html {height: 100%}
.bgimg {
  background-image:'test_img1.jpg';
  min-height: 100%;
  background-position: center;
  background-size: cover;
}
.dropdown-content button{
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropbtn {
  background-color:black;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  position:center;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-hover{
position:relative;display:inline-block;cursor:pointer;
}
.dropdown-content{
cursor:auto;color:#000;background-color:#fff;display:none;position:absolute;min-width:160px;margin:0;padding:0;z-index:1;
}
.dropdown-content button:hover {background-color: #ddd;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #3e8e41;}

.wrapper {
	margin-top: 80px;
  margin-bottom: 80px;
  background-color:#f1f1f1!important;
}

.form-signin {
  max-width: 380px;
  padding: 15px 35px 45px;
  margin: 0 auto;
  background-color:#f1f1f1!important;
  border: 1px solid rgba(0,0,0,0.1);

  .form-signin-heading,
	.checkbox {
	  margin-bottom: 30px;
	  font-family:
	}

	.checkbox {
	  font-weight: normal;
	}

	.form-control {
	  position: relative;
	  font-size: 16px;
	  height: auto;
	  padding: 10px;
	  padding-bottom:5px;
		@include box-sizing(border-box);

		&:focus {
		  z-index: 2;
		}
	}

	input[type="text"] {
	  margin-bottom: -1px;
	  border-bottom-left-radius: 0;
	  border-bottom-right-radius: 0;
	}

	input[type="password"] {
	  margin-bottom: 20px;
	  border-top-left-radius: 0;
	  border-top-right-radius: 0;
	}
}
.amount-display{
background-color:white;
}
.text_dark_grey{
color:#3a3a3a!important;
}
.margin_bottom{
margin-bottom:100px;
}
.margin_right{
margin-right:250px;
}
.dropdown-hover{
position:relative;display:inline-block;cursor:pointer;
}
.dropdown-content{
cursor:auto;color:#000;background-color:#fff;display:none;position:absolute;min-width:160px;margin:0;padding:0;z-index:1;
}
.card-4{
box-shadow:0 4px 10px 0 rgba(0,0,0,0.2),0 4px 20px 0 rgba(0,0,0,0.19);
}
.bar-item{
padding:8px 16px;float:left;width:auto;border:none;display:block;outline:0;
}
.bar{
	padding:8px 16px;float:left;width:auto;border:none;display:block;outline:0;
}


</style>

<script type="text/javascript">
function myFunction() {
  window.print();
}

</script>


<body>
	<div class="bgimg w3-display-container w3-animate-opacity w3-text-black">
	<div class="w3-display-topleft w3-padding-large w3-xlarge">
	<a href="login.html" class="bar w3-button w3-padding-large">HOME</a>
	</div>
	<div class="w3-display-middle">
    <h1 class="w3-jumbo w3-display-topmiddle w3-animate-top">SMART-WALLET</h1>
    <hr class="w3-hover-border-black w3-animate-top" style="margin:auto;width:50%">
	<button class="w3-xlarge w3-text-dark-grey w3-margin-bottom w3-margin-right" onclick="Show_Bal();">Final-Balance</button>
    <br>
	<div class="dropdown">
		<button class="dropbtn">Filter</button>
			<div class="dropdown-content">
				<button class="w3-bar-item w3-button" onclick="Show_TD();">By Time Desc</button>
				<button class="w3-bar-item w3-button" onclick="Show_TA();">By Time Asc</button>
				<button class="w3-bar-item w3-button" onclick="Show_Loc();">By Location</button>
				<button class="w3-bar-item w3-button" onclick="Show_Out();">By Out</button>
				<button class="w3-bar-item w3-button" onclick="Show_In();">By In</button>
				<button class="w3-bar-item w3-button" onclick='Show_All();'>All Transactions</button>
			</div>
	</div>
  </div>
  </div>
 <script >
	function Show_All(){
		document.getElementById('All').style.display='block';
		document.getElementById('TA').style.display='none';
		document.getElementById('TD').style.display='none';
		document.getElementById('Bal').style.display='none';
		document.getElementById('Loc').style.display='none';
		document.getElementById('Out').style.display='none';
		document.getElementById('In').style.display='none';
	}
	function Show_TA(){
		document.getElementById('All').style.display='none';
		document.getElementById('TA').style.display='block';
		document.getElementById('TD').style.display='none';
		document.getElementById('Bal').style.display='none';
		document.getElementById('Loc').style.display='none';
		document.getElementById('In').style.display='none';
		document.getElementById('Out').style.display='none';

	}
	function Show_TD(){
		document.getElementById('All').style.display='none';
		document.getElementById('TA').style.display='none';
		document.getElementById('TD').style.display='block';
		document.getElementById('Bal').style.display='none';
		document.getElementById('Loc').style.display='none';
	 	document.getElementById('In').style.display='none';
		document.getElementById('Out').style.display='none';
	}
	function Show_Bal(){
		document.getElementById('All').style.display='none';
		document.getElementById('TA').style.display='none';
		document.getElementById('TD').style.display='none';
		document.getElementById('Bal').style.display='block';
		document.getElementById('Loc').style.display='none';
		document.getElementById('In').style.display='none';
		 document.getElementById('Out').style.display='none';
	}
 	function Show_Loc(){
		document.getElementById('Loc').style.display='block';
		document.getElementById('All').style.display='none';
		document.getElementById('TA').style.display='none';
		document.getElementById('TD').style.display='none';
		document.getElementById('Bal').style.display='none';
		document.getElementById('Out').style.display='none';
		document.getElementById('In').style.display='none';
	}
	function Show_Out(){
		document.getElementById('Out').style.display='block';
		document.getElementById('All').style.display='none';
		document.getElementById('TA').style.display='none';
		document.getElementById('TD').style.display='none';
		document.getElementById('Bal').style.display='none';
		document.getElementById('In').style.display='none';
		document.getElementById('Loc').style.display='none';

	}
	function Show_In(){
		document.getElementById('Out').style.display='none';
		document.getElementById('All').style.display='none';
		document.getElementById('TA').style.display='none';
		document.getElementById('TD').style.display='none';
		document.getElementById('Bal').style.display='none';
		document.getElementById('In').style.display='block';
		document.getElementById('Loc').style.display='none';

	}
</script>
<center>
<div class="table" style="display:none" id="All">

		<h3> Denominations </h3>
			<table style='border-style:dotted'>
<thead>
				<tr>
				<th>Serial No</th>
				<th>In</th>
				<th>Out</th>
				<th>Location</th>
				<th>Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT *, (SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance FROM `testtable` t";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td><b>" . $row['SNo'] . "</b></td>";
				   echo "<td>" . $row['In'] . "</td>";
				   echo "<td>" . $row['Out'] . "</td>";
				   echo "<td>" . $row['Location'] . "</td>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<div class="table" style="display:none" id="TA">

		<h3> Denominations </h3>
			<table style='border-style:dotted'>
<thead>
				<tr>
				<th>Serial No</th>
				<th>In</th>
				<th>Out</th>
				<th>Location</th>
				<th>Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT *, (SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance FROM `testtable` t ";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td><b>" . $row['SNo'] . "</b></td>";
				   echo "<td>" . $row['In'] . "</td>";
				   echo "<td>" . $row['Out'] . "</td>";
				   echo "<td>" . $row['Location'] . "</td>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<div class="table" style="display:none" id="TD">

		<h3> Denominations </h3>
			<table style='border-style:dotted'>
<thead>
				<tr>
				<th>Serial No</th>
				<th>In</th>
				<th>Out</th>
				<th>Location</th>
				<th>Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT *, (SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance FROM `testtable` t order by Timestamp desc";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td><b>" . $row['SNo'] . "</b></td>";
				   echo "<td>" . $row['In'] . "</td>";
				   echo "<td>" . $row['Out'] . "</td>";
				   echo "<td>" . $row['Location'] . "</td>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<div class="table" style="display:none" id="Bal">

		<h3> Denominations </h3>
			<table style="border-style:dotted">
<thead>
				<tr>
				<th>Current Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT  (SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance, Timestamp FROM `testtable` t order by Timestamp desc limit 1";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<div class="table" style="display:none" id="Loc" >

		<h3> Denominations </h3>
			<table style=" border-style:dotted">
<thead>
				<tr>
				<th>Serial No</th>
				<th>In</th>
				<th>Out</th>
				<th>Location</th>
				<th>Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT *, (SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance FROM `testtable` t order by Location desc";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td><b>" . $row['SNo'] . "</b></td>";
				   echo "<td>" . $row['In'] . "</td>";
				   echo "<td>" . $row['Out'] . "</td>";
				   echo "<td>" . $row['Location'] . "</td>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<div class="table" style="display:none " id="Out">

		<h3> Denominations </h3>
			<table style='border-style:dotted'>
<thead>
				<tr>
				<th>Serial No</th>
				<th>Out</th>
				<th>Location</th>
				<th>Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT  *,(SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance FROM `testtable` t where t.`In`=0";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td><b>" . $row['SNo'] . "</b></td>";
				   echo "<td>" . $row['Out'] . "</td>";
				   echo "<td>" . $row['Location'] . "</td>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<div class="table" style="display:none " id="In">

		<h3> Denominations </h3>
			<table style=' border-style:dotted'>
<thead>
				<tr>
				<th>Serial No</th>
				<th>In</th>
				<th>Location</th>
				<th>Balance</th>
				<th>Time-Stamp</th>
</thead>

<?php
			   $sql = "SELECT  *,(SELECT SUM(t2.In) - SUM(t2.Out) FROM `testtable` t2 WHERE t2.SNo <= t.SNo) Balance FROM `testtable` t where t.`Out`=0";
			   $result = mysqli_query($conn,$sql);
			   while($row=mysqli_fetch_assoc($result)){
				   echo "<tr>";
				   echo "<td><b>" . $row['SNo'] . "</b></td>";
				   echo "<td>" . $row['In'] . "</td>";
				   echo "<td>" . $row['Location'] . "</td>";
				   echo "<td>" . $row['Balance'] . "</td>";
				   echo "<td>" . $row['Timestamp'] . "</td>";
		   	   	   echo "</tr>";
			   }
?>
			</table>
</div>
<br>
<br>
<div>
	<button class="w3-button w3-red" style="margin-bottom:25px" id="cmd" onclick="myFunction()" >
    Print PDF
	</button>
</div>
<div>

<form method="get" action="logout.html">

<button class="w3-button w3-black " style="margin-top:50px margin-bottom:50px" type="submit">Log Out</button>

</div>
<br>
<br>

  <div>
    Powered by
  <img src="js.jpg" style="width:50px">
  </div>
  </center>
</body>
</html>
