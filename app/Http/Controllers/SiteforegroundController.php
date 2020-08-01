<?php

namespace App\Http\Controllers;

use App\SiteForeground;
use App\AdminLog;
use Illuminate\Http\Request;

class SiteForegroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Site Foreground";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=SiteForeground::count();
        if($tabCount==0)
        {
            return redirect(url('siteforeground/create'));
        }else{

            $tab=SiteForeground::orderBy('id','DESC')->first();      
        return view('admin.pages.siteforeground.siteforeground_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=SiteForeground::count();
        if($tabCount==0)
        {            
        return view('admin.pages.siteforeground.siteforeground_create');
            
        }else{

            $tab=SiteForeground::orderBy('id','DESC')->first();      
        return view('admin.pages.siteforeground.siteforeground_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'our_menu'=>'required',
                'reserve'=>'required',
                'fotter'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Site Foreground","Save New","Create New");

        

        $filename_siteforeground_0='';
        if ($request->hasFile('our_menu')) {
            $img_siteforeground = $request->file('our_menu');
            $upload_siteforeground = 'upload/siteforeground';
            $filename_siteforeground_0 = env('APP_NAME').'_'.time() . '.' . $img_siteforeground->getClientOriginalExtension();
            $img_siteforeground->move($upload_siteforeground, $filename_siteforeground_0);
        }

                

        $filename_siteforeground_1='';
        if ($request->hasFile('reserve')) {
            $img_siteforeground = $request->file('reserve');
            $upload_siteforeground = 'upload/siteforeground';
            $filename_siteforeground_1 = env('APP_NAME').'_'.time() . '.' . $img_siteforeground->getClientOriginalExtension();
            $img_siteforeground->move($upload_siteforeground, $filename_siteforeground_1);
        }

                

        $filename_siteforeground_2='';
        if ($request->hasFile('fotter')) {
            $img_siteforeground = $request->file('fotter');
            $upload_siteforeground = 'upload/siteforeground';
            $filename_siteforeground_2 = env('APP_NAME').'_'.time() . '.' . $img_siteforeground->getClientOriginalExtension();
            $img_siteforeground->move($upload_siteforeground, $filename_siteforeground_2);
        }

                
        $tab=new SiteForeground();
        
        $tab->our_menu=$filename_siteforeground_0;
        $tab->reserve=$filename_siteforeground_1;
        $tab->fotter=$filename_siteforeground_2;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('siteforeground')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'our_menu'=>'required',
                'reserve'=>'required',
                'fotter'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new SiteForeground();
        
        $tab->our_menu=$filename_siteforeground_0;
        $tab->reserve=$filename_siteforeground_1;
        $tab->fotter=$filename_siteforeground_2;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SiteForeground  $siteforeground
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('our_menu','LIKE','%'.$search.'%');
                            $query->orWhere('reserve','LIKE','%'.$search.'%');
                            $query->orWhere('fotter','LIKE','%'.$search.'%');
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
                            $query->orWhere('our_menu','LIKE','%'.$search.'%');
                            $query->orWhere('reserve','LIKE','%'.$search.'%');
                            $query->orWhere('fotter','LIKE','%'.$search.'%');
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

    
    public function SiteForegroundQuery($request)
    {
        $SiteForeground_data=SiteForeground::orderBy('id','DESC')->get();

        return $SiteForeground_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Our Menu','Reserve','Fotter','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->SiteForegroundQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->our_menu,$voi->reserve,$voi->fotter,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Site Foreground Report',
            'report_title'=>'Site Foreground Report',
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
                            <th class='text-center' style='font-size:12px;' >Our Menu</th>
                        
                            <th class='text-center' style='font-size:12px;' >Reserve</th>
                        
                            <th class='text-center' style='font-size:12px;' >Fotter</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->SiteForegroundQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->our_menu."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->reserve."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->fotter."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Site Foreground Report',$html);


    }
    public function show(SiteForeground $siteforeground)
    {
        
        $tab=SiteForeground::all();return view('admin.pages.siteforeground.siteforeground_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SiteForeground  $siteforeground
     * @return \Illuminate\Http\Response
     */
    public function edit(SiteForeground $siteforeground,$id=0)
    {
        $tab=SiteForeground::find($id);      
        return view('admin.pages.siteforeground.siteforeground_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SiteForeground  $siteforeground
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SiteForeground $siteforeground,$id=0)
    {
        $this->validate($request,[
                
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Site Foreground","Update","Edit / Modify");

        

        $filename_siteforeground_0=$request->ex_our_menu;
        if ($request->hasFile('our_menu')) {
            $img_siteforeground = $request->file('our_menu');
            $upload_siteforeground = 'upload/siteforeground';
            $filename_siteforeground_0 = env('APP_NAME').'_our_menu_'.time() . '.' . $img_siteforeground->getClientOriginalExtension();
            $img_siteforeground->move($upload_siteforeground, $filename_siteforeground_0);
        }

                

        $filename_siteforeground_1=$request->ex_reserve;
        if ($request->hasFile('reserve')) {
            $img_siteforeground = $request->file('reserve');
            $upload_siteforeground = 'upload/siteforeground';
            $filename_siteforeground_1 = env('APP_NAME').'_reserve_'.time() . '.' . $img_siteforeground->getClientOriginalExtension();
            $img_siteforeground->move($upload_siteforeground, $filename_siteforeground_1);
        }

                

        $filename_siteforeground_2=$request->ex_fotter;
        if ($request->hasFile('fotter')) {
            $img_siteforeground = $request->file('fotter');
            $upload_siteforeground = 'upload/siteforeground';
            $filename_siteforeground_2 = env('APP_NAME').'_fotter_'.time() . '.' . $img_siteforeground->getClientOriginalExtension();
            $img_siteforeground->move($upload_siteforeground, $filename_siteforeground_2);
        }

                
        $tab=SiteForeground::find($id);
        
        $tab->our_menu=$filename_siteforeground_0;
        $tab->reserve=$filename_siteforeground_1;
        $tab->fotter=$filename_siteforeground_2;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('siteforeground')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SiteForeground  $siteforeground
     * @return \Illuminate\Http\Response
     */
    public function destroy(SiteForeground $siteforeground,$id=0)
    {
        $this->SystemAdminLog("Site Foreground","Destroy","Delete");

        $tab=SiteForeground::find($id);
        $tab->delete();
        return redirect('siteforeground')->with('status','Deleted Successfully !');}
}
