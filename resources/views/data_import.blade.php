
<!-- lib -->
<script src="lib/jquery-3.1.1.min.js"></script>
<script src="lib/FileSaver.js"></script>
<!-- /lib -->


<!-- style -->
<link rel="stylesheet" href="css/style.css">


<script src="metronic/js/jquery.blockui.min.js" type="text/javascript"></script>
<script src="metronic/js/jquery.slimscroll.js" type="text/javascript"></script>
<!--<script src="metronic/js/app.js" type="text/javascript"></script>-->
<!-- /metronic -->

<!-- dropzone -->
<link rel="stylesheet" href="dropzone/basic.min.css">
<link rel="stylesheet" href="dropzone/dropzone.min.css">
<script src="dropzone/dropzone.js"></script>
<!-- /dropzone -->

<!-- app -->
<script src="js/app_data_handler.js"></script>
<!-- /app -->

<!-- Insert this line after script imports -->

<script src="lib/pnotify.min.js"></script>
<script src="lib/pouchdb-6.1.1.js"></script>
<script src="js/file_parser.js"></script>
<script src="js/database_handler.js"></script>
<script src="js/activity_log.js"></script>

</head>
<!-- Page Content -->
<div class="col-sm-7 left_side_container"> 
  <div class="row">
    <div class="col-sm-12">
      <div class="portlet light bordered">
        <div class="portlet-title">
          <div class="caption">
            <i class="icon-social-dribbble font-blue-sharp"></i>
            <span class="caption-subject font-blue-sharp bold uppercase">Order Data</span>
          </div>
          <div class="actions">
            <div class="btn-group">
              <a class="btn blue btn-outline btn-circle btn-sm" href="javascript:;" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false"> Actions
                <i class="fa fa-angle-down"></i>
              </a>
              <ul class="dropdown-menu pull-right">
                <li>
                  <a onclick="window.database_handler.dump_all_record();" href="#"> Export Data</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="portlet-body form">
          <div class="form-body">
            <div class="form-group">
              <div class="input-group input-group-lg">
                <input id="customer_id" type="text" class="form-control" placeholder="Please Enter Customer ID">
                <span class="input-group-btn">
                  <button id="search_order_btn" class="btn blue" type="button">Search</button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 text-center">
        <div id="customer_order_number"></div> 
      </div>
    </div>
  </div>

  <div class="row">
    <div id="drop_txt"  class="col-sm-12 text-center">
      <form action="/file-upload" class="dropzone">
        <div class="fallback">
          <input name="file" type="file" multiple />
        </div>
      </form>
    </div>
  </div>
</div>

<div class="col-sm-5 right_side_container">
  <div class="col-sm-12">
    <div class="portlet light bordered">
      <div class="portlet-title">
        <div class="caption">
          <i class="icon-share font-dark hide"></i>
          <span class="caption-subject font-dark bold uppercase">Recent Activities</span>
        </div>

      </div>
      <div class="portlet-body">
        <div class="scroller" style="height: 395px;" data-always-visible="1" data-rail-visible="0">
          <ul class="feeds">

          </ul>
        </div>
      </div>
    </div>
  </div>
</div>


