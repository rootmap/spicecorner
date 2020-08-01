<?php

namespace App\Http\Controllers;

use App\GalleryPhoto;
use App\AdminLog;
use Illuminate\Http\Request;

class GalleryPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Gallery Photo";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }
    
    public function index(){
        $tab=GalleryPhoto::all();
        return view('admin.pages.galleryphoto.galleryphoto_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){


                   
        return view('admin.pages.galleryphoto.galleryphoto_create');
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

    private function resize_crop_image($max_width, $max_height, $source_file, $dst_dir, $quality = 80){
        $imgsize = getimagesize($source_file);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];

        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;

            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;

            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;

            default:
                return false;
                break;
        }

        $dst_img = imagecreatetruecolor($max_width, $max_height);
        $src_img = $image_create($source_file);

        $width_new = $height * $max_width / $max_height;
        $height_new = $width * $max_height / $max_width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
        }

        $image($dst_img, $dst_dir, $quality);

        if($dst_img)imagedestroy($dst_img);
        if($src_img)imagedestroy($src_img);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
                
                'photo_title'=>'required',
                'photo'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Gallery Photo","Save New","Create New");

        

        $filename_galleryphoto_1='';
        if ($request->hasFile('photo')) {
            $img_galleryphoto = $request->file('photo');
            $upload_galleryphoto = 'upload/galleryphoto';
            $filename_galleryphoto_1 = env('APP_NAME').'_'.time() . '.' . $img_galleryphoto->getClientOriginalExtension();
            $img_galleryphoto->move($upload_galleryphoto, $filename_galleryphoto_1);

            $this->resize_crop_image(270, 360, $upload_galleryphoto.'/'.$filename_galleryphoto_1, $upload_galleryphoto.'/small/'.$filename_galleryphoto_1);
        }

                
        $tab=new GalleryPhoto();
        
        $tab->photo_title=$request->photo_title;
        $tab->photo=$filename_galleryphoto_1;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('galleryphoto')->with('status','Added Successfully !');

    }

    public function ajax(Request $request)
    {
        $this->validate($request,[
                
                'photo_title'=>'required',
                'photo'=>'required',
                'module_status'=>'required',
        ]);

        $tab=new GalleryPhoto();
        
        $tab->photo_title=$request->photo_title;
        $tab->photo=$filename_galleryphoto_1;
        $tab->module_status=$request->module_status;
        $tab->save();

        echo json_encode(array("status"=>"success","msg"=>"Added Successfully."));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GalleryPhoto  $galleryphoto
     * @return \Illuminate\Http\Response
     */

    private function methodToGetMembersCount($search=""){

        $tab=Customer::select('id','name','address','phone','email','last_invoice_no','created_at')
                     ->where('store_id',$this->sdc->storeID())->orderBy('id','DESC')
                     ->when($search, function ($query) use ($search) {
                        $query->where('id','LIKE','%'.$search.'%');
                            $query->orWhere('photo_title','LIKE','%'.$search.'%');
                            $query->orWhere('photo','LIKE','%'.$search.'%');
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
                            $query->orWhere('photo_title','LIKE','%'.$search.'%');
                            $query->orWhere('photo','LIKE','%'.$search.'%');
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

    
    public function GalleryPhotoQuery($request)
    {
        $GalleryPhoto_data=GalleryPhoto::orderBy('id','DESC')->get();

        return $GalleryPhoto_data;
    }
    
   

    public function ExportExcel(Request $request) 
    {
         $dataDateTimeIns=formatDateTime(date('d-M-Y H:i:s a'));
        $data=array();
        $array_column=array(
                                'ID','Photo Title','Photo','Module Status','Created Date');
        array_push($data, $array_column);
        $inv=$this->GalleryPhotoQuery($request);
        foreach($inv as $voi):
            $inv_arry=array(
                                $voi->id,$voi->photo_title,$voi->photo,$voi->module_status,formatDate($voi->created_at));
            array_push($data, $inv_arry);
        endforeach;

        $excelArray=array(
            'report_name'=>'Gallery Photo Report',
            'report_title'=>'Gallery Photo Report',
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
                            <th class='text-center' style='font-size:12px;' >Photo Title</th>
                        
                            <th class='text-center' style='font-size:12px;' >Photo</th>
                        
                            <th class='text-center' style='font-size:12px;' >Module Status</th>
                        
                <th class='text-center' style='font-size:12px;'>Created Date</th>
                </tr>
                </thead>
                <tbody>";

                    $inv=$this->GalleryPhotoQuery($request);
                    foreach($inv as $voi):
                        $html .="<tr>
                        <td style='font-size:12px;' class='text-center'>".$voi->id."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->photo_title."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->photo."</td>
                        <td style='font-size:12px;' class='text-center'>".$voi->module_status."</td>
                        <td style='font-size:12px; text-align:center;' class='text-center'>".formatDate($voi->created_at)."</td>
                        </tr>";

                    endforeach;


                $html .="</tbody>
                
                </table>


                ";

                $this->sdc->PDFLayout('Gallery Photo Report',$html);


    }
    public function show(GalleryPhoto $galleryphoto)
    {
        
        $tab=GalleryPhoto::all();return view('admin.pages.galleryphoto.galleryphoto_list',['dataRow'=>$tab]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GalleryPhoto  $galleryphoto
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryPhoto $galleryphoto,$id=0)
    {
        $tab=GalleryPhoto::find($id);      
        return view('admin.pages.galleryphoto.galleryphoto_edit',['dataRow'=>$tab,'edit'=>true]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GalleryPhoto  $galleryphoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryPhoto $galleryphoto,$id=0)
    {
        $this->validate($request,[
                
                'photo_title'=>'required',
                'module_status'=>'required',
        ]);

        $this->SystemAdminLog("Gallery Photo","Update","Edit / Modify");

        

        $filename_galleryphoto_1=$request->ex_photo;
        if ($request->hasFile('photo')) {
            $img_galleryphoto = $request->file('photo');
            $upload_galleryphoto = 'upload/galleryphoto';
            $filename_galleryphoto_1 = env('APP_NAME').'_'.time() . '.' . $img_galleryphoto->getClientOriginalExtension();
            $img_galleryphoto->move($upload_galleryphoto, $filename_galleryphoto_1);

            $this->resize_crop_image(270, 360, $upload_galleryphoto.'/'.$filename_galleryphoto_1, $upload_galleryphoto.'/small/'.$filename_galleryphoto_1);
        }

                
        $tab=GalleryPhoto::find($id);
        
        $tab->photo_title=$request->photo_title;
        $tab->photo=$filename_galleryphoto_1;
        $tab->module_status=$request->module_status;
        $tab->save();

        return redirect('galleryphoto')->with('status','Updated Successfully !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GalleryPhoto  $galleryphoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryPhoto $galleryphoto,$id=0)
    {
        $this->SystemAdminLog("Gallery Photo","Destroy","Delete");

        $tab=GalleryPhoto::find($id);
        $tab->delete();
        return redirect('galleryphoto')->with('status','Deleted Successfully !');}
}
