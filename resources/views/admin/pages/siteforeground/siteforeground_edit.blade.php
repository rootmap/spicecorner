
@extends("admin.layout.master")
@section("title","Edit Site Foreground")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Site Foreground</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Site Foreground</li>
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
            <h3 class="card-title">Edit / Modify Site Foreground</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('siteforeground/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Our Menu Foreground</label>
                                    <!-- <label for="customFile">Choose Our Menu Foreground</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="our_menu" name="our_menu">
                                      <input type="hidden" value="{{$dataRow->our_menu}}" name="ex_our_menu" />
                                      <label class="custom-file-label" for="customFile">Choose Our Menu Foreground</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->our_menu))
                                    @if(!empty($dataRow->our_menu))
                                        <img class="img-thumbnail" src="{{url('upload/siteforeground/'.$dataRow->our_menu)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Reserve Foreground</label>
                                    <!-- <label for="customFile">Choose Reserve Foreground</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="reserve" name="reserve">
                                      <input type="hidden" value="{{$dataRow->reserve}}" name="ex_reserve" />
                                      <label class="custom-file-label" for="customFile">Choose Reserve Foreground</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->reserve))
                                    @if(!empty($dataRow->reserve))
                                        <img class="img-thumbnail" src="{{url('upload/siteforeground/'.$dataRow->reserve)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Reserve Foreground</label>
                                    <!-- <label for="customFile">Choose Reserve Foreground</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="fotter" name="fotter">
                                      <input type="hidden" value="{{$dataRow->fotter}}" name="ex_fotter" />
                                      <label class="custom-file-label" for="customFile">Choose Reserve Foreground</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->fotter))
                                    @if(!empty($dataRow->fotter))
                                        <img class="img-thumbnail" src="{{url('upload/siteforeground/'.$dataRow->fotter)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Foreground Status</label>
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
              <a class="btn btn-danger" href="{{url('siteforeground/edit/'.$dataRow->id)}}">
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

    <script src="{{url('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        bsCustomFileInput.init();
    });
    </script>

    <script src="{{url('admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>
    $(document).ready(function(){
        $(".select2").select2();
    });
    </script>

@endsection
        