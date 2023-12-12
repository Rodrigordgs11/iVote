"use strict";

// Class definition
var KTPollsAddPoll = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_poll');
    const form = element.querySelector('#kt_modal_add_poll_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddPoll = () => {


        // Inicializar o seletor de data de início
        $("#kt_modal_datepicker_start").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: new Date().toISOString(),
            onChange: function (selectedDates, dateStr, instance) {
                // Adiciona uma hora à data de início
                var endDate = new Date(selectedDates[0]);
                endDate.setHours(endDate.getHours() + 1);

                // Limpa o valor do campo "End date"
                $("#kt_modal_datepicker_end").flatpickr().clear();

                // Inicializa o seletor de data de término com a nova configuração
                $("#kt_modal_datepicker_end").flatpickr({
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    minDate: endDate,
                });
            }
        });

        // Inicializa o seletor de data de término
        $("#kt_modal_datepicker_end").flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: $("#kt_modal_datepicker_start").val(),
        });


        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'poll_title': {
                        validators: {
                            notEmpty: {
                                message: 'Title name is required'
                            }
                        }
                    },
                    'event_datetime_start': {
                        validators: {
                            notEmpty: {
                                message: 'Start date & time is required'
                            }
                        }
                    },
                    'event_datetime_end': {
                        validators: {
                            notEmpty: {
                                message: 'End date & time is required'
                            }
                        }
                    },
                    'poll_description': {
                        validators: {
                            notEmpty: {
                                message: 'Description is required'
                            }
                        }
                    },
                    'user': {
                        validators: {
                            notEmpty: {
                                message: 'Owner is required'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Submit button handler
        const submitButton = element.querySelector('[data-kt-polls-modal-action="submit"]');
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click 
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function () {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation 
                            const handleConfirmation = function (result) {
                                if (result.isConfirmed) {
                                    // Poll confirmed, hide the modal and submit the form
                                    form.submit();
                                    modal.hide();
                                }
                            };

                            // Assuming you're using some library like Swal (SweetAlert)
                            Swal.fire({
                                title: 'Confirmation',
                                text: 'Are you sure?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Yes',
                                cancelButtonText: 'No',
                            }).then(handleConfirmation);
                        }, 2000);
                    } else {
                        // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            }
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-polls-modal-action="cancel"]');
        cancelButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        // Close button handler
        const closeButton = element.querySelector('[data-kt-polls-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    form.reset(); // Reset form			
                    modal.hide();
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    return {
        // Public functions
        init: function () {
            initAddPoll();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTPollsAddPoll.init();
});