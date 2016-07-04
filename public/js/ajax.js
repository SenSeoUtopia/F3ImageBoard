var cache = {};

var page_title =document.title;

function qr(showhide){
	
if(showhide == "show"){
$('#quick-reply').show(); /* If the function is called with the variable 'show', show the login box */
$("#post-create,#posted").clearForm();

$('#msg').empty();

var captcha = $('#captcha');
captcha.html('');

if(typeof grecaptcha !== 'undefined' && grecaptcha) grecaptcha.reset();

}else if(showhide == "hide"){
$('#quick-reply').hide(); /* If the function is called with the variable 'hide', hide the login box */
$("#post-create,#posted").clearForm();

$('#msg').empty();

} 

}


$(function(){

// Emoji
$('textarea').suggest(':', {
data: function(q) {
if (q && q.length > 1) {
return $.getJSON(base_url + "/ajax/emoji");
}
},
map: function(emoji) {
console.log(emoji);	
return { value: emoji.value, text: '<span class="twa twa-lg twa_'+emoji.code+'"></span> <strong>'+emoji.text+'</strong> ' }
}
});

if($('.gallery-img').length > 0){
$('.gallery-img').SimpleSlider();
}

if(typeof Dropzone !== 'undefined'){
Dropzone.autoDiscover = false;	
$("#post-create").dropzone({
paramName: "file",
hiddenInputContainer: "#file-uploader .addfile",
autoProcessQueue: false,
addRemoveLinks : true,
renderMethod: "prepend",
dictDefaultMessage: "Add Photo",
previewsContainer: "#file-uploader",
clickable : "#file-uploader .addfile",
previewTemplate: "<div class=\"pic dz-preview dz-file-preview\">\n  <div class=\"dz-image\"><img data-dz-thumbnail /></div>\n  <div class=\"dz-details\">\n    <div class=\"dz-size\"><span data-dz-size></span></div>\n    <div class=\"dz-filename\"><span data-dz-name></span></div>\n  </div>\n  <div class=\"dz-progress\"><span class=\"dz-upload\" data-dz-uploadprogress></span></div>\n  <div class=\"dz-error-message\"><span data-dz-errormessage></span></div>\n  <div class=\"dz-success-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Check</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<path d=\"M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" stroke-opacity=\"0.198794158\" stroke=\"#FFFFFF\" fill-opacity=\"0.816519475\" fill=\"#32A336\" sketch:type=\"MSShapeGroup\"></path>\n      </g>\n    </svg>\n  </div>\n  <div class=\"dz-error-mark\">\n    <svg width=\"54px\" height=\"54px\" viewBox=\"0 0 54 54\" version=\"1.1\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" xmlns:sketch=\"http://www.bohemiancoding.com/sketch/ns\">\n      <title>Error</title>\n      <defs></defs>\n      <g id=\"Page-1\" stroke=\"none\" stroke-width=\"1\" fill=\"none\" fill-rule=\"evenodd\" sketch:type=\"MSPage\">\n<g id=\"Check-+-Oval-2\" sketch:type=\"MSLayerGroup\" stroke=\"#FFFFFF\" stroke-opacity=\"0.198794158\" fill=\"#ff0000\" fill-opacity=\"0.816519475\">\n  <path d=\"M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z\" id=\"Oval-2\" sketch:type=\"MSShapeGroup\"></path>\n</g>\n      </g>\n    </svg>\n  </div>\n</div>",
RemoveLinkTemplate: "<div class=\"remove\" data-dz-remove><i class=\"icon-cross\"></i></div>",

init: function() {
var submitButton = document.querySelector(".post-btn");
myDropzone = this; // closure

submitButton.addEventListener("click", function() {
myDropzone.processQueue(); // Tell Dropzone to process all queued files.
});

}
});

}



var hash = window.location.hash; // Get Post Id

$(hash).ready(function(){
$(hash).addClass("highlight");
});

/* Style Sheet Switcher */
$('select#style').change(function(ev){

var current = $('link[rel="stylesheet"][data-theme]');

var style_url = base_url + "/style";

var new_style = $(this).val();

$.post(style_url,{style: new_style});

$(current).attr('href',base_url + '/css/' + new_style +'.css');
});	
	
var form = $("#posted");
var reply = $('#message');
var msg = $('#msg');

$("#quick-reply").draggable({ containment: 'window', scroll: false });

/* Threads Filters */

/* Search */

$("#menu .search .filter").keyup(function () {
var rex = new RegExp($(this).val(), 'i');
$('.thread').hide();
$('.thread').filter(function () {
return rex.test($(this).text());
}).show();
});


var post_id = $(this).attr('rel');


// Image Toggle
$(document).on('click','#image', function(e) {
 var _this = $(this);
 var current = _this.attr("src");
 var swap = _this.attr("data-src"); 
 $(this).toggleClass('expend');
 _this.attr('src', swap).attr("data-src",current);
});



/* Refresh Posts */
$(document).on('click','#refresh', function(e) {

var ids = new Array();
$('[id="post-id"]').each(function(e) { //Get elements that have an id=
ids.push($(this).attr("rel")); //add id to array
});

var last_post_id = ids.slice(-1)[0];



var url = $("#ajax-loader").attr("data-href");



$('span#timer').text('Updating...');

$.getJSON(url+'?post_id='+last_post_id,function(e){
	
if(e.success){
	
$.each(e.posts,function(i,b){

if($.inArray(b.id,ids) ==-1 ){
post_data(b);


window.location.href= '#'+ b.id;

}


// Update Reply Counter
$("#menu div.thread-stats span.reply").html(b.total_reply);
// Update Images Counter
$("#menu div.thread-stats span.images").html(b.total_images);

});

} else {
$('span#timer').text(e.msg);
}

}).complete(function(){
var get_timer = $('span#timer');
get_timer.text("");
clearTimeout(timer);

var auto_checked = $("#auto").is(':checked');
if(auto_checked){
myTimer();
}

});

}); // Refresh End

/* Post a Reply */

$("#post-create,#posted").ajaxForm({
beforeSubmit: function (){

if(!$("#post-msg").val().length > 0){

alert("Message is required.");

$("#post-msg").addClass('has-error');

return false;
}

msg.html('Posting...');
return true;
},
clearForm: true,
success: function(data) {
	
if(!data){
msg.html("Something went Wrong please try again later.");

return false;
}
	
	
var success_template = "<div id='success-msg'><span class='icon-ok'></span> "+ data.msg+" </div>";
var error_template = "<div id='error-msg'><span class='icon-cross'></span> "+ data.msg+" </div>";

if (data.success) {
	
msg.html(success_template);	

var ids = new Array();
$('[id="post-id"]').each(function() { //Get elements that have an id=
ids.push($(this).attr("rel")); //add id to array
});


var last_post_id = ids.slice(-1)[0];


var url = $("#ajax-loader").attr("data-href");

$.getJSON(url+"?post_id="+last_post_id,function(e){

if(e.success){
	
qr("hide");	

$.each(e.posts,function(i,b){

if($.inArray(b.id,ids) ==-1 ){
post_data(b);


window.location.href= '#'+ b.id;

}


// Update Reply Counter
$("#menu div.thread-stats span.reply").html(b.total_reply);
// Update Images Counter
$("#menu div.thread-stats span.images").html(b.total_images);

});

}

});


setTimeout(function(){
msg.hide()
}, 10000);
} else {
msg.html(error_template);

var captcha = $('#captcha');
captcha.html('');

if(typeof grecaptcha !== 'undefined' && grecaptcha) grecaptcha.reset();

}

},
error: function(data) {

var oh = data.responseText;
	
msg.html(oh.msg);
var captcha = $('#captcha');
captcha.html('');
}
}); 

/* Auto Update */
var auto = $('input#auto');
var timer = '';
function myTimer() {
var sec = 15;
clearInterval(timer);
timer = setInterval(function() { 
$('span#timer').text("in " + sec-- + " secs");
if (sec == -1) {
$('span#timer').text('Updating...');
clearInterval(timer);

var ids = new Array();
$('[id="post-id"]').each(function() { //Get elements that have an id=
ids.push($(this).attr("rel")); //add id to array
});


var last_post_id = ids.slice(-1)[0];

var url = $("#ajax-loader").attr("data-href");

$.getJSON(url+"?post_id="+last_post_id,function(e){

if(e.success){
	
$.each(e.posts,function(i,b){

if($.inArray(b.id,ids) ==-1 ){
post_data(b);


window.location.href= '#'+ b.id;

}


// Update Reply Counter
$("#menu div.thread-stats span.reply").html(b.total_reply);
// Update Images Counter
$("#menu div.thread-stats span.images").html(b.total_images);

});

}

}).done(function( data ) {
myTimer();
});

} 
} , 1000);
}

$(document).on('change',"#auto", function(e) {
if(this.checked) {
auto.prop('checked', true);
myTimer();
}
else {
auto.prop('checked', false);
clearInterval(timer);
$('span#timer').text("");
}
});

/* Quote a Post */
function quote_post(post_id) {
var message_element = document.getElementById("post-msg");
if (message_element) {
message_element.focus();
message_element.value += '>>' + post_id + "\n";
}
return false;
}

$(document).on('click','a#quote_post', function(e) {
var post_id = $(this).attr('rel');

$("#quick-reply").show();

quote_post(post_id);
});


$(document).on('click','a#post-id', function(e) {
var post_id = $(this).attr('rel');
var str = $(this).attr('href');
$(str).toggleClass("highlight");
});

/* Hover Quoted Post */
$(function(){
$("a.quote").hover(function () {
//var div = $(t).parent().addClass('highlight');
var str = $(this).attr('href');

var post_id = 0;

$(str).toggleClass("highlight");

if ($(str).length > 0) {

$("div.quote-preview").show('fast');

if (!$(str).visible(true)) {

var get_post_no = $(str).clone();

$("div.quote-preview").append(get_post_no);

$('div.quote-preview').css({
left: $(this).offset().left + 'px',
top: ($(this).offset().top + $(this).height() + 2) + 'px'
}).show();


} 
}else {
	
var b = $(this).attr('href').slice(1);
post_id = b;

if(post_id in cache){
return pop_up_info(cache[post_id]);
}
else{
$.post(base_url +'/ajax/get_post', {"post_id": b }, function(a) {
cache[post_id] = a;
pop_up_info(cache[post_id]);
});
}

$('div.quote-preview').css({
left: $(this).offset().left + 'px',
top: ($(this).offset().top + $(this).height() + 2) + 'px'
}).show();

}


}, function () {
var str = $(this).attr('href');
$(str).removeClass("highlight");
$('div.quote-preview').empty();
$('div.quote-preview').hide('fast');
});
});

/* oEmbed */
$(function(){
var video_check = $("a#embed");
if(video_check.length > 0) {
$("#embed").ready(function(){
$("#embed").oembed();
})
}
});

/* Report Posts */
$(document).on('click','#report', function(e) {
var post_id = $(this).attr('rel');
var elm = $(this);

swal({
title: "Are you sure?",
text: "This Post will be Marked as Reported. \n Note: Don't Report Legit Posts otherwise you will get Ban.'",
type: "input",
showCancelButton: true,
confirmButtonClass: "btn-danger",
closeOnConfirm: false,
animation: "slide-from-top",
inputPlaceholder: "Reason"
},

function(inputValue){
if (inputValue === false) return false;

if (inputValue === "") {
swal.showInputError("You need to write Reason!");
return false
} else {
$.post(base_url + '/ajax/report',{post_id : post_id },function(data){

if(data.success) {

$("input#delete-this").attr('checked', false);

swal("Reported!", "This Post has been Reported. :)", "success");

$(elm).text("Reported");

} else {
swal("Reported!", "This Post is Already Reported.", "error");	
}
}).fail(function(){
swal("Error!", "Unable to Report this Post'.", "error");	
});	
}
});

});


/* Delete Message */
$("#delete").attr("disabled", true);
$('input#delete-this').click(function(){
$('#delete').attr('disabled',!this.checked)
});

/* Delete Message */
$(document).on('click','#delete', function(e) {

var checkedValues = $('input:checkbox:checked').map(function() {
return this.value;
}).get();	


var post_id = typeof checkedValues == '' ? false :checkedValues;

if(post_id.length !== 0) {
swal({
title: "Are you sure?",
text: "You will not be able to recover this Message!",
type: "warning",
showCancelButton: true,
confirmButtonClass: "btn-danger",
confirmButtonText: "Yes, delete it!",
cancelButtonText: "No, cancel plz!",
closeOnConfirm: false,
closeOnCancel: false
},
function(isConfirm) {
if (isConfirm) {
$.post( base_url + "/ajax/delete",{action:'delete',post_id: post_id}, function( data ) {

if(data.success) {

$("input#delete-this").attr('checked', false);

swal("Deleted!", "Your Message has been deleted. :)", "success");

location.reload();

} else {
swal("Deleted!", "Your Message cann't be deleted.", "error");	
}
}).fail(function(){
swal("Error!", "Your Message cann't be deleted.", "error");	
});
} else {
swal("Cancelled", "Your Message is safe :)", "error");
}
});
} else {
swal("Error", "Please select messages!", "error");
}



});




});

