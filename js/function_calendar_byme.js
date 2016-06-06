function HolidayDates(date){
	
	var day = date.getDay();             
	
	for (i = 0; i < holidayDates.length; i++) {
		var holiday = new Date(holidayDates[i]);		
		
		if(compare_dates(holiday,date)==true )
		  return [false,'holiday'];            
	}
	return [true];
}

function compare_dates(holidaydate,igual)
{
	var equal = new Date(equal);
	if(holidaydate.toString()==igual.toString())
	 return true;

	return false;
}