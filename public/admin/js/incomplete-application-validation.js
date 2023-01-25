function displayError(errorMsgTerms = '', errorCls = ''){
      var errorTxt = errorMsgTerms;
      $(errorCls).text(errorTxt);
      //$(this).closest('div').find('.errorTxt').text(errorTxt);
}

function validationKeyUp(clsName = '', errorCls = ''){

    $(clsName).keyup(function(){
        $(clsName).removeClass(errorCls);
        //console.log(clsName);
    });

}

function validateOnSelect(clsName = '', errorCls = ''){
    $(clsName).change(function() {
      $(clsName).removeClass(errorCls)
    });
}

function isNumber(evt, className='') {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        $(className).addClass("comneror");
        return false;
    }
    $(className).removeClass("comneror");
    return true;
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

function singleKeyUp(zipcode=''){
    $(zipcode).on('keyup',function(){
           var charCount = $(this).val().replace(/\s/g, '').length;
           if(charCount <5){
                $(zipcode).addClass("comneror");
           }else{
                $(zipcode).removeClass("comneror");
           }
        });
}

function validatePhone(phoneCls=''){
    $(phoneCls).on('keyup',function(){
           var numCount = $(this).val().replace(/\s/g, '').length;
           if(numCount <13){
                $(phoneCls).addClass("comneror");
           }else{
                $(phoneCls).removeClass("comneror");
           }
        });
}

function stringOnly(stringCls=''){
    $(stringCls).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(stringCls).addClass("comneror");
            }else{
                $(stringCls).removeClass("comneror");
            }
        });
}

function hasErrorCls(errorCls='',removeCls=''){
    $(errorCls).change(function() {
    if(this.checked) {
        if($(removeCls).hasClass("comneror")){
            $(removeCls).removeClass('comneror');
        } 
    }
});
}

function radiobuttonError(errorCls='',parentCls='',removeCls=''){
    $(errorCls).change(function() {
        if(this.checked) {
            if($(parentCls).parent().hasClass(removeCls)){
                $(parentCls).parent().removeClass(removeCls);
                
            } 
        }
    });
}

$(document).ready(function(){
    $( ".child_first_name" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(".child_first_name").addClass("comneror");
            }else{
                $(".child_first_name").removeClass("comneror");
            }
        }); 

       $( ".child_last_name" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(".child_last_name").addClass("comneror");
            }else{
                $(".child_last_name").removeClass("comneror");
            }
        });
            
       $('.child_zip_code').on('keyup',function(){
           var charCount = $(this).val().replace(/\s/g, '').length;
           if(charCount <5){
                $(".child_zip_code").addClass("comneror");
           }else{
                $(".child_zip_code").removeClass("comneror");
           }
        }); 

       $('.primary_phone').on('keyup',function(){
           var numCount = $(this).val().replace(/\s/g, '').length;
           if(numCount <13){
                $(".primary_phone").addClass("comneror");
           }else{
                $(".primary_phone").removeClass("comneror");
           }
        });

       $('input[type=radio][name=leavsWith]').change(function() {
            if (this.value == '4') {
                var html = '<input type="text" name="other_relation" placeholder="Relationship" class="form-control other_relation">';
                $(".otherRelation").html(html);
                validationKeyUp(".other_relation", "comneror");
            }else{
                $(".otherRelation").html('');
            }
        });

       $('.emergency_contact_phone').on('keyup',function(){
           var numCount = $(this).val().replace(/\s/g, '').length;
           if(numCount <13){
                $(".emergency_contact_phone").addClass("comneror");
           }else{
                $(".emergency_contact_phone").removeClass("comneror");
           }
        });

       $('.emergency_contact_phoneOne').on('keyup',function(){
           var numCount = $(this).val().replace(/\s/g, '').length;
           if(numCount <13){
                $(".emergency_contact_phoneOne").addClass("comneror");
           }else{
                $(".emergency_contact_phoneOne").removeClass("comneror");
           }
        });

   stringOnly(".mother_first_name"); 
   stringOnly(".mother_last_name");  
   stringOnly(".mother_employer_name"); 
   stringOnly(".father_first_name"); 
   stringOnly(".father_last_name");  
   stringOnly(".father_employer_name"); 
   stringOnly(".emergency_contact_name");
   //stringOnly(".emergency_contact_nameOne");
   stringOnly(".emergency_contact_relation");
   //stringOnly(".emergency_contact_relationOne");
   stringOnly(".other_employer_name");
   stringOnly(".other_first_name");
   stringOnly(".other_last_name");
   stringOnly(".authorize_name");
   //stringOnly(".authorize_name_one");

   stringOnly(".authorize_relation");
   //stringOnly(".authorize_relation_one");

   hasErrorCls(".accept_medical_treatment", ".medicalAcept");
   //radiobuttonError(".allergies", ".alerAct", ".comneror");
   hasErrorCls(".accept_parent_release", ".acknowledges");
   hasErrorCls(".step_one_accept", ".policy");
   hasErrorCls(".accept_dcf", ".acknowledge4");
   hasErrorCls(".policy_acpt", ".policies2");
   hasErrorCls(".accept_photo_concent", ".acknowledge5");
   hasErrorCls(".allergy_acpt", ".acknowledge15");
   hasErrorCls(".accept_transportation", ".acknowledge7");
});

$('.sel_program').on('change', function() {
    var val = this.value;
    if(val == 1){
        $(".selected_program").text('(Infant, 6 weeks to 18 months)');
    }else if(val == 2){
        $(".selected_program").text('(Toddler, 19 months to 36 months)');
    }else if(val == 3){
        $(".selected_program").text('(Preschool, 3 years)');
    }else if(val == 4){
        $(".selected_program").text('(Pre-K, 4 years)');
    }else if(val == 5){
        $(".selected_program").text('(Kindergarten, 5 years)');
    }else if(val == 6){
        $(".selected_program").text('(1st Grade, 6 years)');
    }else if(val == 7){
        $(".selected_program").text('(Before Care)');
    }else if(val == 8){
        $(".selected_program").text('(After Care)');
    }
});

$('.child_grade').on('change', function() {
    var val = this.value;
    $(".cGrade").val(val);
});
$(".birth_order").prop("disabled", true);

