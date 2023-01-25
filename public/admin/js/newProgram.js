function selectProgram(mainCls = '', radioCls = '', termsCls = '', errorMsgTerms = '', errorMsg = ''){
	$(mainCls).click(function(){
	  if($(radioCls).is(':checked')) { 
	    /*if($(termsCls).is(':checked')){
	      
	    }else{
	    	$('.valErrorModal').on('show.bs.modal', function(event) {
			  //var button = $(event.relatedTarget);  
			  var modal = $(this);
			  var errorTxt = errorMsgTerms;
			  modal.find('.modal-body').html(errorTxt);
			});
			$('.valErrorModal').modal('show'); 
	    }*/
	    $(this).closest('form').submit();
	  }else{
	  	$('.valErrorModal').on('show.bs.modal', function(event) { 
			  var modal = $(this);
			  var errorTxt = errorMsg;
			  modal.find('.modal-body').html(errorTxt);
			});
			$('.valErrorModal').modal('show');
	  }
	});
}