@extends('backend.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> {{ translate('Edit') }}</h1>
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
                        <li class="breadcrumb-item text-muted"><a href="{{route('property_beds.index')}}" class="text-muted text-hover-primary">{{ translate('Property Beds') }}</a></li>
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
                                href="{{ route('property_beds.edit', ['id' => $property_bed->id, 'lang' => $language->code]) }}">
                                <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}" height="11"
                                    class="mr-1">
                                <span>{{ $language->name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <br>
                <form class="form d-flex flex-column flex-lg-row gap-7 gap-lg-10" action="{{route('property_beds.update', $property_bed->id) }}" method="POST"  >
                  @csrf

                    <input type="hidden" name="lang" value="{{ $lang }}">
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title"><h2> {{ translate('General')}}</h2></div>
                            </div>
                      
                            <div class="card-body pt-0">
                                <div class="py-2">
                                    <label class="required form-label">{{ translate('Name') }}</label>
                                    <input type="text" placeholder="{{ translate('Name')}}" name="name" class=" form-control mb-2" value="{{$property_bed->getTranslation('name', $lang) }}" required />
                                    @if($errors->has('name'))
                                    <div class="error text-danger">{{ $errors->first('name') }}</div>
                                    @endif

                                </div>

                                <div class="py-2">
                                    <label class="required form-label">{{ translate('Slug') }}</label>
                                    <input type="text" placeholder="{{ translate('Slug')}}" name="slug" class="slug form-control mb-2" value="{{$property_bed->slug}}" required />
                                    @if($errors->has('slug'))
                                    <div class="error text-danger">{{ $errors->first('slug') }}</div>
                                    @endif
                                </div>

                                <div class="py-2 text-center ">
                                    <button type="submit" class="btn btn-primary"> {{translate('Submit')}}
                                     </button>
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
    <script src="{{ static_asset('assets/backend/plugins/custom/formrepeater/formrepeater.bundle.js') }}">
    </script>

   <script>
        
         $(".slug").keyup(function(){
           var Text = $(this).val();
           Text = Text.toLowerCase();
           Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
           $(".slug").val(Text);        
        });

    </script>
@endsection
