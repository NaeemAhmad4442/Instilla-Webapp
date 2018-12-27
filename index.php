<?php
include('simple_html_dom.php');
if(isset($_POST["sub"]))
{
	//File System
	$file = fopen('results.csv', 'w');
	fputcsv($file, array('First Link', 'Second Link', 'percentage'));
	//Lettura link input
	$web1 = file_get_html($_POST["web1"]);
	$web2 = file_get_html($_POST["web2"]);
	$ArrayIndex_1=0;
	$ArrayIndex_2=0;
	//Lettura e confronto array
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

</style>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="	sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<title>Instilla-WebApp</title>
</head>
<body>
	<div class="container">
		<div class="row">
  			<div class="col-sm-3 col-md-6">
				<br>
				<br>
				<br>
				<center>
					<h3>Compare website</h3>
					<br>
					<br>
					<div class="mainbox">
						<form method="post" action="index.php">
							First website's URL<br>
							<input type="url" name="web1" id="web1" onkeydown="countchars()" required="" class="form-control" autocomplete="off" />
							<br>
							<br>
							Second website's URL<br>
							<input type="url" name="web2" id="web2" onkeydown="countchars()" required="" class="form-control" autocomplete="off"/>
							<br>
							<br>
							<button type="submit" name="sub" class="btn btn-success"> Compare</button>
						</form>		
  					</div>
				</center>
			</div>
			<div class="col-sm-9 col-md-6">
				<center>
					<br><br><br><br><br><br>
					<div class="form-group">
      						<label>Total Characters</label>
      						<input class="form-control" type="number" readonly="" name="" id="total" disabled>
    					</div>
    					<div class="form-group">
      						<label>Sum of indexes</label>
      						<input class="form-control"  type="number" readonly="" name="" id="indexes"  disabled>
    					</div>
				</center>		
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
function countchars()
{
//...........................................................
//............... Counter One ...............................
//...........................................................
	var total  = document.getElementById("web1").value.length + document.getElementById("web2").value.length;
	document.getElementById("total").value = total;
//...........................................................
//............... Counter Two ...............................
//...........................................................
	textbox1_value = document.getElementById("web1").value;
	textbox2_value = document.getElementById("web2").value;
	var sum=0;
	if(textbox1_value.length >0)
	{
		for (var i = 0; i < totalextbox1_value.length; i++)
		{
			chari = textbox1_value.charAt(i).toLowerCase();	
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

//...........................................................
//............... alphabetic Index ..........................
//...........................................................
function alphabetPosition(text)
{
  var result = "";
  for (var i = 0; i < text.length; i++) {
    var code = text.toUpperCase().charCodeAt(i)
    if (code > 64 && code < 91) result += (code - 64) + " ";
  }
  return result.slice(0, result.length - 1);
}
</script>
