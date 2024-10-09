"use strict";

// Class definition
var KTAppEcommerceSaveProduct = function () {

    // Class Variables
    var media = [];
    var tagifieds = [];

    // Private functions

    // Init quill editor
    const initQuill = () => {
        // Define all elements for quill editor
        const elements = [
            '#kt_ecommerce_add_product_description',
            '#kt_ecommerce_add_product_meta_description'
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get quill element
            let quill = document.querySelector(element);

            // Break if element not found
            if (!quill) {
                return;
            }

            // Init quill --- more info: https://quilljs.com/docs/quickstart/
            quill = new Quill(element, {
                modules: {
                    toolbar: [
                        [{
                            header: [1, 2, false]
                        }],
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block']
                    ]
                },
                placeholder: 'Type your text here...',
                theme: 'snow' // or 'bubble'
            });

            quill.root.innerHTML = document.querySelector(element).getAttribute('value');

        });
    }

    // Init tagify
    const initTagify = () => {
        // Define all elements for tagify
        const elements = [
            '#kt_ecommerce_add_product_categories',
            '#kt_ecommerce_add_product_tags',
            '#kt_ecommerce_add_product_brands',
        ];

        // Loop all elements
        elements.forEach(element => {
            // Get tagify element
            const tagify = document.querySelector(element);

            // Break if element not found
            if (!tagify) {
                return;
            }

            // Init tagify --- more info: https://yaireo.github.io/tagify/
            var tagified = new Tagify(tagify, {
                whitelist: tagify.getAttribute('data-whitelist'),
                dropdown: {
                    maxItems: 20,           // <- mixumum allowed rendered suggestions
                    classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                    enabled: 0,             // <- show suggestions on focus
                    closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
                }
            });

            tagifieds[element] = tagified;

        });

        
    }

    // // Init form repeater --- more info: https://github.com/DubFriend/jquery.repeater
    // const initFormRepeater = () => {
    //     $('#kt_ecommerce_add_product_options').repeater({
    //         initEmpty: false,

    //         defaultValues: {
    //             'text-input': 'foo'
    //         },

    //         show: function () {
    //             $(this).slideDown();

    //             // Init select2 on new repeated items
    //             initConditionsSelect2();
    //         },

    //         hide: function (deleteElement) {
    //             $(this).slideUp(deleteElement);
    //         }
    //     });
    // }

    // Init condition select2
    const initConditionsSelect2 = () => {
        // Tnit new repeating condition types
        const allConditionTypes = document.querySelectorAll('[data-kt-ecommerce-catalog-add-product="product_option"]');
        allConditionTypes.forEach(type => {
            if ($(type).hasClass("select2-hidden-accessible")) {
                return;
            } else {
                $(type).select2({
                    minimumResultsForSearch: -1
                });
            }
        });
    }

    // Init DropzoneJS --- more info:
    const initDropzone = () => {
        var myDropzone = new Dropzone("#kt_ecommerce_add_product_media", {
            url: upload_route, // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: maxFiles,
            method : 'post',
            headers : {
                'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('value'),
                "accept-Type" : 'application/json',
            },
            maxFilesize: 10, // MB
            addRemoveLinks: true,
        });
        
        myDropzone.on("complete", function(file) {
            if(file.status == "success") {
                media.push(file.xhr.response)
            }
        });
    }

    // Category status handler
    const handleStatus = () => {
        const target = document.getElementById('kt_ecommerce_add_product_status');
        const select = document.getElementById('kt_ecommerce_add_product_status_select');
        const statusClasses = ['bg-success', 'bg-warning', 'bg-danger'];

        $(select).on('change', function (e) {
            const value = e.target.value;

            switch (value) {
                case "active": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    hideDatepicker();
                    break;
                }

                case "inactive": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-danger');
                    hideDatepicker();
                    break;
                }
            
                default:
                    break;
            }
        });


        // Handle datepicker
        const datepicker = document.getElementById('kt_ecommerce_add_product_status_datepicker');

        // Init flatpickr --- more info: https://flatpickr.js.org/
        $('#kt_ecommerce_add_product_status_datepicker').flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        const showDatepicker = () => {
            datepicker.parentNode.classList.remove('d-none');
        }

        const hideDatepicker = () => {
            datepicker.parentNode.classList.add('d-none');
        }
    }

    // Condition type handler
    const handleConditions = () => {
        const allConditions = document.querySelectorAll('[name="method"][type="radio"]');
        const conditionMatch = document.querySelector('[data-kt-ecommerce-catalog-add-category="auto-options"]');
        allConditions.forEach(radio => {
            radio.addEventListener('change', e => {
                if (e.target.value === '1') {
                    conditionMatch.classList.remove('d-none');
                } else {
                    conditionMatch.classList.add('d-none');
                }
            });
        })
    }

    // Submit form handler
    const handleSubmit = () => {
        
        // Define variables
        let validator;

        // Get elements
        const form = document.getElementById('kt_ecommerce_add_product_form');
        const submitButton = document.getElementById('kt_ecommerce_add_product_submit');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'product_name': {
                        validators: {
                            notEmpty: {
                                message: 'Store name is required'
                            }
                        }
                    },
                    'tax': {
                        validators: {
                            notEmpty: {
                                message: 'Product tax class is required'
                            }
                        }
                    }
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

        // Handle submit button
        submitButton.addEventListener('click', e => {
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate()
                    .then(function (status) {
                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable submit button whilst loading
                            submitButton.disabled = true;

                            var cover = document.getElementById('cover');
                            var name = document.getElementById('name').value;
                            var description = document.querySelector('#store_address').value;
                            var status = document.getElementById('kt_ecommerce_add_product_status_select').value;
                            
                            var formData = new FormData();

                            formData.append('cover', cover.files[0]);
                            formData.append('media', JSON.stringify(media));
                            formData.append('name', name);
                            formData.append('status', status);
                            formData.append('address', description);

                    
                            fetch(route, {
                                method : "POST",
                                headers : {
                                'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('value'),
                                "accept-Type" : 'application/json',
                                }, body : formData
                            })
                                .then(data => data.json())
                                .then(data => {
                                    if(data[0]) {
                                        submitButton.removeAttribute('data-kt-indicator');

                                        Swal.fire({
                                            text: "Form has been successfully submitted!",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function (result) {
                                            if (result.isConfirmed) {
                                                // Enable submit button after loading
                                                submitButton.disabled = false;

                                                // Redirect to customers list page
                                                window.location = form.getAttribute("data-kt-redirect");
                                            }
                                        });
                                    }
                
                                    else {
                                        Swal.fire({
                                            html: "Sorry, looks like there are some errors detected, please try again.",
                                            icon: "error",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        });
                                    }
                                })
                        } else {
                            Swal.fire({
                                html: "Sorry, looks like there are some errors detected, please try again. <br/><br/>Please note that there may be errors in the <strong>General</strong> or <strong>Advanced</strong> tabs",
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
        })
    }

    // Public methods
    return {
        init: function () {
            // Init forms
            initQuill();
            initTagify();
            // initFormRepeater();
            initDropzone();
            initConditionsSelect2();

            // Handle forms
            handleStatus();
            handleConditions();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});