<?php
if(!defined('ABSPATH')) {
    die();
}
?>
<style type="text/css">
    .days-of-week {
        margin-left: 5px;
    }

    .days-of-week li {
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 30px;;
        display: inline-block;
        margin-right: 10px;
        cursor: pointer;
        font-weight: bold;
        width: 38px;
        text-align: center;
        height: 16px;
        color: rgb(68,68,68);
        float: left;
    }

    .days-of-week li.selected {
        color: #fff;
        background-color: #425F9A;
        border-color: #585858;
    }

    #weekly, #monthly {
        height: 40px;
    }

    .timepicker {
        width: 100px;
        padding: 10px;
        border-radius: 5px;
        margin-right: 10px;
    }

    #times {
        margin-top: 5px;
        width: 800px;
    }

    #times input {
        margin-top: 10px;
        margin-left: 0;
        float: left;
    }

    #times input.error {
        border-color: red !important;
    }

    .subscribe {

    }

    .subscribe .button-container {
        float: left;
        width: 150px;
    }

    .subscribe .text-container {
        float: left;
        width: auto;
    }

    .subscribe .text-container p {
        margin: 0;
        color: #425F9A;
        font-size: 14px;
        font-weight: bold;
    }

    .subscribe .text-container p a {
        color: #425F9A;
        text-decoration: underline;
    }

    .save {
        padding-left: 5px;
        padding-top: 5px;
        width: auto;
    }

    .ui-timepicker-wrapper {
        width: 98px;
    }

    .easing-spinner {
        width: 30px;
        height: 30px;
        position: relative;
        display: inline-block;

        margin-top: 7px;
        margin-left: -15px;

        float: left;
    }

    .double-bounce1, .double-bounce2 {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background-color: #fff;
        opacity: 0.6;
        position: absolute;
        top: 0;
        left: 0;

        -webkit-animation: sk-bounce 2.0s infinite ease-in-out;
        animation: sk-bounce 2.0s infinite ease-in-out;
    }

    .double-bounce2 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .wpae-export-complete-save-button svg {
        margin-top: 7px;
        margin-left: -15px;
        position: relative;
        display: none;
    }

    @-webkit-keyframes sk-bounce {
        0%, 100% {
            -webkit-transform: scale(0.0)
        }
        50% {
            -webkit-transform: scale(1.0)
        }
    }

    @keyframes sk-bounce {
        0%, 100% {
            transform: scale(0.0);
            -webkit-transform: scale(0.0);
        }
        50% {
            transform: scale(1.0);
            -webkit-transform: scale(1.0);
        }
    }

    #add-subscription-field {
        position: absolute;
        left: -152px;
        top: -2px;
        height: 46px;
        border-radius: 5px;
        font-size: 17px;
        padding-left: 10px;
        display: none;
        width: 140px;
    }

    #find-subscription-link {
        position: absolute;
        left: 133px;
        top: 14px;
        height:30px;
        width: 230px;
        display: none;
    }

    #find-subscription-link a {
        display: block;
        width: 100%;
        height: 46px;
        white-space: nowrap;
    }

    #weekly li.error, #monthly li.error {
        border-color: red;
    }

    .chosen-single {
        margin-bottom: 0 !important;
    }

    .chosen-container.chosen-with-drop .chosen-drop {
        margin-top: -3px;
    }

    .wpallexport-preview-content h4{
        font-size: 14px;
        margin-bottom: 5px;
        color: #40acad;
        text-decoration: none;
    }

    #scheduling-form h4 {
        display: inline-block;;
    }

    .manual-scheduling {
        margin-left: 26px;
    }
</style>
<?php
$scheduling = \Wpae\Scheduling\Scheduling::create();
$schedulingExportOptions = $export->options;
$hasActiveLicense = $scheduling->checkLicense();
$cron_job_key = PMXE_Plugin::getInstance()->getOption('cron_job_key');
$options = \PMXE_Plugin::getInstance()->getOption();
$export_id = $export->id;
?>

