function displayError(errorMsgTerms = '', errorCls = ''){
      var errorTxt = errorMsgTerms;
      $(errorCls).text(errorTxt);
      //$(this).closest('div').find('.errorTxt').text(errorTxt);
}

function validationKeyUp(clsName = '', errorCls = ''){

    $(clsName).keyup(function(){
        $(clsName).removeClass(errorCls);
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

function validatePassword(password){
    ///^(?=.*[A-Z])(?=.*\d)(?=.*\W)(?=.*[A-Z]).{8,12}$/;
    //var filter = /^(?=.*\d)(?=.*[A-Z]).{8,12}$/;
    //\w[@][A-Z]\d
    //\w[@#$][A-Z]{6,}\document
    var filter = /^(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~])(?=.*[a-zA-Z]).{10,12}$/;
    if (filter.test(password)) {
        return true;
    }
    else {
        return false;
    }
}

$(document).ready(function(){
       $( ".parent_first_name" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(".parent_first_name").addClass("comneror");
            }else{
                $(".parent_first_name").removeClass("comneror");
            }
        }); 

       $( ".parent_last_name" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(".parent_last_name").addClass("comneror");
            }else{
                $(".parent_last_name").removeClass("comneror");
            }
        });
            
       $('.zip_code').on('keyup',function(){
           var charCount = $(this).val().replace(/\s/g, '').length;
           if(charCount <5){
                $(".zip_code").addClass("comneror");
           }else{
                $(".zip_code").removeClass("comneror");
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

       /*$('.alternative_phone').on('keyup',function(){
           var aCount = $(this).val().replace(/\s/g, '').length;
           if(aCount <13){
                //$(".alternative_phone").addClass("comneror");
           }else{
                //$(".alternative_phone").removeClass("comneror");
           }
        });*/



       //Additional
       $( ".additn_first_name" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(".additn_first_name").addClass("comneror");
            }else{
                $(".additn_first_name").removeClass("comneror");
            }
        });

       $( ".additn_last_name" ).keypress(function(e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
                $(".additn_last_name").addClass("comneror");
            }else{
                $(".additn_last_name").removeClass("comneror");
            }
        });

       $('.additn_zip_code').on('keyup',function(){
           var charCount = $(this).val().replace(/\s/g, '').length;
           if(charCount <5){
                $(".additn_zip_code").addClass("comneror");
           }else{
                $(".additn_zip_code").removeClass("comneror");
           }
        }); 

       $('.additn_primary_phone').on('keyup',function(){
           var numCount = $(this).val().replace(/\s/g, '').length;
           if(numCount <13){
                $(".additn_primary_phone").addClass("comneror");
           }else{
                $(".additn_primary_phone").removeClass("comneror");
           }
        });

       $('.additn_alternative_phone').on('keyup',function(){
           var aCount = $(this).val().replace(/\s/g, '').length;
           if(aCount <13){
                $(".additn_alternative_phone").addClass("comneror");
           }else{
                $(".additn_alternative_phone").removeClass("comneror");
           }
        });

});       

