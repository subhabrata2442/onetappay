function uploadChildPhoto(url='', className = '', childToken='', folderpath=''){
  $(className).on("click", function(){
    var progressbar = $('.progress-bar');
    var image = document.getElementById('childImg').files[0];
    var progress_bar_id     = '#progress-wrp';
    
    if(document.getElementById('childImg').files.length == 0){
      displayModal("<h2>Please select photo first.</h2>");
      return false;
    }
    $('.imgLoader').css('display','block');
  var data = new FormData();
  data.append('image', image);
  data.append('_token', childToken);

  $(progress_bar_id +" .progress-bar").css("width", "0%");
  $(progress_bar_id + " .progress-bar").text("0%");

  $.ajax({
    url: url,
    type: 'POST',
    dataType: 'json',
    data: data,  
    processData: false,
    contentType: false,
    cache: false,  
    xhr: function(){
  //upload Progress
  var xhr = $.ajaxSettings.xhr();
  if (xhr.upload) {
    xhr.upload.addEventListener('progress', function(event) {
      var percent = 0;
      var position = event.loaded || event.position;
      var total = event.total;
      if (event.lengthComputable) {
        percent = Math.ceil(position / total * 100);
      }
//update progressbar
$(progress_bar_id +" .progress-bar").css("width", + percent +"%");
$(progress_bar_id + " .progress-bar").text(percent +"%" + " Complete");
}, true);
  }
  return xhr;
},
mimeType:"multipart/form-data"
}).done(function(data){ //
  //console.log(data);
  $(".upPic img").attr("src", folderpath + '/' + data.message);
  //document.getElementById("childImg").value = null;
  $(".eroImg").css("display", "none");
  $('.imgLoader').css('display','none');
  $("input[name='oldImg']").val(' ');
});
});
}