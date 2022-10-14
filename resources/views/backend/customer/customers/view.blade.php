@extends('backend.layouts.app')
@section('content')

    <!--begin::Content-->
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="toolbar" id="kt_toolbar">
            <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
                <div  class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">{{translate('Customer')}}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route("admin.dashboard") }}" class="text-muted text-hover-primary"> {{ translate('Home')}}</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-300 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted"> <a href="{{route('customers.index')}}">{{ translate('customers')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
     <!--end::Toolbar-->

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xl">
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{translate('Customer Information')}}</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 text-center ">
                                                <span class="avatar avatar-xxl mb-3">
                                                    <img src="{{$data->avtar_orignal ? uploaded_asset($data->avtar_orignal) : 'http://localhost/onlinepropertylive/public/assets/img/avatar-place.png'}}" />
                                                </span>

                                              
                                                <div class="pad-ver btn-groups">
                                                    @if($data->facebook)
                                                    
                                                    <a href="{{$data->facebook}}" target="_blank" class="btn btn-icon demo-pli-facebook icon-lg add-tooltip" data-original-title="Facebook" data-container="body"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16"> <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/> </svg></a>

                                                    @endif
                                
                                                    @if($data->twitter)
                                                    <a href="{{$data->shop->twitter}}" target="_blank" class="btn btn-icon demo-pli-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16"> <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/> </svg></a>
                                                    @endif
                                
                                                    @if($data->google)
                                                    <a href="{{$data->shop->google}}" target="_blank" class="btn btn-icon demo-pli-google-plus icon-lg add-tooltip" data-original-title="Google+" data-container="body"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16"> <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/> </svg></a>
                                                    @endif
                                                  </div>
                                                <hr>
                                            </div>
                                            <div class="col-md-6 pt-3">
                                                <h4>{{ translate('Account Details') }}</h4>
                                                <ul class="d-flex flex-column">
                                                    <li class="my-1"><strong> {{ translate('Username') }}: </strong> {{$data->name}}</li>
                                                    <li class="my-1"><strong> {{ translate('Email') }} :</strong> {{$data->email}}</li>
                                                    <li class="my-1" ><strong>{{translate('Email Verification')}} :</strong> {{ $data->email_verified_at == null ? translate('Verified') : translate('Not Verified')}}</li>
                                                    <li class="my-1" ><strong>{{translate('Joined Date')}} :</strong> {{$data->created_at}}</li>
                                                </ul>
                                            </div>

                                            <div class="col-md-6 pt-3">
                                                
                                                <h5> {{ translate('Address') }}</h5>
                                                <ul class="pb-3">
                                                    <li> <strong class="text-dark">{{ translate('Phone')}}</strong> :  {{ $data->phone}} </li>

                                                    <li><strong class="text-dark" >{{ translate('Country')}}</strong> : {{$data->country}}</li>

                                                    <li><strong class="text-dark" >{{ translate('State / Provence')}}</strong> : {{ $data->state}}</li>

                                                    <li><strong class="text-dark" >{{ translate('City')}}</strong> : {{ $data->city}}</li>
                                                    
                                                    <li><strong class="text-dark">{{ translate('Zip Code')}}</strong> : {{ $data->postal_code}}</li>

                                                    <li><strong class="text-dark">{{ translate('Street Addres')}}</strong> : {{ $data->address}}</li>
                                                </ul>
                                            </div>

                                            <div class="col-12">
                                                <div class="table-responsive pt-3">
                                                    <table class="table table-striped mar-no">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <strong>{{ translate('Total Inquiries') }}</strong>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                      $count = App\Models\PropertyInquiry::where('agent_id',$data->id)->get()->count();
                                                                    ?>
                                                                    {{$count }}
                                                                </td>
                                                                <td style="width: 50px" ><a class="btn btn-sm btn-primary" href="{{route('property_inquiries.index')}}?customer={{$data->id}}"> View</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="text-center pt-3 ">
                                        <a class="btn btn-primary" href="{{route('customers.index')}}"> Back</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                 </div>
           </div>
    </div>
</div>
@endsection