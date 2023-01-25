//Child Information
function nextTabs(className = '', childNo = ''){
	$(className).on("click", function(){
		var ret= false;
		if(className == ".sbmtChildInfo"){
			ret = childInfo(className);
		}
		if(className == ".sbmtParentInfo"){
			ret = parentInfo(className);
		}

		if(ret == true){
			$(".nav.nav-tabs li:nth-child("+ (childNo +1) +")").addClass("active");
			$(".nav.nav-tabs li:nth-child("+ (childNo +1) +") a").attr("aria-expanded", 'true');
			$(".nav.nav-tabs li:nth-child("+ childNo +")").removeClass("active");
			$(".nav.nav-tabs li:nth-child("+ childNo +") a").attr("aria-expanded", 'false');
			$("#menu"+ childNo).removeClass("active");
			$("#menu"+ (childNo +1)).addClass("active in");
			$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
		}
	});
}

function prevTabs(className = '', childNo = ''){
	$(className).on("click", function(){
		$(".nav.nav-tabs li:nth-child("+ (childNo -1) +")").addClass("active");
		$(".nav.nav-tabs li:nth-child("+ (childNo -1) +") a").attr("aria-expanded", 'true');
		$(".nav.nav-tabs li:nth-child("+ childNo +")").removeClass("active");
		$(".nav.nav-tabs li:nth-child("+ childNo +") a").attr("aria-expanded", 'false');
		$("#menu"+ childNo).removeClass("active");
		$("#menu"+ (childNo -1)).addClass("active in");
		$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
	});
}

function displayModal(errorMsgTerms = '', errorCls = ''){
	  var errorTxt = errorMsgTerms;
	  $(errorCls).text(errorTxt);
	  //$(this).closest('div').find('.errorTxt').text(errorTxt);
}

function validateEmail(userEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(userEmail)) {
        return true;
    }
    else {
        return false;
    }
}
function validationKeyUp(clsName = '', errorCls = ''){

	$(clsName).keyup(function(){
	    $(errorCls).css("display", "none");
	});

}

function validateOnSelect(clsName = '', errorCls = ''){
	$(clsName).change(function() {
	  $(errorCls).css("display", "none");
	});
}

function validatePhone(txtPhone) {
    var a = document.getElementById(txtPhone).value;
    var filter = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
    if (filter.test(a)) {
        return true;
    }
    else {
        return false;
    }
}