<script type="text/javascript">
    (function ($) {
        $(function () {

            var hasActiveLicense = <?php echo $hasActiveLicense? 'true':'false'; ?>;

            $(document).ready(function () {

                function openSchedulingAccordeonIfClosed() {
                    if ($('.wpallexport-file-options').hasClass('closed')) {
                        // Open accordion
                        $('#scheduling-title').trigger('click');
                    }
                }

                window.pmxeValidateSchedulingForm = function () {

                    var schedulingEnabled = $('input[name="scheduling_enable"]:checked').val() == 1;

                    if (!schedulingEnabled) {
                        return {
                            isValid: true
                        };
                    }

                    var runOn = $('input[name="scheduling_run_on"]:checked').val();

                    // Validate weekdays
                    if (runOn == 'weekly') {
                        var weeklyDays = $('#weekly_days').val();

                        if (weeklyDays == '') {
                            $('#weekly li').addClass('error');
                            return {
                                isValid: false,
                                message: 'Please select at least a day on which the export should run'
                            }
                        }
                    } else if (runOn == 'monthly') {
                        var monthlyDays = $('#monthly_days').val();

                        if (monthlyDays == '') {
                            $('#monthly li').addClass('error');
                            return {
                                isValid: false,
                                message: 'Please select at least a day on which the export should run'
                            }
                        }
                    }

                    // Validate times
                    var timeValid = true;
                    var timeMessage = 'Please select at least a time for the export to run';
                    var timeInputs = $('.timepicker');
                    var timesHasValues = false;

                    timeInputs.each(function (key, $elem) {

                        if($(this).val() !== ''){
                            timesHasValues = true;
                        }

                        if (!$(this).val().match(/^(0?[1-9]|1[012])(:[0-5]\d)[APap][mM]$/) && $(this).val() != '') {
                            $(this).addClass('error');
                            timeValid = false;
                        } else {
                            $(this).removeClass('error');
                        }
                    });

                    if(!timesHasValues) {
                        timeValid = false;
                        $('.timepicker').addClass('error');
                    }

                    if (!timeValid) {
                        return {
                            isValid: false,
                            message: timeMessage
                        };
                    }

                    return {
                        isValid: true
                    };
                };

                $('#weekly li').click(function () {

                    $('#weekly li').removeClass('error');

                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    } else {
                        $(this).addClass('selected');
                    }

                    $('#weekly_days').val('');

                    $('#weekly li.selected').each(function () {
                        var val = $(this).data('day');
                        $('#weekly_days').val($('#weekly_days').val() + val + ',');
                    });

                    $('#weekly_days').val($('#weekly_days').val().slice(0, -1));

                });

                $('#monthly li').click(function () {

                    $('#monthly li').removeClass('error');
                    $(this).parent().parent().find('.days-of-week li').removeClass('selected');
                    $(this).addClass('selected');

                    $('#monthly_days').val($(this).data('day'));
                });

                $('input[name="scheduling_run_on"]').change(function () {
                    var val = $('input[name="scheduling_run_on"]:checked').val();
                    if (val == "weekly") {

                        $('#weekly').slideDown({
                            queue: false
                        });
                        $('#monthly').slideUp({
                            queue: false
                        });

                    } else if (val == "monthly") {

                        $('#weekly').slideUp({
                            queue: false
                        });
                        $('#monthly').slideDown({
                            queue: false
                        });
                    }
                });

                $('.timepicker').timepicker();

                var selectedTimes = [];

                var onTimeSelected = function () {

                    selectedTimes.push([$(this).val(), $(this).val() + 1]);

                    var isLastChild = $(this).is(':last-child');
                    if (isLastChild) {
                        $(this).parent().append('<input class="timepicker" name="scheduling_times[]" style="display: none;" type="text" />');
                        $('.timepicker:last-child').timepicker({
                            'disableTimeRanges': selectedTimes
                        });
                        $('.timepicker:last-child').fadeIn('fast');
                        $('.timepicker').on('changeTime', onTimeSelected);
                    }
                };

                $('.timepicker').on('changeTime', onTimeSelected);

                $('#timezone').chosen({width: '320px'});

                $('.wpae-export-complete-save-button').click(function (e) {

                    if($('.wpae-save-button').hasClass('disabled')) {
                        return false;
                    }

                    var initialValue = $(this).find('.save-text').html();
                    var schedulingEnable = $('input[name="scheduling_enable"]:checked').val() == 1;

                    var validationResponse = pmxeValidateSchedulingForm();
                    if (!validationResponse.isValid) {

                        openSchedulingAccordeonIfClosed();
                        e.preventDefault();
                        return false;
                    }

                    $(this).find('.easing-spinner').toggle();

                    var $button = $(this);

                    var formData = $('#scheduling-form :input').serializeArray();

                    formData.push({name: 'security', value: wp_all_export_security});
                    formData.push({name: 'action', value: 'save_scheduling'});
                    formData.push({name: 'element_id', value: <?php echo intval($export_id); ?>});
                    formData.push({name: 'scheduling_enable', value: $('input[name="scheduling_enable"]:checked').val()});

                    $.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        data: formData,
                        success: function (response) {
                            $button.find('.easing-spinner').toggle();
                            $button.find('.save-text').html(initialValue);
                            $button.find('svg').show();
                            $button.find('svg').fadeOut(3000);

                        },
                        error: function () {
                            $button.find('.easing-spinner').toggle();
                            $button.find('.save-text').html(initialValue);
                        }
                    });
                });

                <?php if($schedulingExportOptions['scheduling_timezone'] == 'UTC') {
                ?>
                var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

                if($('#timezone').find("option:contains('"+ timeZone +"')").length != 0){
                    $('#timezone').trigger("chosen:updated");
                    $('#timezone').val(timeZone);
                    $('#timezone').trigger("chosen:updated");
                }else{
                    var parts = timeZone.split('/');
                    var lastPart = parts[parts.length-1];
                    var opt = $('#timezone').find("option:contains('"+ lastPart +"')");

                    $('#timezone').val(opt.val());
                    $('#timezone').trigger("chosen:updated");
                }

                <?php
                }
                ?>

                var saveSubscription = false;

                $('#add-subscription').click(function(){

                    $('#add-subscription-field').show();
                    $('#add-subscription-field').animate({width:'400px'}, 225);
                    $('#add-subscription-field').animate({left:'-1px'}, 225);
                    $('#subscribe-button .button-subscribe').css('background-color','#46ba69');
                    $('.text-container p').fadeOut();

                    setTimeout(function () {
                        $('#find-subscription-link').show();
                        $('#find-subscription-link').animate({left: '410px'}, 300, 'swing');
                    }, 225);
                    $('.subscribe-button-text').html('<?php esc_html_e('Activate'); ?>');
                    saveSubscription = true;
                    return false;
                });

                $('#subscribe-button').click(function(){

                    if(saveSubscription) {
                        $('#subscribe-button .easing-spinner').show();
                        var license = $('#add-subscription-field').val();
                        $.ajax({
                            url:ajaxurl+'?action=wpae_api&q=schedulingLicense/saveSchedulingLicense&security=<?php echo esc_js(wp_create_nonce("wp_all_export_secure"));?>',
                            type:"POST",
                            data: {
                                license: license
                            },
                            dataType:"json",
                            success: function(response){

                                $('#subscribe-button .button-subscribe').css('background-color','#425f9a');
                                if(response.success) {
                                    hasActiveLicense = true;
                                    $('.wpae-save-button').removeClass('disabled');
                                    $('#subscribe-button .easing-spinner').hide();
                                    $('#subscribe-button svg.success').show();
                                    $('#subscribe-button svg.success').fadeOut(3000, function () {
                                        $('.subscribe').hide({queue: false});
                                        $('#subscribe-filler').show({queue: false});
                                    });

                                    $('.wpai-no-license').hide();
                                    $('.wpai-license').show();
                                } else {
                                    $('#subscribe-button .easing-spinner').hide();
                                    $('#subscribe-button svg.error').show();
                                    $('.subscribe-button-text').html('<?php esc_html_e('Subscribe'); ?>');
                                    $('#subscribe-button svg.error').fadeOut(3000, function () {
                                        $('#subscribe-button svg.error').hide({queue: false});

                                    });

                                    $('#add-subscription').html('<?php esc_html_e('Invalid license, try again?');?>');
                                    $('.text-container p').fadeIn();

                                    $('#find-subscription-link').animate({width: 'toggle'}, 300, 'swing');

                                    setTimeout(function () {
                                        $('#add-subscription-field').animate({width:'140px'}, 225);
                                        $('#add-subscription-field').animate({left:'-152px'}, 225);
                                    }, 300);

                                    $('#add-subscription-field').val('');

                                    $('#subscribe-button-text').html('<?php esc_html_e('Subscribe'); ?>');
                                    saveSubscription = false;
                                }
                            }
                        });

                        return false;
                    }
                });
            });
            // help scheduling template
            $('.help_scheduling').click(function(){

                $('.wp-all-export-scheduling-help').css('left', ($( document ).width()/2) - 255 ).show();
                $('#wp-all-export-scheduling-help-inner').css('max-height', $( window ).height()-150).show();
                $('.wpallexport-overlay').show();
                return false;
            });

            $('.wp_all_export_scheduling_help').find('h3').click(function(){
                var $action = $(this).find('span').html();
                $('.wp_all_export_scheduling_help').find('h3').each(function(){
                    $(this).find('span').html("+");
                });
                if ( $action == "+" ) {
                    $('.wp_all_export_help_tab').slideUp();
                    $('.wp_all_export_help_tab[rel=' + $(this).attr('id') + ']').slideDown();
                    $(this).find('span').html("-");
                }
                else{
                    $('.wp_all_export_help_tab[rel=' + $(this).attr('id') + ']').slideUp();
                    $(this).find('span').html("+");
                }
            });
        });
    })(jQuery);

