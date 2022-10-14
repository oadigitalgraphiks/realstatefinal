@extends('backend.layouts.app')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ translate('Edit Signup Option') }}</h1>
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
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Models\Language::all() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                href="{{ route('agency_signup_options.edit', ['id' => $agency_signup_option->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('agency_signup_options.update', $agency_signup_option->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                 
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">   
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2> {{ translate('General') }} </h2>
                                </div>
                            </div>
                          
                            <div class="card-body pt-0">
                                <div class="mb-5 fv-row">
                                    <label class="required form-label">{{ translate('Signup Option Name') }}</label>
                                    <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name" class="form-control mb-2" value="{{ $agency_signup_option->name }}" required>
                                </div>

                                <div class="mb-5 fv-row">
                                    <label class="form-label">{{ translate('Signup Option Slug') }}</label>
                                    <input type="text" placeholder="{{ translate('Slug') }}" id="slug" name="slug" class="form-control mb-2" value="{{$agency_signup_option->slug }}" > 
                                </div>

                               
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Parent Property Purposee') }}</label>
                                    <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                        data-placeholder="Select an option" id="parent" name="parent"
                                        data-live-search="true">
                                        <option value="0">{{ translate('No Parent') }}</option>
                                        @foreach ($agency_signup_options as $aagency_signup_option)
                                            <option value="{{ $aagency_signup_option->id }}"
                                                @if($aagency_signup_option->id == $agency_signup_option->parent)
                                                selected
                                                @endif>{{ $aagency_signup_option->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                
                                <div class="fv-row mb-2">
                                    <label for="kt_ecommerce_add_product_store_template"
                                        class="form-label">{{ translate('Ordering Number') }}</label>
                                    <input type="number" name="order_level" class="form-control mb-2" id="order_level" placeholder="{{ translate('Order Level') }}" value="{{ $agency_signup_option->sorting_id }}">
                                </div>

                                <div class="text-center pt-3" >
                                    <button class="btn btn-primary" type="submit">{{translate('Submit')}}</button>
                                </div>

                            </div>
                        </div>
                    </div>
              

                </form>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ static_asset('assets/backend/js/custom/apps/ecommerce/catalog/save-category.js') }}"></script>
@endsection
