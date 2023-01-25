$('input[name="threeFullDays"]').on("change", function(){
    var val = 2;
    $(".selectedPlan").val(val);
    var threeDays = $('input[name="threeFullDays"]:checked').val();
    var bOptionHtml = '';
      bOptionHtml = '<option value="">- -</option>\
                    <option value="5:00">5:00 AM</option>\
                    <option value="5:30">5:30 AM</option>\
                    <option value="6:00">6:00 AM</option>\
                    <option value="6:30">6:30 AM</option>';
      //$(".pick_up_time").append(bOptionHtml);  
      var aOptionHtml = '';
      aOptionHtml = '<option value="">- -</option>\
                    <option value="5:00">5:00 PM</option>\
                    <option value="5:30">5:30 PM</option>\
                    <option value="6:00">6:00 PM</option>\
                    <option value="6:30">6:30 PM</option>';
      //$(".drop_off_time").append(aOptionHtml);
    //alert(threeDays);
    if(threeDays == 'Y'){

        $("input[name='threDaysB']").change(function() {
          checkCareOptionB();
          
        });

        $("input[name='threDaysA']").change(function() {
           checkCareOptionA();
        });

        $(".submtThreeDays").on("click", function(){
            if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == false){
              $(".errorSummerCls").html("Please select care options");
            }else{
              $("#myModal").modal("hide");
              $("#heading1 a").removeAttr("data-toggle");
              nextTab(2,1);
            } 
        });
    }else if(threeDays == 'N'){
      $("#myModal").modal("hide");
      $("#heading1 a").removeAttr("data-toggle");
      nextTab(2,1);
  }
    
  });

$(".submtThreeDays").on("click", function(){
  if($('input[name=threeFullDays]:checked').length<=0){
    $(".errorSummerCls").html("Please select include care");
  } 
});


