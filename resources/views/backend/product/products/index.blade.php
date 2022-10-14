@extends('backend.layouts.app')
@section('css')

    <link rel="stylesheet" href="{{asset('/public/assets/backend/css/confirm.css')}}" />
    <style>
        .display_pagnination {
            padding: 10px 0px;
        }

        .display_pagnination .active{
            background: rgb(15, 133, 243);
        }

        .mytable{ 
            min-width: 1075px!important;
        }

        .mytable tbody tr{
            text-align: center;
        }

        .actions {
            left: -96px!important;
            width: 169px!important;
        }

        .myaction .dropdown-item {
            padding: 6px 12px!important;
        }

    </style>
@endsection
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
                        <div class="card-header container-fluid ">
                                <div class="row pt-3">
                                        <div class="col-md-3">
                                            <div class="d-flex align-items-center position-relative my-1">
                                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                <i class="fas fa-search" ></i>
                                                </span>
                                                <input type="text" class="data_search form-control form-control-solid w-250px ps-14" id="search" placeholder="{{ translate('Type & Enter') }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <select data-control="select2"  class="user_id form-control mr-2">
                                                <option value="">Select Agent</option>
                                                @foreach ($sellers as $item)
                                                    <option value="{{$item->id}}">{{$item->shop->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-3">
                                           <select data-control="select2"  class="purpose_id form-control mr-2">
                                                <option value="">Select Type</option>
                                                @foreach ($purposes as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @foreach ($item->children as $child)
                                                    <option value="{{$child->id}}">--{{$child->name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select data-control="select2"  class="type_id form-control mr-2">
                                                <option value="">Select Purpose</option>
                                                @foreach ($types as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                    @foreach ($item->children as $child)
                                                    <option value="{{$child->id}}">-- {{$child->name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                          </div>
                                          <div class="col-md-6 py-5 ">
                                            <h4 class="d-inline" > {{translate('All Poperties')}}
                                             </h4> - 
                                            <span class="text-muted page_info "></span>  
                                          </div>
                                          <div style="justify-content: end;" class="py-5 col-md-6 d-flex text-right ">
                                               
                                                <select style="width: 104px;" class=" data_length form-select form-control" >
                                                    <option value="10">Length</option>
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                </select>
                                                <div class="myaction mx-1 dropdown">
                                                    <button class="btn btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action</button>
                                                    <div class="dropdown-menu actions" aria-labelledby="dropdownMenuButton">
                                                      
                                                      <a href="{{ route('products.admin.edit', ['id' => 0, 'lang' => env('DEFAULT_LANGUAGE')]) }}" class="dropdown-item ">{{ translate('Add New Property') }}</a>
                                                        
                                                      <button type="button" data-value="0" data-action="delete" class="dropdown-item action_button">{{translate('Delete')}} </button>
                                                    
                                                      <button type="button" data-value="1" data-action="approved" class="dropdown-item action_button">{{translate('Approved')}} </button>
                                                     
                                                      <button type="button" data-value="0" data-action="approved" class="dropdown-item action_button">{{translate('Unapproved')}} </button>
                
                                                      <button type="button" data-value="1" data-action="published" class="dropdown-item action_button">{{translate('Published')}} </button>
                
                                                      <button type="button" data-value="0" data-action="published" class="dropdown-item action_button">{{translate('Unpublished')}} </button>
                
                                                      <button type="button" data-value="1" data-action="featured" class="dropdown-item action_button">{{translate('Featured')}} </button>
            
                                                      <button type="button" data-value="0" data-action="featured" class="dropdown-item action_button">{{translate('Unfeatured')}} </button>
                                                </div>
                                          </div>
                                      </div>           
                                 </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="mytable table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                    <thead>
                                        <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2"><div class=" form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="bulk_check form-check-input" type="checkbox" />
                                            </div>
                                            </th>
                                            <th class="w-10px pe-2"> {{translate('ID')}}</th>
                                            <th class="">{{ translate('Image') }}</th>
                                            <th   class="">{{ translate('Property Name') }}</th>
                                            <th class="">{{ translate('Refrence') }}</th>
                                            <th class="">{{ translate('Price') }}</th>
                                            <th class="text-center">{{ translate('Purpose') }}</th>
                                            <th class="text-center">{{ translate('Type') }}</th>
                                            <th class="text-center">{{ translate('Published') }}</th>
                                            <th class="text-center">{{ translate('Approved') }}</th>
                                            <th class="text-center">{{ translate('Featured') }}</th>
                                            <th  class="text-center">{{ translate('Date') }}</th>
                                            <th style="width: 101px;"  class="text-center">{{ translate('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody class="show_data fw-bold text-gray-600">
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="display_pagnination text-center ">
                                
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
<script>
    

    let action_route = "{{route('products.bulk')}}";
    let data_route = "{{route('products.all')}}";
    let mytable = $('.mytable');
    let body = $('.mytable tbody');
    let page_info = $('.page_info');
    let bulk = $('.bulk_check');
    let actionButton = $('.actions button');
    let length = $('.data_length');
    let search = $('.data_search');
    let agent = $(".user_id");
    let purpose = $(".purpose_id");
    let type = $(".type_id");
    let pagination = $(".display_pagnination");
    
    let query = {
        search:'',
        page:1,
        length:'',
        agent:'',
        purpose:'',
        type:'',
    };



    const render = (response) => {  

          body.empty();  
          if(response.data == undefined && response.data.length == 0){
            body.empty();
            body.html(`<tr><td colspan="9" ><p class="text-center">Records Not Found</p></td></tr>`);
          }
            
           //Pagination

            page_info.text(response.to + '-' + response.total);   
            pagination.empty();

            response.links.forEach(link => {
                let pageId = parseInt(link.label);
                if(pageId){
                    pagination.append(`<a data-href="${pageId}" class="btn btn-icon btn-sm  border-0 btn-light m-1  ${link.active ? 'active' : ''}"> ${link.label}</a>`);
                }
            });
               
            //Data
            response.data.forEach(item => {
                body.append(`<tr>
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="row_item_checkbox form-check-input" type="checkbox" value="${item.id}"/></div>
                        </td>
                        <td>${item.id}</td>
                        <td><img width="50px" src="${item.re_thumbnail_img}" /></td>
                        <td style="width: 286px;" >${item.name}</td>
                        <td>${item.ref}</td>
                        <td>${item.unit_price}</td>
                        <td class="text-center">
                            ${item.purpose ? item.purpose.name : ''} 
                            ${item.purpose_child ? item.purpose_child.name : ''}
                        </td>
                        <td class="text-center">${item.type.name}</td>
                        <td class="text-center" >
                            <label class="d-block form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" value="${item.id}" type="checkbox" ${item.published ? 'checked' : ''} />
                            </label>
                        </td>
                        <td class="text-center">
                            <label class="d-block form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" value="${item.id}" type="checkbox" ${item.approved ? 'checked' : ''} />
                            </label>
                        </td>
                        <td class="text-center">
                            <label class="d-block form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" value="${item.id}" type="checkbox" ${item.featured ? 'checked' : ''} />
                            </label>
                        </td>
                        <td style="width:100px" class="text-center">${item.date}</td>
                        <td style="width:100px" class="text-center">
                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"><span class="svg-icon svg-icon-3"><i class="text-primary fas fa-marker" ></i></span></a>
                            <button data-id="${item.id}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" ><span class="svg-icon svg-icon-3"><i class="text-danger far fa-trash-alt" ></i></span></button>
                        </td>
                    </tr>      
                `);
        });
   }


   const getUser = () => {
        body.empty();
        body.html(`<tr><td class="text-center"><p>Loading</p></td></tr>`);
        $.ajax({url:data_route,
            data: query,
            dataType: "json",
            success: function(response) {
                render(response);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){             
                              
            } 
        });
    }



    //Bulk Actions
    bulk.change(function(){
        if($(this).prop("checked") == true){
           body.find('.row_item_checkbox').prop("checked", true);
        }else if($(this).prop("checked") == false){
           body.find('.row_item_checkbox').prop("checked", false);
        }
    });


    actionButton.click(function(){

            let action = $(this).attr("data-action"); 
            let value = $(this).attr("data-value"); 
            let idz = [];     
            body.find('.row_item_checkbox:checked').each(function() {
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
                $.get("{{route('products.bulk')}}",
                { 
                    idz:idz.toString(),
                    action:action,
                    value:value
                }, function(data, status){
                    AIZ.plugins.notify('success','Action Performed Successfully');
                    bulk.prop('checked',false);
                    getUser();
                });    
            },
            Cancel: {}}});
    });
    //Bulk Actions


    
    //Filters
    search.change(function(){
        query.search = $(this).val();
        getUser();
    });

    agent.change(function(){
        query.agent = $(this).val();
        getUser();
    });

    purpose.change(function(){
        query.purpose = $(this).val();
        getUser();
    });

    type.change(function(){
        query.type = $(this).val();
        getUser();
    });

    

    length.change(function(){
        let pagecount = parseInt($(this).val()) | '';
        query.length = pagecount;
        getUser();
    });
   
    pagination.delegate("a", "click", function(){
        $(".display_pagnination").empty();
        let href = $(this).attr("data-href"); 
        query.page = href;
        getUser();
    });













    // onDelete
    // $(".show_data").delegate(".delete_btn", "click", function(){
    //     let id =  $(this).val();
    //     $.confirm({
    //         closeIcon: true, 
    //         title: false,
    //         content:'Are you sure to continue ?',
    //         buttons: { 
    //                 Ok:function(){
    //                     $.get("{{route('products.bulk')}}",
    //                             { 
    //                                 idz:id,
    //                                 action:'delete',
    //                                 value:0
    //                             }, function(data, status){                   
    //                                 AIZ.plugins.notify('success','Record Deleted');
    //                                 getUser();
    //                         });
    //                 },
    //                 Cancel: {
    //                     action: function () {
    //                     }
    //                 }
    //             }
    //         });
    // });
    
    // $(".show_data").delegate(".featured_toggle", "change", function(){
    //     let id =  $(this).val();
    //     if($(this).prop("checked") == true){
                    
    //                 $.get("{{route('products.bulk')}}",
    //                 { 
    //                     idz:id,
    //                     action:'featured',
    //                     value:1
    //                 }, function(data, status){
    //                     // AIZ.plugins.notify('success','Success');
    //                 });
    //     }else if($(this).prop("checked") == false){
                
    //             $.get("{{route('products.bulk')}}",
    //             { 
    //                 idz:id,
    //                 action:'featured',
    //                 value:0
    //             }, function(data, status){ 
    //             });
    //     }
    // });

    // $(".show_data").delegate(".active_toggle", "change", function(){
    //     let id =  $(this).val();
    //     if($(this).prop("checked") == true){
                    
    //                 $.get("{{route('products.bulk')}}",
    //                 { 
    //                     idz:id,
    //                     action:'active',
    //                     value:1
    //                 }, function(data, status){
    //                     // AIZ.plugins.notify('success','Success');
    //                 });
    //     }else if($(this).prop("checked") == false){
                
    //             $.get("{{route('products.bulk')}}",
    //             { 
    //                 idz:id,
    //                 action:'active',
    //                 value:0
    //             }, function(data, status){ 
    //             });
    //     }
    // });
    

    getUser();
</script> 
@endsection