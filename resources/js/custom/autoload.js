
function getcompanyname() {
$.ajax(
{
    url:_base_url+"easyloan/get_company_data",
	dataType:"json",
	success:function(jsonData) {
	var companydetails = jsonData.companyDetails;
	var datalistString ="";
	for($index=0;$index< companydetails.length;$index++) {
	    console.log(companydetails[$index]);
		var company = companydetails[$index];
		datalistString+="<option cid='"+company.id+"' value='"+company.companyName+"'>";
	}
	
	    $("#companyList").append(datalistString);
	    //console.log(jsonData);
	},
	error:function(a,b,c) {
	    console.log(a);
	    console.log(b);
	    console.log(c);
	}
}
);
}

function getbankname() {
$.ajax(
{
    url:_base_url+"easyloan/get_bank_data",
	dataType:"json",
	success:function(jsonData) {
	var bankdetails = jsonData.bankDetails;
	var datalistString ="";
	for($index=0;$index< bankdetails.length;$index++) {
	    console.log(bankdetails[$index]);
		var company = bankdetails[$index];
		datalistString+="<option cid='"+company.id+"' value='"+company.bankName+"'>";
	}
	
	    $("#banklist").append(datalistString);
	    //console.log(jsonData);
	},
	error:function(a,b,c) {
	    console.log(a);
	    console.log(b);
	    console.log(c);
	}
}
);
}


function getcityname() {
	$.ajax(
	{
	    url:_base_url+"easyloan/get_city_data",
		dataType:"json",
		success:function(jsonData) {
		var cityDetails = jsonData.cityDetails;
		var datalistString ="";
		for($index=0;$index< cityDetails.length;$index++) {
		    console.log(cityDetails[$index]);
			var city = cityDetails[$index];
			datalistString+="<option cid='"+city.id+"' value='"+city.cityDetails+"'>";
		}
		
		    $("#citylist").append(datalistString);
		    //console.log(jsonData);
		},
		error:function(a,b,c) {
		    console.log(a);
		    console.log(b);
		    console.log(c);
		}
	}
	);
	}