// Remove New Post from Title

var hash = window.location.hash;

$(hash).scroll(function (){
$(hash).ready(function(){
$(this).addClass('btn btn-success');
$(this).removeClass('newPostsMarker');
})
});


// PopUp Post
function pop_up_info(data) {
var html = '';
if (!data) {
html = "<h2>Information Not Available<h2>";
} else {
var html= '';

$.each(data,function(i,b){

if(b.country_flag) var country_flag = '<i class="country country-'+b.country_flag+'"></i>'; else var country_flag = '';
	
if(i == 0){
if(b.gallery){
html += '<div class="post reply" id="'+ b.id +'"><div class="post-header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="post-body"><div id="gallery">';

$.each(b.photos,function(i){

html += '<img id="image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" class="img-responsive img-thumbnail"> <span class="desc">'+b.post_content+'</span>';
});
html += '</div>'+b.post_content+'</div></div></div>';

} else {
html += '<div id="'+ b.id +'" class="postContainer opContainer"><div class="post op" id="'+ b.id +'"><div class="post-header"> File: <a href="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" title="'+b.original_name+'">'+ b.original_name +'</a> ('+b.size+' , '+b.pixels+')</div></div><div class="post-body op-body"><span class="op-img"><img id="image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" class="img-responsive img-thumbnail"/></span><div class="post-header"> <div id="'+ b.id +'"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> <span class="subject">'+b.thread_title+'</span><span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div>'+b.post_content+'</div></div><!-- post reply--></div>';	
}
} else {
if(b.gallery){
html += '<div class="post reply" id="'+ b.id +'"> <div class="post-header"><span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="post-body"><div id="gallery">';

$.each(b.photos,function(i){

html += '<span class="gallery-img"><img src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" class="gallery-img img-responsive img-thumbnail"> <span class="desc">'+b.post_content+'</span> </span>';
});
html += '</div>'+b.post_content+'</div></div></div>';

} else {
if(b.file_name) {
html += '<div class="post reply" id="'+ b.id +'"> <div class="post-header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'">' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span> <div class="post-header"> <div id="'+ b.id +'"> File: <a href="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" title="'+b.original_name+'">'+ b.original_name +'</a> ('+b.size+' , '+b.pixels+')</div></div><div class="post-body"><img id="image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" class="img-responsive img-thumbnail"/>'+b.post_content+'</div></div></div>';
} else {
html += '<div class="post reply" id="'+ b.id +'"> <div class="post-header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="post-body">'+b.post_content+'</div></div></div>';
}
}
}

});

$("div.quote-preview").show('fast');
$("div.quote-preview").append(html);

return html;
}
}

