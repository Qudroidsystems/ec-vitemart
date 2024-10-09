<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/vue3';
    import { reactive, ref } from 'vue'
    import { router } from '@inertiajs/vue3'

    var loading = ref(false);

    const form = reactive({
        avatar : null,
        name: null,
        description: null,
        status: 'published'
    });

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
    <Head title="Add Category" />

    <AuthenticatedLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <!--begin::Main-->
                        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                            <!--begin::Content wrapper-->
                            <div class="d-flex flex-column flex-column-fluid">
                                <!--begin::Content-->
                                <div id="kt_app_content" class="app-content  flex-column-fluid " >
                                    
                                                
                                    <!--begin::Content container-->
                                    <div id="kt_app_content_container" class="app-container  container-xxl ">
                                        <form id="kt_ecommerce_add_category_form" @submit.prevent="submit" class="form d-flex flex-column flex-lg-row" data-kt-redirect="categories.html">
                                            <!--begin::Aside column-->
                                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10">
                                                <!--begin::Thumbnail settings-->
                                                <div class="card card-flush py-4">
                                                    <!--begin::Card header-->
                                                    <div class="card-header">
                                                        <!--begin::Card title-->
                                                        <div class="card-title">
                                                            <h2>Cover Image</h2>
                                                        </div>
                                                        <!--end::Card title-->
                                                    </div>
                                                    <!--end::Card header-->

                                                    <!--begin::Card body-->
                                                    <div class="card-body text-center pt-0">
                                                        <!--begin::Image input-->
                                                                    <!--begin::Image input placeholder-->
                                                            
                                                            <!--end::Image input placeholder-->
                                                        
                                                        <!--begin::Image input-->
                                                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                            <!--begin::Preview existing avatar-->
                                                            <div class="image-input-wrapper w-150px h-150px"></div>
                                                            <!--end::Preview existing avatar-->

                                                            <!--begin::Label-->
                                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                                                <!--begin::Icon-->
                                                                <i class="ki-duotone ki-pencil fs-7"><span class="path1"></span><span class="path2"></span></i>                <!--end::Icon-->

                                                                <!--begin::Inputs-->
                                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg" @input = "form.avatar = $event.target.files[0]" />
                                                                <input type="hidden" name="avatar_remove" />
                                                                <!--end::Inputs-->
                                                            </label>
                                                            <!--end::Label-->

                                                            <progress v-if = "form.progress" :value = "form.progress.percentage" max = 100>{{ form.progress.percentage}}</progress>

                                                            <!--begin::Cancel-->
                                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                                            <!--end::Cancel-->

                                                            <!--begin::Remove-->
                                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                                                <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i>            </span>
                                                            <!--end::Remove-->
                                                        </div>
                                                        <!--end::Image input-->

                                                        <!--begin::Description-->
                                                        <div class="text-muted fs-7">Set the category cover image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Thumbnail settings-->
                                                        <!--begin::Status-->
                                                <div class="card card-flush py-4">
                                                    <!--begin::Card header-->
                                                    <div class="card-header">
                                                        <!--begin::Card title-->
                                                        <div class="card-title">
                                                            <h2>Status</h2>
                                                        </div>
                                                        <!--end::Card title-->

                                                        <!--begin::Card toolbar-->
                                                        <div class="card-toolbar">
                                                            <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_category_status"></div>
                                                        </div>
                                                        <!--begin::Card toolbar-->
                                                    </div>
                                                    <!--end::Card header-->

                                                    <!--begin::Card body-->
                                                    <div class="card-body pt-0">
                                                        <!--begin::Select2-->
                                                        <select class="form-select mb-2" v-model = "form.status" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_category_status_select">
                                                            <option value="published" selected>Published</option>
                                                            <option value="unpublished">Unpublished</option>
                                                        </select>
                                                        <!--end::Select2-->

                                                    </div>
                                                    <!--end::Card body-->
                                                </div>
                                                <!--end::Status-->
                                                </div>
                                            <!--end::Aside column-->

                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                                                <!--begin::General options-->
                                                <div class="card card-flush py-4">
                                                    <!--begin::Card header-->
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h2>General</h2>
                                                        </div>
                                                    </div>
                                                    <!--end::Card header-->

                                                    <!--begin::Card body-->
                                                    <div class="card-body pt-0">
                                                        <!--begin::Input group-->
                                                        <div class="mb-10 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="required form-label">Category Name</label>
                                                            <!--end::Label-->

                                                            <!--begin::Input-->
                                                            <input type="text" name="category_name" class="form-control mb-2" v-model="form.name" placeholder="Category name" value="" />
                                                            <!--end::Input-->

                                                            <!--begin::Description-->
                                                            <div class="text-muted fs-7">A category name is required and recommended to be unique.</div>
                                                            <!--end::Description-->
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div>
                                                            <!--begin::Label-->
                                                            <label class="form-label">Description</label>
                                                            <!--end::Label-->

                                                            <!--begin::Editor-->
                                                            <textarea id="kt_ecommerce_add_category_description"  v-model="form.description" name="kt_ecommerce_add_category_description" class="min-h-200px mb-2"></textarea>
                                                            <!--end::Editor-->

                                                            <!--begin::Description-->
                                                            <div class="text-muted fs-7">Set a description to the category for better visibility.</div>
                                                            <!--end::Description-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <!--end::Card header-->
                                                </div>
                                                <!--end::General options-->
                                                
                                                <!--end::Automation-->
                                                <div class="d-flex justify-content-end">
                                                
                                                    <!--begin::Button-->
                                                    <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                                        <span v-if="!loading" class="indicator-label">
                                                            Save Changes
                                                        </span>
                                                        <span v-else class="indicator-progress">
                                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                        </span>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                            </div>
                                            <!--end::Main column-->
                                        </form>        
                                    </div>
                                    <!--end::Content container-->
                                </div>
                            <!--end::Content-->					
                        </div>
                        <!--end::Content wrapper-->

                        </div>
                        <!--end:::Main-->
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style>
    .image-input-placeholder {
        background-image: url('../../../assets/media/svg/files/blank-image.svg');
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url('../../../assets/media/svg/files/blank-image-dark.svg');
    }                
</style>