

	   		 $(document).ready(function(){
	   			$('.registerForm').submit(function(e){
	   		       e.preventDefault();
	   		    $('#mymodal').modal('show');
	   		       /* if($("#save").is(':disabled')) {
               		   $.ajax({
	               			 url:"<?php echo base_url('octopusloan/submit');?>",   
	                     data:{takehomesalary:$("#THS").val(),loanamountrequired: $("#LAR").val(),salariedbankname:$("#SBN").val(),city: $("#loc").val(),personid:'<?php echo $Person_Id;?>'},
	                     type: "POST",
	                     success: function(data){
	                    	   $('#mymodal').modal('show');
	                              }
	                         });  
	   		       		 }  */  
	      			});
                           

	getbankname();
	getcityname();
	$('.registerForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            takehomesalary: {
                message: 'The take home salary is not valid',
                validators: {
                    notEmpty: {
                        message: 'The take home salary is required and cannot be empty'
                    },
                    stringLength: {
                        min: 5,
                        max: 8,
                        message: 'Please Enter a vaild Amount'
                    },
                    regexp: {
                        regexp:/^[1-9]{1}?[0-9]+$/,
                        message: 'only digits are allowed'
                    }
                }
            },
            loanamountrequired: {
                validators: {
                    notEmpty: {
                        message: 'The loan amount is required and cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 8,
                        message: 'Please Enter a vaild Amount'
                    },
                    regexp: {
                        regexp: /^[1-9]{1}?[0-9]+$/,
                        message: 'only digits are allowed'
                    }
                }
            },


            city: {
                validators: {
                 notEmpty: {
                         message: 'The city name is required and cannot be empty'
                     },
                   stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The city name must be more than 3 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The city name can only consist of Alphabets'
                    }
                }               
            },
            salariedbankname: {
                validators: {
                    notEmpty: {
                        message: 'The salaried bank name is required and cannot be empty'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'The salaried bank name must be between 3 to 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z ]+$/,
                        message: 'The salaried bank name can only consist of Alphabets'
                    }
                }
            }

        },
        
    });
	
	
});
$(function() {
    $('.required-icon').tooltip({
        placement: 'left',
        title: 'Required field'
        });
});


