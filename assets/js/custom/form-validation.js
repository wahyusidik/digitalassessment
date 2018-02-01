var FormValidation = function () {

    // basic validation
    var handleValidation1 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form1 = $('#form_sample_1');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    digits: {
                        required: true,
                        digits: true
                    },
                    creditcard: {
                        required: true,
                        creditcard: true
                    },
                    occupation: {
                        minlength: 5,
                    },
                    select: {
                        required: true
                    },
                    select_multi: {
                        required: true,
                        minlength: 1,
                        maxlength: 3
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                }
            });


    }

    // validation using icons
    var handleValidation2 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form2 = $('#form_sample_2');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    url: {
                        required: true,
                        url: true
                    },
                    number: {
                        required: true,
                        number: true
                    },
                    digits: {
                        required: true,
                        digits: true
                    },
                    creditcard: {
                        required: true,
                        creditcard: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    Metronic.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    form[0].submit(); // submit the form
                }
            });


    }

    // advance validation
    var handleValidation3 = function() {
        // for more info visit the official plugin documentation: 
        // http://docs.jquery.com/Plugins/Validation

            var form3 = $('#form_sample_3');
            var error3 = $('.alert-danger', form3);
            var success3 = $('.alert-success', form3);

            //IMPORTANT: update CKEDITOR textarea with actual content before submit
            form3.on('submit', function() {
                for(var instanceName in CKEDITOR.instances) {
                    CKEDITOR.instances[instanceName].updateElement();
                }
            })

            form3.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                rules: {
                    name: {
                        minlength: 2,
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },  
                    options1: {
                        required: true
                    },
                    options2: {
                        required: true
                    },
                    select2tags: {
                        required: true
                    },
                    datepicker: {
                        required: true
                    },
                    occupation: {
                        minlength: 5,
                    },
                    membership: {
                        required: true
                    },
                    service: {
                        required: true,
                        minlength: 2
                    },
                    markdown: {
                        required: true
                    },
                    editor1: {
                        required: true
                    },
                    editor2: {
                        required: true
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    membership: {
                        required: "Please select a Membership type"
                    },
                    service: {
                        required: "Please select  at least 2 types of Service",
                        minlength: jQuery.validator.format("Please select  at least {0} types of Service")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.parent(".input-group").size() > 0) {
                        error.insertAfter(element.parent(".input-group"));
                    } else if (element.attr("data-error-container")) { 
                        error.appendTo(element.attr("data-error-container"));
                    } else if (element.parents('.radio-list').size() > 0) { 
                        error.appendTo(element.parents('.radio-list').attr("data-error-container"));
                    } else if (element.parents('.radio-inline').size() > 0) { 
                        error.appendTo(element.parents('.radio-inline').attr("data-error-container"));
                    } else if (element.parents('.checkbox-list').size() > 0) {
                        error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));
                    } else if (element.parents('.checkbox-inline').size() > 0) { 
                        error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success3.hide();
                    error3.show();
                    Metronic.scrollTo(error3, -200);
                },

                highlight: function (element) { // hightlight error inputs
                   $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    success3.show();
                    error3.hide();
                    form[0].submit(); // submit the form
                }

            });

             //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('.select2me', form3).change(function () {
                form3.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });

            // initialize select2 tags
            $("#select2_tags").change(function() {
                form3.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input 
            }).select2({
                tags: ["red", "green", "blue", "yellow", "pink"]
            });

            //initialize datepicker
            $('.date-picker').datepicker({
                rtl: Metronic.isRTL(),
                autoclose: true
            });
            $('.date-picker .form-control').change(function() {
                form3.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input 
            })
    }

    // basic validation
    var handleUploadDoc= function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form = $('#uploadfile-form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: { },
                rules: {},

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    bootbox.confirm("Unggah semua file ?", function(result) {
                        if( result == true ){
                            $.ajax({
                                type:   "POST",
                                url:    url,
                                beforeSend: function (){
                                },
                                success: function( response ){
                                    response = $.parseJSON(response);
                                    if(response.message == 'error'){
                                        success.hide();
                                        error.empty();
                                        error.html(response.data).fadeIn('fast');
                                    }else if(response.message == 'success'){
                                        error.hide();
                                        success.empty();
                                        success.html(response.data).fadeIn('fast');
                                    }
                                }
                            });
                        }
                    });
                }
            });


    }

    var handleValidationAddAssessment = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var formassessment = $('#addassessment');
            
            var error = $('.alert-danger', formassessment);
            var success = $('.alert-success', formassessment);

            formassessment.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    number: "Nomor diperlukan.",
                    type: "Jenis diperlukan",
                    year: "Tahun diperlukan",
                    position: "Posisi diperlukan",
                    date: "Tanggal diperlukan",
                    time: "Jam diperlukan",
                    room: "Ruangan diperlukan",
                    moderator: "Moderator diperlukan",
                    participants: "Peserta diperlukan",
                    assessors: "Assessor diperlukan",
                },
                rules: {
                    number: {
                        required: true
                    },
                    type: {
                        required: true,
                    },
                    year: {
                        required: true,
                    },
                    position: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    room: {
                        required: true,
                    },
                    moderator: {
                        required: true
                    },
                    participants: {
                        required: true
                    },
                    assessors: {
                        required: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    bootbox.confirm("Simpan Data Assessment ?", function(result) {
                        if( result == true ){
                            $.ajax({
                                type:   "POST",
                                url:    $(form).attr('action'),
                                data: $(form).serialize(),
                                beforeSend: function (){
                                },
                                success: function( response ){
                                    response = $.parseJSON(response);
                                    if(response.message == 'error'){
                                        success.hide();
                                        error.empty();
                                        error.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(formassessment, -200);

                                    }else if(response.message == 'success'){
                                        error.hide();
                                        success.empty();
                                        success.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(formassessment, -200);

                                    }
                                }
                            });
                        }
                    });
                }
            });


    }
    var handleValidationAddAssessmentProgram = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var formassessment = $('#addassessmentprogram');
            
            var error = $('.alert-danger', formassessment);
            var success = $('.alert-success', formassessment);

            formassessment.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    number: "Nomor diperlukan.",
                    type: "Jenis diperlukan",
                    title: "Judul diperlukan",
                    year: "Tahun diperlukan",
                    position: "Posisi diperlukan",
                    datestart: "Tanggal selesai diperlukan",
                    dateend: "Tanggal selesai diperlukan",
                    uploadstart: "Tanggal mulai unggah dokumen diperlukan",
                    uploadend: "Tanggal selesai unggah dokumen diperlukan",
                    'docs[]': "Jenis dokumen diperlukan",
                    'tools[]': "Tools diperlukan",
                },
                rules: {
                    title: {
                        required: true
                    },
                    number: {
                        required: true
                    },
                    type: {
                        required: true,
                    },
                    year: {
                        required: true,
                    },
                    position: {
                        required: true,
                    },
                    datestart: {
                        required: true,
                    },
                    dateend: {
                        required: true,
                    },
                    uploadstart: {
                        required: true,
                    },
                    uploadend: {
                        required: true,
                    },
                    'docs[]': {
                        required: true
                    },
                    'tools[]': {
                        required: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    bootbox.confirm("Simpan Data Assessment ?", function(result) {
                        if( result == true ){
                            $.ajax({
                                type:   "POST",
                                url:    $(form).attr('action'),
                                data: $(form).serialize(),
                                beforeSend: function (){
                                },
                                success: function( response ){
                                    response = $.parseJSON(response);
                                    if(response.message == 'error'){
                                        success.hide();
                                        error.empty();
                                        error.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(formassessment, -200);

                                    }else if(response.message == 'success'){
                                        error.hide();
                                        success.empty();
                                        success.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(formassessment, -200);

                                    }
                                }
                            });
                        }
                    });
                }
            });


    }
    var handleValidationAddAssessment = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var formassessment = $('#addassessment');
            
            var error = $('.alert-danger', formassessment);
            var success = $('.alert-success', formassessment);

            formassessment.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    number: "Nomor diperlukan.",
                    type: "Jenis diperlukan",
                    year: "Tahun diperlukan",
                    position: "Posisi diperlukan",
                    date: "Tanggal diperlukan",
                    time: "Jam diperlukan",
                    room: "Ruangan diperlukan",
                    moderator: "Moderator diperlukan",
                    'participants[]': "Peserta diperlukan",
                    'assessors[]': "Assessor diperlukan",
                },
                rules: {
                    number: {
                        required: true
                    },
                    type: {
                        required: true,
                    },
                    year: {
                        required: true,
                    },
                    position: {
                        required: true,
                    },
                    date: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    room: {
                        required: true,
                    },
                    moderator: {
                        required: true
                    },
                    'participants[]': {
                        required: true
                    },
                    'assessors[]': {
                        required: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    bootbox.confirm("Simpan Data Assessment ?", function(result) {
                        if( result == true ){
                            $.ajax({
                                type:   "POST",
                                url:    $(form).attr('action'),
                                data: $(form).serialize(),
                                beforeSend: function (){
                                },
                                success: function( response ){
                                    response = $.parseJSON(response);
                                    if(response.message == 'error'){
                                        success.hide();
                                        error.empty();
                                        error.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(formassessment, -200);

                                    }else if(response.message == 'success'){
                                        error.hide();
                                        success.empty();
                                        success.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(formassessment, -200);

                                    }
                                }
                            });
                        }
                    });
                }
            });


    }
    var handleValidationAddReportLgd = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form = $('#addreportlgd');
            var id = $('#addreportlgd');
            
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: "Isian ini diperlukan.",
                rules: {
                        required: true
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    bootbox.confirm("Simpan Laporan Assessment ?", function(result) {
                        if( result == true ){
                            $.ajax({
                                type:   "POST",
                                url:    $(form).attr('action'),
                                data: $(form).serialize(),
                                beforeSend: function (){
                                },
                                success: function( response ){
                                    response = $.parseJSON(response);
                                    if(response.message == 'error'){
                                        success.hide();
                                        error.empty();
                                        error.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(form, -200);

                                    }else if(response.message == 'success'){
                                        error.hide();
                                        success.empty();
                                        success.html(response.data).fadeIn('fast');
                                        id.find('input').attr('readonly','true');
                                        id.find('textarea').attr('readonly','true');
                                        Metronic.scrollTo(form, -200);

                                    }
                                }
                            });
                        }
                    });
                }
            });


    }

    var handleValidationAddReport = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

        var formreport = $('.addreportform');
        // var id = form.attr('id');
        // var form_id = $('#'+id);
        var error = $('.alert-danger', formreport);
        var success = $('.alert-success', formreport);
        formreport.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                note_assesse:"Isian ini diperlukan.",
            } ,
            rules: {
                    note_assesse: {
                        required: true
                    },
                    'note_assesse_other[]': {
                        required: true
                    },
                },
            fields: {
                'note_assesse_other[]': {
                    validators: {
                        notEmpty: {
                            message: 'The editor names are required'
                        }
                    }
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit              
                success.hide();
                error.show();
                Metronic.scrollTo(error, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                bootbox.confirm("Simpan Laporan Assessment ?", function(result) {
                    if( result == true ){
                        $.ajax({
                            type:   "POST",
                            url:    $(form).attr('action'),
                            data: $(form).serialize(),
                            beforeSend: function (){
                            },
                            success: function( response ){
                                response = $.parseJSON(response);
                                if(response.message == 'error'){
                                    success.hide();
                                    error.empty();
                                    error.html(response.data).fadeIn('fast');
                                    // Metronic.scrollTo(form_id, -200);

                                }else if(response.message == 'success'){
                                    error.hide();
                                    success.empty();
                                    success.html(response.data).fadeIn('fast');
                                    formreport.find('input').attr('readonly','true');
                                    formreport.find('textarea').attr('readonly','true');
                                    formreport.find('input[type=radio]').attr('disabled', true);
                                    formreport.find('button').addClass('disabled');
                                    // alert(id);
                                    Metronic.scrollTo(formreport, -200);

                                }
                            }
                        });
                    }
                });
            }
        });
    }
    var handleValidationAddReportFinal = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

        var form = $('form.addreportfinal');

        form.each(function(){
            var form_id = $(this).attr('id');
            var form_id = $('#'+form_id);
            var error = $('.alert-danger', form_id);
            var success = $('.alert-success', form_id);
            form_id.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: "Isian ini diperlukan.",
                rules: {
                        required: true
                },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    bootbox.confirm("Simpan Laporan Akhir Assessment ?", function(result) {
                        if( result == true ){
                            $.ajax({
                                type:   "POST",
                                url:    $(form).attr('action'),
                                data: $(form).serialize(),
                                beforeSend: function (){
                                },
                                success: function( response ){
                                    response = $.parseJSON(response);
                                    if(response.message == 'error'){
                                        success.hide();
                                        error.empty();
                                        error.html(response.data).fadeIn('fast');
                                        Metronic.scrollTo(form_id, -200);

                                    }else if(response.message == 'success'){
                                        error.hide();
                                        success.empty();
                                        success.html(response.data).fadeIn('fast');
                                        form_id.find('input').attr('readonly','true');
                                        form_id.find('input[type=radio]').attr('disabled', true);
                                        form_id.find('textarea').attr('readonly','true');
                                        form_id.find('button').addClass('disabled');
                                        Metronic.scrollTo(form_id, -200);

                                    }
                                }
                            });
                        }
                    });
                }
            });
        });
    }

    var handleValidationAddReportFinalold = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form = $('form.addreportfinal');
            

            form.each(function(){
                var form_id = $(this).attr('id');
                var form_id = $('#'+form_id);
                var error = $('.alert-danger', form_id);
                var success = $('.alert-success', form_id);
                form_id.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "",  // validate all fields including form hidden input
                    messages: "Isian ini diperlukan.",
                    rules: {
                            required: true
                    },

                    invalidHandler: function (event, validator) { //display error alert on form submit              
                        success.hide();
                        error.show();
                        Metronic.scrollTo(error, -200);
                    },

                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        label
                            .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },

                    submitHandler: function (form) {
                        bootbox.confirm("Simpan Laporan Final Assessment ?", function(result) {
                            if( result == true ){
                                $.ajax({
                                    type:   "POST",
                                    url:    $(form).attr('action'),
                                    data: $(form).serialize(),
                                    beforeSend: function (){
                                    },
                                    success: function( response ){
                                        response = $.parseJSON(response);
                                        if(response.message == 'error'){
                                            success.hide();
                                            error.empty();
                                            error.html(response.data).fadeIn('fast');
                                            // Metronic.scrollTo(form, -200);

                                        }else if(response.message == 'success'){
                                            error.hide();
                                            success.empty();
                                            success.html(response.data).fadeIn('fast');
                                            form_id.find('input').attr('readonly','true');
                                            // Metronic.scrollTo(form, -200);
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            });
    }
    var handleWysihtml5 = function() {
        if (!jQuery().wysihtml5) {
            
            return;
        }

        if ($('.wysihtml5').size() > 0) {
            $('.wysihtml5').wysihtml5({
                "stylesheets": ["../../assets/global/plugins/bootstrap-wysihtml5/wysiwyg-color.css"]
            });
        }
    }

    return {
        //main function to initiate the module
        init: function () {

            handleWysihtml5();
            // handleValidation1();
            // handleValidation2();
            // handleValidation3();
            handleValidationAddAssessmentProgram();
            handleValidationAddAssessment();
            handleValidationAddReport();

            handleValidationAddReportLgd(); 
            handleValidationAddReportFinal();


        }

    };

}();