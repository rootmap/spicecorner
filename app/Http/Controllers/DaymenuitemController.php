<?php

namespace App\Http\Controllers;

use App\DayMenuItem;
use App\AdminLog;
use Illuminate\Http\Request;
use App\OurMenuDay;
                
use App\OurMenuCategory;
                

class DayMenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Day Menu Item";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=DayMenuItem::orderBy('id','DESC')->get();
        return view('admin.pages.daymenuitem.daymenuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_OurMenuDay=OurMenuDay::all();
        $tab_OurMenuCategory=OurMenuCategory::all();           
        return view('admin.pages.daymenuitem.daymenuitem_create',['dataRow_OurMenuDay'=>$tab_OurMenuDay,'dataRow_OurMenuCategory'=>$tab_OurMenuCategory]);
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
                
                'day_id'=>'required',
                'category_id'=>'required',
                'name'=>'required',
                'price'=>'required',
   
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Day Menu Item","Save New","Create New");

        
        $tab_0_OurMenuDay=OurMenuDay::where('id',$request->day_id)->first();
        $day_id_0_OurMenuDay=$tab_0_OurMenuDay->name;
        $tab_1_OurMenuCategory=OurMenuCategory::where('id',$request->category_id)->first();
        $category_id_1_OurMenuCategory=$tab_1_OurMenuCategory->name;
        $tab=new DayMenuItem();
        
        $tab->day_id_name=$day_id_0_OurMenuDay;
        $tab->day_id=$request->day_id;
        $tab->category_id_name=$category_id_1_OurMenuCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->price=$request->price;
        $tab->description=$request->description;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('daymenuitem')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'day_id'=>'required',
                'category_id'=>'required',
                'name'=>'required',
                'price'=>'required',
                'description'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new DayMenuItem();
        
        $tab->day_id_name=$day_id_0_OurMenuDay;
        $tab->day_id=$request->day_id;
        $tab->category_id_name=$category_id_1_OurMenuCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->price=$request->price;
        $tab->description=$request->description;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DayMenuItem  $daymenuitem
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('day_id','LIKE','%'.$search.'%');
                            $query->orWhere('category_id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('description','LIKE','%'.$search.'%');
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
                            $query->orWhere('day_id','LIKE','%'.$search.'%');
                            $query->orWhere('category_id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
                            $query->orWhere('description','LIKE','%'.$search.'%');
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

    
    public function DayMenuItemQuery($request)
    {
        $DayMenuItem_data=DayMenuItem::orderBy('id','DESC')->get();

        return $DayMenuItem_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Day ID','Category ID','Name','Price','Description','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->DayMenuItemQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->day_id,$voi->category_id,$voi->name,$voi->price,$voi->description,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Day Menu Item Report',
            'report_title'=>'Day Menu Item Report',
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
                            <th class='text-center' style='font-size:12px;' >Day ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Category ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->DayMenuItemQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->day_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->category_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Day Menu Item Report',$html);


    }
    public function show(DayMenuItem $daymenuitem)
    {
        
        $tab=DayMenuItem::orderBy('id','DESC')->get();
        
        return view('admin.pages.daymenuitem.daymenuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DayMenuItem  $daymenuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(DayMenuItem $daymenuitem,$id=0)
    {
        $tab=DayMenuItem::find($id); 
        $tab_OurMenuDay=OurMenuDay::all();
        $tab_OurMenuCategory=OurMenuCategory::all();     
        return view('admin.pages.daymenuitem.daymenuitem_edit',['dataRow_OurMenuDay'=>$tab_OurMenuDay,'dataRow_OurMenuCategory'=>$tab_OurMenuCategory,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DayMenuItem  $daymenuitem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DayMenuItem $daymenuitem,$id=0)
    {
        $this->validate($request,[
                
                'day_id'=>'required',
                'category_id'=>'required',
                'name'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Day Menu Item","Update","Edit / Modify");

        
        $tab_0_OurMenuDay=OurMenuDay::where('id',$request->day_id)->first();
        $day_id_0_OurMenuDay=$tab_0_OurMenuDay->name;
        $tab_1_OurMenuCategory=OurMenuCategory::where('id',$request->category_id)->first();
        $category_id_1_OurMenuCategory=$tab_1_OurMenuCategory->name;

        $tab=DayMenuItem::find($id);
        $tab->day_id_name=$day_id_0_OurMenuDay;
        $tab->day_id=$request->day_id;
        $tab->category_id_name=$category_id_1_OurMenuCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->price=$request->price;
        $tab->description=$request->description;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('daymenuitem')->with('status','Updated Successfully !');
    }

    public function duplicate(Request $request, DayMenuItem $daymenuitem,$id=0)
    {
        
        $tabs=DayMenuItem::find($id);

        $tab=new DayMenuItem();
        $tab->day_id_name=$tabs->day_id_name;
        $tab->day_id=$tabs->day_id;
        $tab->category_id_name=$tabs->category_id_name;
        $tab->category_id=$tabs->category_id;
        $tab->name=$tabs->name;
        $tab->price=$tabs->price;
        $tab->description=$tabs->description;
        $tab->module_status=$tabs->module_status;
        $tab->save();

        return redirect(url('daymenuitem/edit/'.$tab->id))->with('status','Copied Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DayMenuItem  $daymenuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(DayMenuItem $daymenuitem,$id=0)
    {
        $this->SystemAdminLog("Day Menu Item","Destroy","Delete");

        $tab=DayMenuItem::find($id);
        $tab->delete();
        return redirect('daymenuitem')->with('status','Deleted Successfully !');}
}
