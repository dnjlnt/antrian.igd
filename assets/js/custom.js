<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
function tampilkanwaktu(){ 
    var waktu = new Date();
    var sh = waktu.getHours() + "";
    var sm = waktu.getMinutes() + ""; 
    var ss = waktu.getSeconds() + "";
    document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
}

$(function() {
    setInterval(tampilkanwaktu, 1000);
});

$(document).ready(function(){
    $('.patient_mr').click(function(){
        var id = $(this).attr('data-timestamp-id');
        var left = (screen.width - 500) / 2;
        var top = (screen.height - 600) / 4;
        window.open('<?php echo base_url();?>dashboard/formdatapasien/'+id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=400, width=600, scrollbars=1');
    });
});

$(document).ready(function(){
    $('.patient_bed').click(function(){
        var id = $(this).attr('data-timestamp-id');
        var left = (screen.width - 500) / 2;
        var top = (screen.height - 600) / 4;
        window.open('<?php echo base_url();?>dashboard/formbedpatient/'+id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=400, width=600, scrollbars=1');
    });
});

function getPatientTriage(time_stamp_id) {
    var left = (screen.width - 500) / 2;
    var top = (screen.height - 600) / 4;
    window.open('<?php echo base_url();?>dashboard/colortriage/'+time_stamp_id, '_blank', 'toolbar=0, location=0, menubar=0, top='+ top + ', left=' + left + ', height=400, width=600, scrollbars=1');
}

function addPatientMen() {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/addpatientmen',
        data: {},
        success: function (data) {
            if (data == "successsavepatient") {
                window.location.reload();
            } else {
                alert("Gagal menambahkan pasien baru");
                return;
            }
        }
    });
}

function addPatientWomen() {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/addpatientwomen',
        data: {},
        success: function (data) {
            if (data == "successsavepatient") {
                window.location.reload();
            } else {
                alert("Gagal menambahkan pasien baru");
                return;
            }
        }
    });
}

function patientCome(ts_id) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/savepatientcome',
        data: {ts_id:ts_id},
        success: function (data) {
            if (data == "successsavepatientcome") {
                window.location.reload();
            } else {
                alert("Gagal record data");
                return;
            }
        }
    });
}

function patientCheckup(ts_id) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/savepatientcheckup',
        data: {ts_id:ts_id},
        success: function (data) {
            if (data == "successsavepatientcheckup") {
                window.location.reload();
            } else {
                alert("Gagal record data");
                return;
            }
        }
    });
}

function patientObStart(ts_id) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/savepatientobstart',
        data: {ts_id:ts_id},
        success: function (data) {
            if (data == "successsavepatientobstart") {
                window.location.reload();
            } else {
                alert("Gagal record data");
                return;
            }
        }
    });
}

function patientObFinish(ts_id) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/savepatientobfinish',
        data: {ts_id:ts_id},
        success: function (data) {
            if (data == "successsavepatientobfinish") {
                window.location.reload();
            } else {
                alert("Gagal record data");
                return;
            }
        }
    });
}

function patientGo(ts_id) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/savepatientgo',
        data: {ts_id:ts_id},
        success: function (data) {
            if (data == "successsavepatientgo") {
                window.location.reload();
            } else {
                alert("Gagal record data");
                return;
            }
        }
    });
}

function patientTransfer(ts_id) {
    $.ajax({
        type: 'post',
        url: '<?php echo base_url();?>dashboard/savepatienttransfer',
        data: {ts_id:ts_id},
        success: function (data) {
            if (data == "successsavepatienttransfer") {
                window.location.reload();
            } else {
                alert("Gagal record data");
                return;
            }
        }
    });
}

function patientSwap(ts_id) {
    var result = confirm('Hapus data pasien?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatient',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordCome(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatientcome',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordTriage(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatienttriage',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordCheckup(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatientcheckup',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordObstart(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatientobstart',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordObfinish(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatientobfinish',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordGo(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatientgo',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}

function removeRecordTransfer(ts_id) {
    var result = confirm('Hapus record?');
    if(result){
        $.ajax({
            type: 'post',
            url: '<?php echo base_url();?>dashboard/removepatienttransfer',
            data: {ts_id:ts_id},
            success: function (data) {
                if (data == "successremovepatient") {
                    window.location.reload();
                } else {
                    alert("Gagal menghapus data");
                    return;
                }
            }
        });
    } else {
        return false;
    }
}