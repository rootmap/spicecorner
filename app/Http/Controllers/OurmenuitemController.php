<?php

namespace App\Http\Controllers;

use App\OurMenuItem;
use App\AdminLog;
use Illuminate\Http\Request;
use App\MenuCategory;
                

class OurMenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Our Menu Item";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=OurMenuItem::orderBy('id','DESC')->get();
        return view('admin.pages.ourmenuitem.ourmenuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tab_MenuCategory=MenuCategory::all();           
        return view('admin.pages.ourmenuitem.ourmenuitem_create',['dataRow_MenuCategory'=>$tab_MenuCategory]);
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

        $this->SystemAdminLog("Our Menu Item","Save New","Create New");

        
        $tab_0_MenuCategory=MenuCategory::where('id',$request->category_id)->first();
        $category_id_0_MenuCategory=$tab_0_MenuCategory->name;
        $tab=new OurMenuItem();
        
        $tab->category_id_name=$category_id_0_MenuCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('ourmenuitem')->with('status','Added Successfully !');

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

        $tab=new OurMenuItem();
        
        $tab->category_id_name=$category_id_0_MenuCategory;
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
     * @param  \App\OurMenuItem  $ourmenuitem
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

    
    public function OurMenuItemQuery($request)
    {
        $OurMenuItem_data=OurMenuItem::orderBy('id','DESC')->get();

        return $OurMenuItem_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Category ID','Name','Description','Price','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->OurMenuItemQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->category_id,$voi->name,$voi->description,$voi->price,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Our Menu Item Report',
            'report_title'=>'Our Menu Item Report',
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

                    $inv=$this->OurMenuItemQuery($request);
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

                $this->sdc->PDFLayout('Our Menu Item Report',$html);


    }
    public function show(OurMenuItem $ourmenuitem)
    {
        
        $tab=OurMenuItem::orderBy('id','DESC')->get();
        return view('admin.pages.ourmenuitem.ourmenuitem_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OurMenuItem  $ourmenuitem
     * @return \Illuminate\Http\Response
     */
    public function edit(OurMenuItem $ourmenuitem,$id=0)
    {
        $tab=OurMenuItem::find($id); 
        $tab_MenuCategory=MenuCategory::all();     
        return view('admin.pages.ourmenuitem.ourmenuitem_edit',['dataRow_MenuCategory'=>$tab_MenuCategory,'dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OurMenuItem  $ourmenuitem
     * @return \Illuminate\Http\Response
     */


    public function duplicate(Request $request,$id=0)
    {
        $tabs=OurMenuItem::find($id);  

        $tab=new OurMenuItem();        
        $tab->category_id_name=$tabs->category_id_name;
        $tab->category_id=$tabs->category_id;
        $tab->name=$tabs->name;
        $tab->description=$tabs->description;
        $tab->price=$tabs->price;
        $tab->module_status=$tabs->module_status;
        $tab->save();

        return redirect(url('ourmenuitem/edit/'.$tab->id))->with('status','Item Copied Successfully !');
    }

    public function update(Request $request, OurMenuItem $ourmenuitem,$id=0)
    {
        $this->validate($request,[
                
                'category_id'=>'required',
                'name'=>'required',
                'description'=>'required',
                'price'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Our Menu Item","Update","Edit / Modify");

        
        $tab_0_MenuCategory=MenuCategory::where('id',$request->category_id)->first();
        $category_id_0_MenuCategory=$tab_0_MenuCategory->name;
        $tab=OurMenuItem::find($id);
        
        $tab->category_id_name=$category_id_0_MenuCategory;
        $tab->category_id=$request->category_id;
        $tab->name=$request->name;
        $tab->description=$request->description;
        $tab->price=$request->price;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('ourmenuitem')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OurMenuItem  $ourmenuitem
     * @return \Illuminate\Http\Response
     */
    public function destroy(OurMenuItem $ourmenuitem,$id=0)
    {
        $this->SystemAdminLog("Our Menu Item","Destroy","Delete");

        $tab=OurMenuItem::find($id);
        $tab->delete();
        return redirect('ourmenuitem')->with('status','Deleted Successfully !');}
}