function childInfo(className = ''){
		var error =0;
		var childFname = $(".child_first_name").val();
		var childLname = $(".child_last_name").val();
		var childDob =  $(".child_dob").val();
		var childTshirt = $(".child_tshirt").val();
		var hereAboutStem = $(".here_about_stem").val();
		var referredBy = $(".referred_by").val();
		var visitedCenter = $(".child_visited_center").val();
		var enrollmentDate = $(".child_enrollment_date").val();
		var childAssessment = $(".child_assessment").val();
		var uniformSize = $(".child_uniform_size").val();
		var childAddress = $(".child_address").val();
		var childState = $(".child_state").val();
		var childCity = $(".child_city").val();
		var childZip = $(".child_zip").val();
		var childPhone = $(".child_phone").val();
		var childEmail = $(".child_email").val();
		var fel = '';

		if(childFname == ''){
			displayModal("Please enter First Name", ".eroFname");
			if(fel =='')
				fel = ".cFN";

			$(".eroFname").css("display", "block");
			error = 1;
		}

		if(childLname == ''){
			displayModal("Please enter Last Name", ".eroLname");
			if(fel =='')
				fel = ".cLN";

			$(".eroLname").css("display", "block");
			error = 1;
		}
		if(childDob == ''){
			displayModal("Please select date of birth", ".eroDob");
			if(fel =='')
				fel = ".cDOB";

			$(".eroDob").css("display", "block");
			error = 1;
		}
		if($('input[name=child_gender]:checked').length<=0){
		 	displayModal("Please select gender", ".eroGender");
		 	if(fel =='')
				fel = ".cGen";

		 	$(".eroGender").css("display", "block");
		 	error = 1;
		}
		if(childAddress == ''){
			displayModal("Please enter Primary Address", ".eroPrimaryAddr");
			if(fel =='')
				fel = ".cPAdr";

			$(".eroPrimaryAddr").css("display", "block");
			error = 1;
		}

		if(childState == ''){
			displayModal("Please select state", ".eroState");
			if(fel =='')
				fel = ".cStat";

			$(".eroState").css("display", "block");
			error = 1;
		}
		if(childCity == ''){
			displayModal("Please select city", ".eroCity");
			if(fel =='')
				fel = ".cCity";

			$(".eroCity").css("display", "block");
			error = 1;
		}
		if(childZip == ''){
			displayModal("Please enter zip code", ".eroZip");
			if(fel =='')
				fel = ".cZip";

			$(".eroZip").css("display", "block");
			error = 1;
		}

		if(childPhone == ''){
			displayModal("Please enter phone number",".eroChildPhone");
			if(fel =='')
				fel = ".cPhone";

			$(".eroChildPhone").css("display", "block");
			error = 1;
		}else{
			if (!validatePhone('txtPhone')) {
				$('#spnPhoneStatus').html('Please enter valid number');
	            $('#spnPhoneStatus').css('color', 'red');
	            error = 1;
	        }
	        /*else {
	            $('#spnPhoneStatus').html('');
	            $('#spnPhoneStatus').css('color', 'green');
	        }*/
		}

		if(childEmail != ''){
			if(!validateEmail(childEmail)){
				displayModal("Please enter valid email address", ".eroChildEmail");
				if(fel =='')
					fel = ".cEmail";

				$(".eroChildEmail").css("display", "block");
				error = 1;
			}
		}else{
			displayModal("Please enter email address", ".eroChildEmail");
			if(fel =='')
					fel = ".cEmail";

			$(".eroChildEmail").css("display", "block");
			error = 1; 
		}
		if(childTshirt == ''){
			displayModal("Please enter child tshirt color", ".eroTshirt");
			if(fel =='')
				fel = ".cTshirt";

			$(".eroTshirt").css("display", "block");
			error = 1;
		}

		if(hereAboutStem == ''){
			displayModal("Please enter how did you here about us", ".eroAcademy");
			if(fel =='')
					fel = ".cHere";

		 	$(".eroAcademy").css("display", "block");
			error = 1;
		}
		if(referredBy == ''){
			displayModal("Please enter referred by", ".eroReferredBy");
			if(fel =='')
					fel = ".cReferred";

		 	$(".eroReferredBy").css("display", "block");
			error = 1;
		}
		if(visitedCenter == ''){
			displayModal("Please enter child visited center", ".eroVisit");
			if(fel =='')
					fel = ".cVisit";

			$(".eroVisit").css("display", "block");
			error = 1;
		}
		if(enrollmentDate == ''){
			displayModal("Please select child enrollment date", ".eroEnrole");
			if(fel =='')
					fel = ".cEnrole";

			$(".eroEnrole").css("display", "block");
			error = 1;
		}
		if(childAssessment == ''){
			displayModal("Please enter child assessment", ".eroAssement");
			if(fel =='')
					fel = ".cAssement";
		
			$(".eroAssement").css("display", "block");
			error = 1;
		}
		if(uniformSize == ''){
			displayModal("Please enter child child uniform size", ".erouniForm");
			if(fel =='')
					fel = ".cuniForm";
			
			$(".erouniForm").css("display", "block");
			error = 1;
		}
		var liveWithParents = $('.parentLeavs').val();
		if(liveWithParents == 1){
			$("#otherParent").hide();
			$("#mother").show();
			$("#father").show();
		}else if(liveWithParents == 2){
			$("#father").hide();
			$("#otherParent").hide();
			$("#mother").show();
		}else if(liveWithParents == 3){
			$("#mother").hide();
			$("#otherParent").hide();
			$("#father").show();
		}else if(liveWithParents == 4){
			$("#father").hide();
			$("#mother").hide();
			$("#otherParent").show();
		}

		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		return true;
}

