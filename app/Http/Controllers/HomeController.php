<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteSettings;
use App\Slider;
use App\About;
use App\GalleryPhoto;
use App\OpeningHour;
use App\PrivacyCMS;
use App\MenuItem;
use App\Category;
use App\MenuCategory;
use App\TakewayCategory;
use App\OurMenuItem;
use App\TakewayMenuItem;
use App\DayWiseCategory;
use App\HomeDelivery;
use App\SiteForeground;
use App\ReservationInfo;
use App\TableBooking;
use App\OurMenuCategory;
use App\DayMenuItem;
use App\OurMenuDay;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    private $moduleName="Spicecorner";
    private $sdc;
    public function __construct(){ $this->sdc = new CoreCustomController(); }

    private function menuItm(){

        $SubCategory=OurMenuCategory::where('module_status','Active')->get();
        $subCat=[];
        foreach ($SubCategory as $key => $sc) {
            $MenuItem=DayMenuItem::where('category_id',$sc->id)->get();
            $mnt=[];
            foreach ($MenuItem as $key => $mn) {
                $mnt[]=['id'=>$mn->id,'name'=>$mn->name,'description'=>$mn->description,'price'=>$mn->price];
            }
            $subCat[]=['id'=>$sc->id,'name'=>$sc->name,'description'=>$sc->description,'mnitm'=>$mnt];
        }

        return $subCat;
    }

    private function takeawayMenu(){
        $SubCategory=TakewayCategory::select('id','name','description',\DB::Raw("(SELECT count(id) FROM takeway_menu_items WHERE category_id=takeway_categories.id AND deleted_at is null) as total_item"))->where('module_status','Active')->get();
        $subCat=[];
        foreach ($SubCategory as $key => $sc) {
            $MenuItem=TakewayMenuItem::where('category_id',$sc->id)->get();
            $mnt=[];
            foreach ($MenuItem as $key => $mn) {
                $mnt[]=['id'=>$mn->id,'name'=>$mn->name,'description'=>$mn->description,'price'=>$mn->price];
            }
            $subCat[]=['id'=>$sc->id,'name'=>$sc->name,'description'=>$sc->description,'total_item'=>$sc->total_item,'mnitm'=>$mnt];
        }

        return $subCat;
    }

    public function index()
    {
        $siteSetting=SiteSettings::orderBy('id','DESC')->first();
        $reservationInfo=ReservationInfo::orderBy('id','DESC')->first();
        $homeDelivery=HomeDelivery::orderBy('id','DESC')->first();
        $siteForeground=SiteForeground::orderBy('id','DESC')->first();
        $about=About::orderBy('id','DESC')->first();
        $slider=Slider::orderBy('id','ASC')->get();
        $category=Category::orderBy('id','ASC')->get();
        $GalleryPhoto=GalleryPhoto::orderBy('id','ASC')->take('8')->get();
        $openingHour=OpeningHour::orderBy('id','ASC')->get();
        $DayWiseCategory=OurMenuDay::select('id','name','opt_menu',\DB::Raw("(SELECT count(id) FROM day_menu_items WHERE day_id=our_menu_daies.id) as total_item"))->where('module_status','Active')->orderBy('id','ASC')->get();
        $OurMenuCategory=OurMenuCategory::select('id','description','name','day_id')->where('module_status','Active')->orderBy('id','ASC')->get();
        $DayMenuItem=DayMenuItem::where('module_status','Active')->orderBy('id','ASC')->get();
        
        //dd($DayWiseCategory);
        
        $firstDay=[];
        $subCat=[];
        $first_day_id=0;
        if(count($DayWiseCategory)>0)
        {
            $first_day_id=$DayWiseCategory[0]->id;
            if(count($OurMenuCategory)>0)
            {
                foreach ($OurMenuCategory as $key => $row) {
                    if($row->day_id==$first_day_id)
                    {

                        $mnitm=[];
                        if(count($DayMenuItem)>0)
                        {
                            foreach ($DayMenuItem as $kk => $item) {
                                if($item->day_id==$row->day_id && $item->category_id==$row->id)
                                {
                                    $mnitm[]=['id'=>$item->id,'name'=>$item->name,'price'=>$item->price,'description'=>$item->description];
                                }
                                
                            }
                        }

                        $subCat[]=[
                            'id'=>$row->id,
                            'name'=>$row->name,
                            'description'=>$row->description,
                            'mnitm'=>$mnitm,
                        ];
                    }
                    
                }
            }
        }

        $menuitm=[];

        $takeawayMenu=$this->takeawayMenu();
        //dd($takeawayMenu);
        $data=[
            'site'=>$siteSetting,
            'slider'=>$slider,
            'category'=>$category,
            'about'=>$about,
            'gallery'=>$GalleryPhoto,
            'openingHour'=>$openingHour,
            'menu_item'=>$menuitm,
            'takeawayMenu'=>$takeawayMenu,
            'dayWiseCategory'=>$DayWiseCategory,
            'firstDay'=>$subCat,
            'homeDelivery'=>$homeDelivery,
            'foreground'=>$siteForeground,
            'reservationInfo'=>$reservationInfo,
            'OurMenuCategory'=>$OurMenuCategory,
            'DayMenuItem'=>$DayMenuItem,
        ];
        return view('site.pages.index',$data);
    }


    public function privacy()
    {
        $category=Category::orderBy('id','ASC')->get();
        $siteSetting=SiteSettings::orderBy('id','DESC')->first();
        $privacy=PrivacyCMS::orderBy('id','DESC')->first();
        $data=['site'=>$siteSetting,'privacy'=>$privacy,'category'=>$category];
        return view('site.pages.privacy',$data);
    }


    public function gallery()
    {
        $GalleryPhoto=GalleryPhoto::orderBy('id','ASC')->get();
        $category=Category::orderBy('id','ASC')->get();
        $siteSetting=SiteSettings::orderBy('id','DESC')->first();
        $privacy=PrivacyCMS::orderBy('id','DESC')->first();
        $data=['site'=>$siteSetting,'privacy'=>$privacy,'gallery'=>$GalleryPhoto,'category'=>$category];
        return view('site.pages.gallery',$data);
    }

    public function savereservation(Request $request){
        
        $reservationInfo=ReservationInfo::orderBy('id','DESC')->first();
        
        $this->validate($request,[
                    
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'date'=>'required',
                'time'=>'required',
                'person'=>'required',
        ]);

        $emmail_message=$this->bookingTemplate($request);
        

        $this->sdc->initMail($request->email,
        'Online Reservation - '.$this->sdc->SiteName,
        $emmail_message);


        $this->sdc->initMail($reservationInfo->booking_admin_email,
        'Online Reservation - '.$this->sdc->SiteName,
        $emmail_message);

        //dd($emmail_message);

        $tab=new TableBooking();
        $tab->name=$request->name;
        $tab->email=$request->email;
        $tab->phone=$request->phone;
        $tab->date=$request->date;
        $tab->time=$request->time;
        $tab->person=$request->person;
        $tab->save();

        

        return redirect(url('/#Reservation'))->with('status',$reservationInfo->reservation_request_message);
    }

    private function bookingTemplate($request){


        $siteMessage='  <h2>
                            <strong><span style="color: #ff9900;">Online Reservation Info</span></strong>
                        </h2>

                        <table style="border: 2px solid #000000; width: 436px;">

                        <tbody>

                        <tr style="height: 32px;">

                        <td style="width: 184px; height: 32px;">Reservation Created</td>

                        <td style="width: 244px; height: 32px;">&nbsp;'.date('dS M Y, h:i A').'</td>

                        </tr>

                        <tr style="height: 46px;">

                        <td style="width: 428px; height: 46px;" colspan="2">

                        <h3 style="display: block; width: 80%; border-bottom: 3px #000 solid;"><strong>Reservation Detail</strong></h3>

                        </td>

                        </tr>

                        
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Name</td>

                        <td style="width: 244px; height: 18px;">'.$request->name.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Email</td>

                        <td style="width: 244px; height: 18px;">'.$request->email.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Phone</td>

                        <td style="width: 244px; height: 18px;">'.$request->phone.'</td>

                        </tr>
                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Date</td>

                        <td style="width: 244px; height: 18px;">'.$request->Date.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Time&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->time.'</td>

                        </tr>

                        <tr style="height: 18px;">

                        <td style="width: 184px; height: 18px;">&nbsp;Person&nbsp;</td>

                        <td style="width: 244px; height: 18px;">'.$request->person.'</td>

                        </tr>
                        </tbody>

                        </table>

                        <p>Kind Regards, '.$this->sdc->SiteName.'&nbsp;</p>

                        <p>&nbsp;</p>';

        return $siteMessage;
    }
}