function parentInfo(){
    $(".next").click(function(e){
        e.preventDefault();
        var error =0;
        var parentFName = $(".parent_first_name").val();
        var parentLName = $(".parent_last_name").val();
        var streetName = $(".street_name").val();
        var stateName = $(".state_name").val();
        var cityName = $(".child_city").val();
        var zipCode = $(".zip_code").val();
        var primaryPhone = $(".primary_phone").val();
        var alternativePhone = $(".alternative_phone").val();
        var parentEmail = $(".parent_email").val();
        var parentAlterEmail = $(".parent_alter_email").val();
        var fel = '';

        if(parentFName == ''){
            if(fel =='')
                fel = ".cFN";

            $(".parent_first_name").addClass('comneror');
            error = 1;
        }
        if(parentLName == ''){
            if(fel =='')
                fel = ".cLN";

            $(".parent_last_name").addClass("comneror");
            error = 1;
        }
        /*if(streetName == ''){
            if(fel =='')
                fel = ".cSN";

            $(".state_name").addClass("comneror");
            error = 1;
        }*/
        if(cityName == ''){
            if(fel =='')
                fel = ".cSN";

            $(".child_city").addClass("comneror");
            error = 1;
        }
        if(stateName == ''){
            if(fel =='')
                fel = ".cStat";

            $(".street_name").addClass("comneror");
            error = 1;
        }
        if(zipCode == ''){
            if(fel =='')
                fel = ".zCode";

            $(".zip_code").addClass("comneror");
            error = 1;
        }

        if(primaryPhone == ''){
            if(fel =='')
                fel = ".pPhone";

            $(".primary_phone").addClass("comneror");
            error = 1;
        }

        /*if(alternativePhone == ''){
            if(fel =='')
                fel = ".aPhone";

            $(".alternative_phone").addClass("comneror");
            error = 1;
        }*/


        if(parentEmail != ''){
            if(!validateEmail(parentEmail)){
                if(fel =='')
                    fel = ".cEmail";

                $(".parent_email").addClass("comneror");
                error = 1;
            }
        }else{
            if(fel =='')
                    fel = ".cEmail";

            $(".parent_email").addClass("comneror");
            error = 1; 
        }

        if ($(".parent_email").hasClass("comneror")) {
          error = 1;
        }

        /*if(parentAlterEmail != ''){
            if(!validateEmail(parentAlterEmail)){
                if(fel =='')
                    fel = ".aEmail";

                $(".parent_alter_email").addClass("comneror");
                error = 1;
            }
        }else{
            if(fel =='')
                    fel = ".aEmail";

            $(".parent_alter_email").addClass("comneror");
            error = 1; 
        }*/

        if(error == 0){
			//$(".step2").addClass('btn-primary');
            if ($('.parentInfoStep').is(":visible")){
                current_fs = $('.parentInfoStep');
                next_fs = $('.additionalParentInfo');
                $(".step1").addClass('btn-primary');
                $(".step2").addClass('btn-primary').removeClass('btn-default');
            }else if($('.additionalParentInfo').is(":visible")){
                current_fs = $('.additionalParentInfo');
                next_fs = $('.loginInfo');
            }
            next_fs.show(); 
            current_fs.hide();
        }
        //return true;
    });
}

function additionalParentInfo(){
    $(".addiNext").click(function(e){
        e.preventDefault();
        var error =0;
        var parentFName = $(".additn_first_name").val();
        var parentLName = $(".additn_last_name").val();
        var streetName = $(".additn_street_name").val();
        var stateName = $(".additn_state_name").val();
        var cityName = $(".additn_city_name").val();
        var zipCode = $(".additn_zip_code").val();
        var primaryPhone = $(".additn_primary_phone").val();
        var alternativePhone = $(".additn_alternative_phone").val();
        var parentEmail = $(".additn_parent_email").val();
        var parentAlterEmail = $(".additn_parent_alter_email").val();
        var fel = '';

        if(parentFName == ''){
            if(fel =='')
                fel = ".caFN";

            $(".additn_first_name").addClass('comneror');
            error = 1;
        }
        if(parentLName == ''){
            if(fel =='')
                fel = ".caLN";

            $(".additn_last_name").addClass("comneror");
            error = 1;
        }
        if(streetName == ''){
            if(fel =='')
                fel = ".ctSN";

            $(".additn_street_name").addClass("comneror");
            error = 1;
        }
        if(cityName == ''){
            if(fel =='')
                fel = ".caStat";

            $(".additn_city_name").addClass("comneror");
            error = 1;
        }
        if(zipCode == ''){
            if(fel =='')
                fel = ".zaCode";

            $(".additn_zip_code").addClass("comneror");
            error = 1;
        }

        if(primaryPhone == ''){
            if(fel =='')
                fel = ".paPhone";

            $(".additn_primary_phone").addClass("comneror");
            error = 1;
        }

        /*if(alternativePhone == ''){
            if(fel =='')
                fel = ".anPhone";

            $(".additn_alternative_phone").addClass("comneror");
            error = 1;
        }*/


        if(parentEmail != ''){
            if(!validateEmail(parentEmail)){
                if(fel =='')
                    fel = ".caEmail";

                $(".additn_parent_email").addClass("comneror");
                error = 1;
            }
        }else{
            if(fel =='')
                    fel = ".caEmail";

            $(".additn_parent_email").addClass("comneror");
            error = 1; 
        }

        /*if(parentAlterEmail != ''){
            if(!validateEmail(parentAlterEmail)){
                if(fel =='')
                    fel = ".atEmail";

                $(".additn_parent_alter_email").addClass("comneror");
                error = 1;
            }
        }else{
            if(fel =='')
                    fel = ".atEmail";

            $(".additn_parent_alter_email").addClass("comneror");
            error = 1; 
        }*/

        if(error == 0){
            if($('.additionalParentInfo').is(":visible")){
                current_fs = $('.additionalParentInfo');
                next_fs = $('.loginInfo');
                $(".step2").addClass('btn-primary');
                $(".step3").addClass('btn-primary').removeClass('btn-default');
            }
            next_fs.show(); 
            current_fs.hide();
        }
        //return true;
    });
}

