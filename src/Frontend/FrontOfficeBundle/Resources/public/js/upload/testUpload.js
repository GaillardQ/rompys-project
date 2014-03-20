/*
 * jQuery File Upload Plugin JS Example 8.8.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, regexp: true */
/*global $, window, blueimp */

//url = 'analysis/upload/photos/progression';
url = document.getElementById('fileupload').action;

var allUploadedFiles = new Array();

$(function () {
    'use strict';

    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: url
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
    if (window.location.hostname === 'local.carpaccio') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: url,
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/
                .test(window.navigator.userAgent),
            maxFileSize: 500000000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png|tif)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: url,
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' +
                            new Date())
                    .appendTo('#fileupload');
            });
        }
    }
        // Load existing files:
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: url,
            dataType: 'json',
            context: $('#fileupload')[0]
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            var allImgs = result.files;
            var html_membrane = "";
            var html_cytoplasm = "";
            var html_nucleus = "";
            if(allImgs.length != 0)
            {
                for(var i=0; i<3; i++)
                {
                    var img;
                    if(i < allImgs.length)
                    {  
                        img= allImgs[i];
                    }
                    else
                    {
                        img = new Array();
                        img.name = 'NONE'; 
                    }
                    allUploadedFiles[i] = img.name;

                    if(img.name == img_membrane)
                    {
                        html_membrane += '<option value="'+img.name+'" selected>'+img.name+"</option>";
                    }
                    else
                    {
                        html_membrane += '<option value="'+img.name+'">'+img.name+"</option>";
                    }

                    if(img.name == img_cytoplasm)
                    {
                        html_cytoplasm += '<option value="'+img.name+'" selected>'+img.name+"</option>";     
                    }
                    else
                    {
                        html_cytoplasm += '<option value="'+img.name+'">'+img.name+"</option>";
                    }

                    if(img.name == img_nucleus)
                    {
                        html_nucleus += '<option value="'+img.name+'" selected>'+img.name+"</option>";      
                    }
                    else
                    {
                        html_nucleus += '<option value="'+img.name+'">'+img.name+"</option>";
                    }
                }

                if(allImgs.length == 1)
                {
                    if(html_cytoplasm.indexOf('value="NONE"') == -1)
                    {
                        html_cytoplasm += "<option value='NONE' selected>NONE</option>";
                    }

                    if(html_nucleus.indexOf('value="NONE"') == -1)
                    {
                        html_nucleus += "<option value='NONE' selected>NONE</option>";
                    }
                }
                else if(allImgs.length == 2)
                {
                    if(html_cytoplasm.indexOf('value="NONE"') == -1)
                    {
                        html_cytoplasm += "<option value='NONE'>NONE</option>";
                    }

                    if(html_nucleus.indexOf('value="NONE"') == -1)
                    {
                        html_nucleus += "<option value='NONE' selected>NONE</option>";
                    }
                }
                else if(allImgs.length == 3)
                {
                    if(img_cytoplasm == 'NONE')
                    {
                        html_cytoplasm += "<option value='NONE' selected>NONE</option>";
                    }

                    if(img_nucleus == 'NONE')
                    {
                        html_nucleus += "<option value='NONE' selected>NONE</option>";
                    }
                }

                document.getElementById("carpaccio_picture_cytoplasm").innerHTML = html_cytoplasm;
                document.getElementById("carpaccio_picture_membrane").innerHTML = html_membrane;
                document.getElementById("carpaccio_picture_nucleus").innerHTML = html_nucleus;
            }

            $(this).fileupload('option', 'done')
                .call(this, null, {result: result});
        });

});
