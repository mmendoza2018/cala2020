"use strict";
document.addEventListener("DOMContentLoaded", () => {
  $(($ => {

      // preloader
      setTimeout(function() {
        $('#preloader').fadeToggle();
      }, 2500);
      
      // Click to Scroll Top //
        const ScrollTop = $(".scrollToTop");
        $('.scrollToTop').on('click', function () {
          $('html, body').animate({
            scrollTop: 0
          }, 600);
          return false;
        });
        // Click to Scroll Top //

        //>> Aos Animation <<//
        $(document).ready(function () {
          $('.title').attr({
             "data-aos": "zoom-in",
             "data-aos-duration": "2000"
          });
      
          AOS.init({
            once: true,
          });
       });
        //>> Aos Animation <<//

      // Sticky Header //
        const fixed_top = $(".custom-fixed");
        if (fixed_top.data("active_scroll") == 1) {
        if ($(window).scrollTop() > 50) {
          fixed_top.addClass("animated fadeInDown header-fixed");
        }
        else {
          fixed_top.removeClass("animated fadeInDown header-fixed");
        }
      }
      // Sticky Header //
      
      // window on scroll function//
        $(window).on("scroll", function () {

          // Sticky Header//
          if (fixed_top.data("active_scroll") == 1) {
            if ($(window).scrollTop() > 50) {
              fixed_top.addClass("animated fadeInDown header-fixed");
            }
            else {
              fixed_top.removeClass("animated fadeInDown header-fixed");
            }
          }
          // Sticky Header//

          // Check Scroll //
          if ($(this).scrollTop() < 600) {
            ScrollTop.removeClass("active");
          } else {
            ScrollTop.addClass("active");
          }
          // Check Scroll //

        // Odometer Init 
          let windowHeight = $(window).height();
          $('.odometer').children().each(function () {
            if ($(this).isInViewport({ "tolerance": windowHeight, "toleranceForLast": windowHeight, "debug": false })) {
              var section = $(this).closest(".counters");
              section.find(".odometer").each(function () {
                $(this).html($(this).attr("data-odometer-final"));
              });
            }
          });
          //--Odometer--//

      });
      // window on scroll function//

      // magnific-popup//
        $('.popup-video').magnificPopup({
          type: 'iframe'
        });
      // magnific-popup//

      // gridGallery//
        $('.popup_img').magnificPopup({
            type:'image',
            gallery:{
                enabled:true
            }
        });
      // gridGallery//
      
      // Navbar Auto Active Class //
      var curUrl = $(location).attr('href');
      var terSegments = curUrl.split("/");
      var desired_segment = terSegments[terSegments.length - 1];
      var removeGarbage = desired_segment.split(".html")[0] + ".html";
      var checkLink = $('.menu-link a[href="' + removeGarbage + '"]');
      var targetClass = checkLink.addClass('active');
      targetClass.parents('.menu-item').addClass('active-parents');
      $('.active-parents > button').addClass('active'); 
      // Navbar Auto Active Class  //

      // navbar custom//
      $('.navbar-toggle-btn').on('click', function () {
        $('.navbar-toggle-item').slideToggle(300);
        $('body').toggleClass('overflow-hidden');
        $(this).toggleClass('open');
      });
      $('.menu-item button').on('click', function () {
        $(this).siblings("ul").slideToggle(300);
      });
      // navbar custom//

      // Password icon fill//
        document.querySelectorAll(".toggle-password").forEach(function(button) {
            button.addEventListener("click", function() {
                this.classList.toggle("fa-eye");
                this.classList.toggle("fa-eye-slash");
                var inputs = document.querySelectorAll(".password-field, .password-field2, .password-field3");
                inputs.forEach(function(input) {
                    if (input.type === "password") {
                        input.type = "text";
                    } else {
                        input.type = "password";
                    }
                });
            });
        });

      // banner car slide //
        var swiper = new Swiper(".banner-carslide-wrap", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 1000,
          navigation: {
            nextEl: ".swiper-button-prevteam",
            prevEl: ".swiper-button-nextteam",
          },
          autoplay: {
            delay: 1200,
          },
          breakpoints: {
            1400: {
                slidesPerView: 1,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //checkout car slide
        var swiper = new Swiper(".checkout-carslide-wrap", {
          loop: true,
          slidesPerView: 1,
          spaceBetween: 14,
          speed: 4500,
          autoplay: false,
          autoplay: {
            delay: 100,
          },
          pagination: {
            el: ".swiper-pagination-ch",
            clickable: true
          },
          breakpoints: {
            1400: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            992: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        
        // banner Bike one slide //
        var swiper = new Swiper(".banner-bikeslide-wrap", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 1000,
          navigation: {
            nextEl: ".swiper-button-prevteam",
            prevEl: ".swiper-button-nextteam",
          },
          autoplay: {
            delay: 1200,
            reverseDirection: true,
          },
          breakpoints: {
            1400: {
                slidesPerView: 1,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        // lottery service
        var swiper = new Swiper(".lottery-service-wrap", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 1500,
          navigation: {
            nextEl: ".swiper-button-prevteam",
            prevEl: ".swiper-button-nextteam",
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true
          },
          breakpoints: {
            1400: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //luxury bike-onefixed selection
        var swiper = new Swiper(".bike-onefixed", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 1500,
          navigation: {
            nextEl: ".swiper-button-prevteam",
            prevEl: ".swiper-button-nextteam",
          },
          pagination: {
            el: ".swiper-pagination",
            clickable: true
          },
          breakpoints: {
            1400: {
                slidesPerView: 3,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //luxury selection
        var swiper = new Swiper(".luxury-selectionwrap1", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 0,
          speed: 1500,
          navigation: {
            nextEl: ".luxury-prevteam",
            prevEl: ".luxury-nextteam",
          },
          breakpoints: {
            1400: {
                slidesPerView: 1
            },
            992: {
                slidesPerView: 1
            },
            768: {
                slidesPerView: 1
            },
            576: {
                slidesPerView: 1
            },
            500: {
              slidesPerView: 1
            },
        }
        });
        var swiper = new Swiper(".biggest-winner-sldewrap", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 0,
          speed: 1500,
          navigation: {
            nextEl: ".luxury-prevteam",
            prevEl: ".luxury-nextteam",
          },
            breakpoints: {
              1400: {
                  slidesPerView: 1
              },
              992: {
                  slidesPerView: 1
              },
              768: {
                  slidesPerView: 1
              },
              576: {
                  slidesPerView: 1
              },
              500: {
                slidesPerView: 1
              },
          }
        });
        //Bike Working win Slider
        var swiper = new Swiper(".bikeworking-wrap", {
          loop: false,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 50,
          direction: "vertical",
          autoHeight: true,
          mousewheel: true,
          speed: 1000,
          pagination: {
            el: ".swiper-pagination-workguide",
            clickable: true
          },
          autoplay: {
            delay: 3000,
          },
        });
        //bikeworking-wrap-howtoplay
        var swiper = new Swiper(".bikeworking-wrap-howtoplay", {
          loop: false,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 50,
          direction: "vertical",
          autoHeight: true,
          mousewheel: true,
          speed: 1000,
          pagination: {
            el: ".swiper-pagination-workguide",
            clickable: true
          },
          autoplay: {
            delay: 3000,
          },
        });
        //luxury selection
        var swiper = new Swiper(".testimonial-wrap1", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 4500,
          autoplay: true,
          centeredSlides: true,
          autoplay: {
            delay: 100,
          },
          pagination: {
            el: ".swiper-pagination-testi",
            clickable: true
          },
          breakpoints: {
            1600: {
                slidesPerView: 4.1,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3.5,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //testimonial v7
        var swiper = new Swiper(".testimonial-wrapv7", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 4500,
          autoplay: true,
          centeredSlides: true,
          autoplay: {
            delay: 100,
          },
          pagination: {
            el: ".swiper-pagination-testi",
            clickable: true
          },
          breakpoints: {
            1600: {
                slidesPerView: 5.5,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3.5,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //testimonial v8
        var swiper = new Swiper(".testimonial-wrapv8", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 4500,
          autoplay: true,
          centeredSlides: true,
          autoplay: {
            delay: 100,
          },
          pagination: {
            el: ".swiper-pagination-testi",
            clickable: true
          },
          breakpoints: {
            1600: {
                slidesPerView: 2.9,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 2.5,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //testimonial v11
        var swiper = new Swiper(".testimonial-wrapv11", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 4500,
          autoplay: true,
          centeredSlides: true,
          autoplay: {
            delay: 100,
          },
          pagination: {
            el: ".swiper-pagination-testi",
            clickable: true
          },
          breakpoints: {
            1600: {
                slidesPerView: 4,
                spaceBetween: 24,
            },
            1399: {
              slidesPerView: 4,
              spaceBetween: 14,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //Sponsor selection
        var swiper = new Swiper(".sponsor-wrap", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 4500,
          autoplay: true,
          centeredSlides: true,
          autoplay: {
            delay: 100,
          },
          breakpoints: {
            1600: {
                slidesPerView: 4,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 2,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 2,
              spaceBetween: 14,
            },
            0: {
              slidesPerView: 2,
              spaceBetween: 14,
            },
        }
        });
        //Testimonial unique
        var swiper = new Swiper(".testimonial-uniquewrap", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 2000,
          autoplay: false,
          pagination: {
            el: ".swiper-paginations",
            type: "fraction",
          },
          navigation: {
            nextEl: ".swiper-button-nextteam",
            prevEl: ".swiper-button-prevteam",
          },
          breakpoints: {
            1600: {
                slidesPerView: 1,
                spaceBetween: 24,
            },
            992: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            768: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 14,
            },
            500: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
            0: {
              slidesPerView: 1,
              spaceBetween: 14,
            },
        }
        });
        //banner Slide v6
        var swiper = new Swiper(".banner-v6wrap-slide", {
          loop: true,
          slidesPerView: 1,
          slidesToShow: 1,
          spaceBetween: 24,
          speed: 5000,
          autoplay: true,
          autoplay: {
            delay: 5000,
            reverseDirection: true,
          },
        });
        //checking slider
        var swiper = new Swiper(".mySwiper", {
          loop: true,
          spaceBetween: 10,
          slidesPerView: 1,
          watchSlidesProgress: true,
          allowTouchMove: false,
        });
        var swiper2 = new Swiper(".mySwiper2", {
          loop: true,
          spaceBetween: 10,
          navigation: {
            nextEl: ".swiper-button-nextteamjk",
            prevEl: ".swiper-button-prevteamjk",
          },
          thumbs: {
            swiper: swiper,
          },
        });
      // swipper slide //

      //--reply box--//
        $(".reply").on("click", function () {
          $(this).toggleClass("reply-active");
          $(this).parent().next(".reply__content").slideToggle();
        });
      //--reply box--//

      //--Copy Post--//
      var els_copy = document.querySelectorAll("[data-copy]");

      for (var i = 0; i < els_copy.length; i++) {
        var el = els_copy[i];
        el.addEventListener("submit", function(e) {
          e.preventDefault();
          var textInput = e.target.querySelector('input[type="text"]');
          textInput.select();
          document.execCommand("copy");
        });
      }
      //--Copy Post--//

      // Current Year//
        $(".currentYear").text(new Date().getFullYear());
      // Current Year//

        const texts = document.querySelectorAll(".text, .text2");
        texts.forEach(text => {
          if (text) {
            text.innerHTML = text.innerText
              .split("")
              .map(
                (char, i) => `<span style="display:inline-block; transform:rotate(${i * 14}deg)">${char}</span>`
              )
              .join("");
          } else {
            console.log("print");
          }
        });
      //text circle

      //propdown common lide//
        $('.dropdown-toggle').dropdown()
      //propdown common lide//

      //Tooptip//
      $('[data-toggle="tooltip"]').tooltip();   
      //Tooptip//

      // Mouse Follower //
      const follower = document.querySelector(".mouse-follower .cursor-outline");
      const dot = document.querySelector(".mouse-follower .cursor-dot");
      window.addEventListener("mousemove", (e) => {
        follower.animate(
          [
            {
              opacity: 1,
              left: `${e.clientX}px`,
              top: `${e.clientY}px`,
              easing: "ease-in-out"
            }
          ],
          {
            duration: 3000,
            fill: "forwards"
          }
        );
        dot.animate(
          [
            {
              opacity: 1,
              left: `${e.clientX}px`,
              top: `${e.clientY}px`,
              easing: "ease-in-out"
            }
          ],
          {
            duration: 1500,
            fill: "forwards"
          }
        );
      });

      //nice select
      //$('select').niceSelect();

      //Quantity 
      var inputs = document.querySelectorAll('.qtyInput, .qtyInput2, .qtyInput3');
      var btnminus = document.querySelectorAll('.qtyminus');
      var btnplus = document.querySelectorAll('.qtyplus');

      if (inputs.length > 0 && btnminus.length > 0 && btnplus.length > 0) {
        
        inputs.forEach(function(input, index) {
          var min = Number(input.getAttribute('min'));
          var max = Number(input.getAttribute('max'));
          var step = Number(input.getAttribute('step'));

          function qtyminus(e) {
            var current = Number(input.value);
            var newval = (current - step);
            if(newval < min) {
              newval = min;
            } else if(newval > max) {
              newval = max;
            } 
            input.value = Number(newval);
            e.preventDefault();
          }

          function qtyplus(e) {
            var current = Number(input.value);
            var newval = (current + step);
            if(newval > max) newval = max;
            input.value = Number(newval);
            e.preventDefault();
          }
            
          btnminus[index].addEventListener('click', qtyminus);
          btnplus[index].addEventListener('click', qtyplus);
        });
      }

      //Quantity 

      // Mouse Follower Hide Function //
      $("a, button").on('mouseenter mouseleave', function () {
        $('.mouse-follower').toggleClass('hide-cursor');
      });

      // Mouse Follower slider icon Function //
      const newElement = $('<i class="material-symbols-outlined fs-four"> arrow_range </i>');
      $(".slider-icon-area").on('mouseleave', function () {
        $('.mouse-follower').removeClass('slider-icon-active');
        newElement.remove();
      });
      $(".slider-icon-area").on('mouseenter', function () {
        $('.mouse-follower').addClass('slider-icon-active');
        $('.slider-icon-active .cursor-outline').append(newElement);
      });

      // Custom Tabs //
      $(".tablinks .nav-links").each(function () {
        var targetTab = $(this).closest(".singletab");
        targetTab.find(".tablinks .nav-links").each(function() {
          var navBtn = targetTab.find(".tablinks .nav-links");
          navBtn.click(function(){
            navBtn.removeClass('active');
            $(this).addClass('active');
            var indexNum = $(this).closest("li").index();
            var tabcontent = targetTab.find(".tabcontents .tabitem");
            $(tabcontent).removeClass('active');
            $(tabcontent).eq(indexNum).addClass('active');
          });
        });
      });
      // Custom Tabs //

      // tabLinks add active  //
      $('.tabLinks .nav-links').on('mouseenter', function () {
        $(this).addClass('active');
        $('.tabLinks .nav-links').not(this).removeClass('active');
      });
      // tabLinks add active  //

      // custom Accordion //
      $('.accordion-single .header-area').on('click', function () {
        if ($(this).closest(".accordion-single").hasClass("active")) {
          $(this).closest(".accordion-single").removeClass("active");
          $(this).next(".content-area").slideUp();
        } else {
          $(".accordion-single").removeClass("active");
          $(this).closest(".accordion-single").addClass("active");
          $(".content-area").not($(this).next(".content-area")).slideUp();
          $(this).next(".content-area").slideToggle();
        }
      });

    // count down timer
    function getTimeRemaining(endtime) {
      var t = Date.parse(endtime) - Date.parse(new Date());
      
      var seconds = Math.floor((t / 1000) % 60);
      var minutes = Math.floor((t / 1000 / 60) % 60);
      var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
      var days = Math.floor(t / (1000 * 60 * 60 * 24));
      
      return {
          'total': t,
          'days': days,
          'hours': hours,
          'minutes': minutes,
          'seconds': seconds
      };
    }

    // Display the clock and stop it when it reaches zero
    function initializeClock(id, endtime) {
      // var clock = document.getElementById(id);
      var clock = id;
      var daysSpan = clock.querySelector('.days');
      var hoursSpan = clock.querySelector('.hours');
      var minutesSpan = clock.querySelector('.minutes');
      var secondsSpan = clock.querySelector('.seconds');
      
      function updateClock() {
          var t = getTimeRemaining(endtime);
          
          daysSpan.innerHTML = t.days;
          hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
          minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
          secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
          
          if (t.total <= 0) {
              clearInterval(timeinterval);
          }
      }
      
      updateClock(); // Run function once at first to avoid delay
      var timeinterval = setInterval(updateClock, 1000);
    }

    // Set a valid end date 300 days from now
    let clockdiv = document.getElementById("clockdiv");
    let clockdiv2 = document.getElementById("clockdiv2");

      var deadline = new Date();
      deadline.setDate(deadline.getDate() + 300);
      if (clockdiv){
        initializeClock(clockdiv, deadline);
      }
      if (clockdiv2){
        initializeClock(clockdiv2, deadline);
      }

    }));
});




