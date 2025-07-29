<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommanderProfileFormRequest;
use App\Http\Requests\DistrictFormRequest;
use App\Http\Requests\RankClassFormRequest;
use App\Http\Requests\RankFormRequest;
use App\Http\Requests\RegionFormRequest;
use App\Http\Requests\StationFormRequest;
use App\Models\Department;
use App\Models\District;
use App\Models\Rank;
use App\Models\RankClass;
use App\Models\RegBrief;
use App\Models\Region;
use App\Models\RegCommand;
use App\Models\Station;
use App\Models\Staff;
use App\Models\Unit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
 
      /*Get All districts base on selected region*/
    public function findRegionData(Request $request){
  
        $data=District::select('name','id')->where('region_id',$request->id)->get();
        return response()->json($data);//then sent this data to ajax success
	}
}
   
  
