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
   //stringOnly(".authorize_name");
   //stringOnly(".authorize_name_one");

   //stringOnly(".authorize_relation");
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
   hasErrorCls(".acpt_camp", ".actCampAct");
   hasErrorCls(".acptTwo", ".camp2");
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

    $(".childInfoNxt").click(function(){
        //e.preventDefault();
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
        var tshirt = $(".tshirt").val();
        var fel = '';
        var currentTab = $("li.active a").attr('tabnumber');
        var prevChildInfoInput = $(".prevChildInfoInput").val();
        var activLi = $("li.active");

        $(".cRelation").val(childRelation);

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


        if(tshirt == ''){
            if(fel =='')
                fel = ".tshirts";

            $(".tshirt").addClass("comneror");
            $(".tshirt").focus();
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
                'childCareBefore': childCareBefore,
                'tshirt': tshirt,
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
                      url: childSummerInfoUrl,
                      data: { 'childInfo':childInfo,
                              'childPrimaryInfo':childPrimaryInfo,  
                              'currentTab':currentTab, 
                              'prevChildInfoInput':prevChildInfoInput,
                              "_token":childSummerInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         //console.log(data);
                         if(data.success == 1){
                            activLi.addClass("succesOr");
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
    $(".prevChildInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.parentInformation').is(":visible")){
        current_fs = $('.parentInformation');
        next_fs = $('.childInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
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

        var mFName = $(".mother_first_name").val();
        var mLName = $(".mother_last_name").val();

        var oFName = $(".other_first_name").val();
        var oLName = $(".other_last_name").val();

        var fFName = $(".father_first_name").val();
        var fLName = $(".father_last_name").val();

        var childFName = $(".child_first_name").val();
        var childLName = $(".child_last_name").val();

        var currentTab = $("li.active a").attr('tabnumber');

        var childFullName = childFName+' '+childLName;
        var prevParentInfoInput = $(".prevParentInfoInput").val();
        var activLi = $("li.active");

        var few = '';

        $(".childFulName").val(childFullName);

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
                next_fs = $('.enrollInformation');
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
                      url: parentSummerInfoUrl,
                      data: { 'parentMotherInfo':parentMotherInfo, 
                              'parentFatherInfo':parentFatherInfo, 
                              'parentOtherInfo':parentOtherInfo, 
                              'parentEmergencyContact':parentEmergencyContact,
                              'leavsWith':leavsWith,  
                              'prevParentInfoInput':prevParentInfoInput,
                              'currentTab':currentTab, 
                              "_token":parentSummerInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                            activLi.addClass("succesOr");
                         setTimeout(function() {
                            next_fs.show('slow'); 
                            current_fs.hide();
                            $('html, body').animate({
                                scrollTop: $(".enrollInformation").offset().top
                            }, 1000);
                        }, 3000);
                         $(".loader").css("display","none");
                         }
                    }
                });
        }
    });
}

$(".enrollPrev").click(function(){
    $(".prevParentInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.enrollInformation').is(":visible")){
        current_fs = $('.enrollInformation');
        next_fs = $('.parentInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".parentInformation").offset().top
    }, 1000);
});