// Post generator
function post_data(b){ 
var html= ''; 
if(b.gallery){ 
var new_post = '<div class="post reply newPostsMarker" id="'+ b.id +'"><p class="intro"><div id="'+ b.id +'"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span><time class="tooltip" data-tooltip="' + b.post_time +'">' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div></p><div class="body"><div id="gallery">'; $.each(b.photos,function(i){ var file_data = '<b>File Name:</b> <a href='+base_url+' /uploads/ '+b.board_slug+'/ '+b.thread_id+'/ '+b.photos[i].file_name+' title='+b.photos[i].file_name+'>'+ b.photos[i].original_name +'</a><br>('+b.photos[i].size+' , '+b.photos[i].pixels+')<br> <b>Message</b> :'+b.post_content; new_post += '<span class="gallery-img"><img src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" class="img-responsive img-thumbnail"> <span class="desc">'+file_data+'</span> </span>'; }); new_post += '</div>'+b.post_content+'</div></div></div>'; 
} else { 
if(b.file_name) { 
var new_post = '<div class="post reply newPostsMarker" id="'+ b.id +'"><div class="intro"><div id="'+ b.id +'"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span><time class="tooltip" data-tooltip="' + b.post_time +'">' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="files"><div class="file"><div id="'+ b.id +'"> File: <a href="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" title="'+b.original_name+'">'+ b.original_name +'</a> ('+b.size+' , '+b.pixels+')</div></div></div><div class="body"><img id="image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" class="img-responsive img-thumbnail" />'+b.post_content+'</div></div></div>'; 
} else { 
var new_post = '<div class="post reply newPostsMarker" id="'+ b.id +'"><p class="intro"><div id="'+ b.id +'"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span><time class="tooltip" data-tooltip="' + b.post_time +'">' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div></p><div class="body">'+b.post_content+'</div></div></div>'; 
} 
} 
html += new_post; 
$("#posts_list").append(html); 
get_quote_by(); 
return html; 
}

// Board View
function board_view(data){
var html = '';

$.each(data,function(i,b){

html += '<div id="thread-'+b.thread_id+'" class="thread">';
html += '<a href="'+base_url+'/'+b.board_slug+'/thread/'+b.thread_id+'/'+b.thread_url_title+'">';
html += '<img class="thumb" src='+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'>';
html += '</a>';
html += '<div title="(R)eplies / (I)mages">R: <b>'+b.total_reply+'</b> / I: <b>'+b.total_images+'</b>';
html += '</div>';
html += '<div class="teaser">'+b.post_content+'</div></div>';

});

$("#threads").append(html);

get_quote_by();

return html;
}

