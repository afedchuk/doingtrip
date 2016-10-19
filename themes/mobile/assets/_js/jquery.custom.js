var cur = -1, prv = -1;
$(document).ready(function() {                      
    $('legend').click(function() {

        if($(this).parent().hasClass('startClosed'))
            $(this).parent().addClass('collapsable').removeClass('startClosed')
        else
            $(this).parent().addClass('startClosed').removeClass('collapsable')
    })
    $('.sort-wrap a').click(function() {
        var order = $(this).attr('data-order');
        $(this).parent().find('span').removeClass().addClass('icon-chevron-'+ (order == 'desc' ? 'down' : 'up'));
        $('.sort-wrap a').each(function() {
            $(this).removeClass('active');
        })
        reloadApartment.reload(this, this.href, [{'name' :'property_search[sort]', 'value': $(this).attr('data-sort')}, 
                                                 {'name' :'property_search[order]', 'value': order}]);
        $(this).attr('data-order', (order == 'asc' ? 'desc' : 'asc'));
        return false;
    });
})

function setcurrency(curr){
    $.get('currencymanager/default/setcurrency/currency/'+curr, function(data) {
        window.location.reload();
    });

}
function dropdownmenuobj(){
}
dropdownmenuobj.prototype.my_where = '';	
dropdownmenuobj.prototype.show = function(){
    if($(this.my_where + " ul li").length > 1){
        $(this.my_where + " ul li").show();
        $(this.my_where + " ul").removeClass('open');
    }
}
dropdownmenuobj.prototype.hide = function(turbo){
    if(turbo){
        $(this.my_where + " ul li:not(:first-child)").hide();
    }else{
        $(this.my_where + " ul li:not(:first-child)").fadeOut('fast');
    }		
    $(this.my_where + " ul").addClass('open');
}
dropdownmenuobj.prototype.select = function(id){
    this.show();
    $(this.my_where + " ul").prepend($(this.my_where + " li."+id));
    this.hide(true);
}
dropdownmenuobj.prototype.init = function(where){
    this.my_where = where;	
    var inst = this;	
    $(where).hover(
        function(){
            inst.show();
        },
        function(){
            inst.hide();
        }
    );	
    this.hide(true);	
}
dropdownmenuobj.prototype.getSelected = function(){
    return $(this.my_where + " li:first-child").attr("class");
}	
var dropdownmenu = {
    setup : function(where){
        var instance = new dropdownmenuobj();
        instance.init(where);		
        return instance;
    }
}

var tabChange = function(trigger){
    var tabs = $('.nav-tabs > li');
    var active = tabs.filter('.active');
    var next = active.next('li').length? active.next('li').find('a') : tabs.filter(':first-child').find('a');
    var prev = active.prev('li').length? active.prev('li').find('a') : tabs.filter(':first-child').find('a');
    eval(trigger).tab('show');
    return false;
}


$.fn.toJSON = function(options){

    options = $.extend({}, options);

    var self = this,
        json = {},
        push_counters = {},
        patterns = {
            "validate": /^[a-zA-Z][a-zA-Z0-9_]*(?:\[(?:\d*|[a-zA-Z0-9_]+)\])*$/,
            "key":      /[a-zA-Z0-9_]+|(?=\[\])/g,
            "push":     /^$/,
            "fixed":    /^\d+$/,
            "named":    /^[a-zA-Z0-9_]+$/
        };


    this.build = function(base, key, value){
        base[key] = value;
        return base;
    };

    this.push_counter = function(key){
        if(push_counters[key] === undefined){
            push_counters[key] = 0;
        }
        return push_counters[key]++;
    };

    $.each($(this).serializeArray(), function(){

        // skip invalid keys
        if(!patterns.validate.test(this.name)){
            return;
        }

        var k,
            keys = this.name.match(patterns.key),
            merge = this.value,
            reverse_key = this.name;

        while((k = keys.pop()) !== undefined){

            // adjust reverse_key
            reverse_key = reverse_key.replace(new RegExp("\\[" + k + "\\]$"), '');

            // push
            if(k.match(patterns.push)){
                merge = self.build([], self.push_counter(reverse_key), merge);
            }

            // fixed
            else if(k.match(patterns.fixed)){
                merge = self.build([], k, merge);
            }

            // named
            else if(k.match(patterns.named)){
                merge = self.build({}, k, merge);
            }
        }

        json = $.extend(true, json, merge);
    });

    return json;
};

var placemarksYmap = [];
var mapGMap = [];