function childInfo(){
    $('.attending_school').on('change', function() {
      var selVal = $(this).val();
      if(selVal != 'NA'){
        $(".child_grade").prop("disabled", false);
      }else{
        $(".child_grade").prop("disabled", true);
      }
    });

    $('.siblings').on('change', function() {
      var selSibVal = $(this).val();
      if(selSibVal != 0){
        $(".birth_order").prop("disabled", false);
      }else{
        $(".birth_order").prop("disabled", true);
        $(".birth_order").val('');
        $(".birth_order").removeClass('comneror');
      }
    });
    
    $(".childInfoNxt").click(function(e){
        //$(".prevChildInfoInput").val('');
        e.preventDefault();
        var error =0;
        var childFName = $(".child_first_name").val();
        var childLName = $(".child_last_name").val();
        var childDob =  $(".child_dob").val();
        var childStreet = $(".child_street_name").val();
        var childZipCode = $(".child_zip_code").val();
        var childGrade = $(".child_grade").val();
        var childState = $(".child_state_name").val();
        var childCity = $(".child_city_name").val();
        var primaryContact = $(".child_primary_contact").val();
        var childRelation = $(".child_relation").val();
        var primaryEmail = $(".child_primary_email").val();
        var primaryPhone = $(".primary_phone").val();
        var registrationDate = $(".registration_date").val();
        var startDate = $(".start_date").val();
        var program = $(".sel_program").val();
        var programTime = $(".program_time").val();
        var childCareBefore = $('input[name="child_care_before"]:checked').val();
        var bedTime = $(".bed_time").val();
        var wakeUpTime = $(".wake_up_time").val();
        var siblings = $(".siblings").val();
        var birthOrder = $(".birth_order").val();
        var hearAboutStem = $(".hear_about_stem").val();
        var referredBy = $(".referred_by").val();
        var leavsWith = $("input[name='leavsWith']:checked").val();
        var specialRequest = $(".special_request").val();
        var childAge = $(".child_ages").val();
        var childGender = $('input[name="gender"]:checked').val();
        var otherRelations = $(".other_relation").val();
        var attendingSchool = $(".attending_school").val();
        var fel = '';
        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");
        var childLv = $(".childLv").val();

        if(childFName == ''){
            if(fel =='')
                fel = ".cFN";

            $(".child_first_name").addClass('comneror');
            $(".child_first_name").focus();
            error = 1;
        }

        if(childLName == ''){
            if(fel =='')
                fel = ".cLN";

            $(".child_last_name").addClass("comneror");
            $(".child_last_name").focus();
            error = 1;
        }

        if(childDob == ''){
            
            if(fel =='')
                fel = ".cDOB";

            $(".child_dob").addClass("comneror");
            $(".child_dob").focus();
            error = 1;
        }

        if(childStreet == ''){
            
            if(fel =='')
                fel = ".cStr";

            $(".child_street_name").addClass("comneror");
            $(".child_street_name").focus();
            error = 1;
        }

        if(childZipCode == ''){    
            if(fel =='')
                fel = ".cZip";

            $(".child_zip_code").addClass("comneror");
            $(".child_zip_code").focus();
            error = 1;
        }

        /*if(childGrade == ''){    
            if(fel =='')
                fel = ".cGrd";

            $(".child_grade").addClass("comneror");
            $(".child_grade").focus();
            error = 1;
        }*/

        if(childState == ''){    
            if(fel =='')
                fel = ".cState";

            $(".child_state_name").addClass("comneror");
            $(".child_state_name").focus();
            error = 1;
        }

        if(childCity == ''){    
            if(fel =='')
                fel = ".cCity";

            $(".child_city_name").addClass("comneror");
            $(".child_city_name").focus();
            error = 1;
        }

        if(primaryContact == ''){    
            if(fel =='')
                fel = ".cPrimaryCon";

            $(".child_primary_contact").addClass("comneror");
            $(".child_primary_contact").focus();
            error = 1;
        }

        if(childRelation == ''){    
            if(fel =='')
                fel = ".cRel";

            $(".child_relation").addClass("comneror");
            $(".child_relation").focus();
            error = 1;
        }

        if(primaryEmail != ''){
            if(!validateEmail(primaryEmail)){
                if(fel =='')
                    fel = ".pEmail";

                $(".child_primary_email").addClass("comneror");
                $(".child_primary_email").focus();
                error = 1;
            }
        }else{
            if(fel =='')
                    fel = ".pEmail";

            $(".child_primary_email").addClass("comneror");
            $(".child_primary_email").focus();
            error = 1; 
        }

        if ($(".child_primary_email").hasClass("comneror")) {
          error = 1;
        }

        if(primaryPhone == ''){
            if(fel =='')
                fel = ".pPhone";

            $(".primary_phone").addClass("comneror");
            $(".primary_phone").focus();
            error = 1;
        }
        if(startDate == ''){
            if(fel =='')
                fel = ".sDate";

            $(".start_date").addClass("comneror");
            $(".start_date").focus();
            error = 1;
        }

        if(program == ''){
            if(fel =='')
                fel = ".pProgram";

            $(".sel_program").addClass("comneror");
            $(".sel_program").focus();
            error = 1;
        }

        if(programTime == ''){
            if(fel =='')
                fel = ".pTime";

            $(".program_time").addClass("comneror");
            $(".program_time").focus();
            error = 1;
        }

        if(bedTime == ''){
            if(fel =='')
                fel = ".bTime";

            $(".bed_time").addClass("comneror");
            $(".bed_time").focus();
            error = 1;
        }

        if(wakeUpTime == ''){
            if(fel =='')
                fel = ".wTime";

            $(".wake_up_time").addClass("comneror");
            $(".wake_up_time").focus();
            error = 1;
        }
        if(siblings == ''){
            if(fel =='')
                fel = ".sSib";

            $(".siblings").addClass("comneror");
            $(".siblings").focus();
            error = 1;
        }

        if(siblings !=0 && birthOrder == ''){
            if(fel =='')
                fel = ".bOrder";

            $(".birth_order").addClass("comneror");
            $(".birth_order").focus();
            error = 1;
        }


        if(hearAboutStem == ''){
            if(fel =='')
                fel = ".hStem";

            $(".hear_about_stem").addClass("comneror");
            $(".hear_about_stem").focus();
            error = 1;
        }

        /*if(referredBy == ''){
            if(fel =='')
                fel = ".rBy";

            $(".referred_by").addClass("comneror");
            $(".referred_by").focus();
            error = 1;
        }*/

        if(leavsWith == 4){
            var otherRelation = $(".other_relation").val();
            if(otherRelation == ''){
                if(fel =='')
                    fel = ".otherRelation";

                $(".other_relation").addClass("comneror");
                $(".other_relation").focus();
                error = 1;
            }
        }
        if(error == 0){
            if(leavsWith == 1){
                $("#otherParent").hide();
                $("#mother").show();
                $("#father").show();
            }else if(leavsWith == 2){
                $("#father").hide();
                $("#otherParent").hide();
                $("#mother").show();
            }else if(leavsWith == 3){
                $("#mother").hide();
                $("#otherParent").hide();
                $("#father").show();
            }else if(leavsWith == 4){
                var otherRelation = $(".other_relation").val();
                $(".otherRelation").val(otherRelation); 
                $("#father").hide();
                $("#mother").hide();
                $("#otherParent").show();
            }
            $(".loader").css("display","block");
            //setTimeout(function() {
                //alert(childImgUpload);
                 if ($('.childInformation').is(":visible")){
                    current_fs = $('.childInformation');
                    next_fs = $('.parentInformation');
                    var nextId = $(this).parents('.tab-pane').next().attr("id");
                    $('[href=#'+nextId+']').tab('show');
                }


                var childInfo = {'childFName': childFName, 
                'childLName': childLName, 
                'childDob': childDob,
                'childAge':childAge,
                'childGender':childGender,
                'leavsWith': leavsWith,
                'otherRelations':otherRelations,
                'attendingSchool':attendingSchool,
                'childStreet': childStreet,
                'childZipCode': childZipCode,
                'childGrade': childGrade,
                'childState': childState,
                'childCity': childCity,
            };
             var childPrimaryInfo = { 
                'primaryContact': primaryContact,
                'childRelation': childRelation,
                'primaryEmail': primaryEmail,
                'primaryPhone': primaryPhone,
                'registrationDate': registrationDate,
                'startDate': startDate,
                'program': program,
                'programTime': programTime,
                'childCareBefore': childCareBefore,
                'bedTime': bedTime,
                'wakeUpTime': wakeUpTime,
                'siblings': siblings,
                'birthOrder': birthOrder,
                'specialRequest':specialRequest,
                'hearAboutStem': hearAboutStem,
                'referredBy': referredBy,
                
            };

                $.ajax({
                      method: "POST",
                      url: childInfoUrl,
                      data: { 'childInfo':childInfo,
                              'childPrimaryInfo':childPrimaryInfo,  
                              'currentTab':currentTab, 
                              "_token":childInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         //console.log(data);
                         if(data.success == 1){
                            activLi.addClass("succesOr");
                            $(".childLv").val(leavsWith);
                         setTimeout(function() {
                            next_fs.show('slow'); 
                            current_fs.hide();
                            $('html, body').animate({
                                scrollTop: $(".parentInformation").offset().top
                            }, 1000);
                        $(".loader").css("display","none");
                        }, 3000);
                         }
                    }
                });
                
            //}, 2000); // <-- time in milliseconds
        }
    });
}

$(".prevChildInfo").click(function(){
    $(".loader").css("display","block");
    if ($('.parentInformation').is(":visible")){
        current_fs = $('.parentInformation');
        next_fs = $('.childInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $('#step-1 .nav-tabs a[tabnumber="2"]').parent().removeClass('active succesOr');
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".childInformation").offset().top
    }, 1000);
});


