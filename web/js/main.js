$(document).ready(function(){
    $('#singlebulk-form .btn-primary').click(function(){
        $('#singlebulk_flag').val('1');
    });
    //singlebulk page
    $('.singlebulk_check_css').click(function(){
        var selected_count = $('.singlebulk_table input[type="checkbox"]:checked').length;
        var total_count = 0;
        $('.singlebulk_table input[type="checkbox"]:checked').each(function()
        {
            if($(this).attr('class') != 'select-on-check-all'){
                var ss = $(this).parent().next().next().html();
                start = ss.search('\\(');
                end = ss.search('\\)');
                ss = ss.slice(start+1,end);
                total_count = total_count + parseInt(ss);
            } else {
                selected_count--;
            }
        });
        
        var str = selected_count+" items selected(total:" +total_count+")";
        $('.notifyjs-corner').empty();
        var noteOption = {
            clickToHide : true,
            autoHide : false,
            globalPosition : 'top center',
            style : 'bootstrap',
            className : 'error',
            showAnimation : 'slideDown',
            showDuration : 200,
            gap : 20,
        }
        $.notify.defaults(noteOption);
        $.notify.addStyle('happyblue', {
          html: "<div><span data-notify-text/></div>",
          classes: {
            base: {
              "white-space": "nowrap",
              "background-color": "#333399",
              "padding": "10px",
              "margin-top" : "45px",
              "border-radius" : "5px"
            },
            superblue: {
              "color": "white",
            }
          }
        });
        $.notify(str,{style:'happyblue',className:'superblue'});
    });

    $('.havenum .select-on-check-all').click(function(){
        var selected_count = 0;;
        var str = "0 items selected(total:0)";
        if($(this).is(':checked')) {
            selected_count = $('.singlebulk_table input[type="checkbox"]').length - 1;
            var total_count = 0;
            $('.singlebulk_table input[type="checkbox"]').each(function()
            {
                if($(this).attr('class') != 'select-on-check-all'){
                    var ss = $(this).parent().next().next().html();
                    start = ss.search('\\(');
                    end = ss.search('\\)');
                    ss = ss.slice(start+1,end);
                    total_count = total_count + parseInt(ss);
                }
            });
            str = selected_count+" items selected(total:" +total_count+")";
        }
        $('.notifyjs-corner').empty();
        var noteOption = {
            clickToHide : true,
            autoHide : false,
            globalPosition : 'top center',
            style : 'bootstrap',
            className : 'error',
            showAnimation : 'slideDown',
            showDuration : 200,
            gap : 20,
        }
        $.notify.defaults(noteOption);
        $.notify.addStyle('happyblue', {
          html: "<div><span data-notify-text/></div>",
          classes: {
            base: {
              "white-space": "nowrap",
              "background-color": "#333399",
              "padding": "10px",
              "margin-top" : "45px",
              "border-radius" : "5px"
            },
            superblue: {
              "color": "white",
            }
          }
        });
        $.notify(str,{style:'happyblue',className:'superblue'});
    });
    //single page
    $('.usual_check_css').click(function(){
        var selected_count = $('.singlebulk_table input[type="checkbox"]:checked').length;
        if($('.select-on-check-all').is(':checked'))
            selected_count--;
        var str = selected_count+" items selected";
        $('.notifyjs-corner').empty();
        var noteOption = {
            // whether to hide the notification on click
            clickToHide : true,
            // whether to auto-hide the notification
            autoHide : false,
//                position : '0',
            globalPosition : 'top center',
            // default style
            style : 'bootstrap',
            // default class (string or [string])
            className : 'error',
            // show animation
            showAnimation : 'slideDown',
            // show animation duration
            showDuration : 200,
            // hide animation
//            hideAnimation : 'slideUp',
            // hide animation duration
//            hideDuration : 200,
            // padding between element and notification
            gap : 20,
//            autoHideDelay : 2000
        }
        $.notify.defaults(noteOption);
        $.notify.addStyle('happyblue', {
          html: "<div><span data-notify-text/></div>",
          classes: {
            base: {
              "white-space": "nowrap",
              "background-color": "#333399",
              "padding": "10px",
              "margin-top" : "45px",
              "border-radius" : "5px"
            },
            superblue: {
              "color": "white",
            }
          }
        });
        $.notify(str,{style:'happyblue',className:'superblue'});
    });

    $('.onlyone .select-on-check-all').click(function(){
        var selected_count = 0;;
        if($(this).is(':checked')) {
            selected_count = $('.singlebulk_table input[type="checkbox"]').length - 1;
        }
        str = selected_count+" items selected";
        $('.notifyjs-corner').empty();
        var noteOption = {
            clickToHide : true,
            autoHide : false,
            globalPosition : 'top center',
            style : 'bootstrap',
            className : 'error',
            showAnimation : 'slideDown',
            showDuration : 200,
            gap : 20,
        }
        $.notify.defaults(noteOption);
        $.notify.addStyle('happyblue', {
          html: "<div><span data-notify-text/></div>",
          classes: {
            base: {
              "white-space": "nowrap",
              "background-color": "#333399",
              "padding": "10px",
              "margin-top" : "45px",
              "border-radius" : "5px"
            },
            superblue: {
              "color": "white",
            }
          }
        });
        $.notify(str,{style:'happyblue',className:'superblue'});
    });

    $('.waveitems_table .btn').click(function(){
      
    });
});