/**
 * handle access and store customer ID, order number data
 */
(function(global){
  
  /* display file data process status */
  var message_handler = function(response, file_name, total_data) {
    var success = 0;
    for(var i = 0; i < response.length; i++) {
      if(typeof response[i].ok !== 'undefined' && response[i].ok === true) {
        success++;
      }
    }
    var total_record_from_file = total_data.length;
    
    window.activity_log.display_file_parse_success(success, file_name, total_record_from_file);
  };
  
  /* if all file has been processed, remove files on dropzone */
  window.check_process_status = function(success) {
    if(typeof success === 'undefined' || success !== false) {
      global.database_handler.number_files_saved++;
    }
    /* data parse finish and clear dropzone */
    if (global.dropzone_global.files.length === (global.database_handler.number_files_saved + window.database_handler.file_cannot_read)) {
      global.dropzone_global.removeAllFiles(true); // clear files uploaded
      global.database_handler.number_files_saved = 0; // reset
      global.database_handler.file_cannot_read = 0;
      App.unblockUI('.left_side_container'); // hide loading screen
    }
  };
  
  /**
   * Database handler 
   */
  var database_handler = function() {
    this.db = new PouchDB('customer_order'); // db.destroy(''customer_order'');
    
    //this.db_load = require('PouchDB');
    //this.db_load.plugin(require(PouchDBLoad));
    
    this.number_files_saved = 0;
    this.file_cannot_read = 0;
  };
  
  database_handler.prototype = {
    
    insert_data: function(data, file_name) {
      
      this.save_to_backend_database(data);
      
      /* insert multiple data records all in once */
      this.db.bulkDocs(data, function(err, response) {
        //console.log(response);
        global.check_process_status();
        message_handler(response, file_name, data);
      });
    },
    
    save_to_backend_database: function(data) {
      $.ajax({
          url: "/comp5342/public/save_captured_data", 
          type: 'POST',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            data:   data
          },
          dataType: 'JSON', 
          success: function (data) {
              console.log(data);
          }
      });
    },
    
    search_order: function(customer_id) {
      customer_id = $.trim(customer_id);
      this.db.get(customer_id, function(err, doc) {
        if (err) { 
          $('#customer_order_number').html('No Record Found');
          window.activity_log.display_no_record(customer_id);
        }else{
          $('#customer_order_number').html(doc.order_number);
          window.activity_log.display_search(customer_id, doc.order_number);
        }
      });
    },
    
    dump_all_record: function() {
      App.blockUI({target: '.left_side_container', boxed: true, message: 'Exporting data...'});
      this.db.allDocs({
        include_docs: true,
        attachments: true
      }, function (err, response) {
        if (err) {
          return console.log(err);
        }
        //console.log(JSON.stringify(response));
        //console.log(response);
        window.activity_log.display_database_export(response.total_rows);
        var blob = new Blob([JSON.stringify(response)], {type: "text/plain"});
        saveAs(blob, "data.json");
        App.unblockUI('.left_side_container');
      });
    },
    
    import_record: function(data, source_file_name) {
      //console.log(data);
      var clean_data = [];
      for(var i = 0; i < data.rows.length; i++) {
        clean_data.push({
          _id:          data.rows[i].doc._id,
          order_number: data.rows[i].doc.order_number
        });
      }
      this.insert_data(clean_data, source_file_name);
    }
  };
  
  global.database_handler = new database_handler();
  
})(window);

window.webkitRequestFileSystem;
