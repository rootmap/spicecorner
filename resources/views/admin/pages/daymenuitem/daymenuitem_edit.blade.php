
@extends("admin.layout.master")
@section("title","Edit Day Menu Item")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Day Menu Item</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('daymenuitem/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('daymenuitem/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Day Menu Item</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('daymenuitem/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('daymenuitem/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('daymenuitem/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('daymenuitem/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('daymenuitem/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Day Name</label>
                                  <select class="form-control select2" style="width: 100%;"  id="day_id" name="day_id">
                                    
                                        <option value="">Please Select</option>
                                        @if(count($dataRow_OurMenuDay)>0)
                                            @foreach($dataRow_OurMenuDay as $OurMenuDay)
                                                <option 
                                        @if(isset($dataRow->id))
                                            @if($dataRow->id==$OurMenuDay->id)
                                                selected="selected" 
                                            @endif
                                        @endif 
                                         value="{{$OurMenuDay->id}}">{{$OurMenuDay->name}}</option>
                                                
                                            @endforeach
                                        @endif
                                        
                                  </select>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Category</label>
                                  <select class="form-control select2" style="width: 100%;"  id="category_id" name="category_id">
                                    
                                        <option value="">Please Select</option>
                                        @if(count($dataRow_OurMenuCategory)>0)
                                            @foreach($dataRow_OurMenuCategory as $OurMenuCategory)
                                                <option 
                                        @if(isset($dataRow->id))
                                            @if($dataRow->id==$OurMenuCategory->id)
                                                selected="selected" 
                                            @endif
                                        @endif 
                                         value="{{$OurMenuCategory->id}}">{{$OurMenuCategory->name}}</option>
                                                
                                            @endforeach
                                        @endif
                                        
                                  </select>
                                </div>
                            </div>
                        </div>
                    
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
                        <label for="price">Price</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->price)){
                            ?>
                            value="{{$dataRow->price}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Price" id="price" name="price">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Description" id="description" name="description"><?php 
                                if(isset($dataRow->description)){
                                    
                                    echo $dataRow->description;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Menu Item Status</label>
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
              <a class="btn btn-danger" href="{{url('daymenuitem/edit/'.$dataRow->id)}}">
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
      var cat=<?=json_encode($dataRow_OurMenuCategory)?>;
    $(document).ready(function(){
      $('body').on('change','select[name=day_id]',function(){
            var day_id=$(this).val();
            if(day_id.length==0){
                alert('Please Select a Day.');
                return false;
            }

            var dataHtml='<option value="">Please select Category</option>';
            $.each(cat,function(k,r){
              if(r.day_id==day_id)
              {
                dataHtml+='<option value="'+r.id+'">'+r.name+'</option>';
              }
                
            });

            $("#category_id").html(dataHtml);
            $(".select2").select2();
        });
        $(".select2").select2();
    });
    </script>

@endsection
        