// Thread Viewer
function thread_view(data){
var html= '';

$.each(data,function(i,b){

if(b.country_flag) var country_flag = '<i class="country country-'+b.country_flag+'"></i>'; else var country_flag = '';
	
if(i == 0){
if(b.gallery){
html += '<div class="post reply" id="'+ b.id +'"><div class="post-header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="post-body"><div id="gallery">';

$.each(b.photos,function(i){

html += '<img id="image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" class="img-responsive img-thumbnail"> <span class="desc">'+b.post_content+'</span>';
});
html += '</div>'+b.post_content+'</div></div></div>';

} else {
html += '<div id="'+ b.id +'" class="postContainer opContainer"><div class="fileinfo"><div class="file-header"> File: <a href="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" title="'+b.original_name+'">'+ b.original_name +'</a> ('+b.size+' , '+b.pixels+')</div><img id="image" class="post-image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'"/></div><div class="post-body op-body"><div class="header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> <span class="subject">'+b.thread_title+'</span><span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div>'+b.post_content+'</div><!-- post reply--></div>';
}
} else {
if(b.gallery){
html += '<div class="post reply" id="'+ b.id +'"> <div class="post-header"><span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="post-body"><div id="gallery">';

$.each(b.photos,function(i){

html += '<span class="gallery-img"><img src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.photos[i].file_name+'" class="gallery-img img-responsive img-thumbnail"> <span class="desc">'+b.post_content+'</span> </span>';
});
html += '</div>'+b.post_content+'</div></div></div>';

} else {
if(b.file_name) {
html += '<div class="post reply" id="'+ b.id +'"> <div class="post-header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'">' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span> <div class="post-header"> <div id="'+ b.id +'"> File: <a href="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" title="'+b.original_name+'">'+ b.original_name +'</a> ('+b.size+' , '+b.pixels+')</div></div><div class="post-body"><img id="image" src="'+base_url+'/thumb/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" data-src="'+base_url+'/uploads/'+b.board_slug+'/'+b.thread_id+'/'+b.file_name+'" class="img-responsive img-thumbnail"/>'+b.post_content+'</div></div></div>';
} else {
html += '<div class="post reply" id="'+ b.id +'"> <div class="post-header"> <span class="'+b.class_name+'"><input type="checkbox" value="'+ b.id +'" id="delete-this"> '+country_flag+' <span class="icon-user"></span> ' + b.post_by + ' </span> <span class="icon-history"></span> <time class="tooltip" data-tooltip="' + b.post_time +'" >' + b.ago_post_time +'</time> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">No.'+ b.id +'</a> <a href="#'+ b.id +'" id="post-id" rel="'+ b.id +'" class="btn btn-xs btn-success">Quote</a> <span id="report" rel="'+ b.id +'" class="btn btn-danger btn-xs">Report</span></div><div class="post-body">'+b.post_content+'</div></div></div>';
}
}
}

});

$("#posts_list").append(html);

get_quote_by();

return html;
}

// Get Quote posts
function get_quote_by() {
var allHtml = '';

var all_quotes = $("div.reply .body a.quote").sort(function(a,b){ return a-b;});
	
$(all_quotes).each(function (quoteIdx, quote) {
var quote_by = $(quote).parent().parent().attr('id');
var quote_post_id = $(quote).attr('href').slice(1);
var html = ' <a class="quote btn btn-success btn-xs" href="#' + quote_by + '">&gt;&gt;' + quote_by + '</a> ';
var html_quote_to = ' <a class="quote btn btn-success btn-xs" href="#' + quote_post_id + '">&gt;&gt;' + quote_post_id + '</a> ';
$("#posts_list").find('div#'+quote_post_id+' div.intro span#report').after(html);
allHtml += html;
});
return allHtml;
}

// Add BBCodes
function formatText(tag) {
   var Field = document.getElementById("post-msg");
   var val = Field.value;
   var selected_txt = val.substring(Field.selectionStart, Field.selectionEnd);
   var before_txt = val.substring(0, Field.selectionStart);
   var after_txt = val.substring(Field.selectionEnd, val.length);
   var tag_text ='[' + tag + ']'+selected_txt+'[/' + tag + ']'; 
   var replaced_text = val.replace(selected_txt,$.trim(tag_text));
   Field.value = replaced_text;
}

// Is Visible Plugin

(function(e){e.fn.visible=function(t,n,r){var i=e(this).eq(0),s=i.get(0),o=e(window),u=o.scrollTop(),a=u+o.height(),f=o.scrollLeft(),l=f+o.width(),c=i.offset().top,h=c+i.height(),p=i.offset().left,d=p+i.width(),v=t===true?h:c,m=t===true?c:h,g=t===true?d:p,y=t===true?p:d,b=n===true?s.offsetWidth*s.offsetHeight:true,r=r?r:"both";if(r==="both")return!!b&&m<=a&&v>=u&&y<=l&&g>=f;else if(r==="vertical")return!!b&&m<=a&&v>=u;else if(r==="horizontal")return!!b&&y<=l&&g>=f}})(jQuery);