</script>
<?php require __DIR__.'/CommonJs.php'; ?>
<div id="scheduling-form">

    <div class="wpallexport-content-section" style="padding-bottom: 15px; margin-bottom: 10px; margin-top: 5px;">
        <div class="wpallexport-collapsed-content" style="padding: 0; height: auto; ">
            <div class="wpallexport-collapsed-content-inner" style="padding-bottom: 0; overflow: auto; padding-right: 0;">
                <div style="margin-bottom: 20px;">
                    <label>
                        <input type="radio" name="scheduling_enable" value="0" <?php if($schedulingExportOptions['scheduling_enable'] == 0) { ?> checked="checked" <?php } ?>/>
                        <h4 style="display: inline-block;"><?php esc_html_e('Do Not Schedule'); ?></h4>
                    </label>
                </div>
                <div>
                    <label>
                        <input type="radio" name="scheduling_enable" value="1" <?php if($schedulingExportOptions['scheduling_enable'] == 1) {?> checked="checked" <?php }?>/>
                        <h4 style="margin: 0; display: inline-flex; align-items: center;"><?php esc_html_e('Automatic Scheduling', PMXE_Plugin::LANGUAGE_DOMAIN); ?>
                            <span class="connection-icon" style="margin-left: 8px; height: 16px;">
															<?php include_once('ConnectionIcon.php'); ?>
														</span>
                            <?php if($schedulingExportOptions['scheduling_enable'] == 1) { ?>
                                <?php if (!$scheduling->checkConnection()) { ?>
                                    <span class="wpai-license" style="margin-left: 8px; font-weight: normal; font-weight: normal; <?php if(!$hasActiveLicense) { ?> display: none; <?php }?>"><span class="unable-to-connect">Unable to connect, please contact support.</span></span>
                                <?php } ?>
                            <?php } ?>
                        </h4>
                    </label>
                </div>

                <div style="margin-bottom: 10px; margin-left:26px;">
                    <label>
                        <?php esc_html_e('Run this export on a schedule.'); ?>
                        <?php if($hasActiveLicense) { ?>
                        <?php } ?>
                    </label>
                </div>
                <div id="automatic-scheduling"
                     style="margin-left: 21px; <?php if ($schedulingExportOptions['scheduling_enable'] != 1) { ?> display: none; <?php } ?>">
                    <div>
                        <div class="input">
                            <label style="color: rgb(68,68,68);">
                                <input
                                    type="radio" <?php if ($schedulingExportOptions['scheduling_run_on'] != 'monthly') { ?> checked="checked" <?php } ?>
                                    name="scheduling_run_on" value="weekly"
                                    checked="checked"/> <?php esc_html_e('Every week on...', PMXE_Plugin::LANGUAGE_DOMAIN); ?>
                            </label>
                        </div>
                        <input type="hidden" style="width: 500px;" name="scheduling_weekly_days"
                               value="<?php echo esc_attr($schedulingExportOptions['scheduling_weekly_days']); ?>" id="weekly_days"/>
                        <?php
                        if (isset($schedulingExportOptions['scheduling_weekly_days'])) {
                            $weeklyArray = explode(',', $schedulingExportOptions['scheduling_weekly_days']);
                        } else {
                            $weeklyArray = array();
                        }
                        ?>
                        <ul class="days-of-week" id="weekly" style="<?php if ($schedulingExportOptions['scheduling_run_on'] == 'monthly') { ?> display: none; <?php } ?>">
                            <li data-day="0" <?php if (in_array('0', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Mon
                            </li>
                            <li data-day="1" <?php if (in_array('1', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Tue
                            </li>
                            <li data-day="2" <?php if (in_array('2', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Wed
                            </li>
                            <li data-day="3" <?php if (in_array('3', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Thu
                            </li>
                            <li data-day="4" <?php if (in_array('4', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Fri
                            </li>
                            <li data-day="5" <?php if (in_array('5', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Sat
                            </li>
                            <li data-day="6" <?php if (in_array('6', $weeklyArray)) { ?> class="selected" <?php } ?>>
                                Sun
                            </li>
                        </ul>
                    </div>
                    <div style="clear: both;"></div>
                    <div>
                        <div class="input">
                            <label style="color: rgb(68,68,68);">
                                <input
                                    type="radio" <?php if ($schedulingExportOptions['scheduling_run_on'] == 'monthly') { ?> checked="checked" <?php } ?>
                                    name="scheduling_run_on"
                                    value="monthly"/> <?php esc_html_e('Every month on the first...', PMXE_Plugin::LANGUAGE_DOMAIN); ?>
                            </label>
                        </div>
                        <input type="hidden" name="scheduling_monthly_days" value="<?php if(isset($schedulingExportOptions['scheduling_monthly_days'])) echo esc_attr($schedulingExportOptions['scheduling_monthly_days']); ?>" id="monthly_days"/>
                        <?php
                        if (isset($schedulingExportOptions['scheduling_monthly_days'])) {
                            $monthlyArray = explode(',', $schedulingExportOptions['scheduling_monthly_days']);
                        } else {
                            $monthlyArray = array();
                        }
                        ?>
                        <ul class="days-of-week" id="monthly"
                            style="<?php if ($schedulingExportOptions['scheduling_run_on'] != 'monthly') { ?> display: none; <?php } ?>">
                            <li data-day="0" <?php if (in_array('0', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Mon
                            </li>
                            <li data-day="1" <?php if (in_array('1', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Tue
                            </li>
                            <li data-day="2" <?php if (in_array('2', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Wed
                            </li>
                            <li data-day="3" <?php if (in_array('3', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Thu
                            </li>
                            <li data-day="4" <?php if (in_array('4', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Fri
                            </li>
                            <li data-day="5" <?php if (in_array('5', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Sat
                            </li>
                            <li data-day="6" <?php if (in_array('6', $monthlyArray)) { ?> class="selected" <?php } ?>>
                                Sun
                            </li>
                        </ul>
                    </div>
                    <div style="clear: both;"></div>

                    <div id="times-container" style="margin-left: 5px;">
                        <div style="margin-top: 10px; margin-bottom: 5px;">
                            What times do you want this export to run?
                        </div>

                        <div id="times" style="margin-bottom: 10px;">
                            <?php if (is_array($schedulingExportOptions['scheduling_times'])) {
                                foreach ($schedulingExportOptions['scheduling_times'] as $time) { ?>

                                    <?php if ($time) { ?>
                                        <input class="timepicker" type="text" name="scheduling_times[]"
                                               value="<?php echo esc_attr($time); ?>"/>
                                    <?php } ?>
                                <?php } ?>
                                <input class="timepicker" type="text" name="scheduling_times[]"/>
                            <?php } ?>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="timezone-select" style="position:absolute; margin-top: 10px;">
                            <?php

                            $timezoneValue = false;
                            if ($schedulingExportOptions['scheduling_timezone']) {
                                $timezoneValue = $schedulingExportOptions['scheduling_timezone'];
                            }

                            $timezoneSelect = new \Wpae\Scheduling\Timezone\TimezoneSelect();
                            echo $timezoneSelect->getTimezoneSelect($timezoneValue);
                            ?>
                        </div>
                    </div>
                    <div style="height: 50px; margin-top: 30px; <?php if(!$hasActiveLicense) {?>display: none; <?php } ?>" id="subscribe-filler">&nbsp;</div>
                    <?php
                    if (!$hasActiveLicense) {
                        ?>
                        <div class="subscribe" style="margin-left: 5px; margin-top: 65px; margin-bottom: 130px; position: relative;">
                            <div class="button-container">

                                <a href="https://www.wpallimport.com/checkout/?edd_action=add_to_cart&download_id=515704&utm_source=export-plugin-free&utm_medium=upgrade-notice&utm_campaign=automatic-scheduling" target="_blank" id="subscribe-button">
                                    <div class="button button-primary button-hero wpallexport-large-button button-subscribe"
                                         style="background-image: none; width: 140px; text-align: center; position: absolute; z-index: 4;">
                                        <svg class="success" width="30" height="30" viewBox="0 0 1792 1792"
                                             xmlns="http://www.w3.org/2000/svg"
                                             style="fill: white; display: none; position: absolute; top: 6px; left: 5px;">
                                            <path
                                                d="M1671 566q0 40-28 68l-724 724-136 136q-28 28-68 28t-68-28l-136-136-362-362q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 295 656-657q28-28 68-28t68 28l136 136q28 28 28 68z"
                                                fill="white"/>
                                        </svg>
                                        <svg class="error" width="30" height="30" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"
                                             style="fill: red; display: none; position: absolute; top: 6px; left: 5px;">
                                            <path d="M1490 1322q0 40-28 68l-136 136q-28 28-68 28t-68-28l-294-294-294 294q-28 28-68 28t-68-28l-136-136q-28-28-28-68t28-68l294-294-294-294q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 294 294-294q28-28 68-28t68 28l136 136q28 28 28 68t-28 68l-294 294 294 294q28 28 28 68z"/></svg>
                                        <div class="easing-spinner" style="position: absolute; left: 23px; display: none;">
                                            <div class="double-bounce1"></div>
                                            <div class="double-bounce2"></div>
                                        </div>

                                        <span class="subscribe-button-text">
                                            <?php esc_html_e('Subscribe', PMXE_Plugin::LANGUAGE_DOMAIN); ?>
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="text-container" style="position: absolute; left: 150px; top: 2px;">
                                <p><?php esc_html_e('Get automatic scheduling for unlimited sites, just $9/mo.'); ?></p>
                                <p><?php esc_html_e('Have a license?'); ?>
                                    <a href="#" id="add-subscription"><?php esc_html_e('Register this site.'); ?></a> <?php esc_html_e('Questions?', PMXE_Plugin::LANGUAGE_DOMAIN); ?> <a href="#" class="help_scheduling">Read more.</a></p>
                                <input type="password" id="add-subscription-field" style="position: absolute; z-index: 2; font-size:14px;" placeholder="<?php esc_html_e('Enter your license', PMXE_Plugin::LANGUAGE_DOMAIN); ?>" />
                                <div style="position: absolute;" id="find-subscription-link"><a href="http://www.wpallimport.com/portal/automatic-scheduling/" target="_blank"><?php esc_html_e('Find your license.', PMXE_Plugin::LANGUAGE_DOMAIN);?></a></div>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
                <div style="clear:both"></div>
                <?php require __DIR__.'/../views/ManualScheduling.php'; ?>
            </div>
        </div>
    </div>

    <div style="clear: both;"></div>
</div>

<div class="wpae-save-button button button-primary button-hero wpallexport-large-button wpae-export-complete-save-button <?php if(!$hasActiveLicense) { echo 'disabled'; }?>"
     style="position: relative; width: 285px; display: block; margin:auto; background-image: none; margin-top: 25px;">
    <svg width="30" height="30" viewBox="0 0 1792 1792"
         xmlns="http://www.w3.org/2000/svg"
         style="fill: white;">
        <path
                d="M1671 566q0 40-28 68l-724 724-136 136q-28 28-68 28t-68-28l-136-136-362-362q-28-28-28-68t28-68l136-136q28-28 68-28t68 28l294 295 656-657q28-28 68-28t68 28l136 136q28 28 28 68z"
                fill="white"/>
    </svg>
    <div class="easing-spinner" style="display: none;">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
    </div>
    <div class="save-text"
         style="display: block; position:absolute; <?php if($this->isWizard) {?> left: 70px; <?php } else { ?> left: 60px; <?php } ?> top:0; user-select: none;">
            <?php esc_html_e('Save Scheduling Options', 'wp_all_export_plugin'); ?>
    </div>
</div>
<div class="wpallexport-overlay"></div>
<fieldset class="optionsset column rad4 wp-all-export-scheduling-help">

    <div class="title">
        <span style="font-size:1.5em;" class="wpallexport-add-row-title"><?php esc_html_e('Automatic Scheduling', 'wp_all_export_plugin'); ?></span>
    </div>

    <?php
    include_once 'SchedulingHelp.php';
    ?>
</fieldset>
