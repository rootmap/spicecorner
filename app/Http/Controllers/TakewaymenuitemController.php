<?php

namespace App\Http\Controllers;

use App\TakewayMenuItem;
use App\AdminLog;
use Illuminate\Http\Request;
use App\TakewayCategory;
                

class TakewayMenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Takeway Menu Item";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=TakewayMenuItem::orderBy('id','DESC')->get();
        return view('admin.pages.takewaymenuitem.takewaymenuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_TakewayCategory=TakewayCategory::all();           
        return view('admin.pages.takewaymenuitem.takewaymenuitem_create',['dataRow_TakewayCategory'=>$tab_TakewayCategory]);
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
                
                'category_id'=>'required',
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Takeway Menu Item","Save New","Create New");

        
        $tab_0_TakewayCategory=TakewayCategory::where('id',$request->category_id)->first();
        $category_id_0_TakewayCategory=$tab_0_TakewayCategory->name;
        $tab=new TakewayMenuItem();
        
        $tab->category_id_name=$category_id_0_TakewayCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('takewaymenuitem')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'category_id'=>'required',
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new TakewayMenuItem();
        
        $tab->category_id_name=$category_id_0_TakewayCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TakewayMenuItem  $takewaymenuitem
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('category_id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('description','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
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
                            $query->orWhere('category_id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('description','LIKE','%'.$search.'%');
                            $query->orWhere('price','LIKE','%'.$search.'%');
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

    
    public function TakewayMenuItemQuery($request)
    {
        $TakewayMenuItem_data=TakewayMenuItem::orderBy('id','DESC')->get();

        return $TakewayMenuItem_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Category ID','Name','Description','Price','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->TakewayMenuItemQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->category_id,$voi->name,$voi->description,$voi->price,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Takeway Menu Item Report',
            'report_title'=>'Takeway Menu Item Report',
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
                            <th class='text-center' style='font-size:12px;' >Category ID</th>
                        
                            <th class='text-center' style='font-size:12px;' >Name</th>
                        
                            <th class='text-center' style='font-size:12px;' >Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Price</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->TakewayMenuItemQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->category_id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->price."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Takeway Menu Item Report',$html);


    }
    public function show(TakewayMenuItem $takewaymenuitem)
    {
        
        $tab=TakewayMenuItem::orderBy('id','DESC')->get();
        return view('admin.pages.takewaymenuitem.takewaymenuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TakewayMenuItem  $takewaymenuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(TakewayMenuItem $takewaymenuitem,$id=0)
    {
        $tab=TakewayMenuItem::find($id); 
        $tab_TakewayCategory=TakewayCategory::all();     
        return view('admin.pages.takewaymenuitem.takewaymenuitem_edit',['dataRow_TakewayCategory'=>$tab_TakewayCategory,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TakewayMenuItem  $takewaymenuitem
     * @return \Illuminate\Http\Response
     */
    public function duplicate(Request $request,$id=0)
    {
        $tabs=TakewayMenuItem::find($id);  

        $tab=new TakewayMenuItem();        
        $tab->category_id_name=$tabs->category_id_name;
        $tab->category_id=$tabs->category_id;
        $tab->name=$tabs->name;
        $tab->description=$tabs->description;
        $tab->price=$tabs->price;
        $tab->module_status=$tabs->module_status;
        $tab->save();

        return redirect(url('takewaymenuitem/edit/'.$tab->id))->with('status','Item Copied Successfully !');
    }
    

    public function update(Request $request, TakewayMenuItem $takewaymenuitem,$id=0)
    {
        $this->validate($request,[
                
                'category_id'=>'required',
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Takeway Menu Item","Update","Edit / Modify");

        
        $tab_0_TakewayCategory=TakewayCategory::where('id',$request->category_id)->first();
        $category_id_0_TakewayCategory=$tab_0_TakewayCategory->name;
        $tab=TakewayMenuItem::find($id);
        
        $tab->category_id_name=$category_id_0_TakewayCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('takewaymenuitem')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TakewayMenuItem  $takewaymenuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(TakewayMenuItem $takewaymenuitem,$id=0)
    {
        $this->SystemAdminLog("Takeway Menu Item","Destroy","Delete");

        $tab=TakewayMenuItem::find($id);
        $tab->delete();
        return redirect('takewaymenuitem')->with('status','Deleted Successfully !');}
}
