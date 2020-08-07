@extends('site.layout.master')
@section('content')
<section id="content">

    <div class="bg1" id="gallery" style="padding-top: 62px;">
        <div class="container well well__ins3" style="padding: 69px 0 64px;">
            <div class="row">
                <div class="grid_12">
                    <h2 class="hdng">
                        Gallery
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
                    $class="grid_3 off1 js-img-viwer";               
                    ?>
                    <a data-type="lightbox" class="{{$class}}" href="{{asset('upload/galleryphoto/'.$item->photo)}}"  data-caption="" data-id="{{$item->id}}">
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
    

</section>
@endsection

@section('css')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('site/smartphoto/css/smartphoto.min.css')}}">
	<link rel="stylesheet" href="{{asset('site/smartphoto/examples/assets/style.css')}}">
@endsection

@section('js')
<script src="{{asset('site/smartphoto/js/jquery-smartphoto.min.js?v=1')}}"></script>
<script>

    var windowHeightSize=$(window).height();
    $(".camera-wrapper").css('min-height',windowHeightSize);

    $(function(){
		$(".js-img-viwer").SmartPhoto();
	});
    $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");

    @if(Session::has('status')) 
        Swal.fire({
            icon: 'success',
            title: '<h3 class="text-success">Thank You</h3>',
            html: "<h5>{{Session::get('status')}}</h5>"
        });
    @endif

   

    </script>

@endsection