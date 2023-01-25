$(".generalDatepicker").datepicker({
    dateFormat: 'dd/mm/yy',
    maxDate: '0',
    autoclose: true,
    changeMonth: false,
    changeYear: false,
});
$(".newDatepicker").datepicker({
    dateFormat: 'dd/mm/yy',
    minDate: '0',
    autoclose: true,
    changeMonth: false,
    changeYear: false,
});
$(".childDatepicker").datepicker({
    dateFormat: 'dd/mm/yy',
    autoclose: true,
    changeMonth: true,
    changeYear: true,
    onSelect: function() {
        $(".eroVisit").css("display", "none");
      }
});