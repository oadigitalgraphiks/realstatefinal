@extends('backend.layouts.app')
@section('content')
<div class="d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{translate('All Areas')}}</h1>
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
                    <li class="breadcrumb-item text-muted"><a class="text-muted" href="{{route('property_areas.index')}}" >{{translate('Areas')}}</a></li>
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="black" />
                                    </svg>
                                </span>
                                <input type="text" class="form-control form-control-solid w-250px ps-14" id="sort_country" name="sort" @isset($sort) value="{{ $sort}}" @endisset placeholder="{{ translate('Type Name') }}" />
                            </div>
                          </form>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <span class="text-muted"> {{ translate('Displaying') }}  
                                {{ ($data->currentPage() > 1) ? (($data->currentPage()-1) * $data->perPage()) : ((count($data) > 0) ? 1 : 0) }} -
                                    
                                {{ ($data->currentPage() > 1) ? (($data->currentPage()-1) * $data->perPage() + count($data)) : count($data)}} {{ translate('of') }} <span class="count_show"> {{$data->total()}} </span> 
                                {{ translate('Records') }}
                            </span>
                            <a href="{{ route('property_areas.create') }}" class="btn btn-primary" type="submit">{{ translate('Create New') }}</a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <thead>
                                    <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">#</th>
                                        <th class="">{{ translate('Icon') }}</th>
                                        <th class="">{{ translate('Name') }}</th>
                                        <th class="">{{ translate('City') }}</th>
                                        <th class="">{{ translate('State') }}</th>
                                        <th class="">{{ translate('Country') }}</th>
                                        <th class="text-center ">{{ translate('Code') }}</th>
                                        <th class="text-center ">{{ translate('Status') }}</th>
                                        <th class="text-center ">{{ translate('Featured') }}</th>
                                        <th class="text-center ">{{ translate('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ($data as $key => $item)
                                        <tr>
                                            <td class="text-center">{{$key + 1}}</td>
                                            <td class="text-center">
                                                @if($item->icon) 
                                                 <img class=""  style="width: 100px" src="{{uploaded_asset($item->icon)}}" /> @else 
                                                  - 
                                                @endif 
                                            </td>
                                            <td class="text-center">{{ $item->getTranslation('name') }}</td>
                                            <td class="text-center">
                                                @if($item->city)
                                                    <a href="{{route('property_cities.edit',$item->city->id)}}">
                                                        {{ $item->city->getTranslation('name') }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->city && $item->city->state)
                                                    <a href="{{route('property_states.edit',$item->city->state->id)}}">
                                                        {{ $item->city->state->getTranslation('name') }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($item->city && $item->city->state && $item->city->state->country)
                                                    <a href="{{route('property_countries.edit',$item->city->state->country->id)}}">
                                                        {{ $item->city->state->country->getTranslation('name') }}
                                                    </a>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->code }}</td>
                                            <td class="text-center">
                                                <span class="fw-bolder ms-3">
                                                    <label class=" form-check form-switch form-check-custom form-check-solid d-block">
                                                    <input class="onStatuChange form-check-input" value="{{$item->id}}" type="checkbox" {{$item->status == '1' ? 'checked' : ''}} /> </label>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="fw-bolder ms-3">
                                                    <label class=" form-check form-switch form-check-custom form-check-solid d-block">
                                                    <input class="onFeaturedChange form-check-input" value="{{$item->id}}" type="checkbox" {{$item->featured == '1' ? 'checked' : ''}} /> </label>
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('property_areas.edit',['id' => $item->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <span class="svg-icon svg-icon-3"><i class="text-primary fas fa-marker" ></i></span></a>
                                                
                                                <a data-href="{{ route('property_areas.destroy', $item->id) }}"
                                                    class="confirm-delete btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                                    data-href="{{ route('property_areas.destroy', $item->id) }}">
                                                    <span class="svg-icon svg-icon-3"><i class="text-danger far fa-trash-alt" ></i></span>
                                                </a>
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

@section('modal')
 @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">
          $("table").delegate(".onStatuChange", "change", function(){   
                
                let id = $(this).val();
                $.get("{{route('property_areas.bulk')}}",
                { 
                    idz:id,
                    action:'status',
                    value: $(this).prop("checked") ? 1: 0,
                }, function(data, status){
                    AIZ.plugins.notify('success','Updated');
                });
        });

        $("table").delegate(".onFeaturedChange", "change", function(){   
                
                let id = $(this).val();
                $.get("{{route('property_areas.bulk')}}",
                { 
                    idz:id,
                    action:'featured',
                    value: $(this).prop("checked") ? 1: 0,
                }, function(data, status){
                    AIZ.plugins.notify('success','Update');
                });
        });
    </script>
@endsection