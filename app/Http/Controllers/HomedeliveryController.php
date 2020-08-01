<?php

namespace App\Http\Controllers;

use App\HomeDelivery;
use App\AdminLog;
use Illuminate\Http\Request;

class HomeDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Home Delivery";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=HomeDelivery::count();
        if($tabCount==0)
        {
            return redirect(url('homedelivery/create'));
        }else{

            $tab=HomeDelivery::orderBy('id','DESC')->first();      
        return view('admin.pages.homedelivery.homedelivery_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=HomeDelivery::count();
        if($tabCount==0)
        {            
        return view('admin.pages.homedelivery.homedelivery_create');
            
        }else{

            $tab=HomeDelivery::orderBy('id','DESC')->first();      
        return view('admin.pages.homedelivery.homedelivery_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'title'=>'required',
                'sub_title'=>'required',
                'logo_one'=>'required',
                'logo_two'=>'required',
                'logo_three'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Home Delivery","Save New","Create New");

        

        $filename_homedelivery_2='';
        if ($request->hasFile('logo_one')) {
            $img_homedelivery = $request->file('logo_one');
            $upload_homedelivery = 'upload/homedelivery';
            $filename_homedelivery_2 = env('APP_NAME').'_'.time() . '.' . $img_homedelivery->getClientOriginalExtension();
            $img_homedelivery->move($upload_homedelivery, $filename_homedelivery_2);
        }

                

        $filename_homedelivery_3='';
        if ($request->hasFile('logo_two')) {
            $img_homedelivery = $request->file('logo_two');
            $upload_homedelivery = 'upload/homedelivery';
            $filename_homedelivery_3 = env('APP_NAME').'_'.time() . '.' . $img_homedelivery->getClientOriginalExtension();
            $img_homedelivery->move($upload_homedelivery, $filename_homedelivery_3);
        }

                

        $filename_homedelivery_4='';
        if ($request->hasFile('logo_three')) {
            $img_homedelivery = $request->file('logo_three');
            $upload_homedelivery = 'upload/homedelivery';
            $filename_homedelivery_4 = env('APP_NAME').'_'.time() . '.' . $img_homedelivery->getClientOriginalExtension();
            $img_homedelivery->move($upload_homedelivery, $filename_homedelivery_4);
        }

                
        $tab=new HomeDelivery();
        
        $tab->title=$request->title;
        $tab->sub_title=$request->sub_title;
        $tab->logo_one=$filename_homedelivery_2;
        $tab->logo_two=$filename_homedelivery_3;
        $tab->logo_three=$filename_homedelivery_4;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('homedelivery')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'title'=>'required',
                'sub_title'=>'required',
                'logo_one'=>'required',
                'logo_two'=>'required',
                'logo_three'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new HomeDelivery();
        
        $tab->title=$request->title;
        $tab->sub_title=$request->sub_title;
        $tab->logo_one=$filename_homedelivery_2;
        $tab->logo_two=$filename_homedelivery_3;
        $tab->logo_three=$filename_homedelivery_4;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('title','LIKE','%'.$search.'%');
                            $query->orWhere('sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('logo_one','LIKE','%'.$search.'%');
                            $query->orWhere('logo_two','LIKE','%'.$search.'%');
                            $query->orWhere('logo_three','LIKE','%'.$search.'%');
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
                            $query->orWhere('title','LIKE','%'.$search.'%');
                            $query->orWhere('sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('logo_one','LIKE','%'.$search.'%');
                            $query->orWhere('logo_two','LIKE','%'.$search.'%');
                            $query->orWhere('logo_three','LIKE','%'.$search.'%');
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

    
    public function HomeDeliveryQuery($request)
    {
        $HomeDelivery_data=HomeDelivery::orderBy('id','DESC')->get();

        return $HomeDelivery_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Title','Sub Title','Logo One','Logo Two','Logo Three','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->HomeDeliveryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->title,$voi->sub_title,$voi->logo_one,$voi->logo_two,$voi->logo_three,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Home Delivery Report',
            'report_title'=>'Home Delivery Report',
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
                            <th class='text-center' style='font-size:12px;' >Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Sub Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Logo One</th>
                        
                            <th class='text-center' style='font-size:12px;' >Logo Two</th>
                        
                            <th class='text-center' style='font-size:12px;' >Logo Three</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->HomeDeliveryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->logo_one."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->logo_two."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->logo_three."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Home Delivery Report',$html);


    }
    public function show(HomeDelivery $homedelivery)
    {
        
        $tab=HomeDelivery::all();return view('admin.pages.homedelivery.homedelivery_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */
    public function edit(HomeDelivery $homedelivery,$id=0)
    {
        $tab=HomeDelivery::find($id);      
        return view('admin.pages.homedelivery.homedelivery_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HomeDelivery $homedelivery,$id=0)
    {
        $this->validate($request,[
                
                'title'=>'required',
                'sub_title'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Home Delivery","Update","Edit / Modify");

        

        $filename_homedelivery_2=$request->ex_logo_one;
        if ($request->hasFile('logo_one')) {
            $img_homedelivery = $request->file('logo_one');
            $upload_homedelivery = 'upload/homedelivery';
            $filename_homedelivery_2 = env('APP_NAME').'_'.time() . '.' . $img_homedelivery->getClientOriginalExtension();
            $img_homedelivery->move($upload_homedelivery, $filename_homedelivery_2);
        }

                

        $filename_homedelivery_3=$request->ex_logo_two;
        if ($request->hasFile('logo_two')) {
            $img_homedelivery = $request->file('logo_two');
            $upload_homedelivery = 'upload/homedelivery';
            $filename_homedelivery_3 = env('APP_NAME').'_two_'.time() . '.' . $img_homedelivery->getClientOriginalExtension();
            $img_homedelivery->move($upload_homedelivery, $filename_homedelivery_3);
        }

                

        $filename_homedelivery_4=$request->ex_logo_three;
        if ($request->hasFile('logo_three')) {
            $img_homedelivery = $request->file('logo_three');
            $upload_homedelivery = 'upload/homedelivery';
            $filename_homedelivery_4 = env('APP_NAME').'_three_'.time() . '.' . $img_homedelivery->getClientOriginalExtension();
            $img_homedelivery->move($upload_homedelivery, $filename_homedelivery_4);
        }

                
        $tab=HomeDelivery::find($id);
        
        $tab->title=$request->title;
        $tab->sub_title=$request->sub_title;
        $tab->logo_one=$filename_homedelivery_2;
        $tab->logo_two=$filename_homedelivery_3;
        $tab->logo_three=$filename_homedelivery_4;
        $tab->logo_one_link=$request->logo_one_link;
        $tab->logo_two_link=$request->logo_two_link;
        $tab->logo_three_link=$request->logo_three_link;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('homedelivery')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HomeDelivery  $homedelivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(HomeDelivery $homedelivery,$id=0)
    {
        $this->SystemAdminLog("Home Delivery","Destroy","Delete");

        $tab=HomeDelivery::find($id);
        $tab->delete();
        return redirect('homedelivery')->with('status','Deleted Successfully !');}
}
