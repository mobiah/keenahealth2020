$(document).ready(function () {
    $('.page-id-279 #gallery-5 .gallery-text p:empty').remove();
    $('.page-id-2188 #gallery-6 p:empty').remove();
    $('.page-id-2805 p:empty').remove();
    $('.pro-tip-info p:empty').remove();
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

    if ((window.location.href.indexOf("/ehr-migration-journal-collection/") > -1) || (window.location.href.indexOf("/ehr-migration-journal-4/") > -1)) {
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

    // Insights blocks same height
    // if ($('.solutions-same-height')) {
    //     // set gallery items to equal height
    //     var galleryParent = $('.page-id-2188 #gallery-4')
    //     galleryParent.each(function () {
    //         var tallestHeight = 0;
    //         var sameHeightChildren = $(this).find(".solutions-same-height");

    //         sameHeightChildren.each(function () {
    //             var thisHeight = $(this).height();

    //             if (thisHeight > tallestHeight) {
    //                 tallestHeight = thisHeight;
    //             }
    //         });
    //         sameHeightChildren.height(tallestHeight + 10);
    //     });
    // }


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

    // if ($('#clearSolutionsFilter')) {
    //     jQuery(window).on('load', function () {
    //         if (jQuery(window).width() < 768) {
    //             // mobileResetPublications();
    //             // resetPublications();
    //             jQuery('#clearSolutionsFilter').click(function () {
    //                 jQuery('.gallery-item').show();
    //                 // mobileResetPublications();
    //                 // resetPublications();
    //                 jQuery('#clearSolutionsFilter').css('opacity', '0');
    //                 jQuery('#solutionsDrop').text('Solution Types');
    //             });
    //         } else {
    //             // resetPublications();
    //             jQuery('#clearSolutionsFilter').click(function () {
    //                 jQuery('.gallery-item').show();
    //                 // resetPublications();
    //                 jQuery('#clearSolutionsFilter').css('opacity', '0');
    //                 jQuery('#solutionsDrop').text('Solution Types');
    //             });
    //         }
    //     });

    //     var solutionsMenu = $('#solutionsMenu');

    //     if (solutionsMenu) {
    //         solutionsMenu.children('li').click(function (e) {
    //             jQuery('#solutionsDrop').text(jQuery(this).text());
    //             jQuery('#clearSolutionsFilter').css('opacity', '1');
    //             var elText = $(this).text();
    //             e.preventDefault();

    //             switch (elText) {
    //                 // default: resetPublications();
    //                 case "System & Business Automation":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-11').show();
    //                     jQuery('.gallery-item-17').show();
    //                     break;
    //                 case "Data Analytics & Management":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-5').show();
    //                     jQuery('.gallery-item-6').show();
    //                     jQuery('.gallery-item-19').show();
    //                     break;
    //                 case "Conversion & Archival":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-2').show();
    //                     jQuery('.gallery-item-7').show();
    //                     jQuery('.gallery-item-10').show();
    //                     jQuery('.gallery-item-15').show();
    //                     jQuery('.gallery-item-16').show();
    //                     jQuery('.gallery-item-24').show();
    //                     jQuery('.gallery-item-25').show();
    //                     break;
    //                 case "Advisory Services":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-4').show();
    //                     jQuery('.gallery-item-14').show();
    //                     break;
    //                 case "Patient Engagement":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-18').show();
    //                     break;
    //                 case "Workflow Efficiency":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-3').show();
    //                     jQuery('.gallery-item-5').show();
    //                     jQuery('.gallery-item-12').show();
    //                     jQuery('.gallery-item-13').show();
    //                     jQuery('.gallery-item-22').show();
    //                     jQuery('.gallery-item-24').show();
    //                     jQuery('.gallery-item-26').show();
    //                     jQuery('.gallery-item-28').show();
    //                     jQuery('.gallery-item-29').show();
    //                     jQuery('.gallery-item-30').show();
    //                     break;
    //                 case "Interfaces & Interoperability":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-1').show();
    //                     jQuery('.gallery-item-2').show();
    //                     jQuery('.gallery-item-20').show();
    //                     jQuery('.gallery-item-27').show();
    //                     break;
    //                 case "Population Health":
    //                     jQuery('.gallery-item').hide();
    //                     jQuery('.gallery-item-9').show();
    //                     jQuery('.gallery-item-23').show();
    //                     break;
    //             }
    //         });
    //     }
    // }

    // Insights blocks filter
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

        // function mobileResetPublications() {
        //     // only show 3 on mobile on page load. this will be combined with resetPublications
        //     for (var i = 4; i < 10; i++) {
        //         jQuery(`.gallery-item-${i}`).hide();
        //     }
        // }

        // function resetPublications() {
        //     // hide all of the publications after displaying 9
        //     for (var i = 10; i < 32; i++) {
        //         jQuery(`.gallery-item-${i}`).hide();
        //     }
        // }

        // jQuery(window).on('load', function () {
        //     if (jQuery(window).width() < 768) {
        //         // mobileResetPublications();
        //         // resetPublications();
        //         jQuery('#clearSolutionsFilter').click(function () {
        //             jQuery('.gallery-item').show();
        //             // mobileResetPublications();
        //             // resetPublications();
        //             jQuery('#clearSolutionsFilter').css('opacity', '0');
        //             jQuery('#solutionsDrop').text('Solution Types');
        //         });
        //     } else {
        //         // resetPublications();
        //         jQuery('#clearSolutionsFilter').click(function () {
        //             jQuery('.gallery-item').show();
        //             // resetPublications();
        //             jQuery('#clearSolutionsFilter').css('opacity', '0');
        //             jQuery('#solutionsDrop').text('Solution Types');
        //         });
        //     }
        // });

        // var solutionsMenu = $('#solutionsMenu');

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

    if (window.location.href.indexOf("/bulletin-home/") > -1) {
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

    if ($('#insightsDropdown')) {
        var insights_remaining = 0;
        var insightsDropdown = $('#insightsDropdown');
        insightsDropdown.change(function () {
            var e = document.getElementById("insightsDropdown");
            var value = e.value;
            var text = e.options[e.selectedIndex].text;

            var insights_collected = $('.insights-blocks');

            insights_remaining = 0;

            // if text equals the original option, display all insights blocks
            if (text === 'Solution Types') {
                for (var i = 0; i < insights_collected.length; i++) {
                    insights_collected[i].parentElement.style.display = 'block';
                }
                $('#no-insights p').text('');
            } else {

                // else display all insights blocks based on selected option
                for (var i = 0; i < insights_collected.length; i++) {

                    // Loop through and hide all of the Insights blocks
                    insights_collected[i].parentElement.style.display = 'none';

                    for (var l = 0; l < Object.keys(insights_collected[i].dataset).length; l++) {
                        // Loop through the datasets display the ones with values that match the selected option
                        if (Object.values(insights_collected[i].dataset)[l].split('-').join(' ').includes(text)) {
                            insights_collected[i].parentElement.style.display = 'block';
                            insights_remaining++;
                        }
                    }
                }

                // pass the remaining insights to a function to check how many are in the array
                checkSize(insights_remaining);
            }

            // if none are in the array sent over, display a message to the users
            function checkSize(element) {
                if (element === 0) {
                    $('#no-insights p').text('Sorry, no insights to show for this group');
                    $('.insights-blocks-container.insights-grouped').addClass('empty-groups');
                } else {
                    $('#no-insights p').text('');
                    $('.insights-blocks-container.insights-grouped').removeClass('empty-groups');
                }
            }
        }
        )
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
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
            ]
        });
    }

    if ($('.insights-grouped-grid')) {
        var galleryParent = $('.insights-grouped-grid');
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

    if ($('.insights-grouped-slideshow')) {
        var galleryParent = $('.insights-grouped-slideshow');
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
})