function checkMother(){
        var error = 0;
        //Mother
        var mFName = $(".mother_first_name").val();
        var mLName = $(".mother_last_name").val();
        var mStreet = $(".mother_street_name").val();
        var mState = $(".mother_state_name").val();
        var mCity = $(".mother_city_name").val();
        var mZipCode = $(".mother_zip_code").val();
        var mCellPhone = $(".mother_cell_phone").val();
        var motherEmail = $(".mother_email").val();
        var mEmployerName = $(".mother_employer_name").val();
        var mEmployerAddress = $(".mother_employer_address").val();
        var mEmployerPhone = $(".mother_employer_phone").val();
        var mEmployerEmail = $(".mother_employer_email").val();
        //End Mother
        var fel = '';
        //Mother
            if(mFName == ''){
                if(fel =='')
                    fel = ".mFN";

                $(".mother_first_name").addClass("comneror");
                $(".mother_first_name").focus();
                error = 1;
            }

            if(mLName == ''){
                if(fel =='')
                    fel = ".mLN";

                $(".mother_last_name").addClass("comneror");
                $(".mother_last_name").focus();
                error = 1;
            }

            if(mStreet == ''){
                if(fel =='')
                    fel = ".mSN";

                $(".mother_street_name").addClass("comneror");
                $(".mother_street_name").focus();
                error = 1;
            }
            if(mState == ''){
                if(fel =='')
                    fel = ".mSTA";

                $(".mother_state_name").addClass("comneror");
                $(".mother_state_name").focus();
                error = 1;
            }  
            if(mCity == ''){
                if(fel =='')
                    fel = ".mCT";

                $(".mother_city_name").addClass("comneror");
                $(".mother_city_name").focus();
                error = 1;
            }

            if(mZipCode != ''){
                if(!singleKeyUp(".mother_zip_code")){
                    if(fel =='')
                        fel = ".mZIP";

                    $(".mother_zip_code").addClass("comneror");
                    $(".mother_zip_code").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".mZIP";

                $(".mother_zip_code").addClass("comneror");
                $(".mother_zip_code").focus();
                error = 1; 
            }

            if(mCellPhone == ''){
                if(fel =='')
                    fel = ".mCPHN";

                $(".mother_cell_phone").addClass("comneror");
                $(".mother_cell_phone").focus();
                error = 1;
            }

            if(motherEmail != ''){
                if(!validateEmail(motherEmail)){
                    if(fel =='')
                        fel = ".mEmail";

                    $(".mother_email").addClass("comneror");
                    $(".mother_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".mEmail";

                $(".mother_email").addClass("comneror");
                $(".mother_email").focus();
                error = 1; 
            }

            if ($(".mother_email").hasClass("comneror")) {
              error = 1;
            }

            if(mEmployerName == ''){
                if(fel =='')
                    fel = ".mEmp";

                $(".mother_employer_name").addClass("comneror");
                $(".mother_employer_name").focus();
                error = 1;
            }

            if(mEmployerAddress == ''){
                if(fel =='')
                    fel = ".mEmpAddr";

                $(".mother_employer_address").addClass("comneror");
                $(".mother_employer_address").focus();
                error = 1;
            }

            if(mEmployerPhone == ''){
                if(fel =='')
                    fel = ".mEmpPhone";

                $(".mother_employer_phone").addClass("comneror");
                $(".mother_employer_phone").focus();
                error = 1;
            }

            if(mEmployerEmail != ''){
                if(!validateEmail(mEmployerEmail)){
                    if(fel =='')
                        fel = ".mEmpEmail";

                    $(".mother_employer_email").addClass("comneror");
                    $(".mother_employer_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".mEmpEmail";

                $(".mother_employer_email").addClass("comneror");
                $(".mother_employer_email").focus();
                error = 1; 
            }

            if ($(".mother_employer_email").hasClass("comneror")) {
              error = 1;
            }
            //End Mother
            return error;
}

function checkFather(){
        var error = 0;
        //Father
        var fFName = $(".father_first_name").val();
        var fLName = $(".father_last_name").val();
        var fStreet = $(".father_street_name").val();
        var fState = $(".father_state_name").val();
        var fCity = $(".father_city_name").val();
        var fZipCode = $(".father_zip_code").val();
        var fCellPhone = $(".father_cell_phone").val();
        var fatherEmail = $(".father_email").val();
        var fEmployerName = $(".father_employer_name").val();
        var fEmployerAddress = $(".father_employer_address").val();
        var fEmployerPhone = $(".father_employer_phone").val();
        var fEmployerEmail = $(".father_employer_email").val();
        //End Father
        var fel = '';

        //Father
            if(fFName == ''){
                if(fel =='')
                    fel = ".fFN";

                $(".father_first_name").addClass("comneror");
                $(".father_first_name").focus();
                error = 1;
            }

            if(fLName == ''){
                if(fel =='')
                    fel = ".fLN";

                $(".father_last_name").addClass("comneror");
                $(".father_last_name").focus();
                error = 1;
            }

            if(fStreet == ''){
                if(fel =='')
                    fel = ".fSN";

                $(".father_street_name").addClass("comneror");
                $(".father_street_name").focus();
                error = 1;
            }
            if(fState == ''){
                if(fel =='')
                    fel = ".fSTA";

                $(".father_state_name").addClass("comneror");
                $(".father_state_name").focus();
                error = 1;
            }  
            if(fCity == ''){
                if(fel =='')
                    fel = ".fCT";

                $(".father_city_name").addClass("comneror");
                $(".father_city_name").focus();
                error = 1;
            }

            if(fZipCode == ''){
                if(fel =='')
                    fel = ".fZIP";

                $(".father_zip_code").addClass("comneror");
                $(".father_zip_code").focus();
                error = 1;
            }

            if(fCellPhone == ''){
                if(fel =='')
                    fel = ".fCPHN";

                $(".father_cell_phone").addClass("comneror");
                $(".father_cell_phone").focus();
                error = 1;
            }

            if(fatherEmail != ''){
                if(!validateEmail(fatherEmail)){
                    if(fel =='')
                        fel = ".fEmail";

                    $(".father_email").addClass("comneror");
                    $(".father_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".fEmail";

                $(".father_email").addClass("comneror");
                $(".father_email").focus();
                error = 1; 
            }

            if ($(".father_email").hasClass("comneror")) {
              error = 1;
            }

            if(fEmployerName == ''){
                if(fel =='')
                    fel = ".fEmp";

                $(".father_employer_name").addClass("comneror");
                $(".father_employer_name").focus();
                error = 1;
            }

            if(fEmployerAddress == ''){
                if(fel =='')
                    fel = ".fEmpAddr";

                $(".father_employer_address").addClass("comneror");
                $(".father_employer_address").focus();
                error = 1;
            }

            if(fEmployerPhone == ''){
                if(fel =='')
                    fel = ".fEmpPhone";

                $(".father_employer_phone").addClass("comneror");
                $(".father_employer_phone").focus();
                error = 1;
            }


            if(fEmployerEmail != ''){
                if(!validateEmail(fEmployerEmail)){
                    if(fel =='')
                        fel = ".fEmpEmail";

                    $(".father_employer_email").addClass("comneror");
                    $(".father_employer_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".fEmpEmail";

                $(".father_employer_email").addClass("comneror");
                $(".father_employer_email").focus();
                error = 1; 
            }

            if ($(".father_employer_email").hasClass("comneror")) {
              error = 1;
            }
            //End Father

            return error;
}

function checkOthers(){
        var error = 0;
        //Others
        var oFName = $(".other_first_name").val();
        var oLName = $(".other_last_name").val();
        var oStreet = $(".other_street_name").val();
        var oState = $(".other_state_name").val();
        var oCity = $(".other_city_name").val();
        var oZipCode = $(".other_zip_code").val();
        var oCellPhone = $(".other_cell_phone").val();
        var otherEmail = $(".other_email").val();
        var oEmployerName = $(".other_employer_name").val();
        var oEmployerAddress = $(".other_employer_address").val();
        var oEmployerPhone = $(".other_employer_phone").val();
        var oEmployerEmail = $(".other_employer_email").val();
        //End Others
        var fel = '';

        if(oFName == ''){
            if(fel =='')
                fel = ".oFN";

            $(".other_first_name").addClass('comneror');
            $(".other_first_name").focus();
            error = 1;
        }

        if(oLName == ''){
            if(fel =='')
                fel = ".oLN";

            $(".other_last_name").addClass('comneror');
            $(".other_last_name").focus();
            error = 1;
        }
            if(oStreet == ''){
                if(fel =='')
                    fel = ".oSN";

                $(".other_street_name").addClass("comneror");
                $(".other_street_name").focus();
                error = 1;
            }
            if(oState == ''){
                if(fel =='')
                    fel = ".oSTA";

                $(".other_state_name").addClass("comneror");
                $(".other_state_name").focus();
                error = 1;
            }  
            if(oCity == ''){
                if(fel =='')
                    fel = ".oCT";

                $(".other_city_name").addClass("comneror");
                $(".other_city_name").focus();
                error = 1;
            }

            if(oZipCode == ''){
                if(fel =='')
                    fel = ".oZIP";

                $(".other_zip_code").addClass("comneror");
                $(".other_zip_code").focus();
                error = 1;
            }

            if(oCellPhone == ''){
                if(fel =='')
                    fel = ".oCPHN";

                $(".other_cell_phone").addClass("comneror");
                $(".other_cell_phone").focus();
                error = 1;
            }

            if(otherEmail != ''){
                if(!validateEmail(otherEmail)){
                    if(fel =='')
                        fel = ".oEmail";

                    $(".other_email").addClass("comneror");
                    $(".other_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".oEmail";

                $(".other_email").addClass("comneror");
                $(".other_email").focus();
                error = 1; 
            }

            if ($(".other_email").hasClass("comneror")) {
              error = 1;
            }

            if(oEmployerName == ''){
                if(fel =='')
                    fel = ".oEmp";

                $(".other_employer_name").addClass("comneror");
                $(".other_employer_name").focus();
                error = 1;
            }

            if(oEmployerAddress == ''){
                if(fel =='')
                    fel = ".oEmpAddr";

                $(".other_employer_address").addClass("comneror");
                $(".other_employer_address").focus();
                error = 1;
            }

            if(oEmployerPhone == ''){
                if(fel =='')
                    fel = ".oEmpPhone";

                $(".other_employer_phone").addClass("comneror");
                $(".other_employer_phone").focus();
                error = 1;
            }

            if(oEmployerEmail != ''){
                if(!validateEmail(oEmployerEmail)){
                    if(fel =='')
                        fel = ".oEmpEmail";

                    $(".other_employer_email").addClass("comneror");
                    $(".other_employer_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".oEmpEmail";

                $(".other_employer_email").addClass("comneror");
                $(".other_employer_email").focus();
                error = 1; 
            }

            if ($(".other_employer_email").hasClass("comneror")) {
              error = 1;
            }
            return error;
}

function parentInfo(){
    $(".parentInfoNxt").click(function(e){
        e.preventDefault();
        var newError =0;
        var leavsWith = $("input[name='leavsWith']:checked").val();
        var emergencyContact = $(".emergency_contact_name").val();
        var emergencyContactRelation = $(".emergency_contact_relation").val();
        var emergencyContactPhone = $(".emergency_contact_phone").val();
        var emergencyContactOne = $(".emergency_contact_nameOne").val();
        var emergencyContactRelationOne = $(".emergency_contact_relationOne").val();
        var emergencyContactPhoneOne = $(".emergency_contact_phoneOne").val();
        var prevChildInfoInput = $(".prevChildInfoInput").val();

        var mFName = $(".mother_first_name").val();
        var mLName = $(".mother_last_name").val();

        var oFName = $(".other_first_name").val();
        var oLName = $(".other_last_name").val();

        var fFName = $(".father_first_name").val();
        var fLName = $(".father_last_name").val();

        var childFName = $(".child_first_name").val();
        var childLName = $(".child_last_name").val();

        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");

        var few = '';

        if(leavsWith == 1){
            var ckm = checkMother();
            var ckf = checkFather();
            if(ckm == 1 && ckf == 1){
                newError == 1;
            }else{
                newError == 0;
            }
        }else if(leavsWith == 2){
            var cm = checkMother();
            if(cm == 1){
                newError == 1;
            }else{
                newError == 0;
            }
        }else if(leavsWith == 3){
            var cf = checkFather();
            if(cf == 1){
                newError == 1;
            }else{
                newError == 0;
            }
        }else if(leavsWith == 4){
            var ch = checkOthers();
            if(ch == 1){
                newError == 1;
            }else{
                newError == 0;
            }

        }

        if(emergencyContact == ''){
            if(few =='')
                few = ".eName";

            $(".emergency_contact_name").addClass('comneror');
            $(".emergency_contact_name").focus();
            newError = 1;
        }

        if(emergencyContactRelation == ''){
            if(few =='')
                few = ".eRelation";

            $(".emergency_contact_relation").addClass('comneror');
            $(".emergency_contact_relation").focus();
            newError = 1;
        }


        if(emergencyContactPhone == ''){
            if(few =='')
                few = ".EmerPhone";

            $(".emergency_contact_phone").addClass("comneror");
            $(".emergency_contact_phone").focus();
            newError = 1;
        }

        /*if(emergencyContactOne == ''){
            if(few =='')
                few = ".eNameOne";

            $(".emergency_contact_nameOne").addClass('comneror');
            $(".emergency_contact_nameOne").focus();
            newError = 1;
        }*/

        /*if(emergencyContactRelationOne == ''){
            if(few =='')
                few = ".eRelationOne";

            $(".emergency_contact_relationOne").addClass('comneror');
            $(".emergency_contact_relationOne").focus();
            newError = 1;
        }*/


        /*if(emergencyContactPhoneOne == ''){
            if(few =='')
                few = ".EmerPhoneOne";

            $(".emergency_contact_phoneOne").addClass("comneror");
            $(".emergency_contact_phoneOne").focus();
            newError = 1;
        }*/

        var bothParent = '<table class="m-v-10" width="100%" cellspacing="0" cellpadding="0" border="0">\
                                              <tbody>\
                                                <tr>\
                                                  <td width="8%">I (we)</td>\
                                                  <td width="32%"><input class="form-control" name="mother_full_name" value="'+ mFName + ' '+ mLName +'" type="text"></td>\
                                                  <td width="3%" align="center">&amp;</td>\
                                                  <td width="40%"><input class="form-control" name="father_full_name" value="'+ fFName + ' ' + fLName + '" type="text"></td>\
                                                  <td width="24%" align="center">Parents/Guardians of </td>\
                                                </tr>\
                                                <tr>\
                                                  <td colspan="2" class="p-t-10"><input class="form-control" name="child_full_name" value="'+ childFName + ' ' + childLName + '" type="text"></td>\
                                                  <td colspan="3" class="p-t-10">&nbsp; Authorize for emergency purposes only, a designated employee Of stem academy to transport the above</td>\
                                                </tr>\
                                              </tbody>\
                                            </table>';

        var singleParent = ''; 
        if(newError == 0){
            if(leavsWith == 1){
                $(".parentCls").text(mFName + ' '+ mLName + ','+ fFName + ' ' + fLName);
                $(".pfullName").val(mFName + ' '+ mLName + ','+ fFName + ' ' + fLName);
                $(".pfulNm").val(mFName + ' '+ mLName + ','+ fFName + ' ' + fLName);
                $(".parent_ful_nm").val(mFName + ' '+ mLName + ','+ fFName + ' ' + fLName);
                $(".parentsTable").html(bothParent);
            }else if(leavsWith == 2){
                singleParent = '<table class="m-v-10" width="100%" cellspacing="0" cellpadding="0" border="0">\
                                              <tbody>\
                                                <tr>\
                                                  <td width="1%">I</td>\
                                                  <td width="40%"><input class="form-control" name="parent_full_name" value="'+ mFName + ' '+ mLName +'" type="text"></td>\
                                                  <td width="15%" align="center">Parents/Guardians of </td>\
                                                  <td width="40%"><input class="form-control" name="child_full_name" value="'+ childFName + ' ' + childLName + '" type="text"></td>\
                                                </tr>\
                                                <tr>\
                                                 <td colspan="3" class="p-t-10">&nbsp; Authorize for emergency purposes only, a designated employee Of stem academy to transport the above</td>\
                                                </tr>\
                                              </tbody>\
                                            </table>';
                $(".parentCls").text(mFName + ' ' + mLName); 
                $(".pfullName").val(mFName + ' ' + mLName);
                $(".pfulNm").val(mFName + ' ' + mLName);
                $(".parent_ful_nm").val(mFName + ' ' + mLName);                          
                $(".parentsTable").html(singleParent);
            }else if(leavsWith == 3){
                singleParent = '<table class="m-v-10" width="100%" cellspacing="0" cellpadding="0" border="0">\
                                              <tbody>\
                                                <tr>\
                                                  <td width="1%">I</td>\
                                                  <td width="40%"><input class="form-control" name="father_full_name" value="'+ fFName + ' ' + fLName + '" type="text"></td>\
                                                  <td width="15%" align="center">Parents/Guardians of </td>\
                                                  <td width="40%"><input class="form-control" name="child_full_name" value="'+ childFName + ' ' + childLName + '" type="text"></td>\
                                                </tr>\
                                                <tr>\
                                                 <td colspan="3" class="p-t-10">&nbsp; Authorize for emergency purposes only, a designated employee Of stem academy to transport the above</td>\
                                                </tr>\
                                              </tbody>\
                                            </table>';
                $(".parentsTable").html(singleParent);
                $(".parentCls").text(fFName + ' ' + fLName);
                $(".pfullName").val(fFName + ' ' + fLName);
                $(".pfulNm").val(fFName + ' ' + fLName);
                $(".parent_ful_nm").val(fFName + ' ' + fLName);
            }else if(leavsWith == 4){
                singleParent = '<table class="m-v-10" width="100%" cellspacing="0" cellpadding="0" border="0">\
                                              <tbody>\
                                                <tr>\
                                                  <td width="1%">I</td>\
                                                  <td width="40%"><input class="form-control" name="other_full_name" value="'+ oFName + ' ' + oLName + '" type="text"></td>\
                                                  <td width="15%" align="center">Parents/Guardians of </td>\
                                                  <td width="40%"><input class="form-control" name="child_full_name" value="'+ childFName + ' ' + childLName + '" type="text"></td>\
                                                </tr>\
                                                <tr>\
                                                 <td colspan="3" class="p-t-10">&nbsp; Authorize for emergency purposes only, a designated employee Of stem academy to transport the above</td>\
                                                </tr>\
                                              </tbody>\
                                            </table>';
                $(".parentsTable").html(singleParent);
                $(".parentCls").text(oFName + ' ' + oLName);
                $(".pfullName").val(oFName + ' ' + oLName);
                $(".pfulNm").val(oFName + ' ' + oLName);
                $(".parent_ful_nm").val(oFName + ' ' + oLName);
            }

            $(".loader").css("display","block");
            if ($('.parentInformation').is(":visible")){
                current_fs = $('.parentInformation');
                next_fs = $('.medicalInformation');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }



            if(leavsWith == 1){
            var parentMotherInfo = {
                'mother_first_name': $('.mother_first_name').val(), 
                'mother_last_name': $('.mother_last_name').val(),  
                'mother_relation': $('.mother_relation').val(),
                'mother_street_name':$('.mother_street_name').val(),
                'mother_state_name': $('.mother_state_name').val(),
                'mother_city_name':$('.mother_city_name').val(),
                'mother_zip_code':$('.mother_zip_code').val(),
                'mother_cell_phone': $('.mother_cell_phone').val(),
                'mother_home_phone': $('.mother_home_phone').val(),
                'mother_email': $('.mother_email').val(),
                'mother_employer_name': $('.mother_employer_name').val(),
                'mother_employer_address': $('.mother_employer_address').val(),
                'mother_employer_phone': $('.mother_employer_phone').val(),
                'mother_employer_email': $('.mother_employer_email').val(),
            };

            var parentFatherInfo = {
                'father_first_name': $('.father_first_name').val(), 
                'father_last_name': $('.father_last_name').val(),  
                'relation': $('.relation').val(),
                'father_street_name':$('.father_street_name').val(),
                'father_state_name': $('.father_state_name').val(),
                'father_city_name':$('.father_city_name').val(),
                'father_zip_code':$('.father_zip_code').val(),
                'father_cell_phone': $('.father_cell_phone').val(),
                'father_home_phone': $('.father_home_phone').val(),
                'father_email': $('.father_email').val(),
                'father_employer_name': $('.father_employer_name').val(),
                'father_employer_address': $('.father_employer_address').val(),
                'father_employer_phone': $('.father_employer_phone').val(),
                'father_employer_email': $('.father_employer_email').val(),
            };
            }else if(leavsWith == 2){
                var parentMotherInfo = {
                'mother_first_name': $('.mother_first_name').val(), 
                'mother_last_name': $('.mother_last_name').val(),  
                'mother_relation': $('.mother_relation').val(),
                'mother_street_name':$('.mother_street_name').val(),
                'mother_state_name': $('.mother_state_name').val(),
                'mother_city_name':$('.mother_city_name').val(),
                'mother_zip_code':$('.mother_zip_code').val(),
                'mother_cell_phone': $('.mother_cell_phone').val(),
                'mother_home_phone': $('.mother_home_phone').val(),
                'mother_email': $('.mother_email').val(),
                'mother_employer_name': $('.mother_employer_name').val(),
                'mother_employer_address': $('.mother_employer_address').val(),
                'mother_employer_phone': $('.mother_employer_phone').val(),
                'mother_employer_email': $('.mother_employer_email').val(),
            };
            }else if(leavsWith == 3){
                var parentFatherInfo = {
                'father_first_name': $('.father_first_name').val(), 
                'father_last_name': $('.father_last_name').val(),  
                'relation': $('.relation').val(),
                'father_street_name':$('.father_street_name').val(),
                'father_state_name': $('.father_state_name').val(),
                'father_city_name':$('.father_city_name').val(),
                'father_zip_code':$('.father_zip_code').val(),
                'father_cell_phone': $('.father_cell_phone').val(),
                'father_home_phone': $('.father_home_phone').val(),
                'father_email': $('.father_email').val(),
                'father_employer_name': $('.father_employer_name').val(),
                'father_employer_address': $('.father_employer_address').val(),
                'father_employer_phone': $('.father_employer_phone').val(),
                'father_employer_email': $('.father_employer_email').val(),
            };
        }else if(leavsWith == 4){
            var parentOtherInfo = {
                'other_first_name': $('.other_first_name').val(), 
                'other_last_name': $('.other_last_name').val(),  
                'relation': $('.relation').val(),
                'other_street_name':$('.other_street_name').val(),
                'other_state_name': $('.other_state_name').val(),
                'other_city_name':$('.other_city_name').val(),
                'other_zip_code':$('.other_zip_code').val(),
                'other_cell_phone': $('.other_cell_phone').val(),
                'other_home_phone': $('.other_home_phone').val(),
                'other_email': $('.other_email').val(),
                'other_employer_name': $('.other_employer_name').val(),
                'other_employer_address': $('.other_employer_address').val(),
                'other_employer_phone': $('.other_employer_phone').val(),
                'other_employer_email': $('.other_employer_email').val(),
            };
        }

            var parentEmergencyContact = {
                'comnCName': [],
                'comnCRelation': [],
                'comnCPhone': [],
            };
            $(".comnCName").each(function(){
                parentEmergencyContact.comnCName.push($(this).val());
            });
            $(".comnCRelation").each(function(){
                parentEmergencyContact.comnCRelation.push($(this).val());
            });
            $(".comnCPhone").each(function(){
                parentEmergencyContact.comnCPhone.push($(this).val());
            });

                $.ajax({
                      method: "POST",
                      url: parentInfoUrl,
                      data: { 'parentMotherInfo':parentMotherInfo, 
                              'parentFatherInfo':parentFatherInfo, 
                              'parentOtherInfo':parentOtherInfo, 
                              'parentEmergencyContact':parentEmergencyContact,
                              'leavsWith':leavsWith,  
                              'prevChildInfoInput':prevChildInfoInput,
                              'currentTab':currentTab, 
                              "_token":parentInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         //console.log(data);
                         activLi.addClass("succesOr");
                         if(data.success == 1){
                         setTimeout(function() {
                            next_fs.show('slow'); 
                            current_fs.hide();
                            $('html, body').animate({
                                scrollTop: $(".medicalInformation").offset().top
                            }, 1000);
                        $(".loader").css("display","none");
                        }, 3000);
                         }
                    }
                });
        }
    });
}

$(".prevParentsInfo").click(function(){
    $(".prevChildInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.medicalInformation').is(":visible")){
        current_fs = $('.medicalInformation');
        next_fs = $('.parentInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $('#step-1 .nav-tabs a[tabnumber="3"]').parent().removeClass('active succesOr');
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".parentInformation").offset().top
    }, 1000);
});


$('input[type=radio][name=allergies]').change(function() {
    var allergies = $('input[name="allergies"]:checked').length;
    if(allergies == 0){
        $(".alerAct").parent().addClass('comneror');
        $(".allergies").focus();
        error = 1;
    }else{
        $(".alerAct").parent().removeClass('comneror');
    }
});

$('input[type=radio][name=epi_pen]').change(function() {
    var epiPen = $('input[name="epi_pen"]:checked').length;
    if(epiPen == false){
            if(fel =='')
                fel = ".alerEpi";
            $(".alerEpi").parent().addClass('comneror');
            $(".epi_pen").focus();
            error = 1;
        }else{
            $(".alerEpi").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=allergy_plan]').change(function() {
    var allergyPlan = $('input[name="allergy_plan"]:checked').length;
    if(allergyPlan == false){
            if(fel =='')
                fel = ".alerGPlan";
            $(".alerGPlan").parent().addClass('comneror');
            $(".allergy_plan").focus();
            error = 1;
        }else{
            $(".alerGPlan").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=physical_illness]').change(function() {
    var physicalIllness = $('input[name="physical_illness"]:checked').length;
    if(physicalIllness == false){
            if(fel =='')
                fel = ".phyIlns";
            $(".phyIlns").parent().addClass('comneror');
            $(".physical_illness").focus();
            error = 1;
        }else{
            $(".phyIlns").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=center_activities]').change(function() {
    var centerActivities = $('input[name="center_activities"]:checked').length;
    if(centerActivities == false){
            if(fel =='')
                fel = ".activityS";
            $(".activityS").parent().addClass('comneror');
            $(".center_activities").focus();
            error = 1;
        }else{
            $(".activityS").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=physicians_care]').change(function() {
    var physiciansCare = $('input[name="physicians_care"]:checked').length;
    if(physiciansCare == false){
            if(fel =='')
                fel = ".phyCares";
            $(".phyCares").parent().addClass('comneror');
            $(".physicians_care").focus();
            error = 1;
        }else{
            $(".phyCares").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=prescribed_medications]').change(function() {
    var prescribedMedications = $('input[name="prescribed_medications"]:checked').length;
    if(prescribedMedications == false){
            if(fel =='')
                fel = ".presCribMediCn";
            $(".presCribMediCn").parent().addClass('comneror');
            $(".prescribed_medications").focus();
            error = 1;
        }else{
            $(".presCribMediCn").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=special_devices]').change(function() {
    var specialDevices = $('input[name="special_devices"]:checked').length;
    if(specialDevices == false){
            if(fel =='')
                fel = ".speClDevics";
            $(".speClDevics").parent().addClass('comneror');
            $(".special_devices").focus();
            error = 1;
        }else{
            $(".speClDevics").parent().removeClass('comneror');
        }
});

$('input[type=radio][name=group_care]').change(function() {
    var groupCare = $('input[name="group_care"]:checked').length;
    if(groupCare == false){
            if(fel =='')
                fel = ".gCares";
            $(".gCares").parent().addClass('comneror');
            $(".group_care").focus();
            error = 1;
        }else{
            $(".gCares").parent().removeClass('comneror');
        }
});


$('.child_genderF').change(function() {
        if ($(this,':checked')) {
            $('.release_child_genderF').prop('checked', true);
            $('.release_child_genderM').prop('checked', false);
        }
    });
    $('.child_genderM').change(function() {
        if ($(this,':checked')) {
            $('.release_child_genderM').prop('checked', true);
            $('.release_child_genderF').prop('checked', false);
        }
    });


function medicalInformation(){

    $(".releaseInfoNxt").click(function(e){
        var error = 0;
        var fel = '';
        var prevMedicalInfoInput = $(".prevMedicalInfoInput").val();
        var acceptMedicalTret = $('input[name="accept_medical_treatment"]').prop('checked');
        var allergies = $('input[name="allergies"]:checked').length;

        var epiPen = $('input[name="epi_pen"]:checked').length;
        var allergyPlan = $('input[name="allergy_plan"]:checked').length;
        var physicalIllness = $('input[name="physical_illness"]:checked').length;
        var centerActivities = $('input[name="center_activities"]:checked').length;

        var physiciansCare = $('input[name="physicians_care"]:checked').length;
        var prescribedMedications = $('input[name="prescribed_medications"]:checked').length;
        var specialDevices = $('input[name="special_devices"]:checked').length;
        var groupCare = $('input[name="group_care"]:checked').length;

        var doctorName = $(".doctor_name").val();
        var doctorOfficePhone = $(".doctor_office_phone").val();
        var doctorOfficeEmail = $(".doctor_office_email").val();
        var doctorOfficeFax = $(".doctor_office_fax").val();
        var dentistFullName = $(".dentist_full_name").val();
        var dentistOfficePhone = $(".dentist_office_phone").val();
        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");

        var childFName = $(".child_first_name").val();
        var childLName = $(".child_last_name").val();
        var dob = $(".child_dob").val();

        if(doctorName == ''){
            if(fel =='')
                fel = ".dName";

            $(".doctor_name").addClass("comneror");
            $(".doctor_name").focus();
            error = 1;
        }

        if(doctorOfficePhone == ''){
            if(fel =='')
                fel = ".dOPhone";

            $(".doctor_office_phone").addClass("comneror");
            $(".doctor_office_phone").focus();
            error = 1;
        }

        if(doctorOfficeEmail != ''){
                if(!validateEmail(doctorOfficeEmail)){
                    if(fel =='')
                        fel = ".docMail";

                    $(".doctor_office_email").addClass("comneror");
                    $(".doctor_office_email").focus();
                    error = 1;
                }
            }else{
                if(fel =='')
                        fel = ".docMail";

                $(".doctor_office_email").addClass("comneror");
                $(".doctor_office_email").focus();
                error = 1; 
            }

        if(doctorOfficeFax == ''){
            if(fel =='')
                fel = ".dOficeFx";

            $(".doctor_office_fax").addClass("comneror");
            $(".doctor_office_fax").focus();
            error = 1;
        }    

        if(dentistFullName == ''){
            if(fel =='')
                fel = ".dentistFulNm";

            $(".dentist_full_name").addClass("comneror");
            $(".dentist_full_name").focus();
            error = 1;
        }

        if(dentistOfficePhone == ''){
            if(fel =='')
                fel = ".dentistPhn";

            $(".dentist_office_phone").addClass("comneror");
            $(".dentist_office_phone").focus();
            error = 1;
        }

        if(acceptMedicalTret == false){
            if(fel =='')
                fel = ".medAct";

            $(".medicalAcept").addClass('comneror');
            $(".medicalAcept").focus();
            error = 1;
        }else{
            $(".medicalAcept").removeClass('comneror');
        }

        if(allergies == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".alerAct").parent().addClass('comneror');
            $(".allergies").focus();
            error = 1;
        }else{
            $(".alerAct").parent().removeClass('comneror');
        }

        if(epiPen == false){
            if(fel =='')
                fel = ".alerEpi";
            $(".alerEpi").parent().addClass('comneror');
            $(".epi_pen").focus();
            error = 1;
        }else{
            $(".alerEpi").parent().removeClass('comneror');
        }

        if(allergyPlan == false){
            if(fel =='')
                fel = ".alerGPlan";
            $(".alerGPlan").parent().addClass('comneror');
            $(".allergy_plan").focus();
            error = 1;
        }else{
            $(".alerGPlan").parent().removeClass('comneror');
        }

        if(physicalIllness == false){
            if(fel =='')
                fel = ".phyIlns";
            $(".phyIlns").parent().addClass('comneror');
            $(".physical_illness").focus();
            error = 1;
        }else{
            $(".phyIlns").parent().removeClass('comneror');
        }

        if(centerActivities == false){
            if(fel =='')
                fel = ".activityS";
            $(".activityS").parent().addClass('comneror');
            $(".center_activities").focus();
            error = 1;
        }else{
            $(".activityS").parent().removeClass('comneror');
        }

        if(physiciansCare == false){
            if(fel =='')
                fel = ".phyCares";
            $(".phyCares").parent().addClass('comneror');
            $(".physicians_care").focus();
            error = 1;
        }else{
            $(".phyCares").parent().removeClass('comneror');
        }

        if(prescribedMedications == false){
            if(fel =='')
                fel = ".presCribMediCn";
            $(".presCribMediCn").parent().addClass('comneror');
            $(".prescribed_medications").focus();
            error = 1;
        }else{
            $(".presCribMediCn").parent().removeClass('comneror');
        }

        if(specialDevices == false){
            if(fel =='')
                fel = ".speClDevics";
            $(".speClDevics").parent().addClass('comneror');
            $(".special_devices").focus();
            error = 1;
        }else{
            $(".speClDevics").parent().removeClass('comneror');
        }

        if(groupCare == false){
            if(fel =='')
                fel = ".gCares";
            $(".gCares").parent().addClass('comneror');
            $(".group_care").focus();
            error = 1;
        }else{
            $(".gCares").parent().removeClass('comneror');
        }

        if(error == 0){
        $(".child_names").val(childFName + ' ' + childLName);
        $(".print_child_name").val(childFName + ' ' + childLName);
        $(".child_dobs").val(dob);
           $(".loader").css("display","block");
            if ($('.medicalInformation').is(":visible")){
                current_fs = $('.medicalInformation');
                next_fs = $('.releaseInfo');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }


            var medicalInfo = {
                'allergies_to_food': $('.allergies_to_food').val(), 
                'allergies': $('input[name="allergies"]:checked').val(),  
                'epi_pen': $('input[name="epi_pen"]:checked').val(),
                'allergy_plan':$('input[name="allergy_plan"]:checked').val(),
                'physical_illness': $('input[name="physical_illness"]:checked').val(),
                'center_activities':$('input[name="center_activities"]:checked').val(),
                'physicians_care': $('input[name="physicians_care"]:checked').val(),
                'prescribed_medications': $('input[name="prescribed_medications"]:checked').val(),
                'special_devices': $('input[name="special_devices"]:checked').val(),
                'group_care': $('input[name="group_care"]:checked').val(),
                'group_care_incident': $('.group_care_incident').val(),
                'doctor_name': $('.doctor_name').val(),
                'doctor_office_phone': $('.doctor_office_phone').val(),
                'doctor_office_email': $('.doctor_office_email').val(),
                'doctor_office_fax': $('.doctor_office_fax').val(),
                'dentist_full_name': $('.dentist_full_name').val(),
                'dentist_office_phone': $('.dentist_office_phone').val(),
            };

            $.ajax({
                      method: "POST",
                      url: medicalInfoUrl,
                      data: { 'medicalInfo':medicalInfo, 
                              'currentTab':currentTab, 
                              'prevMedicalInfoInput':prevMedicalInfoInput,
                              "_token":medicalInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                            activLi.addClass("succesOr");
                         setTimeout(function() {
                            next_fs.show(); 
                            $(".loader").css("display","none");
                            current_fs.hide();
                            $('html, body').animate({
                                scrollTop: $(".releaseInfo").offset().top
                            }, 1000); 
                        $(".loader").css("display","none");
                        }, 3000);
                         }
                    }
                });
            }
    });
}

$(".prevMedicalInfo").click(function(){
    $(".prevMedicalInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.releaseInfo').is(":visible")){
        current_fs = $('.releaseInfo');
        next_fs = $('.medicalInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $('#step-1 .nav-tabs a[tabnumber="4"]').parent().removeClass('active succesOr');
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".medicalInformation").offset().top
    }, 1000);
});


$('input.transport_from').bind('keyup', function(e){
        $(".transport_from").removeClass('comneror');
});
$('input.transport_to').bind('keyup', function(e){
        $(".transport_to").removeClass('comneror');
});

$('input.days_indicated').bind('keyup', function(e){
        $(".days_indicated").removeClass('comneror');
});


$('input[type=radio][name=private_permission]').change(function() {
    var privatePermission = $('input[name="private_permission"]:checked').length;
    if(privatePermission == 0){
        $(".pPer").addClass('comneror');
        $(".private_permission").focus();
        error = 1;
    }else{
        $(".pPer").removeClass('comneror');
    }
});

function releaseAuthorization(){
    $(".waiverNxt").click(function(){
        var error = 0;
        var transportFrom = $(".transport_from").val();
        var transportTo = $(".transport_to").val();
        var daysIndicated = $(".days_indicated").val();
        var privatePermission = $('input[name="private_permission"]:checked').length;
        var acceptMedicalRelease = $('input[name="accept_parent_release"]').prop('checked');
        var fel = '';
        var currentTab = $("li.active a").attr('tabnumber');
        var prevReleaseInfoInput = $(".prevReleaseInfoInput").val();
        var activLi = $("li.active");

        /*if(transportFrom == ''){
            if(fel =='')
                fel = ".tFrom";

            $(".transport_from").addClass("comneror");
            $(".transport_from").focus();
            error = 1;
        }*/

        if(transportTo == ''){
            if(fel =='')
                fel = ".tTo";

            $(".transport_to").addClass("comneror");
            $(".transport_to").focus();
            error = 1;
        }

        if(daysIndicated == ''){
            if(fel =='')
                fel = ".daysIndict";

            $(".days_indicated").addClass("comneror");
            $(".days_indicated").focus();
            error = 1;
        }

        if(privatePermission == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".pPer").addClass('comneror');
            $(".private_permission").focus();
            error = 1;
        }else{
            $(".pPer").removeClass('comneror');
        }

        if(acceptMedicalRelease == false){
            if(fel =='')
                fel = ".acks";

            $(".acknowledges").addClass('comneror');
            $(".acknowledges").focus();
            error = 1;
        }else{
            $(".acknowledges").removeClass('comneror');
        }

        if(error == 0){
           $(".loader").css("display","block");
            if ($('.releaseInfo').is(":visible")){
                current_fs = $('.releaseInfo');
                next_fs = $('.waiverInfo');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }

            var schoolInfo = {
                'transport_from': $('.transport_from').val(), 
                'transport_to': $('.transport_to').val(), 
                'days_indicated': $('.days_indicated').val(),
                'private_permission':$('input[name="private_permission"]:checked').val(),
            };

            $.ajax({
                      method: "POST",
                      url: schoolInfoUrl,
                      data: { 'schoolInfo':schoolInfo, 
                              'currentTab':currentTab, 
                              'prevReleaseInfoInput':prevReleaseInfoInput,
                              "_token":schoolInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                            activLi.addClass("succesOr");
                         setTimeout(function() {
                            next_fs.show(); 
                            $(".loader").css("display","none");
                            current_fs.hide();
                            $('html, body').animate({
                                scrollTop: $(".waiverInfo").offset().top
                            }, 1000); 
                        $(".loader").css("display","none");
                        }, 3000);
                        }
                    }
                });
        }
    });
}

function waiverAndRelease(){

    $('input[name="custody"]').on("change", function(){
        var dropZone = $('input[name="custody"]:checked').val();
        if(dropZone == 'Y'){
            $("#childDocs").show('slow');
        }else if(dropZone == 'N'){
            $("#childDocs").hide('slow');
        }
    });

    $('input[type=radio][name=custody]').change(function() {
        var cust = $('input[name="custody"]:checked').length;
        if(cust == 0){
            $(".custLabel").addClass('comneror');
            $(".custod").focus();
            error = 1;
        }else{
            $(".custLabel").removeClass('comneror');
        }
    });

    $('.authorize_phone').on('keyup',function(){
       var numCount = $(this).val().replace(/\s/g, '').length;
       if(numCount <13){
            $(".authorize_phone").addClass("comneror");
       }else{
            $(".authorize_phone").removeClass("comneror");
       }
    });

    $('.authorize_phone_one').on('keyup',function(){
       var numCount = $(this).val().replace(/\s/g, '').length;
       if(numCount <13){
            $(".authorize_phone_one").addClass("comneror");
       }else{
            $(".authorize_phone_one").removeClass("comneror");
       }
    });

    $(".finalStepOneNxt").click(function(){
        var error = 0;
        var stepOneAccept = $('input[name="step_one_accept"]').prop('checked');
        var custody = $('input[name="custody"]:checked').length;
        var authorizeName = $(".authorize_name").val();
        var authorizeNameOne = $(".authorize_name_one").val();
        var authorizeRelation = $(".authorize_relation").val();
        var authorizeRelationOne = $(".authorize_relation_one").val();
        var authorizeAddress = $(".authorize_address").val();
        var authorizeAddressOne = $(".authorize_address_one").val();
        var authorizePhone = $(".authorize_phone").val();
        var authorizePhoneOne = $(".authorize_phone_one").val();
        var custodyVal = $('input[name="custody"]:checked').val();
        var prevWaiverInfoInput = $(".prevWaiverInfoInput").val();
        var prevPageWaiverInfoInput =$(".prevPageWaiverInfoInput").val();

        var fel = '';
        if(stepOneAccept == false){
            if(fel =='')
                fel = ".poly";

            $(".policy").addClass('comneror');
            $(".policy").focus();
            error = 1;
        }else{
            $(".policy").removeClass('comneror');
        }

        if(custody == 0){
            if(fel =='')
                fel = ".custL";
            $(".custLabel").addClass('comneror');
            $(".custod").focus();
            error = 1;
        }else{
            $(".custLabel").removeClass('comneror');
        }

        if(authorizeName ==''){
            if(fel =='')
                fel = ".cAuthName";
            
            $(".authorize_name").addClass("comneror");
            $(".authorize_name").focus();
            error = 1;
        }

        /*if(authorizeNameOne ==''){
            if(fel =='')
                fel = ".cAuthName";
            
            $(".authorize_name_one").addClass("comneror");
            $(".authorize_name_one").focus();
            error = 1;
        }*/

        if(authorizeRelation ==''){
            if(fel =='')
                fel = ".authRelation";
            
            $(".authorize_relation").addClass("comneror");
            $(".authorize_relation").focus();
            error = 1;
        }

        /*if(authorizeRelationOne ==''){
            if(fel =='')
                fel = ".authRelation";
            
            $(".authorize_relation_one").addClass("comneror");
            $(".authorize_relation_one").focus();
            error = 1;
        }*/

        if(authorizeAddress ==''){
            if(fel =='')
                fel = ".authAddr";
            
            $(".authorize_address").addClass("comneror");
            $(".authorize_address").focus();
            error = 1;
        }

        /*if(authorizeAddressOne ==''){
            if(fel =='')
                fel = ".authAddr";
            
            $(".authorize_address_one").addClass("comneror");
            $(".authorize_address_one").focus();
            error = 1;
        }*/

        if(authorizePhone == ''){
            if(fel =='')
                fel = ".authPhone";

            $(".authorize_phone").addClass("comneror");
            $(".authorize_phone").focus();
            error = 1;
        }
        /*if(authorizePhoneOne == ''){
            if(fel =='')
                fel = ".authPhone";

            $(".authorize_phone_one").addClass("comneror");
            $(".authorize_phone_one").focus();
            error = 1;
        }*/
        if(error == 0){
            $(".loader").css("display","block");



            var authContact = {
                'comnAName': [],
                'comnARelation': [],
                'comnAAddress': [],
                'comnAPhone': [],
            };
            $(".comnAName").each(function(){
                authContact.comnAName.push($(this).val());
            });
            $(".comnARelation").each(function(){
                authContact.comnARelation.push($(this).val());
            });
            $(".comnAAddress").each(function(){
                authContact.comnAAddress.push($(this).val());
            });
            $(".comnAPhone").each(function(){
                authContact.comnAPhone.push($(this).val());
            });


            $.ajax({
                      method: "POST",
                      url: authInfoUrl,
                      data: { 'authContact':authContact,
                              'custodyVal':custodyVal,
                              'prevWaiverInfoInput':prevWaiverInfoInput, 
                              'prevPageWaiverInfoInput':prevPageWaiverInfoInput,  
                              'imcopletePage': 1,
                              "_token":authInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                         setTimeout(function() {
                            $(".secCls").addClass("btn-primary");
                            //$(".fstCls").removeClass("btn-primary");
                            $("#step-1").removeClass('pleaseShow').css("display", "none");
                            $("#step-2").removeClass('donotSHow').css("display", "block");
                            $('.nav-tabs li a[tabnumber="6"]').parent().addClass('active');
                            $("#home").addClass('in active');
                                $('html, body').animate({
                                scrollTop: $(".policyDCFInfo").offset().top
                            }, 1000);
                            $(".loader").css("display","none");    
                        }, 3000);
                          
                         }
                    }
                });
        }

    });
}

$(".prevReleaseAuth").click(function(){
    $(".prevReleaseInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.waiverInfo').is(":visible")){
        current_fs = $('.waiverInfo');
        next_fs = $('.releaseInfo');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $('#step-1 .nav-tabs a[tabnumber="5"]').parent().removeClass('active succesOr');
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".releaseInfo").offset().top
    }, 1000);
});
var next_fs = current_fs = '';
$(".preTabOne").click(function(){
    $(".prevWaiverInfoInput").val('1');
    $(".prevPageWaiverInfoInput").val('1');
    $(".loader").css("display","block");
    //$(".secCls").removeClass("btn-primary");
    $(".fstCls").addClass("btn-primary");
    //$("#step-1").css("display", "block");
    //$("#step-2").css("display", "none");
    $("#step-1").removeClass('donotSHow').css("display", "block");
    $("#step-2").removeClass('pleaseShow').css("display", "none");
    $("#step-2 .nav-tabs li").removeClass('active');
    $("#step-2 .tab-pane").removeClass('in active');
    //if ($('.childInformation').is(":visible")){
        current_fs = $('.childInformation');
        next_fs = $('.waiverInfo');
        var nextId = $(this).parents('.tab-pane').next().attr("id");

        $('[href=#item5]').tab('show');
        $(".waiverInfo").addClass("in active");
        $(".childInformation").addClass("in active");
    //}
    if(next_fs != '')
        next_fs.show(); 
    $(".loader").css("display","none");
    if(current_fs != '')
        current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".waiverInfo").offset().top
    }, 1000);
    $(".loader").css("display","none");
});


function policyDCF(){
    $(".policyAgremntNxt").click(function(){
        var error = 0;
        var acceptPolicyDCF = $('input[name="accept_dcf"]').prop('checked');
        var activLi = $("li.active");

        var fel = '';
        if(acceptPolicyDCF == false){
            if(fel =='')
                fel = ".acDcf";

            $(".acknowledge4").addClass('comneror');
            $(".acknowledge4").focus();
            error = 1;
        }else{
            $(".acknowledge4").removeClass('comneror');
        }

        if(error == 0){
               $(".loader").css("display","block");
               activLi.addClass("succesOr");
                if ($('.policyDCFInfo').is(":visible")){
                    current_fs = $('.policyDCFInfo');
                    next_fs = $('.policyAggrementInfo');
                    var nextId = $(this).parents('.tab-pane').next().attr("id");
                    $('[href=#'+nextId+']').tab('show');
                }

                $.ajax({
                      method: "POST",
                      url: policyDcfUrl,
                      data: { 'tabNumber':'6',   
                              "_token":policyToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                         setTimeout(function() {
                           next_fs.show(); 
                                current_fs.hide();
                                $('html, body').animate({
                                    scrollTop: $(".policyAggrementInfo").offset().top
                                }, 1000); 
                                $(".loader").css("display","none");
                        }, 3000); 
                      }
                    }
                });
        }

    });
}

