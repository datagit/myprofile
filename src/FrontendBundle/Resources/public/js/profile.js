/**
 * Created by dat on 7/9/15.
 */
$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'inline';
    $.fn.editable.defaults.url = linkUpdateProfileAtEdit;

    //enable / disable
    //$('#enable').click(function() {
    //    $('.editable').editable('toggleDisabled');
    //});

    //make username editable
    $('#firstName').editable('option', 'validate', function(v) {
        if(!v) return 'Required field!';
    });

    $('#lastName').editable('option', 'validate', function(v) {
        if(!v) return 'Required field!';
    });

    $('#jobTitle').editable('option', 'validate', function(v) {
        if(!v) return 'Required field!';
    });

    $('#categoriesJson').editable({
        inputclass: 'input-large',
        select2: {
            tags: ['php', 'java-web', 'java-android', 'ajax'],
            tokenSeparators: [",", " "]
        }
    });

    $('#phone').editable();

    var year = [];
    var d = new Date();
    var n = d.getFullYear() - 15;
    for(var i = n; i > 1960; i--) {
        year.push({"value": i, "text": i});
    }
    $('#birthday').editable({
        prepend: "not selected",
        source: year
    });

    $('#sex').editable({
        prepend: "not selected",
        source: [
            {value: 1, text: 'Male'},
            {value: 2, text: 'Female'},
            {value: 3, text: 'Other'}
        ],
        display: function(value, sourceData) {
            var colors = {"": "gray", 1: "green", 2: "blue", 3: "blue"},
                elem = $.grep(sourceData, function(o){return o.value == value;});

            if(elem.length) {
                $(this).text(elem[0].text).css("color", colors[value]);
            } else {
                $(this).empty();
            }
        }
    });

    $('#summary').editable({
        showbuttons: 'bottom',
        inputclass: 'summary_wh'
    });

    $('#researchInterests').editable({
        showbuttons: 'bottom',
        inputclass: 'summary_wh'
    });


    //st job------------------------------------
    $('.add_experience').on('click', function(){
        $('#btnRemoveExperience').hide();
        //reset value
        $('#cname').val('');
        $('#ctitle').val('');
        $('#cdescription').val('');
        $('#cstart_time').val('');
        $('#cend_time').val('');
        $('#ccurrent_job').removeAttr("checked");
        $('#corder').val('');
        $('#cid').val('');
    });

    $('.edit_experience').on('click', function(e){
        $('#btnRemoveExperience').show();
    });

    $('#btnSaveExperience').on('click', function() {
        var cid = $('#cid');
        var cname = $('#cname');
        var ctitle = $('#ctitle');
        var cstartTime = $('#cstart_time');
        var cendTime = $('#cend_time');
        var cdescription = $('#cdescription');
        var ccurrentJob = $('#ccurrent_job');
        var corder = $('#corder');
        var current = 0;
        if(ccurrentJob.checked) {
            current = 1;
        }

        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkUpdateJobsHistoryAtEdit,
            data: {
                cid: cid.val(),
                cname: cname.val(),
                ctitle: ctitle.val(),
                cstart_time: cstartTime.val(),
                cend_time: cendTime.val(),
                cdescription: cdescription.val(),
                ccurrent_job: current,
                corder: corder.val()
                }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#jobs_history').html(res.html);
                    $("#myModal").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });

    });

    $('#btnRemoveExperience').on('click', function() {
        var cid = $('#cid');
        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkRemoveJobsHistoryAtEdit,
            data: {
                cid: cid.val()
            }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#jobs_history').html(res.html);
                    $("#myModal").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });

    });
    //ed job------------------------------------

    //st skill------------------------------------
    $('#btnSaveSkill').on('click', function() {
        var sid = $('#sid');
        var sname = $('#sname');
        var slevel = $('#slevel');
        var sverified = $('#sverified');

        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkUpdateSkillAtEdit,
            data: {
                sid: sid.val(),
                sname: sname.val(),
                slevel: slevel.val(),
                sverified: sverified.val()
            }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#skill').html(res.html);
                    $("#myModalSkill").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });

    });

    $('.add_skill').on('click', function(){
        $('#btnRemoveSkill').hide();
        //reset value
        $('#sname').val('');
        $('#slevel').val('');
        $('#sverified').val('');
        $('#sid').val('');
    });

    $('.edit_skill').on('click', function(e){
        $('#btnRemoveSkill').show();
    });

    $('#btnRemoveSkill').on('click', function() {
        var sid = $('#sid');
        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkRemoveSkillAtEdit,
            data: {
                sid: sid.val()
            }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#skill').html(res.html);
                    $("#myModalSkill").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });

    });
    //ed skill------------------------------------
    //st education------------------------------------
    $('.add_education').on('click', function(){
        $('#btnRemoveEducation').hide();
        //reset value
        $('#ename').val('');
        $('#emajor').val('');
        $('#estart_time').val('');
        $('#eend_time').val('');
        $('#eorder').val('');
        $('#eid').val('');
    });

    $('.edit_education').on('click', function(e){
        $('#btnRemoveEducation').show();
    });

    $('#btnSaveEducation').on('click', function() {
        var ename = $('#ename');
        var emajor = $('#emajor');
        var estartTime = $('#estart_time');
        var eendTime = $('#eend_time');
        var eorder = $('#eorder');
        var eid = $('#eid');

        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkUpdateEducationAtEdit,
            data: {
                eid: eid.val(),
                ename: ename.val(),
                emajor: emajor.val(),
                estart_time: estartTime.val(),
                eend_time: eendTime.val(),
                eorder: eorder.val()
            }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#education').html(res.html);
                    $("#myModalEducation").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });

    });

    $('#btnRemoveEducation').on('click', function() {
        var eid = $('#eid');
        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkRemoveEducationAtEdit,
            data: {
                eid: eid.val()
            }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#education').html(res.html);
                    $("#myModalEducation").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });

    });
    //ed education------------------------------------

    //st upload image--------------------------------
    $('#profile_photo').change(function(){
        previewPhotoURL(this);
        if($(this).val() != '') {
            var formData = new FormData();
            formData.append('file', $(this)[0].files[0]);
            $.ajax({
                url: linkUpdatePhotoAtEdit,
                type: 'POST',
                data: formData,
                success: function (r) {
                    if(r.status == 200) {
                        //success work
                        $('#profile_photo').attr('newurl', r.newurl);
                        $('#profile_photo').attr('filename', r.filename);
                        $('#reviewPhoto').attr('src', r.newurl);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });
    $('#btnSavePhoto').on('click', function() {
        //update photo profile
        var btn = $(this);
        btn.button('loading');
        $.ajax({
            method: "POST",
            url: linkMovePhotoAtEdit,
            data: {
                filename: $('#profile_photo').attr('filename')
            }
        })
            .done(function(res) {
                if( res.status == 200 ) {
                    $('#profilePhoto').attr('src', res.newurl);
                    $("#myModalUploadPhoto").modal("hide");
                } else {

                }
            })
            .always(function () {
                btn.button('reset')
            });


    });
    //ed upload image--------------------------------

});

function editJobProfile(job) {
    var item = $.parseJSON(job);
    $('#cname').val(item.name);
    $('#ctitle').val(item.title);
    $('#cdescription').val(item.description);
    $('#cstart_time').val(item.start_time);
    $('#cend_time').val(item.end_time);
    if(item.current_job == '1') {
        $('#ccurrent_job').attr("checked","checked");
    }
    $('#corder').val(item.order);
    $('#cid').val(item.id);
}

function editSkillProfile(skill) {
    var item = $.parseJSON(skill);
    $('#sname').val(item.name);
    $('#slevel').val(item.level);
    $('#sverified').val(item.verified);
    $('#sid').val(item.id);
}

function editEducationProfile(edu) {
    var item = $.parseJSON(edu);
    $('#ename').val(item.name);
    $('#emajor').val(item.major);
    $('#estart_time').val(item.start_time);
    $('#eend_time').val(item.end_time);
    $('#eorder').val(item.order);
    $('#eid').val(item.id);
}

function previewPhotoURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#reviewPhoto').attr('src', e.target.result);
            //$('#preview').css("background", "url(" + e.target.result +")" + " right top no-repeat");
        }

        reader.readAsDataURL(input.files[0]);
    }
}
