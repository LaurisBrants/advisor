<?php
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
// Include Spout library 
require_once 'importer/src/Spout/Autoloader/autoload.php';
$date = date('F j, Y');

if (!get_option("adv_date")) {
  add_option("adv_date", $date);
}else{
  update_option( 'adv_date', $date, false );
}

$msg ='';
$erroe_msg  = '';
// this is working to import excelsheet data
if ( !empty( $_FILES['file']['name'] ) ) {
  // Get File extension eg. 'xlsx' to check file is excel sheet
  $pathinfo = pathinfo( $_FILES['file']['name'] );
  // check file has extension xlsx, xls and also check 
  // file is not empty
  if ( ( $pathinfo['extension'] == 'xlsx' || $pathinfo['extension'] == 'xls' ) && $_FILES['file']['size'] > 0 ) {
     
    // Temporary file name
    $inputFileName = $_FILES['file']['tmp_name']; 
    
    // Read excel file by using ReadFactory object.
    $reader = ReaderFactory::create(Type::XLSX);
    
    // Open file
    $reader->open( $inputFileName );
    $count = 1;
    // Number of sheet in excel file
    foreach ( $reader->getSheetIterator() as $sheet ) {
      
      // grab sheet name from existing file
      $existing_file_sheet_name = $sheet->getName();
      if( $existing_file_sheet_name ){
        // Number of Rows in Excel sheet
        foreach ( $sheet->getRowIterator() as $row ) {
          
          // It reads data after header. In the my excel sheet,
          // header is in the first row.
          if ( $count > 1 ) {
            //Here, You can insert data into database.
            global $wpdb;
            $tbl_name = $wpdb->prefix.'adv_table';
            $kv_data = array(
              'category' => $row[0],
              'skill'     => $row[1],
              'gender'   => $row[2],
              'footsize'   => $row[3],
              'wh_product'   => $row[4],
              'advisor'   => $row[5],
              'product_id'   => $row[6],
            );
            $new = $wpdb->insert( $tbl_name, $kv_data );
          }
          $count++;
        }
      }
    }
    // Close excel file
    $reader->close();
    
  } else {
    $erroe_msg = '';
    $erroe_msg = "Please Select Valid Excel File";
  }
}
?>
<div>

<div class="container import-container">
    <h1>Import Advisor Data</h1>
    <p>Please note that you can import XLSL,XLS,CSV file formats.</p>
    <p>In case you are importing multi sheet excel format - import will target first sheet.</p>
    <div id="excelsucess"><?php echo $msg;?></div>
    <div class="upload_error"><?php echo $erroe_msg;?></div>
    <form action="#" method="post" name="myForm" enctype="multipart/form-data" class="upload_excel"> 
    <input type="file" name="file" id="upload_file">
    <input type= "submit" value ="upload" class="submit excel_btn">
    </form>
</div>
<h3>Requirements:</h3>
<p>Max Post Time must be larger than 300s</p>
<script>
jQuery( '.submit' ).click(function(){
  if( jQuery( '#upload_file' ).val().length == 0 ) {
    jQuery( '#excelsucess' ).html( 'Please select file' );      
    return false;
  }
});
</script>
<style>
    .import-container{
        padding-top:15px;
    }
    .excel_btn{
        margin: 0;
        padding: 12px;
        background: #084dff;
        width: 100px;
        color: white;
        text-transform: uppercase;
    }
    .excel_btn:hover{
        cursor:pointer;
    }
    #upload_file{
        background:white;
        padding:10px;
    }
    </style>