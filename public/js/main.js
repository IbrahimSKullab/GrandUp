/*------------- #General --------------*/

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
});




$('a[href="#"]').click(function ($) {
        $.preventDefault();
    });


var loading_delay = 500,
    more_loading_delay = 1000;


/*------------- #loading functions --------------*/

$('.loading-btn').each(function(){
    
    var btn = $(this);
    btn.on("click" , function(){
        
        
        btn.addClass('loading-overlay');
        setTimeout(function() {
          btn.removeClass('loading-overlay');
          btn.toggleClass('active');
          if(btn.hasClass('btn-cart')){

            btn.parents(".product-actions").toggleClass("cart-active");
          }
        
        }, loading_delay);

    });
    
});

$('.show-more-loading ').each(function(){
    
    var btn = $(this);
    btn.on("click" , function(){
        
        btn.addClass('active');
        setTimeout(function() {
          btn.removeClass('active')
        }, more_loading_delay);

    });
    
});


/*------------- #active_toggle_items--------------*/

$('.active_toggle_item').on('click' ,function(){
        
       let item = $(this),
           itemParent = $(this).closest(".active_toggle_items"),
           items = $('.active_toggle_item');
         
      if(itemParent.hasClass("only_active_item")){
          
          itemParent.find(items).not(item).removeClass("active");
          item.toggleClass("active");
          
      }else if(itemParent.hasClass("active_added_item")){
          
          item.addClass("active");
      }else{
          
          item.toggleClass("active");
      }
        
});
 

/*------------- #accordion   --------------*/

$(function(){
    
    
    $(".accordion-panels .panel-item .accordion_header").click(function(){
        
        let $items = $(this).closest(".accordion-panels.one-panel").find(".panel-item"),
            $parent = $(this).closest(".panel-item"),
            $body = $parent.find(".accordion_body");
        
        $(this).closest(".one-panel").find(".accordion_body").not($body).slideUp(300);
        $items.not($parent).removeClass('active');
        
        if($parent.hasClass("active")){
            
            $parent.removeClass("active ");
            $body.slideUp(300);
            
        }else{
            
             $parent.toggleClass("active");
             $body.slideToggle(300);
             
        }
       
		
  });
    
    
});


/*------------- #tabs functions --------------*/

$(function () {
    
    
	$(".tab-btn").click(function(){
  
        
        $(this).parent().find('.tab-btn').removeClass("active");
        $(this).addClass("active");
        var current_tab = $(this).attr("data-target");
        $(this).closest('.tabs-content-area').find('.tab-content').hide();        
        $("."+current_tab).fadeIn();
     
        
    });
});


/*------------- #panel-responsive-items --------------*/

$(function(){
    
    $(".panel-responsive-btn").click(function(){
        
        let current_item_attr = $(this).attr("data-target"),
            current_item = $(".panel-responsive-item."+current_item_attr);
            
        if($(this).hasClass("panel-responsive-open")){
            
            current_item.addClass("active");
            if(current_item.hasClass("noScroll")){
                
                $("body").attr("data-panel", "noScroll");
            }
            if(!current_item.hasClass("no-overlay")){
                
                $(".side-overlay").addClass("active");
            }
            
            
            
        }
        if($(this).hasClass("panel-responsive-close")){
            
            
          
            $(".panel-responsive-item").removeClass("active");
            $("body").removeAttr("data-panel"); 
            $(".side-overlay").removeClass("active");
            
            
        }
        
    });
    
    
});


/*------------- #toggle-modal-btn   --------------*/

$(".toggle-modal-btn").click(function(){
      
            var this_modal = $(this).closest('.custom-modal');
            $(this_modal).modal('hide');
      
});

$(".h-model").on('click' , function(){
    
        var current_model = $(this).attr("data-bs-target");
        
        if($(this).hasClass('with-delay')){
            
            setTimeout(function() {
             
                $(current_model ).modal('show');

            }, loading_delay);   

        }else{
            
            $(current_model ).modal('show');
        }
         
    });

/*------------- #Add Plus Minus Button To Input Number   --------------*/

