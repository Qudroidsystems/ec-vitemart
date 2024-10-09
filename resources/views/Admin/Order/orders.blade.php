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
                                type="text" data-kt-ecommerce-order-filter="search"
                                class="form-control form-control-solid w-250px ps-12"
                                placeholder="Search Order" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->

                    <!--begin::Card toolbar-->
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <!--begin::Flatpickr-->
                        <div class="input-group w-250px">
                            <input class="form-control form-control-solid rounded rounded-end-0"
                                placeholder="Pick date range" id="kt_ecommerce_sales_flatpickr" />
                            <button class="btn btn-icon btn-light"
                                id="kt_ecommerce_sales_flatpickr_clear">
                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span
                                        class="path2"></span></i> </button>
                        </div>
                        <!--end::Flatpickr-->

                        <div class="w-100 mw-150px">
                            <!--begin::Select2-->
                            <select class="form-select form-select-solid" data-control="select2"
                                data-hide-search="true" data-placeholder="Status"
                                data-kt-ecommerce-order-filter="status">
                                <option></option>
                                <option value="all">All</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Completed">Completed</option>
                                <option value="Denied">Denied</option>
                                <option value="Expired">Expired</option>
                                <option value="Failed">Failed</option>
                                <option value="Pending">Pending</option>
                                <option value="Processing">Processing</option>
                                <option value="Refunded">Refunded</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Delivering">Delivering</option>
                            </select>
                            <!--end::Select2-->
                        </div>

                        <!--begin::Add product-->
                        <a href="../catalog/add-product.html" class="btn btn-primary">
                            Add Order
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
                        id="kt_ecommerce_sales_table">
                        <thead>
                            <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox"
                                            data-kt-check="true"
                                            data-kt-check-target="#kt_ecommerce_sales_table .form-check-input"
                                            value="1" />
                                    </div>
                                </th>
                                <th class="min-w-100px">Order ID</th>
                                <th class="min-w-175px">Customer</th>
                                <th class="text-end min-w-70px">Status</th>
                                <th class="text-end min-w-100px">Total</th>
                                <th class="text-end min-w-100px">Date Added</th>
                                <th class="text-end min-w-100px">Date Modified</th>
                                <th class="text-end min-w-100px">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            @foreach ($orders as $order)
                            <tr>
                                <td>
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a href="details.html"
                                        class="text-gray-800 text-hover-primary fw-bold">
                                        {{$order->id}} </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div
                                            class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="../../user-management/users/view.html">
                                                <div class="symbol-label">
                                                    <img src="../../../assets/media/avatars/300-13.jpg"
                                                        alt="John Miller" class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="../../user-management/users/view.html"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">{{$order->customer->name}}
                                                </a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0" data-order="Completed">
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">{{$order->status}}</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">{{$order->total_cost}}</span>
                                </td>
                                <td class="text-end" data-order="{{$order->created_at}}">
                                    <span class="fw-bold">{{$order->created_at}}</span>
                                </td>
                                <td class="text-end" data-order="{{$order->updated_at}}">
                                    <span class="fw-bold">{{$order->updated_at}}</span>
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
                                            <a href="details.html" class="menu-link px-3">
                                                View
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        @if($order->handler_id)
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="edit-order.html" class="menu-link px-3">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-order-filter="delete_row">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        @endif
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a href="details.html"
                                        class="text-gray-800 text-hover-primary fw-bold">
                                        13739 </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div
                                            class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="../../user-management/users/view.html">
                                                <div
                                                    class="symbol-label fs-3 bg-light-danger text-danger">
                                                    O </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="../../user-management/users/view.html"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">Olivia
                                                Wild</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0" data-order="Failed">
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Failed</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">$91.00</span>
                                </td>
                                <td class="text-end" data-order="2023-06-05">
                                    <span class="fw-bold">05/06/2023</span>
                                </td>
                                <td class="text-end" data-order="2023-06-10">
                                    <span class="fw-bold">10/06/2023</span>
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
                                            <a href="details.html" class="menu-link px-3">
                                                View
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="edit-order.html" class="menu-link px-3">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-order-filter="delete_row">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a href="details.html"
                                        class="text-gray-800 text-hover-primary fw-bold">
                                        13740 </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div
                                            class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="../../user-management/users/view.html">
                                                <div class="symbol-label">
                                                    <img src="../../../assets/media/avatars/300-23.jpg"
                                                        alt="Dan Wilson" class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="../../user-management/users/view.html"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">Dan
                                                Wilson</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0" data-order="Denied">
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-danger">Denied</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">$403.00</span>
                                </td>
                                <td class="text-end" data-order="2023-06-02">
                                    <span class="fw-bold">02/06/2023</span>
                                </td>
                                <td class="text-end" data-order="2023-06-09">
                                    <span class="fw-bold">09/06/2023</span>
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
                                            <a href="details.html" class="menu-link px-3">
                                                View
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="edit-order.html" class="menu-link px-3">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-order-filter="delete_row">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a href="details.html"
                                        class="text-gray-800 text-hover-primary fw-bold">
                                        13741 </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div
                                            class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="../../user-management/users/view.html">
                                                <div
                                                    class="symbol-label fs-3 bg-light-danger text-danger">
                                                    M </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="../../user-management/users/view.html"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">Melody
                                                Macy</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0" data-order="Completed">
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-success">Completed</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">$268.00</span>
                                </td>
                                <td class="text-end" data-order="2023-06-05">
                                    <span class="fw-bold">05/06/2023</span>
                                </td>
                                <td class="text-end" data-order="2023-06-08">
                                    <span class="fw-bold">08/06/2023</span>
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
                                            <a href="details.html" class="menu-link px-3">
                                                View
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="edit-order.html" class="menu-link px-3">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-order-filter="delete_row">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td data-kt-ecommerce-order-filter="order_id">
                                    <a href="details.html"
                                        class="text-gray-800 text-hover-primary fw-bold">
                                        13742 </a>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!--begin:: Avatar -->
                                        <div
                                            class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                            <a href="../../user-management/users/view.html">
                                                <div class="symbol-label">
                                                    <img src="../../../assets/media/avatars/300-25.jpg"
                                                        alt="Brian Cox" class="w-100" />
                                                </div>
                                            </a>
                                        </div>
                                        <!--end::Avatar-->

                                        <div class="ms-5">
                                            <!--begin::Title-->
                                            <a href="../../user-management/users/view.html"
                                                class="text-gray-800 text-hover-primary fs-5 fw-bold">Brian
                                                Cox</a>
                                            <!--end::Title-->
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end pe-0" data-order="Processing">
                                    <!--begin::Badges-->
                                    <div class="badge badge-light-primary">Processing</div>
                                    <!--end::Badges-->
                                </td>
                                <td class="text-end pe-0">
                                    <span class="fw-bold">$338.00</span>
                                </td>
                                <td class="text-end" data-order="2023-06-04">
                                    <span class="fw-bold">04/06/2023</span>
                                </td>
                                <td class="text-end" data-order="2023-06-07">
                                    <span class="fw-bold">07/06/2023</span>
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
                                            <a href="details.html" class="menu-link px-3">
                                                View
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="edit-order.html" class="menu-link px-3">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3"
                                                data-kt-ecommerce-order-filter="delete_row">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                </td>
                            </tr>
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
var KTAppEcommerceSalesListing = function () {
    // Shared variables
    var table;
    var datatable;
    var flatpickr;
    var minDate, maxDate;

    // Private functions
    var initDatatable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            'pageLength': 10,
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                { orderable: false, targets: 7 }, // Disable ordering on column 7 (actions)
            ]
        });

        // Re-init functions on datatable re-draws
        datatable.on('draw', function () {
            handleDeleteRows();
        });
    }

    // Init flatpickr --- more info :https://flatpickr.js.org/getting-started/
    var initFlatpickr = () => {
        const element = document.querySelector('#kt_ecommerce_sales_flatpickr');
        flatpickr = $(element).flatpickr({
            altInput: true,
            altFormat: "d/m/Y",
            dateFormat: "Y-m-d",
            mode: "range",
            onChange: function (selectedDates, dateStr, instance) {
                handleFlatpickr(selectedDates, dateStr, instance);
            },
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-ecommerce-order-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    // Handle status filter dropdown
    var handleStatusFilter = () => {
        const filterStatus = document.querySelector('[data-kt-ecommerce-order-filter="status"]');
        $(filterStatus).on('change', e => {
            let value = e.target.value;
            if (value === 'all') {
                value = '';
            }
            datatable.column(3).search(value).draw();
        });
    }

    // Handle flatpickr --- more info: https://flatpickr.js.org/events/
    var handleFlatpickr = (selectedDates, dateStr, instance) => {
        minDate = selectedDates[0] ? new Date(selectedDates[0]) : null;
        maxDate = selectedDates[1] ? new Date(selectedDates[1]) : null;

        // Datatable date filter --- more info: https://datatables.net/extensions/datetime/examples/integration/datatables.html
        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function (settings, data, dataIndex) {
                var min = minDate;
                var max = maxDate;
                var dateAdded = new Date(moment($(data[5]).text(), 'DD/MM/YYYY'));
                var dateModified = new Date(moment($(data[6]).text(), 'DD/MM/YYYY'));

                if (
                    (min === null && max === null) ||
                    (min === null && max >= dateModified) ||
                    (min <= dateAdded && max === null) ||
                    (min <= dateAdded && max >= dateModified)
                ) {
                    return true;
                }
                return false;
            }
        );
        datatable.draw();
    }

    // Handle clear flatpickr
    var handleClearFlatpickr = () => {
        const clearButton = document.querySelector('#kt_ecommerce_sales_flatpickr_clear');
        clearButton.addEventListener('click', e => {
            flatpickr.clear();
        });
    }

    // Delete cateogry
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-ecommerce-order-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get category name
                const orderID = parent.querySelector('[data-kt-ecommerce-order-filter="order_id"]').innerText;

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete order: " + orderID + "?",
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
                        Swal.fire({
                            text: "You have deleted " + orderID + "!.",
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
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: orderID + " was not deleted.",
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
            table = document.querySelector('#kt_ecommerce_sales_table');

            if (!table) {
                return;
            }

            initDatatable();
            initFlatpickr();
            handleSearchDatatable();
            handleStatusFilter();
            handleDeleteRows();
            handleClearFlatpickr();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTAppEcommerceSalesListing.init();
});
    </script>

    @endsection
@endsection