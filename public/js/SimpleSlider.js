/*
* jQuery Slider Plugin
* Version : SimpleSlider.js
* author  :amit & amar
* website :
* Date    :06-2-2014
 
* NOTE : "jQuery v1.8.2 used while developing"
*/

(function ($) {

    jQuery.fn.SimpleSlider = function () {
        //popup div
        $div = $('<div class="gallery-popup"> <div class="popup-overlay"></div> <div class="popup-content"> <div class="image"> <img id="gallery-img" src="" alt="" /> <div class="gallery-nav-btns"> <a id="nav-btn-next" class="nav-btn next" ></a> <a id="nav-btn-prev" class="nav-btn prev" ></a></div> </div><div class="information"> <p class="desc"></p></div> <div class="clear"></div><a href="javascript:void(0)" class="cross"><i class="icon-cross"></i></a></div></div>').appendTo('body');

        //on image click   
        $(this).click(function () {
		
		var img_src = $(this).attr('data-src');
		
		console.log(this);
		
            $('.gallery-popup').fadeIn(500);
            $('body').css({ 'overflow': 'hidden' });
            $('.popup-content .image img').attr('src', img_src);
            $('.popup-content .information p').html($(this).find('span.desc').html());
            $Current = $(this);
            $PreviousElm = $(this).prev();
            $nextElm = $(this).next();
            if ($PreviousElm.length === 0) { $('.nav-btn.prev').hide(); }
            else { $('.nav-btn.prev').show(); }
            if ($nextElm.length === 0) { $('.nav-btn.next').hide(); }
            else { $('.nav-btn.next').show() }
        });
        //on Next click
        $('.next').click(function () {
            $NewCurrent = $nextElm;
            $PreviousElm = $NewCurrent.prev();
            $nextElm = $NewCurrent.next();
            $('.popup-content .image img').clearQueue().animate({ opacity: '0' }, 0).attr('src', $NewCurrent.attr('data-src')).animate({ opacity: '1' }, 500);
          
          
            
            $('.popup-content .information p').html($NewCurrent.find('span.desc').html());
            if ($PreviousElm.length === 0) { $('.nav-btn.prev').hide(); }
            else { $('.nav-btn.prev').show(); }
            if ($nextElm.length === 0) { $('.nav-btn.next').hide(); }
            else { $('.nav-btn.next').show(); }
        });
        //on Prev click
        $('.prev').click(function () {
            $NewCurrent = $PreviousElm;
            $PreviousElm = $NewCurrent.prev();
            $nextElm = $NewCurrent.next();
            $('.popup-content .image img').clearQueue().animate({ opacity: '0' }, 0).attr('src', $NewCurrent.attr('data-src')).animate({ opacity: '1' }, 500);
            
            $('.popup-content .information p').html($NewCurrent.find('span.desc').html());
            if ($PreviousElm.length === 0) { $('.nav-btn.prev').hide(); }
            else { $('.nav-btn.prev').show(); }
            if ($nextElm.length === 0) { $('.nav-btn.next').hide(); }
            else { $('.nav-btn.next').show(); }
        });
        //Close Popup
        $('.cross,.popup-overlay').click(function () {
            $('.gallery-popup').fadeOut(500);
            $('body').css({ 'overflow': 'initial' });
        });

        //Key Events
        $(document).on('keyup', function (e) {
            e.preventDefault();
            //Close popup on esc
            if (e.keyCode === 27) { $('.gallery-popup').fadeOut(500); $('body').css({ 'overflow': 'initial' }); }
            //Next Img On Right Arrow Click
            if (e.keyCode === 39) { NextProduct(); }
            //Prev Img on Left Arrow Click
            if (e.keyCode === 37) { PrevProduct(); }
        });

        function NextProduct() {
            if ($nextElm.length === 1) {
                $NewCurrent = $nextElm;
                $PreviousElm = $NewCurrent.prev();
                $nextElm = $NewCurrent.next();
                $('.popup-content .image img').clearQueue().animate({ opacity: '0' }, 0).attr('src', $NewCurrent.attr('data-src')).animate({ opacity: '1' }, 500);
                
                $('.popup-content .information p').html($NewCurrent.find('span.desc').html());
                if ($PreviousElm.length === 0) { $('.nav-btn.prev').hide(); }
                else { $('.nav-btn.prev').show(); }
                if ($nextElm.length === 0) { $('.nav-btn.next').hide(); }
                else { $('.nav-btn.next').show(); }
            }

        }

        function PrevProduct() {
            if ($PreviousElm.length === 1) {
                $NewCurrent = $PreviousElm;
                $PreviousElm = $NewCurrent.prev();
                $nextElm = $NewCurrent.next();
                $('.popup-content .image img').clearQueue().animate({ opacity: '0' }, 0).attr('src', $NewCurrent.attr('data-src')).animate({ opacity: '1' }, 500);
        
                $('.popup-content .information p').html($NewCurrent.find('span.desc').html());
                if ($PreviousElm.length === 0) { $('.nav-btn.prev').hide(); }
                else { $('.nav-btn.prev').show(); }
                if ($nextElm.length === 0) { $('.nav-btn.next').hide(); }
                else { $('.nav-btn.next').show(); }
            }

        }
    };

} (jQuery));
