<?php

namespace App\Http\Controllers;

use App\About;
use App\AdminLog;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="About";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tabCount=About::count();
        if($tabCount==0)
        {
            return redirect(url('about/create'));
        }else{

            $tab=About::orderBy('id','DESC')->first();      
        return view('admin.pages.about.about_edit',['dataRow'=>$tab,'edit'=>true]); 
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


        
        $tabCount=About::count();
        if($tabCount==0)
        {            
        return view('admin.pages.about.about_create');
            
        }else{

            $tab=About::orderBy('id','DESC')->first();      
        return view('admin.pages.about.about_edit',['dataRow'=>$tab,'edit'=>true]); 
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
                'image'=>'required',
                'description'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("About","Save New","Create New");

        

        $filename_about_2='';
        if ($request->hasFile('image')) {
            $img_about = $request->file('image');
            $upload_about = 'upload/about';
            $filename_about_2 = env('APP_NAME').'_'.time() . '.' . $img_about->getClientOriginalExtension();
            $img_about->move($upload_about, $filename_about_2);
        }

                
        $tab=new About();
        
        $tab->title=$request->title;
        $tab->sub_title=$request->sub_title;
        $tab->image=$filename_about_2;
        $tab->description=$request->description;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('about')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'title'=>'required',
                'sub_title'=>'required',
                'image'=>'required',
                'description'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new About();
        
        $tab->title=$request->title;
        $tab->sub_title=$request->sub_title;
        $tab->image=$filename_about_2;
        $tab->description=$request->description;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('title','LIKE','%'.$search.'%');
                            $query->orWhere('sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('image','LIKE','%'.$search.'%');
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
                            $query->orWhere('title','LIKE','%'.$search.'%');
                            $query->orWhere('sub_title','LIKE','%'.$search.'%');
                            $query->orWhere('image','LIKE','%'.$search.'%');
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

    
    public function AboutQuery($request)
    {
        $About_data=About::orderBy('id','DESC')->get();

        return $About_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Title','Sub Title','Image','Description','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->AboutQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->title,$voi->sub_title,$voi->image,$voi->description,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'About Report',
            'report_title'=>'About Report',
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
                        
                            <th class='text-center' style='font-size:12px;' >Image</th>
                        
                            <th class='text-center' style='font-size:12px;' >Description</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->AboutQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->sub_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->image."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->description."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('About Report',$html);


    }
    public function show(About $about)
    {
        
        $tab=About::all();return view('admin.pages.about.about_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about,$id=0)
    {
        $tab=About::find($id);      
        return view('admin.pages.about.about_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about,$id=0)
    {
        $this->validate($request,[
                
                'title'=>'required',
                'sub_title'=>'required',
                'description'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("About","Update","Edit / Modify");

        

        $filename_about_2=$request->ex_image;
        if ($request->hasFile('image')) {
            $img_about = $request->file('image');
            $upload_about = 'upload/about';
            $filename_about_2 = env('APP_NAME').'_'.time() . '.' . $img_about->getClientOriginalExtension();
            $img_about->move($upload_about, $filename_about_2);
        }

                
        $tab=About::find($id);
        
        $tab->title=$request->title;
        $tab->sub_title=$request->sub_title;
        $tab->image=$filename_about_2;
        $tab->description=$request->description;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('about')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about,$id=0)
    {
        $this->SystemAdminLog("About","Destroy","Delete");

        $tab=About::find($id);
        $tab->delete();
        return redirect('about')->with('status','Deleted Successfully !');}
}
