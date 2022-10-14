@extends('backend.layouts.app')
@section('css')
 <link rel="stylesheet" href="{{asset('/public/assets/backend/css/confirm.css')}}">
@endSection

@section('content')

<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{ translate('All Agencies') }} </h1>
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
    

    <!--begin::Post-->
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
                                    <div class="col-md-4">
                                        <label class="pb-2 mr-3 mb-0  block">{{ translate('Search') }}:</label>
                                        <div class="input-icon">
                                            <input type="text" name="search" class="form-control" placeholder="Search..." value="{{request()->has('search') ? request()->search : '' }}"  />
                                            <span><i class="flaticon2-search-1 text-muted"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pb-2 mr-3 mb-0 d-none d-md-block">{{ translate('Status') }}:</label>
                                        <select name="status" class="form-control">
                                            <option value=""> {{ translate('All') }}</option>
                                           
                                            <option {{request()->has('status') && request()->status == '1' ? 'selected' : '' }} value="1"> {{ translate('Approved') }} </option>
                                           
                                            <option {{request()->has('status') && request()->status == '0' ? 'selected' : '' }} value="0">{{translate('UnApproved')}} </option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="pb-2 mr-3 mb-0 d-none d-md-block"> {{ translate('Type') }} :</label>
                                        <select name="type"  class="form-control">
                                            <option value=""> {{translate('All')}}</option>
                                           
                                            <option {{request()->has('type') && request()->type == 'agency' ? 'selected' : '' }} value="agency">{{translate('Agency')}}</option>
                                           
                                            <option {{request()->has('type') && request()->type == 'agent' ? 'selected' : '' }} value="agent">{{translate('Agent')}}</option>
                                        </select>
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
                                <h2>{{ translate('All Agencies') }}</h2>
                            </div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            
                            <span class="text-muted"> {{ translate('Displaying') }}  
                                {{ ($sellers->currentPage() > 1) ? (($sellers->currentPage()-1) * $sellers->perPage()) : ((count($sellers) > 0) ? 1 : 0) }} -
                                    
                                {{ ($sellers->currentPage() > 1) ? (($sellers->currentPage()-1) * $sellers->perPage() + count($sellers)) : count($sellers)}} {{ translate('of') }} <span class="count_show"> {{$sellers->total()}} </span> 
                                {{ translate('Records') }}</span>

                                <div class="mx-1 dropdown">
                                    <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i></button>
                                    <div class="dropdown-menu actions" aria-labelledby="dropdownMenuButton" style="">
                                      <button data-action="delete" data-value="1" type="button" class="dropdown-item action_button ">{{ translate('Delete') }}</button>
                                      <button data-action="status" data-value="1" type="button" class="dropdown-item action_button ">{{ translate('Approved') }} </button>
                                      <button data-action="status" data-value="0" type="button" class="dropdown-item action_button ">{{ translate('UnApproved') }} </button>

                                      <button data-action="banned" data-value="1" type="button" class="dropdown-item action_button ">{{ translate('Banned') }} </button>
                                      <button data-action="banned" data-value="0" type="button" class="dropdown-item action_button "> {{ translate('UnBanned') }} </button>

                                    </div>
                                </div>
                         </div>
                    </div>
                    <div class="card-body pt-0">

                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="text-center  fw-bolder fs-7 text-uppercase gs-0">
                                        <th>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3"> <input class="bulk_check form-check-input" type="checkbox" />
                                            </div> 
                                        </th>
                                        <th class="w-10px pe-2">#</th>
                                        <th class="">{{ translate('Name')}}</th>
                                        <th class="">{{ translate('Type')}}</th>
                                        <th class="text-center min-w-75px">{{ translate('Approval') }}</th>
                                        <th class="text-center min-w-75px">{{ translate('Ban') }}</th>
                                        
                                       
                                        <th width="10%">{{ translate('Action') }}</th>
                                    </tr>
                                </thead>
                                
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ($sellers as $key => $seller)
                                            <tr>
                                                <td> <div class="row_selected_checkbox form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class=" form-check-input" type="checkbox" value="{{$seller->id}}"/>
                                                </div></td>
                                                <td>{{$key + 1}}</td>
                                                <td class="text-center">
                                                    @if($seller->shop)
                                                    {{ $seller->shop->name}}
                                                    @else 
                                                    {{ translate('None') }}
                                                    @endif
                                                </td>
                                                <td class="text-center pe-0">
                                                    <span class="fw-bolder">{{$seller->shop->type}}</span>
                                                </td>
                                                <td class="text-center pe-0">
                                                    <label
                                                        class="d-block form-check form-switch form-check-custom form-check-solid">
                                                        <input disabled class="form-check-input" type="checkbox"
                                                            <?php if ( $seller->shop && $seller->shop->status == 1){ echo 'checked';} ?> >
                                                    </label>
                                                </td>
                                                <td class="text-center pe-0">
                                                    <label class="d-block form-check form-switch form-check-custom form-check-solid">
                                                        <input disabled class="form-check-input" type="checkbox"
                                                            <?php if ( $seller->banned == 1){ echo 'checked';} ?> >
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
                                                                href="{{ route('sellers.show', $seller->id) }}">
                                                                {{ translate('View')}}</a>

                                                            <a href="#" class="dropdown-item confirm-delete"
                                                                data-href="{{ route('sellers.destroy', $seller->id) }}">
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
                            {{ $sellers->appends(request()->input())->links() }}
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
                        $.get("{{route('sellers.bulk')}}",
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
         $(".render_data").delegate(".onDelete", "click", function(){

            let id = $(this).attr("data-id"); 
            $.confirm({
                closeIcon: true, 
                title: false,
                content:'Are you sure to continue ?',
                buttons: { 
                        Ok:function(){
                                $.get("{{route('sellers.bulk')}}",
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

        

        // $(document).on("change", ".check-all", function() {
        //     if (this.checked) {
        //         // Iterate each checkbox
        //         $('.check-one:checkbox').each(function() {
        //             this.checked = true;
        //         });
        //     } else {
        //         $('.check-one:checkbox').each(function() {
        //             this.checked = false;
        //         });
        //     }
        // });


        // function update_approved(el) {
        //     if (el.checked) {
        //         var status = 1;
        //     } else {
        //         var status = 0;
        //     }
        //     $.post('{{ route('sellers.approved') }}', {
        //         _token: '{{ csrf_token() }}',
        //         id: el.value,
        //         status: status
        //     }, function(data) {
        //         if (data == 1) {
        //             AIZ.plugins.notify('success', '{{ translate('Approved sellers updated successfully') }}');
        //         } else {
        //             AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
        //         }
        //     });
        // }

        // function sort_sellers(el) {
        //     $('#sort_sellers').submit();
        // }

        // function confirm_ban(url) {
        //     $('#confirm-ban').modal('show', {
        //         backdrop: 'static'
        //     });
        //     document.getElementById('confirmation').setAttribute('href', url);
        // }

        // function confirm_unban(url) {
        //     $('#confirm-unban').modal('show', {
        //         backdrop: 'static'
        //     });
        //     document.getElementById('confirmationunban').setAttribute('href', url);
        // }

        // function bulk_delete() {
        //     var data = new FormData($('#sort_sellers')[0]);
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "{{ route('bulk-seller-delete') }}",
        //         type: 'POST',
        //         data: data,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             if (response == 1) {
        //                 location.reload();
        //             }
        //         }
        //     });
        // }

    </script>
@endsection