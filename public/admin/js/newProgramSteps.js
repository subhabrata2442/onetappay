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

$.fn.nearest = function(selector) {
  // base case if we can't find anything
  if (this.length == 0)
    return this;
  var nearestSibling = this.prevAll(selector + ':first');
  if (nearestSibling.length > 0)
    return nearestSibling;
  return this.parent().nearest(selector);
};


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
		var hereAboutStem = $(".here_about_stem").val();
		var referredBy = $(".referred_by").val();
		var registrationDate = $(".registration_date").val();
		var startDate = $(".start_date").val();
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
		var attendingSchool = $(".attending_school").val();
		var referredBy = $(".referred_by").val();
		var physicianPhone = $(".primary_physician_phone").val();
		var physicianName = $(".primary_physician_name").val();
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
				$('#txtPhoneId').html('Please enter valid number');
	            $('#txtPhoneId').css('color', 'red');
	            error = 1;
	        }
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

		if(attendingSchool == ''){
			displayModal("Please enter if any attending school",".eroAttend");
			if(fel =='')
				fel = ".cAttend";

			$(".eroAttend").css("display", "block");
			error = 1;
		}

		if(referredBy == ''){
			displayModal("Please enter referred by",".eroRefferdBy");
			if(fel =='')
				fel = ".cRefferdBy";

			$(".eroRefferdBy").css("display", "block");
			error = 1;
		}

		if(physicianName == ''){
			displayModal("Please enter physician name",".eroPhysicianName");
			if(fel =='')
				fel = ".cPhysicianName";

			$(".eroPhysicianName").css("display", "block");
			error = 1;
		}

		if(physicianPhone == ''){
			displayModal("Please enter phone number",".eroPhysicianPhone");
			if(fel =='')
				fel = ".cPhysicianPhone";

			$(".eroPhysicianPhone").css("display", "block");
			error = 1;
		}else{
			if (!validatePhone('primaryPhone')) {
				$('#primaryPhoneStatus').html('Please enter valid number');
	            $('#primaryPhoneStatus').css('color', 'red');
	            error = 1;
	        }
		}

		/*if($('input[name=parents]:checked').length<=0){
		 	displayModal("Please select child lives with", ".eroLeavesWith");
		 	if(fel =='')
					fel = ".childleavs";

		 	$(".eroLeavesWith").css("display", "block");
		 	error = 1;
		}*/
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
		if(registrationDate == ''){
			displayModal("Please select registration date", ".eroReg");
			if(fel =='')
					fel = ".cReg";

			$(".eroReg").css("display", "block");
			error = 1;
		}
		if(startDate == ''){
			displayModal("Please select start date", ".eroStart");
			if(fel =='')
					fel = ".cStart";

			$(".eroStart").css("display", "block");
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
			displayModal("Please enter contact number", ".eroEmrPhone");
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



function policyAgreement(className = ''){
	$(".basicPolicyAct").on("click", function(){
		$('.loader').css('display','block');
		nextTab(1,0);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});

	$(".prevBasicPolicy").on("click", function(){
		$('.loader').css('display','block');
		nextTab(0,1);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});


	$(".diaperChangePolicyAct").on("click", function(){
		$('.loader').css('display','block');
		nextTab(2,1);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});

	$(".preDiaperChange").on("click", function(){
		$('.loader').css('display','block');
		nextTab(1,2);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});


	$(".releaseChildAct").on("click", function(){
		$('.loader').css('display','block');
		nextTab(6,2);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});

	$(".preReleaseChild").on("click", function(){
		$('.loader').css('display','block');
		nextTab(2,6);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});

	$(".childLeftAct").on("click", function(){
		$('.loader').css('display','block');
		nextTab(7,6);
		setTimeout(function(){
			$('.loader').css('display','none');
		},1000);
	});

	$(".preChildLeft").on("click", function(){
		nextTab(6,7);
	});

	$(".pickUpAct").on("click", function(){
		$("#collapse7").removeClass("in").attr("aria-expanded", 'false');
		$("#heading7 a").addClass("collapsed").attr("aria-expanded", 'false');
		$("#heading7 a i").removeClass("glyphicon-minus").addClass("glyphicon-plus");
		$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
		$(".nextEnroll").show();
	});

	$(".prevPolicyAgreements").on("click", function(){
		$(".nav.nav-tabs li:nth-child(2)").addClass("active");
		$(".nav.nav-tabs li:nth-child(2) a").attr("aria-expanded", 'true');
		$(".nav.nav-tabs li:nth-child(3)").removeClass("active");
		$(".nav.nav-tabs li:nth-child(3) a").attr("aria-expanded", 'false');
		$("#menu3").removeClass("active");
		$("#menu2").addClass("active in");
		$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
	});


	$(".submPolicyAgreement").on("click", function(){
		$(".nav.nav-tabs li:nth-child(4)").addClass("active");
		$(".nav.nav-tabs li:nth-child(4) a").attr("aria-expanded", 'true');
		$(".nav.nav-tabs li:nth-child(3)").removeClass("active");
		$(".nav.nav-tabs li:nth-child(3) a").attr("aria-expanded", 'false');
		$("#menu3").removeClass("active");
		$("#menu4").addClass("active in");
		$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
	});

	return true;
}

function enrollmentInfo(){
	/*var consent = $('input[name="child_consent"]:checked').val();
	alert(consent);
	if(consent == 'L'){
		$(".consent_limitation").show();
	}*/

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
	    /*if(!$('.updoad').data('clicked')) {
		    displayModal("<h2>Please select photo first and upload it.</h2>");
		    return false;
		}else{
			$(this).data('clicked', true);
		}*/
		if(error == 0){
			nextTab(4,3);
		}
	});

	$(".prePhotoConsent").on("click", function(){
		nextTab(3,4);
	});

	$(".submAllergy").on("click", function(){

		var error = 0;
		var transportationChildName = $(".transportation_child_name").val();
		var transportationMedium = $(".transportation_medium").val();

		if(transportationMedium == ''){
			displayModal("Please enter transportation medium", ".eroTransport");
			$('.scroll-y').mCustomScrollbar('scrollTo', '.cTransport');
		 	$(".eroTransport").css("display", "block");
			error = 1;
		}
		if(transportationChildName == ''){
			displayModal("Please enter child name");
			$( ".transportation_child_name" ).focus();
			error = 1;
		}

		if(error == 0){
			nextTab(5,4);
		}
	});


	$(".preAllergy").on("click", function(){
		nextTab(4,5);
	});

	$(".subMedicalInfo").on("click", function(){
		var html = '';
		var mName = $(".mother_name").val();
		var fName = $(".father_name").val();
		var otherParentName = $(".other_parent_name").val();
		if(mName !='' && fName !=''){
			html = '<td class="" width="8%">I (we)</td>\
                    <td class="" width="32%"><input class="textBox" name="medical_authorization_mother" type="text" value="'+ mName +'"></td>\
                    <td class="" width="3%" align="center">&amp;</td>\
                    <td class="" width="30%"><input class="textBox" name="medical_authorization_father" type="text" value="'+ fName +'"></td>\
                    <td class="" width="24%" align="left">Parents/Guardians of </td>';

            $(".parents_name").val(mName+ ',' + fName);        
		}else if(mName !='' && fName == ''){
			html = '<td class="" width="1%">I </td><td class="" colspan="2" width="32%"><input class="textBox" name="medical_authorization_mother" type="text" value="'+ mName +'"></td>\
                    <td class="" width="24%" align="left">Parents/Guardians of </td>';
            $(".parents_name").val(mName);        
		}else if(fName !='' && mName == ''){
			html = '<td class="" width="1%">I </td><td class="" colspan="2" width="32%"><input class="textBox" name="medical_authorization_father" type="text" value="'+ fName +'"></td>\
                    <td class="" width="24%" align="left">Parents/Guardians of </td>';
            $(".parents_name").val(fName);        
		}
		
		if(otherParentName !=''){
			html = '<td class="" width="1%">I </td><td class="" colspan="2" width="32%"><input class="textBox" name="medical_authorization_other" type="text" value="'+ otherParentName +'"></td>\
                    <td class="" width="24%" align="left">Parents/Guardians of </td>';
            $(".parents_name").val(otherParentName);        
		}

        $(".parentsDetails").html(html);
		nextTab(8,5);
	});


	$(".preMedicalInfo").on("click", function(){
		nextTab(5,8);
	});

	$(".preCustody").on("click", function(){
		nextTab(10,15);
	});

	$('input[name="custody"]').on("change", function(){
		var dropZone = $('input[name="custody"]:checked').val();
		if(dropZone == 'Y'){
			$("#childDocs").show();
		}else if(dropZone == 'N'){
			$("#childDocs").hide();
		}
	});

	$(".submPrivateInfo").on("click", function(){
		var error = 0;
		var fel = '';
		var authorizeName = $(".authorize_name").val();
		var authorizeRelation = $(".authorize_relation").val();
		var authorizeAddress = $(".authorize_address").val();
		var authorizePhone = $(".authorize_phone").val();
		
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
		if($('input[name=custody]:checked').length==0){
		 	displayModal("Do you have any custody issues/ custodial Papers? Please select", ".eroCustdIssue");
		 	if(fel =='')
     			fel = ".cCustdIssue";
			
			$(".eroCustdIssue").css("display", "block");
			error = 1;
		}


		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		if(error == 0){
		  nextTab(9,15);
		}
	});

	$(".preCustodyInfo").on("click", function(){
		nextTab(15,9);
	});

	$(".infoToParents").on("click", function(){
		var error = 0;
		var fel = '';
		var tripChildName = $(".trip_child_name").val();
		var tripChildNickName = $(".trip_child_nick_name").val();
		var childPrimaryLang = $(".trip_child_primary_lang").val();
		var tripBedTime = $(".trip_bed_time").val();
		var tripTakeCare = $(".trip_take_care").val();
		var tripChildSiblings = $(".trip_child_siblings").val();
		var tripChildBirthOrder = $(".trip_child_birth_order").val();

		if($('input[name=trip_permission]:checked').length==0){
		 	displayModal("Please select your permission", ".eroTripPermission");
		 	if(fel =='')
     			fel = ".cTripPermission";
			
			$(".eroTripPermission").css("display", "block");
			error = 1;
		}
		if(tripChildName == ''){
			displayModal("Please enter child name", ".eroTripCName");
			if(fel =='')
     			fel = ".cTripCName";
			
			$(".eroTripCName").css("display", "block");
			error = 1;
		}
		if(tripChildNickName == ''){
			displayModal("Please enter child nick name", ".eroTripCNick");
			if(fel =='')
     			fel = ".cTripCNick";
			
			$(".eroTripCNick").css("display", "block");
			error = 1;
		}
		if(childPrimaryLang == ''){
			displayModal("Please enter child primary language spoken at home", ".eroPriLang");
			if(fel =='')
     			fel = ".cPriLang";
			
			$(".eroPriLang").css("display", "block");
			error = 1;
		}
		if(tripBedTime == ''){
			displayModal("Please enter child bed time and wake up time", ".eroBedTime");
			if(fel =='')
     			fel = ".cBedTime";
			
			$(".eroBedTime").css("display", "block");
			error = 1;
		}
		if(tripTakeCare == ''){
			displayModal("Please enter primary caretake of child", ".eroTakeCare");
			if(fel =='')
     			fel = ".cTakeCare";
			
			$(".eroTakeCare").css("display", "block");
			error = 1;
		}
		if(tripChildSiblings == ''){
			displayModal("Please enter child number of siblings", ".eroSiblings");
			if(fel =='')
     			fel = ".cSiblings";
			
			$(".eroSiblings").css("display", "block");
			error = 1;
		}
		if(tripChildBirthOrder == ''){
			displayModal("Please enter birth order of child",".eroBirthOrder");
			if(fel =='')
     			fel = ".cBirthOrder";
			
			$(".eroBirthOrder").css("display", "block");
			error = 1;
		}
		if($('input[name=trip_child_group]:checked').length==0){
		 	displayModal("Please select My child has been in home, group, or private care before", ".eroTripGroup");
		 	if(fel =='')
     			fel = ".cTripGroup";
			
			$(".eroTripGroup").css("display", "block");
			error = 1;
		}
		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		if(error == 0){
		  $("#collapse9").removeClass("in").attr("aria-expanded", 'false');
		  $("#heading9 a").addClass("collapsed").attr("aria-expanded", 'false');
		  $("#heading9 a i").removeClass("glyphicon-minus").addClass("glyphicon-plus");
		  $('.scroll-y').mCustomScrollbar('scrollTo', 'top');	
		  $(".nxtParentSignPage").show();
		  $(".submParentSign").on("click", function(){
		  $(".nav.nav-tabs li:nth-child(5)").addClass("active");
		  $(".nav.nav-tabs li:nth-child(5) a").attr("aria-expanded", 'true');
		  $(".nav.nav-tabs li:nth-child(4)").removeClass("active");
		  $(".nav.nav-tabs li:nth-child(4) a").attr("aria-expanded", 'false');
		  $("#menu4").removeClass("active");
		  $("#menu5").addClass("active in");
		  $('.scroll-y').mCustomScrollbar('scrollTo', '.nxtParentSignPage');
		});	

		$(".prevPolicyAgreement").on("click", function(){
			$(".nav.nav-tabs li:nth-child(3)").addClass("active");
			$(".nav.nav-tabs li:nth-child(3) a").attr("aria-expanded", 'true');
			$(".nav.nav-tabs li:nth-child(4)").removeClass("active");
			$(".nav.nav-tabs li:nth-child(4) a").attr("aria-expanded", 'false');
			$("#menu4").removeClass("active");
			$("#menu3").addClass("active in");
			$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
		});	
		}
	});
}

