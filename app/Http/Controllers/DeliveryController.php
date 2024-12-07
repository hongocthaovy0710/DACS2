<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;

class DeliveryController extends Controller
{


    public function update_delivery(Request $request)
    {
        try {
            $validated = $request->validate([
                'feeship_id' => 'required|exists:tbl_feeship,fee_id',
                'fee_value' => 'required|numeric|min:0'
            ]);
    
            $feeShip = Feeship::findOrFail($validated['feeship_id']);
            $feeValue = floatval(rtrim($validated['fee_value'], '.'));
            
            // Using Eloquent model instead of DB facade
            $feeShip->fee_feeship = $feeValue;
            $feeShip->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Updated successfully',
                'data' => [
                    'fee_id' => $feeShip->fee_id,
                    'fee_value' => $feeShip->fee_feeship
                ]
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
    public function delivery(Request $request){
        $city = City::orderby('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }


    public function select_feeship(){
		$feeship = Feeship::orderby('fee_id','DESC')->get();
		$output = '';
		$output .= '<div class="table-responsive">  
			<table class="table table-bordered">
				<thead> 
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th> 
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>  
				</thead>
				<tbody>
				';

				foreach($feeship as $key => $fee){

				$output.='
					<tr>
						<td>'.$fee->city->name_city.'</td>
						<td>'.$fee->province->name_quanhuyen.'</td>
						<td>'.$fee->wards->name_xaphuong.'</td>
						<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
					</tr>
					';
				}

				$output.='		
				</tbody>
				</table></div>
				';
                return $output;
				
               

		
	}

    public function insert_delivery(Request $request)
    {
        // 1. Xác thực dữ liệu đầu vào
        $request->validate([
            'city' => 'required|integer',
            'province' => 'required|integer',
            'wards' => 'required|integer',
            'fee_ship' => 'required|numeric',
        ]);

        try {
            // 2. Tạo mới phí vận chuyển
            $fee_ship = new Feeship();
            $fee_ship->fee_matp = $request->city;
            $fee_ship->fee_maqh = $request->province;
            $fee_ship->fee_xaid = $request->wards;
            $fee_ship->fee_feeship = $request->fee_ship;
            $fee_ship->save();

            // 3. Trả về phản hồi JSON thành công
            return response()->json(['success' => 'Thêm phí vận chuyển thành công']);
        } catch (\Exception $e) {
            // 4. Trả về phản hồi JSON lỗi nếu có vấn đề
            return response()->json(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()], 500);
        }
    }


    public function select_delivery(Request $request)
    {
        if ($request->action == 'city') {
            $provinces = Province::where('matp', $request->ma_id)->orderby('maqh','ASC')->get();
            $output = '<option value="">--Chọn quận huyện--</option>';
            foreach($provinces as $province){
                $output .= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
            }
            echo $output;
        } elseif ($request->action == 'province') {
            $wards = Wards::where('maqh', $request->ma_id)->orderby('xaid','ASC')->get();
            $output = '<option value="">--Chọn xã phường--</option>';
            foreach($wards as $ward){
                $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
            }
            echo $output;
        }
    }
   

        // Kiểm tra
}