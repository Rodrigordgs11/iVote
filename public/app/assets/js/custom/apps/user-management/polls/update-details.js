"use strict";

// Class definition
var KTUsersUpdatePermissions = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_update_poll');
    const form = element.querySelector('#kt_modal_update_poll_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initUpdatePermissions = () => {

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

        // Close button handler
        const closeButton = element.querySelector('[data-kt-roles-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to close?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, close it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    modal.hide(); // Hide modal				
                }
            });
        });

        // Cancel button handler
        const cancelButton = element.querySelector('[data-kt-roles-modal-action="cancel"]');
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
                    modal.hide(); // Hide modal				
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

        const submitButton = element.querySelector('[data-kt-roles-modal-action="submit"]');
        submitButton.addEventListener('click', function (e) {
            // Prevent default button action
            e.preventDefault();

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

                // Assuming you're using some library like Swal (SweetAlert)
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                }).then(function (result) {
                    if (result.isConfirmed) {
                        // User confirmed, hide the modal and submit the form
                        form.submit();
                        modal.hide();
                    }
                }
                )
            }, 2000);
        });
    }

    // Select all handler
    const handleSelectAll = () => {
        // Define variables
        const selectAll = form.querySelector('#kt_roles_select_all');
        const allCheckboxes = form.querySelectorAll('[type="checkbox"]');

        // Handle check state
        selectAll.addEventListener('change', e => {

            // Apply check state to all checkboxes
            allCheckboxes.forEach(c => {
                c.checked = e.target.checked;
            });
        });
    }

    return {
        // Public functions
        init: function () {
            initUpdatePermissions();
            handleSelectAll();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersUpdatePermissions.init();
});