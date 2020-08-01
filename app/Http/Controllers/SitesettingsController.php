<?php

namespace App\Http\Controllers;

use App\SiteSettings;
use App\AdminLog;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Site Settings";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=SiteSettings::count();
        if($tabCount==0)
        {
            return redirect(url('sitesettings/create'));
        }else{

            $tab=SiteSettings::orderBy('id','DESC')->first();      
        return view('admin.pages.sitesettings.sitesettings_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=SiteSettings::count();
        if($tabCount==0)
        {            
        return view('admin.pages.sitesettings.sitesettings_create');
            
        }else{

            $tab=SiteSettings::orderBy('id','DESC')->first();      
        return view('admin.pages.sitesettings.sitesettings_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function SystemAdminLog($module_name="",$action="",$details=""){
        $tab=new AdminLog();
        $tab->module_name=$module_name;
        $tab->action=$action;
        $tab->details=$details;
        $tab->admin_id=$this->sdc->admin_id();
        $tab->admin_name=$this->sdc->UserName();
        $tab->save();
    }


    public function store(Request $request)
    {
        $this->validate($request,[
                
                'site_name'=>'required',
                'site_title'=>'required',
                'site_description'=>'required',
                'logo'=>'required',
                'slider_logo'=>'required',
                'contact_address'=>'required',
                'contact_tel'=>'required',
                'contact_phone'=>'required',
                'contact_email'=>'required',
                'fb_link'=>'required',
                'twitter_link'=>'required',
                'instragram_link'=>'required',
                'map_source'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Site Settings","Save New","Create New");

        

        $filename_sitesettings_3='';
        if ($request->hasFile('logo')) {
            $img_sitesettings = $request->file('logo');
            $upload_sitesettings = 'upload/sitesettings';
            $filename_sitesettings_3 = env('APP_NAME').'_'.time() . '.' . $img_sitesettings->getClientOriginalExtension();
            $img_sitesettings->move($upload_sitesettings, $filename_sitesettings_3);
        }

                

        $filename_sitesettings_4='';
        if ($request->hasFile('slider_logo')) {
            $img_sitesettings = $request->file('slider_logo');
            $upload_sitesettings = 'upload/sitesettings';
            $filename_sitesettings_4 = env('APP_NAME').'_'.time() . '.' . $img_sitesettings->getClientOriginalExtension();
            $img_sitesettings->move($upload_sitesettings, $filename_sitesettings_4);
        }

                
        $tab=new SiteSettings();
        
        $tab->site_name=$request->site_name;
        $tab->site_title=$request->site_title;
        $tab->site_description=$request->site_description;
        $tab->logo=$filename_sitesettings_3;
        $tab->slider_logo=$filename_sitesettings_4;
        $tab->contact_address=$request->contact_address;
        $tab->contact_tel=$request->contact_tel;
        $tab->contact_phone=$request->contact_phone;
        $tab->contact_email=$request->contact_email;
        $tab->fb_link=$request->fb_link;
        $tab->twitter_link=$request->twitter_link;
        $tab->instragram_link=$request->instragram_link;
        $tab->map_source=$request->map_source;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('sitesettings')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'site_name'=>'required',
                'site_title'=>'required',
                'site_description'=>'required',
                'logo'=>'required',
                'slider_logo'=>'required',
                'contact_address'=>'required',
                'contact_tel'=>'required',
                'contact_phone'=>'required',
                'contact_email'=>'required',
                'fb_link'=>'required',
                'twitter_link'=>'required',
                'instragram_link'=>'required',
                'map_source'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new SiteSettings();
        
        $tab->site_name=$request->site_name;
        $tab->site_title=$request->site_title;
        $tab->site_description=$request->site_description;
        $tab->logo=$filename_sitesettings_3;
        $tab->slider_logo=$filename_sitesettings_4;
        $tab->contact_address=$request->contact_address;
        $tab->contact_tel=$request->contact_tel;
        $tab->contact_phone=$request->contact_phone;
        $tab->contact_email=$request->contact_email;
        $tab->fb_link=$request->fb_link;
        $tab->twitter_link=$request->twitter_link;
        $tab->instragram_link=$request->instragram_link;
        $tab->map_source=$request->map_source;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('site_name','LIKE','%'.$search.'%');
                            $query->orWhere('site_title','LIKE','%'.$search.'%');
                            $query->orWhere('site_description','LIKE','%'.$search.'%');
                            $query->orWhere('logo','LIKE','%'.$search.'%');
                            $query->orWhere('slider_logo','LIKE','%'.$search.'%');
                            $query->orWhere('contact_address','LIKE','%'.$search.'%');
                            $query->orWhere('contact_tel','LIKE','%'.$search.'%');
                            $query->orWhere('contact_phone','LIKE','%'.$search.'%');
                            $query->orWhere('contact_email','LIKE','%'.$search.'%');
                            $query->orWhere('fb_link','LIKE','%'.$search.'%');
                            $query->orWhere('twitter_link','LIKE','%'.$search.'%');
                            $query->orWhere('instragram_link','LIKE','%'.$search.'%');
                            $query->orWhere('map_source','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->count();
        return $tab;
    }


    private function methodToGetMembers($start, $length,$search=''){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('site_name','LIKE','%'.$search.'%');
                            $query->orWhere('site_title','LIKE','%'.$search.'%');
                            $query->orWhere('site_description','LIKE','%'.$search.'%');
                            $query->orWhere('logo','LIKE','%'.$search.'%');
                            $query->orWhere('slider_logo','LIKE','%'.$search.'%');
                            $query->orWhere('contact_address','LIKE','%'.$search.'%');
                            $query->orWhere('contact_tel','LIKE','%'.$search.'%');
                            $query->orWhere('contact_phone','LIKE','%'.$search.'%');
                            $query->orWhere('contact_email','LIKE','%'.$search.'%');
                            $query->orWhere('fb_link','LIKE','%'.$search.'%');
                            $query->orWhere('twitter_link','LIKE','%'.$search.'%');
                            $query->orWhere('instragram_link','LIKE','%'.$search.'%');
                            $query->orWhere('map_source','LIKE','%'.$search.'%');
                            $query->orWhere('module_status','LIKE','%'.$search.'%');
                            $query->orWhere('created_at','LIKE','%'.$search.'%');

                        return $query;
                     })
                     ->skip($start)->take($length)->get();
        return $tab;
    }

    public function datatable(Request $request){

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search = $request->get('search');

        $search = (isset($search['value']))? $search['value'] : '';

        $total_members = $this->methodToGetMembersCount($search); // get your total no of data;
        $members = $this->methodToGetMembers($start, $length,$search); //supply start and length of the table data

        $data = array(
            'draw' => $draw,
            'recordsTotal' => $total_members,
            'recordsFiltered' => $total_members,
            'data' => $members,
        );

        echo json_encode($data);

    }

    
    public function SiteSettingsQuery($request)
    {
        $SiteSettings_data=SiteSettings::orderBy('id','DESC')->get();

        return $SiteSettings_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Site Name','Site Title','Site Description','Logo','Slider Logo','Contact Address','Contact Tel','Contact Phone','Contact Email','FB Link','Twitter Link','Instragram Link','Map Source','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->SiteSettingsQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->site_name,$voi->site_title,$voi->site_description,$voi->logo,$voi->slider_logo,$voi->contact_address,$voi->contact_tel,$voi->contact_phone,$voi->contact_email,$voi->fb_link,$voi->twitter_link,$voi->instragram_link,$voi->map_source,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Site Settings Report',
            'report_title'=>'Site Settings Report',
            'report_description'=>'Report Genarated : '.$dataDateTimeIns,
            'data'=>$data
        );

        $this->sdc->ExcelLayout($excelArray);
        
    }

    public function ExportPDF(Request $request)
    {

        $html="<table class='table table-bordered' style='width:100%;'>
                <thead>
                <tr>
                <th class='text-center' style='font-size:12px;'>ID</th>
                            <th class='text-center' style='font-size:12px;' >Site Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Site Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Slider Logo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Address</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Tel</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Phone</th>
                        
                            <th class='text-center' style='font-size:12px;' >Contact Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >FB Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Twitter Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Instragram Link</th>
                        
                            <th class='text-center' style='font-size:12px;' >Map Source</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->SiteSettingsQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->site_description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->slider_logo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_address."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_tel."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_phone."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->contact_email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->fb_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->twitter_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->instragram_link."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->map_source."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Site Settings Report',$html);


    }
    public function show(SiteSettings $sitesettings)
    {
        
        $tab=SiteSettings::all();return view('admin.pages.sitesettings.sitesettings_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteSettings $sitesettings,$id=0)
    {
        $tab=SiteSettings::find($id);      
        return view('admin.pages.sitesettings.sitesettings_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteSettings $sitesettings,$id=0)
    {
        $this->validate($request,[
                
                'site_name'=>'required',
                'site_title'=>'required',
                'site_description'=>'required',
                'contact_address'=>'required',
                'contact_tel'=>'required',
                'contact_phone'=>'required',
                'contact_email'=>'required',
                'map_source'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Site Settings","Update","Edit / Modify");

        

        $filename_sitesettings_3=$request->ex_logo;
        if ($request->hasFile('logo')) {
            $img_sitesettings = $request->file('logo');
            $upload_sitesettings = 'upload/sitesettings';
            $filename_sitesettings_3 = env('APP_NAME').'_'.time() . '.' . $img_sitesettings->getClientOriginalExtension();
            $img_sitesettings->move($upload_sitesettings, $filename_sitesettings_3);
        }

                

        $filename_sitesettings_4=$request->ex_slider_logo;
        if ($request->hasFile('slider_logo')) {
            $img_sitesettings = $request->file('slider_logo');
            $upload_sitesettings = 'upload/sitesettings';
            $filename_sitesettings_4 = env('APP_NAME').'_slider_logo_'.time() . '.' . $img_sitesettings->getClientOriginalExtension();
            $img_sitesettings->move($upload_sitesettings, $filename_sitesettings_4);
        }

                
        $tab=SiteSettings::find($id);
        
        $tab->site_name=$request->site_name;
        $tab->site_title=$request->site_title;
        $tab->site_description=$request->site_description;
        $tab->logo=$filename_sitesettings_3;
        $tab->slider_logo=$filename_sitesettings_4;
        $tab->contact_address=$request->contact_address;
        $tab->contact_tel=$request->contact_tel;
        $tab->contact_phone=$request->contact_phone;
        $tab->contact_email=$request->contact_email;
        $tab->fb_link=$request->fb_link;
        $tab->twitter_link=$request->twitter_link;
        $tab->instragram_link=$request->instragram_link;
        $tab->map_source=$request->map_source;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('sitesettings')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteSettings  $sitesettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteSettings $sitesettings,$id=0)
    {
        $this->SystemAdminLog("Site Settings","Destroy","Delete");

        $tab=SiteSettings::find($id);
        $tab->delete();
        return redirect('sitesettings')->with('status','Deleted Successfully !');}
}
