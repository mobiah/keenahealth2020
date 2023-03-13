$(document).ready(function () {
    $('.page-id-279 #gallery-5 .gallery-text p:empty').remove();
    $('.page-id-2188 #gallery-6 p:empty').remove();
    $('.page-id-2805 p:empty').remove();
    $('.pro-tip-info p:empty').remove();
    $('.page-id-279 .cs-locale').css('display', 'none');
    $('.read-more-journal br').remove();
    $('.journal-assortment p:empty').remove();

    // jQuery('.dl-push').click(function (e) {
    //     dataLayer.push({
    //         'event': 'site_wide_clicks',
    //         'event_category': 'Site-wide Tracking',
    //         'event_action': 'Clicked "' + jQuery(this).text().trim() + '" button on ' + document.title.split(' ')[0] + ' page',
    //         'event_label': jQuery(this).text()
    //     });
    // });


    // $('.insights-dl-push').click(function (e) {
    //     e.preventDefault();
    //     // this_text holds the insight type (brochure, case study, etc.)
    //     var this_text = jQuery(this).text().trim().split('READ ')[1];

    //     // event_label will hold the title of the insight
    //     var event_label = $(this).parent().parent().find('.title')[0].innerHTML.trim();
    //     console.log(event_label);
    //     // console.log($(this).parent().parent());

    //     // event_media will hold insight media attachment
    //     var event_media = $(this)[0].href;

    //     if (this_text && event_label && event_media) {
    //         dataLayer.push({
    //             'event': 'insight_click',
    //             'event_category': 'Insights Tracking',
    //             'event_action': 'Clicked the "' + event_label + '" ' + this_text + ' on ' + document.URL + ' page',
    //             'event_label': 'Attachment: ' + event_media
    //         });
    //     }
    // })

    if (window.location.href.indexOf("/ehr-barcode-reader/") > -1) {
        jQuery('a').click(function () {
            dataLayer.push({
                'event': 'keena_clicks',
                'event_category': 'Click Tracking',
                'event_action': 'Clicked "' + jQuery(this).text().trim() + '" button',
                'event_label': jQuery(this).text()
            });
        });
    }

    if ($('.fps')) {
        var galleryParent = $('.gallery-items');
        galleryParent.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".fps");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight + 30);
        });
    }

    if ($('.solutions-same-height')) {
        // set gallery items to equal height
        var galleryParent = $('.page-id-2805');
        galleryParent.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".solutions-same-height");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight + 20);
            $('.solutions-same-height.migration-callout-box').height(tallestHeight + 10);
        });
    }




    if (window.location.href.indexOf("/partners/epic/") > -1) {

        // Get an array of all element heights
        var elementHeights = $('.gallery-item').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments `apply` is equivalent to passing each height as an argument
        var maxHeight = Math.max.apply(null, elementHeights);

        // Set each height to the max height
        $('.gallery-item>div>div').height(maxHeight);

        // Get an array of all element heights
        var elementHeights2 = $('.card').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments `apply` is equivalent to passing each height as an argument
        var maxHeight2 = Math.max.apply(null, elementHeights2);

        // Set each height to the max height
        $('.card').height(maxHeight2 + 30);

        $('#full-width-4 .col-md-12').slick({
            dots: true,
            infinite: false,
            arrows: false,
            mobileFirst: true,
            autoplay: false,
            speed: 300,
            cssEase: 'ease',
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            ]
        });
    }

    if ($('.card-slider')) {
        jQuery('.card-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            infinite: false,
            mobileFirst: true,
            draggable: true,
            nextArrow: '<button type="button" class="slick-next article-slick-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev article-slick-prev"><i class="fas fa-chevron-left"></i></button>',
            dots: false,
            responsive: [{
                breakpoint: 1279,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
            ]
        });
    }

    if (window.location.pathname == "/") {
        // Get an array of all element heights
        var elementHeights = $('.gallery-item').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments `apply` is equivalent to passing each height as an argument
        var maxHeight = Math.max.apply(null, elementHeights);

        // Set each height to the max height
        $('.service-gallery-item').height(maxHeight - 10);

        // Get an array of all element heights
        var elementHeights2 = $('.card').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments `apply` is equivalent to passing each height as an argument
        var maxHeight2 = Math.max.apply(null, elementHeights2);

        // Set each height to the max height
        $('.card').height(maxHeight2 + 15);
    }

    if (window.location.href.indexOf("/allscripts-altera-bulletin/") > -1) {
        if ($('#gallery-2 .row.gallery-items')) {
            jQuery('#gallery-2 .row.gallery-items').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                arrows: true,
                infinite: false,
                mobileFirst: true,
                draggable: true,
                nextArrow: '<button type="button" class="slick-next article-slick-next bulletin-slick-arrow"><i class="fas fa-chevron-right"></i></button>',
                prevArrow: '<button type="button" class="slick-prev article-slick-prev bulletin-slick-arrow"><i class="fas fa-chevron-left"></i></button>',
                dots: false,
                responsive: [{
                    breakpoint: 1279,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }

                ]
            });
        }
    }

    $(window).resize(function () {

        var galleryParent = $('.specific-insights');
        galleryParent.each(function () {
            var tallestHeight = 0;

            var sameHeightChildren = $(this).find(".insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });

            sameHeightChildren.css('min-height', tallestHeight);
        });
    })

    if ($('#insightsDropdown')) {
        var filtered = false;
        var insights_remaining = 0;
        var insightsDropdown = $('#insightsDropdown');
        if (!insightsDropdown.length) {
            var galleryParent = $('.specific-insights');
            var class_to_filter = $('.specific-insights-title').text().split(' ').join('-').toLowerCase();

        } else {

            insightsDropdown.change(function () {
                var e = document.getElementById("insightsDropdown");
                var text = e.options[e.selectedIndex].text + " Insights";
                var insights_collected = $('.insights-blocks');

                insights_remaining = 0;

                placeholder_text = '';
                // if text equals the original option, display all insights blocks

                if (text === 'All Keena Insights Insights') {

                    for (var i = 0; i < insights_collected.length; i++) {
                        insights_collected[i].parentElement.style.display = 'block';
                    }
                    $('.no-insights p').text('');
                    $('.insights-blocks-container').slick('slickUnfilter');

                    // $('.all-insights-section>div').show();
                    $('.insights-whitepapers').show();
                    $('.insights-case-studies').show();
                    $('.insights-sales-sheets').show();
                    $('.insights-brochures').show();
                } else {
                    // format the class name so it matches the selected dropdown text
                    fixed_class_name = text.split(' ').join('-').toLowerCase();

                    $('.insights-blocks-container').slick('slickUnfilter');

                    $('.insights-blocks-container').slick('slickFilter', $('.' + fixed_class_name));

                    // case study check
                    if ($('.insights-case-studies .slick-track').children().length <= 0) {
                        $('.insights-case-studies').hide();
                    } else {
                        $('.insights-case-studies').show();
                    }

                    // whitepaper check
                    if ($('.insights-whitepapers .slick-track').children().length <= 0) {
                        $('.insights-whitepapers').hide();
                    } else {
                        $('.insights-whitepapers').show();
                    }

                    // sales sheet check
                    if ($('.insights-sales-sheets .slick-track').children().length <= 0) {
                        $('.insights-sales-sheets').hide();
                    } else {
                        $('.insights-sales-sheets').show();
                    }

                    // brochure check
                    if ($('.insights-brochures .slick-track').children().length <= 0) {
                        $('.insights-brochures').hide();
                    } else {
                        $('.insights-brochures').show();
                    }
                }
                caseStudiesSameHeight();
            }
            )
        }
    }

    if ($('.slick-true')) {
        // Prevents us from calling init twice
        jQuery('.slick-true').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            infinite: true,
            mobileFirst: true,
            nextArrow: '<button type="button" class="slick-next article-slick-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev article-slick-prev"><i class="fas fa-chevron-left"></i></button>',
            dots: false,
            responsive: [{
                breakpoint: 1279,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });
    }

    if ($('.home-insights')) {

        // Prevents us from calling init twice
        jQuery('.home-insights').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            infinite: false,
            mobileFirst: true,
            nextArrow: '<button type="button" class="slick-next article-slick-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev article-slick-prev"><i class="fas fa-chevron-left"></i></button>',
            dots: false,
            responsive: [{
                breakpoint: 1279,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });

        var case_study_top = $('.home-insights');
        case_study_top.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".home-insights-blocks .insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight);
        });
    }

    $('.read-more-journal').click(function () {
        var this_element_parent = this.parentElement;

        if (this_element_parent.classList.length > 1) {
            $('.one-off').css('visibility', 'visible');
            $('.journal-assortment>div').removeClass('active');
            $('.journal-assortment>div').addClass('inactive');
            for (var i = 0; i < this_element_parent.classList.length; i++) {
                this_element_parent.classList.remove('inactive');
                this_element_parent.classList.add('active');
            }
        }

    })

    if ($('.insights-blocks-container')) {
        // Prevents us from calling init twice
        jQuery('.insights-blocks-container').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            infinite: false,
            mobileFirst: true,
            nextArrow: '<button type="button" class="slick-next article-slick-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev article-slick-prev"><i class="fas fa-chevron-left"></i></button>',
            dots: false,
            responsive: [{
                breakpoint: 1279,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
            ]
        });
    }

    if ($('.specific-insights')) {
        var galleryParent = $('.specific-insights');
        var class_to_filter = $('.specific-insights-title').text().split(' ').join('-').toLowerCase();

        $('.insights-blocks.bc').each(function () {
            $(this).css('padding', '0');
        });

        $('.insights-blocks.bc .card-main').each(function () {
            $(this).css('padding', '15px 30px');
        });

        $('.insights-blocks.bc .card-bottom').each(function () {
            $(this).css('padding', '30px');
        });
    }

    // if ($('.insights').length) {
    //     if ($('.insights')[0].id !== 'solution-types-filter') {

    //         $('.insights-blocks-container').slick('slickFilter', $('.' + $('.insights')[0].id.split('-filter')[0] + "-insights"));

    //         // Once the specific insight is queried, hide the elements that don't have insights
    //         if ($('.cs-insights .slick-track').children().length <= 0) {
    //             $('.insights-case-studies').remove();
    //         }
    //         if ($('.wp-insights .slick-track').children().length <= 0) {
    //             $('.insights-whitepapers').remove();
    //         }
    //         if ($('.ss-insights .slick-track').children().length <= 0) {
    //             $('.insights-sales-sheets').remove();
    //         }
    //         if ($('.brochure-insights .slick-track').children().length <= 0) {
    //             $('.insights-brochures').remove();
    //         }

    //         if ($('.insights').children().length <= 0) {
    //             $('#no-insights-queried').css('padding-bottom', '30px');
    //             $('#no-insights-queried').append('<p>Sorry, no insights to show for this solution type.</p>');
    //         } else {
    //             $('#no-insights-queried').css('padding-bottom', '0');
    //             if ($('#no-insights-queried p')) {
    //                 $('#no-insights-queried p').remove();
    //             }
    //         }
    //     }
    // }

    if ($('.insights-grouped-slideshow')) {
        if ($('.insights-case-studies')) {

            var case_study_top = $('.insights-case-studies');
            case_study_top.each(function () {
                var tallestHeight = 0;
                var sameHeightChildren = $(this).find(".card-top");

                sameHeightChildren.each(function () {
                    var thisHeight = $(this).height();

                    if (thisHeight > tallestHeight) {
                        tallestHeight = thisHeight;
                    }
                });
                sameHeightChildren.height(tallestHeight);
            });

            var galleryParent = $('.insights-case-studies');
            galleryParent.each(function () {
                var tallestHeight = 0;
                var sameHeightChildren = $(this).find(".insights-blocks");

                sameHeightChildren.each(function () {
                    var thisHeight = $(this).height();

                    if (thisHeight > tallestHeight) {
                        tallestHeight = thisHeight;
                    }
                });
                sameHeightChildren.height(tallestHeight);
            });
        }

        var galleryParent2 = $('.insights-whitepapers');
        galleryParent2.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight);
        });

        var galleryParent3 = $('.insights-sales-sheets');
        galleryParent3.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight);
        });

        var galleryParent4 = $('.brochure-insights');
        galleryParent4.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight);
        });
    }

    if ($('.ins-sec')) {
        $('.ins-sec').css('visibility', 'visible');
    }

    if (document.getElementsByClassName("accordion")) {
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    }

    if (document.getElementsByClassName("leader-accordion")) {

        var acc = document.getElementsByClassName("leader-accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    }
    // Case Studies Same Height Function
    function caseStudiesSameHeight() {

        // $('.insights-case-studies .card-top').css('height', 'auto');
        // $('.insights-case-studies .insights-blocks').css('height', 'auto');
        // var case_study_top = $('.insights-case-studies');
        // case_study_top.each(function () {
        //     var tallestHeight = 0;
        //     var sameHeightChildren = $(this).find(".card-top");

        //     sameHeightChildren.each(function () {
        //         var thisHeight = $(this).height();

        //         if (thisHeight > tallestHeight) {
        //             tallestHeight = thisHeight;
        //         }
        //     });
        //     sameHeightChildren.height(tallestHeight);
        // });

        jQuery('.insights-blocks-container.cs-insights').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            infinite: false,
            mobileFirst: true,
            nextArrow: '<button type="button" class="slick-next article-slick-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev article-slick-prev"><i class="fas fa-chevron-left"></i></button>',
            dots: false,
            responsive: [{
                breakpoint: 1279,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            }
            ]
        });

        var galleryParent = $('.insights-case-studies');
        galleryParent.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight);
        });


    }

    if (document.querySelectorAll('a.read-more-journal')) {
        document.querySelectorAll('a.read-more-journal[href^="#"]').forEach(anchor => { anchor.addEventListener('click', function (e) { e.preventDefault(); document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' }); }); });
    }

    if (document.querySelectorAll('a.read-more-down-arrow')) {
        document.querySelectorAll('a.read-more-down-arrow[href^="#"]').forEach(anchor => { anchor.addEventListener('click', function (e) { e.preventDefault(); document.querySelector(this.getAttribute('href')).scrollIntoView({ behavior: 'smooth' }); }); });
    }

    if ($('.solutions-insights')) {

        // Prevents us from calling init twice
        jQuery('.solutions-insights-container').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            arrows: true,
            infinite: false,
            mobileFirst: true,
            nextArrow: '<button type="button" class="slick-next article-slick-next"><i class="fas fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev article-slick-prev"><i class="fas fa-chevron-left"></i></button>',
            dots: false,
            responsive: [{
                breakpoint: 1279,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });

        var custom_insights = $('.solutions-insights-container');

        custom_insights.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".solutions-insights .insights-blocks");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight + 20);
        });
    }
})

