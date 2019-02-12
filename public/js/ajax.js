/**
 * Localstorage
 */
if (!localStorage.getItem("first_time"))
{
    localStorage.setItem("firs_time", "1");
    localStorage.setItem("preview", "1");
    localStorage.setItem("watched", "0");
    localStorage.setItem("updater", "1");
    localStorage.setItem("quick_reply", "1");
}

/**
 * Quick Reply
 * @param showhide
 */

function qr(showhide) {

    if (showhide === "show") {
        $('#quick-reply').show();
        /* If the function is called with the variable 'show', show the login box */
        $("#post-create,#posted").clearForm();

        $('#msg').empty();

        var captcha = $('#captcha');
        captcha.html('');

        if (typeof grecaptcha !== 'undefined' && grecaptcha) grecaptcha.reset();

    } else if (showhide === "hide") {
        $('#quick-reply').hide();
        /* If the function is called with the variable 'hide', hide the login box */
        $("#post-create,#posted").clearForm();
        $("#post-msg").removeClass('has-error');
        $('#msg').empty();
        toastr.clear();

    }

}

/**
 * Settings
 * @param showhide
 */
function settings(showhide) {

    if (showhide === "show") {
        $('#settings').show();

    } else if (showhide === "hide") {
        $('#settings').hide();

    }

}

/*
 * Show Hide Video Player
 */
function video_player(showhide) {

    if (showhide === "show") {
        $('#video-player').show();

    } else if (showhide === "hide") {
        $('#video-player').hide();

    }

}

/*
 * jQuery Stuff
 */
