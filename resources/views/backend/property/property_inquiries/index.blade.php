@extends('backend.layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('/public/assets/backend/css/confirm.css')}}">
@endSection

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ translate('Property Inquiries') }} </h1><span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route("admin.dashboard")}}" class="text-muted text-hover-primary"> {{ translate('home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                         <a href="{{route('sellers.index')}}">{{ translate('agencies') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted"> <a href="{{route('property_inquiries.index')}}">{{translate('inquiries') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
   
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">

                <div class="card card-flush mb-5">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <h2>{{ translate('Filters') }}</h2>
                            </div>
                        </div>
                    </div>
                     <div class="card-body pt-0">
                        <form>
                                <div class="row align-items-center">
                                       
                                        <div class="col-md-3">
                                            <label class="pb-2 mr-3 mb-0 d-none d-md-block">{{ translate('Customer') }}:</label>
                                            <select name="customer" class="form-select mb-2" data-control="select2" data-placeholder="Select an option" data-allow-clear="true"  class="form-control">
                                                <option value=""> {{ translate('All') }}</option>
                                                @foreach ($customers as $item)
                                                <option {{request()->has('customer') && request()->customer == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->name}}</option>    
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="pb-2 mr-3 mb-0 d-none d-md-block">{{ translate('Property') }}:</label>
                                            <select name="property" class="form-select mb-2" data-control="select2" data-placeholder="Select an option" data-allow-clear="true"  class="form-control">
                                                <option value=""> {{ translate('All') }}</option>
                                                @foreach ($properties as $item)
                                                <option {{request()->has('property') && request()->property == $item->id ? 'selected' : '' }} value="{{$item->id}}">({{$item->ref}}) - {{$item->name}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="pb-2 mr-3 mb-0 d-none d-md-block"> {{ translate('Agent') }} :</label>
                                            <select class="form-select mb-2" data-control="select2" data-allow-clear="true"   data-placeholder="Select an option"  name="agent"  class="form-control">
                                                <option value=""> {{translate('All')}}</option>
                                               @foreach ($agents as $item)
                                                <option {{request()->has('agent') && request()->agent == $item->id ? 'selected' : '' }} value="{{$item->id}}">{{$item->shop->name}}</option>
                                               @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2 align-self-end ">
                                            <button type="submit" class="block btn btn-primary px-6 font-weight-bold">Search</button>
                                        </div>
                                  </div>
                            </form>
                        </div>
                    </div>
                
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <h2>{{ translate('All Inquiries') }}</h2>
                                </div>
                            </div>
                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                
                                <span class="text-muted"> {{ translate('Displaying') }}  
                                    {{ ($data->currentPage() > 1) ? (($data->currentPage()-1) * $data->perPage()) : ((count($data) > 0) ? 1 : 0) }} -
                                        
                                    {{ ($data->currentPage() > 1) ? (($data->currentPage()-1) * $data->perPage() + count($data)) : count($data)}} {{ translate('of') }} <span class="count_show"> {{$data->total()}} </span> 
                                    {{ translate('Records') }}</span>
    
                                    <div class="mx-1 dropdown">
                                        <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i></button>
                                        <div class="dropdown-menu actions" aria-labelledby="dropdownMenuButton" style="">
                                          <button data-action="delete" data-value="1" type="button" class="dropdown-item action_button "> Delete</button>

                                        </div>
                                    </div>
                             </div>
                        </div>
                     
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                                            <th>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="bulk_check form-check-input" type="checkbox" />
                                                </div> 
                                            </th>
                                            <th class="w-10px pe-2"># </th>
                                            <th class="min-w-200px">{{ translate('Name') }}</th>
                                            <th class="min-w-200px">{{ translate('Email') }}</th>
                                            <th class="text-center min-w-175px">{{ translate('Property') }}</th>
                                            <th class="text-center min-w-75px">{{translate('Agent')}}/{{translate('Agency')}}</th>
                                            <th class="text-center min-w-150px">{{ translate('Date') }}</th>
                                            <th class="text-center min-w-150px">{{ translate('Actions') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody class="fw-bold text-gray-600">
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td> 
                                                    <div class="row_selected_checkbox form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class=" form-check-input" type="checkbox" value="{{$item->id}}"/>
                                                 </div>
                                                </td>
                                                <td class="text-center ">
                                                    <span class="fw-bolder">{{$item->id}}</span>
                                                </td>
                                                <td class="text-center">
                                                    @if($item->user)
                                                       <a href="{{route('customers.show',$item->user->id)}}">
                                                         {{$item->user->name}}
                                                       </a>
                                                      @else
                                                        {{$item->name}}
                                                    @endif
                                                </td>
                                                <td> {{$item->email}}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('products.admin.edit', $item->property_id) }}" class="fw-bolder">
                                                        @if($item->property->name != null)
                                                        ({{$item->property->ref }}) - {{ $item->property->name }}
                                                        @else  —  @endif </a>
                                                </td>
                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">
                                                        @if (isset($item->property->user->shop->name))
                                                        <a href="{{route('sellers.show',$item->property->user->id)}}" >{{ $item->property->user->shop->name }}</a>    
                                                        
                                                        @else —  @endif
                                                    </span>
                                                </td>
                                                <td> {{$item->created_at}}</td>
                                                <td class="text-center">
                                                    <div class="dropdown dropdown-inline mr-4">
                                                        <button type="button" class="btn  btn-light-primary btn-icon btn-sm"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                 <i class="fas fa-ellipsis-v" ></i>
                                                            </span>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('property_inquiries.edit',$item->id)}}">{{ translate('View')}}</a>
                                                            <a href="javascript:void(0)" class="onDelete dropdown-item" data-id="{{$item->id}}">{{ translate('Delete')}} </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="aiz-pagination">
                                {{ $data->appends(request()->input())->links() }}
                            </div>
                        </div>
                    </div>
            
            </div>
        </div>
    </div>
@endsection


@section('script')

    <script src="{{asset('/public/assets/backend/js/confirm.js')}}"></script>
    <script type="text/javascript">

        $('.bulk_check').change(function(){
            if($(this).prop("checked") == true){
                $('.row_selected_checkbox .form-check-input').prop("checked", true);
            }else if($(this).prop("checked") == false){
                $('.row_selected_checkbox .form-check-input').prop("checked", false);
            }
        });


        $('.actions button').click(function(){

            let action = $(this).attr("data-action"); 
            let value = $(this).attr("data-value"); 
            let idz = [];

            $('.row_selected_checkbox .form-check-input:checked').each(function() {
                idz.push($(this).val());
            });

            if(idz.length == 0){
                alert('Please Select Record');
                return false;
            }

            $.confirm({
            closeIcon: true, 
            title: false,
            content:'Are you sure to continue ?',
            buttons: { 
                    Ok:function(){
                        $.get("{{route('property_inquiries.bulk')}}",
                        { 
                            idz:idz.toString(),
                            action:action,
                            value:value
                        }, function(data, status){
                            AIZ.plugins.notify('success','Success');
                            location.reload();
                        });
                    },
                    Cancel: {
                        action: function () {
                        }
                    }
                }
            });

        });


        $("table").delegate(".onDelete", "click", function(){

            let id = $(this).attr("data-id"); 

            $.confirm({
                closeIcon: true, 
                title: false,
                content:'Are you sure to continue ?',
                buttons: { 
                        Ok:function(){
                                $.get("{{route('property_inquiries.bulk')}}",
                                    { 
                                        idz:id,
                                        action:'delete',
                                        value:0
                                    }, function(data, status){                   
                                        AIZ.plugins.notify('success','Record Deleted');
                                        location.reload();
                                });
                        },
                        Cancel: {
                            action: function () {
                                
                            }
                        }
                    }
                });


        });    
    </script>
@endsection