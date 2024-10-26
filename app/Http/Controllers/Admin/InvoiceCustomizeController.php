<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InvoiceCustomization;
use App\Models\City;
use App\Models\State;
use App\Models\User;
use App\Models\CompanyType;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Company;
use Facebook\WebDriver\Firefox\FirefoxDriver;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Http\Request;
use PhpParser\JsonDecoder;

class InvoiceCustomizeController extends Controller
{
    use MediaUploadingTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company_id = $request->comp_id;
        $company = Company::with('city','state')->where('id',$request->comp_id)->first();
        $company_user = \DB::table('company_role_user')
        ->join('users','users.id','=','company_role_user.user_id')
        ->where('company_role_user.company_id',$request->comp_id)
        ->select('users.*')
        ->first();
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        // $company = Company::where('id',$request->comp_id)->first();
        return view('admin.invoice_customize.create',compact('company_id','states','cities','company','company_user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $invoiceCustomizationTemplate = InvoiceCustomization::create([
           'template_name' => $request->template_name,
           'template_no'   => $request->temp_no,
           'template_logo_alignment' => $request->logo_alignment,
           'template_color_code' => $request->color_code,
           'template_font' => $request->font,
           'company_id'    => $request->company_id,

        ]);
        if($request->company_logo) {
            $invoiceCustomizationTemplate->addMedia(storage_path('tmp/uploads/'.$request->company_logo))->toMediaCollection('company_logo');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $request->company_id]);
        }

        return $invoiceCustomizationTemplate;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
      $template = InvoiceCustomization::where('id',$request->temp_id)->first();
      $template_properties = json_decode($template->template_properties); 
      $email_content_properties = json_decode($template->email_content_properties);
      $company = Company::with('city','state')->where('id',$template->company_id)->first();
        $company_user = \DB::table('company_role_user')
        ->join('users','users.id','=','company_role_user.user_id')
        ->where('company_role_user.company_id',$template->company_id)
        ->select('users.*')
        ->first();
      $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
      $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
      return view('admin.invoice_customize.edit',compact('template','states','cities','template_properties','email_content_properties','company','company_user'));
    }

    public function templateProperies(Request $request){
      $template = InvoiceCustomization::where('id',$request->temp_id)->first();
      $template_properties = json_decode($template->template_properties); 
      return $template_properties;
    }

    public function emailContentProperies(Request $request){
        $template = InvoiceCustomization::where('id',$request->temp_id)->first();
        $email_content_properties = json_decode($template->email_content_properties); 
        return $email_content_properties;
       
      }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceCustomization $invoiceCustomization)
    {
        $template = InvoiceCustomization::where('id',$request->temp_id)->first();
        $template->update([
            'template_name' => $request->template_name,
            'template_no'   => $request->temp_no,
            'template_logo_alignment' => $request->logo_alignment,
            'template_color_code' => $request->color_code,
            'template_font' => $request->font,
            'company_id'    => $request->company_id,   
        ]);
        if ($request->company_logo) {
            if (!$template->company_logo || $request->company_logo !== $template->company_logo->file_name) {
                if ($template->company_logo) {
                    $template->company_logo->delete();
                }
                $template->addMedia(storage_path('tmp/uploads/'.$request->company_logo))->toMediaCollection('company_logo');
            }
        } 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $delete_template_by_id = InvoiceCustomization::where('id',$request->temp_id)->first();
        $delete_template_by_id->delete();

    }
    public function templateSet(Request $request){
        $company = Company::with('city','state')->where('id',$request->comp_id)->first();
        $company_user = \DB::table('company_role_user')
        ->join('users','users.id','=','company_role_user.user_id')
        ->where('company_role_user.company_id',$request->comp_id)
        ->select('users.*')
        ->first();
        $states = State::pluck('state', 'id')->prepend(trans('global.pleaseSelect'), '');
       if($request->temp_no == 1 || $request->temp_no == 0){
        $view = View('admin.invoice_customize.template1',compact('company','company_user','states'));
       }elseif($request->temp_no == 2){
        $view = View('admin.invoice_customize.template2',compact('company','company_user','states'));
       }elseif($request->temp_no == 3){
        $view = View('admin.invoice_customize.template3',compact('company','company_user','states'));
       }
       elseif($request->temp_no == 4){
        $view = View('admin.invoice_customize.template4',compact('company','company_user','states'));
       }elseif($request->temp_no == 5){
        $view = View('admin.invoice_customize.template5',compact('company','company_user','states'));
       }
    //    elseif($request->temp_no == 6){
    //     $view = View('admin.invoice_customize.template6',compact('company','company_user','states'));
    //    }
       return $view;

    }


    public function allTemplateListing(Request $request){
       $allTemplateListing = InvoiceCustomization::where('company_id',$request->company_id)->pluck('template_name','id');
       return $allTemplateListing;

    }

    public function templateDropzoneGet(Request $request){
        $company = Company::where('id',$request->comp_id)->first();
        return $company;

    }

    public function templateContentSave(Request $request){
        $data = ['Header'=>['business_name'=>$request->business_name,'phone'=>$request->phone_org_no,'owner_email'=>$request->owner_email,'street_address'=>$request->street_address,'website'=>$request->website,'shipping_address'=>$request->shipping_address,'terms'=>$request->terms,'due_date'=>$request->due_date ],
        'Center'=>['product_date'=>$request->product_date,'product_service'=>$request->product_service,'product_incl_des_here'=>$request->product_incl_des_here,'product_description'=>$request->product_description,'product_incl_qua_rate'=>$request->product_incl_qua_rate,'product_quantity'=>$request->product_quantity,'product_rate'=>$request->product_rate,'product_amount'=>$request->product_amount,'product_sku'=>$request->product_sku],
        'Footer'=>['product_discount'=>$request->product_discount,'product_deposit'=>$request->product_deposit,'message_invoice'=>$request->message_invoice]];
        $template_content = json_encode($data);
        $company = Company::where('id',$request->company_id)->first();
        $company_owner =User::where('id',$request->owner_id)->first();
        $lastTemplate = InvoiceCustomization::where([ 'company_id' => $request->company_id, ])->orderBy('id','desc')->first();


        $company->update([
            'company_name' => $request->comp_name,
            'address_line_1' => $request->address1,
            'address_line_2' => $request->address2,
            'pin_code'      => $request->pin_code,
            'city_id'       => $request->city_id,
            'state_id'      => $request->state_id,
        ]);

        $company_owner->update([
            'email' => $request->email,
            'phone_no' => $request->phone,

        ]);

        $lastTemplate->update([
            'template_properties'=>$template_content,
        ]);

        $data=[
            'company'=>$company,
            'company_owner'=>$company_owner,
            'template_content'=>$lastTemplate,
        ];
        return $data;
    }

    public function templateContentUpdate(Request $request){
        $data = ['Header'=>['business_name'=>$request->business_name,'phone'=>$request->phone_org_no,'owner_email'=>$request->owner_email,'street_address'=>$request->street_address,'website'=>$request->website,'shipping_address'=>$request->shipping_address,'terms'=>$request->terms,'due_date'=>$request->due_date ],
        'Center'=>['product_date'=>$request->product_date,'product_service'=>$request->product_service,'product_incl_des_here'=>$request->product_incl_des_here,'product_description'=>$request->product_description,'product_incl_qua_rate'=>$request->product_incl_qua_rate,'product_quantity'=>$request->product_quantity,'product_rate'=>$request->product_rate,'product_amount'=>$request->product_amount,'product_sku'=>$request->product_sku],
        'Footer'=>['product_discount'=>$request->product_discount,'product_deposit'=>$request->product_deposit,'message_invoice'=>$request->message_invoice]];
        $template_content = json_encode($data);
        $company = Company::where('id',$request->company_id)->first();
        $company_owner =User::where('id',$request->owner_id)->first();
        $template = InvoiceCustomization::where('id',$request->temp_id)->first();
        
        $company->update([
            'company_name' => $request->comp_name,
            'address_line_1' => $request->address1,
            'address_line_2' => $request->address2,
            'pin_code'      => $request->pin_code,
            'city_id'       => $request->city_id,
            'state_id'      => $request->state_id,
        ]);

        $company_owner->update([
            'email' => $request->email,
            'phone_no' => $request->phone,

        ]);

        $template->update([
            'template_properties'=>$template_content,
        ]);

        $data=[
            'company'=>$company,
            'company_owner'=>$company_owner,
            'template_content'=>$template,
        ];
        return $data;
    }

    public function emailContentSave(Request $request){
        $data = ['Header'=>['sale_form_type'=>$request->sale_form_type,'full_details_email'=>$request->full_details_email,'summarized_details_email'=>$request->summarized_details_email,'check_attachment_invo_pdf'=>$request->check_attachment_invo_pdf ],
        'StandardEmail'=>['standard_email_subject'=>$request->standard_email_subject,'check_standard_greeting'=>$request->check_standard_greeting,'standard_greeting'=>$request->standard_greeting,'standard_greeting_name'=>$request->standard_greeting_name,'message_standard_email'=>$request->message_standard_email],
        'ReminderEmail'=>['email_reminder_subject'=>$request->email_reminder_subject,'check_reminder_greeting'=>$request->check_reminder_greeting,'reminder_greeting'=>$request->reminder_greeting,'reminder_greeting_name'=>$request->reminder_greeting_name ,'message_reminder_email'=>$request->message_reminder_email ]];
        $email_content = json_encode($data);
        $lastTemplate = InvoiceCustomization::where([ 'company_id' => $request->company_id, ])->orderBy('id','desc')->first();

        $lastTemplate->update([
            'email_content_properties'=>$email_content,
        ]);
       
        return $lastTemplate;
    }

}
