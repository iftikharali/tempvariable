<?php echo $header; ?>
<!-- Main -->
<div class="container">
  
  <!-- upper section -->
  <div class="row">
	<div class="col-sm-3">
      <!-- left -->
      <?php echo $rightNavigation; ?>
      
  	</div><!-- /span-3 -->
    <div class="col-sm-9">
      	
      <!-- column 2 -->	
       <h3><i class="glyphicon glyphicon-dashboard"></i> Dashboard</h3>  
            
       <hr>
      
	   <div class="row">
            <!-- center left-->	
         	<div class="col-md-7">
			  <?php echo $content; ?>                    
              
          	</div><!--/col-->
         
            <!--center-right-->
        	<div class="col-md-5">
              
                <?php echo $right_content; ?>
              
			</div><!--/col-span-6-->
     
       </div><!--/row-->
  	</div><!--/col-span-9-->
    
  </div><!--/row-->
  <!-- /upper section -->
  
  <!-- lower section -->
  <div class="row">
    
    <div class="col-md-12">
      <hr>
      <a href="#"><strong><i class="glyphicon glyphicon-list-alt"></i> Our Frequently Used Tools</strong></a>  
      <hr>    
    </div>
    <div class="col-md-8">
      
      <table class="table table-striped">
        <thead>
          <tr>
            <th>
              Visits
            </th>
            <th>
              Tools
            </th>
            <th>
              Source
            </th>
            <th>
              Description
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              45
            </td>
            <td>
              Data Generator
            </td>
            <td>
              Direct
            </td>
            <td>
              Tools used to generate Dummy data for you, just provide the number of column and type it will automatically generate Mock data for you.
            </td>
          </tr>
          <tr>
            <td>
              289
            </td>
            <td>
              Automation Email
            </td>
            <td>
              Referral
            </td>
            <td>
              Using this Automation Email tool you can automate sending Emails to the person you want. 
             </td>
           </tr>
          <tr>
            <td>
              98
            </td>
            <td>
              Converter
            </td>
            <td>
              Type
            </td>
            <td>
              Using Converter tool you can convert from any type of data like CSV,SQL,Excel etc to any type like CSV,SQL Excel and so on.
            </td>
          </tr>
          <tr>
            <td>
              109
            </td>
            <td>
              Web Site Template
            </td>
            <td>
              ..
            </td>
            <td>
              We provide huge number of free website template which are responsive and developed using Bootstrap and Foundation.
            </td>
          </tr>
          <tr>
            <td>
              34
            </td>
            <td>
              Online Tests
            </td>
            <td>
              ..
            </td>
            <td>
              Online Test is a place where you can find for many competition exam mock test. You can test your knowledge and preparation here compltely free.
            </td>
          </tr>
        </tbody>
      </table>
      
      <hr>              
      
      <!--tabs-->
      <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav-tabs" id="myTab">
          <li class="active"><a href="#user" data-toggle="tab">Top Users</a></li>
          <li><a href="#comments" data-toggle="tab">Top Comments</a></li>
          <li><a href="#discussion" data-toggle="tab">Top Discussion</a></li>
        </ul>
        
        <div class="tab-content">
          <div class="tab-pane active" id="user">
            <!-- <h4><i class="glyphicon glyphicon-user"></i></h4> -->
            <div class="row">
              <div class="col-lg-1">
                <image class="user-min" src="<?php echo base_url();?>resources/images/blog/avatar2.png" />
              </div>
              <div class="col-lg-11">
                <span class="user-name"><a href="#">Iftikhar Ali Ansari</a></span><hr class="form-group-hr">
                Software Engineer at Ellipsonic, Bangalore.
              </div>
            </div>
          </div>
          <div class="tab-pane" id="comments">
            <div class="row">
              <div class="col-lg-1">
                <image class="user-min" src="<?php echo base_url();?>resources/images/blog/avatar2.png" />
              </div>
              <div class="col-lg-11">
                <span class="user-name"><a href="#">Iftikhar Ali Ansari</a></span><hr class="form-group-hr">
                Software Engineer at Ellipsonic, Bangalore.
              </div>
            </div>
          </div>
          <div class="tab-pane" id="discussion">
            Coming soon..
          </div>
        </div>
      </div>
      </div>
      <!--/tabs-->
      
      <hr>
      
      <div class="panel panel-default">
        <div class="panel-heading"><h4>New Requests</h4></div>
        <div class="panel-body">
          <div class="list-group">
            <a href="#" class="list-group-item active">Hosting virtual mailbox serv..</a>
            <a href="#" class="list-group-item">Dedicated server doesn't..</a>
            <a href="#" class="list-group-item">RHEL 6 install on new..</a>
          </div>
        </div>
      </div>
      
      <hr>
      
      <div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please remember to <a href="#">Logout</a> for classified security.
      </div>

    
    </div>
    <div class="col-md-4">
      
      <ul class="nav nav-pills nav-stacked">
        <li class="nav-header"></li>
        <li><a href="#"><i class="glyphicon glyphicon-list"></i> Layouts &amp; Templates</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="glyphicon glyphicon-briefcase"></i> Toolbox</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-link"></i> Widgets</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-list-alt"></i> Reports</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-book"></i> Pages</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="glyphicon glyphicon-star"></i> Social Media</a></li>
      </ul>
      
      <hr>
              
      <div class="panel panel-default">
        <div class="panel-heading">
          <div class="panel-title">
            <i class="glyphicon glyphicon-wrench pull-right"></i>
            <h4>Submit Request</h4>
          </div>
        </div>
        <div class="panel-body">
          
          <form class="form form-vertical">
            <div class="control-group">
              <label>Name</label>
              <div class="controls">
                <input type="text" class="form-control" placeholder="Enter Name">
              </div>
            </div>      
            <div class="control-group">
              <label>Title</label>
              <div class="controls">
                <input type="password" class="form-control" placeholder="Password">
                
              </div>
            </div>   
            <div class="control-group">
              <label>Details</label>
              <div class="controls">
                <textarea class="form-control"></textarea>
              </div>
            </div> 
            <div class="control-group">
              <label>Select</label>
              <div class="controls">
                <select class="form-control"><option>General Question</option><option>Server Issues</option><option>Billing Question</option></select>
              </div>
            </div>    
            <div class="control-group">
              <label></label>
              <div class="controls">
                <button type="submit" class="btn btn-primary">
                  Post
                </button>
              </div>
            </div>   
            
          </form>
          
          
        </div><!--/panel content-->
      </div><!--/panel-->
      
      <div class="panel panel-default">
        <div class="panel-heading"><div class="panel-title"><h4>Meet Our Team</h4></div></div>
        <div class="panel-body">	
          <div class="col-xs-4 text-center"><img src="<?php echo base_url(); ?>/resources/images/users/iftikhar.png" class="img-circle img-responsive"></div>
          <div class="col-xs-4 text-center"><img src="<?php echo base_url(); ?>/resources/images/users/rajendra_pandey.png" class="img-circle img-responsive"></div>
          <div class="col-xs-4 text-center"><img src="http://placehold.it/80/EEEEEE/222" class="img-circle img-responsive"></div>
        </div>
      </div><!--/panel-->
    
    </div><!--/col-->
    
  </div><!--/row-->
  
</div><!--/container-->
<!-- /Main -->
<?php echo $footer; ?>