$("#checkbox2").change(function() {
    if(this.checked) {
        $(".actp").removeClass("comneror");
    }
});


function createAccount(){
    $(".createAcct").on("click", function(e){
        e.preventDefault();
        var error = 0;
        var userName = $(".user_name").val();
        var password = $(".password").val();
        var verifyPassword = $(".verify_password").val();
        var firstQuestions = $(".first_questions").val();
        var secondQuestions = $(".second_questions").val();
        var thirdQuestions = $(".third_questions").val();

        var firstAnswer = $(".first_answer").val();
        var secondAnswer = $(".second_answer").val();
        var thirdAnswer = $(".third_answer").val();

        /*var fliter = ^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$;

        if(fliter.test(password)){
            alert("valid");
        }else{
            alert("error");
        }*/

        var fel = '';
      
        if(userName == ''){
            if(fel =='')
                fel = ".pUser";

            $(".user_name").addClass("comneror");
            error = 1;
        }

        /*if(password == ''){
            if(fel =='')
                fel = ".pPass";

            $(".password").addClass("comneror");
            error = 1;
        }*/


        if(password != ''){
            if(!validatePassword(password)){
                if(fel =='')
                    fel = ".pPass";

                $(".password").addClass("comneror");
                error = 1;
            }
        }else{
            if(fel =='')
                    fel = ".pPass";

            $(".password").addClass("comneror");
            error = 1; 
        }






        if(verifyPassword == ''){
            if(fel =='')
                fel = ".pVPass";

            $(".verify_password").addClass("comneror");
            error = 1;
        }

        if (verifyPassword != password ) {
            if(fel =='')
                fel = ".pVPass";

            $(".verify_password").addClass("comneror");
            error = 1;
        }


        if(firstQuestions == ''){
            if(fel =='')
                fel = ".fQ";

            $(".first_questions").addClass("comneror");
            error = 1;
        }

        if(secondQuestions == ''){
            if(fel =='')
                fel = ".sQ";

            $(".second_questions").addClass("comneror");
            error = 1;
        }
        if(thirdQuestions == ''){
            if(fel =='')
                fel = ".tQ";

            $(".third_questions").addClass("comneror");
            error = 1;
        }


        if(firstAnswer == ''){
            if(fel =='')
                fel = ".fa";

            $(".first_answer").addClass("comneror");
            error = 1;
        }
        if(secondAnswer == ''){
            if(fel =='')
                fel = ".sa";

            $(".second_answer").addClass("comneror");
            error = 1;
        }
        if(thirdAnswer == ''){
            if(fel =='')
                fel = ".ta";

            $(".third_answer").addClass("comneror");
            error = 1;
        }

        if ($("#checkbox2").is(":checked")) {
            $(".actp").removeClass("comneror");
        }else {
            $(".actp").addClass("comneror");
            error = 1;
        }

        if(error == 0){
            $(".loader").fadeIn("slow");
            $("#registrationForm").submit();
        }

    })
} 

function backToParentInfo(){
    $(".parentBackBtn").click(function(){
        if($('.additionalParentInfo').is(":visible")){
                    current_fs = $('.additionalParentInfo');
                    prev_fs = $('.parentInfoStep');
                    $(".step2").removeClass('btn-primary').addClass('btn-default');
                    $(".step1").addClass('btn-primary').removeClass('btn-default');
                }
        prev_fs.show(); 
        current_fs.hide();
    });
}

function backToParentAdditionalInfo(){
    $(".backToAditnInfo").click(function(){
        if($('.loginInfo').is(":visible")){
                    current_fs = $('.loginInfo');
                    prev_fs = $('.additionalParentInfo');
                    $(".step3").removeClass('btn-primary').addClass('btn-default');
                    $(".step2").addClass('btn-primary').removeClass('btn-default');
                }
        prev_fs.show(); 
        current_fs.hide();
    });
}