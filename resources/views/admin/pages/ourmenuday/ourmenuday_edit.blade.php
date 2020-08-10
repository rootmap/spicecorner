
@extends("admin.layout.master")
@section("title","Edit Our Menu Day")
@section("content")
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Our Menu Day</h1>
      </div>
      <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('ourmenuday/list')}}">Datatable </a></li>
              <li class="breadcrumb-item"><a href="{{url('ourmenuday/create')}}">Create New </a></li>
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
            <h3 class="card-title">Edit / Modify Our Menu Day</h3>
            <div class="card-tools">
              <ul class="pagination pagination-sm float-right">
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('ourmenuday/create')}}"> 
                        Create 
                        <i class="fas fa-plus"></i>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary" href="{{url('ourmenuday/list')}}"> 
                        Data 
                        <i class="fas fa-table"></i>
                    </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('ourmenuday/export/pdf')}}">
                    <i class="fas fa-file-pdf" data-toggle="tooltip" data-html="true"title="Pdf"></i>
                  </a>
                </li>
                <li class="page-item">
                  <a class="page-link  bg-primary" target="_blank" href="{{url('ourmenuday/export/excel')}}">
                    <i class="fas fa-file-excel" data-toggle="tooltip" data-html="true"title="Excel"></i>
                  </a>
                </li>
              </ul>
            </div>
        </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="{{url('ourmenuday/update/'.$dataRow->id)}}" method="post" enctype="multipart/form-data">
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
                    <!-- texhint input -->
                    <div class="form-group">
                      <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Day Options</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
      
                                @if (!empty($dataRow->opt_menu))
                                  <?php 
                                    $dataJson=json_decode($dataRow->opt_menu);
                                    $k=1;
                                  ?>
                                  @foreach ($dataJson as $item)
                                  <tr id="tr1" class="crud-item">
                                      <td>{{$k}}</td>
                                      <td>
                                          <input type="text" id="example-text-input" class="form-control" value="{{$item}}" placeholder="Day Options" name="field_name[]"><br />
                                      </td>
                                      <td>
                                          <button onclick="deleteRow(this)" class="btn btn-warning deleteRow btn-alt btn-default"><i class="fa fa-times fa-fw"></i></button>
                                      </td>
                                  </tr>
                                  <?php $k++; ?>
                                  @endforeach
                                @else
                                <tr id="tr1" class="crud-item">
                                    <td>1</td>
                                    <td>
                                        <input type="text" id="example-text-input" class="form-control" placeholder="Day Options" name="field_name[]"><br />
                                    </td>
                                    <td>
                                        <button onclick="deleteRow(this)" class="btn btn-warning deleteRow btn-alt btn-default"><i class="fa fa-times fa-fw"></i></button>
                                    </td>
                                </tr>
                                @endif

                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"><button type="button" onclick="javascript:addmore();" class="btn btn-info"><i class="fas fa-plus"></i> Add More Field</button></td>
                            </tr>
                          </tfoot>
                    </table>
                    </div>
                  </div>
              </div>
                
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
              <a class="btn btn-danger" href="{{url('ourmenuday/edit/'.$dataRow->id)}}">
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

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script type="text/javascript">
        $(".show_in_table").show();
        $(".show_in_filter").hide();

        $(document).ready(function(){
            $("select[name=page_type]").change(function(){
                var page_type=$(this).val();
                $(".show_in_table").show();
                $(".show_in_filter").hide();
                if(page_type=="CRUD"){
                    $(".show_in_table").show();
                    $(".show_in_filter").hide();
                }
                else if(page_type=="Single"){
                    $(".show_in_table").hide();
                    $(".show_in_filter").hide();
                }
                else if(page_type=="Report"){
                    $(".show_in_table").show();
                    $(".show_in_filter").show();
                }
            });
        });

        function refreshSerial(){
            var r=1;
            $.each($(".crud-item"),function(key,row){
                $(this).attr("id","tr"+r);
                $(this).find("td:first").html(r);
                $(this).find("td:eq(2)").find("input").attr("name","field_validation_"+r);
                $(this).find("td:eq(3)").find("input").attr("name","field_data_table_"+r);
                $(this).find("td:eq(4)").find("input:eq(1)").attr("name","field_data_filter_"+r);
                r++;
            });
        }

        $('tbody').sortable({
            stop: function (event, ui) {
                refreshSerial(); // re-number rows after sorting
            }
        });

        function addmore(){
            $("tr[class^='crud-item']:last").after($("tr[class^='crud-item']:last").clone());
            var item=$(".crud-item").length;
            refreshSerial();
        }

        function deleteRow(place){
            var item=$(".crud-item").length;
            if(item>1)
            {
                var itemID=$(place).parent().parent().attr("id");
                $("#"+itemID).remove()
            }
            refreshSerial(); 
        }
        var rootURL="{{url('/')}}";
        $(document).ready(function(){
            $("#page_name").keyup(function(){
                var getPageName=$(this).val();
                var getPageName=$.trim(getPageName);
                var getPageName=getPageName.replace(/\s/g,"");
                var getPageName=getPageName.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
                var getPageName=getPageName.toLowerCase();
                console.log(getPageName);
                //page_route
                $("#page_route").val(getPageName);
            });
        });
    </script>
@endsection

        