@extends('backend.layouts.app')
@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                    class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> {{ translate('Propert Types') }}</h1>
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
                <form  id="sort_property_type" action="" method="GET">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                            fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                                            <path
                                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                fill="black" />
                                        </svg>
                                    </span>
                                    <input type="text" class="form-control form-control-solid w-250px ps-14" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}"@endisset placeholder="{{ translate('Type & Enter') }}" />
                                </div>
                            </div>
                          
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <span class="text-muted"> {{ translate('Displaying') }}  
                                    {{ ($property_types->currentPage() > 1) ? (($property_types->currentPage()-1) * $property_types->perPage()) : ((count($property_types) > 0) ? 1 : 0) }} -
                                        
                                    {{ ($property_types->currentPage() > 1) ? (($property_types->currentPage()-1) * $property_types->perPage() + count($property_types)) : count($property_types)}} {{ translate('of') }} <span class="count_show"> {{$property_types->total()}} </span> 
                                    {{ translate('Records') }}
                                </span>

                                <a href="{{ route('property_type.create') }}" class="btn btn-primary">
                                    {{ translate('Add New') }}
                                </a>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="">{{ translate('ID') }}</th>
                                            <th class="">{{ translate('Image') }}</th>
                                            <th class="">{{ translate('Name') }}</th>
                                            <th class="">{{ translate('Parent') }}</th>
                                            <th class="">{{ translate('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600 text-center ">
                                        @foreach ($property_types as $key => $property_type)
                                            <tr>
                                                <td class="text-center pe-0">{{$property_type->id}}</td>
                                                <td class="text-center pe-0">
                                                    @if ($property_type->icon != null)
                                                        <span class="avatar avatar-square avatar-xs width_75">
                                                            <img src="{{ uploaded_asset($property_type->icon) }}"
                                                                alt="{{ translate('icon') }}" style="width: 75px">
                                                        </span>
                                                    @else
                                                        —
                                                    @endif
                                                </td>
                                                <td>
                                                    {{$property_type->getTranslation('name')}}
                                                </td>
                                                <td class="text-center pe-0">
                                                {{ $property_type->parent ?      $property_type->parent->getTranslation('name') : '-'}}
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{ route('property_type.edit', ['id' => $property_type->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <span class="svg-icon svg-icon-3">
                                                            <i class="text-primary fas fa-marker" ></i>
                                                        </span>
                                                    </a>
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm confirm-delete"
                                                        data-href="{{ route('property_type.destroy', $property_type->id) }}">
                                                        <span class="svg-icon svg-icon-3"><i class="text-danger far fa-trash-alt" ></i>
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="aiz-pagination pt-4">
                        {{ $property_types->appends(request()->input())->links() }}
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
    <script type="text/javascript">

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('property_type.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured property_type updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }
    </script>
@endsection