function enrollmentInformation(){

    $('input[type=radio][name=lunch]').change(function() {
        var lunch = $('input[name="lunch"]:checked').length;
        if(lunch == 0){
            $(".lunchEror").addClass('comneror');
            $(".lunch").focus();
            error = 1;
        }else{
            $(".lunchEror").removeClass('comneror');
        }
    });

    $('select[name=program]').change(function() {
        $('.tableMain tr').removeClass('addGreen');
        $('.tableMain td').removeClass('addGreen2');
        var selProgram = $(this).val();
        
        if(selProgram !=''){
            $(".cals").removeClass("showCalender");
            /*if(selProgram == 1 || selProgram == 6){
                $(".tableMain tr td").click(function(){
                    var $this = $(this);
                    $this.closest("tr").toggleClass('addGreen');
                    var numActive = $('.addGreen').length;
                    if(numActive >=3){
                        $(".errorMsgTbl").html('');
                    }
                 });
            }else if(selProgram == 2){
                $(".atable tr td").click(function(){
                    var $this = $(this);
                    $this.toggleClass('addGreen2');
                    var numActive = $('.addGreen2').length;
                    if(numActive >=3){
                        $(".errorMsgTbl").html('');
                    }
                 });
            }*/
            
         
        }else{
            $(".cals").addClass("showCalender");
        }
    
    });

    /*$('.tableMain tr td').click(function(){
        var cval = $(this).text();
        alert(cval);
    });*/

    $(".tableMain tr td").click(function(){
        var $this = $(this);
        var selProgs = $('select[name=program]').val();
        if(selProgs == 1 || selProgs == 2  || selProgs == 3){
            $this.closest("tr").toggleClass('addGreen');

            var numActive = $('.addGreen').length;
            if(numActive >=3){
                $(".errorMsgTbl").html('');
            }

        }
        if(selProgs == 4 || selProgs == 5 || selProgs == 6 || selProgs == 7){
            var numActive = $('.addGreen2').length;

            var tdCount = $(this).parent('tr').find('.addGreen2').not(':first').length;

            if($(this).hasClass('addGreen2')){
                $this.toggleClass("addGreen2");
            }else if(tdCount == 3){
              alert("plese select only 3 days in a week");
            }else{
                $(this).toggleClass("addGreen2");
                if(tdCount > 0)
                    $this.closest("tr").find(".firstTd").addClass('addGreen2');

            }

            var numActive2 = $('.addGreen2').length;
            if(numActive2 >=12){
                $(".errorMsgTbl").html('');
            }
            /*if(tdCount <4){

                $this.closest("tr").find(".firstTd").addClass('addGreen2');
            }
            else{
                $this.closest("tr").find(".firstTd").removeClass('addGreen2');
            }*/
        }
                    
                    
                    /*var numActive = $('.addGreen').length;
                    if(numActive >=3){
                        $(".errorMsgTbl").html('');
                    }*/
                 });


    $(".nxtMedicalInfo").click(function(e){
        e.preventDefault();
        var error =0;
        var startDate = $(".start_date").val();
        var program = $(".sel_program").val();
        var pickUpTime = $(".pick_up_time").val();
        var dropOffTime = $(".drop_off_time").val();
        var lunchs = $('input[name="lunch"]:checked').length;
        var currentTab = $("li.active a").attr('tabnumber');
        var numActive = $('.addGreen').length;
        var numActive2 = $('.addGreen2').length;
        var activLi = $("li.active");
        var prevEnrollInfoInput = $(".prevEnrollInfoInput").val();

        var fel = '';

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

        if(pickUpTime == ''){
            if(fel =='')
                fel = ".pkProgram";

            $(".pick_up_time").addClass("comneror");
            $(".pick_up_time").focus();
            error = 1;
        }

        if(dropOffTime == ''){
            if(fel =='')
                fel = ".ptProgram";

            $(".drop_off_time").addClass("comneror");
            $(".drop_off_time").focus();
            error = 1;
        }

        if(lunchs == 0){
            if(fel =='')
                fel = ".alearAct";
            $(".lunchEror").addClass('comneror');
            $(".lunch").focus();
            error = 1;
        }else{
            $(".lunchEror").removeClass('comneror');
        }

        /*if(numActive <3){
            $(".errorMsgTbl").html('Please select atleast 3 weeks');
            error = 1;
        }else{
            error = 0;
        }

        if(numActive2 <12){
            $(".errorMsgTbl").html('Please select atleast 3 weeks');
            error = 1;
        }else{
            error = 0;
        }*/


        if(error == 0){
           $(".loader").css("display","block");
            if ($('.enrollInformation').is(":visible")){
                current_fs = $('.enrollInformation');
                next_fs = $('.medicalInformation');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }

            var enrollInfo = {
                'registration_date': $('.registration_date').val(), 
                'start_date': $('.start_date').val(),  
                'sel_program': $('.sel_program').val(),
                'pick_up_time':$('.pick_up_time').val(),
                'drop_off_time': $('.drop_off_time').val(),
                'lunch': $('input[name="lunch"]:checked').val(),
                'userSelctTable': $(".leftTbl").html(),
                'userSelctTableRight': $(".rightTbl").html(),
            };


            $.ajax({
                      method: "POST",
                      url: enrollSummerInfoUrl,
                      data: { 'enrollInfo':enrollInfo,   
                              'currentTab':currentTab,
                              'prevEnrollInfoInput':prevEnrollInfoInput, 
                              "_token":enrollSummerInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                            activLi.addClass("succesOr");
                         setTimeout(function() {
                            next_fs.show('slow'); 
                            current_fs.hide();
                            $('html, body').animate({
                                scrollTop: $(".medicalInformation").offset().top
                            }, 1000);
                        }, 3000);
                         $(".loader").css("display","none");
                         }
                    }
            });
        }
    });
}

