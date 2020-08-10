<?php

namespace App\Http\Controllers;

use App\ReservationInfo;
use App\AdminLog;
use Illuminate\Http\Request;

class ReservationInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Reservation Info";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=ReservationInfo::count();
        if($tabCount==0)
        {
            return redirect(url('reservationinfo/create'));
        }else{

            $tab=ReservationInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.reservationinfo.reservationinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=ReservationInfo::count();
        if($tabCount==0)
        {            
        return view('admin.pages.reservationinfo.reservationinfo_create');
            
        }else{

            $tab=ReservationInfo::orderBy('id','DESC')->first();      
        return view('admin.pages.reservationinfo.reservationinfo_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                
                'opening_hour_title'=>'required',
                'reservation_title'=>'required',
                'booking_admin_email'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Reservation Info","Save New","Create New");

        
        $tab=new ReservationInfo();
        
        $tab->opening_hour_title=$request->opening_hour_title;
        $tab->reservation_title=$request->reservation_title;
        $tab->booking_admin_email=$request->booking_admin_email;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('reservationinfo')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'opening_hour_title'=>'required',
                'reservation_title'=>'required',
                'booking_admin_email'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new ReservationInfo();
        
        $tab->opening_hour_title=$request->opening_hour_title;
        $tab->reservation_title=$request->reservation_title;
        $tab->booking_admin_email=$request->booking_admin_email;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReservationInfo  $reservationinfo
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('opening_hour_title','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_title','LIKE','%'.$search.'%');
                            $query->orWhere('booking_admin_email','LIKE','%'.$search.'%');
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
                            $query->orWhere('opening_hour_title','LIKE','%'.$search.'%');
                            $query->orWhere('reservation_title','LIKE','%'.$search.'%');
                            $query->orWhere('booking_admin_email','LIKE','%'.$search.'%');
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

    
    public function ReservationInfoQuery($request)
    {
        $ReservationInfo_data=ReservationInfo::orderBy('id','DESC')->get();

        return $ReservationInfo_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Opening Hour Title','Reservation Title','Booking Admin Email','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->ReservationInfoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->opening_hour_title,$voi->reservation_title,$voi->booking_admin_email,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Reservation Info Report',
            'report_title'=>'Reservation Info Report',
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
                            <th class='text-center' style='font-size:12px;' >Opening Hour Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Reservation Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Booking Admin Email</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->ReservationInfoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->opening_hour_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->reservation_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->booking_admin_email."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Reservation Info Report',$html);


    }
    public function show(ReservationInfo $reservationinfo)
    {
        
        $tab=ReservationInfo::all();return view('admin.pages.reservationinfo.reservationinfo_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservationInfo  $reservationinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservationInfo $reservationinfo,$id=0)
    {
        $tab=ReservationInfo::find($id);      
        return view('admin.pages.reservationinfo.reservationinfo_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservationInfo  $reservationinfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservationInfo $reservationinfo,$id=0)
    {
        $this->validate($request,[
                
                'opening_hour_title'=>'required',
                'reservation_title'=>'required',
                'booking_admin_email'=>'required',
                'booking_max_person'=>'required',
                'booking_min_frame'=>'required',
                'reservation_request_message'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Reservation Info","Update","Edit / Modify");

        
        $tab=ReservationInfo::find($id);
        
        $tab->opening_hour_title=$request->opening_hour_title;
        $tab->reservation_title=$request->reservation_title;
        $tab->booking_admin_email=$request->booking_admin_email;
        $tab->booking_max_person=$request->booking_max_person;
        $tab->booking_min_frame=$request->booking_min_frame;
        $tab->reservation_request_message=$request->reservation_request_message;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('reservationinfo')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservationInfo  $reservationinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservationInfo $reservationinfo,$id=0)
    {
        $this->SystemAdminLog("Reservation Info","Destroy","Delete");

        $tab=ReservationInfo::find($id);
        $tab->delete();
        return redirect('reservationinfo')->with('status','Deleted Successfully !');}
}
