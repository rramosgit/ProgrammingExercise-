<?php
class ApiCaller
{
    //some variables for the object
    private $_app_id;
    private $_app_key;
    private $_api_url;
     
    //construct an ApiCaller object, taking an
    //APP ID, APP KEY and API URL parameter
    public function __construct($app_id, $app_key, $api_url)
    {
        $this->_app_id = $app_id;
        $this->_app_key = $app_key;
        $this->_api_url = $api_url;
    }
     
    //send the request to the API server
    //also encrypts the request, then checks
    //if the results are valid
    public function sendRequest($request_params)
    {
        //encrypt the request parameters
        $enc_request = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->_app_key, json_encode($request_params), MCRYPT_MODE_ECB));
         
        //create the params array, which will
        //be the POST parameters
        $params = array();
        $params['enc_request'] = $enc_request;
        $params['app_id'] = $this->_app_id;
         
        //initialize and setup the curl handler
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->_api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
 
        //execute the request
        $result = curl_exec($ch);
         
        //json_decode the result
        $result = @json_decode($result);
         
        //check if we're able to json_decode the result correctly
       // if( $result == false || !isset($result['success'])  ) 
	
       if( $result == false || $result->success	== false)	
		{
            throw new Exception('Request was not correct');
        }
         
        //if there was an error in the request, throw an exception
        if( $result->success== false ) {
            throw new Exception($result['errormsg']);
        }
         
        //if everything went great, return the data
        return $result->data;
    }
}
?>
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


function httpGetAsync(theUrl, callback)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callback(xmlHttp.responseText);
    }
    xmlHttp.open("GET", theUrl, true); // true for asynchronous 
    xmlHttp.send(null);
	 
	return xmlHttp.responseText;
	//make a loop and take only dates, return it
	
}
var holidayDates = ['7/4/2015','7/4/2016','7/4/2017','7/4/2018'];
$(document).ready(function() {





	$(".next").click(function(){
		
	if($("#start_date").attr('value')=='' || $("#days").attr('value')=='' || $("#countrycode").attr('value')=='')
	{
		alert('Please,fill the form above')
	}	
	else
	{
	  var countrycode = $("#countrycode").attr('value');
      var url = "http://holidayapi.com/v1/holidays?country="+countrycode;
	  
	    //var holidayDates = httpGetAsync(url);
	   
	   
	   
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
<input type="text" id="countrycode" name="countrycode" value="" />

<input type="text" id="end_date" name="end_date" value="" readonly="readonly" class="hidden" />

<a class="next" ></a>
<br class="clear;">
<label>"To Load Again click here !!"</label><input type="submit" value="Reload">
<div  id="calendar"  class="hidden" > </div>
</form>
</body>
</html>
