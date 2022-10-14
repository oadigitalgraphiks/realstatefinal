@extends('backend.layouts.app')
@section('content')

<!--begin::Content-->
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div  class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">All Sellers</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route("admin.dashboard") }}" class="text-muted text-hover-primary"> {{ translate('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted"> <a href="{{route('sellers.index')}}">{{ translate('agencies')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
<!--end::Toolbar-->



    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xl">
                    <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{ route('sellers.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <!--begin::General options-->
                            <div class="card card-flush py-4">
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{translate('Edit Seller Information')}}</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ translate('Name') }}</label>
                                        <input type="text" placeholder="{{ translate('Name') }}" id="name" name="name"
                                            class="form-control mb-2" value="{{$seller->user->name}}" required>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ translate('Email Address') }}</label>
                                        <input type="text" placeholder="{{translate('Email Address')}}" id="email" name="email"
                                            class="form-control mb-2" value="{{$seller->user->email}}" required>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-5 fv-row">
                                        <label class="required form-label">{{ translate('Password') }}</label>
                                        <input type="text" placeholder="{{translate('Password')}}" id="password" name="password"
                                            class="form-control mb-2">
                                    </div>
                                    <!--end::Input group-->
                                    <div class="d-flex justify-content-end">

                                        <button type="submit" id="kt_ecommerce_add_category_submit" class="btn btn-primary">
                                            <span class="indicator-label">{{ translate('Save Changes') }}</span>
                                            <span class="indicator-progress">{{translate('Please wait')}}...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                        <!--end::Button-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>

@endsection