// Underscore.js 1.8.3
// http://underscorejs.org
// (c) 2009-2015 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
// Underscore may be freely distributed under the MIT license.
(function(){function n(n){function t(t,r,e,u,i,o){for(;i>=0&&o>i;i+=n){var a=u?u[i]:i;e=r(e,t[a],a,t)}return e}return function(r,e,u,i){e=b(e,i,4);var o=!k(r)&&m.keys(r),a=(o||r).length,c=n>0?0:a-1;return arguments.length<3&&(u=r[o?o[c]:c],c+=n),t(r,e,u,o,c,a)}}function t(n){return function(t,r,e){r=x(r,e);for(var u=O(t),i=n>0?0:u-1;i>=0&&u>i;i+=n)if(r(t[i],i,t))return i;return-1}}function r(n,t,r){return function(e,u,i){var o=0,a=O(e);if("number"==typeof i)n>0?o=i>=0?i:Math.max(i+a,o):a=i>=0?Math.min(i+1,a):i+a+1;else if(r&&i&&a)return i=r(e,u),e[i]===u?i:-1;if(u!==u)return i=t(l.call(e,o,a),m.isNaN),i>=0?i+o:-1;for(i=n>0?o:a-1;i>=0&&a>i;i+=n)if(e[i]===u)return i;return-1}}function e(n,t){var r=I.length,e=n.constructor,u=m.isFunction(e)&&e.prototype||a,i="constructor";for(m.has(n,i)&&!m.contains(t,i)&&t.push(i);r--;)i=I[r],i in n&&n[i]!==u[i]&&!m.contains(t,i)&&t.push(i)}var u=this,i=u._,o=Array.prototype,a=Object.prototype,c=Function.prototype,f=o.push,l=o.slice,s=a.toString,p=a.hasOwnProperty,h=Array.isArray,v=Object.keys,g=c.bind,y=Object.create,d=function(){},m=function(n){return n instanceof m?n:this instanceof m?void(this._wrapped=n):new m(n)};"undefined"!=typeof exports?("undefined"!=typeof module&&module.exports&&(exports=module.exports=m),exports._=m):u._=m,m.VERSION="1.8.3";var b=function(n,t,r){if(t===void 0)return n;switch(null==r?3:r){case 1:return function(r){return n.call(t,r)};case 2:return function(r,e){return n.call(t,r,e)};case 3:return function(r,e,u){return n.call(t,r,e,u)};case 4:return function(r,e,u,i){return n.call(t,r,e,u,i)}}return function(){return n.apply(t,arguments)}},x=function(n,t,r){return null==n?m.identity:m.isFunction(n)?b(n,t,r):m.isObject(n)?m.matcher(n):m.property(n)};m.iteratee=function(n,t){return x(n,t,1/0)};var _=function(n,t){return function(r){var e=arguments.length;if(2>e||null==r)return r;for(var u=1;e>u;u++)for(var i=arguments[u],o=n(i),a=o.length,c=0;a>c;c++){var f=o[c];t&&r[f]!==void 0||(r[f]=i[f])}return r}},j=function(n){if(!m.isObject(n))return{};if(y)return y(n);d.prototype=n;var t=new d;return d.prototype=null,t},w=function(n){return function(t){return null==t?void 0:t[n]}},A=Math.pow(2,53)-1,O=w("length"),k=function(n){var t=O(n);return"number"==typeof t&&t>=0&&A>=t};m.each=m.forEach=function(n,t,r){t=b(t,r);var e,u;if(k(n))for(e=0,u=n.length;u>e;e++)t(n[e],e,n);else{var i=m.keys(n);for(e=0,u=i.length;u>e;e++)t(n[i[e]],i[e],n)}return n},m.map=m.collect=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=Array(u),o=0;u>o;o++){var a=e?e[o]:o;i[o]=t(n[a],a,n)}return i},m.reduce=m.foldl=m.inject=n(1),m.reduceRight=m.foldr=n(-1),m.find=m.detect=function(n,t,r){var e;return e=k(n)?m.findIndex(n,t,r):m.findKey(n,t,r),e!==void 0&&e!==-1?n[e]:void 0},m.filter=m.select=function(n,t,r){var e=[];return t=x(t,r),m.each(n,function(n,r,u){t(n,r,u)&&e.push(n)}),e},m.reject=function(n,t,r){return m.filter(n,m.negate(x(t)),r)},m.every=m.all=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=0;u>i;i++){var o=e?e[i]:i;if(!t(n[o],o,n))return!1}return!0},m.some=m.any=function(n,t,r){t=x(t,r);for(var e=!k(n)&&m.keys(n),u=(e||n).length,i=0;u>i;i++){var o=e?e[i]:i;if(t(n[o],o,n))return!0}return!1},m.contains=m.includes=m.include=function(n,t,r,e){return k(n)||(n=m.values(n)),("number"!=typeof r||e)&&(r=0),m.indexOf(n,t,r)>=0},m.invoke=function(n,t){var r=l.call(arguments,2),e=m.isFunction(t);return m.map(n,function(n){var u=e?t:n[t];return null==u?u:u.apply(n,r)})},m.pluck=function(n,t){return m.map(n,m.property(t))},m.where=function(n,t){return m.filter(n,m.matcher(t))},m.findWhere=function(n,t){return m.find(n,m.matcher(t))},m.max=function(n,t,r){var e,u,i=-1/0,o=-1/0;if(null==t&&null!=n){n=k(n)?n:m.values(n);for(var a=0,c=n.length;c>a;a++)e=n[a],e>i&&(i=e)}else t=x(t,r),m.each(n,function(n,r,e){u=t(n,r,e),(u>o||u===-1/0&&i===-1/0)&&(i=n,o=u)});return i},m.min=function(n,t,r){var e,u,i=1/0,o=1/0;if(null==t&&null!=n){n=k(n)?n:m.values(n);for(var a=0,c=n.length;c>a;a++)e=n[a],i>e&&(i=e)}else t=x(t,r),m.each(n,function(n,r,e){u=t(n,r,e),(o>u||1/0===u&&1/0===i)&&(i=n,o=u)});return i},m.shuffle=function(n){for(var t,r=k(n)?n:m.values(n),e=r.length,u=Array(e),i=0;e>i;i++)t=m.random(0,i),t!==i&&(u[i]=u[t]),u[t]=r[i];return u},m.sample=function(n,t,r){return null==t||r?(k(n)||(n=m.values(n)),n[m.random(n.length-1)]):m.shuffle(n).slice(0,Math.max(0,t))},m.sortBy=function(n,t,r){return t=x(t,r),m.pluck(m.map(n,function(n,r,e){return{value:n,index:r,criteria:t(n,r,e)}}).sort(function(n,t){var r=n.criteria,e=t.criteria;if(r!==e){if(r>e||r===void 0)return 1;if(e>r||e===void 0)return-1}return n.index-t.index}),"value")};var F=function(n){return function(t,r,e){var u={};return r=x(r,e),m.each(t,function(e,i){var o=r(e,i,t);n(u,e,o)}),u}};m.groupBy=F(function(n,t,r){m.has(n,r)?n[r].push(t):n[r]=[t]}),m.indexBy=F(function(n,t,r){n[r]=t}),m.countBy=F(function(n,t,r){m.has(n,r)?n[r]++:n[r]=1}),m.toArray=function(n){return n?m.isArray(n)?l.call(n):k(n)?m.map(n,m.identity):m.values(n):[]},m.size=function(n){return null==n?0:k(n)?n.length:m.keys(n).length},m.partition=function(n,t,r){t=x(t,r);var e=[],u=[];return m.each(n,function(n,r,i){(t(n,r,i)?e:u).push(n)}),[e,u]},m.first=m.head=m.take=function(n,t,r){return null==n?void 0:null==t||r?n[0]:m.initial(n,n.length-t)},m.initial=function(n,t,r){return l.call(n,0,Math.max(0,n.length-(null==t||r?1:t)))},m.last=function(n,t,r){return null==n?void 0:null==t||r?n[n.length-1]:m.rest(n,Math.max(0,n.length-t))},m.rest=m.tail=m.drop=function(n,t,r){return l.call(n,null==t||r?1:t)},m.compact=function(n){return m.filter(n,m.identity)};var S=function(n,t,r,e){for(var u=[],i=0,o=e||0,a=O(n);a>o;o++){var c=n[o];if(k(c)&&(m.isArray(c)||m.isArguments(c))){t||(c=S(c,t,r));var f=0,l=c.length;for(u.length+=l;l>f;)u[i++]=c[f++]}else r||(u[i++]=c)}return u};m.flatten=function(n,t){return S(n,t,!1)},m.without=function(n){return m.difference(n,l.call(arguments,1))},m.uniq=m.unique=function(n,t,r,e){m.isBoolean(t)||(e=r,r=t,t=!1),null!=r&&(r=x(r,e));for(var u=[],i=[],o=0,a=O(n);a>o;o++){var c=n[o],f=r?r(c,o,n):c;t?(o&&i===f||u.push(c),i=f):r?m.contains(i,f)||(i.push(f),u.push(c)):m.contains(u,c)||u.push(c)}return u},m.union=function(){return m.uniq(S(arguments,!0,!0))},m.intersection=function(n){for(var t=[],r=arguments.length,e=0,u=O(n);u>e;e++){var i=n[e];if(!m.contains(t,i)){for(var o=1;r>o&&m.contains(arguments[o],i);o++);o===r&&t.push(i)}}return t},m.difference=function(n){var t=S(arguments,!0,!0,1);return m.filter(n,function(n){return!m.contains(t,n)})},m.zip=function(){return m.unzip(arguments)},m.unzip=function(n){for(var t=n&&m.max(n,O).length||0,r=Array(t),e=0;t>e;e++)r[e]=m.pluck(n,e);return r},m.object=function(n,t){for(var r={},e=0,u=O(n);u>e;e++)t?r[n[e]]=t[e]:r[n[e][0]]=n[e][1];return r},m.findIndex=t(1),m.findLastIndex=t(-1),m.sortedIndex=function(n,t,r,e){r=x(r,e,1);for(var u=r(t),i=0,o=O(n);o>i;){var a=Math.floor((i+o)/2);r(n[a])<u?i=a+1:o=a}return i},m.indexOf=r(1,m.findIndex,m.sortedIndex),m.lastIndexOf=r(-1,m.findLastIndex),m.range=function(n,t,r){null==t&&(t=n||0,n=0),r=r||1;for(var e=Math.max(Math.ceil((t-n)/r),0),u=Array(e),i=0;e>i;i++,n+=r)u[i]=n;return u};var E=function(n,t,r,e,u){if(!(e instanceof t))return n.apply(r,u);var i=j(n.prototype),o=n.apply(i,u);return m.isObject(o)?o:i};m.bind=function(n,t){if(g&&n.bind===g)return g.apply(n,l.call(arguments,1));if(!m.isFunction(n))throw new TypeError("Bind must be called on a function");var r=l.call(arguments,2),e=function(){return E(n,e,t,this,r.concat(l.call(arguments)))};return e},m.partial=function(n){var t=l.call(arguments,1),r=function(){for(var e=0,u=t.length,i=Array(u),o=0;u>o;o++)i[o]=t[o]===m?arguments[e++]:t[o];for(;e<arguments.length;)i.push(arguments[e++]);return E(n,r,this,this,i)};return r},m.bindAll=function(n){var t,r,e=arguments.length;if(1>=e)throw new Error("bindAll must be passed function names");for(t=1;e>t;t++)r=arguments[t],n[r]=m.bind(n[r],n);return n},m.memoize=function(n,t){var r=function(e){var u=r.cache,i=""+(t?t.apply(this,arguments):e);return m.has(u,i)||(u[i]=n.apply(this,arguments)),u[i]};return r.cache={},r},m.delay=function(n,t){var r=l.call(arguments,2);return setTimeout(function(){return n.apply(null,r)},t)},m.defer=m.partial(m.delay,m,1),m.throttle=function(n,t,r){var e,u,i,o=null,a=0;r||(r={});var c=function(){a=r.leading===!1?0:m.now(),o=null,i=n.apply(e,u),o||(e=u=null)};return function(){var f=m.now();a||r.leading!==!1||(a=f);var l=t-(f-a);return e=this,u=arguments,0>=l||l>t?(o&&(clearTimeout(o),o=null),a=f,i=n.apply(e,u),o||(e=u=null)):o||r.trailing===!1||(o=setTimeout(c,l)),i}},m.debounce=function(n,t,r){var e,u,i,o,a,c=function(){var f=m.now()-o;t>f&&f>=0?e=setTimeout(c,t-f):(e=null,r||(a=n.apply(i,u),e||(i=u=null)))};return function(){i=this,u=arguments,o=m.now();var f=r&&!e;return e||(e=setTimeout(c,t)),f&&(a=n.apply(i,u),i=u=null),a}},m.wrap=function(n,t){return m.partial(t,n)},m.negate=function(n){return function(){return!n.apply(this,arguments)}},m.compose=function(){var n=arguments,t=n.length-1;return function(){for(var r=t,e=n[t].apply(this,arguments);r--;)e=n[r].call(this,e);return e}},m.after=function(n,t){return function(){return--n<1?t.apply(this,arguments):void 0}},m.before=function(n,t){var r;return function(){return--n>0&&(r=t.apply(this,arguments)),1>=n&&(t=null),r}},m.once=m.partial(m.before,2);var M=!{toString:null}.propertyIsEnumerable("toString"),I=["valueOf","isPrototypeOf","toString","propertyIsEnumerable","hasOwnProperty","toLocaleString"];m.keys=function(n){if(!m.isObject(n))return[];if(v)return v(n);var t=[];for(var r in n)m.has(n,r)&&t.push(r);return M&&e(n,t),t},m.allKeys=function(n){if(!m.isObject(n))return[];var t=[];for(var r in n)t.push(r);return M&&e(n,t),t},m.values=function(n){for(var t=m.keys(n),r=t.length,e=Array(r),u=0;r>u;u++)e[u]=n[t[u]];return e},m.mapObject=function(n,t,r){t=x(t,r);for(var e,u=m.keys(n),i=u.length,o={},a=0;i>a;a++)e=u[a],o[e]=t(n[e],e,n);return o},m.pairs=function(n){for(var t=m.keys(n),r=t.length,e=Array(r),u=0;r>u;u++)e[u]=[t[u],n[t[u]]];return e},m.invert=function(n){for(var t={},r=m.keys(n),e=0,u=r.length;u>e;e++)t[n[r[e]]]=r[e];return t},m.functions=m.methods=function(n){var t=[];for(var r in n)m.isFunction(n[r])&&t.push(r);return t.sort()},m.extend=_(m.allKeys),m.extendOwn=m.assign=_(m.keys),m.findKey=function(n,t,r){t=x(t,r);for(var e,u=m.keys(n),i=0,o=u.length;o>i;i++)if(e=u[i],t(n[e],e,n))return e},m.pick=function(n,t,r){var e,u,i={},o=n;if(null==o)return i;m.isFunction(t)?(u=m.allKeys(o),e=b(t,r)):(u=S(arguments,!1,!1,1),e=function(n,t,r){return t in r},o=Object(o));for(var a=0,c=u.length;c>a;a++){var f=u[a],l=o[f];e(l,f,o)&&(i[f]=l)}return i},m.omit=function(n,t,r){if(m.isFunction(t))t=m.negate(t);else{var e=m.map(S(arguments,!1,!1,1),String);t=function(n,t){return!m.contains(e,t)}}return m.pick(n,t,r)},m.defaults=_(m.allKeys,!0),m.create=function(n,t){var r=j(n);return t&&m.extendOwn(r,t),r},m.clone=function(n){return m.isObject(n)?m.isArray(n)?n.slice():m.extend({},n):n},m.tap=function(n,t){return t(n),n},m.isMatch=function(n,t){var r=m.keys(t),e=r.length;if(null==n)return!e;for(var u=Object(n),i=0;e>i;i++){var o=r[i];if(t[o]!==u[o]||!(o in u))return!1}return!0};var N=function(n,t,r,e){if(n===t)return 0!==n||1/n===1/t;if(null==n||null==t)return n===t;n instanceof m&&(n=n._wrapped),t instanceof m&&(t=t._wrapped);var u=s.call(n);if(u!==s.call(t))return!1;switch(u){case"[object RegExp]":case"[object String]":return""+n==""+t;case"[object Number]":return+n!==+n?+t!==+t:0===+n?1/+n===1/t:+n===+t;case"[object Date]":case"[object Boolean]":return+n===+t}var i="[object Array]"===u;if(!i){if("object"!=typeof n||"object"!=typeof t)return!1;var o=n.constructor,a=t.constructor;if(o!==a&&!(m.isFunction(o)&&o instanceof o&&m.isFunction(a)&&a instanceof a)&&"constructor"in n&&"constructor"in t)return!1}r=r||[],e=e||[];for(var c=r.length;c--;)if(r[c]===n)return e[c]===t;if(r.push(n),e.push(t),i){if(c=n.length,c!==t.length)return!1;for(;c--;)if(!N(n[c],t[c],r,e))return!1}else{var f,l=m.keys(n);if(c=l.length,m.keys(t).length!==c)return!1;for(;c--;)if(f=l[c],!m.has(t,f)||!N(n[f],t[f],r,e))return!1}return r.pop(),e.pop(),!0};m.isEqual=function(n,t){return N(n,t)},m.isEmpty=function(n){return null==n?!0:k(n)&&(m.isArray(n)||m.isString(n)||m.isArguments(n))?0===n.length:0===m.keys(n).length},m.isElement=function(n){return!(!n||1!==n.nodeType)},m.isArray=h||function(n){return"[object Array]"===s.call(n)},m.isObject=function(n){var t=typeof n;return"function"===t||"object"===t&&!!n},m.each(["Arguments","Function","String","Number","Date","RegExp","Error"],function(n){m["is"+n]=function(t){return s.call(t)==="[object "+n+"]"}}),m.isArguments(arguments)||(m.isArguments=function(n){return m.has(n,"callee")}),"function"!=typeof/./&&"object"!=typeof Int8Array&&(m.isFunction=function(n){return"function"==typeof n||!1}),m.isFinite=function(n){return isFinite(n)&&!isNaN(parseFloat(n))},m.isNaN=function(n){return m.isNumber(n)&&n!==+n},m.isBoolean=function(n){return n===!0||n===!1||"[object Boolean]"===s.call(n)},m.isNull=function(n){return null===n},m.isUndefined=function(n){return n===void 0},m.has=function(n,t){return null!=n&&p.call(n,t)},m.noConflict=function(){return u._=i,this},m.identity=function(n){return n},m.constant=function(n){return function(){return n}},m.noop=function(){},m.property=w,m.propertyOf=function(n){return null==n?function(){}:function(t){return n[t]}},m.matcher=m.matches=function(n){return n=m.extendOwn({},n),function(t){return m.isMatch(t,n)}},m.times=function(n,t,r){var e=Array(Math.max(0,n));t=b(t,r,1);for(var u=0;n>u;u++)e[u]=t(u);return e},m.random=function(n,t){return null==t&&(t=n,n=0),n+Math.floor(Math.random()*(t-n+1))},m.now=Date.now||function(){return(new Date).getTime()};var B={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#x27;","`":"&#x60;"},T=m.invert(B),R=function(n){var t=function(t){return n[t]},r="(?:"+m.keys(n).join("|")+")",e=RegExp(r),u=RegExp(r,"g");return function(n){return n=null==n?"":""+n,e.test(n)?n.replace(u,t):n}};m.escape=R(B),m.unescape=R(T),m.result=function(n,t,r){var e=null==n?void 0:n[t];return e===void 0&&(e=r),m.isFunction(e)?e.call(n):e};var q=0;m.uniqueId=function(n){var t=++q+"";return n?n+t:t},m.templateSettings={evaluate:/<%([\s\S]+?)%>/g,interpolate:/<%=([\s\S]+?)%>/g,escape:/<%-([\s\S]+?)%>/g};var K=/(.)^/,z={"'":"'","\\":"\\","\r":"r","\n":"n","\u2028":"u2028","\u2029":"u2029"},D=/\\|'|\r|\n|\u2028|\u2029/g,L=function(n){return"\\"+z[n]};m.template=function(n,t,r){!t&&r&&(t=r),t=m.defaults({},t,m.templateSettings);var e=RegExp([(t.escape||K).source,(t.interpolate||K).source,(t.evaluate||K).source].join("|")+"|$","g"),u=0,i="__p+='";n.replace(e,function(t,r,e,o,a){return i+=n.slice(u,a).replace(D,L),u=a+t.length,r?i+="'+\n((__t=("+r+"))==null?'':_.escape(__t))+\n'":e?i+="'+\n((__t=("+e+"))==null?'':__t)+\n'":o&&(i+="';\n"+o+"\n__p+='"),t}),i+="';\n",t.variable||(i="with(obj||{}){\n"+i+"}\n"),i="var __t,__p='',__j=Array.prototype.join,"+"print=function(){__p+=__j.call(arguments,'');};\n"+i+"return __p;\n";try{var o=new Function(t.variable||"obj","_",i)}catch(a){throw a.source=i,a}var c=function(n){return o.call(this,n,m)},f=t.variable||"obj";return c.source="function("+f+"){\n"+i+"}",c},m.chain=function(n){var t=m(n);return t._chain=!0,t};var P=function(n,t){return n._chain?m(t).chain():t};m.mixin=function(n){m.each(m.functions(n),function(t){var r=m[t]=n[t];m.prototype[t]=function(){var n=[this._wrapped];return f.apply(n,arguments),P(this,r.apply(m,n))}})},m.mixin(m),m.each(["pop","push","reverse","shift","sort","splice","unshift"],function(n){var t=o[n];m.prototype[n]=function(){var r=this._wrapped;return t.apply(r,arguments),"shift"!==n&&"splice"!==n||0!==r.length||delete r[0],P(this,r)}}),m.each(["concat","join","slice"],function(n){var t=o[n];m.prototype[n]=function(){return P(this,t.apply(this._wrapped,arguments))}}),m.prototype.value=function(){return this._wrapped},m.prototype.valueOf=m.prototype.toJSON=m.prototype.value,m.prototype.toString=function(){return""+this._wrapped},"function"==typeof define&&define.amd&&define("underscore",[],function(){return m})}).call(this);

/**
 *
 * jquery.charcounter.js version 1.2
 * requires jQuery version 1.2 or higher
 * Copyright (c) 2007 Tom Deater (http://www.tomdeater.com)
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */
 
(function($) {
/**
	 * attaches a character counter to each textarea element in the jQuery object
	 * usage: $("#myTextArea").charCounter(max, settings);
	 */
	
	$.fn.charCounter = function (max, settings) {
		max = max || 100;
		settings = $.extend({
			container: "<span></span>",
			classname: "charcounter",
			format: "(%1 characters remaining)",
			pulse: true,
			delay: 0
		}, settings);
		var p, timeout;
		
		function count(el, container) {
			el = $(el);
			if (el.val().length > max) {
			el.val(el.val().substring(0, max));
			if (settings.pulse && !p) {
				pulse(container, true);
			};
			};
			if (settings.delay > 0) {
				if (timeout) {
					window.clearTimeout(timeout);
				}
				timeout = window.setTimeout(function () {
					container.html(settings.format.replace(/%1/, (max - el.val().length)));
				}, settings.delay);
			} else {
				container.html(settings.format.replace(/%1/, (max - el.val().length)));
			}
		};
		
		function pulse(el, again) {
			if (p) {
				window.clearTimeout(p);
				p = null;
			};
			el.animate({ opacity: 0.1 }, 100, function () {
				$(this).animate({ opacity: 1.0 }, 100);
			});
			if (again) {
				p = window.setTimeout(function () { pulse(el) }, 200);
			};
		};
		
		return this.each(function () {
			var container;
			if (!settings.container.match(/^<.+>$/)) {
				// use existing element to hold counter message
				container = $(settings.container);
			} else {
				// append element to hold counter message (clean up old element first)
				$(this).next("." + settings.classname).remove();
				container = $(settings.container)
								.insertAfter(this)
								.addClass(settings.classname);
			}
			$(this)
				.unbind(".charCounter")
				.bind("keydown.charCounter", function () { count(this, container); })
				.bind("keypress.charCounter", function () { count(this, container); })
				.bind("keyup.charCounter", function () { count(this, container); })
				.bind("focus.charCounter", function () { count(this, container); })
				.bind("mouseover.charCounter", function () { count(this, container); })
				.bind("mouseout.charCounter", function () { count(this, container); })
				.bind("paste.charCounter", function () { 
					var me = this;
					setTimeout(function () { count(me, container); }, 10);
				});
			if (this.addEventListener) {
				this.addEventListener('input', function () { count(this, container); }, false);
			};
			count(this, container);
		});
	};

})(jQuery);


$(function() {
	
if(!is_logged_in){	
$("textarea").charCounter(max_char_limit,{container: "#counter,#char-left"});
} else {
$("textarea").charCounter(max_char_limit,{container: "#counter,#char-left"});	
}
});
