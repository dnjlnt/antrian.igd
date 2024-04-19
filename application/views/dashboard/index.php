
<div class="row" style="height:125px;background:#009688;padding-left:0px;">
    <div class="col-8">
        <p style="color:#fff;margin-top:15px;margin-left:10px;">Ciputra Hospital - <?php echo ($user_unit)?></p>
        <h5 style="color:#fff;margin-left:10px;"><b><?php echo strtoupper($user_fullname)?></b></h5>
        <h6 style="color:#fff;margin-left:10px;">DEVELOPMENT SUPPORT</h6>
    </div>
    <div class="col-4">
        <img src="<?php echo base_url();?>assets/dist/img/avatar5.png" width="70" class="img-circle" style="margin-top:25px;margin-left:15px;">
    </div>
</div>
<div id="demo" class="carousel slide" style="margin-left:5px;margin-right:5px;margin-top:5px;" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url();?>assets/dist/img/cgc.jpg" class="img-responsive rounded" height="170">
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url();?>assets/dist/img/cmh.jpg" class="img-responsive rounded" height="170">
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url();?>assets/dist/img/crt.png" class="img-responsive rounded" height="170">
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<br>
<div class="row">
    <div class="col-lg-3 col-6">
        <a href="<?php echo base_url();?>form">
            <div style="text-align:center;">
                <div class="inner" style="padding: 0px;">
                    <ion-icon name="documents-outline" size="large" style="color:red;"></ion-icon>
                    <p style="font-size:13px;color:#000;">Form Request</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-6">
        <a href="<?php echo base_url();?>attendance">
            <div style="text-align:center;">
                <div class="inner" style="padding: 0px;">
                    <ion-icon name="qr-code-outline" size="large" style="color:blue;"></ion-icon>
                    <p style="font-size:13px;color:#000;">Attendance Meeting</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-6">
        <a href="">
            <div style="text-align:center;">
                <div class="inner" style="padding-top: 7px;">
                    <ion-icon name="document-attach-outline" size="large" style="color:purple;"></ion-icon>
                    <p style="font-size:13px;color:#000;">Document Workflow</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-6">
        <a href="">
            <div style="text-align:center;">
                <div class="inner" style="padding-top: 7px;">
                    <ion-icon name="accessibility-outline" size="large" style="color:orange;"></ion-icon>
                    <p style="font-size:13px;color:#000;">Patient Out</p>
                </div>
            </div>
        </a>
    </div>
</div>
