<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { computed, reactive, ref } from 'vue'
    import { router, usePage } from '@inertiajs/vue3'

    const page = usePage();

    const brands = computed(() => page.props.brands);
    const categories = computed(() => page.props.categories);

    var loading = ref(false);

    const form = reactive({
        name: null,
        short_description: null,
        description: null,
        on_sale: true,
        quantify_in_stock : 0,
        category_id : null,
        brand_id : null,
        unit : 'pieces',
        refundable : true,
        retail_price_in_naira : 0,
        sale_price_in_naira : 0,
        discount : 0,
        visibility : 'public'
    });

    function discount() {
        form.sale_price_in_naira = form.retail_price_in_naira - (form.retail_price_in_naira * (form.discount / 100))
    }

    function submit() {
        loading = true;
        router.post(route('admin-edit-category'), form, {
            onSuccess : () => {
                loading = false
            },
            headers: {
                "X-CRSF-TOKEN" : $('meta[name=_token]').attr('content')
            },
        })
    }
</script>

<template>
    <Head title="Add Product" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                                                <h4 class="mb-sm-0">Add Product</h4>

                                                <div class="page-title-right">
                                                    <ol class="breadcrumb m-0">
                                                        <li class="breadcrumb-item">
                                                            <Link :href="route('admin-dashboard')">Administrator</Link>
                                                        </li>
                                                        <li class="breadcrumb-item active">Add Product</li>
                                                    </ol>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- end page title -->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xxl-4">
                                                            <h5 class="card-title mb-3">Product Information</h5>
                                                            <p class="text-muted">Product Information refers to any information held by an organisation about the products it produces, buys, sells or distributes.</p>
                                                        </div>
                                                        <div class="col-xxl-8">
                                                            <form @submit.prevent = "submit()">
                                                                <div class="mb-3">
                                                                    <label for="productTitle" class="form-label">Product Title <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control" v-model = "form.name" id="productTitle" placeholder="Enter product title" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="productCategories" class="form-label">Category <span class="text-danger">*</span></label>
                                                                    <select class="form-control" data-choices v-model = "form.category_id" id="productCategories">
                                                                        <option value="">Select category</option>
                                                                        <option v-for = "category in categories" v-bind:key = "category.id" value="category.id">{{ category.name }}</option>
                                                                        <!-- <option value="Appliances">Appliances</option>
                                                                        <option value="Automotive Accessories">Automotive Accessories</option>
                                                                        <option value="Electronics">Electronics</option>
                                                                        <option value="Fashion">Fashion</option>
                                                                        <option value="Furniture">Furniture</option>
                                                                        <option value="Footwear">Footwear</option>
                                                                        <option value="Sportswear">Sportswear</option>
                                                                        <option value="Watches">Watches</option>
                                                                        <option value="Headphones">Headphones</option>
                                                                        <option value="Other Accessories">Other Accessories</option> -->
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="productCategories" class="form-label">Brand <span class="text-danger">*</span></label>
                                                                    <select class="form-control" data-choices v-model = "form.category_id" id="productCategories">
                                                                        <option value="">Select brand</option>
                                                                        <option v-for = "brand in brands" v-bind:key = "brand.id" value="category.id">{{ brand.name }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="shortDecs" class="form-label">Short Description <span class="text-danger">*</span></label>
                                                                    <textarea class="form-control" id="shortDecs" v-model = "form.short_description" placeholder="Must enter minimum of a 100 characters" rows="3"></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="mb-3">
                                                                            <label for="productUnit" class="form-label">Unit <span class="text-danger">*</span></label>
                                                                            <select  v-model = "form.unit" class="form-control" data-choices name="productUnit" id="productUnit">
                                                                                <option value="">Select Unit</option>
                                                                                <option value="kilogram" selected>Kilogram</option>
                                                                                <option value="pieces">Pieces</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Tags</label>
                                                                    <input class="form-control" id="choices-text-unique-values" data-choices data-choices-text-unique-true data-choices-removeItem type="text" value="Fashion, Style, Brands, Puma">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="form-check form-switch mb-3">
                                                                            <input class="form-check-input"  v-model = "form.on_sale" type="checkbox" role="switch" id="onsale">
                                                                            <label class="form-check-label" for="onsale">On Sale</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="form-check form-switch mb-3">
                                                                            <input class="form-check-input" type="checkbox" role="switch" v-model = "form.refundable" id="refundableInput">
                                                                            <label class="form-check-label" for="refundableInput">Refundable</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xxl-4">
                                                            <h5 class="card-title mb-3">Description</h5>
                                                            <p class="text-muted">Product Information refers to any information held by an organization about the products it produces, buys, sells or distributes.</p>
                                                        </div><!--end col-->
                                                        <div class="col-xxl-8">
                                                            <div>
                                                                <label class="form-label" for="description">Product Description <span class="text-danger">*</span></label>
                                                                <textarea class="form-control" id="description" v-model = "form.description" placeholder="Must enter minimum of a 100 characters" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div><!--end row-->
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xxl-4">
                                                            <h5 class="card-title mb-3">Images</h5>
                                                            <p class="text-muted">Product Information refers to any information held by an organization about the products it produces, buys, sells or distributes.</p>
                                                        </div><!--end col-->
                                                        <div class="col-xxl-8">
                                                            <div class="mb-3">
                                                                <label class="form-label">Product Images <span class="text-danger">*</span></label>
                                                                <div class="dropzone text-center">
                                                                    <div class="fallback">
                                                                        <input name="file" @input = "form.avatar = $event.target.files[0]" type="file" multiple="multiple">
                                                                    </div>
                                                                    <div class="dz-message needsclick">
                                                                        <div class="mb-3">
                                                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                                        </div>
                                                                
                                                                        <h4>Drop product images here or click to upload.</h4>
                                                                    </div>
                                                                </div>
                                                                
                                                                <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                                    <li class="mt-2" id="dropzone-preview-list">
                                                                        <!-- This is used as the file preview template -->
                                                                        <div class="border rounded">
                                                                            <div class="d-flex p-2">
                                                                                <div class="flex-shrink-0 me-3">
                                                                                    <div class="avatar-sm bg-light rounded">
                                                                                        <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="flex-grow-1">
                                                                                    <div class="pt-1">
                                                                                        <h5 class="fs-md mb-1" data-dz-name>&nbsp;</h5>
                                                                                        <p class="fs-sm text-muted mb-0" data-dz-size></p>
                                                                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="flex-shrink-0 ms-3">
                                                                                    <button type = "button" data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                                <!-- end dropzon-preview -->
                                                            </div>

                                                        </div>
                                                    </div><!--end row-->
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-xxl-4">
                                                            <h5 class="card-title mb-3">General Info</h5>
                                                            <p class="text-muted mb-0">An informational product can be a digital book (or e-book), a digital report, a white paper, a piece of software, audio or video files, a website, an e-zine or a newsletter.</p>
                                                        </div><!--end col-->
                                                        <div class="col-xxl-8">
                                                            <div class="row gy-3">
                                                                <div class="col-lg-4">
                                                                    <div>
                                                                        <label for="productStocks" class="form-label">Quantity in Stock <span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" id="productStocks" v-model="form.quantify_in_stock" placeholder="Stocks" required>
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-lg-4">
                                                                    <div>
                                                                        <label class="form-label" for="product-price-input">Retail Price of One</label>
                                                                        <div class="input-group has-validation">
                                                                            <span class="input-group-text" id="product-price-addon">$</span>
                                                                            <input type="number" class="form-control" id="product-price-input" v-model="form.sale_price_in_naira" placeholder="Enter price" aria-label="Price" aria-describedby="product-price-addon" required="">
                                                                            <div class="invalid-feedback">Please Enter a product price.</div>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="form-label" for="product-price-input">Discount on One</label>
                                                                        <div class="input-group has-validation">
                                                                            <span class="input-group-text" id="product-price-addon">%</span>
                                                                            <input type="number" class="form-control" id="product-price-input" v-model="form.discount" @change = "discount()" placeholder="Enter discount on one" aria-label="Price" aria-describedby="product-price-addon" required="">
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <label class="form-label" for="product-price-input">Sale Price of One</label>
                                                                        <div class="input-group has-validation">
                                                                            <span class="input-group-text" id="product-price-addon">$</span>
                                                                            <input type="number" class="form-control" disabled id="product-price-input" v-model="form.retail_price_in_naira" aria-label="Price" aria-describedby="product-price-addon" required="">
                                                                        </div>
                                                                    </div>
                                                                </div><!--end col-->
                                                                <div class="col-lg-6">
                                                                    <div>
                                                                        <label for="choices-publish-visibility-input" class="form-label">Visibility</label>
                                                                        <select class="form-select" id="choices-publish-visibility-input" v-model = "form.visibility" data-choices data-choices-search-false>
                                                                            <option value="Public" selected>Public</option>
                                                                            <option value="Hidden">Hidden</option>
                                                                        </select>
                                                                    </div>
                                                                </div><!--end col-->
                                                            </div><!--end row-->
                                                        </div>
                                                    </div><!--end row-->
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->

                                    <div class="hstack gap-2 justify-content-end mb-3">
                                        <button class="btn btn-danger"><i class="ph-x align-middle"></i> Cancel</button>
                                        <button class="btn btn-primary">Submit</button>
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
