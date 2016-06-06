<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Programing exercise</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="all"/>
<link rel="stylesheet" href="js/themes/ui-lightness/jquery.ui.all.css">

<script language="javascript" type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script language="javascript" type="text/javascript" src="js/ui/jquery.ui.core.js"></script>
<script language="javascript" type="text/javascript" src="js/ui/jquery.ui.datepicker.js"></script>
<script language="javascript" type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script language="javascript" type="text/javascript" src="js/ui/i18n/jquery.ui.datepicker-EN.js"></script>
<script language="javascript" type="text/javascript" src="js/tooltip.js"></script>

<script language="javascript" type="text/javascript" src="js/function_calendar_byme.js"></script>
<script language="javascript">

var holidayDates = ['7/4/2015','7/4/2016','7/4/2017','7/4/2018'];

$(document).ready(function() {





	$(".next").click(function(){
		
	if($("#start_date").attr('value')=='' || $("#days").attr('value')=='')
	{
		alert('Please,fill the form above')
	}	
	else
	{
	  var start_date = new Date($("#start_date").attr('value'));
	  var days = parseInt($("#days").attr('value'))-1;
	  var end_date = new Date(start_date);
	  end_date.setDate(start_date.getDate() + days);                            
	  $("#end_date").val(end_date.getFullYear() + '-' + ("0" + (end_date.getMonth() + 1)).slice(-2) + '-' + ("0" + end_date.getDate()).slice(-2));		
		
	$("#calendar").datepicker({"dateFormat":"mm/dd/yy",minDate:start_date,maxDate:end_date,beforeShowDay: HolidayDates},$.datepicker.regional[ "es" ]);	
	
	$(".holiday span").attr('tooltip','Holiday'); 
	
	
	$("#calendar").show();
	}
	});
});
</script>
</head>

<body>

<form>
<input type="text" id="start_date" name="start_date" value="" />
<input type="text" id="days" name="days" value="" />

<input type="text" id="end_date" name="end_date" value="" readonly="readonly" class="hidden" />
<label>"To Load Again click here !!"</label>
<input type="submit" value="Reload">
<a class="next"></a>

<div  id="calendar"  class="hidden" > </div>
</form>
</body>
</html>