$(".prevEnroll").click(function(){
    $(".prevEnrollInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.medicalInformation').is(":visible")){
        current_fs = $('.medicalInformation');
        next_fs = $('.enrollInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".enrollInformation").offset().top
    }, 1000);
});


/*function selectedDates(){

    $(".tableMain tr td").click(function(){
        alert("clicked");
		var alltd = $(this).closest('tr td');
			alltd.toggleClass("activegreen");
		data = $(event.target).closest('element-row').find('.title');
				
        if(!$(this).parent().find(".firstTd").hasClass("nwactive")){
            if(!$(this).hasClass("firstTd")){
                alert("Please select week first");
                return false;
            }
        }
          var slectedPlan = $(".sel_program").val();
          alert(slectedPlan);

          if( slectedPlan == 2){
            //$(this).parent('tr').find('td:not(.firstTd)').toggleClass('active');
            if($(this).hasClass('firstTd')){
              $(this).toggleClass('selct active nwactive');
            }
            var tdCount = $(this).parent('tr').find('.active.threeDayActive').not(':first').length;
            //alert(tdCount);
            console.log(tdCount);
            if($(this).hasClass('active threeDayActive')){
              $(this).toggleClass("active threeDayActive");
            }else if(tdCount == 3){
              alert("plese select only 3 days in a week");
            }else{
              //if($(this).parent().siblings(":first").hasClass('selct active')){
                $(this).toggleClass("active threeDayActive");

            }
          }
    });
  
    $(".firstTd").on("click", function(){
        var slectedPlan = $(".selectedPlan").val();
        var numActive = $('.active').length;

        if(numActive >= 36){
           $(".dateSelecError").css("display", "none");
        }
        //console.log('dff'+slectedPlan);
        if(slectedPlan == 1 || slectedPlan == 3){
          //console.log('5141'+slectedPlan);
          $(this).parent('tr').find('td:not(.firstTd)').toggleClass('active');
          $(this).toggleClass('selct');
        }
    });
}*/
hasErrorCls(".accept_medical_treatment", ".medicalAcept");
function medicalInfo(){

    $('.primary_physician_phone').on('keyup',function(){
           var numCount = $(this).val().replace(/\s/g, '').length;
           if(numCount <13){
                $(".primary_physician_phone").addClass("comneror");
           }else{
                $(".primary_physician_phone").removeClass("comneror");
           }
        });

    $(".nxtAcknowledge").click(function(){
        var error = 0;
        var fel = '';
        var primary_physician = $(".primary_physician").val();
        var primary_physician_phone = $(".primary_physician_phone").val();
        var acceptMedicalTret = $('input[name="accept_medical_treatment"]').prop('checked');
        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");
        var prevMedicalInfoInput = $(".prevMedicalInfoInput").val();

        if(primary_physician == ''){
            if(fel =='')
                fel = ".pPhysician";

            $(".primary_physician").addClass("comneror");
            $(".primary_physician").focus();
            error = 1;
        }

        if(primary_physician_phone == ''){
            if(fel =='')
                fel = ".pPhysicianPhone";

            $(".primary_physician_phone").addClass("comneror");
            $(".primary_physician_phone").focus();
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

        if(error == 0){

            $(".loader").css("display","block");
            if ($('.medicalInformation').is(":visible")){
                current_fs = $('.medicalInformation');
                next_fs = $('.waiverInfo');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }

            var medicalInfo = {
                'medical_info': $('.medical_info').val(), 
                'primary_physician': $('.primary_physician').val(),  
                'primary_physician_phone': $('.primary_physician_phone').val(),
            };


            $.ajax({
                      method: "POST",
                      url: medicalSummerInfoUrl,
                      data: { 'medicalInfo':medicalInfo,   
                              'currentTab':currentTab,
                              'prevMedicalInfoInput':prevMedicalInfoInput, 
                              "_token":medicalSummerInfoToken,
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
        var authorizeName = $(".authorize_name").val();
        var authorizeNameOne = $(".authorize_name_one").val();
        var authorizeRelation = $(".authorize_relation").val();
        var authorizeRelationOne = $(".authorize_relation_one").val();
        var authorizeAddress = $(".authorize_address").val();
        var authorizeAddressOne = $(".authorize_address_one").val();
        var authorizePhone = $(".authorize_phone").val();
        var authorizePhoneOne = $(".authorize_phone_one").val();
        var prevWaiverInfoInput = $(".prevWaiverInfoInput").val();

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

        /*if(authorizeName ==''){
            if(fel =='')
                fel = ".cAuthName";
            
            $(".authorize_name").addClass("comneror");
            $(".authorize_name").focus();
            error = 1;
        }*/

        /*if(authorizeNameOne ==''){
            if(fel =='')
                fel = ".cAuthName";
            
            $(".authorize_name_one").addClass("comneror");
            $(".authorize_name_one").focus();
            error = 1;
        }*/

        /*if(authorizeRelation ==''){
            if(fel =='')
                fel = ".authRelation";
            
            $(".authorize_relation").addClass("comneror");
            $(".authorize_relation").focus();
            error = 1;
        }*/

        /*if(authorizeRelationOne ==''){
            if(fel =='')
                fel = ".authRelation";
            
            $(".authorize_relation_one").addClass("comneror");
            $(".authorize_relation_one").focus();
            error = 1;
        }*/

        /*if(authorizeAddress ==''){
            if(fel =='')
                fel = ".authAddr";
            
            $(".authorize_address").addClass("comneror");
            $(".authorize_address").focus();
            error = 1;
        }*/

        /*if(authorizeAddressOne ==''){
            if(fel =='')
                fel = ".authAddr";
            
            $(".authorize_address_one").addClass("comneror");
            $(".authorize_address_one").focus();
            error = 1;
        }*/

        /*if(authorizePhone == ''){
            if(fel =='')
                fel = ".authPhone";

            $(".authorize_phone").addClass("comneror");
            $(".authorize_phone").focus();
            error = 1;
        }*/
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
                      url: authSummerInfoUrl,
                      data: { 'authContact':authContact,
                              'prevWaiverInfoInput':prevWaiverInfoInput,     
                              "_token":authSummerInfoToken,
                          },
                      dataType:"json",
                      success: function(data) {
                         if(data.success == 1){
                         setTimeout(function() {
                            $(".secCls").addClass("btn-primary");
                            //$(".fstCls").removeClass("btn-primary");
                            $("#step-1").css("display", "none");
                            $("#step-2").css("display", "block");
                            $(".loader").css("display","none");
                            $('html, body').animate({
                                scrollTop: $(".policyDCFInfo").offset().top
                            }, 1000); 
                        }, 3000);
                         }
                    }
                });
        }

    });
}

$(".prevReleaseAuth").click(function(){
    $(".prevMedicalInfoInput").val('1');
    $(".loader").css("display","block");
    if ($('.waiverInfo').is(":visible")){
        current_fs = $('.waiverInfo');
        next_fs = $('.medicalInformation');
        var nextId = $(this).parents('.tab-pane').prev().attr("id");
        $('[href=#'+nextId+']').tab('show');
    }
    next_fs.show(); 
    $(".loader").css("display","none");
    current_fs.hide();
    $('html, body').animate({
        scrollTop: $(".medicalInformation").offset().top
    }, 1000);
});

$(".preTabOne").click(function(){
    $(".prevWaiverInfoInput").val('1');
    $(".loader").css("display","block");
    $(".secCls").removeClass("btn-primary");
    $(".fstCls").addClass("btn-primary");
    $("#step-1").css("display", "block");
    $("#step-2").css("display", "none");
    if ($('.childInformation').is(":visible")){
        current_fs = $('.childInformation');
        next_fs = $('.waiverInfo');
        var nextId = $(this).parents('.tab-pane').next().attr("id");

        $('[href=#item5]').tab('show');
        $(".waiverInfo").addClass("in active");
        $(".childInformation").addClass("in active");
    }
    next_fs.show(); 
    $(".loader").css("display","none");
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
                if ($('.policyDCFInfo').is(":visible")){
                    current_fs = $('.policyDCFInfo');
                    next_fs = $('.policyAggrementInfo');
                    var nextId = $(this).parents('.tab-pane').next().attr("id");
                    $('[href=#'+nextId+']').tab('show');
                }
                $.ajax({
                      method: "POST",
                      url: policyDcfUrl,
                      data: { 'tabNumber':'7',   
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
    var activLi = $("li.active");
    var fel = '';
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
        activLi.addClass("succesOr");
        $(".loader").css("display","block");
        if ($('.policyAggrementInfo').is(":visible")){
            current_fs = $('.policyAggrementInfo');
            next_fs = $('#menu2');
            var nextId = $(this).parents('.tab-pane').next().attr("id");
            $('[href=#'+nextId+']').tab('show');
        }
        next_fs.show(); 
        $(".loader").css("display","none");
        current_fs.hide();
        $('html, body').animate({
            scrollTop: $("#menu2").offset().top
        }, 1000);
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
        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");
        var prevChildImgInfoInput = $(".prevChildImgInfoInput").val();
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
                  url: photoSummerInfoUrl,
                  data: { 'photoInfo':photoInfo, 
                          'currentTab':currentTab,
                          'prevChildImgInfoInput':prevChildImgInfoInput, 
                          "_token":photoSummerInfoToken,
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

    radioOnchange("epi_pen",".al4",".epi_pen");
    radioOnchange("benadryl",".al6",".benadryl");
    radioOnchange("with_benadryl",".a18",".with_benadryl");
    radioOnchange("allergy_action_plan",".rad3",".allergy_action_plan");

    $(".nxtTransportation").click(function(){
        var error = 0;
        var fel = '';
        var alergyChk = $('input[name="alergy_chk"]:checked').length;
        var epi_pen = $('input[name="epi_pen"]:checked').length;
        var benadryl = $('input[name="benadryl"]:checked').length;
        var with_benadryl = $('input[name="with_benadryl"]:checked').length;
        var allergy_action_plan = $('input[name="allergy_action_plan"]:checked').length;
        var currentTab = $("li.active a").attr('tabnumber');
        var allergyAcpt = $('input[name="allergy_acpt"]').prop('checked');
        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");
        var prevAlergyAlrtInput = $(".prevAlergyAlrtInput").val();

        if(alergyChk == 0){
            if(fel =='')
                fel = ".aChk";

            $(".al1").addClass('comneror');
            $(".alergy_chk").focus();
            error = 1;
        }else{
            $(".al1").removeClass('comneror');
        }


        if(epi_pen == 0){
            if(fel =='')
                fel = ".epe";

            $(".al4").addClass('comneror');
            $(".epi_pen").focus();
            error = 1;
        }else{
            $(".al4").removeClass('comneror');
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

        if(benadryl == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".al6").addClass('comneror');
            $(".benadryl").focus();
            error = 1;
        }else{
            $(".al6").removeClass('comneror');
        }

        if(with_benadryl == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".a18").addClass('comneror');
            $(".with_benadryl").focus();
            error = 1;
        }else{
            $(".a18").removeClass('comneror');
        }

        if(allergy_action_plan == 0){
            if(fel =='')
                fel = ".alerAct";
            $(".rad3").addClass('comneror');
            $(".allergy_action_plan").focus();
            error = 1;
        }else{
            $(".rad3").removeClass('comneror');
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
                'epi_pen': $('input[name="epi_pen"]:checked').val(),
                'benadryl':$('input[name="benadryl"]:checked').val(),
                'with_benadryl': $('input[name="with_benadryl"]:checked').val(),
                'allergy_action_plan': $('input[name="allergy_action_plan"]:checked').val(),
            };

            $.ajax({
                  method: "POST",
                  url: alergyInfoUrl,
                  data: { 'alergyInfo':alergyInfo, 
                          'currentTab':currentTab,
                          'prevAlergyAlrtInput':prevAlergyAlrtInput, 
                          "_token":alergyInfoToken,
                      },
                  dataType:"json",
                  success: function(data) {
                     if(data.success == 1){
                        activLi.addClass("succesOr");
                        setTimeout(function() {
                        next_fs.show(); 
                        current_fs.hide();
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

$(".prevAlergy").click(function(){
    $(".prevAlergyAlrtInput").val('1');
    $(".loader").css("display","block");
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



function receiptInfo(){

    $(".nxtReceiptInfo").click(function(){
        var error = 0;
        var fel = '';

        var acpt_camp = $('input[name="acpt_camp"]').prop('checked');
        var acptTwo = $('input[name="acptTwo"]').prop('checked');
        var currentTab = $("li.active a").attr('tabnumber');
        var activLi = $("li.active");


        if(acpt_camp == false){
            if(fel =='')
                fel = ".actport";

            $(".actCampAct").addClass('comneror');
            $(".actCampAct").focus();
            error = 1;
        }else{
            $(".actCampAct").removeClass('comneror');
        }

        if(acptTwo == false){
            if(fel =='')
                fel = ".actports";

            $(".camp2").addClass('comneror');
            $(".camp2").focus();
            error = 1;
        }else{
            $(".camp2").removeClass('comneror');
        }


        if(error == 0){
            activLi.addClass("succesOr");
            $(".loader").css("display","block");
            if ($('#transportation').is(":visible")){
                current_fs = $('#transportation');
                next_fs = $('#acknowledgement');
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                $('[href=#'+nextId+']').tab('show');
            }


            /*var travelInfo = {
                'child_names': $('.child_names').val(),
                'travelBy': travelBy, 
            };
*/
            setTimeout(function() {
                        next_fs.show(); 
                        current_fs.hide();
                        $('html, body').animate({
                            scrollTop: $("#acknowledgement").offset().top
                        }, 1000); 
                    $(".loader").css("display","none");
                    }, 3000);
            /*$.ajax({
                  method: "POST",
                  url: travelInfoUrl,
                  data: { 'travelInfo':travelInfo, 
                          'currentTab':currentTab, 
                          "_token":travelInfoToken,
                      },
                  dataType:"json",
                  success: function(data) {
                     if(data.success == 1){
                     
                    }
                }
            });*/
        }
    });
}
$(".prevTransport").click(function(){
    $(".loader").css("display","block");
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