@extends('backend.layouts.app')

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        {{ translate('Signup Options') }}</h1>
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
        

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">    
                    <div class="card card-flush">
                       
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <form action="">
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                            <i class="fa fa-search" ></i></span>
                                        <input type="text" class="form-control form-control-solid w-250px ps-14" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}"
                                         @endisset placeholder="{{ translate('Type & Enter') }}" />
                                    </div>
                                </form>
                            </div>

                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                <span class="text-muted"> {{ translate('Displaying') }}  

                                    {{ ($agency_signup_options->currentPage() > 1) ? (($agency_signup_options->currentPage()-1) * $agency_signup_options->perPage()) : ((count($agency_signup_options) > 0) ? 1 : 0) }} -
                                    
                                    {{ ($agency_signup_options->currentPage() > 1) ? (($agency_signup_options->currentPage()-1) * $agency_signup_options->perPage() + count($agency_signup_options)) : count($agency_signup_options)}} {{ translate('of') }} <span class="count_show"> {{$agency_signup_options->total()}} </span> 
                                    
                                    {{ translate('Records') }}
                                </span>

                                <a href="{{ route('agency_signup_options.create') }}" class="btn btn-primary">
                                    {{ translate('Add New') }}
                                </a>

                            </div>
                        </div>
                    
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="text-center  fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">#</th>
                                            <th class="min-w-200px">{{ translate('Name') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('Parent') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('Slug') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('Order Level') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Actions') }}</th>
                                        </tr>
                                        <!--end::Table row-->
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                        @foreach ($agency_signup_options as $key => $agency_signup_option)
                                            <tr>
                                                 <td class="text-center pe-0">
                                                    <span class="fw-bolder">{{$key + 1}}</span>
                                                </td>
                                                <td class="text-center" >{{ $agency_signup_option->name }}</td>
                                            
                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">@php
                                                        $parent = $agency_signup_option->parents;
                                                    @endphp
                                                        @if ($parent != null)
                                                            {{ $parent->name }}
                                                        @else
                                                            —
                                                        @endif
                                                    </span>
                                                </td>

                                                <td class="text-center pe-0">
                                                    {{$agency_signup_option->slug}} 
                                                </td>

                                                <td class="text-center pe-0">
                                                    {{$agency_signup_option->sorting_id}}
                                                </td>

                                                <td class="text-center">

                                                    <a href="{{ route('agency_signup_options.edit', ['id' => $agency_signup_option->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <span class="svg-icon svg-icon-3"> <i class="text-info fas fa-eye"></i></span>
                                                    </a>

                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-sm confirm-delete"
                                                        data-href="{{ route('agency_signup_options.destroy', $agency_signup_option->id) }}">
                                                        <span class="svg-icon svg-icon-3">
                                                            <i class=" text-danger fas fa-trash-alt"></i></button>
                                                        </span>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                             </table>
                         </div>

                         <div class="aiz-pagination">
                            {{ $agency_signup_options->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
       
    </script>
@endsection
