@extends('layouts.master')

@section('content')
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  py-3 py-lg-6 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex flex-stack ">

            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3 ">
                <!--begin::Title-->
                <h1
                    class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    All Stores
                </h1>
                <!--end::Title-->

                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="../../../index.html" class="text-muted text-hover-primary">
                            Administrator </a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        Stores </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->

                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        All </li>
                    <!--end::Item-->

                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">

        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-xxl ">
            <!--begin::Products-->
            <div class="card card-flush">
                <!--begin::Card header-->
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span
                                    class="path1"></span><span class="path2"></span></i> <input
                                type="text" data-kt-ecommerce-product-filter="search"
                                class="form-control form-control-solid w-250px ps-12"
                                placeholder="Search Product" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <div class="w-100 mw-150px">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Status"
                                data-kt-ecommerce-product-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <!--end::Select2-->
                        </div>

                        <!--begin::Add product-->
                        <a href="{{ route('admin-add-store') }}" class="btn btn-primary">
                            Add Store
                        </a>
                        <!--end::Add product-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body pt-0">

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5"
                        id="kt_ecommerce_products_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox"
                                            data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_products_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-200px">Store</th>
                                <th class="text-end min-w-100px">Address</th>
                                <th class="text-end min-w-100px">Status</th>
                                <th class="text-end min-w-70px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($stores as $store)
                            <tr>
                                <td>
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin::Thumbnail-->
                                        <a href="{{ route('admin-edit-store', $store->id)}}" class="symbol symbol-50px">
                                            <span class="symbol-label"
                                                style="background-image:url({{ asset('uploads/' . $store->cover->name . '.' . $store->cover->ext)}});"></span>
                                        </a>
                                        <!--end::Thumbnail-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="{{ route('admin-edit-store', ['store' => $store->id])}}"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold"
                                                data-kt-ecommerce-product-filter="product_name">{{$store->name}}</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">{{$store->physical_address}}</span>
                                </td>
                                <td class="text-end pe-0" data-order="{{$store->status}}">
                                    <!--begin::Badges-->
                                    <div class="badge {{ $store->status == "active" ? 'badge-light-success' : 'badge-light-danger'}}">{{ $store->status }}</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end">
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                        data-kt-menu-trigger="click"
                                        data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin-edit-store', ['store' => $store->id]) }}" class="menu-link px-3">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href = "" class="menu-link px-3"
                                                data-kt-ecommerce-product-filter="delete_row" data-href = "{{ route('admin-delete-store', ['store' => $store->id]) }}">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Products-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

    @section('script')
    <script>
        "use strict";
    
        // Class definition
        var KTAppEcommerceProducts = function () {
            // Shared variables
            var table;
            var datatable;

            // Private functions
            var initDatatable = function () {
                // Init datatable --- more info on datatables: https://datatables.net/manual/
                datatable = $(table).DataTable({
                    "info": false,
                    'order': [],
                    'pageLength': 10,
                    'columnDefs': [
                        { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                        { orderable: false, targets: 3 }, // Disable ordering on column 3 (actions)
                    ]
                });

                // Re-init functions on datatable re-draws
                datatable.on('draw', function () {
                    handleDeleteRows();
                });
            }

            // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
            var handleSearchDatatable = () => {
                const filterSearch = document.querySelector('[data-kt-ecommerce-product-filter="search"]');
                filterSearch.addEventListener('keyup', function (e) {
                    datatable.search(e.target.value).draw();
                });
            }

            // Delete cateogry
            var handleDeleteRows = () => {
                // Select all delete buttons
                const deleteButtons = table.querySelectorAll('[data-kt-ecommerce-category-filter="delete_row"]');

                deleteButtons.forEach(d => {
                    // Delete button on click
                    d.addEventListener('click', function (e) {
                        e.preventDefault();

                        // Select parent row
                        const parent = e.target.closest('tr');

                        // Get category name
                        const categoryName = parent.querySelector('[data-kt-ecommerce-category-filter="category_name"]').innerText;

                        // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                        Swal.fire({
                            text: "Are you sure you want to delete " + categoryName + "?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                        
                                fetch(d.getAttribute('data-href'), {
                                    method : "DELETE",
                                    headers : {
                                    'X-CSRF-TOKEN' : $('meta[name=csrf-token]').attr('value'),
                                    "accept-Type" : 'application/json',
                                    }
                                })
                                    .then(data => data.json())
                                    .then(data => {
                                        if(data[0]) {
                                            Swal.fire({
                                                text: "You have deleted " + categoryName + " Category!.",
                                                icon: "success",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {
                                                    confirmButton: "btn fw-bold btn-primary",
                                                }
                                            }).then(function () {
                                                // Remove current row
                                                datatable.row($(parent)).remove().draw();
                                            });
                                        } else {
                                            Swal.fire({
                                                text: "Could not delete " + categoryName + "!. As it has products linked to it.",
                                                icon: "error",
                                                buttonsStyling: false,
                                                confirmButtonText: "Ok, got it!",
                                                customClass: {
                                                    confirmButton: "btn fw-bold btn-primary",
                                                }
                                            })

                                        }
                                    })

                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: categoryName + " was not deleted.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    })
                });
            }

    
            
            // Public methods
            return {
                init: function () {
                    table = document.querySelector('#kt_ecommerce_product_table');

                    if (!table) {
                        return;
                    }

                    initDatatable();
                    handleSearchDatatable();
                    handleDeleteRows();
                }
            };
        }();
    
        // On document ready
        KTUtil.onDOMContentLoaded(function () {
            KTAppEcommerceProducts.init();
        });
    </script>

    @endsection
@endsection