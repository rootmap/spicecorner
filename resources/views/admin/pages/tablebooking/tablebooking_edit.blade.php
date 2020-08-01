
@extends("admin.layout.master")
@section("title","Edit Table Booking")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Table Booking</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('tablebooking/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('tablebooking/create')}}">Create New </a></li>
              <li class="breadcrumb-item active">Edit / Modify</li>
            </ol>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include("admin.include.msg")
        </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-8 offset-2">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Edit / Modify Table Booking</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('tablebooking/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('tablebooking/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('tablebooking/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('tablebooking/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('tablebooking/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->name)){
                            ?>
                            value="{{$dataRow->name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Name" id="name" name="name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->email)){
                            ?>
                            value="{{$dataRow->email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Email" id="email" name="email">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->phone)){
                            ?>
                            value="{{$dataRow->phone}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Phone" id="phone" name="phone">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="date">Date</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->date)){
                            ?>
                            value="{{$dataRow->date}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Date" id="date" name="date">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="time">Time</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->time)){
                            ?>
                            value="{{$dataRow->time}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Time" id="time" name="time">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Enter Person</label>
                                  <select class="form-control select2" style="width: 100%;"  id="person" name="person">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->person=="1"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="1">1</option>
            <option 
                    <?php 
                    if($dataRow->person=="2"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="2">2</option>
            <option 
                    <?php 
                    if($dataRow->person=="3"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="3">3</option>
            <option 
                    <?php 
                    if($dataRow->person=="4"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="4">4</option>
            <option 
                    <?php 
                    if($dataRow->person=="5"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="5">5</option>
            <option 
                    <?php 
                    if($dataRow->person=="6"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="6">6</option>
            <option 
                    <?php 
                    if($dataRow->person=="7"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="7">7</option>
            <option 
                    <?php 
                    if($dataRow->person=="8"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="8">8</option>
            <option 
                    <?php 
                    if($dataRow->person=="9"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="9">9</option>
            <option 
                    <?php 
                    if($dataRow->person=="10"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="10">10</option>
            <option 
                    <?php 
                    if($dataRow->person=="11"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="11">11</option>
            <option 
                    <?php 
                    if($dataRow->person=="12"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="12">12</option>
            <option 
                    <?php 
                    if($dataRow->person=="13"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="13">13</option>
            <option 
                    <?php 
                    if($dataRow->person=="14"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="14">14</option>
            <option 
                    <?php 
                    if($dataRow->person=="15"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="15">15</option>
            <option 
                    <?php 
                    if($dataRow->person=="16"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="16">16</option>
            <option 
                    <?php 
                    if($dataRow->person=="17"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="17">17</option>
            <option 
                    <?php 
                    if($dataRow->person=="18"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="18">18</option>
            <option 
                    <?php 
                    if($dataRow->person=="19"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="19">19</option>
            <option 
                    <?php 
                    if($dataRow->person=="20"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="20">20</option>
            <option 
                    <?php 
                    if($dataRow->person=="21"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="21">21</option>
            <option 
                    <?php 
                    if($dataRow->person=="22"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="22">22</option>
            <option 
                    <?php 
                    if($dataRow->person=="23"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="23">23</option>
            <option 
                    <?php 
                    if($dataRow->person=="24"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="24">24</option>
            <option 
                    <?php 
                    if($dataRow->person=="25"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="25">25</option>
            <option 
                    <?php 
                    if($dataRow->person=="26"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="26">26</option>
            <option 
                    <?php 
                    if($dataRow->person=="27"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="27">27</option>
            <option 
                    <?php 
                    if($dataRow->person=="28"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="28">28</option>
            <option 
                    <?php 
                    if($dataRow->person=="29"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="29">29</option>
            <option 
                    <?php 
                    if($dataRow->person=="30"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="30">30</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Table Booking Status</label>
                                  <select class="form-control select2" style="width: 100%;"  id="module_status" name="module_status">
                                    
        <option value="">Please select</option>
            <option 
                    <?php 
                    if($dataRow->module_status=="Active"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Active">Active</option>
            <option 
                    <?php 
                    if($dataRow->module_status=="Inactive"){
                        ?>
                        selected="selected" 
                        <?php 
                    }
                    ?> 
            value="Inactive">Inactive</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                           
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('tablebooking/edit/'.$dataRow->id)}}">
                <i class="far fa-times-circle"></i> 
                Reset
              </a>
            </div>
          </form>
        </div>
        <!-- /.card -->

      </div>
      <!--/.col (left) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@section("css")
    
    <link rel="stylesheet" href="{{url('admin/plugins/select2/css/select2.min.css')}}">
    
@endsection
        
@section("js")

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
    </script>

@endsection
        