$(".prvPolicyDcf").click(function(){
    $(".loader").css("display","block");
    if ($('.policyAggrementInfo').is(":visible")){
        current_fs = $('.policyAggrementInfo');
        next_fs = $('.policyDCFInfo');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $('#step-2 .nav-tabs a[tabnumber="7"]').parent().removeClass('active succesOr');
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".policyDCFInfo").offset().top
    }, 1000);
});

function policyAggrement(){
   $(".photoConcentNxt").click(function(){
    var error = 0;
    var acceptPolicyAggrement = $('input[name="policy_acpt"]').prop('checked');
    var fel = '';
    var activLi = $("li.active");
        if(acceptPolicyAggrement == false){
            if(fel =='')
                fel = ".policyAct";

            $(".policies2").addClass('comneror');
            $(".policies2").focus();
            error = 1;
        }else{
            $(".policies2").removeClass('comneror');
        }

    if(error == 0){
        $(".loader").css("display","block");
        activLi.addClass("succesOr");
        if ($('.policyAggrementInfo').is(":visible")){
            current_fs = $('.policyAggrementInfo');
            next_fs = $('#menu2');
            var nextId = $(this).parents('.tab-pane').next().attr("id");
            $('[href=#'+nextId+']').tab('show');
        }

        $.ajax({
              method: "POST",
              url: policyAggreeUrl,
              data: { 'tabNumber':'7',   
                      "_token":policyAgreeToken,
                  },
              dataType:"json",
              success: function(data) {
                 if(data.success == 1){
                 setTimeout(function() {
                   next_fs.show(); 
                    $(".loader").css("display","none");
                    current_fs.hide();
                    $('html, body').animate({
                        scrollTop: $("#menu2").offset().top
                    }, 1000); 
                }, 3000); 
              }
            }
        });
    }    

    }); 
}