function parentInfo(className = ''){
	var error =0;
	var liveWithParents = $('.parentLeavs').val();
	var motherName = $(".mother_name").val();
	var motherEmail = $(".mother_email").val();
	var motherMobile = $(".mother_mobile").val();
	var fatherName = $(".father_name").val();
	var fatherEmail = $(".father_email").val();
	var fatherMobile = $(".father_mobile").val();
	var otherParentName = $(".other_parent_name").val();
	var otherParentEmail = $(".other_parent_email").val();
	var otherParentMobile = $(".other_parent_mobile").val();

	var employerName = $(".employer_name").val();
	var employerEmail = $(".employer_email").val();
	var employerPhone = $(".employer_phone").val();
	var employerAddress = $(".employer_address").val();
	var employerEmails = $(".employer_emails").val();

	var emergencyContactName = $(".emergency_contact_name").val();
	var emergencyContactRelation = $(".emergency_contact_relation").val();
	var emergencyContactPhone = $(".emergency_contact_phone").val();

	var childDob =  $(".child_dob").val();
	var hereAboutStem = $(".here_about_stem").val();
	var referredBy = $(".referred_by").val();
	var registrationDate = $(".registration_date").val();
	var fel = '';

	$('#motherHome').blur(function(e) {
	    if (!validatePhone('motherHome')) {
	    	$('#motherHomeStatus').html('Please enter valid number');
	        $('#motherHomeStatus').css('color', 'red');
	        error = 1;
	    } 
	});

	$('#motherOffice').blur(function(e) {
	    if (!validatePhone('motherOffice')) {
	        $('#motherOfficeStatus').html('Please enter valid number');
	        $('#motherOfficeStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#motherCell').blur(function(e) {
	    if (!validatePhone('motherCell')) {
	        $('#motherCellStatus').html('Please enter valid number');
	        $('#motherCellStatus').css('color', 'red');
	        error = 1;
	    }
	});


	$('#fatherHome').blur(function(e) {
	    if (!validatePhone('fatherHome')) {
	       $('#fatherHomeStatus').html('Please enter valid number');
	        $('#fatherHomeStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#fatherOffice').blur(function(e) {
	    if (!validatePhone('fatherOffice')) {
	       $('#fatherOfficeStatus').html('Please enter valid number');
	        $('#fatherOfficeStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#fatherCell').blur(function(e) {
	    if (!validatePhone('fatherCell')) {
	       $('#fatherCellStatus').html('Please enter valid number');
	       $('#fatherCellStatus').css('color', 'red');
	       error = 1;
	    }
	});

	$('#otherHome').blur(function(e) {
	    if (!validatePhone('otherHome')) {
	        $('#otherHomeStatus').html('Please enter valid number');
	        $('#otherHomeStatus').css('color', 'red');
	        error = 1;
	    }
	});


	$('#otherOffice').blur(function(e) {
	    if (!validatePhone('otherOffice')) {
	        $('#otherOfficeStatus').html('Please enter valid number');
	        $('#otherOfficeStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#otherCell').blur(function(e) {
	    if (!validatePhone('otherCell')) {
	        $('#otherCellStatus').html('Please enter valid number');
	        $('#otherCellStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#workPhone').blur(function(e) {
	    if (!validatePhone('workPhone')) {
	        $('#otherWorkStatus').html('Please enter valid number');
	        $('#otherWorkStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#emerPhone').blur(function(e) {
	    if (!validatePhone('emerPhone')) {
	        $('#emerStatus').html('Please enter valid number');
	        $('#emerStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#newEmer').blur(function(e) {
	    if (!validatePhone('newEmer')) {
	        $('#newEmerStatus').html('Please enter valid number');
	        $('#newEmerStatus').css('color', 'red');
	        error = 1;
	    }
	});

	$('#emer2Phone').blur(function(e) {
	    if (!validatePhone('emer2Phone')) {
	        $('#emer2Status').html('Please enter valid number');
	        $('#emer2Status').css('color', 'red');
	        error = 1;
	    }
	});

	if(liveWithParents == 1){
		if(motherName == ''){
			displayModal("Please enter mother's name", ".eroMName");
			if(fel =='')
     			fel = ".mName";
			
			$(".eroMName").css("display", "block");
			error = 1;
		}
		if(motherEmail != ''){
			if(!validateEmail(motherEmail)){
				displayModal("Please enter valid email address", ".eroMEmail");
				if(fel =='')
     				fel = ".mEmail";
									
				$(".eroMEmail").css("display", "block");
				error = 1;
			}
		}else{
			displayModal("Please enter mother's email address", ".eroMEmail");
			if(fel =='')
     			fel = ".mEmail";
			
			$(".eroMEmail").css("display", "block");
			error = 1;
		}
		if(motherMobile == ''){
			displayModal("Please enter mother's mobile number", ".eroMPhone");
			if(fel =='')
     			fel = ".mPhone";
			
			$(".eroMPhone").css("display", "block");
			error = 1;
		}
		if(fatherName == ''){
			displayModal("Please enter father's name", ".eroFName");
			if(fel =='')
     			fel = ".fName";
			
			$(".eroFName").css("display", "block");
			error = 1;
		}
		if(fatherEmail != ''){
			if(!validateEmail(fatherEmail)){
				displayModal("Please enter valid email address", ".eroFEmail");
				if(fel =='')
     				fel = ".fEmail";
				
				$(".eroFEmail").css("display", "block");
				error = 1;
			}
		}else{
			displayModal("Please enter father's email address", ".eroFEmail");
			if(fel =='')
     			fel = ".fEmail";
			
			$(".eroFEmail").css("display", "block");
			error = 1;
		}
		if(fatherMobile == ''){
			displayModal("Please enter father's mobile number", ".eroFPhone");
			if(fel =='')
     			fel = ".fPhone";
			
			$(".eroFPhone").css("display", "block");
			error = 1;
		}

	}else if(liveWithParents == 2){
		if(motherName == ''){
			displayModal("Please enter mother's name", ".eroMName");
			if(fel =='')
     			fel = ".mName";
			
			$(".eroMName").css("display", "block");
			error = 1;
		}
		if(motherEmail != ''){
			if(!validateEmail(motherEmail)){
				displayModal("Please enter valid email address", ".eroMEmail");
				if(fel =='')
     				fel = ".mEmail";
				
				$(".eroMEmail").css("display", "block");
				error = 1;
			}
		}else{
			displayModal("Please enter mother's email address", ".eroMEmail");
			if(fel =='')
     			fel = ".mEmail";
			
			$(".eroMEmail").css("display", "block");
			error = 1;
		}
		if(motherMobile == ''){
			displayModal("Please enter mother's mobile number", ".eroMPhone");
			if(fel =='')
     			fel = ".mPhone";
			
			$(".eroMPhone").css("display", "block");
			error = 1;
		}
	}else if(liveWithParents == 3){
		if(fatherName == ''){
			displayModal("Please enter father's name", ".eroFName");
			if(fel =='')
     			fel = ".fName";
			
			$(".eroFName").css("display", "block");
			error = 1;
		}
		if(fatherEmail != ''){
			if(!validateEmail(fatherEmail)){
				displayModal("Please enter valid email address", ".eroFEmail");
				if(fel =='')
     				fel = ".fEmail";
				
				$(".eroFEmail").css("display", "block");
				error = 1;
			}
		}else{
			displayModal("Please enter father's email address", ".eroFEmail");
			if(fel =='')
     			fel = ".fEmail";
			
			$(".eroFEmail").css("display", "block");
			error = 1;
		}
		if(fatherMobile == ''){
			displayModal("Please enter father's mobile number", ".eroFPhone");
			if(fel =='')
     			fel = ".fPhone";
			
			$(".eroFPhone").css("display", "block");
			error = 1;
		}
	}else if(liveWithParents == 4){
		if(otherParentName == ''){
			displayModal("Please enter other's parent name", ".eroOthName");
			if(fel =='')
     			fel = ".oName";
			
			$(".eroOthName").css("display", "block");
			error = 1;
		}
		if(otherParentEmail != ''){
			if(!validateEmail(otherParentEmail)){
				displayModal("Please enter valid email address", ".eroOthEmail");
				if(fel =='')
     				fel = ".oEmail";
				
				$(".eroOthEmail").css("display", "block");
				error = 1;
			}
		}else{
			displayModal("Please enter other's parent email address", ".eroOthEmail");
			if(fel =='')
     			fel = ".oEmail";
			
			$(".eroOthEmail").css("display", "block");
			error = 1;
		}
		if(otherParentMobile == ''){
			displayModal("Please enter other's parent mobile number", ".eroOthPhone");
			if(fel =='')
     			fel = ".oPhone";
			
			$(".eroOthPhone").css("display", "block");
			error = 1;
		}
	}

		if(employerName == ''){
			displayModal("Please enter employer name", ".eroEmpName");
			if(fel =='')
     			fel = ".eName";
			
			$(".eroEmpName").css("display", "block");
			error = 1;
		}
		if(employerEmail != ''){
			if(!validateEmail(employerEmail)){
				displayModal("Please enter valid email address", ".eroEmpEmail");
				if(fel =='')
     				fel = ".eEmail";
				
				$(".eroEmpEmail").css("display", "block");
				error = 1;
		}
		}else{
			displayModal("Please enter employer email address", ".eroEmpEmail");
			if(fel =='')
     			fel = ".eEmail";
			
			$(".eroEmpEmail").css("display", "block");
			error = 1;
		}
		if(employerPhone == ''){
			displayModal("Please enter employer phone number", ".eroEmpPhone");
			if(fel =='')
     			fel = ".ePhone";
			
			$(".eroEmpPhone").css("display", "block");
			error = 1;
		}
		if(employerAddress == ''){
			displayModal("Please enter employer address", ".eroEmpAddr");
			if(fel =='')
     			fel = ".eAddr";
			
			$(".eroEmpAddr").css("display", "block");
			error = 1;
		}
		if(employerEmails == ''){
			displayModal("Please enter employer emails", '.eroEmpEmails');
			if(fel =='')
     			fel = ".eEmails";
			
			$(".eroEmpEmails").css("display", "block");
			error = 1;
		}

		if(emergencyContactName == ''){
			displayModal("Please enter contact name", ".eroEmrName");
			if(fel =='')
     			fel = ".emrName";			
			
			$(".eroEmrName").css("display", "block");
			error = 1;
		}
		if(emergencyContactRelation == ''){
			displayModal("Please enter contact relation", ".eroEmrRel");
			if(fel =='')
     			fel = ".emrRel";
			
			$(".eroEmrRel").css("display", "block");
			error = 1;
		}
		if(emergencyContactPhone == ''){
			displayModal("Please enter contact phone number", ".eroEmrPhone");
			if(fel =='')
     			fel = ".emrPhone";
			
			$(".eroEmrPhone").css("display", "block");
			error = 1;
		}

		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		return true;
	//return true;
}

function nextTab(num1 = '', num2 = '') {
	 $("#collapse" + num1).addClass("in").attr("aria-expanded", 'true');
	 $("#heading" + num1 + " a").removeClass("collapsed").attr("aria-expanded", 'true');
	 $("#heading" + num1 + " a i").addClass("glyphicon-minus").removeClass("glyphicon-plus");

	 $("#collapse" + num2).removeClass("in").attr("aria-expanded", 'false');
	 $("#heading" + num2 + " a").addClass("collapsed").attr("aria-expanded", 'false');
	 $("#heading" + num2 + " a i").removeClass("glyphicon-minus").addClass("glyphicon-plus");
	 $('.scroll-y').mCustomScrollbar('scrollTo', 'top');
}

function emergencyMedicalRelease(){

	$(".aceptPhysician").on("click", function(){
		var error = 0;
		var fel = '';
		var physicianName = $(".physician_name").val(); 
		var physicianPhone = $(".physician_phone").val();
		if(physicianName == ''){
				displayModal("Please enter physician name", ".eroPhysician");
				if(fel =='')
	     			fel = ".ePhysician";
				
				$(".eroPhysician").css("display", "block");
				error = 1;
			}

		if(physicianPhone == ''){
			displayModal("Please enter physician phone number", ".eroPhysicianPhone");
			if(fel =='')
     			fel = ".ePhysicianPhone";
			
			$(".eroPhysicianPhone").css("display", "block");
			error = 1;
		}else{
			if (!validatePhone('physicianPhone')) {
				$('#physicianPhoneStatus').html('Please enter valid number');
	            $('#physicianPhoneStatus').css('color', 'red');
	            error = 1;
	        }
		}	
		if(error == 0){
			nextTab(1,0);
		}	
	});
}

function childRelease(){

	$(".submPrivateInfo").on("click", function(){
		var error = 0;
		var fel = '';
		var authorizeName = $(".authorize_name").val();
		var authorizeRelation = $(".authorize_relation").val();
		var authorizeAddress = $(".authorize_address").val();
		var authorizePhone = $(".authorize_phone").val();

		$('#authPhone').blur(function(e) {
		    if (!validatePhone('authPhone')) {
		        $('#authPhoneStatus').html('Please enter valid number');
		        $('#authPhoneStatus').css('color', 'red');
		        error = 1;
		    }
		});

		$('#auth2Phone').blur(function(e) {
		    if (!validatePhone('auth2Phone')) {
		        $('#authPhone2Status').html('Please enter valid number');
		        $('#authPhone2Status').css('color', 'red');
		        error = 1;
		    }
		});

		
		if(authorizePhone ==''){
			displayModal("Please enter phone", ".eroAuthPhone");
		 	if(fel =='')
     			fel = ".cAuthPhone";
			
			$(".eroAuthPhone").css("display", "block");
			error = 1;
		}
		if(authorizeAddress ==''){
			displayModal("Please enter address", ".eroAuthAddr");
		 	if(fel =='')
     			fel = ".cAuthAddr";
			
			$(".eroAuthAddr").css("display", "block");
			error = 1;
		}
		if(authorizeRelation ==''){
			displayModal("Please enter relation", ".eroAuthRelation");
		 	if(fel =='')
     			fel = ".cAuthRelation";
			
			$(".eroAuthRelation").css("display", "block");
			error = 1;
		}
		if(authorizeName ==''){
			displayModal("Please enter name", ".eroAuthName");
		 	if(fel =='')
     			fel = ".cAuthName";
			
			$(".eroAuthName").css("display", "block");
			error = 1;
		}

		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		if(error == 0){
		  nextTab(2,1);
		}
	});


	$(".preCustody").on("click", function(){
		nextTab(0,1);
	});

	$(".acknowledgeAcpt").on("click", function(){
		nextTab(3,2);
	});
	$(".acknowledgePrev").on("click", function(){
		nextTab(1,2);
	});

	$(".policyPrev").on("click", function(){
		nextTab(2,3);
	});

	$(".policyAcpt").on("click", function(){
		nextTab(4,3);
	});
	
}

function photoConsent(){

	$('input[name="child_consent"]').on("change", function(){
		var consent = $('input[name="child_consent"]:checked').val();
		if(consent == 'L'){
			$(".consent_limitation").show();
		}else if(consent == 'Y'){
			$(".consent_limitation").hide();
			$(".consent_limitation").val('');
		}else if(consent == 'N'){
			$(".consent_limitation").hide();
			$(".consent_limitation").val('');
		}
	});

	$(".sbmtPhotoConsent").on("click", function(){

		var error = 0;
		var enrollChildName = $(".enroll_child_name").val();
		var enrollChildGrade = $(".enroll_child_grade").val();
		var enrollChildAge = $(".enroll_child_age").val();
		var mName = $(".mother_name").val();
		var fName = $(".father_name").val();
		var otherParentName = $(".other_parent_name").val();


		if($('input[name=child_consent]:checked').length==0){
		 	displayModal("Please select Yes, I do give my consent OR No, I do not give my consent", ".eroConcern");
		 	$('.scroll-y').mCustomScrollbar('scrollTo', '.cConcern');
		 	$(".eroConcern").css("display", "block");
		 	error = 1;
		}

		if($('input[name=enroll_child_gender]:checked').length<=0){
		 	displayModal("Please select child gender");
		 	error = 1;
		}
		

		if(enrollChildAge == ''){
			displayModal("Please enter child age");
			$( ".enroll_child_age" ).focus();
			error = 1;
		}
		if(enrollChildGrade == ''){
			displayModal("Please enter child grade", ".eroEnrChild");
			$('.scroll-y').mCustomScrollbar('scrollTo', '.enrChildGrd');
			$(".eroEnrChild").css("display", "block");
			error = 1;
		}
		if(enrollChildName == ''){
			displayModal("Please enter child name");
			$( ".enroll_child_name" ).focus();
			error = 1;
		}


		var childConsents = $('input[name=child_consent]:checked').val();
		if(childConsents == 'L'){
			var consentLimitation = $(".consent_limitation").val();
			if(consentLimitation == ''){
				displayModal("Please enter limitations", ".eroLimit");
				$('.scroll-y').mCustomScrollbar('scrollTo', '.cLimitation');
		 		$(".eroLimit").css("display", "block");
				error = 1;
			}
		}
		var editImg = $(".editImg").val();
		//alert(editImg);
		if(editImg == 0){
			if(document.getElementById('childImg').files.length == 0){
		      displayModal("Please select photo first.", ".eroImg");
		      $('.scroll-y').mCustomScrollbar('scrollTo', '.cImg');
			  $(".eroImg").css("display", "block");
		      return false;
		    }
	    }
	    if(mName !='' && fName !=''){
	        $(".parents_name").val(mName+ ',' + fName); 
	        $(".parent_signs").val(mName+ ',' + fName);       
		}else if(mName !='' && fName == ''){
	        $(".parents_name").val(mName);
	        $(".parent_signs").val(mName);        
		}else if(fName !='' && mName == ''){
	        $(".parents_name").val(fName); 
	        $(".parent_signs").val(fName);       
		}
		if(otherParentName !=''){
	        $(".parents_name").val(otherParentName); 
	        $(".parent_signs").val(otherParentName);       
		}
		if(mName !=''){
	        $(".parents_name").val(mName); 
	        $(".parent_signs").val(mName);       
		}
		if(fName !=''){
	        $(".parents_name").val(fName); 
	        $(".parent_signs").val(fName);       
		}
		if(error == 0){
			nextTab(5,4);
		}
	});


	$(".sbmtPhotoConsentPrev").on("click", function(){
		nextTab(3,4);
	});

	$(".preAllergy").on("click", function(){
		nextTab(4,5);
	});
	$(".subAllergyInfo").on("click", function(){
		nextTab(6,5);
	});
}

function signature(){
	$(".prevParentSignature").on("click", function(){
			$(".nav.nav-tabs li:nth-child(3)").addClass("active");
			$(".nav.nav-tabs li:nth-child(3) a").attr("aria-expanded", 'true');
			$(".nav.nav-tabs li:nth-child(4)").removeClass("active");
			$(".nav.nav-tabs li:nth-child(4) a").attr("aria-expanded", 'false');
			$("#menu3").addClass("active");
			$("#menu4").removeClass("active in");
			$('.scroll-y').mCustomScrollbar('scrollTo', 'top');	
	});
}

function onSelection(){
	var childFName = '';
	var childLName = '';
	$(".child_first_name").keyup(function(){
		childFName = $(this).val();
		$(".transportation_child_name").val(childFName);
		$(".enroll_child_name").val(childFName);
		$(".medical_info_child_name").val(childFName);
		$(".meical_authorization_child_name").val(childFName);
		$(".trip_child_name").val(childFName);
		$(".trip_print_child_name").val(childFName);
		$(".trip_print_child_names").val(childFName);
		$(".children_name").val(childFName);
		$(".child_first_name_allergy").val(childFName);

	});

	$(".child_last_name").keyup(function(){
		childLName = $(this).val();
		$(".transportation_child_name").val(childFName + ' ' + childLName);
		$(".enroll_child_name").val(childFName + ' ' + childLName);
		$(".medical_info_child_name").val(childFName + ' ' + childLName);
		$(".meical_authorization_child_name").val(childFName + ' ' + childLName);
		$(".trip_child_name").val(childFName + ' ' + childLName);
		$(".trip_print_child_name").val(childFName + ' ' + childLName);
		$(".trip_print_child_names").val(childFName + ' ' + childLName);
		$(".children_name").val(childFName + ' ' + childLName);
		$(".child_last_name_allergy").val(childLName);
		$(".child_full_name").val(childFName + ' ' + childLName);
	});
	

	$('.child_genderF').change(function() {
	    if ($(this,':checked')) {
	        $('.enroll_child_genderF').attr('checked', true);
	    }
	});
	$('.child_genderM').change(function() {
	    if ($(this,':checked')) {
	        $('.enroll_child_genderM').attr('checked', true);
	    }
	});

	$('input[name="medical_info"]').on("change", function(){
		var medicalInfo = $('input[name="medical_info"]:checked').val();
		if(medicalInfo == 'Y'){
			$(".showMedicalInfo").show();
		}else if(medicalInfo == 'N'){
			$(".showMedicalInfo").hide();
		}
	});

	
}
function textareaLimit(limit = ''){
	$('textarea').keypress(function(e) {
    var tval = $('textarea').val(),
        tlength = tval.length,
        set = limit,
        remain = parseInt(set - tlength);
    //$('p').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('textarea').val((tval).substring(0, tlength - 1));
        return false;
    }
});
}

function summerCamp(){

	$(".nextSummerCamp").on("click", function(){
		var mName = $(".mother_name").val();
		var fName = $(".father_name").val();
		var otherParentName = $(".other_parent_name").val();
		if(mName !='' && fName !=''){
	        $(".parents_name").val(mName+ ',' + fName); 
	        $(".parent_signs").val(mName+ ',' + fName);       
		}else if(mName !='' && fName == ''){
	        $(".parents_name").val(mName);
	        $(".parent_signs").val(mName);        
		}else if(fName !='' && mName == ''){
	        $(".parents_name").val(fName); 
	        $(".parent_signs").val(fName);       
		}
		if(otherParentName !=''){
	        $(".parents_name").val(otherParentName); 
	        $(".parent_signs").val(otherParentName);       
		}
		var error = 0;
		var fel = '';
		var childRelation = $(".child_relation").val();
		if(childRelation ==''){
			displayModal("Please enter relation", ".eroRelatn");
		 	if(fel =='')
     			fel = ".cRelatn";
			
			$(".eroRelatn").css("display", "block");
			error = 1;
		}
		if(error == 0){
			$("#collapse6").removeClass("in").attr("aria-expanded", 'false');
			$("#heading6 a").addClass("collapsed").attr("aria-expanded", 'false');
			$("#heading6 a i").removeClass("glyphicon-minus").addClass("glyphicon-plus");
			$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
			$(".finalEnrollment").show();


			$(".submParentSign").on("click", function(){
			  $(".nav.nav-tabs li:nth-child(4)").addClass("active");
			  $(".nav.nav-tabs li:nth-child(4) a").attr("aria-expanded", 'true');
			  $(".nav.nav-tabs li:nth-child(3)").removeClass("active");
			  $(".nav.nav-tabs li:nth-child(3) a").attr("aria-expanded", 'false');
			  $("#menu3").removeClass("active");
			  $("#menu4").addClass("active in");
			  $('.scroll-y').mCustomScrollbar('scrollTo', '.nxtParentSignPage');
			});

			$(".prevPolicyAgreement").on("click", function(){
				$(".nav.nav-tabs li:nth-child(2)").addClass("active");
				$(".nav.nav-tabs li:nth-child(2) a").attr("aria-expanded", 'true');
				$(".nav.nav-tabs li:nth-child(3)").removeClass("active");
				$(".nav.nav-tabs li:nth-child(3) a").attr("aria-expanded", 'false');
				$("#menu3").removeClass("active");
				$("#menu2").addClass("active in");
				$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
			});	

		}

		
	});

	$(".preSummerCamp").on("click", function(){
		nextTab(5,6);
	});
	
}