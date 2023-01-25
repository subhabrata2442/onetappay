$(document).ready(function() {

    /*
     * SUMMERNOTE EDITOR
     */
     var blankHTML = '';
    $('.summernote').summernote({
        height: 200,
        dialogsInBody: true,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'hr']],
            ['view', ['fullscreen', 'codeview', 'help']]

        ],
        enterHtml: '<p><i></i></p>',
        emptyPara: '' + blankHTML + '',
    });
});
var myText = $('#myField').summernote('isEmpty')? '' : $('#myField').summernote('code');
$('.summernote_add').summernote({
            height: 250,
            callbacks: {
                onChange: function (contents) {
                    if($('.summernote_add').summernote('isEmpty')){
                        $(".add .panel-body").html('');
                    }else{
                        $(".add .panel-body").val(contents);
                    }
                    //$('.summernote_add').val($('.summernote_add').summernote('isEmpty') ? null : contents);
                    summernoteValidatorAdd.element($('.summernote_add'));
                }
            }
        });