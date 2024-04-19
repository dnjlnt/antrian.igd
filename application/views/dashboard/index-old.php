<style>
    .slider {
        width: 100%;
        text-align: center;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .slides {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    .slides::-webkit-scrollbar {
        width: 10px;
        height: 10px;
    }

    .slides::-webkit-scrollbar-thumb {
        background: black;
        border-radius: 10px;
    }

    .slides::-webkit-scrollbar-track {
        background: transparent;
    }
    .slides > div {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: 100%;
        background: #eee;
        transform-origin: center center;
        transform: scale(1);
        transition: transform 0.5s;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 100px;
    }

    .slides > div:target {
        /*   transform: scale(0.8); */
    }

    .author-info {
        background: rgba(0, 0, 0, 0.75);
        color: white;
        padding: 0.75rem;
        text-align: center;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        margin: 0;
    }

    .author-info a {
        color: white;
    }

    .slider > a {
        display: inline-flex;
        width: 1rem;
        height: 1rem;
        font-size:11px;
        background: white;
        text-decoration: none;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 0 0.5rem 0;
        position: relative;
    }

    .slider > a:active {
        top: 1px;
    }

    .slider > a:focus {
        background: #28A745;
        color: #fff;
    }

    @supports (scroll-snap-type) {
        .slider > a {
            display: none;
        }
    }
</style>
<div class="row" style="height:125px;background:#009688;padding-left:0px;">
    <div class="col-lg-3 col-9">
        <p style="color:#fff;margin-top:15px;margin-left:10px;">Ciputra Hospital - <?php echo ($user_unit)?></p>
        <h5 style="color:#fff;margin-left:10px;"><b><?php echo strtoupper($user_fullname)?></b></h5>
        <h6 style="color:#fff;margin-left:10px;">DEVELOPMENT SUPPORT</h6>
    </div>
    <div class="col-lg-3 col-3">
        
    </div>
</div>
<div class="row">
    <div class="slider">
        <div class="slides">
            <div id="slide-1">
                <img src="<?php echo base_url();?>assets/dist/img/cgc.jpg" class="img-responsive" style="height:200px;width:100%;">
            </div>
            <div id="slide-2">
                <img src="<?php echo base_url();?>assets/dist/img/crt.png" class="img-responsive" style="height:200px;width:100%;">
            </div>
            <div id="slide-3">
                <img src="<?php echo base_url();?>assets/dist/img/cmh.jpg" class="img-responsive" style="height:200px;width:100%;">
            </div>
            <div id="slide-4">
                <img src="">
            </div>
        </div>
        <a href="#slide-1">1</a>
        <a href="#slide-2">2</a>
        <a href="#slide-3">3</a>
        <a href="#slide-4">4</a>
    </div>
</div>
<hr>
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
<hr>