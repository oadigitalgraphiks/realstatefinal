@extends('backend.layouts.app')
@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1"> {{translate('All Properties')}}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{translate('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{translate('Properties')}}</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <form class="" id="sort_products" action="" method="GET">
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <span class="svg-icon svg-icon-1 position-absolute ms-4"><i class="fas fa-search" ></i></span>
                                
                                    <input type="text" class="form-control form-control-solid w-250px ps-14" id="search" name="search" @isset($sort_search) value="{{ $sort_search }}"@endisset placeholder="{{ translate('Type & Enter') }}" />
                                </div>
                            </div>

                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">                                
                                <div class="w-100 mw-150px">
                                    <select class="form-select form-select-solid" id="user_id" name="user_id"
                                        onchange="sort_products()">
                                        <option value="">{{ translate('All Agent / Agencies') }}</option>
                                        @foreach ($users as $user)
                                                 <option value="{{ $user->id }}" @if(request()->has('user_id') && request()->user_id == $user->id) selected @endif value="{{$user->id}}" >    
                                                {{ $user->shop->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                
                                {{-- <div class="w-100 mw-150px">
                                    <select class="form-select form-select-solid" name="type" id="type"
                                        onchange="sort_products()">
                                        <option value="">{{ translate('Sort By') }}</option>
                                        <option value="rating,desc" @isset($col_name, $query)
                                            @if ($col_name == 'rating' && $query == 'desc') selected @endif @endisset>{{ translate('Rating (High > Low)') }}
                                        </option>
                                        <option value="rating,asc" @isset($col_name, $query)
                                            @if ($col_name == 'rating' && $query == 'asc') selected @endif @endisset>{{ translate('Rating (Low > High)') }}
                                        </option>
                                        <option value="num_of_sale,desc" @isset($col_name, $query)
                                            @if ($col_name == 'num_of_sale' && $query == 'desc') selected @endif @endisset>{{ translate('Num of Sale (High > Low)') }}
                                        </option>
                                        <option value="num_of_sale,asc" @isset($col_name, $query)
                                            @if ($col_name == 'num_of_sale' && $query == 'asc') selected @endif @endisset>{{ translate('Num of Sale (Low > High)') }}
                                        </option>
                                        <option value="unit_price,desc" @isset($col_name, $query)
                                            @if ($col_name == 'unit_price' && $query == 'desc') selected @endif @endisset>{{ translate('Base Price (High > Low)') }}
                                        </option>
                                        <option value="unit_price,asc" @isset($col_name, $query)
                                            @if ($col_name == 'unit_price' && $query == 'asc') selected @endif @endisset>{{ translate('Base Price (Low > High)') }}
                                        </option>
                                    </select>
                                </div> --}}

                                <span class="text-muted"> {{ translate('Displaying') }}  
                                    {{ ($products->currentPage() > 1) ? (($products->currentPage()-1) * $products->perPage()) : ((count($products) > 0) ? 1 : 0) }} -
                                        
                                    {{ ($products->currentPage() > 1) ? (($products->currentPage()-1) * $products->perPage() + count($products)) : count($products)}} {{ translate('of') }} <span class="count_show"> {{$products->total()}} </span> 
                                    {{ translate('Records') }}</span>
                                
                                <a href="{{ route('products.admin.edit', ['id' => 0, 'lang' => env('DEFAULT_LANGUAGE')]) }}" class="btn btn-primary">{{ translate('Add New Property') }}</a>
                            </div>
                        </div>
                        

                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">ID
                                                {{-- <div
                                                    class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div> --}}
                                            </th>
                                            <th class="">{{ translate('Image') }}</th>
                                            <th class="">{{ translate('Property Name') }}</th>
                                            <th class="">{{ translate('Refrence') }}</th>
                                            <th class="">{{ translate('Price') }}</th>
                                            <th class="text-center">{{ translate('Purpose') }}</th>
                                            <th class="text-center">{{ translate('Type') }}</th>
                                            <th class="text-center">{{ translate('Published') }}</th>
                                            <th class="text-center">{{ translate('Approved') }}</th>
                                            <th class="text-center">{{ translate('Featured') }}</th>
                                            <th class="text-center">{{ translate('Date') }}</th>
                                            <th class="text-center">{{ translate('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-bold text-gray-600">
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td>#{{$product->id}}
                                                    <div
                                                        class="d-none form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" name="id[]" value="{{ $product->id }}" />
                                                    </div>
                                                </td>
                                                <td>
                                                    <img width="50px" src="{{uploaded_asset($product->thumbnail_img)}}" />
                                                </td>
                                                <td>{{$product->getTranslation('name')}}</td>
                                                <td>{{$product->ref}}</td>
                                                <td>{{number_format($product->unit_price,2)}}</td>
                                                <td class="text-center ">
                                                    
                                                    @if($product->purpose) 
                                                    {{$product->purpose->getTranslation('name')}},
                                                    @endif

                                                    @if($product->purpose_child) 
                                                    {{$product->purpose_child->getTranslation('name')}}
                                                    @endif
                                                </td>

                                                <td class="text-center ">
                                                    {{$product->type->getTranslation('name')}}
                                                </td>
                                        
                                                <td class="text-center" >
                                                    <label class="d-block form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" onchange="update_published(this)"
                                                            value="{{ $product->id }}" type="checkbox"
                                                            <?php if ($product->published == 1) {
                                                                echo 'checked';
                                                            } ?>>
                                                    </label>
                                                </td>

                                                <td class="text-center " >
                                                    <label class="d-block form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input"
                                                            onchange="update_approved(this)"
                                                            value="{{ $product->id }}" type="checkbox"
                                                            <?php if ($product->approved == 1) {
                                                                echo 'checked';
                                                            } ?>>
                                                    </label>
                                                </td>
                                    
                                                <td class="text-center">
                                                    <label class="d-block form-check form-switch form-check-custom form-check-solid">
                                                        <input class="form-check-input" onchange="update_featured(this)"
                                                            value="{{ $product->id }}" type="checkbox"
                                                            <?php if ($product->featured == 1) {
                                                                echo 'checked';
                                                            } ?>>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    {{$product->created_at}}
                                                </td>
                                                <td class="text-center">

                                                    <a href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}"
                                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"><span class="svg-icon svg-icon-3">
                                                        <i class="text-primary fas fa-marker" ></i></span>
                                                    </a>
                                                    
                                                    <a href="#"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm confirm-delete"
                                                        data-href="{{ route('products.destroy', $product->id) }}">
                                                        <span class="svg-icon svg-icon-3"><i class="text-danger far fa-trash-alt" ></i>
                                                        </span>
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="aiz-pagination">
                                {{ $products->appends(request()->input())->links() }}
                            </div>
                        </div>
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

        $(document).on("change", ".check-all", function() {
            if (this.checked) {
                // Iterate each checkbox
                $('.check-one:checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('.check-one:checkbox').each(function() {
                    this.checked = false;
                });
            }
        });


        $(document).ready(function() {
            //$('#container').removeClass('mainnav-lg').addClass('mainnav-sm');
        });

        function update_todays_deal(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.todays_deal') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Todays Deal updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_published(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.published') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Published products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_approved(el) {
            if (el.checked) {
                var approved = 1;
            } else {
                var approved = 0;
            }
            $.post('{{ route('products.approved') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                approved: approved
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Product approval update successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function update_featured(el) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('products.featured') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status
            }, function(data) {
                if (data == 1) {
                    AIZ.plugins.notify('success', '{{ translate('Featured products updated successfully') }}');
                } else {
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        function sort_products(el) {
            $('#sort_products').submit();
        }

        function bulk_delete() {
            var data = new FormData($('#sort_products')[0]);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('bulk-product-delete') }}",
                type: 'POST',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        location.reload();
                    }
                }
            });
        }
    </script>
@endsection
