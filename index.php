<?php
include('simple_html_dom.php');
if(isset($_POST["sub"]))
{
	$file = fopen('results.csv', 'w');
	fputcsv($file, array('First Link', 'Second Link', 'percentage'));
	echo "inside";
	$web1 = file_get_html($_POST["web1"]);
	$web2 = file_get_html($_POST["web2"]);
	$ArrayIndex_1=0;
	$ArrayIndex_2=0;

	foreach($web1->find('a') as $element)
	{
    	$array[$ArrayIndex_1] = $element->href;
    	$ArrayIndex_1++;
	}

   foreach($web2->find('a') as $element) 
   {
   		$array1[$ArrayIndex_2] = $element->href;
    	$ArrayIndex_2++;
   }

   for($i=0; $i < sizeof($array); $i++)
   {
		for($k=0; $k< sizeof($array1); $k++)
		{
			similar_text($array[$i], $array1[$k], $perc[$i][$k]);

		}   	
   }
   $data = array( array("", "", ""));
   
   for($i=0; $i < sizeof($array); $i++)
   {
		for($k=0; $k< sizeof($array1); $k++)
		{
			$percentage = number_format($perc[$i][$k], 2, ',', ' '). '%';
			array_push($data,array($array[$i], $array1[$k], $percentage));
		}
	}
	foreach ($data as $row)
	{
		fputcsv($file, $row);
	}
	fclose($file);
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="results.csv"');
	echo readfile("results.csv"); 
}
?>

<style type="text/css">
	body {
 background-image: url("bj.pg");
 background-color: #cccccc;
}
.mainbox {
width: 500px;
height: 600px;
}
</style>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<title>
	</title>
</head>
<body><br><br><br><br>

<center><h3>Compare website</h3><br><br><br>

<div class="mainbox">
<form method="post" action="index.php">

First website's URL<br>
<input type="url" name="web1" id="web1" onkeydown="countchars()" required="" class="form-control"/><br><br>
Second website's URL<br>
<input type="url" name="web2" id="web2" onkeydown="countchars()" required="" class="form-control"/><br><br>
<button type="submit" name="sub" class="btn btn-success"> Compare</button>
</form>
Total characters: <input type="number" readonly="" name="" style="width:30; height: 30" id="total" /><br>
Sum of indexes: <input type="number" readonly="" name="" style="width:30; height: 30" id="indexes" />
</div>
</center>
</body>
</html>
<script type="text/javascript">

function countchars()
{
	var total  = document.getElementById("web1").value.length + document.getElementById("web2").value.length;
	document.getElementById("total").value = total;
	textbox1_value = document.getElementById("web1").value;
	textbox2_value = document.getElementById("web2").value;
	var sum=0;
	if(textbox1_value.length >0)
	{
		for (var i = 0; i < totalextbox1_value.length; i++)
		{
			alert("insidee loop")
			chari = textbox1_value.charAt(i).toLowerCase();
			alert(chari)
			sum +=alphabetPosition(chari);
			alert(alphabetPosition(chari))
		}
	}
	if(textbox2_value.len.length >0)
	{
		for (var k = 0; k < textbox2_value.length; k++)
		{
			chari = textbox2_value.charAt(k).toLowerCase();
			sum +=alphabetPosition(chari);
		}
	}
	document.getElementById("indexes").value = sum;
}
function alphabetPosition(text) {
  var result = "";
  for (var i = 0; i < text.length; i++) {
    var code = text.toUpperCase().charCodeAt(i)
    if (code > 64 && code < 91) result += (code - 64) + " ";
  }

  return result.slice(0, result.length - 1);
}

</script>