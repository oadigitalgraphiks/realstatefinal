@extends('backend.layouts.app')
@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div  class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        {{ translate('Add Signup Options') }}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary"> {{ translate('home')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{translate('settings')}}</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> <a class="text-muted" href="{{route('agency_signup_options.index')}}" >{{translate('Signup Options')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>

    
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('agency_signup_options.store') }}"
                    method="POST" enctype="multipart/form-data">
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
                                    <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name" class="form-control mb-2" required>
                                </div>

                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Slug') }}</label>
                                    <input type="text" placeholder="{{ translate('Slug') }}" id="slug" name="slug" class="form-control mb-2">
                                </div>

                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Parent Property Type') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="parent" name="parent"
                                        data-live-search="true">
                                        <option value="0">{{ translate('No Parent') }}</option>
                                        @foreach ($agency_signup_options as $agency_signup_option)
                                            <option value="{{ $agency_signup_option->id }}">{{ $agency_signup_option->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Ordering Number') }}</label>
                                    <input type="number" name="order_level" class="form-control mb-2" id="order_level"
                                        placeholder="{{ translate('Order Level') }}">
                                </div>

                            </div>

                            <div class="my-3 text-center " >
                                <button type="submit" class="btn btn-primary" >{{ translate('Submit') }}</button> 
                            </div>
                        </div>
                    </div>
             </form>
        </div>
    </div>
@endsection
@section('script')
  

@endsection
