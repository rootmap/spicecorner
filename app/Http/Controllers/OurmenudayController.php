<?php

namespace App\Http\Controllers;

use App\OurMenuDay;
use App\AdminLog;
use Illuminate\Http\Request;

class OurMenuDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Our Menu Day";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=OurMenuDay::all();
        return view('admin.pages.ourmenuday.ourmenuday_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.ourmenuday.ourmenuday_create');
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
        //dd($request);
        $this->validate($request,[
                
                'name'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Our Menu Day","Save New","Create New");

        
        $tab=new OurMenuDay();
        
        $tab->name=$request->name;
        $tab->module_status=$request->module_status;
        $tab->opt_menu=json_encode($request->field_name);
        $tab->save();

        return redirect('ourmenuday')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new OurMenuDay();
        
        $tab->name=$request->name;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OurMenuDay  $ourmenuday
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
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
                            $query->orWhere('name','LIKE','%'.$search.'%');
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

    
    public function OurMenuDayQuery($request)
    {
        $OurMenuDay_data=OurMenuDay::orderBy('id','DESC')->get();

        return $OurMenuDay_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Name','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->OurMenuDayQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->name,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Our Menu Day Report',
            'report_title'=>'Our Menu Day Report',
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
                            <th class='text-center' style='font-size:12px;' >Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->OurMenuDayQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Our Menu Day Report',$html);


    }
    public function show(OurMenuDay $ourmenuday)
    {
        
        $tab=OurMenuDay::all();return view('admin.pages.ourmenuday.ourmenuday_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurMenuDay  $ourmenuday
     * @return \Illuminate\Http\Response
     */
    public function edit(OurMenuDay $ourmenuday,$id=0)
    {
        $tab=OurMenuDay::find($id);      
        return view('admin.pages.ourmenuday.ourmenuday_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurMenuDay  $ourmenuday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OurMenuDay $ourmenuday,$id=0)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Our Menu Day","Update","Edit / Modify");

        
        $tab=OurMenuDay::find($id);
        
        $tab->name=$request->name;
        $tab->opt_menu=json_encode($request->field_name);
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('ourmenuday')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurMenuDay  $ourmenuday
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurMenuDay $ourmenuday,$id=0)
    {
        $this->SystemAdminLog("Our Menu Day","Destroy","Delete");

        $tab=OurMenuDay::find($id);
        $tab->delete();
        return redirect('ourmenuday')->with('status','Deleted Successfully !');}
}