function displayErrors(errorMsgTerms = '', errorCls = ''){
      var errorTxt = errorMsgTerms;
      $(errorCls).text(errorTxt);
      //$(this).closest('div').find('.errorTxt').text(errorTxt);
}


function childConsent(){

    $('input[name="child_consent"]').on("change", function(){
        var childConsentLen = $('input[name="child_consent"]:checked').length;
        if(childConsentLen == 0){
            $(".common_c_concen").addClass('comneror');
            $(".child_consent").focus();
            error = 1;
        }else{
            $(".common_c_concen").removeClass('comneror');
        }


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

    $(".alergyNxt").click(function(){
        var error = 0;
        var fel = '';
        var photoConcent = $('input[name="accept_photo_concent"]').prop('checked');
        var activLi = $("li.active");
        var currentTab = $("li.active a").attr('tabnumber');
        var prevChildImgInfoInput = $(".prevChildImgInfoInput").val();
        var prevPagePhotoInfo = $(".prevPagePhotoInfo").val();
        if($('input[name=child_consent]:checked').length==0){
            if(fel =='')
                fel = ".cConcen";

            $(".common_c_concen").addClass("comneror");
            $(".common_c_concen").focus();
            error = 1;
        }

        if(photoConcent == false){
            if(fel =='')
                fel = ".pConcen";

            $(".acknowledge5").addClass('comneror');
            $(".acknowledge5").focus();
            error = 1;
        }else{
            $(".acknowledge5").removeClass('comneror');
        }

        var childConsents = $('input[name=child_consent]:checked').val();
        if(childConsents == 'L'){
            var consentLimitation = $(".consent_limitation").val();
            if(consentLimitation == ''){
                if(fel =='')
                fel = ".pConcen";

            $(".consent_limitation").addClass('comneror');
            $(".consent_limitation").focus();
                error = 1;
            }
        }


        var editImg = $(".editImg").val();

        if(editImg == 0){
            if(document.getElementById('childImg').files.length == 0){
              displayErrors("Please select photo first.", ".eroImg");
              $(".eroImg").css("display", "block");
              return false;
            }
        }


        if(error == 0){
            $(".loader").css("display","block");
            if ($('#menu2').is(":visible")){
                current_fs = $('#menu2');
                next_fs = $('#menu3');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }


            var photoInfo = {
                'child_names': $('.child_names').val(), 
                'cGrade': $('.cGrade').val(), 
                'photoAge': $('.photoAge').val(),
                'childGen':$('input[name="childGen"]:checked').val(),
                'child_consent':$('input[name="child_consent"]:checked').val(),
                'consent_limitation': $(".consent_limitation").val(),
            };


            $.ajax({
                  method: "POST",
                  url: photoInfoUrl,
                  data: { 'photoInfo':photoInfo, 
                          'currentTab':currentTab, 
                          'prevChildImgInfoInput':prevChildImgInfoInput,
                          'prevPagePhotoInfo':prevPagePhotoInfo,
                          "_token":photoInfoToken,
                      },
                  dataType:"json",
                  success: function(data) {
                     if(data.success == 1){
                        activLi.addClass("succesOr");
                     setTimeout(function() {
                        next_fs.show(); 
                        current_fs.hide();
                        $('html, body').animate({
                            scrollTop: $("#menu3").offset().top
                        }, 1000); 
                    $(".loader").css("display","none");
                    }, 3000);
                    }
                }
            });
        }
    });
}


$(".prevPolycy").click(function(){
    $(".loader").css("display","block");
    if ($('#menu2').is(":visible")){
        current_fs = $('#menu2');
        next_fs = $('#menu1');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $("#menu1").offset().top
    }, 1000);
});

$(".prevPhoto").click(function(){
    $(".prevChildImgInfoInput").val('1');
    $(".prevPagePhotoInfo").val('1');
    $(".loader").css("display","block");
    if ($('#menu3').is(":visible")){
        current_fs = $('#menu3');
        next_fs = $('#menu2');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $("#menu2").offset().top
    }, 1000);
});

