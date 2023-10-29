<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Item;
use App\Helpers\Helper;
use Hash;
use PDF;

class ScanController extends Controller
{
    
    // form view 
    public function scaninventory()
    {

        if(Auth::check()){
            $items = Item::all()->whereIn('status', ['Available', 'Unresolved' , 'Lost']);
            return view('scaninventory',['items'=>$items]);
        }
  
        return redirect("login")->with('noaccess','Please login to access that page');

    }

    // form view 
    public function scanresult()
    {

        if(Auth::check()){
            $data = Item::sortable()->whereIn('status', ['Available', 'Unresolved', 'Lost'])->paginate(10);
            return view('scanresult',['items'=>$data]);
        }
  
        return redirect("login")->with('noaccess','Please login to access that page');
    }

    // form view 
    public function resetitemtatus()
    {
        Item::where('status', 'Available')->update(array('status' => 'Unresolved'));
        
        return redirect('scaninventory');
        

    }



    public function setfound($id)
    {
        Item::where('id', $id)->update(array('status' => 'Available'));

        return redirect('scanresult');
    }

    public function setlost($id)
    {
        Item::where('id', $id)->update(array('status' => 'Lost'));

        return redirect('scanresult');
    }
    

}
