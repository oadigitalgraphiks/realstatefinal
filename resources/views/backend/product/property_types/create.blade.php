@extends('backend.layouts.app')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> {{ translate('Add New') }}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted  text-hover-primary">{{ translate('Home') }} </a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{route('products.all')}}" class="text-muted text-hover-primary">{{ translate('Properties') }}</a></li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"><a href="{{route('property_type.index')}}" class="text-muted text-hover-primary">{{ translate('Property Types') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end::Toolbar-->


        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('property_type.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Name') }}</label>
                                    <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name" class="title form-control mb-2" required>
                                        @if($errors->has('name'))
                                        <div class="error text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                </div>

                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Slug') }}</label>
                                    <input type="text" placeholder="{{ translate('slug') }}" id="slug" name="slug" class="slug form-control mb-2" required>
                                    @if($errors->has('slug'))
                                     <div class="error text-danger">{{ $errors->first('slug') }}</div>
                                     @endif
                                </div>

                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Parent') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="parent_id" name="parent_id"
                                        data-live-search="true">
                                        <option value="0">{{ translate('No Parent') }}</option>
                                        @foreach ($property_type as $property_type)
                                            <option value="{{ $property_type->id }}">{{ $property_type->getTranslation('name') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="fv-row mb-2">
                                    <label class="form-label">{{ translate('Icon') }} <b>(120 x 120)</b></label>
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image">
                                        <div class="dz-message needsclick">
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <input type="hidden" name="icon" class="selected-files">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1"> {{translate(' Drop files here or click to upload.')}}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="file-preview box sm"></div>
                                </div>

                                <div class="py-2">
                                    <label class="form-label">{{ translate('Description') }}</label>
                                    <textarea name="meta_description" rows="3" class="form-control mb-2"></textarea>
                                </div>

                                <div class="py-2"  >
                                    <label class="form-label">{{ translate('Order level')}}</label>
                                    <input type="number" name="order_level" class="form-control mb-2" id="order_level" value="0" placeholder="{{ translate('Order Level') }}">
                                </div>

                                <div class="text-center pt-3">
                                    <button class="btn btn-primary" type="submit"> {{translate('Submit')}}</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
       </div>
@endsection
@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>

    <script>

         $(".title").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".slug").val(Text);        
         });

         $(".slug").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".slug").val(Text);        
         });


    </script>
@endsection
