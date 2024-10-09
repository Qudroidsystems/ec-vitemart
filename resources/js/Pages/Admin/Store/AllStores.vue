<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Add Category" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!-- ============================================================== -->
                        <!-- Start right Content here -->
                        <!-- ============================================================== -->
                        <div class="main-content">

                                <div class="page-content">
                                    <div class="container-fluid">

                                        <!-- start page title -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                                    <h4 class="mb-sm-0">Sellers</h4>

                                                    <div class="page-title-right">
                                                        <ol class="breadcrumb m-0">
                                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                                                            <li class="breadcrumb-item active">Sellers</li>
                                                        </ol>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end page title -->

                                        <div class="row g-3 mb-4">
                                            <div class="col-xxl-auto me-auto">
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSellerModal"><i class="bi bi-plus-circle align-baseline me-1"></i> Add Sellers</button>
                                            </div><!--end col-->
                                            <div class="col-xxl-2">
                                                <div class="search-box">
                                                    <input type="text" class="form-control" id="searchResultList" autocomplete="off" placeholder="Search for sellers & owner name or something..."> <i class="ri-search-line search-icon"></i>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-xxl-2">
                                                <select class="form-control" id="select-category" data-choices data-choices-search-false>
                                                    <option value="">Select Categories</option>
                                                    <option value="All">All</option>
                                                    <option value="Retailer">Retailer</option>
                                                    <option value="Health & Medicine">Health & Medicine</option>
                                                    <option value="Manufacturer">Manufacturer</option>
                                                    <option value="Food Service">Food Service</option>
                                                    <option value="Computers & Electronics">Computers & Electronics</option>
                                                </select>
                                            </div><!--end col-->
                                        </div><!--end row-->

                                        <div class="row" id="seller-list">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="card m-2">
                                                    <div class="card-body">
                                                        <div class="text-end mb-3">
                                                            <button type="button" class="btn-close text-end" aria-label="Close" data-bs-toggle="modal" data-bs-target="#removeItemModal"></button>
                                                        </div>
                                                        <div class="avatar-md mx-auto">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="assets/images/companies/img-1.png" alt="" class="avatar-sm p-1">
                                                            </div>
                                                        </div>
                                                        <div class="text-center mt-4">
                                                            <a href="apps-ecommerce-seller-overview.html"><h5>Zibra Fashion</h5></a>
                                                            <p class="text-muted mb-0">Lenna Labadie</p>
                                                        </div>
                                                    </div>
                                                    <div class="row g-0 text-center">
                                                        <div class="col-xxl-4 col-lg-6 col-md-4">
                                                            <div class="card-body px-3 border-top border-bottom border-end border-dashed">
                                                                <h5 class="mb-1">451</h5>
                                                                <p class="text-muted text-truncate mb-0">Item Stock</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-4 col-lg-6 col-md-4">
                                                            <div class="card-body h-100 px-3 border-top border-bottom border-end border-dashed">
                                                                <div id="chart-seller1" data-colors='["--tb-danger"]' dir="ltr"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-4 col-lg-6 col-md-4">
                                                            <div class="card-body px-3 border-top border-bottom border-dashed">
                                                                <h5 class="mb-1">$253.32</h5>
                                                                <p class="text-muted text-truncate mb-0">Revenue</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body hstack gap-2">
                                                        <a href="apps-ecommerce-seller-overview.html" class="btn btn-subtle-secondary w-100">View Details</a>
                                                        <button type="button" class="btn btn-subtle-primary w-100"  data-bs-toggle="modal" data-bs-target="#addSellerModal">Edit</button>
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                            <div class="col-lg-3 col-md-6">
                                                <div class="card m-2">
                                                    <div class="card-body">
                                                        <div class="text-end mb-3">
                                                            <button type="button" class="btn-close text-end" aria-label="Close" data-bs-toggle="modal" data-bs-target="#removeItemModal"></button>
                                                        </div>
                                                        <div class="avatar-md mx-auto">
                                                            <div class="avatar-title bg-light rounded">
                                                                <img src="assets/images/companies/img-7.png" alt="" class="avatar-sm p-1">
                                                            </div>
                                                        </div>
                                                        <div class="text-center mt-4">
                                                            <a href="apps-ecommerce-seller-overview.html">
                                                                <h5>Pich Fashion</h5>
                                                            </a>
                                                            <p class="text-muted mb-0">Jaylon McClure</p>
                                                        </div>
                                                    </div>
                                                    <div class="row g-0 text-center">
                                                        <div class="col-xxl-4 col-lg-6 col-md-4">
                                                            <div class="card-body px-3 border-top border-bottom border-end border-dashed">
                                                                <h5 class="mb-1">792</h5>
                                                                <p class="text-muted text-truncate mb-0">Item Stock</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-4 col-lg-6 col-md-4">
                                                            <div class="card-body px-3 h-100 border-top border-bottom border-end border-dashed">
                                                                <div id="chart-seller2" data-colors='["--tb-success"]' dir="ltr"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-4 col-lg-6 col-md-4">
                                                            <div class="card-body px-3 border-top border-bottom border-dashed">
                                                                <h5 class="mb-1">$357.44</h5>
                                                                <p class="text-muted text-truncate mb-0">Revenue</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body hstack gap-2">
                                                        <a href="apps-ecommerce-seller-overview.html" class="btn btn-subtle-secondary w-100">View Details</a>
                                                        <button type="button" class="btn btn-subtle-primary w-100"  data-bs-toggle="modal" data-bs-target="#addSellerModal">Edit</button>
                                                    </div>
                                                </div>
                                            </div><!--end col-->
                                        </div><!--end row-->
                                        
                                        <div class="row align-items-center mb-4 justify-content-between text-center text-sm-start mt-auto" id="pagination-element">
                                            <div class="col-sm">
                                                <div class="text-muted">
                                                    Showing <span class="fw-semibold">8</span> of <span class="fw-semibold">13</span> Results
                                                </div>
                                            </div>
                                            <div class="col-sm-auto  mt-3 mt-sm-0">
                                                <div class="pagination-block pagination pagination-separated justify-content-center justify-content-sm-end mb-sm-0">
                                                    <div class="page-item">
                                                        <a href="javascript:void(0);" class="page-link" id="page-prev">Previous</a>
                                                    </div>
                                                    <span id="page-num" class="pagination"></span>
                                                    <div class="page-item">
                                                        <a href="javascript:void(0);" class="page-link" id="page-next">Next</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="noresult" class="d-none">
                                            <div class="text-center py-4">
                                                <div class="avatar-md mx-auto mb-4">
                                                    <div class="avatar-title bg-light text-primary rounded-circle fs-4xl">
                                                        <i class="bi bi-search"></i>
                                                    </div>
                                                </div>
                                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                                <p class="text-muted mb-0">We've searched more than 150+ sellers We did not find any sellers for you search.</p>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- container-fluid -->
                                </div>
                                <!-- End Page-content -->

                            </div>
                        <!-- end main content-->

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
