
@extends("admin.layout.master")
@section("title","Create New Takeway Menu Item")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Takeway Menu Item</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('takewaymenuitem/list')}}">Takeway Menu Item Data</a></li>
              <li class="breadcrumb-item active">Create New Takeway Menu Item</li>
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
            <h3 class="card-title">Create New Takeway Menu Item</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item"><a class="page-link bg-primary" href="{{url('takewaymenuitem/list')}}"> Data <i class="fas fa-table"></i></a></li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('takewaymenuitem/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('takewaymenuitem/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>            
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('takewaymenuitem')}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Category</label>
                                  <select class="form-control select2" style="width: 100%;"  id="category_id" name="category_id">
                                        <option value="">Please Select</option>
                                        @if(isset($dataRow_TakewayCategory))    
                                            @if(count($dataRow_TakewayCategory)>0)
                                                @foreach($dataRow_TakewayCategory as $TakewayCategory)
                                                    <option value="{{$TakewayCategory->id}}">{{$TakewayCategory->name}}</option>
                                                    
                                                @endforeach
                                            @endif
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
                        <input type="text" class="form-control" placeholder="Enter Name" id="name" name="name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Description" id="description" name="description"></textarea>
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" placeholder="Enter Price" id="price" name="price">
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
            value="Active">Active</option>
            <option 
            value="Inactive">Inactive</option>
                                  </select>
                                </div>
                            </div>
                        </div>
                           
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Submit</button>
              <a class="btn btn-danger" href="{{url('takewaymenuitem/create')}}"><i class="far fa-times-circle"></i> Reset</a>
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
        