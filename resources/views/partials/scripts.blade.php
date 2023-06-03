   
   <script src="{{asset("frontend/js/jquery-3.5.1.min.js")}}"></script>
   
   <script src="{{asset("frontend/js/bootstrap.bundle.min.js")}}"></script>

   <script src="{{asset("frontend/js/jquery.matchHeight-min.js")}}"></script>

   <script src="{{asset("frontend/js/swiper.js")}}"></script>

   <script src="{{asset("frontend/js/jquery.rateit.min.js")}}"></script>

   <script src="{{asset("frontend/js/main.js")}}"></script>

    <script>
        /*------------- #duplicated-products-slider  --------------*/
        $(function() {

            if (window.matchMedia('(min-width: 576px)').matches) {

                $(".duplicated-products-slider").each(function(index, element) {
                    var $this = $(this);
                    $this.addClass("instance-" + index);
                    $this.parent().find(".prev-btn").addClass("prev-btn-" + index);
                    $this.parent().find(".next-btn").addClass("next-btn-" + index);
                    var swiper = new Swiper(".instance-" + index, {

                        slidesPerView: 1,
                        spaceBetween: 24,
                        grabCursor: true,
                        a11y: false,
                        loop: false,
                        loopFillGroupWithBlank: false,
                        initialSlide: 0,
                        navigation: {

                            prevEl: ".prev-btn-" + index,
                            nextEl: ".next-btn-" + index,

                        },
                        breakpoints: {

                            576: {
                                slidesPerView: 2,
                                slidesPerGroup: 2,
                                spaceBetween: 16,
                            },
                            768: {
                                slidesPerView: 3,
                                slidesPerGroup: 3,
                                spaceBetween: 12,
                            },
                            992: {
                                slidesPerView: 3,
                                slidesPerGroup: 3,
                                spaceBetween: 16,
                            },

                            1024: {
                                slidesPerView: 4,
                                slidesPerGroup: 4,
                                spaceBetween: 16,
                            },

                            1200: {
                                slidesPerView: 4,
                                slidesPerGroup: 4,
                                spaceBetween: 24,
                            },

                        },


                    });

                });


            }

        });

        /*------------- #categories-slider  --------------*/
        function free_mode() {


            if ((window.matchMedia('(max-width: 575.98px)').matches) && $('.swiper').parents(".slider-container").hasClass("free-mode-slider")) {

                return true;
            } else {

                return false;
            }

        }
        $(function() {

            if (window.matchMedia('(min-width: 576px)').matches) {

                var swiper = new Swiper(".categories-slider", {

                    slidesPerView: 3,
                    spaceBetween: 12,
                    grabCursor: true,
                    a11y: false,
                    loop: false,
                    loopFillGroupWithBlank: false,
                    initialSlide: 0,
                    freeMode: free_mode(),
                    navigation: {

                        prevEl: ".categories-slider-container .prev-btn",
                        nextEl: ".categories-slider-container .next-btn",

                    },
                    breakpoints: {

                        0: {

                            slidesPerView: "auto",
                            spaceBetween: 0,
                            speed: 300,
                        },
                        576: {
                            slidesPerView: 6,
                            slidesPerGroup: 6,
                            spaceBetween: 12,

                        },
                        768: {
                            slidesPerView: 8,
                            slidesPerGroup: 8,
                            spaceBetween: 12,

                        },
                        992: {
                            slidesPerView: 10,
                            slidesPerGroup: 10,
                            spaceBetween: 12,
                        },
                        1200: {
                            slidesPerView: 12,
                            slidesPerGroup: 12,
                            spaceBetween: 12,
                        },
                        1400: {
                            slidesPerView: 14,
                            slidesPerGroup: 14,
                            spaceBetween: 12,
                        },

                    },


                });


            }

        });
    </script>