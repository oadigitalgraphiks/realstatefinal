@extends('backend.layouts.app')

@section('content')

    <div class="container">
        @if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)
            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                        <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black"></rect>
                        <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black"></rect>
                    </svg>
                </span>
                <div class="d-flex flex-stack flex-grow-1">
                    <div class="fw-bold">
                        <h4 class="text-gray-900 fw-bolder">Warning</h4>
                        <div class="fs-6 text-gray-700">{{translate('Please Configure SMTP Setting to work all email sending functionality')}},
                        <a href="{{ route('smtp_settings.index')}}">{{ translate('Configure Now') }}</a>
                       </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="row g-5 g-xl-8">

            <div class="col-xl-3">
                <a href="{{route('property_inquiries.index')}}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black"></path>
                                <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black"></path>
                                <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black"></path>
                            </svg>
                        </span>
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{ \App\Models\PropertyInquiry::count() }}</div>
                        <div class="fw-bold text-gray-100">{{ translate('Total') }} {{ translate('Inquiries') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3">
                <a href="{{route('customers.index')}}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"></rect>
                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                            </svg>
                        </span>
                        <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ \App\Models\User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->count() }}</div>
                        <div class="fw-bold text-gray-400">{{ translate('Total') }} {{ translate('Customer') }}</div>
                    </div>
                </a>
            </div>

            
            <div class="col-xl-3">
                <a href="{{route('sellers.index')}}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black"></path>
                                <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black"></path>
                            </svg>
                        </span>
                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ \App\Models\User::where('user_type', 'seller')->where('type', 'agent')->count() }}</div>
                        <div class="fw-bold text-white">{{ translate('Total') }} {{ translate('Agents') }}</div>
                    </div>
                </a>
            </div>

            <div class="col-xl-3">
                <a href="{{route('sellers.index')}}" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black"></path>
                                <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black"></path>
                            </svg>
                        </span>
                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ \App\Models\User::where('user_type', 'seller')->where('type', 'agency')->count()}}</div>
                        <div class="fw-bold text-white">{{translate('Total')}} {{translate('Agency')}}</div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <div class="toolbar" id="kt_toolbar">
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
            <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0"><h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
                <small class="text-muted fs-7 fw-bold my-1 ms-1">Welcome to </small>
        </h1></div>
        </div>

    </div>


    <div class="container">
        <div class="row g-5 g-xl-8">
            <div class="col-xl-4">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body pt-5">
                        <div class="d-flex flex-stack">
                            <h4 class="fw-bolder text-gray-800 m-0">{{translate('Total published Properties')}}</h4>
                        </div>
                        <div class="d-flex flex-center w-100">
                            <div class="mixed-widget-17-charts" data-kt-chart-color="primary" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body pt-5">
                        <div class="d-flex flex-stack">
                            <h4 class="fw-bolder text-gray-800 m-0">{{translate('Total Agents Properties')}}</h4>
                        </div>
                        <div class="d-flex flex-center w-100">
                            <div class="mixed-widget-18-charts"  style="height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4">
                <div class="card card-xl-stretch mb-5 mb-xl-8">
                    <div class="card-body pt-5">
                        <div class="d-flex flex-stack">
                            <h4 class="fw-bolder text-gray-800 m-0">{{translate('Total Agencies Properties')}}</h4>
                           
                        </div>
                        <div class="d-flex flex-center w-100">
                            <div class="mixed-widget-19-charts" data-kt-chart-color="danger" style="height: 300px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-xxl-stretch mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1"> {{ translate('Popular Properties')}}</span>
                        </h3>
                        <div class="card-toolbar"></div>
                    </div>
                    <div style="max-height: 400px;overflow-y: scroll;" class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                <thead class="text-center"  style="font-weight: bold" >
                                    <th>{{translate('Image')}}</th>
                                    <th>{{translate('Title')}}</th>
                                    <th>{{translate('Inquiries')}}</th>
                                    <th>{{translate('Agent')}}/{{translate('Agency')}}</th>
                                    <th>{{translate('Locations')}}</th>
                                    <th>{{translate('Action')}}</th>
                                </thead>
                                <tbody>
                                <?php
                                  $inquiry = DB::table('property_contact_forms')
                                  ->select('property_id',\DB::raw("count('property_id') as total"))
                                  ->groupBy('property_id')
                                  ->orderBy('total','desc')
                                  ->get()->pluck('property_id')->toArray();

                                  $recentlyadded = \App\Models\Product::where('published', 1)
                                  ->WhereIn('id',$inquiry)
                                  ->with('iqnuiries')
                                  ->orderByRaw('FIELD (id,'.implode(',', $inquiry).') ASC')
                                  ->limit(20)->get();   
                                ?>
                                @foreach($recentlyadded as $key => $product)
                                <tr class="text-center" >
                                    <td>
                                        <img style="width: 50px" src="{{ uploaded_asset($product->thumbnail_img) }}" />
                                    </td>
                                    <td class="text-left" >
                                        <a href="{{ route('product', $product->slug) }}" class="text-dark  text-hover-primary mb-1 fs-6">{{ $product->getTranslation('name') }}</a>
                                    </td>
                                    <td>
                                        <a href="{{route('property_inquiries.index')}}?property={{$product->id}}">({{count($product->iqnuiries)}})</a>
                                    </td>
                                    <td>
                                        @if($product->user && $product->user->shop)
                                         <a class="text-dark text-hover-primary"  href="{{route('sellers.edit',$product->user->id)}}" >{{$product->user->shop->name}}
                                        </a>
                                        @else
                                        -
                                        @endif
                                    </td>
                                    <td>
                                        @if($product->country)
                                        <a class="text-dark text-hover-primary"  href="{{route('property_countries.edit',$product->country->id)}}" >{{$product->country->name}}</a>,@endif
                                        @if($product->state)
                                        <a class="text-dark text-hover-primary" href="{{route('property_states.edit',$product->state->id)}}" >{{$product->state->name}}</a>,@endif
                                        @if($product->city)
                                        <a class="text-dark text-hover-primary" href="{{route('property_cities.edit',$product->city->id)}}" >{{$product->city->name}}</a>,@endif
                                        @if($product->area)
                                        <a class="text-dark text-hover-primary" href="{{route('property_areas.edit',$product->area->id)}}" >{{$product->area->name}}</a>,@endif
                                        @if($product->nested_area)
                                        <a class="text-dark text-hover-primary" href="{{route('property_nested_areas.edit',$product->nested_area->id)}}" >{{$product->nested_area->name}}</a>,@endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')])}}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                            <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                            </svg>
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
            </div>
            <div class="col-md-6">
                <div class="card card-xxl-stretch mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1"> {{ translate('Recently Added Properties')}}</span>
                        </h3>
                        <div class="card-toolbar"></div>
                    </div>
                    <div style="max-height: 400px;overflow-y: scroll;" class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                <thead style="font-weight: bold" >
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                </thead>
                                
                                <tbody>
                                <?php 
                                  $recentlyadded = \App\Models\Product::where('published', 1)->orderBy('created_at', 'desc')->limit(12)->get();     
                                ?>
                                @foreach($recentlyadded as $key => $product)
                                <tr>
                                    <td>
                                        <img style="width: 50px" src="{{ uploaded_asset($product->thumbnail_img) }}" />
                                    </td>
                                    <td>
                                        <a href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ $product->getTranslation('name') }}</a>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('products.admin.edit', ['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]) }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                            <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                            </svg>
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
            </div>
            <div class="col-md-6">
                <div class="card card-xxl-stretch mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">{{ translate('Recently Added Inquiries')}}</span>
                        </h3>
                        <div class="card-toolbar"></div>
                    </div>
                    <div style="max-height: 400px;overflow-y: scroll;" class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                <thead style="font-weight: bold" >
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                <?php 
                                  $recentlyadded = \App\Models\PropertyInquiry::orderBy('created_at', 'desc')->limit(12)->get();     
                                ?>
                                @foreach($recentlyadded as $key => $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td class="text-end">
                                        <a href="{{ route('property_inquiries.edit', $item->id) }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                            <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                            </svg>
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
            </div>
        </div>
    </div>
    

    <!--begin::Post-->
    <div class="d-none post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container-xxl">

            <div class="row gy-5 g-xl-8">

                <div class="col-xl-4 d-none">
                    <div class="card card-xl-stretch">
                        <div class="card-header align-items-center border-0 mt-4">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="fw-bolder mb-2 text-dark">Activities</span>
                                <span class="text-muted fw-bold fs-7">890,344 Sales</span>
                            </h3>
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																	<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																	<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																	<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																</g>
															</svg>
														</span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61bc33c4f09dc">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61bc33c4f09dc" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Timeline-->
                            <div class="timeline-label">
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">08:42</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-warning fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div class="fw-mormal timeline-content text-muted ps-3">Outlines keep you honest. And keep structure</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">10:00</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Content-->
                                    <div class="timeline-content d-flex">
                                        <span class="fw-bolder text-gray-800 ps-3">AEOL meeting</span>
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">14:37</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-danger fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Desc-->
                                    <div class="timeline-content fw-bolder text-gray-800 ps-3">Make deposit
                                        <a href="#" class="text-primary">USD 700</a>. to ESL</div>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">16:50</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-primary fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">21:03</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-danger fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Desc-->
                                    <div class="timeline-content fw-bold text-gray-800 ps-3">New order placed
                                        <a href="#" class="text-primary">#XF-2356</a>.</div>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">16:50</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-primary fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div class="timeline-content fw-mormal text-muted ps-3">Indulging in poorly driving and keep structure keep great</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">21:03</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-danger fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Desc-->
                                    <div class="timeline-content fw-bold text-gray-800 ps-3">New order placed
                                        <a href="#" class="text-primary">#XF-2356</a>.</div>
                                    <!--end::Desc-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="timeline-item">
                                    <!--begin::Label-->
                                    <div class="timeline-label fw-bolder text-gray-800 fs-6">10:30</div>
                                    <!--end::Label-->
                                    <!--begin::Badge-->
                                    <div class="timeline-badge">
                                        <i class="fa fa-genderless text-success fs-1"></i>
                                    </div>
                                    <!--end::Badge-->
                                    <!--begin::Text-->
                                    <div class="timeline-content fw-mormal text-muted ps-3">Finance KPI Mobile app launch preparion meeting</div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Timeline-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end: List Widget 5-->
                </div>
                <!--end::Col-->
            </div>
            <br>
            <!--end::Row-->
            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <!--begin::Charts Widget 1-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Category wise product sale</span>
                               {{-- <span class="text-muted fw-bold fs-7">More than 400 new members</span>--}}
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                {{-- <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-2">
															<svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
																	<rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																	<rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																	<rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
																</g>
															</svg>
														</span>
                                    <!--end::Svg Icon-->
                                </button> --}}
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61bc340902ed2">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <div class="px-7 py-5">
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61bc340902ed2" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <!--end::Label-->
                                            <!--begin::Options-->
                                            <div class="d-flex">
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <!--end::Options-->
                                                <!--begin::Options-->
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                                <!--end::Options-->
                                            </div>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <!--end::Label-->
                                            <!--begin::Switch-->
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                            <!--end::Switch-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_1_charts" style="height: 350px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Charts Widget 1-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Charts Widget 1-->
                    <div class="card card-xl-stretch mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">Category wise product stock</span>
{{--                                <span class="text-muted fw-bold fs-7">More than 400 new members</span>--}}
                            </h3>
                            <div class="card-toolbar">
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61bc340902ed2">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>
                                    <div class="px-7 py-5">
                                        <div class="mb-10">
                                            <label class="form-label fw-bold">Status:</label>
                                            <div>
                                                <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61bc340902ed2" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="1">Approved</option>
                                                    <option value="2">Pending</option>
                                                    <option value="2">In Process</option>
                                                    <option value="2">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-bold">Member Type:</label>
                                            <div class="d-flex">
                                                <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                    <span class="form-check-label">Author</span>
                                                </label>
                                                <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                    <span class="form-check-label">Customer</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mb-10">
                                            <label class="form-label fw-bold">Notifications:</label>
                                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                                <label class="form-check-label">Enabled</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="kt_charts_widget_1_chart2" style="height: 350px"></div>
                        </div>
                    </div>
                </div>
            </div>
    



        
            <div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <form class="form" action="#" id="kt_modal_add_event_form">
                            <div class="modal-header">
                                <h2 class="fw-bolder" data-kt-calendar="title">Add Event</h2>
                                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close">
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <div class="modal-body py-10 px-lg-17">
                                <div class="fv-row mb-9">
                                    <label class="fs-6 fw-bold required mb-2">Event Name</label>
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold mb-2">Event Description</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold mb-2">Event Location</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-9">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday" />
                                        <span class="form-check-label fw-bold" for="kt_calendar_datepicker_allday">All Day</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold mb-2 required">Event Start Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold mb-2">Event Start Time</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="Pick a start time" id="kt_calendar_datepicker_start_time" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-lg-2 g-10">
                                    <div class="col">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold mb-2 required">Event End Date</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="Pick a end date" id="kt_calendar_datepicker_end_date" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <div class="col" data-kt-calendar="datepicker">
                                        <div class="fv-row mb-9">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-bold mb-2">Event End Time</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="Pick a end time" id="kt_calendar_datepicker_end_time" />
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">Cancel</button>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
														<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
            </div>
     

            <div class="modal fade" id="kt_modal_view_event" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <div class="modal-content">
                        <div class="modal-header border-0 justify-content-end">
                            <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Edit Event" id="kt_modal_view_event_edit">
                                <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black" />
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black" />
                                </svg>
                            </span>
                               
                            </div>
                            



                            <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Delete Event" id="kt_modal_view_event_delete">
                                <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black" />
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black" />
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black" />
                                </svg>
                            </span>
                            </div>
                        

                            <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="Hide Event" data-bs-dismiss="modal">
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                

                        <div class="modal-body pt-0 pb-20 px-lg-17">
                            <div class="d-flex">
                                <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="black" />
                                    <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="black" />
                                    <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="black" />
                                </svg>
                            </span>
                                
                                <div class="mb-9">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="fs-3 fw-bolder me-3" data-kt-calendar="event_name"></span>
                                        <span class="badge badge-light-success" data-kt-calendar="all_day"></span>
                                    </div>
                                    <div class="fs-6" data-kt-calendar="event_description"></div>
                                </div>
                            </div>
                           
                            <div class="d-flex align-items-center mb-2">
                                <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <circle fill="#000000" cx="12" cy="12" r="8" />
                                    </svg>
                                </span>
                                <div class="fs-6">
                                    <span class="fw-bolder">Starts</span>
                                    <span data-kt-calendar="event_start_date"></span>
                                </div>
                            </div>
                    
                            <div class="d-flex align-items-center mb-9">
                                <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <circle fill="#000000" cx="12" cy="12" r="8" />
                                    </svg>
                                </span>
                                <div class="fs-6">
                                    <span class="fw-bolder">Ends</span>
                                    <span data-kt-calendar="event_end_date"></span>
                                </div>
                            </div>
                        


                            <div class="d-flex align-items-center">
                                <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="black" />
                                        <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="black" />
                                    </svg>
                                </span>
                                <div class="fs-6" data-kt-calendar="event_location"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




{{--@if(env('MAIL_USERNAME') == null && env('MAIL_PASSWORD') == null)--}}
{{--    <div class="">--}}
{{--        <div class="alert alert-danger d-flex align-items-center">--}}
{{--            {{translate('Please Configure SMTP Setting to work all email sending functionality')}},--}}
{{--            <a class="alert-link ml-2" href="{{ route('smtp_settings.index') }}">{{ translate('Configure Now') }}</a>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}
{{--@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))--}}
{{--<div class="row gutters-10">--}}
{{--    <div class="col-lg-6">--}}
{{--        <div class="row gutters-10">--}}
{{--            <div class="col-6">--}}
{{--                <div class="bg-grad-2 text-white rounded-lg mb-4 overflow-hidden">--}}
{{--                    <div class="px-3 pt-3">--}}
{{--                        <div class="opacity-50">--}}
{{--                            <span class="fs-12 d-block">{{ translate('Total') }}</span>--}}
{{--                            {{ translate('Customer') }}--}}
{{--                        </div>--}}
{{--                        <div class="h3 fw-700 mb-3">--}}
{{--                            {{ \App\Models\User::where('user_type', 'customer')->where('email_verified_at', '!=', null)->count() }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">--}}
{{--                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <div class="bg-grad-3 text-white rounded-lg mb-4 overflow-hidden">--}}
{{--                    <div class="px-3 pt-3">--}}
{{--                        <div class="opacity-50">--}}
{{--                            <span class="fs-12 d-block">{{ translate('Total') }}</span>--}}
{{--                            {{ translate('Order') }}--}}
{{--                        </div>--}}
{{--                        <div class="h3 fw-700 mb-3">{{ \App\Models\Order::count() }}</div>--}}
{{--                    </div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">--}}
{{--                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <div class="bg-grad-1 text-white rounded-lg mb-4 overflow-hidden">--}}
{{--                    <div class="px-3 pt-3">--}}
{{--                        <div class="opacity-50">--}}
{{--                            <span class="fs-12 d-block">{{ translate('Total') }}</span>--}}
{{--                            {{ translate('Product category') }}--}}
{{--                        </div>--}}
{{--                        <div class="h3 fw-700 mb-3">{{ \App\Models\Category::count() }}</div>--}}
{{--                    </div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">--}}
{{--                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <div class="bg-grad-4 text-white rounded-lg mb-4 overflow-hidden">--}}
{{--                    <div class="px-3 pt-3">--}}
{{--                        <div class="opacity-50">--}}
{{--                            <span class="fs-12 d-block">{{ translate('Total') }}</span>--}}
{{--                            {{ translate('Product brand') }}--}}
{{--                        </div>--}}
{{--                        <div class="h3 fw-700 mb-3">{{ \App\Models\Brand::count() }}</div>--}}
{{--                    </div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">--}}
{{--                        <path fill="rgba(255,255,255,0.3)" fill-opacity="1" d="M0,128L34.3,112C68.6,96,137,64,206,96C274.3,128,343,224,411,250.7C480,277,549,235,617,213.3C685.7,192,754,192,823,181.3C891.4,171,960,149,1029,117.3C1097.1,85,1166,43,1234,58.7C1302.9,75,1371,149,1406,186.7L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-lg-6">--}}
{{--        <div class="row gutters-10">--}}
{{--            <div class="col-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h6 class="mb-0 fs-14">{{ translate('Products') }}</h6>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <canvas id="pie-1" class="w-100" height="305"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <h6 class="mb-0 fs-14">{{ translate('Sellers') }}</h6>--}}
{{--                    </div>--}}
{{--                    <div class="card-body">--}}
{{--                        <canvas id="pie-2" class="w-100" height="305"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endif--}}


{{--@if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))--}}
{{--    <div class="row gutters-10">--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h6 class="mb-0 fs-14">{{ translate('Category wise product sale') }}</h6>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <canvas id="graph-1" class="w-100" height="500"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h6 class="mb-0 fs-14">{{ translate('Category wise product stock') }}</h6>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <canvas id="graph-2" class="w-100" height="500"></canvas>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        <h6 class="mb-0">{{ translate('Top 12 Products') }}</h6>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--        <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="6" data-xl-items="5" data-lg-items="4" data-md-items="3" data-sm-items="2" data-arrows='true'>--}}
{{--            @foreach (filter_products(\App\Models\Product::where('published', 1)->orderBy('num_of_sale', 'desc'))->limit(12)->get() as $key => $product)--}}
{{--                <div class="carousel-box">--}}
{{--                    <div class="aiz-card-box border border-light rounded shadow-sm hov-shadow-md mb-2 has-transition bg-white">--}}
{{--                        <div class="position-relative">--}}
{{--                            <a href="{{ route('product', $product->slug) }}" class="d-block">--}}
{{--                                <img--}}
{{--                                    class="img-fit lazyload mx-auto h-210px"--}}
{{--                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"--}}
{{--                                    data-src="{{ uploaded_asset($product->thumbnail_img) }}"--}}
{{--                                    alt="{{  $product->getTranslation('name')  }}"--}}
{{--                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"--}}
{{--                                >--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="p-md-3 p-2 text-left">--}}
{{--                            <div class="fs-15">--}}
{{--                                @if(home_base_price($product) != home_discounted_base_price($product))--}}
{{--                                    <del class="fw-600 opacity-50 mr-1">{{ home_base_price($product) }}</del>--}}
{{--                                @endif--}}
{{--                                <span class="fw-700 text-primary">{{ home_discounted_base_price($product) }}</span>--}}
{{--                            </div>--}}
{{--                            <div class="rating rating-sm mt-1">--}}
{{--                                {{ renderStarRating($product->rating) }}--}}
{{--                            </div>--}}
{{--                            <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 mb-0">--}}
{{--                                <a href="{{ route('product', $product->slug) }}" class="d-block text-reset">{{ $product->getTranslation('name') }}</a>--}}
{{--                            </h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<?php 
 
 $seller = 
  
  $agent = \App\Models\User::where('user_type', 'seller')->where('type', 'agent')->get()->pluck('id')->toArray();
  $agency = \App\Models\User::where('user_type', 'seller')->where('type', 'agency')->get()->pluck('id')->toArray();

//   $products = \App\Models\Product::where('published', 1)->whereIn('user_id',$agency)->get();
//   dd($products);
 
?>

@endsection
@section('script')
<script type="text/javascript">

    var TPS  = {{ \App\Models\Product::where('published', 1)->count() }};
    var TSP  = {{ \App\Models\Product::where('published', 1)->whereIn('user_id',$agent)->count() }};
    var TAP  = {{ \App\Models\Product::where('published', 1)->whereIn('user_id',$agency)->count() }};

    var e=document.querySelectorAll(".mixed-widget-17-charts");[].slice.call(e).map((function(e){var t=parseInt(KTUtil.css(e,"height"));if(e){var a=e.getAttribute("data-kt-chart-color"),o={labels:["Published Properties"],series:[TPS],chart:{fontFamily:"inherit",height:t,type:"radialBar",offsetY:0},plotOptions:{radialBar:{startAngle:-90,endAngle:90,hollow:{margin:0,size:"55%"},dataLabels:{showOn:"always",name:{show:!0,fontSize:"12px",fontWeight:"700",offsetY:-5,color:KTUtil.getCssVariableValue("--bs-gray-500")},value:{color:KTUtil.getCssVariableValue("--bs-gray-900"),fontSize:"24px",fontWeight:"600",offsetY:-40,show:!0,formatter:function(e){return TPS}}},track:{background:KTUtil.getCssVariableValue("--bs-gray-300"),strokeWidth:"100%"}}},colors:[KTUtil.getCssVariableValue("--bs-"+a)],stroke:{lineCap:"round"}};new ApexCharts(e,o).render()}}))

    var e=document.querySelectorAll(".mixed-widget-18-charts");[].slice.call(e).map((function(e){var t=parseInt(KTUtil.css(e,"height"));if(e){var a=e.getAttribute("data-kt-chart-color"),o={labels:["Agents Properties"],series:[TSP],chart:{fontFamily:"inherit",height:t,type:"radialBar",offsetY:0},plotOptions:{radialBar:{startAngle:-90,endAngle:90,hollow:{margin:0,size:"55%"},dataLabels:{showOn:"always",name:{show:!0,fontSize:"12px",fontWeight:"700",offsetY:-5,color:KTUtil.getCssVariableValue("--bs-gray-500")},value:{color:KTUtil.getCssVariableValue("--bs-gray-900"),fontSize:"24px",fontWeight:"600",offsetY:-40,show:!0,formatter:function(e){return TSP}}},track:{background:KTUtil.getCssVariableValue("--bs-gray-300"),strokeWidth:"100%"}}},colors:[KTUtil.getCssVariableValue("--bs-"+a)],stroke:{lineCap:"round"}};new ApexCharts(e,o).render()}}))
    
    var e=document.querySelectorAll(".mixed-widget-19-charts");[].slice.call(e).map((function(e){var t=parseInt(KTUtil.css(e,"height"));if(e){var a=e.getAttribute("data-kt-chart-color"),o={labels:["Agency Properties"],series:[TAP],chart:{fontFamily:"inherit",height:t,type:"radialBar",offsetY:0},plotOptions:{radialBar:{startAngle:-90,endAngle:90,hollow:{margin:0,size:"55%"},dataLabels:{showOn:"always",name:{show:!0,fontSize:"12px",fontWeight:"700",offsetY:-5,color:KTUtil.getCssVariableValue("--bs-gray-500")},value:{color:KTUtil.getCssVariableValue("--bs-gray-900"),fontSize:"24px",fontWeight:"600",offsetY:-40,show:!0,formatter:function(e){return TAP}}},track:{background:KTUtil.getCssVariableValue("--bs-gray-300"),strokeWidth:"100%"}}},colors:[KTUtil.getCssVariableValue("--bs-"+a)],stroke:{lineCap:"round"}};new ApexCharts(e,o).render()}}))

    a = document.getElementById("kt_charts_widget_1_charts"), o = parseInt(KTUtil.css(a, "height")), s = KTUtil.getCssVariableValue("--bs-gray-500"), r = KTUtil.getCssVariableValue("--bs-gray-200"), i = KTUtil.getCssVariableValue("--bs-primary"), l = KTUtil.getCssVariableValue("--bs-gray-300"), a && new ApexCharts(a, {
        series: [{
            name: "No of Sales",
            data: [{{ $cached_graph_data['num_of_sale_data'] }}]
        } ],
        chart: {
            fontFamily: "inherit",
            type: "bar",
            height: o,
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: ["30%"],
                borderRadius: 4
            }
        },
        legend: {
            show: !1
        },
        dataLabels: {
            enabled: !1
        },
        stroke: {
            show: !0,
            width: 2,
            colors: ["#001aff"]
        },
        xaxis: {
            categories: [ @foreach ($root_categories as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach],
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "12px"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "12px"
                }
            }
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: "none",
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: "none",
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: !1,
                filter: {
                    type: "none",
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: "12px"
            },
            y: {
                formatter: function(e) {
                    return  e
                }
            }
        },
        colors: [i, l],
        grid: {
            borderColor: r,
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: !0
                }
            }
        }
    }).render();




    a = document.getElementById("kt_charts_widget_1_chart2"), o = parseInt(KTUtil.css(a, "height")), s = KTUtil.getCssVariableValue("--bs-gray-500"), r = KTUtil.getCssVariableValue("--bs-gray-200"), i = KTUtil.getCssVariableValue("--bs-primary"), l = KTUtil.getCssVariableValue("--bs-gray-300"), a && new ApexCharts(a, {
        series: [{
            name: "No of Stock",
            data: [{{ $cached_graph_data['qty_data'] }}]
        } ],
        chart: {
            fontFamily: "inherit",
            type: "bar",
            height: o,
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !1,
                columnWidth: ["30%"],
                borderRadius: 4
            }
        },
        legend: {
            show: !1
        },
        dataLabels: {
            enabled: !1
        },
        stroke: {
            show: !0,
            width: 2,
            colors: ["#ff0032"]
        },
        xaxis: {
            categories: [ @foreach ($root_categories as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach],
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                style: {
                    colors: s,
                    fontSize: "12px"
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: s,
                    fontSize: "12px"
                }
            }
        },
        fill: {
            opacity: 1
        },
        states: {
            normal: {
                filter: {
                    type: "none",
                    value: 0
                }
            },
            hover: {
                filter: {
                    type: "none",
                    value: 0
                }
            },
            active: {
                allowMultipleDataPointsSelection: !1,
                filter: {
                    type: "none",
                    value: 0
                }
            }
        },
        tooltip: {
            style: {
                fontSize: "12px"
            },
            y: {
                formatter: function(e) {
                    return   e
                }
            }
        },
        colors: [i, l],
        grid: {
            borderColor: r,
            strokeDashArray: 4,
            yaxis: {
                lines: {
                    show: !0
                }
            }
        }
    }).render();




    AIZ.plugins.chart('#pie-1',{
        type: 'doughnut',
        data: {
            labels: [
                '{{translate('Total published products')}}',
                '{{translate('Total sellers products')}}',
                '{{translate('Total admin products')}}'
            ],
            datasets: [
                {
                    data: [
                        {{ \App\Models\Product::where('published', 1)->count() }},
                        {{ \App\Models\Product::where('published', 1)->where('added_by', 'seller')->count() }},
                        {{ \App\Models\Product::where('published', 1)->where('added_by', 'admin')->count() }}
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }
            ]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
                position: 'bottom'
            }
        }
    });

    AIZ.plugins.chart('#pie-2',{
        type: 'doughnut',
        data: {
            labels: [
                '{{translate('Total sellers')}}',
                '{{translate('Total approved sellers')}}',
                '{{translate('Total pending sellers')}}'
            ],
            datasets: [
                {
                    data: [
                        {{ \App\Models\Seller::count() }},
                        {{ \App\Models\Seller::where('verification_status', 1)->count() }},
                        {{ \App\Models\Seller::where('verification_status', 0)->count() }}
                    ],
                    backgroundColor: [
                        "#fd3995",
                        "#34bfa3",
                        "#5d78ff",
                        '#fdcb6e',
                        '#d35400',
                        '#8e44ad',
                        '#006442',
                        '#4D8FAC',
                        '#CA6924',
                        '#C91F37'
                    ]
                }
            ]
        },
        options: {
            cutoutPercentage: 70,
            legend: {
                labels: {
                    fontFamily: 'Montserrat',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
                position: 'bottom'
            }
        }
    });





    AIZ.plugins.chart('#graph-1',{
        type: 'bar',
        data: {
            labels: [
                @foreach ($root_categories as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [{
                label: '{{ translate('Number of sale') }}',
                data: [
                    {{ $cached_graph_data['num_of_sale_data'] }}
                ],
                backgroundColor: [
                    @foreach ($root_categories as $key => $category)
                        'rgba(55, 125, 255, 0.4)',
                    @endforeach
                ],
                borderColor: [
                    @foreach ($root_categories as $key => $category)
                        'rgba(55, 125, 255, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#f2f3f8',
                        zeroLineColor: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10
                    }
                }]
            },
            legend:{
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
            }
        }
    });
    AIZ.plugins.chart('#graph-2',{
        type: 'bar',
        data: {
            labels: [
                @foreach ($root_categories as $key => $category)
                '{{ $category->getTranslation('name') }}',
                @endforeach
            ],
            datasets: [{
                label: '{{ translate('Number of Stock') }}',
                data: [
                    {{ $cached_graph_data['qty_data'] }}
                ],
                backgroundColor: [
                    @foreach ($root_categories as $key => $category)
                        'rgba(253, 57, 149, 0.4)',
                    @endforeach
                ],
                borderColor: [
                    @foreach ($root_categories as $key => $category)
                        'rgba(253, 57, 149, 1)',
                    @endforeach
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    gridLines: {
                        color: '#f2f3f8',
                        zeroLineColor: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10,
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    gridLines: {
                        color: '#f2f3f8'
                    },
                    ticks: {
                        fontColor: "#8b8b8b",
                        fontFamily: 'Poppins',
                        fontSize: 10
                    }
                }]
            },
            legend:{
                labels: {
                    fontFamily: 'Poppins',
                    boxWidth: 10,
                    usePointStyle: true
                },
                onClick: function () {
                    return '';
                },
            }
        }
    });



</script>
@endsection