$(function () {
    
    
     
    
    $(".count-wrap .count-btn").on("click" , function(){

    
        let $parent = $(this).closest(".product-actions"),
            input = $(this).closest(".count-wrap").find(".count-num"),
            plusBtn =  $(this).closest(".count-wrap").find(".count-add"),
            minusBtn = $(this).closest(".count-wrap").find(".count-sub"),
            notes = $(this).closest(".counter-wrap").find(".msg-error"),
            currentVal = parseInt(input.val()),
            type = $(this).attr('data-type');
        
        if (!isNaN(currentVal)) {
            
            if(type == 'minus') {

                if(currentVal > input.attr('min') ) {
                    input.val(currentVal - 1).change();
                } 
                if(currentVal == input.attr('min') && $(this).hasClass("step-btn") ) {
                    
                    let taht= $(this);
                    taht.addClass('loading-overlay');
                    setTimeout(function() {
                      taht.removeClass('loading-overlay');
                      $parent.removeClass("cart-active");
                      $parent.find(".btn-cart").removeClass("active");

                    }, loading_delay);
                    
                    
                }
                
                if(currentVal == (Number(input.attr('min') ) + 1) && $(this).hasClass("step-btn")) {
                    
                    $parent.removeClass('step2');
                }
                
                if(currentVal == input.attr('min') && !$(this).hasClass("step-btn") ) {
                    
                    $(this).addClass('disabled')
                    notes.show();
                }else{
                    
                    notes.hide();
                }
                
                
                
                plusBtn.removeClass('disabled');
                
            } 
            
            else if(type == 'plus') {

                
                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                
                if(currentVal == input.attr('min') && $(this).hasClass("step-btn")) {
                    
                    $parent.addClass('step2')
                    
                }
                
                if(currentVal == input.attr('max')) {
                    $(this).addClass('disabled');
                    notes.show();
                    
                }else{
                    
                    notes.hide();
                }
                
                    
                minusBtn.removeClass('disabled');
                
            }
            
            }else {
                
                input.val(0);
                
        }

       
    });
    
    $(".count-num").keydown(function (e) {
        
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             
            (e.keyCode == 65 && e.ctrlKey === true) || 
             
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 
                 return;
        }
        
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    $('.count-num').change(function (e) {
    
        e.preventDefault();
        let $parent = $(this).closest(".product-actions"),
            notes = $(this).closest(".counter-wrap").find(".msg-error"),
            plusBtn =  $(this).closest(".count-wrap").find(".count-add"),
            minusBtn = $(this).closest(".count-wrap").find(".count-sub"),
            minValue =  parseInt($(this).attr('min')),
            maxValue =  parseInt($(this).attr('max')),
            currentVal = parseInt($(this).val());
        
        if(currentVal >= minValue || currentVal <= maxValue){
            
            notes.hide();
        }
        
        
        if(currentVal > minValue && minusBtn.hasClass("step-btn")){
            
            $parent.addClass('step2');
        }else{
            
            $parent.removeClass('step2');
        }
                
        
         if(currentVal <= maxValue) {
            plusBtn.removeClass('disabled')
        } else {
            $(this).val(maxValue);
            notes.show();
        }

        
        if(currentVal >= minValue) {
            minusBtn.removeClass('disabled');
            
            
        } else {
            
           $(this).val(minValue);
            notes.show();
            
        }
       
      
    
    });
    
  
});


/*------------- #show and hide password   --------------*/
   
$('.password-field .eye-icon').on('click' , function(){
       
        
       var password_input = $(this).parent().find(".password-input");
         console.log(password_input);
         
       if(password_input.attr('type') === 'password'){
           
           password_input.attr('type' , 'text');
           $(this).addClass('hide');
           
       }else{
           
           password_input.attr('type' , 'password');
           $(this).removeClass('hide');
       }
          
          
    });


/*------------- #upload-img --------------*/

function readURL(input , img) {
  
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            img.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

var uploadInput = function(){
    
    $(".uploadWrapper .uploadInput").on("change" , function(){
    
        let input = $(this),
            parent = $(this).closest(".uploadWrapper"),
            img = $(this).closest(".uploadWrapper").find(".uploadImg");

            parent.addClass("active");
            readURL(this , img);

    });
    
}

$(".uploadWrapper .uploadBtn").on("click" , function(){
   
    uploadInput();
    
});


/*------------- #copied__viewbox--------------*/

var resultContainer = document.querySelectorAll(".copied__item");
resultContainer.forEach(items =>{
        
     items.addEventListener("click", () => {

        var textarea = document.createElement("textarea");
        textarea.readOnly = true;
        var element = items.innerText;
        textarea.value = element;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand("copy");
        textarea.remove();


     });
});
$('.copied__viewbox').on('click' ,function(){
        
        let copiedBox = $(this),
            confirmCopied = $(this).find('.confirm__copied');
    
        copiedBox.addClass("copied__done");
        confirmCopied.addClass('active');
        setTimeout(function() { 
            copiedBox.removeClass("copied__done");
            confirmCopied.removeClass('active');
        }, 1500);
        
});

/*------------- #checkOverflown--------------*/

$(function(){
    $('.scroll-list').each(function(){

        let item =$(this),
            scroll_width = $(this)[0].scrollWidth,
            client_width = $(this)[0].clientWidth;


        if(scroll_width > client_width){

            item.addClass("scrolled")
            
        }else{

            item.removeClass("scrolled");
            
        }
    });
});

/*------------- #draggable_lists--------------*/
        
const draggable_lists = document.querySelectorAll(".draggable-list");
draggable_lists.forEach(items =>{
        
        let mouseDown = false;
        let startX, scrollLeft;

        let startDragging = function (e) {
          mouseDown = true;
          startX = e.pageX - items.offsetLeft;
          scrollLeft = items.scrollLeft;
          items.style.cursor = 'move';


        };
        let stopDragging = function (event) {
          mouseDown = false;
          items.style.cursor = 'auto';
          items.classList.remove("move");
        };

        items.addEventListener('mousemove', (e) => {
          e.preventDefault();
          if(!mouseDown) { return; }
          const x = e.pageX - items.offsetLeft;
          const scroll = x - startX;
          items.scrollLeft = scrollLeft - scroll;
          items.classList.add("move");

        });


        items.addEventListener('mousedown', startDragging, false);
        items.addEventListener('mouseup', stopDragging, false);
        items.addEventListener('mouseleave', stopDragging, false);
                

             
});


/*------------- #star rating  --------------*/

$(".rateit.w-set").bind('rated', function (event,value) {

    $(this).parent().find('.rate-val').text(value);

});
$(".rateit.w-set").bind('over', function (event,value) {

    $(this).attr('title', value); 


});

$( ".add-rate-modal" ).on('shown.bs.modal', function(){
            $(".rateit.in-modal").rateit();
});
       

        
 
/*------------- # Fix 100vh viewport bug on mobile devices --------------*/

let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);