var list = {
    lat: 0,
    lng: 0,

    apply: function(){
        $('div.appartment_item').each(function(){
            var item = $(this);

            item.mouseover(function(){

                var ad = $(this);
                var lat = ad.attr('lat') + 0;
                var lng = ad.attr('lng') + 0;
                var id = ad.attr('ap_id');

                if((list.lat != lat || list.lng != lng) && lat > 0 && lng > 0 ){
                    list.lat = lat;
                    list.lng = lng;
                    if(useGoogleMap){
                        for(m in markersGMap) {
                            markersGMap[m].setIcon("/images/house.png");
                        }
                        if(typeof infoWindowsGMap !== 'undefined' && typeof infoWindowsGMap[id] !== 'undefined'){
                            for(var key in infoWindowsGMap){

                                if(key == id){
                                    infoWindowsGMap[key].open();
                                }else{
                                    infoWindowsGMap[key].close();
                                }
                            }
                            var latLng = new google.maps.LatLng(lat, lng);
                            markersGMap[id].setIcon("/images/house-hover.png");
                            mapGMap.panTo(latLng);
                            mapGMap.setZoom(13);
                            $("div.blockList").removeClass("active");
                        }
                    }

                    if(useYandexMap){
                        if(typeof placemarksYMap[id] !== 'undefined'){
                            placemarksYMap[id].balloon.open();
                        }
                    }
                }
            });
        });
    }
}

var compareList = {

    addUrl: '',
    delUrl: '',
    indexUrl: '',
    inComparisonMsg: null,
    limitMsg: 5,
    errorMsg: null,
    delMsg: null,

    apply: function() {
        $(document).on("click", "a.compare-label", function() {
            apId = $(this).attr("id");
            apId = apId.replace("compare_label", "");

            if ($(this).attr("data-rel-compare") == "false") {
                if (apId) {
                    var checkboxCompare = $("#compare_check"+apId);
                    if (checkboxCompare.is(":checked"))
                        checkboxCompare.prop("checked", false);
                    else {
                        checkboxCompare.prop("checked", true);
                    }
                    compareList.add(apId);
                }
            }
        });
        $(document).on("change", ".compare-check", function() {
            apId = $(this).attr("id");
            apId = apId.replace("compare_check", "");

            compareList.add(apId);
        });
    },

    add: function(apId) {

        apId = apId || 0;
        if (apId) {
            var controlCheckedCompare = $("#compare_check"+apId).prop("checked");
            if (!controlCheckedCompare) {
                compareList.delete(apId);
            } else {
                $.ajax({
                    type: "POST",
                    url: compareList.addUrl,
                    data: {apId: apId},
                    beforeSend: function(){

                    },
                    success: function(html){
                        if (html == "ok") {
                            $("#compare_label"+apId).html(compareList.inComparisonMsg);
                            $("#compare_label"+apId).prop("href", compareList.indexUrl);
                            $("#compare_label"+apId).attr("data-rel-compare", "true");
                        }
                        else {
                            $("#compare_check"+apId).prop("checked", false);

                            if (html == "max_limit") {
                                $("#compare_label"+apId).html(compareList.limitMsg);
                            }
                            else {
                                $("#compare_label"+apId).html(compareList.errorMsg);
                            }
                        }
                    }
                });
            }
        }
    },

    delete: function() {
         $.ajax({
            type: "POST",
            url: compareList.delUrl,
            data: {apId: apId},
            success: function(html){
                if (html == "ok") {
                    $("#compare_label"+apId).html(compareList.delMsg);
                    $("#compare_label"+apId).prop("href", "javascript:void(0);");
                    $("#compare_label"+apId).attr("data-rel-compare", "false");
                }
                else {
                    $("#compare_check"+apId).prop("checked", true);
                    $("#compare_label"+apId).html(compareList.errorMsg);
                }
            }
        });
    }
}

var widgetlist = {
    apply: function() {
        
        $('.jcarousel').jcarousel();

        $('.jcarousel-control-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '-=1'
            });

        $('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                target: '+=1'
        });

        $('div.jcarousel').each(function() {
            var item = $(this);
            item.mouseover(function(){
                var ad = $(this);
                if(ad.find('li').length == 1) {
                    $.ajax({type: 'POST',
                            dataType: 'json',
                            url: '/apartments/main/photos',
                            data: {aprtment_id: ad.parents('.blockList').attr('ap_id')},
                            success: function(data){
                                if(data) {
                                    title = ad.find('li:first a').attr('title');
                                    href = ad.find('li:first a').attr('href');
                                    $.each( data, function( key, val ) {
                                       $( "<li><a href='"+href+"' title='"+title+"'><img alt='' src='"+val+"'/></a></li>" ).insertAfter(ad.find('li:last'))
                                    }); 
                                    $('.jcarousel').jcarousel('reload', {
                                        animation: 'fast'
                                    });
                                }
                            },
                    });
                }
            });
        })
    }
}

