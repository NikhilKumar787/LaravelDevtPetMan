<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
class HomeController
{
    public function index(Request $request)
    {
        if(auth()->user()->roles[0]->id == 5){
            $tEmp = User::join('role_user','role_user.user_id','=','users.id')->whereIn('role_id',[3])->count();
            $pEmp = User::join('role_user','role_user.user_id','=','users.id')
            ->join('attendance','attendance.emp_id','=','users.id')
            ->whereDate('login_date',\Carbon\Carbon::now())
            ->whereIn('role_id',[3])
            ->count();
            $aEmp = $tEmp - $pEmp;
            return view('home', compact('tEmp','pEmp','aEmp'));
        } else {
            $settings1 = [
                'chart_title'           => 'Invoices',
                'chart_type'            => 'line',
                'report_type'           => 'group_by_date',
                'model'                 => 'App\Models\Invoice',
                'group_by_field'        => 'invoice_date',
                'group_by_period'       => 'day',
                'aggregate_function'    => 'count',
                'filter_field'          => 'created_at',
                'filter_period'         => 'year',
                'group_by_field_format' => 'Y-m-d',
                'column_class'          => 'col-md-12',
                'entries_number'        => '5',
                'translation_key'       => 'invoice',
            ];
    
            $chart1 = new LaravelChart($settings1);
    
            $settings2 = [
                'chart_title'           => 'Latest Invoices',
                'chart_type'            => 'latest_entries',
                'report_type'           => 'group_by_date',
                'model'                 => 'App\Models\Invoice',
                'group_by_field'        => 'invoice_date',
                'group_by_period'       => 'day',
                'aggregate_function'    => 'count',
                'filter_field'          => 'created_at',
                'filter_period'         => 'year',
                'group_by_field_format' => 'Y-m-d',
                'column_class'          => 'col-md-12',
                'entries_number'        => '5',
                'fields'                => [
                    'type'            => '',
                    'invoice_date'    => '',
                    'invoice_no'      => '',
                    'created_at'      => '',
                    'customer'        => 'first_name',
                    'customer_email'  => '',
                    'place_of_supply' => 'state',
                ],
                'translation_key' => 'invoice',
            ];
            if(auth()->user()->id == 1){
                $settings2['data'] = [];
                if (class_exists($settings2['model'])) {
                    $settings2['data'] = $settings2['model']::latest()
                        ->take($settings2['entries_number'])
                        ->get();
                } 
                if (!array_key_exists('fields', $settings2)) {
                    $settings2['fields'] = [];
                }  
            }else{
              $value = isset($_COOKIE['comp_name']) ? $_COOKIE['comp_name']: 0;
            if($value == 0){
                $settings2['data'] = [];
                if (class_exists($settings2['model'])) {
                    $settings2['data'] = $settings2['model']::latest()
                        ->take($settings2['entries_number'])
                        ->get();
                } 
                if (!array_key_exists('fields', $settings2)) {
                    $settings2['fields'] = [];
                } 
            }else {
                $settings2['data'] = [];
                if (class_exists($settings2['model'])) {
                    $settings2['data'] = $settings2['model']::latest()
                        ->where('company_id',$value)->take($settings2['entries_number'])
                        ->get();
                }
        
                if (!array_key_exists('fields', $settings2)) {
                    $settings2['fields'] = [];
                }
                
            }
        }
            
    
            $settings3 = [
                'chart_title'           => 'Products',
                'chart_type'            => 'pie',
                'report_type'           => 'group_by_date',
                'model'                 => 'App\Models\Product',
                'group_by_field'        => 'created_at',
                'group_by_period'       => 'day',
                'aggregate_function'    => 'count',
                'filter_field'          => 'created_at',
                'filter_period'         => 'year',
                'group_by_field_format' => 'Y-m-d H:i:s',
                'column_class'          => 'col-md-12',
                'entries_number'        => '5',
                'translation_key'       => 'product',
            ];
    
            $chart3 = new LaravelChart($settings3);
            return view('home', compact('chart1', 'chart3', 'settings2'));
        }
        

        
    }
}
