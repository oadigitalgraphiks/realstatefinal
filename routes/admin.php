<?php

/*
  |--------------------------------------------------------------------------
  | Admin Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register admin routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

    Route::get('/test',function(){

        dd('asdasd');


    });

Route::post('/update', 'UpdateController@step0')->name('update');
Route::get('/update/step1', 'UpdateController@step1')->name('update.step1');
Route::get('/update/step2', 'UpdateController@step2')->name('update.step2');

Route::get('/admin', 'AdminController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    
   
    //Update Routes
    Route::resource('categories', 'CategoryController');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::get('/categories/destroy/{id}', 'CategoryController@destroy')->name('categories.destroy');
    Route::post('/categories/featured', 'CategoryController@updateFeatured')->name('categories.featured');

    // Brands
    Route::resource('brands', 'BrandController');
    Route::get('/brands/edit/{id}', 'BrandController@edit')->name('brands.edit');
    Route::get('/brands/destroy/{id}', 'BrandController@destroy')->name('brands.destroy');

    // Products
    Route::get('/dashboard', 'AdminController@admin_dashboard')->name('all_orders.index');

    Route::get('/properties/bulk', 'ProductController@bulk')->name('products.bulk');
    Route::get('/properties/all', 'ProductController@all_products')->name('products.all');
    Route::get('/properties/create', 'ProductController@create')->name('products.create');
    Route::get('/properties/admin/{id}/edit', 'ProductController@admin_product_edit')->name('products.admin.edit');
    Route::get('/properties/seller/{id}/edit', 'ProductController@seller_product_edit')->name('products.seller.edit');
    Route::post('/properties/todays_deal', 'ProductController@updateTodaysDeal')->name('products.todays_deal');
    Route::post('/properties/featured', 'ProductController@updateFeatured')->name('products.featured');
    Route::post('/properties/approved', 'ProductController@updateProductApproval')->name('products.approved');
    Route::post('/properties/get_products_by_subcategory', 'ProductController@get_products_by_subcategory')->name('products.get_products_by_subcategory');
    Route::post('/bulk-product-delete', 'ProductController@bulk_product_delete')->name('bulk-product-delete');

    // Property Types
    Route::resource('property_type', 'PropertyTypeController');
    Route::get("property_type/create/",'PropertyTypeController@create')->name('property_type.create');
    Route::get("property_type/edit/{id}",'PropertyTypeController@edit')->name('property_type.edit');
    Route::get('property_type/property/serach', 'PropertyTypeController@search')->name('property_type.search');
    Route::post('property_type/property/property_list', 'PropertyTypeController@product_list')->name('property_type.type_list');
    Route::get('property_types', 'PropertyTypeController@index')->name('product.property_type');
    Route::get('property_type/destroy/{id}', 'PropertyTypeController@destroy')->name('property_type.destroy');
    Route::post('/property_type/featured', 'PropertyTypeController@updateFeatured')->name('property_type.featured');

    //Property Purposes
    Route::resource('property_purposes', 'PropertyPurposeController');
    Route::get("property_purposes/create/",'PropertyPurposeController@create')->name('property_purposes.create');
    Route::get("property_purposes/edit/{id}",'PropertyPurposeController@edit')->name('property_purposes.edit');
    Route::get('property_purposes/product/serach', 'PropertyPurposeController@search')->name('property_purposes.search');
    Route::post('property_purposes/product/product_list', 'PropertyPurposeController@product_list')->name('property_purposes.type_list');
    Route::get('property_purposes', 'PropertyPurposeController@index')->name('property_purposes.index');
    Route::get('property_purposes/destroy/{id}', 'PropertyPurposeController@destroy')->name('property_purposes.destroy');
    Route::post('/property_purposes/featured', 'PropertyPurposeController@updateFeatured')->name('property_purposes.featured');

    //Propery Baths
    Route::get('property_baths', 'PropertyBathController@index')->name('property_baths.index');
    Route::get("property_baths/create/",'PropertyBathController@create')->name('property_baths.create');
    Route::post("property_baths/store/",'PropertyBathController@store')->name('property_baths.store');
    Route::get("property_baths/edit/{id}",'PropertyBathController@edit')->name('property_baths.edit');
    Route::post("property_baths/update/{id}",'PropertyBathController@update')->name('property_baths.update');
    Route::get('property_baths/destroy/{id}', 'PropertyBathController@destroy')->name('property_baths.destroy');
     
    //Property Beds
    Route::get('property_beds', 'PropertyBedController@index')->name('property_beds.index');
    Route::get("property_beds/create/",'PropertyBedController@create')->name('property_beds.create');
    Route::post("property_beds/store/",'PropertyBedController@store')->name('property_beds.store');
    Route::get("property_beds/edit/{id}",'PropertyBedController@edit')->name('property_beds.edit');
    Route::post("property_beds/update/{id}",'PropertyBedController@update')->name('property_beds.update');
    Route::get('property_beds/destroy/{id}', 'PropertyBedController@destroy')->name('property_beds.destroy');

    //Property Amenities
    Route::get('property_amenities', 'PropertyAmenityController@index')->name('property_amenities.index');
    Route::get("property_amenities/create/",'PropertyAmenityController@create')->name('property_amenities.create');
    Route::post("property_amenities/store/",'PropertyAmenityController@store')->name('property_amenities.store');
    Route::get("property_amenities/edit/{id}",'PropertyAmenityController@edit')->name('property_amenities.edit');
    Route::post("property_amenities/update/{id}",'PropertyAmenityController@update')->name('property_amenities.update');
    Route::get('property_amenities/destroy/{id}', 'PropertyAmenityController@destroy')->name('property_amenities.destroy');

    //Property Tour Types
    Route::get('property_tour_types', 'PropertyTourTypeController@index')->name('property_tour_types.index');
    Route::get("property_tour_types/create/",'PropertyTourTypeController@create')->name('property_tour_types.create');
    Route::post("property_tour_types/store/",'PropertyTourTypeController@store')->name('property_tour_types.store');
    Route::get("property_tour_types/edit/{id}",'PropertyTourTypeController@edit')->name('property_tour_types.edit');
    Route::post("property_tour_types/update/{id}",'PropertyTourTypeController@update')->name('property_tour_types.update');
    Route::get('property_tour_types/destroy/{id}', 'PropertyTourTypeController@destroy')->name('property_tour_types.destroy');

    //Property Countries
    Route::get('/property_countries_bulk', 'CountryController@bulk')->name('property_countries.bulk');
    Route::get('/property_countries', 'CountryController@index')->name('property_countries.index');
    Route::get('/property_countries/create', 'CountryController@create')->name('property_countries.create');
    Route::post('/property_countries/store', 'CountryController@store')->name('property_countries.store');
    Route::get('/property_countries/edit/{id}', 'CountryController@edit')->name('property_countries.edit');
    Route::post('/property_countries/update/{id}', 'CountryController@update')->name('property_countries.update');
    Route::get('/property_countries/destroy/{id}', 'CountryController@destroy')->name('property_countries.destroy');

    //Property States
    Route::get('/allstates', 'StateController@all_states')->name('allstates');
    Route::get('/property_states_bulk', 'StateController@bulk')->name('property_states.bulk');
    Route::get('/property_states', 'StateController@index')->name('property_states.index');
    Route::get('/property_states/create', 'StateController@create')->name('property_states.create');
    Route::post('/property_states/store', 'StateController@store')->name('property_states.store');
    Route::get('/property_states/edit/{id}', 'StateController@edit')->name('property_states.edit');
    Route::post('/property_states/update/{id}', 'StateController@update')->name('property_states.update');
    Route::get('/property_states/destroy/{id}', 'StateController@destroy')->name('property_states.destroy');

    // Property Cites
    Route::get('/all_cities', 'CityController@all_cities')->name('allcities');
    Route::get('/property_cities/bulk', 'CityController@bulk')->name('property_cities.bulk');
    Route::get('/property_cities', 'CityController@index')->name('property_cities.index');
    Route::get('/property_cities/create', 'CityController@create')->name('property_cities.create');
    Route::post('/property_cities/store', 'CityController@store')->name('property_cities.store');
    Route::get('/property_cities/edit/{id}', 'CityController@edit')->name('property_cities.edit');
    Route::post('/property_cities/update/{id}', 'CityController@update')->name('property_cities.update');
    Route::get('/property_cities/destroy/{id}', 'CityController@destroy')->name('property_cities.destroy');

    //Property Areas
    Route::get('/all_areas', 'AreaController@all_areas')->name('all_areas');
    Route::get('/property_areas/bulk', 'AreaController@bulk')->name('property_areas.bulk');
    Route::get('/property_areas', 'AreaController@index')->name('property_areas.index');
    Route::get('/property_areas/create', 'AreaController@create')->name('property_areas.create');
    Route::post('/property_areas/store', 'AreaController@store')->name('property_areas.store');
    Route::get('/property_areas/edit/{id}', 'AreaController@edit')->name('property_areas.edit');
    Route::post('/property_areas/update/{id}', 'AreaController@update')->name('property_areas.update');
    Route::get('/property_areas/destroy/{id}', 'AreaController@destroy')->name('property_areas.destroy');

    //Property Nested Areas
    Route::get('/all_nested_areas', 'NestedAreaController@all_nested_areas')->name('all_nested_areas');
    Route::get('/property_nested_areas/bulk', 'NestedAreaController@bulk')->name('property_nested_areas.bulk');
    Route::get('/property_nested_areas', 'NestedAreaController@index')->name('property_nested_areas.index');
    Route::get('/property_nested_areas/create', 'NestedAreaController@create')->name('property_nested_areas.create');
    Route::post('/property_nested_areas/store', 'NestedAreaController@store')->name('property_nested_areas.store');
    Route::get('/property_nested_areas/edit/{id}', 'NestedAreaController@edit')->name('property_nested_areas.edit');
    Route::post('/property_nested_areas/update/{id}', 'NestedAreaController@update')->name('property_nested_areas.update');
    Route::get('/property_nested_areas/destroy/{id}', 'NestedAreaController@destroy')->name('property_nested_areas.destroy');

    //Sellers
    Route::get('sellers/bulk', 'SellerController@bulk')->name('sellers.bulk');
    Route::resource('sellers', 'SellerController');
    Route::get('sellers_ban/{id}', 'SellerController@ban')->name('sellers.ban');
    Route::get('/sellers/destroy/{id}', 'SellerController@destroy')->name('sellers.destroy');
    Route::post('/bulk-seller-delete', 'SellerController@bulk_seller_delete')->name('bulk-seller-delete');
    Route::get('/sellers/view/{id}/verification', 'SellerController@show_verification_request')->name('sellers.show_verification_request');
    Route::get('/sellers/approve/{id}', 'SellerController@approve_seller')->name('sellers.approve');
    Route::get('/sellers/reject/{id}', 'SellerController@reject_seller')->name('sellers.reject');
    Route::get('/sellers/login/{id}', 'SellerController@login')->name('sellers.login');
    Route::post('/sellers/payment_modal', 'SellerController@payment_modal')->name('sellers.payment_modal');
    Route::get('/seller/payments', 'PaymentController@payment_histories')->name('sellers.payment_histories');
    Route::get('/seller/payments/show/{id}', 'PaymentController@show')->name('sellers.payment_history');

    //Property_inquiries
    Route::get('property_inquiries/bulk', 'PropertyInquiryController@bulk')->name('property_inquiries.bulk');
    Route::resource('property_inquiries', 'PropertyInquiryController');

    //Agency Signup    
    Route::resource('agency_signup_options', 'AgencySignupOptionController')->only(['index','create','store','update']); 
    Route::get("agency_signup_options/edit/{id}",'AgencySignupOptionController@edit')->name('agency_signup_options.edit');
    Route::get('agency_signup_options/destroy/{id}', 'AgencySignupOptionController@destroy')->name('agency_signup_options.destroy');

    // Property Spam Reports
    Route::resource('property_reports', 'PropertyReportController');
    Route::get("property_reports/edit/{id}",'PropertyReportController@edit')->name('property_reports.edit');
    Route::get('property_reports/destroy/{id}', 'PropertyReportController@destroy')->name('property_reports.destroy');
    

    Route::get('customers/bulk', 'CustomerController@bulk')->name('customers.bulk');
    Route::resource('customers', 'CustomerController');
    Route::get('customers_ban/{customer}', 'CustomerController@ban')->name('customers.ban');
    Route::get('/customers/login/{id}', 'CustomerController@login')->name('customers.login');
    Route::get('/customers/destroy/{id}', 'CustomerController@destroy')->name('customers.destroy');
    Route::post('/bulk-customer-delete', 'CustomerController@bulk_customer_delete')->name('bulk-customer-delete');

    Route::get('/newsletter', 'NewsletterController@index')->name('newsletters.index');
    Route::post('/newsletter/send', 'NewsletterController@send')->name('newsletters.send');
    Route::post('/newsletter/test/smtp', 'NewsletterController@testEmail')->name('test.smtp');

    Route::resource('profile', 'ProfileController');

    Route::post('/business-settings/update', 'BusinessSettingsController@update')->name('business_settings.update');
    Route::post('/business-settings/update/activation', 'BusinessSettingsController@updateActivationSettings')->name('business_settings.update.activation');
    Route::get('/general-setting', 'BusinessSettingsController@general_setting')->name('general_setting.index');
    Route::get('/activation', 'BusinessSettingsController@activation')->name('activation.index');
    Route::get('/payment-method', 'BusinessSettingsController@payment_method')->name('payment_method.index');
    Route::get('/file_system', 'BusinessSettingsController@file_system')->name('file_system.index');
    Route::get('/social-login', 'BusinessSettingsController@social_login')->name('social_login.index');
    Route::get('/smtp-settings', 'BusinessSettingsController@smtp_settings')->name('smtp_settings.index');
    Route::get('/google-analytics', 'BusinessSettingsController@google_analytics')->name('google_analytics.index');
    Route::get('/google-recaptcha', 'BusinessSettingsController@google_recaptcha')->name('google_recaptcha.index');
    Route::get('/google-map', 'BusinessSettingsController@google_map')->name('google-map.index');
    Route::get('/google-firebase', 'BusinessSettingsController@google_firebase')->name('google-firebase.index');

    //Facebook Settings
    Route::get('/facebook-chat', 'BusinessSettingsController@facebook_chat')->name('facebook_chat.index');
    Route::post('/facebook_chat', 'BusinessSettingsController@facebook_chat_update')->name('facebook_chat.update');
    Route::get('/facebook-comment', 'BusinessSettingsController@facebook_comment')->name('facebook-comment');
    Route::post('/facebook-comment', 'BusinessSettingsController@facebook_comment_update')->name('facebook-comment.update');
    Route::post('/facebook_pixel', 'BusinessSettingsController@facebook_pixel_update')->name('facebook_pixel.update');

    Route::post('/env_key_update', 'BusinessSettingsController@env_key_update')->name('env_key_update.update');
    Route::post('/payment_method_update', 'BusinessSettingsController@payment_method_update')->name('payment_method.update');
    Route::post('/google_analytics', 'BusinessSettingsController@google_analytics_update')->name('google_analytics.update');
    Route::post('/google_recaptcha', 'BusinessSettingsController@google_recaptcha_update')->name('google_recaptcha.update');
    Route::post('/google-map', 'BusinessSettingsController@google_map_update')->name('google-map.update');
    Route::post('/google-firebase', 'BusinessSettingsController@google_firebase_update')->name('google-firebase.update');
    //Currency
    Route::get('/currency', 'CurrencyController@currency')->name('currency.index');
    Route::post('/currency/update', 'CurrencyController@updateCurrency')->name('currency.update');
    Route::post('/your-currency/update', 'CurrencyController@updateYourCurrency')->name('your_currency.update');
    Route::get('/currency/create', 'CurrencyController@create')->name('currency.create');
    Route::post('/currency/store', 'CurrencyController@store')->name('currency.store');
    Route::post('/currency/currency_edit', 'CurrencyController@edit')->name('currency.edit');
    Route::post('/currency/update_status', 'CurrencyController@update_status')->name('currency.update_status');

    //Tax
    Route::resource('tax', 'TaxController');
    Route::get('/tax/edit/{id}', 'TaxController@edit')->name('tax.edit');
    Route::get('/tax/destroy/{id}', 'TaxController@destroy')->name('tax.destroy');
    Route::post('tax-status', 'TaxController@change_tax_status')->name('taxes.tax-status');


    Route::get('/verification/form', 'BusinessSettingsController@seller_verification_form')->name('seller_verification_form.index');
    Route::post('/verification/form', 'BusinessSettingsController@seller_verification_form_update')->name('seller_verification_form.update');
    Route::get('/vendor_commission', 'BusinessSettingsController@vendor_commission')->name('business_settings.vendor_commission');
    Route::post('/vendor_commission_update', 'BusinessSettingsController@vendor_commission_update')->name('business_settings.vendor_commission.update');

    Route::resource('/languages', 'LanguageController');
    Route::post('/languages/{id}/update', 'LanguageController@update')->name('languages.update');
    Route::get('/languages/destroy/{id}', 'LanguageController@destroy')->name('languages.destroy');
    Route::post('/languages/update_rtl_status', 'LanguageController@update_rtl_status')->name('languages.update_rtl_status');
    Route::post('/languages/key_value_store', 'LanguageController@key_value_store')->name('languages.key_value_store');

    //App Trasnlation
    Route::post('/languages/app-translations/import', 'LanguageController@importEnglishFile')->name('app-translations.import');
    Route::get('/languages/app-translations/show/{id}', 'LanguageController@showAppTranlsationView')->name('app-translations.show');
    Route::post('/languages/app-translations/key_value_store', 'LanguageController@storeAppTranlsation')->name('app-translations.store');
    Route::get('/languages/app-translations/export/{id}', 'LanguageController@exportARBFile')->name('app-translations.export');

    Route::get('contact/list', 'HomeController@contact_list')->name('contact_list');
    Route::post('contact/show/', 'HomeController@contact_show')->name('contact_show');

    // website setting
    Route::group(['prefix' => 'website'], function() {

        Route::group(['prefix' => 'menus'], function() {
        //menu Routes
            Route::post('updateMenus','MenuController2@updateMenus')->name('updateMenus');
            Route::get('manage-menus/{id?}','MenuController2@index')->name('manage.menus');
            Route::post('menu-store','MenuController@store')->name('menu.store');
            Route::get('menu-destroy/{id?}','MenuController@destroy')->name('menu.destroy');
            Route::post('menu-edit','MenuController@edit')->name('menu.edit');
            Route::post('menu-update','MenuController@update')->name('menu.update');
            Route::post('menu-change-lang','MenuController@chnagelang')->name('menu.changge.lang');
        });

        Route::get('/footer', 'WebsiteController@footer')->name('website.footer');
        Route::get('/header', 'WebsiteController@header')->name('website.header');
        Route::get('/appearance', 'WebsiteController@appearance')->name('website.appearance');
        Route::get('/pages', 'WebsiteController@pages')->name('website.pages');
        Route::resource('custom-pages', 'PageController');
        Route::get('/custom-pages/edit/{id}', 'PageController@edit')->name('custom-pages.edit');
        Route::get('/custom-pages/destroy/{id}', 'PageController@destroy')->name('custom-pages.destroy');

    });

    Route::resource('roles', 'RoleController');
    Route::get('/roles/edit/{id}', 'RoleController@edit')->name('roles.edit');
    Route::get('/roles/destroy/{id}', 'RoleController@destroy')->name('roles.destroy');

    Route::resource('staffs', 'StaffController');
    Route::get('/staffs/destroy/{id}', 'StaffController@destroy')->name('staffs.destroy');

    Route::resource('flash_deals', 'FlashDealController');
    Route::get('/flash_deals/edit/{id}', 'FlashDealController@edit')->name('flash_deals.edit');
    Route::get('flash_deal/product/serach', 'FlashDealController@search')->name('flash_deal.search');
    Route::get('/flash_deals/destroy/{id}', 'FlashDealController@destroy')->name('flash_deals.destroy');
    Route::post('/flash_deals/update_status', 'FlashDealController@update_status')->name('flash_deals.update_status');
    Route::post('/flash_deals/update_featured', 'FlashDealController@update_featured')->name('flash_deals.update_featured');
    Route::post('/flash_deals/product_discount', 'FlashDealController@product_discount')->name('flash_deals.product_discount');
    Route::post('/flash_deals/product_discount_edit', 'FlashDealController@product_discount_edit')->name('flash_deals.product_discount_edit');
    

    //Subscribers
    Route::get('/subscribers', 'SubscriberController@index')->name('subscribers.index');
    Route::get('/subscribers/destroy/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');

    // Route::get('/orders', 'OrderController@admin_orders')->name('orders.index.admin');
    // Route::get('/orders/{id}/show', 'OrderController@show')->name('orders.show');
    // Route::get('/sales/{id}/show', 'OrderController@sales_show')->name('sales.show');
    // Route::get('/sales', 'OrderController@sales')->name('sales.index');
    // All Orders
    // Route::get('/all_orders', 'OrderController@all_orders')->name('all_orders.index');
    
    Route::get('/all_orders/{id}/show', 'OrderController@all_orders_show')->name('all_orders.show');

    // Inhouse Orders
    Route::get('/inhouse-orders', 'OrderController@admin_orders')->name('inhouse_orders.index');
    Route::get('/inhouse-orders/{id}/show', 'OrderController@show')->name('inhouse_orders.show');

    // Seller Orders
    Route::get('/seller_orders', 'OrderController@seller_orders')->name('seller_orders.index');
    Route::get('/seller_orders/{id}/show', 'OrderController@seller_orders_show')->name('seller_orders.show');

    Route::post('/bulk-order-status', 'OrderController@bulk_order_status')->name('bulk-order-status');


    // Pickup point orders
    Route::get('orders_by_pickup_point', 'OrderController@pickup_point_order_index')->name('pick_up_point.order_index');
    Route::get('/orders_by_pickup_point/{id}/show', 'OrderController@pickup_point_order_sales_show')->name('pick_up_point.order_show');

    Route::get('/orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');
    Route::post('/bulk-order-delete', 'OrderController@bulk_order_delete')->name('bulk-order-delete');

    Route::post('/pay_to_seller', 'CommissionController@pay_to_seller')->name('commissions.pay_to_seller');

    //Reports
    Route::get('/stock_report', 'ReportController@stock_report')->name('stock_report.index');
    Route::get('/in_house_sale_report', 'ReportController@in_house_sale_report')->name('in_house_sale_report.index');
    Route::get('/seller_sale_report', 'ReportController@seller_sale_report')->name('seller_sale_report.index');
    Route::get('/wish_report', 'ReportController@wish_report')->name('wish_report.index');
    Route::get('/user_search_report', 'ReportController@user_search_report')->name('user_search_report.index');
    Route::get('/wallet-history', 'ReportController@wallet_transaction_history')->name('wallet-history.index');

    //Blog Section
    Route::resource('blog-category', 'BlogCategoryController');
    Route::get('/blog-category/destroy/{id}', 'BlogCategoryController@destroy')->name('blog-category.destroy');
    Route::resource('blog', 'BlogController');
    Route::get('/blog/destroy/{id}', 'BlogController@destroy')->name('blog.destroy');
    Route::post('/blog/change-status', 'BlogController@change_status')->name('blog.change-status');

    //Coupons
    Route::resource('coupon', 'CouponController');
    Route::get('/coupon/destroy/{id}', 'CouponController@destroy')->name('coupon.destroy');

    //Reviews
    Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
    Route::post('/reviews/published', 'ReviewController@updatePublished')->name('reviews.published');

    //Support_Ticket
    Route::get('support_ticket/', 'SupportTicketController@admin_index')->name('support_ticket.admin_index');
    Route::get('support_ticket/{id}/show', 'SupportTicketController@admin_show')->name('support_ticket.admin_show');
    Route::post('support_ticket/reply', 'SupportTicketController@admin_store')->name('support_ticket.admin_store');

    //Pickup_Points
    Route::resource('pick_up_points', 'PickupPointController');
    Route::get('/pick_up_points/edit/{id}', 'PickupPointController@edit')->name('pick_up_points.edit');
    Route::get('/pick_up_points/destroy/{id}', 'PickupPointController@destroy')->name('pick_up_points.destroy');

    //conversation of seller customer
    Route::get('conversations', 'ConversationController@admin_index')->name('conversations.admin_index');
    Route::get('conversations/{id}/show', 'ConversationController@admin_show')->name('conversations.admin_show');

    Route::post('/sellers/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
    Route::post('/sellers/approved', 'SellerController@updateApproved')->name('sellers.approved');

    Route::resource('attributes', 'AttributeController');
    Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attributes.edit');
    Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attributes.destroy');

    //Attribute Value
    Route::post('/store-attribute-value', 'AttributeController@store_attribute_value')->name('store-attribute-value');
    Route::get('/edit-attribute-value/{id}', 'AttributeController@edit_attribute_value')->name('edit-attribute-value');
    Route::post('/update-attribute-value/{id}', 'AttributeController@update_attribute_value')->name('update-attribute-value');
    Route::get('/destroy-attribute-value/{id}', 'AttributeController@destroy_attribute_value')->name('destroy-attribute-value');

    //Colors
    Route::get('/colors', 'AttributeController@colors')->name('colors');
    Route::post('/colors/store', 'AttributeController@store_color')->name('colors.store');
    Route::get('/colors/edit/{id}', 'AttributeController@edit_color')->name('colors.edit');
    Route::post('/colors/update/{id}', 'AttributeController@update_color')->name('colors.update');
    Route::get('/colors/destroy/{id}', 'AttributeController@destroy_color')->name('colors.destroy');

    Route::resource('addons', 'AddonController');
    Route::post('/addons/activation', 'AddonController@activation')->name('addons.activation');

    Route::get('/customer-bulk-upload/index', 'CustomerBulkUploadController@index')->name('customer_bulk_upload.index');
    Route::post('/bulk-user-upload', 'CustomerBulkUploadController@user_bulk_upload')->name('bulk_user_upload');
    Route::post('/bulk-customer-upload', 'CustomerBulkUploadController@customer_bulk_file')->name('bulk_customer_upload');
    Route::get('/user', 'CustomerBulkUploadController@pdf_download_user')->name('pdf.download_user');
    //Customer Package

    Route::resource('customer_packages', 'CustomerPackageController');
    Route::get('/customer_packages/edit/{id}', 'CustomerPackageController@edit')->name('customer_packages.edit');
    Route::get('/customer_packages/destroy/{id}', 'CustomerPackageController@destroy')->name('customer_packages.destroy');

    //Classified Products
    Route::get('/classified_products', 'CustomerProductController@customer_product_index')->name('classified_products');
    Route::post('/classified_products/published', 'CustomerProductController@updatePublished')->name('classified_products.published');

    //Shipping Configuration
    Route::get('/shipping_configuration', 'BusinessSettingsController@shipping_configuration')->name('shipping_configuration.index');
    Route::post('/shipping_configuration/update', 'BusinessSettingsController@shipping_configuration_update')->name('shipping_configuration.update');

    // Route::resource('pages', 'PageController');
    // Route::get('/pages/destroy/{id}', 'PageController@destroy')->name('pages.destroy');

    Route::resource('countries', 'CountryController');
    Route::post('/countries/status', 'CountryController@updateStatus')->name('countries.status');

    Route::resource('states','StateController');
	Route::post('/states/status', 'StateController@updateStatus')->name('states.status');

    Route::resource('cities', 'CityController');
    Route::get('/cities/edit/{id}', 'CityController@edit')->name('cities.edit');
    Route::get('/cities/destroy/{id}', 'CityController@destroy')->name('cities.destroy');
    Route::post('/cities/status', 'CityController@updateStatus')->name('cities.status');

    Route::view('/system/update', 'backend.system.update')->name('system_update');
    Route::view('/system/server-status', 'backend.system.server_status')->name('system_server');

    // uploaded files
    Route::any('/uploaded-files/file-info', 'AizUploadController@file_info')->name('uploaded-files.info');
    Route::resource('/uploaded-files', 'AizUploadController');
    Route::get('/uploaded-files/destroy/{id}', 'AizUploadController@destroy')->name('uploaded-files.destroy');

    Route::get('/all-notification', 'NotificationController@index')->name('admin.all-notification');

    Route::get('/cache-cache', 'AdminController@clearCache')->name('cache.clear');

    // themes
    Route::resource('themes', 'ThemeController');
    Route::post('/themes/activation', 'themecontroller@activation')->name('themes.activation');

    //admin menu
    Route::get('/admin-menus', 'AdminMenuController@index')->name('admin_menu.index');
    Route::get('/admin-menus/create', 'AdminMenuController@create')->name('admin_menu.create');
    Route::post('/admin-menus/store', 'AdminMenuController@store')->name('admin_menu.store');
    Route::get('/admin-menus/edit/{id}', 'AdminMenuController@edit')->name('admin_menu.edit');
    Route::patch('/admin-menus/update/{id}', 'AdminMenuController@update')->name('admin_menu.update');
    Route::get('/admin-menus/destroy/{id}', 'AdminMenuController@destroy')->name('admin_menu.destroy');
    Route::post('/admin-menus/update-status', 'AdminMenuController@updateStatus')->name('admin_menu.update_status');
   
    //permission
    Route::get('/permissions', 'PermissionController@index')->name('permission.index');
    Route::get('/permissions/create', 'PermissionController@create')->name('permission.create');
    Route::post('/permissions/store', 'PermissionController@store')->name('permission.store');
    Route::get('/permissions/edit/{id}', 'PermissionController@edit')->name('permission.edit');
    Route::patch('/permissions/update/{id}', 'PermissionController@update')->name('permission.update');
    Route::get('/permissions/destroy/{id}', 'PermissionController@destroy')->name('permission.destroy');
    Route::post('/permissions/update-status', 'PermissionController@updateStatus')->name('permission.update_status');

    Route::get('/activity/log', 'ActivityController@index')->name('activity.log');
    Route::post('/activity/show', 'ActivityController@show')->name('activity.show');


});