var reloadApartment = {
    indicator: '/images/indicator.gif',
    bg_img: '/images/opacity.png',
    updateText: 'Loading ...',
    resultBlock: 'appartment_box',

    modalContainer: null,
    modalTmp: null,
    modalCss: {},

    loading: function() {
        $('#update_div').remove();
        $('#update_img').remove();

        var opacityBlock = $('#'+reloadApartment.resultBlock);

        if (opacityBlock.width() != null){

            var width = opacityBlock.width();
            var height = opacityBlock.height();
            var left_pos = opacityBlock.offset().left;
            var top_pos = opacityBlock.offset().top;
            $('body').append('<div id="update_div"></div>');

            var cssValues = {
                'z-index' : '5',
                'position' : 'absolute',
                'left' : left_pos,
                'top' : top_pos,
                'width' : width,
                'height' : height,
                'border' : '0px solid #FFFFFF',
                'background-image' : 'url('+reloadApartment.bg_img+')'
            }

            $('#update_div').css(cssValues);

            var left_img = left_pos + width/2 - 16;
            var left_text = left_pos + width/2 + 24;
            var top_img = top_pos + height/2 -16;
            

            $('body').append("<img id='update_img' src='"+reloadApartment.indicator+"' style='position:absolute;z-index:6; left: "+left_img+"px;top: "+top_img+"px;'>");
        }
    },



    reload: function(obj, url, args) {
        //if($(obj).hasClass('active'))
            //return false;
        var path = window.location.pathname.substring(url.lastIndexOf('?')+1);
        $('div.switch-page-structure').find('a.active').removeClass('active');
        $(obj).addClass('active');
        $.ajax({
            type: 'POST',
            url: url,
            data: args,
            ajaxStart: reloadApartment.loading(reloadApartment.resultBlock),
            success: function(msg){
                $('div#'+reloadApartment.resultBlock).html(msg);
                $('#update_div').remove();
                $('#update_img').remove();
            },
            complete: function() {list.apply();
                $('html,body').animate({
                    scrollTop: $('.main').offset().top
                }, 500);
                var ret = window.location.search;
                if(Object.keys(args).length > 0) {
                    for(val in args){
                        ret = modURLParam(ret, args[val]['name'], args[val]['value']);
                    }
                }
                window.history.pushState(args, '', path+ret)
                list.apply();
            }
        });
    },


    modal: function() {
        $('[data-toggle="modal"], [data-toggle="modal"] a').click(function(e) {
            e.preventDefault();
            url = $(this).attr('href');
            $.get(url, function(data) {
                $(reloadApartment.modalTmp).html(data);
                $(reloadApartment.modalTmp).find(reloadApartment.modalContainer).modal().css(reloadApartment.modalCss).on('hidden', function(){
                    $('.modal-backdrop.in').each(function(i) {
                        $(this).remove();
                    });
                    var height = $(window).height() - 200;
                    $(this).find(".modal-body").css("max-height", height);
                });
            }).success(function() { });
            return false;
        });
    }
}
$(document).ready(function() { 
    (function(expCharsToEscape, expEscapedSpace, expNoStart, undefined) {
      modURLParam = function(url, paramName, paramValue) {
        paramValue = paramValue != undefined
          ? encodeURIComponent(paramValue).replace(expEscapedSpace, '+')
          : paramValue;
        var pattern = new RegExp(
          '([?&]'
          + paramName.replace(expCharsToEscape, '\\$1')
          + '=)[^&]*'
        );
        if(pattern.test(url)) {
          return url.replace(
            pattern,
            function($0, $1) {
              return paramValue != undefined ? $1 + paramValue : '';
            }
          ).replace(expNoStart, '$1?');
        }
        else if (paramValue != undefined) {
          return url + (url.indexOf('?') + 1 ? '&' : '?')
            + paramName + '=' + paramValue;
        }
        else {
          return url;
        }
      };
    })(/([\\\/\[\]{}().*+?|^$])/g, /%20/g, /^([^?]+)&/);
});