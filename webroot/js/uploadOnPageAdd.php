
var swfu = new SWFUpload({
    upload_url: "/podcast/admin/casts/add",
    flash_url: "/podcast/js/swfupload.swf",

    file_post_name: "data[Cast][audio_file]",
    file_types: "*.mp3;",
    file_types_description: "Audio Files",
    file_size_limit: "100000000",

    button_width: 76,
    button_height: 19,
    button_text_style: ".vidSelect { font-weight: bold; background-color: red; }",
    button_placeholder_id: "uploadButtonSection",
    button_image_url: "/podcast/img/select_video.png",
    button_action: SWFUpload.BUTTON_ACTION.SELECT_FILE,

    swfupload_loaded_handler: function() {
        $('fileInfoInput').value = "swfready";
    },
    file_queue_error_handler: function(file, code, message) {
        $('uploadStatus').innerHTML = message;
        alert(message);
    },
    file_queued_handler: function() {
        this.startUpload();
    },
    upload_start_handler: function(file) {
        document.getElementById("uploadStatus").innerHTML = 'Uploading file...';
        $('fileInfoInput').value = "uploading";
        $('uploadCancel').style.display = 'block';
        return true;
    },
    upload_error_handler: function(file, error_code, message) {
        $('uploadCancel').style.display = '';
        var extra_message = "Please refresh and try again.";
        switch(error_code) {
            case SWFUpload.UPLOAD_ERROR.HTTP_ERROR:
                extra_message = "Please check your internet connection and try again.";
                break;
            case SWFUpload.UPLOAD_ERROR.MISSING_UPLOAD_URL:
                extra_message = "This website needs to be reconfigured.";
                break;
            case SWFUpload.UPLOAD_ERROR.IO_ERROR:
                extra_message = "There was a data I/O error.";
                break;
            case SWFUpload.UPLOAD_ERROR.SECURITY_ERROR:
                extra_message = "Security issue, please ensure that the file is readable by your system.";
                break;
            case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
                extra_message = "The file is too large, please try a smaller resolution or shorter length item.";
                break;
            case SWFUpload.UPLOAD_ERROR.SPECIFIED_FILE_ID_NOT_FOUND:
                extra_message = "Please check that the file exists.";
                break;
            case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
            case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
                $('uploadStatus').innerHTML = "Upload canceled.";
                $('fileInfoInput').value = "Upload was canceled, please reselect a file to upload.";
                return;
        }

        $('uploadStatus').innerHTML = "Upload failed!<br/>" + extra_message;
        $('fileInfoInput').value = "error";

        alert("Upload failed: " + message + error_code + "\n" + extra_message);
    },
    upload_progress_handler: function(file, bytes, total) {
        var progress = parseInt(bytes / total * 100);
        var progress_txt = progress == 100 ? "Processing data..." : "Uploading (" + progress + "% complete)";
        var html = "<div class='uploadProgressContainer'><div class='uploadProgress' style='width: " + progress + "%'></div></div><div class='uploadProgressText'>" + progress_txt + "</div>";
        $('uploadStatus').innerHTML = html;
    },
    upload_success_handler: function(file, data) {
        $('uploadCancel').style.display = '';
        $('submitMe').disabled = 'false';
        if(data.charAt(0) == '@') {
            document.getElementById('CastNewFile').value = data.replace(/@/,'');
            document.getElementById('submitMe').disabled = false;
            this.destroy();
            document.getElementById("flashUploader").innerHTML = 'File uploaded successfully!';
            if($('fileInfoInput').value == "uploading,submit") {
                $('fileInfoInput').value = data;
                $('uploadForm').submit();
            } else {
                $('fileInfoInput').value = data;
            }
        } else {
            var message = "There was an error: " + data;
            $('uploadStatus').innerHTML = message;
            $('fileInfoInput').value = message;
            alert(message);
        }
    }

});

$('uploadForm').addEvent("submit", function(e) {
    var errors = "";
    if($('fileInfoInput').charAt(0) != '@') {
        switch($('fileInfoInput').value) {
            case "error":
                errors += "There was an error uploading the file, please refresh and try again.\n";
                break;
            case "swfready":
                errors += "Please select a file to upload.\n";
                break;
            case "uploading":
                break;
            case "":
                errors += "There was an error with the file upload, please check it and try again.\n";
                break;
            default:
                errors += $('fileInfoInput').value;
                break;
        }
    }

    if($('nameInput').value.length < 3) {
        errors += "Please enter your full name.\n"
    }
    if($('emailInput').value.length < 3) {
        errors += "Please enter your e-mail address.\n"
    } else if(!$('emailInput').value.match(/^.+@.+$/)) {
        errors += "Please enter a valid e-mail address.\n";
    }
    if($('websiteInput').value.length < 3) {
        errors += "Please enter your website's address.\n"
    }

    if(errors) {
        new Event(e).preventDefault();
        alert(errors);
    } else {
        if($('fileInfoInput').value == "uploading") {
            new Event(e).preventDefault();
            $('fileInfoInput').value = "uploading,submit";
            $('submitButtonContainer').innerHTML = "Waiting for upload to complete...";
            return;
        }
    }
});

$('uploadCancel').addEvent("click", function(e) {
    swfu.cancelUpload();
});
