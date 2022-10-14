@extends('backend.layouts.app')

@section('content')

<!--begin::Content-->
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <!--begin::Page title-->
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <!--begin::Title-->
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Pick-up Points
                </h1>
                <!--end::Title-->
                <!--begin::Separator-->
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <!--end::Separator-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">eCommerce</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">Setup & Configuration</li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-dark">Pick-up Point Edit</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <div class="row g-5 g-xl-8">
        <div class="col-xl-8 mx-auto">
            <div class="card card-flush">
                <div class="card-header row gutters-5 align-items-center py-5 gap-2 gap-md-5">
                    <h5 class="mb-0 h6">{{ translate('Update Pickup Point Information') }}</h5>
                </div>
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Models\Language::all() as $key => $language)
                        <li class="nav-item">
                            <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                href="{{ route('pick_up_points.edit', ['id' => $pickup_point->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('pick_up_points.update', $pickup_point->id) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                    <div class="card-body">
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label" for="name">{{ translate('Name') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ translate('Name') }}" name="name"
                                    value="{{ $pickup_point->getTranslation('name', $lang) }}" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label" for="address">{{ translate('Location') }}</label>
                            <div class="col-sm-9">
                                <textarea name="address" rows="8" class="form-control" required>
                                    {{ $pickup_point->getTranslation('address', $lang) }}
                                </textarea>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label" for="phone">{{ translate('Phone') }}</label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="{{ translate('Phone') }}"
                                    value="{{ $pickup_point->phone }}" name="phone" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label">{{ translate('Pickup Point Status') }}</label>
                            <div class="col-sm-3">
                                <label
                                    class="form-check form-switch form-switch-sm form-check-custom form-check-solid mb-5 d-block">
                                    <span class="form-check-label ms-0 fw-bolder fs-6 text-gray-700 ps-5">
                                        <input class="form-check-input" value="1" type="checkbox" name="pick_up_status"
                                            @if ($pickup_point->pick_up_status == 1) checked @endif>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label class="col-sm-3 col-from-label"
                                for="name">{{ translate('Pick-up Point Manager') }}</label>
                            <div class="col-sm-9">
                                <select class="form-select mb-2" data-control="select2" data-hide-search="false"
                                    data-placeholder="Select an option" name="staff_id" data-live-search="true" required>
                                    @foreach (\App\Models\Staff::all() as $staff)
                                        @if ($staff->user != null)
                                            <option value="{{ $staff->id }}" @if ($pickup_point->staff_id == $staff->id) selected @endif>
                                                {{ $staff->user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save Changes') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
