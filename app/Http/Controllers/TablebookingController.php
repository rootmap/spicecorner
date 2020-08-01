<?php

namespace App\Http\Controllers;

use App\TableBooking;
use App\AdminLog;
use Illuminate\Http\Request;

class TableBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Table Booking";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=TableBooking::all();
        return view('admin.pages.tablebooking.tablebooking_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.tablebooking.tablebooking_create');
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
                
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'date'=>'required',
                'time'=>'required',
                'person'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Table Booking","Save New","Create New");

        
        $tab=new TableBooking();
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->phone=$request->phone;
        $tab->date=$request->date;
        $tab->time=$request->time;
        $tab->person=$request->person;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('tablebooking')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'date'=>'required',
                'time'=>'required',
                'person'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new TableBooking();
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->phone=$request->phone;
        $tab->date=$request->date;
        $tab->time=$request->time;
        $tab->person=$request->person;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TableBooking  $tablebooking
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('name','LIKE','%'.$search.'%');
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('phone','LIKE','%'.$search.'%');
                            $query->orWhere('date','LIKE','%'.$search.'%');
                            $query->orWhere('time','LIKE','%'.$search.'%');
                            $query->orWhere('person','LIKE','%'.$search.'%');
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
                            $query->orWhere('email','LIKE','%'.$search.'%');
                            $query->orWhere('phone','LIKE','%'.$search.'%');
                            $query->orWhere('date','LIKE','%'.$search.'%');
                            $query->orWhere('time','LIKE','%'.$search.'%');
                            $query->orWhere('person','LIKE','%'.$search.'%');
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

    
    public function TableBookingQuery($request)
    {
        $TableBooking_data=TableBooking::orderBy('id','DESC')->get();

        return $TableBooking_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Name','Email','Phone','Date','Time','Person','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->TableBookingQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->name,$voi->email,$voi->phone,$voi->date,$voi->time,$voi->person,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Table Booking Report',
            'report_title'=>'Table Booking Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Phone</th>
                        
                            <th class='text-center' style='font-size:12px;' >Date</th>
                        
                            <th class='text-center' style='font-size:12px;' >Time</th>
                        
                            <th class='text-center' style='font-size:12px;' >Person</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->TableBookingQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->name."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->phone."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->date."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->time."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->person."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Table Booking Report',$html);


    }
    public function show(TableBooking $tablebooking)
    {
        
        $tab=TableBooking::all();return view('admin.pages.tablebooking.tablebooking_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TableBooking  $tablebooking
     * @return \Illuminate\Http\Response
     */
    public function edit(TableBooking $tablebooking,$id=0)
    {
        $tab=TableBooking::find($id);      
        return view('admin.pages.tablebooking.tablebooking_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TableBooking  $tablebooking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TableBooking $tablebooking,$id=0)
    {
        $this->validate($request,[
                
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'date'=>'required',
                'time'=>'required',
                'person'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Table Booking","Update","Edit / Modify");

        
        $tab=TableBooking::find($id);
        
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->phone=$request->phone;
        $tab->date=$request->date;
        $tab->time=$request->time;
        $tab->person=$request->person;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('tablebooking')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TableBooking  $tablebooking
     * @return \Illuminate\Http\Response
     */
    public function destroy(TableBooking $tablebooking,$id=0)
    {
        $this->SystemAdminLog("Table Booking","Destroy","Delete");

        $tab=TableBooking::find($id);
        $tab->delete();
        return redirect('tablebooking')->with('status','Deleted Successfully !');}
}
