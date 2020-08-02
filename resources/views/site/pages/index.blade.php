@extends('site.layout.master')
@section('slider')
{{-- var(--my-slider-back); --}}
    @isset($slider)
    <div class="camera-wrapper" style="--var-camera_overlayer:url('{{asset('upload/sitesettings/'.$site->slider_logo)}}') no-repeat center center;">
        <div id="camera" class="camera-wrap">
            
                @foreach ($slider as $item)
                <div data-src="{{asset('upload/slider/'.$item->photo)}}" data-title="{{$item->photo_title}}"></div>
                @endforeach
            
        </div>
    </div>
    @endisset
@endsection
@section('content')
<section id="content">
    @isset($about)
    
    <div class="container well" id="about" style="padding-top: 95px;">
        <div class="row">
            <div class="grid_12">
                <h2 class="hdng">
                    {{$about->title}}
                    <span>{{$about->sub_title}}</span>
                </h2>
            </div>
        </div>
    
        <div class="box1 box1__off1 row">
            <div class="img-wrap grid_6">
                <img src="{{asset('upload/about/'.$about->image)}}" alt="{{$about->title}}"/>
            </div>
            <div class="grid_6">
                <div class="box1_cnt box1__ins2 ta__c" style="padding-top: 20px;">
                    <p align="justify" style="font-family: 'Roboto Slab', serif;">
                        {{$about->description}}
                    </p>
                </div>
            </div>
        </div>
    </div>
        
    @endisset

    <style type="text/css">
        .om_menu_item_detail
        {
            font-family: 'Roboto', sans-serif;
            font-weight: 300;
            font-size: 14px;
            text-transform: capitalize;
            padding-right: 70px;
            color: rgb(0,0,0);
            text-align: left;
        }
    </style>

    <style type="text/css">
        .omg_title{
            font-family: 'Roboto', sans-serif; 
                font-weight: 500; 
                font-size: 16px; 
                text-transform: capitalize; 
                text-align: left;
            
        }

        .omg_title::after{
            content: var(--var-omg-price);
            position: relative;
            text-align: right;
            float: right;
            color:#950F24;
        }

        .omg_heading{
            color:#950F24; 
                font-weight: 500; 
                font-size: 18px; 
                font-family: 'Roboto', sans-serif; 
                text-transform: capitalize; 
                text-align: left;
                text-decoration: none;
                transition: font-size 2s;
                padding-bottom: 10px;
        }
    </style>


    @isset($site->our_menu_module_status)
        @if($site->our_menu_module_status=="Active")
            <div class="stellar-section" id="menu" style="--var-ourmenu-foreground:url('{{asset('upload/siteforeground/'.$foreground->our_menu)}}');">
                <div class="stellar-block stellar1 ta__c" style="padding-top: 100px;">
                    <div class="container">
                        <div class="row">
                            <div class="grid_12">
                                <h2 class="hdng__off2">
                                    Our 
                                    <span>Menu</span>
                                </h2>
                            </div>
                        </div>
        
                        <div class="row">
                            <div class="grid_12 ta__c">
                                @isset($dayWiseCategory)
                                <ul id="filters" class="isotope-list">
                                    @foreach ($dayWiseCategory as $key=>$item)
                                        <li class="{{$key==0?'active':''}}">
                                            <a href="javascript:void(0);"  data-filter="{{$item->id}}" class="loadom{{$key==0?' first_day_load':''}}" style="color: #000;">{{$item->name}} </a>
                                        </li>   
                                    @endforeach
                                </ul>
                                @endisset
        
                                
                                <div class="container" id="daywiseMenuItem">
                                    @isset($firstDay)
                                        @foreach ($firstDay as $key=>$item)
                                        <div class="row">
                                            <div class="grid_12">
                                                <div class="box2 box2__off1" style="margin-bottom: 0px;">
                                                    <h4 class="omg_heading">{{$item['name']}}</h4>                                    
                                                </div>
                                            </div>
                                            @foreach($item['mnitm'] as $k=>$row)
                                            <div class="grid_6">
                                                <div class="box2 box2__off1" style="margin-bottom: 15px;">
                                                    <h4 class="omg_title" style="--var-omg-price:'{{$row['price']}}'">{{$k+1}}. {{$row['name']}}</h4>
                                                    <p class="om_menu_item_detail" style="margin-top: 0px;">{{$row['description']}}</p>
                                                    
                                                </div>
                                            </div>
                                            @endforeach        
                                        </div>
                                        @endforeach
                                    @endisset
                                    
                                </div>
                                
                            </div>
                        </div>
        
                            
                    </div>
                </div>
            </div>
        @endif
    @endisset
    

    @isset($site->takeway_menu_module_status)
    @if($site->takeway_menu_module_status=="Active")
        <div class="container well well__ins8" id="takeaway" style="padding-top: 95px;">
            <div class="row">
                <div class="grid_12">
                    <h2 class="hdng__off2">
                        Takeway
                        <span>Menu</span>
                    </h2>
                </div>
            </div>

            <style type="text/css">
                .tw_menu{ 
                    color:#950F24; 
                    font-weight: 500; 
                    font-size: 18px; 
                    font-family: 'Roboto', sans-serif; 
                    text-transform: capitalize; 
                    text-align: left;
                    text-decoration: none;
                    transition: font-size 2s;
                }

                .tw_menu:hover
                {
                    text-decoration: none;
                    color:rgb(122,15,32); 
                    border-bottom: 1px #950F24 solid;
                    font-size: 21px;
                }

                .tw_menu_active{ 
                    color:rgb(122,15,32); 
                    border-bottom: 1px #950F24 solid;
                }

                .om_title{
                    font-family: 'Roboto', sans-serif; 
                    font-weight: 500; 
                    font-size: 16px; 
                    text-transform: capitalize; 
                    text-align: left;
                }

                .tw{ border-right:1px #ccc inset; margin-left:-1px; }
            </style>
    
            <div class="row">
                <div class="grid_4 tw">
                    @isset($takeawayMenu)
                        @foreach ($takeawayMenu as $key=>$item)
                        <div class="box2 box2__off1" style="margin-bottom: 12px;">
                            <a href="javascript:void(0);" data-id="{{$item['id']}}" style=" " class="tw_menu {{$key==0?'tw_menu_active':''}}"> <i class="fa fa-bolt" aria-hidden="true"></i> &nbsp;&nbsp; {{$item['name']}}</a>                                    
                        </div>
                        @endforeach
                    @endisset
                    
                    
                </div>
                <div class="grid_8">
                    <section id="content">
                        <style type="text/css">
                                    

                            .om_title::after{
                                content: var(--var-mt-price);
                                position: relative;
                                text-align: right;
                                float: right;
                                color:#950F24;
                            }

                            .tw_menu_item_detail{
                                font-family: 'Roboto', sans-serif;
                                font-weight: 300;
                                font-size: 14px;
                                text-transform: capitalize;
                                padding-right: 70px;
                                color: rgb(0,0,0);
                                text-align: left;
                            }
                        </style>
                        <div class="container" id="tw_item">
                                
                            @isset($takeawayMenu[0]['mnitm'])
                                <?php 
                                $countTotalItemtw=count($takeawayMenu[0]['mnitm']);
                                $i=1;
                                $j=1;
                                ?>
                                @foreach ($takeawayMenu[0]['mnitm'] as $key=>$item)
                                    @if ($i==1)
                                    <div class="row">    
                                    @endif
                                        <div class="grid_4">
                                            <div class="box2 box2__off1" style="margin-bottom: 25px;">
                                            <h4 class="om_title" style="--var-mt-price:'{{$item['price']}}'">{{$key+1}}. {{$item['name']}}</h4>
                                                <p class="tw_menu_item_detail">{{$item['description']}}</p>
                                            </div>
                                        </div>
                                    @if ($j==$countTotalItemtw)
                                    </div>
                                    @elseif($i==2 && $j!=$countTotalItemtw)
                                    <?php $i=0; ?>
                                    </div>
                                    @endif
                                    <?php
                                    $i++;
                                    $j++;
                                    ?>
                                @endforeach
                            @endisset

                            

                            
                                    
                        </div>
                    </section>
                </div>
            </div>
        </div>
    @endif
    @endisset
    
    

    
    
    <div class="bg1" id="gallery">
        <div class="container well well__ins3">
            <div class="row">
                <div class="grid_12">
                    <h2 class="hdng">
                        gallery
                        <span>of our restaurant</span>
                    </h2>
                </div>
            </div>
    
            @isset($gallery)
                <?php $i=1; $k=1; ?>
                @foreach ($gallery as $key=>$item)
                    <?php if($k==1){ ?>
                        <div class="row">
                    <?php } 
                    $class="grid_3 off1";               
                    ?>
                    <a data-type="lightbox" class="{{$class}}" href="{{asset('upload/galleryphoto/'.$item->photo)}}">
                        <img src="{{asset('upload/galleryphoto/small/'.$item->photo)}}" alt="{{$item->photo_title}}"/>
                    </a>
                    <?php 
                    if($i==count($gallery))
                    {
                        ?>
                        </div>
                        <?php 
                    }
                    elseif($k==4) {
                        ?>
                        </div>
                        <?php 
                    }
    
                    if($k==4){
                        $k=0;
                    }
                    $i++; 
                    $k++; 
                    ?>
                @endforeach
            @endisset
    
            
        </div>
    </div>
    
    
    <footer id="Reservation" class="" style="background: url('{{asset('upload/siteforeground/'.$foreground->reserve)}}'); background-size: cover;">
            <div class="footer-top control-overlay" style="background: rgb(0,0,0,0.7)">
            <div class="container">
            <div class="row" style="transform: translate3d(0px, 0px, 0px); padding-top:121px; padding-bottom:100px;">
                
                <div class="grid_6" style="padding-bottom: 30px;">
                    <h2 class="hdng" >
                        <span class="hdng" style="font-weight: bolder; color: #FFF;">{{$reservationInfo->opening_hour_title}}</span>
                    </h2>
                    <div class="box2 box2__off1" style="padding-top:50px;">
                        @isset($openingHour)
                        <ul class="menu-list">   
                            @foreach ($openingHour as $item)
                            <li>
                                <a href="#" style="color: #fff;">{{$item->title}}</a>
                                <span style="color: #fff;">{{$item->opening_time}}</span>
                            </li>
                            @endforeach                 
                        </ul>
                        @endisset
                    </div>
                </div>
                
                
        
                <div class="grid_6" style="background: url('{{asset('site/images/cnt-bg.jpg')}}'); border-radius: 5px;">
                    <div class="well well__ins8"  style="padding-bottom: 45px;">
                        <h2 class="hdng">
                            <span style="font-weight: bolder;">{{$reservationInfo->reservation_title}}</span>
                        </h2>



                        <form id="contact-form" method="POST" action="{{url('reservation')}}">
                            <div class="contact-form-loader"></div>
                            <fieldset style="padding: 0 20px;">

                                {{csrf_field()}}
                                
                                <label class="name label_full">
                                    <input type="text" name="name" placeholder="Name*" value=""
                                            data-constraints="@Required @JustLetters"/>

                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid name.</span>
                                </label>

                                <label class="phone label50">
                                    <input type="text" name="phone" placeholder="Phone" value=""
                                            data-constraints="@JustNumbers"/>

                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid phone.</span>
                                </label>

                                <label class="email label50">
                                    <input type="text" name="email" placeholder="Email*" value=""
                                            data-constraints="@Required @Email"/>

                                    <span class="empty-message">*This field is required.</span>
                                    <span class="error-message">*This is not a valid email.</span>
                                </label>

                                

                                <label class="date label50">
                                    <input type="text" name="date" placeholder="Date" value="" />
                                </label>

                                <label class="time label50">
                                    <select name="time" id="time">
                                        <option value="">Select Time</option>
                                        @for ($i = 0; $i<=23; $i++)
                                            @for ($j = 0; $j<=55; $j+=5)
                                                <option value="{{strlen($i)==1?'0'.$i:$i}}:{{strlen($j)==1?'0'.$j:$j}}">{{strlen($i)==1?'0'.$i:$i}}:{{strlen($j)==1?'0'.$j:$j}}</option>
                                            @endfor
                                        @endfor
                                    </select>
                                </label>

                                <label class="Person label50">
                                    <select name="person" id="person">
                                        <option value="">Select Person</option>
                                        @for ($i = 1; $i <=100; $i++)
                                            <option value="{{$i}} Person">{{$i}} Person</option>
                                        @endfor
                                    </select>
                                </label>

                

                                <div class="btn-wr" style="text-align:left;">
                                    {{-- <button type="submit" style="border: 0px;" class="btn" href="javascript:recaptcha();" data-type="submit">send</button> --}}
                                    <button type="submit" style="border: 0px;" class="btn">send</button>
                                    
                                </div>
                            </fieldset>
                           
                        </form>

                    </div>
                
                
                </div>
        
            
            </div>
        </div>
        </div>
    </footer>

    @isset($homeDelivery)
        @if ($homeDelivery->module_status=="Active")
        <div class="well well__ins8" id="gallery" style="padding-bottom: 0px;">
            <div class="container well well__ins3" style="padding-top: 0px; padding-bottom: 35px;">
                <div class="row">
                    <div class="grid_12">
                        <h2 class="hdng__off2">
                            {{$homeDelivery->title}}
                            <span>{{$homeDelivery->sub_title}}</span>
                        </h2>
                    </div>
                </div>
    
                <div class="row">
                    <div class="img-wrap grid_4">
                        <a class="" href="{{$homeDelivery->logo_one_link}}">
                            <img style="margin-bottom: 40px;" src="{{asset('upload/homedelivery/'.$homeDelivery->logo_one)}}" alt="dsdf"/>
                        </a>
                    </div>
                    <div class="img-wrap grid_4">
                        <a class="" href="{{$homeDelivery->logo_two_link}}">
                            <img style="margin-bottom: 40px;" src="{{asset('upload/homedelivery/'.$homeDelivery->logo_two)}}" alt="dsdf"/>
                        </a>
                    </div>
                    <div class="img-wrap grid_4">
                        <a class="" href="{{$homeDelivery->logo_three_link}}">
                            <img style="margin-bottom: 40px;" src="{{asset('upload/homedelivery/'.$homeDelivery->logo_three)}}" alt="{{$homeDelivery->logo_three_link}}"/>
                        </a>
                    </div>
                </div>        
            </div>
        </div>
        @endif
    @endisset
    

        <footer id="contact" class="" style="background: url('{{asset('upload/siteforeground/'.$foreground->fotter)}}'); background-size: cover;">
            <div class="footer-top control-overlay" style="background: rgb(0,0,0,0.70);">
            <div class="container">
            <div class="row" style="transform: translate3d(0px, 0px, 0px); padding-top:30px;">
                
                <div class="grid_4" style="padding-bottom: 30px;">
                <h3 class="footer-title" style="color: #fff; padding-bottom: 20px;">{{$reservationInfo->opening_hour_title}}</h3>
                <div class="open-time opening-time" style="color: #fff; ">
                                
                                <p>
                        <strong>Måndag - Torsdag :</strong> 11:00 - 15:00, 15:00 - 22:00
                    </p>
        
                    
                                <p>
                        <strong>Fredag :</strong> 11:00 - 15:00, 15:00 - 23:00
                    </p>
        
                    
                                <p>
                        <strong>Lördag :</strong> 12:00 - 23:00
                    </p>
        
                    
                                <p>
                        <strong>Söndag :</strong> 12:00 - 22:00
                    </p>
        
                                        </div>
                </div>
                
                <div class="grid_4" style="padding-bottom: 30px;">
                <h3 class="footer-title" style="color: #fff; padding-bottom: 20px;">contacts</h3>
                <div class="address" style="color: #fff;">
                    <p class="icon-map"><i class="fa fa-map-marker" style="margin-bottom: 0px; margin-top: 5px;"></i>  Address :  {{$site->contact_address}} </p>
                    <p><i class="fa fa-phone" style="margin-bottom: 0px; margin-top: 5px;"></i> <a href="tel:{{$site->contact_tel}}"> Tel :  {{$site->contact_tel}}</a></p>
                    <p><i class="fa fa-phone-square" style="margin-bottom: 0px; margin-top: 5px;"></i> <a href="tel:{{$site->contact_phone}}"> Phone :  {{$site->contact_phone}}</a></p>
                    <p><i class="fa fa-envelope" style="margin-bottom: 0px; margin-top: 5px;"></i>  <a style="color: #fff;" href="mailto:{{$site->contact_email}}"> Email : {{$site->contact_email}}</a></p>
                </div>
                <ul class="socials" style="margin-top: 30px; padding-bottom: 15px;">
                    @if (!empty($site->fb_link))
                    <li>
                        <a class="fa fa-facebook" href="{{!empty($site->fb_link)?$site->fb_link:'#'}}"></a>
                    </li>
                    @endif
                    @if (!empty($site->twitter_link))
                    <li>
                        <a class="fa fa-twitter" href="{{!empty($site->twitter_link)?$site->twitter_link:'#'}}"></a>
                    </li>
                    @endif
                    @if (!empty($site->instragram_link))
                        <li>
                            <a class="fa fa-instagram" href="{{!empty($site->instragram_link)?$site->instragram_link:'#'}}"></a>
                        </li>
                    @endif
                    
                </ul>
            </div>
        
            <div class="grid_4">
                {{-- <iframe id="fotterAMap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2035.2569356843828!2d18.004020416072297!3d59.32866408165864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x465f762ea8986879%3A0x69d7f596b4a3b1d8!2sStagneliusv%C3%A4gen%2037%2C%20112%2057%20Stockholm%2C%20Sweden!5e0!3m2!1sen!2sbd!4v1596128798051!5m2!1sen!2sbd" width="100%" frameborder="0" style="border:0; height: 250px;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}
                {!!$site->map_source!!}
            </div>
        
            
            </div>
        </div>
        </div>
        </footer>
    
    
    </section>

@endsection

@section('css')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@endsection

@section('js')

<script>
    $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");

    @if(Session::has('status')) 
        Swal.fire({
            icon: 'success',
            title: '<h3 class="text-success">Thank You</h3>',
            html: "<h5>{{Session::get('status')}}</h5>"
        });
    @endif

    var dayWiseCategory=<?=json_encode($dayWiseCategory)?>;
    var OurMenuCategory=<?=json_encode($OurMenuCategory)?>;
    var DayMenuItem=<?=json_encode($DayMenuItem)?>;
    var menu_item=null;
    var takeawayMenu=<?=json_encode($takeawayMenu)?>;
    $(function() {
      $('input[name="date"]').daterangepicker({
        singleDatePicker: true,
        minDate:moment(),
        locale: {
            format: 'YYYY-MM-DD'
        }
      });
    });




    $(document).ready(function(){

        $('body').on('click','.loadom',function(){
            //alert('ok');
            var day_id=$(this).attr('data-filter');

            $('.loadom').each(function(r,y){
                $(y).parent().removeClass('active');
            });

            $(this).parent().addClass('active');
            
            var dataHj='';
            $.each(dayWiseCategory,function(k,r){
                if(r.id==day_id)
                {
                    console.log('Day Found',r);
                    $.each(OurMenuCategory,function(m,n){

                        if(n.day_id==r.id)
                        {
                            console.log('Cate Found =',n);

                            dataHj+='<div class="row">';
                            dataHj+='    <div class="grid_12">';
                            dataHj+='        <div class="box2 box2__off1" style="margin-bottom: 0px;">';
                            dataHj+='            <h4  class="omg_heading">'+n.name+'</h4>';                                    
                            dataHj+='        </div>';
                            dataHj+='    </div>';
                            var tt=1;
                            $.each(DayMenuItem,function(p,q){
                                if(q.day_id==n.day_id && q.category_id==n.id)
                                {
                                    console.log(n.name,q);
                                    dataHj+='    <div class="grid_6">';
                                    dataHj+='        <div class="box2 box2__off1" style="margin-bottom: 15px;">';
                                    dataHj+='            <h4 class="omg_title" style="--var-omg-price:';
                                    dataHj+="'"+q.price+"'";
                                    dataHj+='">'+tt+'. '+q.name+'</h4>';
                                    if(q.description=== null)
                                    {
                                        dataHj+='            <p class="om_menu_item_detail" style="margin-top: 0px;"></p>';
                                    }
                                    else
                                    {
                                        dataHj+='            <p class="om_menu_item_detail" style="margin-top: 0px;">'+q.description+'</p>';
                                    }
                                    
                                    dataHj+='        </div>';
                                    dataHj+='    </div>';
                                    tt++;
                                }
                                
                                
                            });

                            dataHj+='</div>';


                        }

                    })
                }
            });
            $("#daywiseMenuItem").html(dataHj);
            //dayWiseCategory
        });

        $('body').on('click','.tw_menu',function(){
            $('.tw_menu').each(function(key,row){
                $(row).removeClass('tw_menu_active');
            });

            $(this).addClass('tw_menu_active');

            var data_id=$(this).attr('data-id');

            $.each(takeawayMenu,function(key,row){
               // console.log(row);
                if(row.id==data_id)
                {
                    var dataHtml='';
                    var m=1;
                    var n=1;
                    var dataLength=row.mnitm.length;
                    console.log('dataLength',dataLength);
                    $.each(row.mnitm,function(k,r){
                        console.log(r);
                        if(m==1)
                        {
                        dataHtml+='<div class="row">';
                        }

                        dataHtml+='     <div class="grid_4">';
                        dataHtml+='         <div class="box2 box2__off1" style="margin-bottom: 25px;">';
                        dataHtml+='             <h4 class="om_title om_title_'+n+'" style="--var-mt-price:';
                        dataHtml+="'"+r.price+"'";
                        dataHtml+='                        ">'+n+'. '+r.name+'</h4>';
                        if(r.description=== null)
                        {
                            dataHtml+='             <p class="tw_menu_item_detail"></p>';
                        }
                        else
                        {
                            dataHtml+='             <p class="tw_menu_item_detail">'+r.description+'</p>';
                        }
                        
                        dataHtml+='         </div>';
                        dataHtml+='     </div>';
                        if(n==dataLength)
                        {
                        dataHtml+='</div>';
                        }
                        else if(m==2 && n!=dataLength)
                        {
                            m=0;
                        dataHtml+='</div>';
                        }
                        n++;
                        m++;
                    });

                    $("#tw_item").html(dataHtml);
                }
            });

        });
    });


    </script>

@endsection