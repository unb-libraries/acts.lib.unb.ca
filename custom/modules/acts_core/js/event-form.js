/**
 * @file ACTS Event Form Enhancements
 */

function eventDateRange() {
    /**
     * Set Event Date interface within Date of Publication fieldset.
     */
    if (jQuery("#edit-field-event-date-type").val() == 'approximate') {
        jQuery("#edit-field-event-date-0 legend .fieldset__label").text("Event Date Range");
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:first-child .form-item__label").text("Approximate start date");
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:nth-child(2) .form-item__label").addClass("form-required").text("Approximate end date");
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:nth-child(2)").slideDown(300);
        jQuery("#edit-field-event-date-0 .fieldset__description").slideDown(300);
    } else {
        jQuery("#edit-field-event-date-0 legend .fieldset__label").text("Event Date");
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:first-child .form-item__label").text("Date");
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:first-child .form-item__label").addClass("form-required");
        /**
         * Clear the end date widget when Approximate is NOT selected.
         */
        jQuery("#edit-field-event-date-0-end-value-date").val('');
        /**
         * Clear the start date widget when Exact is NOT selected.
         */
        if (jQuery("#edit-field-event-date-type").val() != 'exact') {
            jQuery("#edit-field-event-date-0-value-date").val('');
        }
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:nth-child(2) .form-item__label").removeClass("form-required");
        jQuery("#edit-field-event-date-0 .form-datetime-wrapper:nth-child(2)").slideUp(200);
        jQuery("#edit-field-event-date-0 .fieldset__description").slideUp(200);
    }
}

(function ($, Drupal) {
    'use strict';

    Drupal.behaviors.inputEventDate = {
        attach: function () {
            eventDateRange();

            $('#edit-field-event-date-type').change(eventDateRange);
        }
    };
})(jQuery, Drupal);
