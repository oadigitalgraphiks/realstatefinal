<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyReport;
use App\Models\PropertyReportTranslation;
use Illuminate\Support\Str;

class PropertyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $property_reports = PropertyReport::orderBy('id', 'desc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $property_reports = $property_reports->where('name', 'like', '%'.$sort_search.'%');
        }

        $property_reports = $property_reports->with(['agent.shop', 'property'])->paginate(10);
        return view('backend.property.property_reports.index', compact('property_reports', 'sort_search'));
    }

   
    public function destroy($id)
    {
        $property_reports = PropertyReport::findOrFail($id);
        $property_reports->delete();

        flash(translate('Property report has been deleted successfully'))->success();
        return redirect()->route('property_reports.index');
    }


    public function edit(Request $request, $id){

        $lang = $request->lang;
        $data = PropertyReport::findOrFail($id);
        
        return view('backend.property.property_reports.edit', compact('lang', 'data'));
    }

    
}
