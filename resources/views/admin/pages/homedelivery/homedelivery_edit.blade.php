
@extends("admin.layout.master")
@section("title","Edit Home Delivery")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Home Delivery</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Home Delivery</li>
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
            <h3 class="card-title">Edit / Modify Home Delivery</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('homedelivery/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->title)){
                            ?>
                            value="{{$dataRow->title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Title" id="title" name="title">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="sub_title">Sub Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->sub_title)){
                            ?>
                            value="{{$dataRow->sub_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Sub Title" id="sub_title" name="sub_title">
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Logo One</label>
                                    <!-- <label for="customFile">Choose Logo One</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="logo_one" name="logo_one">
                                      <input type="hidden" value="{{$dataRow->logo_one}}" name="ex_logo_one" />
                                      <label class="custom-file-label" for="customFile">Choose Logo One</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->logo_one))
                                    @if(!empty($dataRow->logo_one))
                                        <img class="img-thumbnail" src="{{url('upload/homedelivery/'.$dataRow->logo_one)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                              <!-- text input -->
                              <div class="form-group">
                                <label for="sub_title">Logo One Link</label>
                                <input type="text" 
                                    
                                <?php 
                                if(isset($dataRow->logo_one_link)){
                                    ?>
                                    value="{{$dataRow->logo_one_link}}" 
                                    <?php 
                                }
                                ?>
                                
                                class="form-control" placeholder="Enter Logo One Link" id="logo_one_link" name="logo_one_link">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Logo Two</label>
                                    <!-- <label for="customFile">Choose Logo Two</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="logo_two" name="logo_two">
                                      <input type="hidden" value="{{$dataRow->logo_two}}" name="ex_logo_two" />
                                      <label class="custom-file-label" for="customFile">Choose Logo Two</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->logo_two))
                                    @if(!empty($dataRow->logo_two))
                                        <img class="img-thumbnail" src="{{url('upload/homedelivery/'.$dataRow->logo_two)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                              <!-- text input -->
                              <div class="form-group">
                                <label for="sub_title">Logo Two Link</label>
                                <input type="text" 
                                    
                                <?php 
                                if(isset($dataRow->logo_two_link)){
                                    ?>
                                    value="{{$dataRow->logo_two_link}}" 
                                    <?php 
                                }
                                ?>
                                
                                class="form-control" placeholder="Enter Logo two Link" id="logo_two_link" name="logo_two_link">
                              </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Logo Three</label>
                                    <!-- <label for="customFile">Choose Logo Three</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="logo_three" name="logo_three">
                                      <input type="hidden" value="{{$dataRow->logo_three}}" name="ex_logo_three" />
                                      <label class="custom-file-label" for="customFile">Choose Logo Three</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->logo_three))
                                    @if(!empty($dataRow->logo_three))
                                        <img class="img-thumbnail" src="{{url('upload/homedelivery/'.$dataRow->logo_three)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <!-- text input -->
                            <div class="form-group">
                              <label for="sub_title">Logo Three Link</label>
                              <input type="text" 
                                  
                              <?php 
                              if(isset($dataRow->logo_three_link)){
                                  ?>
                                  value="{{$dataRow->logo_three_link}}" 
                                  <?php 
                              }
                              ?>
                              
                              class="form-control" placeholder="Enter Logo Three Link" id="logo_three_link" name="logo_three_link">
                            </div>
                          </div>
                      </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label>Choose Home Delivery Status</label>
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
              <a class="btn btn-danger" href="{{url('homedelivery/edit/'.$dataRow->id)}}">
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
        