function radioOnchange(btnName='',AdCls = '', focusCls = ''){

    $('input[type=radio][name="'+ btnName +'"]').change(function() {
        var alergy_chk = $('input[name="'+ btnName +'"]:checked').length;
        if(alergy_chk == 0){
            $(AdCls).addClass('comneror');
            $(focusCls).focus();
            error = 1;
        }else{
            $(AdCls).removeClass('comneror');
        }
    });
}

function alergyAlert(){

    radioOnchange("alergy_chk",".al1",".alergy_chk");
    radioOnchange("child_alergy",".al4",".child_alergy");
    radioOnchange("epinephrine",".al6",".epinephrine");
    radioOnchange("benadryl",".al8",".benadryl");
    radioOnchange("asthma",".radio4",".asthma");
    radioOnchange("supplied_with",".al10",".supplied_with");
    radioOnchange("inhaler",".al11",".inhaler");
    radioOnchange("asthma_action_plan",".al14",".asthma_action_plan");

    $(".nxtTransportation").click(function(){
        var error = 0;
        var fel = '';
        var alergyChk = $('input[name="alergy_chk"]:checked').length;
        var allergyAcpt = $('input[name="allergy_acpt"]').prop('checked');
        var child_alergy = $('input[name="child_alergy"]:checked').length;
        var epinephrine = $('input[name="epinephrine"]:checked').length;
        var benadryl = $('input[name="benadryl"]:checked').length;
        var asthma = $('input[name="asthma"]:checked').length;
        var suppliedWith = $('input[name="supplied_with"]:checked').length;
        var inhaler = $('input[name="inhaler"]:checked').length;
        var asthmaPlan = $('input[name="asthma_action_plan"]:checked').length;
        var currentTab = $("li.active a").attr('tabnumber');
        var prevAlergyAlrtInput = $(".prevAlergyAlrtInput").val();
        var prevPageAlergyInfoInput = $(".prevPageAlergyInfoInput").val();
        var activLi = $("li.active");

        if(alergyChk == 0){
            if(fel =='')
                fel = ".aChk";

            $(".al1").addClass('comneror');
            $(".alergy_chk").focus();
            error = 1;
        }else{
            $(".al1").removeClass('comneror');
        }

        if(allergyAcpt == false){
            if(fel =='')
                fel = ".acAcpt";

            $(".acknowledge15").addClass('comneror');
            $(".acknowledge15").focus();
            error = 1;
        }else{
            $(".acknowledge15").removeClass('comneror');
        }

        if(child_alergy == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al4").addClass('comneror');
            $(".child_alergy").focus();
            error = 1;
        }else{
            $(".al4").removeClass('comneror');
        }

        if(epinephrine == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al6").addClass('comneror');
            $(".epinephrine").focus();
            error = 1;
        }else{
            $(".al6").removeClass('comneror');
        }

        if(benadryl == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al8").addClass('comneror');
            $(".benadryl").focus();
            error = 1;
        }else{
            $(".al8").removeClass('comneror');
        }

        if(asthma == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".radio4").addClass('comneror');
            $(".asthma").focus();
            error = 1;
        }else{
            $(".radio4").removeClass('comneror');
        }

        if(suppliedWith == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al10").addClass('comneror');
            $(".supplied_with").focus();
            error = 1;
        }else{
            $(".al10").removeClass('comneror');
        }

        if(inhaler == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al11").addClass('comneror');
            $(".inhaler").focus();
            error = 1;
        }else{
            $(".al11").removeClass('comneror');
        }
        if(asthmaPlan == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al14").addClass('comneror');
            $(".asthma_action_plan").focus();
            error = 1;
        }else{
            $(".al14").removeClass('comneror');
        }
        if(error == 0){
            $(".loader").css("display","block");
            if ($('#menu3').is(":visible")){
                current_fs = $('#menu3');
                next_fs = $('#transportation');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }

            var alergyInfo = {
                'alergy_chk':$('input[name="alergy_chk"]:checked').val(),
                'allergy_content': $('.allergy_content').val(), 
                'child_alergy': $('input[name="child_alergy"]:checked').val(),
                'epinephrine': $('input[name="epinephrine"]:checked').val(),
                'benadryl':$('input[name="benadryl"]:checked').val(),
                'asthma': $('input[name="asthma"]:checked').val(),
                'supplied_with': $('input[name="supplied_with"]:checked').val(),
                'inhaler': $('input[name="inhaler"]:checked').val(),
                'asthma_action_plan':$('input[name="asthma_action_plan"]:checked').val(),
            };


            $.ajax({
                  method: "POST",
                  url: alergyInfoUrl,
                  data: { 'alergyInfo':alergyInfo, 
                          'currentTab':currentTab,
                          'prevAlergyAlrtInput':prevAlergyAlrtInput,
                          'prevPageAlergyInfoInput':prevPageAlergyInfoInput, 
                          "_token":alergyInfoToken,
                      },
                  dataType:"json",
                  success: function(data) {
                     if(data.success == 1){
                        activLi.addClass("succesOr");
                     setTimeout(function() {
                        next_fs.show(); 
                        current_fs.hide();
                        $('.nav-tabs li a[tabnumber="9"]').parent().addClass('active');
                        $('html, body').animate({
                            scrollTop: $("#transportation").offset().top
                        }, 1000); 
                    $(".loader").css("display","none");
                    }, 3000);
                    }
                }
            });
        }
    });
}

