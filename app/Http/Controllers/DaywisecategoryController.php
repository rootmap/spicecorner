<?php

namespace App\Http\Controllers;

use App\DayWiseCategory;
use App\AdminLog;
use Illuminate\Http\Request;
use App\MenuCategory;
                

class DayWiseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Day Wise Category";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=DayWiseCategory::all();
        return view('admin.pages.daywisecategory.daywisecategory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_MenuCategory=MenuCategory::all();           
        return view('admin.pages.daywisecategory.daywisecategory_create',['dataRow_MenuCategory'=>$tab_MenuCategory]);
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
                
                'day_name'=>'required|unique:day_wise_categories',
                'module_status'=>'required',
        ]);

        $categories=[];
        if(isset($request->ind_check))
        {
            foreach ($request->ind_check as $key => $value) {
                $categories[]=$value;
            }
        }


        $this->SystemAdminLog("Day Wise Category","Save New","Create New");

        $tab=new DayWiseCategory();        
        $tab->day_name=$request->day_name;
        $tab->category_id_name=count($categories)." Categories";
        $tab->category_id=json_encode($categories);
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('daywisecategory')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'day_name'=>'required',
                'category_id'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new DayWiseCategory();
        
        $tab->day_name=$request->day_name;
        $tab->category_id_name=$category_id_1_MenuCategory;
        $tab->category_id=$request->category_id;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DayWiseCategory  $daywisecategory
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('day_name','LIKE','%'.$search.'%');
                            $query->orWhere('category_id','LIKE','%'.$search.'%');
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
                            $query->orWhere('day_name','LIKE','%'.$search.'%');
                            $query->orWhere('category_id','LIKE','%'.$search.'%');
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

    
    public function DayWiseCategoryQuery($request)
    {
        $DayWiseCategory_data=DayWiseCategory::orderBy('id','DESC')->get();

        return $DayWiseCategory_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Day Name','Category ID','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->DayWiseCategoryQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->day_name,$voi->category_id,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Day Wise Category Report',
            'report_title'=>'Day Wise Category Report',
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
                            <th class='text-center' style='font-size:12px;' >Day Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Category ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->DayWiseCategoryQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->day_name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->category_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Day Wise Category Report',$html);


    }
    public function show(DayWiseCategory $daywisecategory)
    {
        
        $tab=DayWiseCategory::all();return view('admin.pages.daywisecategory.daywisecategory_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DayWiseCategory  $daywisecategory
     * @return \Illuminate\Http\Response
     */
    public function edit(DayWiseCategory $daywisecategory,$id=0)
    {
        $tab=DayWiseCategory::find($id); 
        $tab_MenuCategory=MenuCategory::all();     
        return view('admin.pages.daywisecategory.daywisecategory_edit',['dataRow_MenuCategory'=>$tab_MenuCategory,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DayWiseCategory  $daywisecategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayWiseCategory $daywisecategory,$id=0)
    {
        $this->validate($request,[
                
                'day_name'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Day Wise Category","Update","Edit / Modify");

        $categories=[];
        if(isset($request->ind_check))
        {
            foreach ($request->ind_check as $key => $value) {
                $categories[]=$value;
            }
        }

        $tab=DayWiseCategory::find($id);
        
        $tab->day_name=$request->day_name;
        $tab->category_id_name=count($categories)." Categories";
        $tab->category_id=json_encode($categories);
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('daywisecategory')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DayWiseCategory  $daywisecategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayWiseCategory $daywisecategory,$id=0)
    {
        $this->SystemAdminLog("Day Wise Category","Destroy","Delete");

        $tab=DayWiseCategory::find($id);
        $tab->delete();
        return redirect('daywisecategory')->with('status','Deleted Successfully !');}
}
