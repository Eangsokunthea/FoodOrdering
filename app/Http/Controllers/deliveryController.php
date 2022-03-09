<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Delivery;
use App\Models\Feeship;
use App\Models\Province;
use App\Models\Wards;
use Illuminate\Http\Request;

class deliveryController extends Controller
{
    public function index(){
        return view('BackEnd.delivery.addDelivery');
    }
    public function save_boy(Request $request){
        $boy = new Delivery();
        $boy->delivery_name = $request->delivery_name;
        $boy->delivery_phone_number = $request->delivery_phone_number;
        $boy->delivery_password = $request->delivery_password;
        $boy->added_on = $request->added_on;
        $boy->delivery_status = $request->delivery_status;
        $boy->save();

        return back()->with('message','Delivery Saved');
    }
    public function  manage(){
        $boy_delivery = Delivery::all();
        
        return view('BackEnd.delivery.manageDelivery', compact('boy_delivery'));
    }
    public function active($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delivery_status = 1;
        $delivery->save();
        return back();
    }
    public function inactive($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delivery_status = 0;
        $delivery->save();
        return back();
    }
    public function delete($delivery_id){
        $delivery = Delivery::find($delivery_id);
        $delivery->delete();
        return back();
    }   
    public function update(Request $request){
        $delivery = Delivery::find($request->delivery_id);
        $delivery->delivery_name = $request->delivery_name;
        $delivery->delivery_phone_number = $request->delivery_phone_number;
        $delivery->order_number = $request->order_number;
        $delivery->save();
        return redirect('/delivery/boy/manage')->with('message', 'delivery Updated');
    }


    // ----------FeeShip-----------
    public function  ManageFeeShip(Request $request){   
        $boy_delivery = Delivery::all();
        $city = City::orderby('matp','ASC')->get();

        return view('BackEnd.feeship.manageFeeShip', compact('boy_delivery', 'city'));
    }
    public function SelectDelivery(Request $request){
        $data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    }
    
    public function InsertDelivery(Request $request){
        $data = $request->all();
		$fee_ship = new Feeship();
		$fee_ship->fee_delivery = $data['delivery'];
		$fee_ship->fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$fee_ship->save();
    }

    public function SelectFeeship(){
        $feeship = Feeship::orderby('fee_id','DESC')->get();
		$output = '';
		$output .= '<br><div class="table-responsive">  
			<table class="table table-bordered">
				<thread> 
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th> 
						<th>Tên xã phường</th>
                        <th>Tên người vận chuyển</th>
						<th>Phí ship</th>
					</tr>  
				</thread>
				<tbody>
				';

				foreach($feeship as $key => $fee){

				$output.='
					<tr>
						<td>'.$fee->city->name_city.'</td>
						<td>'.$fee->province->name_quanhuyen.'</td>
						<td>'.$fee->wards->name_xaphuong.'</td>
                        <td>'.$fee->delivery->delivery_name.'</td>
						<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'$</td>
					</tr>
					';
				}

				$output.='		
				</tbody>
				</table></div>
				';

				echo $output;
    }
    public function UpdateFeeDelivery(Request $request){
        $data = $request->all();
		$fee_ship = Feeship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
    }
}
