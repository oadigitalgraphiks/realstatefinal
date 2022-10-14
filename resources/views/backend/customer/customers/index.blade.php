@extends('backend.layouts.app')
@section('css')
<link rel="stylesheet" href="{{asset('/public/assets/backend/css/confirm.css')}}">
@endSection

@section('content')

<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div  class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> {{ translate('All Customers')}}</h1>
                <span class="h-20px border-gray-300 border-start mx-4"></span>
                <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route("admin.dashboard") }}" class="text-muted text-hover-primary">{{ translate('Home')}}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-300 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-muted">{{ translate('Customers')}}</li>
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
                                    <div class="col-md-10">
                                        <label class="pb-2 mr-3 mb-0  block">{{ translate('Search') }}:</label>
                                        <div class="input-icon">
                                            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{request()->has('search') ? request()->search : '' }}"  />
                                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 align-self-end ">
                                        <button type="submit" class="block btn btn-primary px-6 font-weight-bold"> {{ translate('Search')}}</button>
                                    </div>
                                </div>
                        </form>
                 </div>
            </div>
                
            
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <h2>{{ translate('All Customers') }}</h2>
                        </div>
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        
                        <span class="text-muted"> {{ translate('Displaying') }}  
                            {{ ($users->currentPage() > 1) ? (($users->currentPage()-1) * $users->perPage()) : ((count($users) > 0) ? 1 : 0) }} -
                                
                            {{ ($users->currentPage() > 1) ? (($users->currentPage()-1) * $users->perPage() + count($users)) : count($users)}} {{ translate('of') }} <span class="count_show"> {{$users->total()}} </span> 
                            {{ translate('Records') }}</span>

                            <div class="mx-1 dropdown">
                                <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i></button>
                                <div class="dropdown-menu actions" aria-labelledby="dropdownMenuButton" style="">
                                  <button data-action="delete" data-value="1" type="button" class="dropdown-item action_button ">{{ translate('Delete') }} </button>
                                  <button data-action="banned" data-value="1" type="button" class="dropdown-item action_button "> {{ translate('Banned')}}</button>
                                  <button data-action="banned" data-value="0" type="button" class="dropdown-item action_button ">{{ translate('UnBanned') }} </button>

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
                                        <th class="min-w-200px">{{ translate('Name') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Email Address') }}</th>
                                        <th class="text-center min-w-175px">{{ translate('Ban') }}</th>
                                        <th class="text-center min-w-100px">{{ translate('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ($users as $key => $user)
                                            <tr>
                                                <td> <div class="row_selected_checkbox form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class=" form-check-input" type="checkbox" value="{{$user->id}}"/>
                                                    </div>
                                                </td>
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center pe-0">
                                                    <label class="d-block form-check form-switch form-check-custom form-check-solid">
                                                        <input disabled class="form-check-input" type="checkbox"
                                                        <?php if ( $user->banned == 1){ echo 'checked';} ?> >
                                                    </label>
                                                </td>
                                                <td class="text-center">

                                                    <div class="dropdown dropdown-inline mr-4">
                                                        <button type="button" class="btn btn-light-primary btn-icon btn-sm"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                 <i class="fas fa-ellipsis-v"></i>
                                                            </span>
                                                        </button>
                                                        <div class="dropdown-menu" style="overflow: auto;max-height: 100px">
                                                            <a class="dropdown-item"
                                                                href="{{ route('customers.show', $user->id) }}">
                                                                {{ translate('View')}}</a>
                                                           
                                                            <a href="#" class="onDelete dropdown-item"
                                                                data-id="{{$user->id}}">
                                                                {{ translate('Delete') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="aiz-pagination">
                            {{ $users->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
            </form>
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
                    $.get("{{route('customers.bulk')}}",
                            { 
                                idz:idz.toString(),
                                action:action,
                                value:value
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



     // onDelete
     $("table").delegate(".onDelete", "click", function(){

        let id = $(this).attr("data-id"); 
        $.confirm({
            closeIcon: true, 
            title: false,
            content:'Are you sure to continue ?',
            buttons: { 
                    Ok:function(){
                            $.get("{{route('customers.bulk')}}",
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