function medicalInfo(){
	
	$('input[name=medical_info]').on("change", function(){
		var medicalInfo = $('input[name=medical_info]:checked').val();
		if(medicalInfo == 'Y'){
			$(".severityCls").show();
		}else if(medicalInfo == 'N'){
			$(".severityCls").hide();
			$( ".medical_allergies" ).val('');
		}
	});

	$('input[name="medical_condition"]').on("change", function(){
		var medicalCon = $('input[name="medical_condition"]:checked').val();
		if(medicalCon == 'Y'){
			$(".medical_conditn").show();
		}else if(medicalCon == 'N'){
			$(".medical_conditn").hide();
			$(".medical_condition_content").val('');
		}
	});

	$('input[name="medical_hamper"]').on("change", function(){
		var hamper = $('input[name="medical_hamper"]:checked').val();
		if(hamper == 'Y'){
			$(".hamperCls").show();
		}else if(hamper == 'N'){
			$(".hamperCls").hide();
			$( ".medical_hamper_content" ).val('');
		}
	});

	$('input[name="under_physician"]').on("change", function(){
		var physicians = $('input[name="under_physician"]:checked').val();
		if(physicians == 'Y'){
			$(".underPhysicianCls").show();
			$(".physicanCls").show();
		}else if(physicians == 'N'){
			$(".underPhysicianCls").hide();
			$(".physicanCls").hide();
			$(".under_physician_explanation").val('');
			$(".physician_name").val('');
			$(".physician_phone").val('');
		}
	});

	$('input[name="medications"]').on("change", function(){
		var medicins = $('input[name="medications"]:checked').val();
		if(medicins == 'Y'){
			$(".medicinCls").show();
		}else if(medicins == 'N'){
			$(".medicinCls").hide();
			$(".medicine_name").val('');
			$(".medicine_side_effect").val('');
		}
	});

	$('input[name="child_devices"]').on("change", function(){
		var childDevices = $('input[name="child_devices"]:checked').val();
		if(childDevices == 'Y'){
			$(".devicesCls").show();
		}else if(childDevices == 'N'){
			$(".devicesCls").hide();
			$(".child_incident").val('');
		}
	});

	$('input[name="group_care"]').on("change", function(){
		var groupCare = $('input[name="group_care"]:checked').val();
		if(groupCare == 'Y'){
			$(".groupCls").show();
		}else if(groupCare == 'N'){
			$(".groupCls").hide();
			$(".group_care_incident").val('');
		}
	});

	$(".submCustody").on("click", function(){
		var error = 0;
		var fel = '';

		if($('input[name=medical_info]:checked').length<=0){
		 	displayModal("Does your child have allergies", ".eroCAlergy");
		 	if(fel =='')
					fel = ".cAlergy";

			$(".eroCAlergy").css("display", "block");
		 	error = 1;
		}
		
		var medInfo = $('input[name=medical_info]:checked').val();
		if(medInfo == 'Y'){
			if($('input[name=severity]:checked').length<=0){
			 	displayModal("Please select severity type", ".eroSevere");
			 	if(fel =='')
					fel = ".cSevere";

				$(".eroSevere").css("display", "block");
			 	error = 1;
			}
			var medicalAllergies = $(".medical_allergies").val();
			if(medicalAllergies == ''){
				displayModal("Please explain about child allergies", ".eroAllergies");
				if(fel =='')
					fel = ".cAllergies";

				$(".eroAllergies").css("display", "block");
			 	error = 1;
			}
		}else if(medInfo == 'N'){
			$( ".medical_allergies" ).val('');
		}

		if($('input[name=medical_condition]:checked').length<=0){
		 	displayModal("Any major illness or physical condition to which you are aware", ".eroMedCon");
		 	if(fel =='')
					fel = ".cMedCon";

				$(".eroMedCon").css("display", "block");
			 	error = 1;
		}


		var medicalCons = $('input[name=medical_condition]:checked').val();
		if(medicalCons == 'Y'){
			var medicalConditn = $(".medical_condition_content").val();
			if(medicalConditn == ''){
				displayModal("Please explain any major illness or physical condition", ".eroMedConditn");
				if(fel =='')
					fel = ".cMedConditn";

				$(".eroMedConditn").css("display", "block");
			 	error = 1;
			}
		}else if(medicalCons == 'N'){
			$( ".medical_condition_content" ).val('');
			$(".eroMedConditn").css("display", "none");
		}

		if($('input[name=medical_hamper]:checked').length<=0){
		 	displayModal("Will this exclude or hamper your child’s participation in center activities?",".eroMedHamper");
		 	if(fel =='')
					fel = ".cMedHamper";

				$(".eroMedHamper").css("display", "block");
			 	error = 1;
		}

		var medicalhamp = $('input[name=medical_hamper]:checked').val();
		if(medicalhamp == 'Y'){
			var hamperCon = $(".medical_hamper_content").val();
			if(hamperCon == ''){
				displayModal("Please explain hamper your child’s participation in center activities?", ".eroMedHamperCon");
				if(fel =='')
					fel = ".cMedHamper";

				$(".eroMedHamperCon").css("display", "block");
			 	error = 1;
			}
		}else if(medicalhamp == 'N'){
			$( ".medical_hamper_content" ).val('');
			$(".eroMedHamperCon").css("display", "none");
		}
		
		if($('input[name=under_physician]:checked').length<=0){
		 	displayModal("Is your child currently under a physician’s care?", ".eroUnderPhysician");
		 	if(fel =='')
					fel = ".cUnderPhysician";

				$(".eroUnderPhysician").css("display", "block");
			 	error = 1;
		}

		var undrPhyscn = $('input[name=under_physician]:checked').val();
		if(undrPhyscn == 'Y'){
			var underPhysician = $(".under_physician_explanation").val();
			if(underPhysician == ''){
				displayModal("Please explain is your child currently under a physician’s care?", ".eroPhysicianExp");
				if(fel =='')
					fel = ".cPhysicianExp";

				$(".eroPhysicianExp").css("display", "block");
			 	error = 1;
			}
		}else if(undrPhyscn == 'N'){
			$( ".under_physician_explanation" ).val('');
			$(".eroPhysicianExp").css("display", "none");
		}

		/*if($('input[name=under_physician]:checked').length<=0){
		 	displayModal("Does your child have allergies");
		 	$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
		 	return false;
		}*/
		
		var undPhys = $('input[name=under_physician]:checked').val();
		if(undPhys == 'Y'){
			var physicianExplanation = $(".under_physician_explanation").val();
			if(physicianExplanation == ''){
				displayModal("Is your child currently under a physician’s care? please explain",".eroPhysicianExp");
				if(fel =='')
					fel = ".cPhysicianExp";

				$(".eroPhysicianExp").css("display", "block");
			 	error = 1;
			}
			var physicianName = $(".physician_name").val();
			var physicianPhone = $(".physician_phone").val();
			if(physicianName == ''){
				displayModal("Please enter physician name", ".eroPhyName");
				if(fel =='')
					fel = ".cPhysician";

				$(".eroPhyName").css("display", "block");
			 	error = 1;
			}
			if(physicianPhone == ''){
				displayModal("Please enter physician phone number", ".eroPhyPhone");
				if(fel =='')
					fel = ".cPhysician";

				$(".eroPhyPhone").css("display", "block");
			 	error = 1;
			}else{
				if (!validatePhone('physicianPhone')) {
					$('#physicianPhoneStatus').html('Please enter valid number');
		            $('#physicianPhoneStatus').css('color', 'red');
		            error = 1;
		        }
			}
		}else if(undPhys == 'N'){
			$( ".under_physician_explanation" ).val('');
			$(".physician_name").val('');
			$(".physician_phone").val('');
			$(".eroPhysicianExp").css("display", "none");
			$(".eroPhyName").css("display", "none");
			$(".eroPhyPhone").css("display", "none");
		}

		if($('input[name=medications]:checked').length<=0){
		 	displayModal("Does your child take prescribed medications?", ".eroMedications");
		 	if(fel =='')
					fel = ".cMedications";

				$(".eroMedications").css("display", "block");
			 	error = 1;
		}

		var medicatn = $('input[name=medications]:checked').val();
		if(medicatn == 'Y'){
			var medicineName = $(".medicine_name").val();
			var sideEffect = $(".medicine_side_effect").val();
			if(medicineName == ''){
				displayModal("Please enter medicin name", ".eroMedName");
				if(fel =='')
					fel = ".cMedName";

				$(".eroMedName").css("display", "block");
			 	error = 1;
			}
			if(sideEffect == ''){
				displayModal("Please enter medicine side effects", ".eroMedSideEfc");
				if(fel =='')
					fel = ".cMedSideEfc";

				$(".eroMedSideEfc").css("display", "block");
			 	error = 1;
			}
		}else if(medicatn == 'N'){
			$( ".medicine_name" ).val('');
			$(".medicine_side_effect").val('');
		}


		if($('input[name=child_devices]:checked').length<=0){
		 	displayModal("Does your child use any special devices?", ".eroDevice");
		 	if(fel =='')
					fel = ".cDevice";

				$(".eroDevice").css("display", "block");
			 	error = 1;
		}


		var childDevice = $('input[name=child_devices]:checked').val();
		if(childDevice == 'Y'){
			var incident = $(".child_incident").val();
			if(incident == ''){
				displayModal("Please indicate about your child device", ".eroDeviceCont");
				if(fel =='')
					fel = ".cDeviceCont";

				$(".eroDeviceCont").css("display", "block");
			 	error = 1;
			}
		}else if(childDevice == 'N'){
			$( ".child_incident" ).val('');
			$(".eroDeviceCont").css("display", "none");
		}


		if($('input[name=group_care]:checked').length<=0){
		 	displayModal("Does your child being in group care?", ".eroGroupCare");
		 	if(fel =='')
					fel = ".cGroupCare";

				$(".eroGroupCare").css("display", "block");
			 	error = 1;
		}


		var groupCares = $('input[name=group_care]:checked').val();
		if(groupCares == 'Y'){
			var groupCareIncident = $(".group_care_incident").val();
			if(groupCareIncident == ''){
				displayModal("Please indicate group care incident", ".eroGroupCareCont");
				if(fel =='')
					fel = ".cGroupCareCont";

				$(".eroGroupCareCont").css("display", "block");
			 	error = 1;
			}
		}else if(groupCares == 'N'){
			$( ".child_incident" ).val('');
			$(".eroGroupCareCont").css("display", "none");
		}

		var knownAllergies = $(".known_allergies").val();
		var lastBooster = $(".last_booster").val();
		if(knownAllergies == ''){
				displayModal("Please indicate known allergies to medication or foods", ".eroKnownAllerg");
				if(fel =='')
					fel = ".cKnownAllerg";

				$(".eroKnownAllerg").css("display", "block");
			 	error = 1;
		}

		if(lastBooster == ''){
				displayModal("Please indicate last tetanus/ diptheria booster", ".eroLastBooster");
				if(fel =='')
					fel = ".cLastBooster";

				$(".eroLastBooster").css("display", "block");
			 	error = 1;
		}

		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		if(error == 0){
			nextTab(10,8);
			//return true;
		}
		
		return true;
	});
	
	return true;
}