$(function () {

    Notification.requestPermission();

    /*
     * Get post Hash
     */
    var hash = window.location.hash;


    if(hash){

        if($(hash).visible()) {
            $(hash).removeClass('newPostsMarker');
        }
    }


    /*
     * Back to Top
     */
    $('#go_to_top').ready(function () {
        $('#go_to_top').click(function () {
            $("html, body").animate({scrollTop: 0}, 500);
            return false;
        });
    });

    /*
     * Go to Bottom
     */
    $('#go_to_bottom').ready(function () {
        $('#go_to_bottom').click(function () {
            $("html, body").animate({scrollTop: $("#bottom").offset().top}, 500);
            return false;
        });
    });

    /*
     * Video Embed
     */
    function video_embed(path, type, embed_to, embed_close_btn_to, close_btn_html) {
        var html = "<video id='video-player' controls loop>";
        html += "<source src='" + path + "' type='" + type + "'/>";
        html += "</video>";

        $(embed_close_btn_to).html(close_btn_html);

        $(embed_to).html(html);

        return html;

    }

// Image Toggle
    $(document).on('click', '#image img,#image', function (e) {
        var _this = $(this);
        var current = _this.attr("src");
        var swap = _this.attr("data-src");

        $(this).toggleClass('expend');
        _this.attr('src', swap).attr("data-src", current);
    });


    $(document).on('click', '#video-image img', function (e) {
        var _this = $(this);
        var current = _this.attr("src");
        var swap = _this.attr("data-src");

        var video_path, video_type, embed_to, close_btn;
        video_type = _this.attr("data-type");

        video_path = _this.parent().parent().find("p.fileinfo a").attr("href");
        embed_to = _this.parent();
        close_btn = _this.parent().parent().find("p.fileinfo span.video_close");

        var close_btn_html = "[<a href='javascript:void(0)' class='close_video' data-pic='" + current + "' data-type='" + video_type + "'>Close Video</a>]";

        video_embed(video_path, video_type, embed_to, close_btn, close_btn_html);


    });

    $(document).on('click', '.close_video', function (e) {
        var _this = $(this);
        var img = _this.attr("data-pic");
        var pic_type = _this.attr("data-type");
        var embed_to = _this.parent().parent().parent().find("div#video-image");
        var html = '<img src="' + img + '" data-pic="video" data-type="' + pic_type + '" class="post-image img-responsive img-thumbnail">';
        $(embed_to).html(html);
        _this.parent().html("");
    });

    /* Search */

    $(".search").keyup(function () {
        var rex = new RegExp($(this).val(), 'i');
        $('.catalog').hide();
        $('.catalog').filter(function () {
            return rex.test($(this).text());
        }).show();
    });

    /* Quick Reply */
    $("#quick-reply").draggable({cursor: "move", containment: 'window', scroll: false, handle: ".title"});


    /* Highlight */
    function toggle_highlight() {
        var hash = window.location.hash; // Get Post Id

        $(hash).ready(function () {
            $(".reply").removeClass("highlight");
            $(hash).addClass("highlight");
        });
    }

    toggle_highlight();

    /*
    Catalog
    */

    $("#sort_by").on('change', function () {
        $('#Grid').mixItUp('sort', this.value);
    });

    $("#image_size").change(function () {
        var value = this.value, old;
        $(".grid-li").removeClass("grid-size-vsmall");
        $(".grid-li").removeClass("grid-size-small");
        $(".grid-li").removeClass("grid-size-large");
        $(".grid-li").addClass("grid-size-" + value);
    });

    $('#Grid').mixItUp({});

    /* Quote a Post */
    function quote_post(post_id) {
        var message_element = null;

        var x = document.querySelectorAll("[id='post-msg']"); // x is an array
        var firstElement = x[0]; // get first element
        var secondElement = x[1]; // get second elemen

        if ($(firstElement).visible(true)) {
            message_element = firstElement;
        } else {
            message_element = secondElement;
            $("#quick-reply").show();
        }
        if (message_element) {
            message_element.focus();
            message_element.value += '>>' + post_id + "\n";
        }
        return false;
    }

    $(document).on('click', 'a#quote_post', function (e) {
        var post_id = $(this).attr('rel');

        quote_post(post_id);

    });

    $(document).on('click', 'a#post-id', function (e) {
        var str = $(this).attr('href');
        $(str).toggleClass("highlight");
    });

    $(document).on('click', 'a#post-id', function (e) {
        var post_id = $(this).attr('rel');
        var str = $(this).attr('href');
        $(str).toggleClass("highlight");
    });

    /* Hover Quoted Post */
    $(function () {
        $("a.quote").hover(function () {
            //var div = $(t).parent().addClass('highlight');
            var str = $(this).attr('href');

            var post_id = 0;

            var op = $(str).hasClass("op");

            var quote_preview = $("div.quote-preview");

            if(op){
                quote_preview.addClass("reply");
            } else {
                quote_preview.removeClass("reply");
            }


            if ($(str).length > 0) {

                $(str).toggleClass("highlight");

                quote_preview.show();

                if (!$(str).visible(true)) {

                    var get_post_no = $(str).clone();

                    quote_preview.html(get_post_no);

                    quote_preview.css({
                        left: $(this).offset().left + 'px',
                        top: ($(this).offset().top + $(this).height() + 2) + 'px'
                    }).show();


                }
            } else {

                var b = $(this).attr('href').slice(1);
                post_id = b;

                if (post_id in cache) {
                    return $(".quote-preview").html(cache[post_id]);
                }
                else {
                    $.post(base_url + '/ajax/get_post/' + b, function (a) {
                        cache[post_id] = a.html;
                        $(".quote-preview").html(cache[post_id]);
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

    /* Report Posts */
    $(document).on('click', '#report', function (e) {
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

            function (inputValue) {
                if (inputValue === false) return false;

                if (inputValue === "") {
                    swal.showInputError("You need to write Reason!");
                    return false
                } else {
                    $.post(base_url + '/ajax/report', {post_id: post_id,reason: inputValue}, function (data) {

                        if (data.success) {

                            swal("Reported!", "This Post has been Reported. :)", "success");

                            $(elm).text("Reported");

                        } else {
                            swal("Reported!", "This Post is Already Reported.", "error");
                        }
                    }).fail(function () {
                        swal("Error!", "Unable to Report this Post'.", "error");
                    });
                }
            });

    });

    /* Delete Message */
    $("#delete").attr("disabled", true);
    $('input#delete-this').click(function () {
        $('#delete').attr('disabled', !this.checked)
    });

    /* Delete Message */
    $(document).on('click', '#delete', function (e) {

        var checkedValues = $('#posts_list input:checkbox:checked').map(function () {
            return this.value;
        }).get();


        var post_id = typeof checkedValues === '' ? false : checkedValues;

        if (post_id.length !== 0) {
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
                function (isConfirm) {
                    if (isConfirm) {

                        var url = $("#ajax-delete").attr("data-href");

                        $.post(url, {post_id: post_id}, function (data) {

                            if (data.success) {

                                $("input#delete-this").attr('checked', false);

                                swal("Deleted!", "Your Message has been deleted. :)", "success");

                                location.reload();

                            } else {

                                if (data.msg) {
                                    swal("Deleted!", data.msg, "error");
                                } else {
                                    swal("Deleted!", "Your Message can't be deleted.", "error");
                                }
                            }
                        }).fail(function () {
                            swal("Error!", "Your Message can't be deleted.", "error");
                        });
                    } else {
                        swal("Cancelled", "Your Message is safe :)", "error");
                    }
                });
        } else {
            swal("Error", "Please select messages!", "error");
        }


    });


    /*
    Auto Update
     */
    var auto = $('input#auto');
    var auto_updater;
    var timer = $('span#timer');
    function myTimer(set){
        var n = [5,10,15,20,25,30,60,90,120]; // Available Timer Intervals
        var rand = Math.floor(Math.random()*n.length); // Random Number for Choosing Intervals
        var default_interval = n[0];
        var c =  (set) ? default_interval : n[rand];
        auto_updater = setInterval(function(){
            if(c>=0){
                timer.text(c);
            }
            c--;
            if(c===-1){
                timer.text('Updating...');
                clearInterval(auto_updater);

                /*
                 * Get Last Post to get new posts
                 */
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
                }).fail(function (data) {
                    timer.text("An Error Occurred");
                    }
                );
            }
        },1000);
    }

    $(document).on('change', "#auto", function (e) {
        if (this.checked) {
            auto.prop('checked', true);
            myTimer(1);
        }
        else {
            auto.prop('checked', false);
            clearInterval(auto_updater);
            $('span#timer').text("");
        }
    });

    /* Refresh Posts */
    $(document).on('click', '#refresh', function (e) {

        var ids = new Array();
        $('[id="post-id"]').each(function (e) { //Get elements that have an id=
            ids.push($(this).attr("rel")); //add id to array
        });

        var last_post_id = ids.slice(-1)[0];

        var url = $("#ajax-loader").attr("data-href");

        $('span#timer').text('Updating...');

        $.getJSON(url + '?post_id=' + last_post_id, function (e) {

            if (e.success) {

                $.each(e.posts, function (i, b) {

                    if ($.inArray(b.id, ids) === -1) {
                        $("#posts_list").append(b.html);

                        window.location.href = '#' + b.id;

                        toggle_highlight();
                    }

                });

            } else {
                $('span#timer').text(e.msg);
            }

        }).done(function () {

            clearTimeout(auto_updater);

            var auto_checked = $("#auto").is(':checked');
            if (auto_checked) {
                myTimer();
            }

        });

    }); // Refresh End

    /*
     * Emoji List
     */
    if($("textarea").length){
        $.getJSON(base_url + '/ajax/emoji', function(jsonData) {
            $("textarea").suggest(':', {
                data: jsonData,
                map: function (emoji) {
                    text = '<span class="twa twa-2x twa_' + emoji.code + '"></span> <strong>' + emoji.text + '</strong>';
                    return {
                        value: emoji.value.slice(1),
                        text: text
                    }
                }

            });
        });
    }

    /* Post a Reply */

    $("#post-create,#posted").ajaxForm({
        beforeSubmit: function () {
            $('#msg').html('Posting...');
            notification("Posting...");
            return true;
        },
        clearForm: false,
        success: function (data) {

            if (!data) {
                $('#msg').html("<div id='error-msg'><span class='icon-cross'></span> Something went Wrong please try again later</div>");
                notification("<div id='error-msg'><span class='icon-cross'></span> Something went Wrong please try again later</div>");
                return false;
            }


            var success_template = "<div id='success-msg'><span class='icon-ok'></span> " + data.msg + " </div>";
            var error_template = "<div id='error-msg'><span class='icon-cross'></span> " + data.msg + " </div>";

            if (data.success) {

                $('#msg').html(success_template);

                notification(data.msg,"Success!","success");

                if (data.thread_url) {

                    return setTimeout(function () {
                        window.location.href = data.thread_url;
                    }, 5000);
                }

                var ids = new Array();
                $('[id="post-id"]').each(function () { //Get elements that have an id=
                    ids.push($(this).attr("rel")); //add id to array
                });


                var last_post_id = ids.slice(-1)[0];


                var url = $("#ajax-loader").attr("data-href");

                $.getJSON(url + "?post_id=" + last_post_id, function (e) {

                    if (e.success) {

                        qr("hide");

                        $.each(e.posts, function (i, b) {

                            if ($.inArray(b.id, ids) === -1) {
                                $("#posts_list").append(b.html);

                                window.location.href = '#' + b.id;

                                document.getElementById('pc' + b.id).scrollIntoView();

                                toggle_highlight();

                            }

                        });

                        setTimeout(function () {
                            $('#msg').hide()
                        }, 5000);
                    }

                });


            } else {
                $('#msg').html(error_template);
                notification(data.msg,"Error!","error");

                var captcha = $('#captcha');
                captcha.html('');

                if (typeof grecaptcha !== 'undefined' && grecaptcha) grecaptcha.reset();

            }

        },
        error: function (data) {

            var oh = data.responseText;

            $('#msg').html(oh.msg);

            notification(oh.msg,"Error!","error");

            var captcha = $('#captcha');
            captcha.html('');
        }
    });

    function notification(body,title,msg_type) {

        if(!msg_type){
            msg_type = "success";
        }

        if(!title){
            title = "Sending data...";
        }

        var options = {
            body: body
        };

        var n = new Notification(title,options);
		setTimeout(n.close.bind(n), 4000);

        toastr.options = {
            "timeOut": "0",
            "extendedTimeOut": "0",
            "positionClass": "toast-top-left",
            "closeButton": true,
            "preventDuplicates": true
        };

        toastr.clear();

        toastr[msg_type](body,title);
    }

});


// Add BBCodes
function formatText(tag) {

    var message_element = null;

    var x = document.querySelectorAll("[id='post-msg']"); // x is an array
    var firstElement = x[0]; // get first element
    var secondElement = x[1]; // get second elemen

    if ($(firstElement).visible(true)) {
        message_element = firstElement;
        document.getElementById("quick-reply").style.display = 'none';
    } else {
        message_element = secondElement;
    }

    var Field = message_element;
    var val = Field.value;
    var selected_txt = val.substring(Field.selectionStart, Field.selectionEnd);
    var before_txt = val.substring(0, Field.selectionStart);
    var after_txt = val.substring(Field.selectionEnd, val.length);
    var tag_text = '[' + tag + ']' + selected_txt + '[/' + tag + ']';
    Field.value = val.replace(selected_txt, tag_text.trim());
}