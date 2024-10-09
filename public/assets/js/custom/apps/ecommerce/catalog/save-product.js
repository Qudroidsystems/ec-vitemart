"use strict";

// Class definition
var KTAppEcommerceSaveProduct = function () {

    // Class Variables
    var discount_type = old_discount_type ?? null;
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

    // Init noUIslider
    const initSlider = () => {
        var slider = document.querySelector("#kt_ecommerce_add_product_discount_slider");
        var value = document.querySelector("#kt_ecommerce_add_product_discount_label");

        noUiSlider.create(slider, {
            start: [value.innerHTML],
            connect: true,
            range: {
                "min": 1,
                "max": 100
            }
        });

        slider.noUiSlider.on("update", function (values, handle) {
            value.innerHTML = Math.round(values[handle]);
            if (handle) {
                value.innerHTML = Math.round(values[handle]);
            }
        });
    }

    // Init DropzoneJS --- more info:
    const initDropzone = () => {
        var myDropzone = new Dropzone("#kt_ecommerce_add_product_media", {
            url: upload_route, // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
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

    // Handle discount options
    const handleDiscount = () => {
        const discountOptions = document.querySelectorAll('input[name="discount_option"]');
        const percentageEl = document.getElementById('kt_ecommerce_add_product_discount_percentage');
        const fixedEl = document.getElementById('kt_ecommerce_add_product_discount_fixed');

        discountOptions.forEach(option => {
            option.addEventListener('change', e => {
                const value = e.target.value;

                switch (value) {
                    case '2': {
                        discount_type = "percentage";
                        percentageEl.classList.remove('d-none');
                        fixedEl.classList.add('d-none');
                        break;
                    }
                    case '3': {
                        discount_type = "fixed";
                        percentageEl.classList.add('d-none');
                        fixedEl.classList.remove('d-none');
                        break;
                    }
                    default: {
                        discount_type = null;
                        percentageEl.classList.add('d-none');
                        fixedEl.classList.add('d-none');
                        break;
                    }
                }
            });
        });
    }

    // Shipping option handler
    const handleShipping = () => {
        const shippingOption = document.getElementById('kt_ecommerce_add_product_shipping_checkbox');
        const shippingForm = document.getElementById('kt_ecommerce_add_product_shipping');

        shippingOption.addEventListener('change', e => {
            const value = e.target.checked;

            if (value) {
                shippingForm.classList.remove('d-none');
            } else {
                shippingForm.classList.add('d-none');
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
                case "public": {
                    target.classList.remove(...statusClasses);
                    target.classList.add('bg-success');
                    hideDatepicker();
                    break;
                }

                case "hidden": {
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
                                message: 'Product name is required'
                            }
                        }
                    },
                    'sku': {
                        validators: {
                            notEmpty: {
                                message: 'SKU is required'
                            }
                        }
                    },
                    'barcode': {
                        validators: {
                            notEmpty: {
                                message: 'Product barcode is required'
                            }
                        }
                    },
                    'shelf': {
                        validators: {
                            notEmpty: {
                                message: 'Shelf quantity is required'
                            }
                        }
                    },
                    'price': {
                        validators: {
                            notEmpty: {
                                message: 'Product base price is required'
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

                            var cover = document.getElementById('product_cover');
                            var name = document.getElementById('product_name').value;
                            var description = document.querySelector('#kt_ecommerce_add_product_description .ql-editor').innerHTML;
                            var status = document.getElementById('kt_ecommerce_add_product_status_select').value;
                            var retail_price_in_naira = document.getElementById('product_price').value;
                            var sku = document.getElementById('sku').value;
                            var barcode = document.getElementById('barcode').value;
                            var shelf_quantity = document.getElementById('shelf_quantity').value;
                            var warehouse_quantity = document.getElementById('warehouse_quantity').value;
                            var allow_backorders = document.getElementById('allow_backorders').value;
                            var physical = document.getElementById('kt_ecommerce_add_product_shipping_checkbox').value;
                            
                            var weight = physical ? document.getElementById('weight').value : null;
                            var height = physical ? document.getElementById('height').value : null;
                            var width = physical ? document.getElementById('width').value : null;
                            var length = physical ? document.getElementById('length').value : null;

                            var category_id = document.getElementById('category_id').value;
                            var template = document.getElementById('kt_ecommerce_add_product_store_template').value;
                            

                            var product_tags = [];
                            tagifieds['#kt_ecommerce_add_product_tags'].value.forEach((tag) => {
                                product_tags.push(tag.value);
                            });

                            var brands = [];
                            tagifieds['#kt_ecommerce_add_product_brands'].value.forEach((tag) => {
                                brands.push(tag.value);
                            });;
                            
                            var discount = 0;
                            switch (discount_type) {
                                case 'percentage':
                                    discount = document.getElementById('kt_ecommerce_add_product_discount_label').innerText;
                                    break;
                            
                                case 'fixed':
                                    discount = document.getElementById('discounted_price').value;
                                    break;
                            
                                default:
                                    break;
                            }

                            var formData = new FormData();


                            formData.append('cover', cover.files[0]);
                            formData.append('media', JSON.stringify(media));
                            formData.append('name', name);
                            formData.append('status', status);
                            formData.append('description', description);
                            formData.append('retail_price_in_naira', retail_price_in_naira);
                            formData.append('category_id', category_id);
                            formData.append('tags', JSON.stringify(product_tags));
                            formData.append('brands', JSON.stringify(brands));
                            formData.append('discount_type', discount_type);
                            formData.append('discount', discount);
                            formData.append('sku', sku);
                            formData.append('barcode', barcode);
                            formData.append('template', template);
                            formData.append('physical', physical);
                            formData.append('width', width);
                            formData.append('height', height);
                            formData.append('length', length);
                            formData.append('weight', weight);
                            formData.append('shelf_quantity', shelf_quantity);
                            formData.append('warehouse_quantity', warehouse_quantity);
                            formData.append('allow_backorders', allow_backorders);
                    
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
                                            html: "Sorry, looks like there are some errors detected, please try again. <br/><br/>Please note that there may be errors in the <strong>General</strong> or <strong>Advanced</strong> tabs",
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
            initSlider();
            // initFormRepeater();
            initDropzone();
            initConditionsSelect2();

            // Handle forms
            handleStatus();
            handleConditions();
            handleDiscount();
            handleShipping();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSaveProduct.init();
});