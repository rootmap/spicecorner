
@extends("admin.layout.master")
@section("title","Edit Site Settings")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Site Settings</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Update Site Settings</li>
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
            <h3 class="card-title">Edit / Modify Site Settings</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('sitesettings/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
          {{csrf_field()}}
          
            <div class="card-body">
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="site_name">Site Name</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->site_name)){
                            ?>
                            value="{{$dataRow->site_name}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Site Name" id="site_name" name="site_name">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="site_title">Site Title</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->site_title)){
                            ?>
                            value="{{$dataRow->site_title}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Site Title" id="site_title" name="site_title">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="site_description">Site Description</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Site Description" id="site_description" name="site_description"><?php 
                                if(isset($dataRow->site_description)){
                                    
                                    echo $dataRow->site_description;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Logo</label>
                                    <!-- <label for="customFile">Choose Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="logo" name="logo">
                                      <input type="hidden" value="{{$dataRow->logo}}" name="ex_logo" />
                                      <label class="custom-file-label" for="customFile">Choose Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->logo))
                                    @if(!empty($dataRow->logo))
                                        <img class="img-thumbnail" src="{{url('upload/sitesettings/'.$dataRow->logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Choose Slider Logo</label>
                                    <!-- <label for="customFile">Choose Slider Logo</label> -->
                                    <div class="custom-file">
                                      <input type="file" class="custom-file-input"  id="slider_logo" name="slider_logo">
                                      <input type="hidden" value="{{$dataRow->slider_logo}}" name="ex_slider_logo" />
                                      <label class="custom-file-label" for="customFile">Choose Slider Logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if(isset($dataRow->slider_logo))
                                    @if(!empty($dataRow->slider_logo))
                                        <img class="img-thumbnail" src="{{url('upload/sitesettings/'.$dataRow->slider_logo)}}" width="150">
                                    @endif
                                @endif
                            </div>
                        </div>
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_address">Contact Address</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_address)){
                            ?>
                            value="{{$dataRow->contact_address}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Contact Address" id="contact_address" name="contact_address">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_tel">Contact Tel</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_tel)){
                            ?>
                            value="{{$dataRow->contact_tel}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Contact Tel" id="contact_tel" name="contact_tel">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_phone">Contact Phone</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_phone)){
                            ?>
                            value="{{$dataRow->contact_phone}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Contact Phone" id="contact_phone" name="contact_phone">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="contact_email">Contact Email</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->contact_email)){
                            ?>
                            value="{{$dataRow->contact_email}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Contact Email" id="contact_email" name="contact_email">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="fb_link">FB Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->fb_link)){
                            ?>
                            value="{{$dataRow->fb_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter FB Link" id="fb_link" name="fb_link">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="twitter_link">Twitter Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->twitter_link)){
                            ?>
                            value="{{$dataRow->twitter_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Twitter Link" id="twitter_link" name="twitter_link">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="instragram_link">Instragram Link</label>
                        <input type="text" 
                            
                        <?php 
                        if(isset($dataRow->instragram_link)){
                            ?>
                            value="{{$dataRow->instragram_link}}" 
                            <?php 
                        }
                        ?>
                        
                        class="form-control" placeholder="Enter Instragram Link" id="instragram_link" name="instragram_link">
                      </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                      <!-- text input -->
                      <div class="form-group">
                        <label for="map_source">Map Source</label>
                        <textarea class="form-control" rows="3"  placeholder="Enter Map Source" id="map_source" name="map_source"><?php 
                                if(isset($dataRow->map_source)){
                                    
                                    echo $dataRow->map_source;
                                    
                                }
                                ?></textarea>
                      </div>
                    </div>
                </div>

                        <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Choose Our Menu Status</label>
                                  <select class="form-control select2" style="width: 100%;"  id="our_menu_module_status" name="our_menu_module_status">
                                                              <option value="">Please select</option>
                                                              <option 
                                                                      <?php 
                                                                      if($dataRow->our_menu_module_status=="Active"){
                                                                          ?>
                                                                          selected="selected" 
                                                                          <?php 
                                                                      }
                                                                      ?> 
                                                              value="Active">Active</option>
                                                              <option 
                                                                      <?php 
                                                                      if($dataRow->our_menu_module_status=="Inactive"){
                                                                          ?>
                                                                          selected="selected" 
                                                                          <?php 
                                                                      }
                                                                      ?> 
                                                              value="Inactive">Inactive</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                                <label>Choose Takeyway Menu Status</label>
                                <select class="form-control select2" style="width: 100%;"  id="takeway_menu_module_status" name="takeway_menu_module_status">
                                                            <option value="">Please select</option>
                                                            <option 
                                                                    <?php 
                                                                    if($dataRow->takeway_menu_module_status=="Active"){
                                                                        ?>
                                                                        selected="selected" 
                                                                        <?php 
                                                                    }
                                                                    ?> 
                                                            value="Active">Active</option>
                                                            <option 
                                                                    <?php 
                                                                    if($dataRow->takeway_menu_module_status=="Inactive"){
                                                                        ?>
                                                                        selected="selected" 
                                                                        <?php 
                                                                    }
                                                                    ?> 
                                                            value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Choose Site Status</label>
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
                
                        <div class="row">
                            
                        </div>
                           
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> 
                Update
              </button>
              <a class="btn btn-danger" href="{{url('sitesettings/edit/'.$dataRow->id)}}">
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
        