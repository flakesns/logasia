<?php
/**
 * 
 * @author hafiz
 * @link http://hafiznor.wordpress.com
 * @since 1.0
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Vehicles;
use App\Models\VehiclePrice;
use DB;


class SpaController extends Controller
{
    const INTERVAL_DATE = "+10 days";

    public function __construct(){}
    
    protected function getVehicleLists()
    {
        $lists = Vehicles::lists('vehicle', 'id');
        return $lists;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $current_date = date('Y-m-d');
        
        if (isset($request->last_date)) {
            $current_date = $request->last_date;
        }
        
        $end_date = date('Y-m-d',strtotime($current_date . self::INTERVAL_DATE));
        
        $obj = new \stdClass();
        
        //$date = new \DateTime();
        $obj->current_month = date('F Y', strtotime($end_date)); //$date->format('F Y');
        $obj->current_date = $current_date;
        $obj->last_date = $end_date;
        $obj->dates = $this->getDateRange($current_date, $end_date);
        $obj->available = $this->getVehicleAvailability($current_date, $end_date);
        $obj->vehicle_lists = $this->getVehicleLists();
        return \Response::json($obj);
    }
    
    /**
     * Regenerate table price & availability with next date
     * @param date $last_date Y-m-d
     */
    public function nextDate(Request $request, $last_date)
    {
        $request->last_date = $last_date;
        return $this->index($request);
    }
    
    protected function saveData(Request $request)
    {
        $arrWhere = array(
                    'vehicle_id' => $request->vehicle_id,
                    'date_avail'=> $request->date_avail
                );
                
        
        $model = VehiclePrice::firstOrNew($arrWhere);
        $model->vehicle_id = $request->vehicle_id;
        $model->date_avail = $request->date_avail;
       
        if ($request->type == 'numb_avail') {
            $model->numb_avail = $request->numb_avail;
        } elseif ($request->type == 'price') {
            $model->price = $request->price;
        }
         
        $model->save();
        
        return \Response::json(array('success' => true));
    }
    
    protected function saveDataMass(Request $request)
    {
        $table = (new VehiclePrice())->getTable();

        $from_date = date('Y-m-d', strtotime($request->from_date));
        $to_date = date('Y-m-d', strtotime($request->to_date));
        $current = strtotime($from_date);
        $end = strtotime($to_date);
        while( $current <= $end ) {
            
            $add_to_array = true;
            $date_avail = date('Y-m-d', $current);
                        
            if (isset($request->chk_day)) {
                $day = date('l', $current);
                $add_to_array = $this->_is_add_to_array($day, $request);
            }
            
            if ($add_to_array) {
                $arrInsert[] = "($request->vehicle_id, '$date_avail', $request->numb_avail, '$request->price')";
            } else {
                echo "<br>NOT " . $day . " " .$date_avail;
            }
            
            $current = strtotime('+1 day', $current);
        }
        
        $sql = "INSERT INTO $table ( `vehicle_id`,`date_avail`, `numb_avail`, `price` ) VALUES ".implode( ',', $arrInsert )."
                ON DUPLICATE KEY UPDATE `numb_avail` = VALUES(`numb_avail`), price = VALUES(`price`)";
        
        DB::statement($sql);
        
    }
    
    /**
     * 
     * @param string $day date day value
     * @param string $request post value
     * @return boolean
     */
    private function _is_add_to_array($day, $request) 
    {
  
        if (isset($request->chk_day['all']) && $request->chk_day['all'] == 'all') {
            return true;
        }
        
                
        if (isset($request->chk_day)) {
            
            $day = strtolower($day);
            
            $arrDay = $request->chk_day;
            
            if (isset($request->chk_day['weekends']) && $request->chk_day['weekends'] != 'false') {
                  $arrDay = array('saturday', 'sunday');
            }
            
            if (isset($request->chk_day['weekdays']) && $request->chk_day['weekdays'] != 'false') {
                  $arrDay = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday');
            }
            
            if (in_array($day, $arrDay)) {
                return true;
            }            
            
        }
        
        return false;
    }
        
    public function getDateRange($first_date, $last_date, $interval = '+1 day')
    {
        $dates = array();
        $current = strtotime($first_date);
        $end = strtotime($last_date);
    
        while( $current <= $end ) {
            $dates[] = array(
                        'date' => date('d', $current),
                        'day' => date('D', $current)
                    );
            $current = strtotime($interval, $current);
        }
    
        return $dates;
    }
    
    protected function getVehicleAvailability($current_date, $last_date)
    {
        $model = Vehicles::all();
        foreach ($model as $obj) {
                       
            $current = strtotime($current_date);
            $end = strtotime($last_date);
        
            while( $current <= $end ) {
                $date = date('Y-m-d', $current);
                $arrVehicle[$obj->id][$date] = array('avail'=>$obj->total, 'price'=>$obj->default_price);
                $current = strtotime('+1 days', $current);
            }
        }
        
        $model = VehiclePrice::whereBetween('date_avail', [$current_date, $last_date])->get();
        foreach ($model as $obj) {
            $date = date('Y-m-d', strtotime($obj->date_avail));
            if ($obj->numb_avail != '') {
                $arrVehicle[$obj->vehicle_id][$date]['avail'] = $obj->numb_avail;
            }
            if ($obj->price != '') {
                $arrVehicle[$obj->vehicle_id][$date]['price'] = $obj->price;
            }
            
            #28.5 foot pup trailer {id: 3} available only with 20 foot swap body truck {id: 2}
            if ($obj->vehicle_id == 2) {
                if (isset($arrVehicle[2][$date]['avail'])) {
                    if ($arrVehicle[2][$date]['avail'] == 0) {
                        $arrVehicle[3][$date]['avail'] = 0;
                        //$arrVehicle[3][$date]['price'] = 0;
                    }
                }
            }
        }
        
        return $arrVehicle;
    }
}
