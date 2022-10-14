<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\FlashDealProduct;
use App\Models\ProductTax;
use App\Models\AttributeValue;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\PropertyAmenity;
use App\Models\PropertyBath;
use App\Models\PropertyBed;
use App\Models\PropertyCondition;
use App\Models\PropertyFurnishType;
use App\Models\PropertyPurpose;
use App\Models\PropertyTourType;
use App\Models\PropertyType;
use App\Models\PropertyCountry;
use App\Models\PropertyState;
use App\Models\PropertyCity;
use App\Models\PropertyArea;
use App\Models\PropertyNestedArea;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Combinations;
use CoreComponentRepository;
use Illuminate\Support\Str;
use Artisan;
use Cache;
use App\Models\PropertyUnit;
use App\Models\Shop;

class ProductController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function admin_products(Request $request)
    // {

       
    //     //CoreComponentRepository::instantiateShopRepository();

    //     $type = 'In House';
    //     $col_name = null;
    //     $query = null;
    //     $sort_search = null;

    //     $products = Product::where('added_by', 'admin')->where('auction_product',0);

    //     if ($request->type != null){
    //         $var = explode(",", $request->type);
    //         $col_name = $var[0];
    //         $query = $var[1];
    //         $products = $products->orderBy($col_name, $query);
    //         $sort_type = $request->type;
    //     }
    //     if ($request->search != null){
    //         $products = $products
    //                     ->where('name', 'like', '%'.$request->search.'%');
    //         $sort_search = $request->search;
    //     }

    //     $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);

    //     return view('backend.product.products.index', compact('products','type', 'col_name', 'query', 'sort_search'));
    // }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function seller_products(Request $request)
    // {
    //     $col_name = null;
    //     $query = null;
    //     $seller_id = null;
    //     $sort_search = null;
    //     $products = Product::where('added_by', 'seller')->where('auction_product',0);
    //     if ($request->has('user_id') && $request->user_id != null) {
    //         $products = $products->where('user_id', $request->user_id);
    //         $seller_id = $request->user_id;
    //     }
    //     if ($request->search != null){
    //         $products = $products
    //                     ->where('name', 'like', '%'.$request->search.'%');
    //         $sort_search = $request->search;
    //     }
    //     if ($request->type != null){
    //         $var = explode(",", $request->type);
    //         $col_name = $var[0];
    //         $query = $var[1];
    //         $products = $products->orderBy($col_name, $query);
    //         $sort_type = $request->type;
    //     }

    //     $products = $products->where('digital', 0)->orderBy('created_at', 'desc')->paginate(15);
    //     $type = 'Seller';

    //     return view('backend.product.products.index', compact('products','type', 'col_name', 'query', 'seller_id', 'sort_search'));
    // }




    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //CoreComponentRepository::initializeCache();

    //     $categories = Category::where('parent_id', 0)
    //         ->where('digital', 0)
    //         ->with('childrenCategories')
    //         ->get();

    //     return view('backend.product.products.create', compact('categories'));
    // }

    // public function add_more_choice_option(Request $request) {
    //     $all_attribute_values = AttributeValue::with('attribute')->where('attribute_id', $request->attribute_id)->get();

    //     $html = '';

    //     foreach ($all_attribute_values as $row) {
    //         $html .= '<option value="' . $row->value . '">' . $row->value . '</option>';
    //     }

    //     echo json_encode($html);
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $product = new Product;
    //     $product->name = $request->name;
    //     $product->added_by = $request->added_by;
    //     if(Auth::user()->user_type == 'seller'){
    //         $product->user_id = Auth::user()->id;
    //         if(get_setting('product_approve_by_admin') == 1) {
    //             $product->approved = 0;
    //         }
    //     }
    //     else{
    //         $product->user_id = User::where('user_type', 'admin')->first()->id;
    //     }
    //     $product->category_id = $request->category_id;
    //     $product->brand_id = $request->brand_id;
    //     $product->barcode = $request->barcode;

    //     if (addon_is_activated('refund_request')) {
    //         if ($request->refundable != null) {
    //             $product->refundable = 1;
    //         }
    //         else {
    //             $product->refundable = 0;
    //         }
    //     }
    //     $product->photos = $request->photos;
    //     $product->thumbnail_img = $request->thumbnail_img;
    //     $product->unit = $request->unit;
    //     $product->min_qty = $request->min_qty;
    //     $product->low_stock_quantity = $request->low_stock_quantity;
    //     $product->stock_visibility_state = $request->stock_visibility_state;
    //     $product->external_link = $request->external_link;
    //     $product->external_link_btn = $request->external_link_btn;


    //     if($request->has('weight') && !empty($request->weight)){
    //         $product->weight =$request->weight;
    //     }
    //     else {
    //         $weight = 0;
    //         $product->weight = $weight;
    //     }

	// 	if($request->has('length') && !empty($request->length)){
    //         $product->length =$request->length;
    //     }
    //     else {
    //         $length = 0;
    //         $product->length = $length;
    //     }

	// 	if($request->has('width') && !empty($request->width)){
    //         $product->width =$request->width;
    //     }
    //     else {
    //         $width = 0;
    //         $product->width = $width;
    //     }


	// 	if($request->has('height') && !empty($request->height)){
    //         $product->height =$request->height;
    //     }
    //     else {
    //         $height = 0;
    //         $product->height = $height;
    //     }


    //     $tags = array();
    //     if($request->tags[0] != null){
    //         foreach (json_decode($request->tags[0]) as $key => $tag) {
    //             array_push($tags, $tag->value);
    //         }
    //     }
    //     $product->tags = implode(',', $tags);

    //     $product->description = $request->description;
    //     $product->video_provider = $request->video_provider;
    //     $product->video_link = $request->video_link;
    //     $product->unit_price = $request->unit_price;
    //     $product->discount = $request->discount;
    //     $product->discount_type = $request->discount_type;

    //     if ($request->date_range != null) {
    //         $date_var               = explode(" to ", $request->date_range);
    //         $product->discount_start_date = strtotime($date_var[0]);
    //         $product->discount_end_date   = strtotime( $date_var[1]);
    //     }

    //     $product->shipping_type = $request->shipping_type;
    //     $product->est_shipping_days  = $request->est_shipping_days;

    //     if (addon_is_activated('club_point')) {
    //         if($request->earn_point) {
    //             $product->earn_point = $request->earn_point;
    //         }
    //     }

    //     if ($request->has('shipping_type')) {
    //         if($request->shipping_type == 'free'){
    //             $product->shipping_cost = 0;
    //         }
    //         elseif ($request->shipping_type == 'flat_rate') {
    //             $product->shipping_cost = $request->flat_shipping_cost;
    //         }
    //         elseif ($request->shipping_type == 'product_wise') {
    //             $product->shipping_cost = json_encode($request->shipping_cost);
    //         }
    //     }
    //     if ($request->has('is_quantity_multiplied')) {
    //         $product->is_quantity_multiplied = 1;
    //     }

    //     $product->meta_title = $request->meta_title;
    //     $product->meta_description = $request->meta_description;

    //     if($request->has('meta_img')){
    //         $product->meta_img = $request->meta_img;
    //     } else {
    //         $product->meta_img = $product->thumbnail_img;
    //     }

    //     if($product->meta_title == null) {
    //         $product->meta_title = $product->name;
    //     }

    //     if($product->meta_description == null) {
    //         $product->meta_description = strip_tags($product->description);
    //     }

    //     if($product->meta_img == null) {
    //         $product->meta_img = $product->thumbnail_img;
    //     }

    //     if($request->hasFile('pdf')){
    //         $product->pdf = $request->pdf->store('uploads/products/pdf');
    //     }

    //     $product->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', strtolower($request->name)));

    //     if(Product::where('slug', $product->slug)->count() > 0){
    //         flash(translate('Another product exists with same slug. Please change the slug!'))->warning();
    //         return back();
    //     }

    //     if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
    //         $product->colors = json_encode($request->colors);
    //     }
    //     else {
    //         $colors = array();
    //         $product->colors = json_encode($colors);
    //     }

    //     $choice_options = array();

    //     if($request->has('choice_no')){
    //         foreach ($request->choice_no as $key => $no) {
    //             $str = 'choice_options_'.$no;

    //             $item['attribute_id'] = $no;

    //             $data = array();
    //             // foreach (json_decode($request[$str][0]) as $key => $eachValue) {
    //             foreach ($request[$str] as $key => $eachValue) {
    //                 // array_push($data, $eachValue->value);
    //                 array_push($data, $eachValue);
    //             }

    //             $item['values'] = $data;
    //             array_push($choice_options, $item);
    //         }
    //     }

    //     if (!empty($request->choice_no)) {
    //         $product->attributes = json_encode($request->choice_no);
    //     }
    //     else {
    //         $product->attributes = json_encode(array());
    //     }

    //     $product->choice_options = json_encode($choice_options, JSON_UNESCAPED_UNICODE);

    //     $product->published = 1;
    //     if($request->button == 'unpublish' || $request->button == 'draft') {
    //         $product->published = 0;
    //     }

    //     if ($request->has('cash_on_delivery')) {
    //         $product->cash_on_delivery = 1;
    //     }
    //     if ($request->has('featured')) {
    //         $product->featured = 1;
    //     }
    //     if ($request->has('todays_deal')) {
    //         $product->todays_deal = 1;
    //     }
    //     $product->cash_on_delivery = 0;
    //     if ($request->cash_on_delivery) {
    //         $product->cash_on_delivery = 1;
    //     }
    //     //$variations = array();

    //     $product->save();

    //     //VAT & Tax
    //     if($request->tax_id) {
    //         foreach ($request->tax_id as $key => $val) {
    //             $product_tax = new ProductTax;
    //             $product_tax->tax_id = $val;
    //             $product_tax->product_id = $product->id;
    //             $product_tax->tax = $request->tax[$key];
    //             $product_tax->tax_type = $request->tax_type[$key];
    //             $product_tax->save();
    //         }
    //     }
    //     //Flash Deal
    //     if($request->flash_deal_id) {
    //         $flash_deal_product = new FlashDealProduct;
    //         $flash_deal_product->flash_deal_id = $request->flash_deal_id;
    //         $flash_deal_product->product_id = $product->id;
    //         $flash_deal_product->save();
    //     }

    //     //combinations start
    //     $options = array();
    //     if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
    //         $colors_active = 1;
    //         array_push($options, $request->colors);
    //     }

    //     if($request->has('choice_no')){
    //         foreach ($request->choice_no as $key => $no) {
    //             $name = 'choice_options_'.$no;
    //             $data = array();
    //             foreach ($request[$name] as $key => $eachValue) {
    //                 array_push($data, $eachValue);
    //             }
    //             array_push($options, $data);
    //         }
    //     }

    //     //Generates the combinations of customer choice options
    //     $combinations = Combinations::makeCombinations($options);
    //     if(count($combinations[0]) > 0){
    //         $product->variant_product = 1;
    //         foreach ($combinations as $key => $combination){
    //             $str = '';
    //             foreach ($combination as $key => $item){
    //                 if($key > 0 ){
    //                     $str .= '-'.str_replace(' ', '', $item);
    //                 }
    //                 else{
    //                     if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
    //                         $color_name = Color::where('code', $item)->first()->name;
    //                         $str .= $color_name;
    //                     }
    //                     else{
    //                         $str .= str_replace(' ', '', $item);
    //                     }
    //                 }
    //             }
    //             $product_stock = ProductStock::where('product_id', $product->id)->where('variant', $str)->first();
    //             if($product_stock == null){
    //                 $product_stock = new ProductStock;
    //                 $product_stock->product_id = $product->id;
    //             }

    //             $product_stock->variant = $str;
    //             $product_stock->price = $request['price_'.str_replace('.', '_', $str)];
    //             $product_stock->sku = $request['sku_'.str_replace('.', '_', $str)];
    //             $product_stock->qty = $request['qty_'.str_replace('.', '_', $str)];
    //             $product_stock->image = $request['img_'.str_replace('.', '_', $str)];
    //             $product_stock->save();
    //         }
    //     }
    //     else{
    //         $product_stock              = new ProductStock;
    //         $product_stock->product_id  = $product->id;
    //         $product_stock->variant     = '';
    //         $product_stock->price       = $request->unit_price;
    //         $product_stock->sku         = $request->sku;
    //         $product_stock->qty         = $request->current_stock;
    //         $product_stock->save();
    //     }
    //     //combinations end

    //     if (addon_is_activated('warehouse')) {
    //         $product->warehouse_id  = $product->warehouse_id;
    //     }

	//     $product->save();

    //     // Product Translations
    //     $product_translation = ProductTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'product_id' => $product->id]);
    //     $product_translation->name = $request->name;
    //     $product_translation->unit = $request->unit;
    //     $product_translation->description = $request->description;
    //     $product_translation->save();

    //     flash(translate('Product has been inserted successfully'))->success();

    //     Artisan::call('view:clear');
    //     Artisan::call('cache:clear');

    //     if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
    //         return redirect()->route('products.admin');
    //     }
    //     else{
    //         if(addon_is_activated('seller_subscription')){
    //             $seller = Auth::user()->seller;
    //             $seller->remaining_uploads -= 1;
    //             $seller->save();
    //         }
    //         return redirect()->route('seller.products');
    //     }
    // }



    public function all_products(Request $request)
    {
        if($request->ajax()){

            $products = Product::orderBy('created_at', 'desc')->with('purpose','purpose_child', 'type');
            if ($request->has('agent') && $request->agent != '') {
                $products = $products->where('user_id', $request->agent);
            }

        
            if($request->has('search') && $request->search != ''){
                $products = $products->where('name', 'like', '%'.$request->search.'%');
            }

            if($request->has('length') &&  $request->length != ''){
                $products = $products->paginate($request->length);   
            }else{
                $products = $products->paginate(15);  
            }
            
            return response()->json($products,200);
        }



        $col_name = null;
        $query = null;
        $seller_id = null;
        $sort_search = null;

        $products = Product::orderBy('created_at', 'desc')->with('purpose','purpose_child', 'type');
        
        if ($request->has('agent') && $request->agent != '') {
            $products = $products->where('user_id', $request->agent);
        }

        if ($request->has('purpose') && $request->purpose != '') {
            $products = $products->where('purpose_id', $request->purpose);
        }

        if ($request->has('type') && $request->type != '') {
            $products = $products->where('type_id', $request->type);
        }
      
        if ($request->search != null){
            $products = $products->where('name', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }
      
        // if ($request->type != null){
        //     $var = explode(",", $request->type);
        //     $col_name = $var[0];
        //     $query = $var[1];
        //     $products = $products->orderBy($col_name, $query);
        //     $sort_type = $request->type;
        // }

        $sellers = User::where('user_type','seller')->get();
        $types = PropertyType::all();
        $purposes = PropertyPurpose::all();

        return view('backend.product.products.index', compact('sellers','types','purposes'));
    }

    

    /**
     * Show the form for editing the specified resource.
     */
     public function admin_product_edit(Request $request, $id)
     {   

    
        if($id == 0){
            $product = null;
        }else{
            $product = Product::findOrFail($id);
        }
      
        $units = PropertyUnit::all();
        $beds = PropertyBed::all();
        $baths = PropertyBath::all();
        $users = User::where('user_type', '=' ,'seller')->get();
        $lang = $request->lang;
        $tags = $product ? json_decode($product->tags) : null;
        $types = PropertyType::where('parent_id', 0)->with('children')->get();
        $purposes = PropertyPurpose::where('parent_id', 0)->with('children')->get();
        $tours = PropertyTourType::all();
      
        $countries = PropertyCountry::all();
        $states = $product ? PropertyState::where('country_id',$product->country_id)->get() : [];
        $cities =  $product ? PropertyCity::where('state_id',$product->state_id)->get() : [];
        $areas =  $product ? PropertyArea::where('city_id',$product->city_id)->get() : [];
        $nested_areas =  $product ? PropertyNestedArea::where('parent',$product->area_id)->get() : [];

      
        $conditions = PropertyCondition::all();
        $furnish_types = PropertyFurnishType::all();
        $amenities = PropertyAmenity::all();
    
        return view('backend.product.products.edit', compact('beds','baths', 'users', 'purposes','product',  'tags','lang','units','types','tours','conditions','furnish_types','amenities', 'countries', 'states', 'cities', 'areas', 'nested_areas'));
     }


    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function seller_product_edit(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);
    //     if($product->digital == 1) {
    //         return redirect('digitalproducts/' . $id . '/edit');
    //     }
    //     $lang = $request->lang;
    //     $tags = json_decode($product->tags);
    //     $categories = Category::all();
    //     return view('backend.product.products.edit', compact('product', 'categories', 'tags','lang'));
    // }


    /**
     * Update the specified resource in storage.
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == 0){
            $product = new Product();
        }else{
            $product = Product::findOrFail($id);
        }

        $tags = array();
        if($request->tags[0] != null){
            foreach (json_decode($request->tags[0]) as $key => $tag) {
                array_push($tags, $tag->value);
            }
        }

        $amenities = array();
        if($request->has('amenities')){
            foreach($request->amenities as $amenity) {
                array_push($amenities, $amenity);
            }
        }
       
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;

        $product->featured = $request->featured;
        $product->approved = $request->approved;
        $product->published = $request->published;

        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_img = $request->meta_img;
        
        $product->video_provider = $request->video_provider;
        $product->video_link = $request->video_link;

        $product->photos = $request->photos;
        $product->thumbnail_img = $request->thumbnail_img;

        $product->user_id = $request->user_id;
        $product->ref = $request->ref;

        $product->unit_price = $request->unit_price;
        
        $product->type_id = $request->type_id;
        $product->purpose_child_id = $request->purpose_id;
        
        $product->bed_id = $request->bed_id;
        $product->bath_id = $request->bath_id;
        
        $product->longitude = $request->longitude;
        $product->latitude = $request->latitude;
        $product->country_id = $request->country_id;
        $product->state_id = $request->state_id;
        $product->city_id = $request->city_id;
        $product->area_id = $request->area_id;
        $product->nested_area_id = $request->nested;
        
        $product->tour_type_id = $request->tour_type_id;

        $product->furnish_type_id = $request->furnish_type_id;
        $product->unit_id = $request->unit_id;
        $product->search_sqft = $request->search_sqft;

        $product->tags = implode(',', $tags);
        $product->conditions = $request->conditions;
        $product->amenities = implode(',', $amenities);
        $product->external_link =  $request->external_link;
        $product->external_link_btn = $request->external_link_btn;
        
        $product->save();

       

          flash(translate('Product has been updated successfully'))->success();
        
          return redirect()->route('products.admin.edit',['id' => $product->id, 'lang' => env('DEFAULT_LANGUAGE')]);  

        // return back(); 
    }


    /*
     * Duplicates the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Request $request, $id)
    {
        $product = Product::find($id);

        if(Auth::user()->id == $product->user_id || Auth::user()->user_type == 'staff'){
            $product_new = $product->replicate();
            $product_new->slug = $product_new->slug.'-'.Str::random(5);
            $product_new->save();

            foreach ($product->stocks as $key => $stock) {
                $product_stock              = new ProductStock;
                $product_stock->product_id  = $product_new->id;
                $product_stock->variant     = $stock->variant;
                $product_stock->price       = $stock->price;
                $product_stock->sku         = $stock->sku;
                $product_stock->qty         = $stock->qty;
                $product_stock->save();

            }

            flash(translate('Product has been duplicated successfully'))->success();
            if(Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff'){
              if($request->type == 'In House')
                return redirect()->route('products.admin');
              elseif($request->type == 'Seller')
                return redirect()->route('products.seller');
              elseif($request->type == 'All')
                return redirect()->route('products.all');
            }
            else{
                if (addon_is_activated('seller_subscription')) {
                    $seller = Auth::user()->seller;
                    $seller->remaining_uploads -= 1;
                    $seller->save();
                }
                return redirect()->route('seller.products');
            }
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }



    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->product_translations as $key => $product_translations) {
            $product_translations->delete();
        }

        foreach ($product->stocks as $key => $stock) {
            $stock->delete();
        }

        if(Product::destroy($id)){
            Cart::where('product_id', $id)->delete();

            flash(translate('Product has been deleted successfully'))->success();

            Artisan::call('view:clear');
            Artisan::call('cache:clear');

            return back();
        }
        else{
            flash(translate('Something went wrong'))->error();
            return back();
        }
    }


    public function bulk_product_delete(Request $request) {
        if($request->id) {
            foreach ($request->id as $product_id) {
                $this->destroy($product_id);
            }
        }
        return 1;
    }


     /*
     * Remove the specified resource from storage.
     */
    public function bulk(Request $request)
    {
        if($request->has('idz') && $request->has('action') && $request->has('value')){

            $idz = explode(',',$request->idz);    
            switch ($request->action) {
               
                case 'delete':
                    // Product::whereIn('id',$idz)->delete();
                    // ProductTranslation::whereIn('product_id',$idz)->delete();
                    return response()->json(['message' => translate('Records Deleted')],200);
                    break;

                case 'published':
                    $pp = Product::whereIn('id',$idz)->get();
                    foreach ($pp as $item) {
                        $item->published = $request->value;
                        $item->save();
                    }
                    return response()->json(['message' => translate('Updated')],200);
                    break;
                

                case 'featured':
                        $idz = explode(',',$request->idz);    
                        $pp = Product::whereIn('id',$idz)->get();
                        foreach ($pp as $item) {
                            $item->featured = $request->value;
                            $item->save();
                        }
                        return response()->json(['message' => translate('Updated')],200);
                        break;    


                case 'approved':
                    $pp = Product::whereIn('id',$idz)->get();
                    foreach ($pp as $item) {
                        $item->approved = $request->value;
                        $item->save();
                    }
                    return response()->json(['message' => translate('Status Updated')],200);
                    break;            
                

                default:
                break;
            }
        }

        return response()->json(['message' => translate('Error Found')],400);
    }








    public function get_products_by_brand(Request $request)
    {
        $products = Product::where('brand_id', $request->brand_id)->get();
        return view('partials.product_select', compact('products'));
    }

    public function updateTodaysDeal(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->todays_deal = $request->status;
        $product->save();
        Cache::forget('todays_deal_products');
        return 1;
    }

    public function updatePublished(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->published = $request->status;

        if($product->added_by == 'seller' && addon_is_activated('seller_subscription')){
            $seller = $product->user->seller;
            if($seller->invalid_at != null && $seller->invalid_at != '0000-00-00' && Carbon::now()->diffInDays(Carbon::parse($seller->invalid_at), false) <= 0){
                return 0;
            }
        }

        $product->save();
        return 1;
    }

    public function updateProductApproval(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->approved = $request->approved;

        if($product->added_by == 'seller' && addon_is_activated('seller_subscription')){
            $seller = $product->user->seller;
            if($seller->invalid_at != null && Carbon::now()->diffInDays(Carbon::parse($seller->invalid_at), false) <= 0){
                return 0;
            }
        }

        $product->save();
        return 1;
    }

    public function updateFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->featured = $request->status;
        if($product->save()){
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            return 1;
        }
        return 0;
    }

    public function updateSellerFeatured(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->seller_featured = $request->status;
        if($product->save()){
            return 1;
        }
        return 0;
    }



    // public function sku_combination(Request $request)
    // {
    //     $options = array();
    //     if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
    //         $colors_active = 1;
    //         array_push($options, $request->colors);
    //     }
    //     else {
    //         $colors_active = 0;
    //     }

    //     $unit_price = $request->unit_price;
    //     $product_name = $request->name;

    //     if($request->has('choice_no')){
    //         foreach ($request->choice_no as $key => $no) {
    //             $name = 'choice_options_'.$no;
    //             $data = array();
    //             // foreach (json_decode($request[$name][0]) as $key => $item) {
    //             foreach ($request[$name] as $key => $item) {
    //                 // array_push($data, $item->value);
    //                 array_push($data, $item);
    //             }
    //             array_push($options, $data);
    //         }
    //     }

    //     $combinations = Combinations::makeCombinations($options);
    //     return view('backend.product.products.sku_combinations', compact('combinations', 'unit_price', 'colors_active', 'product_name'));
    // }

    // public function sku_combination_edit(Request $request)
    // {
    //     $product = Product::findOrFail($request->id);
    //     $options = array();
    //     if($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0){
    //         $colors_active = 1;
    //         array_push($options, $request->colors);
    //     }
    //     else {
    //         $colors_active = 0;
    //     }

    //     $product_name = $request->name;
    //     $unit_price = $request->unit_price;
    //     if($request->has('choice_no')){
    //         foreach ($request->choice_no as $key => $no) {
    //             $name = 'choice_options_'.$no;
    //             $data = array();
    //             // foreach (json_decode($request[$name][0]) as $key => $item) {
    //                 foreach ($request[$name] as $key => $item) {
    //                     // array_push($data, $item->value);
    //                     array_push($data, $item);
    //                 }
    //                 array_push($options, $data);
    //             }
    //     }

    //     $combinations = Combinations::makeCombinations($options);
    //     return view('backend.product.products.sku_combinations_edit', compact('combinations', 'unit_price', 'colors_active', 'product_name', 'product'));
    // }

}
