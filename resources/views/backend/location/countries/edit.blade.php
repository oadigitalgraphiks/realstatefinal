@extends('backend.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{translate('Edit')}}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route("admin.dashboard")}}" class="text-muted text-hover-primary"> {{translate('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"><a  >{{translate('Locations')}}</a></li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"><a href="{{route('property_countries.index')}}" >{{translate('Countries')}}</a></li>
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
                                href="{{ route('property_countries.edit', ['id' => $data->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11" class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10"
                    action="{{ route('property_countries.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="lang" value="{{ $lang }}">
                    @csrf
                
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>General</h2>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="py-2">
                                    <label class="required form-label">{{ translate('Name') }}</label>
                                    <input value="{{$data->getTranslation('name', $lang)}}" placeholder="{{ translate('Name') }}" name="name" class="form-control mb-2" required>
                                        @if($errors->has('name'))
                                        <div class="error text-danger ">{{ $errors->first('name') }}</div>
                                        @endif
                                </div>

                                <div class="py-2">
                                    <label class="required form-label">{{ translate('Slug') }}</label>
                                    <input type="text" placeholder="{{ translate('slug') }}" id="slug" name="slug" class="slug form-control mb-2" value="{{$data->slug}}" required>
                                    @if($errors->has('slug'))
                                     <div class="error text-danger">{{ $errors->first('slug') }}</div>
                                     @endif
                                </div>

                                <div class="py-2">
                                    <label class="form-label">{{ translate('Latitude') }}</label>
                                    <input value="{{$data->lat}}" placeholder="{{ translate('Latitude') }}" name="lat" class="form-control mb-2" />
                                </div>

                                <div class="py-2">
                                    <label class="form-label">{{ translate('Longitude') }}</label>
                                    <input value="{{$data->lon}}" placeholder="{{ translate('Longitude') }}" name="lon" class="form-control mb-2" />
                                </div>
                                
                                <div class="py-2">
                                    <label class="required form-label">{{ translate('Country Code') }}</label>
                                    <input value="{{$data->code}}" placeholder="{{ translate('Code') }}" name="code" class="form-control mb-2" required />
                                </div>

                                <div class="py-2">
                                    <label class="form-label">{{ translate('Status') }}</label>
                                    <select required class="form-select mb-2" data-control="select2" data-placeholder="Select an option" name="status" id="published">
                                          <option @if($data->status == 1) {{'selected'}} @endif value="1"> {{ translate('Active') }}</option>
                                          <option @if($data->status == 0) {{'selected'}} @endif value="0"> {{ translate('Deactive') }}</option>
                                    </select>
                                </div>

                                <div class="py-2">
                                    <label class="form-label">{{ translate('Featured') }}</label>
                                    <select required class="form-select mb-2" data-control="select2" data-placeholder="Select an option" name="featured" id="featured">
                                          <option @if($data->featured == 1) {{'selected'}} @endif value="1"> {{ translate('Active') }}</option>
                                          <option @if($data->featured == 0) {{'selected'}} @endif value="0"> {{ translate('Deactive') }}</option>
                                    </select>
                                </div>

                                <div class="py-2">
                                    <label class="form-label">{{ translate('Icon') }} <b>(120 x 120)</b></label>
                                    <div class="dropzone" id="kt_ecommerce_add_product_mediaa"
                                        data-toggle="aizuploader" data-type="image">
                                        <div class="dz-message needsclick">
                                            <i class="bi bi-file-earmark-arrow-up text-primary fs-3x"></i>
                                            <input type="hidden" name="icon" value="{{ $data->icon }}" class="selected-files">
                                            <div class="ms-4">
                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1"> {{translate(' Drop files here or click to upload.')}}
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="file-preview box sm"></div>
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
    </div>
@endsection
@section('script')
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script>
        $(".slug").keyup(function(){
            var Text = $(this).val();
            Text = Text.toLowerCase();
            Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
            $(".slug").val(Text);        
         });
    </script>
@endsection
