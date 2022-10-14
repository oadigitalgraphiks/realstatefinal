@extends('backend.layouts.app')

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                        {{ translate('Spam Report') }}</h1>
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
                        <li class="breadcrumb-item text-muted"> <a class="text-muted" href="{{route('property_reports.index')}}" >{{translate('Spams')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>


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

                                    {{ ($property_reports->currentPage() > 1) ? (($property_reports->currentPage()-1) * $property_reports->perPage()) : ((count($property_reports) > 0) ? 1 : 0) }} -
                                    
                                    {{ ($property_reports->currentPage() > 1) ? (($property_reports->currentPage()-1) * $property_reports->perPage() + count($property_reports)) : count($property_reports)}} {{ translate('of') }} <span class="count_show"> {{$property_reports->total()}} </span> 
                                    
                                    {{ translate('Records') }}
                                </span>
                            </div>
                        </div>
                    
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">#</th>
                                            <th class="text-center">{{ translate('Name') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Email') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Property') }}</th>
                                            <th class="text-center min-w-75px">{{ translate('Agency') }}</th>
                                            <th class="text-center min-w-200px">{{ translate('Date') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                    
                                        @foreach ($property_reports as $key => $property_report)    
                                            <tr>
                                                <td class="text-center">
                                                    {{$property_report->id}}
                                                </td>
                                                <td class="text-center" >
                                                    @if($property_report->agent)
                                                      <a href="{{route('customers.show',$property_report->agent->id)}}">
                                                        {{$property_report->agent->name}}</a>
                                                    @else
                                                    {{$property_report->name}}
                                                    @endif
                                                </td>
                                                <td class="text-center pe-0" data-order="32">
                                                    <span class="fw-bolder ms-3">
                                                        {{ $property_report->email }}
                                                    </span>
                                                </td>
                                               
                                                <td class="text-center pe-0" data-order="32">
                                                    <a href="{{ route('products.admin.edit',      $property_report->property->id)}}" class="fw-bolder">
                                                        @if ($property_report->property->name != null)
                                                            {{ $property_report->property->name }}
                                                        @else
                                                            —
                                                        @endif
                                                    </a>
                                                </td>

                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">
                                                        @if (isset($property_report->agent->shop->name))
                                                        <a href="{{route('sellers.show',$property_report->agent_id)}}">{{ $property_report->agent->shop->name }}</a>
                                                            
                                                        @else
                                                            —
                                                        @endif
                                                    </span>
                                                </td>
                                                
                                                <td class="text-center pe-0">
                                                    {{ $property_report->created_at }}
                                                </td>
                                                
                                                <td class="text-center">

                                                    <a href="{{ route('property_reports.edit', ['id' => $property_report->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                        <span class="svg-icon svg-icon-3"> <i class="text-info fas fa-eye"></i></span>
                                                    </a>

                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-sm confirm-delete"
                                                        data-href="{{ route('property_reports.destroy', $property_report->id) }}">
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
                                {{ $property_reports->appends(request()->input())->links() }}
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
