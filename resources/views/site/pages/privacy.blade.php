@extends('site.layout.master')
@section('content')
<section id="content">

    <div class="container well">
        <div class="row">
            <div class="grid_12">
                <h2 class="hdng__off2">
                    {{$privacy->title}}
                    <span>{{$privacy->sub_title}}</span>
                </h2>

                <dl class="terms ta__c">
                    <dd>
                        {{$privacy->description}}
                    </dd>
                    
                </dl>
            </div>
        </div>
    </div>

</section>
@endsection