function checkCareOptionB(){
  var beforePrice = $(".beforePrice").val();
  var afterPrice = $(".afterPrice").val();
  var totalOptB = '';
  if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == true){
    totalOptB = 4.5*beforePrice+7.5*afterPrice;
      $(".totalHour3").html("<h6 class='threeBeforeHour'>12 Hr</h6>");
      $(".totalPrice3").html("<h6 class='threeBeforePrice'>"+ totalOptB +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == true){
      totalOptB = 4.5*beforePrice;
      $(".totalHour3").html("<h6 class='threeBeforeHour'>4 Hr 30 Min</h6>");
      $(".totalPrice3").html("<h6 class='threeBeforePrice'>"+ totalOptB +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == false){
      totalOptB = 4.5*beforePrice;
      $(".totalHour3").html("<h6 class='threeBeforeHour'>4 Hr 30 Min</h6>");
      $(".totalPrice3").html("<h6 class='threeBeforePrice'>"+ beforePrice +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == true){
      totalOptB = 7.5*afterPrice;  
      $(".totalHour3").html("<h6 class='threeBeforeHour'>7 Hr 30 Min</h6>");
      $(".totalPrice3").html("<h6 class='threeBeforePrice'>"+ afterPrice +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == false){
      $(".totalHour3").html("");
      $(".totalPrice3").html("");
      $(".errorSummerCls").css("display", "block");
  }
}

function checkCareOptionA(){
  var beforePrice = $(".beforePrice").val();
  var afterPrice = $(".afterPrice").val();
  var totalOptB = '';
 if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == true){
      totalOptB = 4.5*beforePrice+7.5*afterPrice;
      $(".totalHour3").html("<h6 class='threeAfterHour'>12 Hr</h6>");
      $(".totalPrice3").html("<h6 class='threeAfterPrice'>"+ totalOptB +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysA']").prop('checked') == true){
      totalOptB = 7.5*afterPrice;
      $(".totalHour3").html("<h6 class='threeAfterHour'>7 Hr 30 Min</h6>");
      $(".totalPrice3").html("<h6 class='threeAfterPrice'>"+ totalOptB +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == false){
      totalOptB = 4.5*beforePrice;
      $(".totalHour3").html("<h6 class='threeAfterHour'>4 Hr 30 Min</h6>");
      $(".totalPrice3").html("<h6 class='threeAfterPrice'>"+ totalOptB +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == true){
      totalOptB = 7.5*afterPrice;  
      $(".totalHour3").html("<h6 class='threeAfterHour'>7 Hr 30 Min</h6>");
      $(".totalPrice3").html("<h6 class='threeAfterPrice'>"+ totalOptB +"$</h6>");
      $(".errorSummerCls").css("display", "none");
  }else if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == false){
      $(".totalHour3").html("");
      $(".totalPrice3").html("");
      $(".errorSummerCls").css("display", "block");
  }
}

function nextTab(num1 = '', num2 = '') {
   $("#collapse" + num1).addClass("in").attr("aria-expanded", 'true');
   $("#heading" + num1 + " a").removeClass("collapsed").attr("aria-expanded", 'true');
   $("#heading" + num1 + " a i").addClass("glyphicon-minus").removeClass("glyphicon-plus");

   $("#collapse" + num2).removeClass("in").attr("aria-expanded", 'false');
   $("#heading" + num2 + " a").addClass("collapsed").attr("aria-expanded", 'false');
   $("#heading" + num2 + " a i").removeClass("glyphicon-minus").addClass("glyphicon-plus");
}

$('input[name="fiveHalfDay"]').on("change", function(){
    var val = 3;
    $(".selectedPlan").val(val);
    var fiveHalfDay = $('input[name="fiveHalfDay"]:checked').val();

    var bOptionHtml = '';
        bOptionHtml = '<option value="">- -</option>\
                    <option value="5:00">5:00 AM</option>\
                    <option value="5:30">5:30 AM</option>\
                    <option value="6:00">6:00 AM</option>\
                    <option value="6:30">6:30 AM</option>';
      //$(".pick_up_time").append(bOptionHtml); 
    var aOptionHtml = '';
      aOptionHtml = '<option value="">- -</option>\
                    <option value="1:00">1:00 PM</option>\
                    <option value="1:30">1:30 PM</option>\
                    <option value="2:00">2:00 PM</option>\
                    <option value="2:30">2:30 PM</option>';
      //$(".drop_off_time").append(aOptionHtml);  

    if(fiveHalfDay == 'Y'){
        var totalOptB = '';
        var prices = $(".fiveDaysHalfPrice").val();
        $("input[name='fiveDaysHalf']").change(function() {
          if($("input[name='fiveDaysHalf']").prop('checked') == true){
             totalOptB = 7.5*prices;
              $(".totalPrice5Half").html("<h6 class='fiveHalfPrice'>"+ totalOptB +"$</h6>");
              $(".errorSummerFiveCls").css("display", "none");
          }else if($("input[name='fiveDaysHalf']").prop('checked') == false){
              $(".errorSummerFiveCls").css("display", "block");
          }
        });


        $(".submtFiveDays").on("click", function(){
            //$(".errorSummerCls").css("display", "block");
            if($("input[name='fiveDaysHalf']").prop('checked') == false){
              $(".errorSummerFiveCls").html("Please select care options");
            }else{
              $("#myModal2").modal("hide");
              $("#heading1 a").removeAttr("data-toggle");
              nextTab(2,1);
            } 
        });
    }else if(fiveHalfDay == 'N'){
      $("#myModal2").modal("hide");
      $("#heading1 a").removeAttr("data-toggle");
      nextTab(2,1);
  }
    
  });

$(".fullDays").on("click", function(){
      var val = 1;

      $(".selectedPlan").val(val);
      $("#heading1 a").removeAttr("data-toggle");
      $(".dateSelecError").css("display", "none");
      var bOptionHtml = '';
      bOptionHtml = '<option value="">- -</option>\
                    <option value="5:00">5:00 AM</option>\
                    <option value="5:30">5:30 AM</option>\
                    <option value="6:00">6:00 AM</option>\
                    <option value="6:30">6:30 AM</option>';
      //$(".pick_up_time").append(bOptionHtml);  
      var aOptionHtml = '';
      aOptionHtml = '<option value="">- -</option>\
                    <option value="5:00">5:00 PM</option>\
                    <option value="5:30">5:30 PM</option>\
                    <option value="6:00">6:00 PM</option>\
                    <option value="6:30">6:30 PM</option>';
      //$(".drop_off_time").append(aOptionHtml);

      nextTab(2,1);
});


//Code for blade tempalte not here paste this code into laravel blade tempalte
/*var summerDate = '{{ $summerDate ?? ''}}';
//Start Date
var startDate = new Date(summerDate).getTime()+ 35*24*60*60*1000;
var endDate = new Date(startDate);
var nextDate = endDate.toLocaleDateString();

var newDates = new Date(nextDate).getTime()+ 24*60*60*1000;


//End Date
var startDateTwo = new Date(nextDate).getTime()+ 28*24*60*60*1000;
var endDateTwo = new Date(startDateTwo);
var nextDateTwo = endDateTwo.toLocaleDateString();

$(".startDatepicker").datepicker( {
  //firstDay: 1,
  beforeShowDay: $.datepicker.noWeekends,
  showTime: true,
  constrainInput: false,
  minDate: new Date(summerDate),
  maxDate: new Date(nextDate),
  // changeMonth: true,
  // changeYear: true,
  prevText: '<i class="fa fa-fw fa-angle-left"></i>',
    nextText: '<i class="fa fa-fw fa-angle-right"></i>',
  
  //bg
  
  onSelect: function() {
    var dateText = $.datepicker.formatDate("MM dd, yy", $(this).datepicker("getDate"));
  alert(dateText);
         $('p.bgText').text(dateText);
    }
  
});


$(".endDatepicker").datepicker( {
  //firstDay: 1,
  beforeShowDay: $.datepicker.noWeekends,
  showTime: true,
  constrainInput: false,
  minDate: new Date(newDates),
  maxDate: new Date(nextDateTwo),
  // changeMonth: true,
  // changeYear: true,
  prevText: '<i class="fa fa-fw fa-angle-left"></i>',
    nextText: '<i class="fa fa-fw fa-angle-right"></i>',
  
  //bg
  
  onSelect: function() {
    var dateText = $.datepicker.formatDate("MM dd, yy", $(this).datepicker("getDate"));
  alert(dateText);
         $('p.bgText').text(dateText);
    }
  
});*/
function selectedDates(){

    $(".tableMain tr td").click(function(){
        
        if(!$(this).parent().find(".firstTd").hasClass("nwactive")){
            if(!$(this).hasClass("firstTd")){
                alert("Please select week first");
                return false;
            }
        }
          var slectedPlan = $(".selectedPlan").val();

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
}

function calculateTotal(){
  $('select[name="pick_up_time"]').change(function(){
    var selectPickUp = $("select[name='pick_up_time'] option:selected").val();
    if(selectPickUp == ''){
      $(".errorSummerPickup").css("display", "block");
    }else{
      $(".errorSummerPickup").css("display", "none");
    }
  });

  $('select[name="drop_off_time"]').change(function(){
    var selectDropOff = $("select[name='drop_off_time'] option:selected").val();
    if(selectDropOff == ''){
      $(".errorSummerDropoff").css("display", "block");
    }else{
      $(".errorSummerDropoff").css("display", "none");
    }
  });

  $('input[name="lunch"]').on("change", function(){
    $(".lunchError").css("display", "none");
  });

  $(".acceptAll").on("click", function(){
      var error = 0;
      var pickUp = $(".pick_up_time").val();
      var dropOff = $(".drop_off_time").val();
      var numActive = $('.active').length;
      var nwactive = $(".nwactive").length;
      var slectedPlan = $(".selectedPlan").val();

      if(slectedPlan == 1 || slectedPlan == 3){
        if(numActive == 0){
          $(".dateSelecError").html("Please select minimum 7 weeks");
          $(".dateSelecError").css("display", "block");
          error = 1;
        }else if(numActive < 42){
          $(".dateSelecError").html("Please select minimum 7 weeks");
          error = 1;
          $(".dateSelecError").css("display", "block");
        }else if(numActive == 42){
          $(".dateSelecError").css("display", "none");
        }
      }else if(slectedPlan == 2){
        
        if(numActive == 0){
          $(".dateSelecError").html("Please select minimum 7 weeks");
          $(".dateSelecError").css("display", "block");
          error = 1;
        }else if(numActive < 28){
          $(".dateSelecError").html("Please select minimum 7 weeks");
          error = 1;
          $(".dateSelecError").css("display", "block");
        }else if(numActive == 28){
          $(".dateSelecError").css("display", "none");
        }
        if(nwactive <7 && numActive < 28){
          $(".dateSelecError").html("Please select minimum 7");
          error = 1;
        }else if(nwactive ==8 && numActive < 32){
          $(".dateSelecError").html("Please select minimum 3 days in a week");
          error = 1;
        }else if(nwactive ==9 && numActive < 36){
          $(".dateSelecError").html("Please select minimum 3 days in a week");
          error = 1;
        }else{
          $(".dateSelecError").css("display", "none");
        }
      }
      if(pickUp == ''){
        $(".errorSummerPickup").html("Please select pickup time");
        error = 1;
      }else{
         $(".errorSummerPickup").css("display", "none");
      }
      if(dropOff == ''){
        $(".errorSummerDropoff").html("Please select dropoff time");
        error = 1;
      }else{
         $(".errorSummerDropoff").css("display", "none");
      }

      if($('input[name=lunch]:checked').length==0){
        $(".lunchError").html("Please select lunch option");
        error = 1;
    }
      
    if(error == 0){
      var lunchTableHeadr = '';
      var lunchTableBody = '';
      var colspan = '';
      var newTable = '';
      var total = '';
      var payble = '';
      var tutionFee = '';
      var slectedPlan = $(".selectedPlan").val();
      var lunch = $("input:radio[name=lunch]:checked").val();
      if(lunch == 'Y'){
        lunchTableHeadr = '<td><strong>Lunch Programme</strong></td> <td>&nbsp;</td>';
        lunchTableBody = '<td>$'+ $(".mealPrice").text()  +' per Meal</td><td>+</td>';
        colspan = 9;
      }else{
        colspan = 7;
      }
      
    var numSelct = $('.selct').length; 
    var selectedWeek = $(".selct a").text();
    var mealPrice = $(".mealPrice").text();

    if(slectedPlan == 1){  
      if(numSelct >7){
        tutionFee = $(".moreThanSeven").text();
      }else{
        tutionFee = $(".SevenWeeks").text();
      }
     
      if(lunch == 'Y'){
        total+= (mealPrice*5)+parseInt(tutionFee);
      }else{
        total+= parseInt(tutionFee);
      }
      
    payble += total*numSelct;
    var htmlTable = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        htmlTable += '<thead><tr>\
                                <td><strong>Weeks</strong></td>\
                                <td><strong>Tution Fees</strong></td>\
                                <td>&nbsp;</td>\
                                '+lunchTableHeadr+'\
                                <td><strong>Before Care</strong></td>\
                                <td>&nbsp;</td>\
                                <td><strong>After Care</strong></td>\
                                <td>&nbsp;</td>\
                                <td><strong>Total</strong></td>\
                              </tr>\
                            </thead><tbody>';
       $(".selct.active").each(function(){  
        htmlTable += '<tr><td><strong>'+ $(this).text() +':</strong></td>\
                        <td>'+ tutionFee +'$</td>\
                        <td>+</td>\
                        '+ lunchTableBody +'\
                        <td>Included</td>\
                        <td>+</td>\
                        <td>Included</td>\
                        <td>=</td>\
                        <td>'+ total +'$</td></tr>';

       });                   
      /*for(i=1; i<=numSelct; i++){

          
      }*/
      htmlTable += '<tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Total :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                    <tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Payable :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                  </tbody>\</table>';

      $('.tableMain2').html(htmlTable);
      $(".payble").val(payble);
      $(".totalCalculation").toggle("slow");
      $(".selectDates").hide();
    }else if(slectedPlan == 2){
      var beforeCareHead = '';
      var beforeCareBody = '';
      var afterCareHead = '';
      var afterCareBody = '';
      var threeFullDays = $('input[name="threeFullDays"]:checked').val();
      if(threeFullDays == 'Y'){

        if(lunch == 'Y'){
           if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == true){
            tutionFee = parseInt($(".threeWeeks").text())+parseInt($(".totalPrice3 h6").text());
            beforeCareHead = '<td>&nbsp;</td><td><strong>Before Care</strong></td><td>&nbsp;</td>';
            beforeCareBody = '<td>Included</td><td>+</td>';
            afterCareHead = '<td><strong>After Care</strong></td><td>&nbsp;</td>';
            afterCareBody = '<td>Included</td><td>=</td>';
            colspan = 10;

        }else if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == false){
            tutionFee = parseInt($(".threeWeeks").text())+parseInt($(".totalPrice3 h6").text());
            beforeCareHead = '<td>&nbsp;</td><td><strong>Before Care</strong></td><td>&nbsp;</td>';
            beforeCareBody = '<td>Included</td><td>=</td>';
            colspan = 8;

        }else if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == true){
            tutionFee = parseInt($(".threeWeeks").text())+parseInt($(".totalPrice3 h6").text());
            afterCareHead = '<td>&nbsp;</td><td><strong>After Care</strong></td><td>&nbsp;</td>';
            afterCareBody = '<td>Included</td><td>=</td>';
            colspan = 8;
        }

           lunchTableHeadr = '<td>&nbsp;</td><td><strong>Lunch Programme</strong></td>';
           lunchTableBody = '<td>+</td><td>$'+ $(".mealPrice").text()  +' per Meal</td><td>+</td>';
           total+= mealPrice*3+tutionFee;
           payble += total*numSelct;
           var htmlTable = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
           htmlTable += '<thead><tr>\
                                <td><strong>Weeks</strong></td>\
                                <td><strong>Tution Fees</strong></td>\
                                <td><strong>Dates</strong></td>\
                                '+lunchTableHeadr+'\
                                '+ beforeCareHead +'\
                                '+ afterCareHead +'\
                                <td><strong>Total</strong></td>\
                              </tr>\
                            </thead><tbody>';
      $(".selct.active").each(function(){
          var nameIDs = $(this).parent().find('td.active.threeDayActive').map(function () {
            if(!$(this).hasClass('firstTd')){
              return this.innerText;
            }
          }).get().join(',');
          htmlTable += '<tr><td><strong>'+ $(this).text() +':</strong></td>\
                        <td>'+ tutionFee +'$</td>\
                        <td>'+ nameIDs +'</td>\
                        '+ lunchTableBody +'\
                        '+ beforeCareBody +'\
                        '+ afterCareBody +'\
                        <td>'+ total +'$</td></tr>';
      });
      htmlTable += '<tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Total :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                    <tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Payable :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                  </tbody>\</table>'; 
        }else{

          if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == true){
            tutionFee = parseInt($(".threeWeeks").text())+parseInt($(".totalPrice3 h6").text());
            beforeCareHead = '<td>&nbsp;</td><td><strong>Before Care</strong></td><td>&nbsp;</td>';
            beforeCareBody = '<td>+</td><td>Included</td>';
            afterCareHead = '<td><strong>After Care</strong></td><td>&nbsp;</td>';
            afterCareBody = '<td>+</td><td>Included</td><td>=</td>';
            colspan = 8;

        }else if($("input[name='threDaysB']").prop('checked') == true && $("input[name='threDaysA']").prop('checked') == false){
            tutionFee = parseInt($(".threeWeeks").text())+parseInt($(".totalPrice3 h6").text());
            beforeCareHead = '<td>&nbsp;</td><td><strong>Before Care</strong></td><td>&nbsp;</td>';
            beforeCareBody = '<td>+</td><td>Included</td><td>=</td>';
            colspan = 6;

        }else if($("input[name='threDaysB']").prop('checked') == false && $("input[name='threDaysA']").prop('checked') == true){
            tutionFee = parseInt($(".threeWeeks").text())+parseInt($(".totalPrice3 h6").text());
            afterCareHead = '<td>&nbsp;</td><td><strong>After Care</strong></td><td>&nbsp;</td>';
            afterCareBody = '<td>+</td><td>Included</td><td>=</td>';
            colspan = 6;
        }


           total+= tutionFee;
           payble += total*numSelct;
           var htmlTable = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        htmlTable += '<thead><tr>\
                                <td><strong>Weeks</strong></td>\
                                <td><strong>Tution Fees</strong></td>\
                                <td><strong>Dates</strong></td>\
                                '+ beforeCareHead +'\
                                '+ afterCareHead +'\
                                <td><strong>Total</strong></td>\
                              </tr>\
                            </thead><tbody>';
      $(".selct.active").each(function(){                        
          var dateIDs = $(this).parent().find('td.active.threeDayActive').map(function () {
            if(!$(this).hasClass('firstTd')){
              return this.innerText;
            }
          }).get().join(',');
          htmlTable += '<tr><td><strong>'+ $(this).text() +':</strong></td>\
                        <td>'+ tutionFee +'$</td>\
                        <td>'+ dateIDs +'</td>\
                        '+ beforeCareBody +'\
                        '+ afterCareBody +'\
                        <td>'+ total +'$</td></tr>';
      });
      htmlTable += '<tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Total :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                    <tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Payable :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                  </tbody>\</table>';
        }
        
      }else{
        tutionFee = parseInt($(".threeWeeks").text());
        if(lunch == 'Y'){
           lunchTableHeadr = '<td>&nbsp;</td><td><strong>Lunch Programme</strong></td>';
           lunchTableBody = '<td>+</td><td>$'+ $(".mealPrice").text()  +' per Meal</td><td>=</td>';
           total+= $(".mealPrice").text()*5+tutionFee;
           payble += total*numSelct;
           colspan = 6;
           var htmlTable = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
           htmlTable += '<thead><tr>\
                                <td><strong>Weeks</strong></td>\
                                <td><strong>Tution Fees</strong></td>\
                                <td><strong>Dates</strong></td>\
                                '+lunchTableHeadr+'\
                                <td>&nbsp;</td>\
                                <td><strong>Total</strong></td>\
                              </tr>\
                            </thead><tbody>';
      $(".selct.active").each(function(){                        
          var selectDate = $(this).parent().find('td.active.threeDayActive').map(function () {
            if(!$(this).hasClass('firstTd')){
              return this.innerText;
            }
          }).get().join(',');
          htmlTable += '<tr><td><strong>'+ $(this).text() +':</strong></td>\
                        <td>'+ tutionFee +'$</td>\
                        <td>'+ selectDate +'</td>\
                        '+ lunchTableBody +'\
                        <td>'+ total +'$</td></tr>';
      });
      htmlTable += '<tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Total :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                    <tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Payable :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                  </tbody>\</table>';
        }else{
           total+= tutionFee;
           payble += total*numSelct;
           colspan = 3;
           var htmlTable = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
           htmlTable += '<thead><tr>\
                                <td><strong>Weeks</strong></td>\
                                <td><strong>Tution Fees</strong></td>\
                                <td><strong>Dates</strong></td>\
                                <td><strong>Total</strong></td>\
                              </tr>\
                            </thead><tbody>';
      $(".selct.active").each(function(){                        
          var selDate = $(this).parent().find('td.active.threeDayActive').map(function () {
            if(!$(this).hasClass('firstTd')){
              return this.innerText;
            }
          }).get().join(',');

          htmlTable += '<tr><td><strong>'+ $(this).text() +':</strong></td>\
                        <td>'+ tutionFee +'$</td>\
                        <td>'+ selDate +'</td>\
                        <td>'+ total +'$</td></tr>';
      });
      //alert(selDate);
      htmlTable += '<tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Total :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                    <tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Payable :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                  </tbody>\</table>';
        }
         
      }

      $('.tableMain2').html(htmlTable);
      $(".payble").val(payble);
      $(".totalCalculation").toggle("slow");
      $(".selectDates").hide();


    }else if(slectedPlan == 3){
      var beforeCareHead = '';
      var beforeCareBody = '';
      tutionFee = parseInt($(".fiveHalfDayPrice").text());
      var totalTd = '';
      var careTd = '';
      var careAfterTd = '';
      var fiveHalfDay = $("input:radio[name=fiveHalfDay]:checked").val();

      if(fiveHalfDay == 'Y'){
        if($("input[name='fiveDaysHalf']").prop('checked') == true){
          tutionFee = tutionFee + parseInt($(".totalPrice5Half h6").text());
          if(lunch == 'Y'){
              beforeCareHead = '<td>&nbsp;</td><td><strong>Before Care</strong></td><td>&nbsp;</td>';
              beforeCareBody = '<td>Included</td><td>=</td>';
              lunchTableHeadr = '<td>&nbsp;</td><td><strong>Lunch Programme</strong></td>';
              lunchTableBody = '<td>+</td><td>$'+ $(".mealPrice").text()  +' per Meal</td><td>+</td>';
              total+= $(".mealPrice").text()*5+tutionFee;
              colspan = 7;
            }else{
              beforeCareHead = '<td>&nbsp;</td><td><strong>Before Care</strong></td><td>&nbsp;</td>';
              beforeCareBody = '<td>+</td><td>Included</td><td>=</td>';
              total+= tutionFee;
              colspan = 5;
            }
          }
      }
      if(fiveHalfDay == 'N'){
        tutionFee = parseInt($(".fiveHalfDayPrice").text());
        if(lunch == 'Y'){
              lunchTableHeadr = '<td>&nbsp;</td><td><strong>Lunch Programme</strong></td><td>&nbsp;</td>';
              lunchTableBody = '<td>+</td><td>$'+ $(".mealPrice").text()  +' per Meal</td><td>=</td>';
              total+= $(".mealPrice").text()*5+tutionFee;
              colspan = 5;
            }else{
              total+= tutionFee;
              colspan = 2;
            }
      }  
    payble += total*numSelct;
    var htmlTable = '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        htmlTable += '<thead><tr>\
                                <td><strong>Weeks</strong></td>\
                                <td><strong>Tution Fees</strong></td>\
                                '+lunchTableHeadr+'\
                                '+ beforeCareHead +'\
                                <td><strong>Total</strong></td>\
                              </tr>\
                            </thead><tbody>';
      $(".selct.active").each(function(){                        

          htmlTable += '<tr><td><strong>'+ $(this).text() +':</strong></td>\
                        <td>'+ tutionFee +'$</td>\
                        '+ lunchTableBody +'\
                        '+ beforeCareBody +'\
                        <td>'+ total +'$</td></tr>';
      });
      htmlTable += '<tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Total :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                    <tr>\
                      <td colspan="'+ colspan +'" style="text-align:right"><h5>Payable :</h5></td>\
                      <td><h5>'+ payble +'$</h5></td>\
                    </tr>\
                  </tbody>\</table>';

      $('.tableMain2').html(htmlTable);
      $(".payble").val(payble);
      $(".totalCalculation").toggle("slow");
      $(".selectDates").hide();

    }
  } 
  });
}

$(".prevSummerInfo").click(function(){
  $(".totalCalculation").hide();
  $(".selectDates").show();
});
$(".prevSummerStep").click(function(){
  nextTab(1,2);
});