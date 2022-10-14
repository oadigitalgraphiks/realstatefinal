@extends('backend.layouts.app')
@section('content')

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
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>View</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="pb-3" >
                                    <p class="mt-1"><strong>{{ translate('Date:')}}</strong> {{$data->created_at}}</p>
                                    <p class="mt-1"><strong>{{ translate('Name')}} </strong>
                                        @if($data->agent) 
                                          <a href="{{route('customers.show',$data->agent->id)}}"> {{$data->agent->name}}</a> 
                                         @else 
                                          {{$data->name}}
                                         @endif 
                                    </p>
                                    <p class="mt-1"><strong>{{ translate('Email')}} :</strong> {{$data->email}}</p>
                                    <p class="mt-1"><strong>{{ translate('Phone')}}:</strong> {{$data->phone}}</p>
                                    <p class="mt-1"><strong>{{ translate('Message')}}:</strong> {{$data->message}}</p>
                                    <p class="mt-1"><strong>{{ translate('Property')}}:</strong> 
                                     @if($data->property)<a href="{{route('products.admin.edit',$data->property->id)}}"> {{$data->property->name}}</a> @else - @endif </p>
                                    
                                    <p class="mt-1"><strong>{{ translate('Agent / Agency ')}}:</strong> 
                                        @if($data->property)<a href="{{route('sellers.show',$data->property->user->id)}}"> {{$data->property->user->shop->name}}</a> @else - @endif </p>
                                </div>
                               <div class="text-center" >
                                <a class="btn btn-primary" href="{{route('property_reports.index')}}"> {{ translate('Back') }}</a>
                               </div>
                            </div>
                        </div>
                   </div>
              </div>
          </div>
      </div>
@endsection
@section('script')
    
@endsection