function pickUpDrop(){
	$(".nxtCust").on("click", function(){
		nextTab(15,10);
	});
	$(".preMedical").on("click", function(){
		nextTab(8,10);
	});

}

function parentsSignOff(){
	$(".finalSign").on("click", function(){
		var error = 0;
		var fel = '';
		if($('input[name=received_parent_hadnbook]:checked').length==0 || $('input[name=responsible_parent_handbook]:checked').length==0 || $('input[name=aware_parent_handbook]:checked').length==0 || $('input[name=electronic_copy_parent_handbook]:checked').length==0){
			 displayModal("Please accept All", ".eroAcceptance");
			 if(fel =='')
					fel = ".cAcceptance";

				$(".eroAcceptance").css("display", "block");
			 	error = 1;

		}
		if(error == 1){
			$('.scroll-y').mCustomScrollbar('scrollTo',$(fel));
			return false;
		}
		if(error == 0){
			$(".nav.nav-tabs li:nth-child(6)").addClass("active");
			$(".nav.nav-tabs li:nth-child(6) a").attr("aria-expanded", 'true');
			$(".nav.nav-tabs li:nth-child(5)").removeClass("active");
			$(".nav.nav-tabs li:nth-child(5) a").attr("aria-expanded", 'false');
			$("#menu5").removeClass("active");
			$("#menu6").addClass("active in");
			$('.scroll-y').mCustomScrollbar('scrollTo', 'top');
		}	
	});

	$(".prevParentSign").on("click", function(){
			$(".nav.nav-tabs li:nth-child(4)").addClass("active");
			$(".nav.nav-tabs li:nth-child(4) a").attr("aria-expanded", 'true');
			$(".nav.nav-tabs li:nth-child(5)").removeClass("active");
			$(".nav.nav-tabs li:nth-child(5) a").attr("aria-expanded", 'false');
			$("#menu5").removeClass("active");
			$("#menu4").addClass("active in");
			$('.scroll-y').mCustomScrollbar('scrollTo', 'top');	
	});
	
}

function signature(){
	$(".prevParentSignature").on("click", function(){
			$(".nav.nav-tabs li:nth-child(5)").addClass("active");
			$(".nav.nav-tabs li:nth-child(5) a").attr("aria-expanded", 'true');
			$(".nav.nav-tabs li:nth-child(6)").removeClass("active");
			$(".nav.nav-tabs li:nth-child(6) a").attr("aria-expanded", 'false');
			$("#menu6").removeClass("active");
			$("#menu5").addClass("active in");
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