$(".prevAlergyAlrt").click(function(){
    $(".loader").css("display","block");
    $(".prevAlergyAlrtInput").val('1');
    $(".prevPageAlergyInfoInput").val('1');
    if ($('#transportation').is(":visible")){
        current_fs = $('#transportation');
        next_fs = $('#menu3');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $("#menu3").offset().top
    }, 1000);
});



$(".prevTransport").click(function(){
    $(".loader").css("display","block");
    $(".prevChildTransportations").val('1');
    if ($('#acknowledgement').is(":visible")){
        current_fs = $('#acknowledgement');
        next_fs = $('#transportation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $("#transportation").offset().top
    }, 1000);
});



function receiptInfo(){

    $(".nxtReceiptInfo").click(function(){
        var error = 0;
        var fel = '';
        var travelBy = $(".travel_by").val();
        var acceptTransportation = $('input[name="accept_transportation"]').prop('checked');
        var currentTab = $("li.active a").attr('tabnumber');
        var prevChildTransportations = $(".prevChildTransportations").val();
        if(travelBy == ''){
            if(fel =='')
                fel = ".tBy";

            $(".travel_by").addClass("comneror");
            $(".travel_by").focus();
            error = 1;
        }

        if(acceptTransportation == false){
            if(fel =='')
                fel = ".actport";

            $(".acknowledge7").addClass('comneror');
            $(".acknowledge7").focus();
            error = 1;
        }else{
            $(".acknowledge7").removeClass('comneror');
        }

        if(error == 0){
            $(".loader").css("display","block");
            if ($('#transportation').is(":visible")){
                current_fs = $('#transportation');
                next_fs = $('#acknowledgement');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }


            var travelInfo = {
                'child_names': $('.child_names').val(),
                'travelBy': travelBy,
                'prevChildTransportations':prevChildTransportations, 
            };


            $.ajax({
                  method: "POST",
                  url: travelInfoUrl,
                  data: { 'travelInfo':travelInfo, 
                          'currentTab':currentTab, 
                          "_token":travelInfoToken,
                      },
                  dataType:"json",
                  success: function(data) {
                     if(data.success == 1){
                     setTimeout(function() {
                        $('.nav-tabs li a[tabnumber="10"]').parent().addClass('active');
                        next_fs.show(); 
                        current_fs.hide();
                        $('html, body').animate({
                            scrollTop: $("#acknowledgement").offset().top
                        }, 1000); 
                    $(".loader").css("display","none");
                    }, 3000);
                    }
                }
            });
        }
    });
}