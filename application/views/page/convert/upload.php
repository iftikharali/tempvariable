<div class="well"><u>What is Tempvariable Converter </u>
    <p>
      The TempVariable online converter let you convert free Json, CSV, Excel 2003 or Excel 2007, SQL,
       Fixed width text data, User defined delimeter and many more type of data to Json, CSV, Excel 2003 or Excel 2007, SQL,
        Fixed width text data, User defined delimeter. In no time you will get your converted data on your computer.
    </p>
</div>
<div class="panel-body">
          
          <!-- <form class="form form-vertical" action="<?php echo base_url();?>converter/convert" method="post" accept-charset="utf-8" enctype="multipart/form-data">   -->
          <?php echo form_open_multipart(base_url().'converter/upload');?>
            <div class="control-group">
              <label>Select Source file</label>
              <div class="controls">
                <input type="file" name="userfile" size="20"  class="form-control"/>
              </div>
            </div> <hr />
            <div class="control-group">
              <label>Select destination type to convert</label>
              <div class="controls">
                <select class="form-control" id="destinationType" name="ctype">
                  <option value="0">Select type</option>
                  <option value="1">MySQL</option>
                  <option value="2">JSON</option>
                  <option value="3">Excel</option>
                  <option value="4">CSV</option>
                  <option value="5">User Defined delimeter</option>
                </select>
              </div>
            </div> 
            <hr />
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cheader"> My data contains header.
              </label>
            </div>    
            <div class="control-group">
              <label></label>
              <div class="controls">
                <button type="submit" id="convertSubmit" class="btn btn-primary">
                  Convert
                </button>
              </div>
            </div>   
            
          </form>
          
          
        </div><!--/panel content-->