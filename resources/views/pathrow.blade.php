<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<div  class="container" >
    <div class="row justify-content-center">
        <div class="container">
            <div class="card">
                <div class="card-header">
                

                        <h2> Path planning </h2>
                            <form name="FormData" method="post" action="" >
                                <div class="wrapper">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-8 col-lg-9">
                                            <input type="text" name="input_array_name[]" placeholder="Input Movement Here" class="form-control" value="" />
                                        </div>
                                    </div>
                                </div>
                                <p><button type="button" class="btn btn-success" id="add_fields"><i class="fa fa-plus"></i> Add Path</button>
                                <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i> Automate</button>

                            </p>
                            </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>





<script>
//Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $("#add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1
	
	//When user click on add input button
	$(add_button).click(function(e){
        e.preventDefault();
		//Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
			 //add input field
            $(wrapper).append('<div class="form-group row"><div class="col-sm-12 col-md-8 col-lg-9"><input type="text" name="input_array_name[]" placeholder="Input Movement Here" class="form-control" value="" /> </div><a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });
	
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout field
		x--; //inout field decrement
    })
});
</script>