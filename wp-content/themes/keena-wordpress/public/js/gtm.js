$(document).ready(function () {
    $('.page-id-279 #gallery-5 .gallery-text p:empty').remove();
    $('.page-id-279 .cs-locale').css('display', 'none');
    jQuery('a.dl-push').click(function (e) {
        dataLayer.push({
            'event': 'site_wide_clicks',
            'event_category': 'Site-wide Tracking',
            'event_action': 'Clicked "' + jQuery(this).text().trim() + '" button on ' + document.title.split(' ')[0] + ' page',
            'event_label': jQuery(this).text()
        });
    });

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

    if (window.location.href.indexOf("/keena-insights/") > -1) {

        // set gallery items to equal height
        var galleryParent = $('.page-id-279 #gallery-5')
        galleryParent.each(function () {
            var tallestHeight = 0;
            var sameHeightChildren = $(this).find(".card-sections");

            sameHeightChildren.each(function () {
                var thisHeight = $(this).height();

                if (thisHeight > tallestHeight) {
                    tallestHeight = thisHeight;
                }
            });
            sameHeightChildren.height(tallestHeight - 10);
        });

        function mobileResetPublications() {
            jQuery('.gallery-item-4').hide();
            jQuery('.gallery-item-5').hide();
            jQuery('.gallery-item-6').hide();
            jQuery('.gallery-item-7').hide();
            jQuery('.gallery-item-8').hide();
            jQuery('.gallery-item-9').hide();
        }

        function resetPublications() {
            jQuery('.gallery-item-10').hide();
            jQuery('.gallery-item-11').hide();
            jQuery('.gallery-item-12').hide();
            jQuery('.gallery-item-13').hide();
            jQuery('.gallery-item-14').hide();
            jQuery('.gallery-item-15').hide();
            jQuery('.gallery-item-16').hide();
            jQuery('.gallery-item-17').hide();
            jQuery('.gallery-item-18').hide();
            jQuery('.gallery-item-19').hide();
            jQuery('.gallery-item-20').hide();
            jQuery('.gallery-item-21').hide();
            jQuery('.gallery-item-22').hide();
            jQuery('.gallery-item-23').hide();
            jQuery('.gallery-item-24').hide();
            jQuery('.gallery-item-25').hide();
            jQuery('.gallery-item-26').hide();
            jQuery('.gallery-item-27').hide();
            jQuery('.gallery-item-28').hide();
            jQuery('.gallery-item-29').hide();
            jQuery('.gallery-item-30').hide();
            jQuery('.gallery-item-31').hide();
        }

        jQuery(window).on('load', function () {
            if (jQuery(window).width() < 768) {
                // mobileResetPublications();
                // resetPublications();
                jQuery('#clearSolutionsFilter').click(function () {
                    jQuery('.gallery-item').show();
                    // mobileResetPublications();
                    // resetPublications();
                    jQuery('#clearSolutionsFilter').css('opacity', '0');
                    jQuery('#solutionsDrop').text('Solution Types');
                });
            } else {
                // resetPublications();
                jQuery('#clearSolutionsFilter').click(function () {
                    jQuery('.gallery-item').show();
                    // resetPublications();
                    jQuery('#clearSolutionsFilter').css('opacity', '0');
                    jQuery('#solutionsDrop').text('Solution Types');
                });
            }
        });

        var solutionsMenu = $('#solutionsMenu');

        if (solutionsMenu) {
            solutionsMenu.children('li').click(function (e) {
                jQuery('#solutionsDrop').text(jQuery(this).text());
                jQuery('#clearSolutionsFilter').css('opacity', '1');
                var elText = $(this).text();
                e.preventDefault();

                switch (elText) {
                    // default: resetPublications();
                    case "System & Business Automation":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-11').show();
                        jQuery('.gallery-item-16').show();
                        break;
                    case "Data Analytics & Management":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-5').show();
                        jQuery('.gallery-item-6').show();
                        jQuery('.gallery-item-18').show();
                        break;
                    case "Conversion & Archival":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-2').show();
                        jQuery('.gallery-item-14').show();
                        jQuery('.gallery-item-15').show();
                        jQuery('.gallery-item-23').show();
                        jQuery('.gallery-item-7').show();
                        jQuery('.gallery-item-10').show();
                        jQuery('.gallery-item-24').show();
                        break;
                    case "Advisory Services":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-4').show();
                        break;
                    case "Patient Engagement":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-17').show();
                        break;
                    case "Workflow Efficiency":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-3').show();
                        jQuery('.gallery-item-5').show();
                        jQuery('.gallery-item-12').show();
                        jQuery('.gallery-item-13').show();
                        jQuery('.gallery-item-21').show();
                        jQuery('.gallery-item-23').show();
                        jQuery('.gallery-item-25').show();
                        jQuery('.gallery-item-27').show();
                        jQuery('.gallery-item-28').show();
                        jQuery('.gallery-item-29').show();
                        break;
                    case "Interfaces & Interoperability":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-1').show();
                        jQuery('.gallery-item-2').show();
                        jQuery('.gallery-item-19').show();
                        jQuery('.gallery-item-26').show();
                        break;
                    case "Population Health":
                        jQuery('.gallery-item').hide();
                        jQuery('.gallery-item-9').show();
                        jQuery('.gallery-item-22').show();
                        break;
                }
            });
        }
    }

    if (window.location.href.indexOf("/partners/epic/") > -1) {

        // Get an array of all element heights
        var elementHeights = $('.gallery-item').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments
        // `apply` is equivalent to passing each height as an argument
        var maxHeight = Math.max.apply(null, elementHeights);

        // Set each height to the max height
        $('.gallery-item>div>div').height(maxHeight);

        // Get an array of all element heights
        var elementHeights2 = $('.card').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments
        // `apply` is equivalent to passing each height as an argument
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

        // Math.max takes a variable number of arguments
        // `apply` is equivalent to passing each height as an argument
        var maxHeight = Math.max.apply(null, elementHeights);

        // Set each height to the max height
        $('.service-gallery-item').height(maxHeight - 10);

        // Get an array of all element heights
        var elementHeights2 = $('.card').map(function () {
            return $(this).height();
        }).get();

        // Math.max takes a variable number of arguments
        // `apply` is equivalent to passing each height as an argument
        var maxHeight2 = Math.max.apply(null, elementHeights2);

        // Set each height to the max height
        $('.card').height(maxHeight2 + 15);
    }
})