
@extends("admin.layout.master")
@section("title","Edit Day Wise Category")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Day Wise Category</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('daywisecategory/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('daywisecategory/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Day Wise Category</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('daywisecategory/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('daywisecategory/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('daywisecategory/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('daywisecategory/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('daywisecategory/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="day_name">Day Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->day_name)){
                            ?>
                            value="{{$dataRow->day_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Day Name" id="day_name" name="day_name">
                      </div>
                    </div>
                </div>
                
                @if(isset($dataRow_MenuCategory))    
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th><input type="checkbox" class="checkAll" /> All</th>
                              <th>Category Name</th>
                            </tr>
                          </thead>
                          <tbody>
                            @if(count($dataRow_MenuCategory)>0)
                            <?php 
                            $categories=json_decode($dataRow->category_id);
                            ?>
                                @foreach($dataRow_MenuCategory as $MenuCategory)
                                <tr>
                                  <td>
                                    <input 
                                    <?php 
                                    if(in_array($MenuCategory->id,$categories))
                                    {
                                        ?>
                                      checked 
                                        <?php 
                                    }
                                    ?>
                                    type="checkbox" value="{{$MenuCategory->id}}" class="ind_check" name="ind_check[]" />
                                  </td>
                                  <td>{{$MenuCategory->name}}</td>
                                </tr>
                                @endforeach
                            @endif
                          </tbody>
                        </table>
                    </div>
                </div>
                @endif 
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Day Status</label>
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
              <a class="btn btn-danger" href="{{url('daywisecategory/edit/'.$dataRow->id)}}">
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
        