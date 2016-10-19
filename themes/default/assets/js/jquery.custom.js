var cur = -1, prv = -1;
$(document).ready(function() {   
    $(".phone").mask("(999) 999-99-99");
    $("[data-toggle='tooltip']").tooltip({html: true});    
    $('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(200);
    }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(200);
    });    
    $(document).scroll(function() {
      var y = $(this).scrollTop();
      if (y > 820 && $('#update-block').length > 0) {
        $('#update-block').addClass('flat-info-fixed').fadeIn();
        $('#header').fadeOut();
      } else {
        $('#update-block').removeClass('flat-info-fixed');
        $('#header').fadeIn();
      }
    });          
    $('.sort-wrap a:not(.filters-toggle)').click(function() {
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
    $('#social-contain a.close').click(function() {
        document.cookie="socbox=1";
    })
    window.setTimeout(function() {
        if ($(".fb-like").length > 0 || $('#vk_groups').length > 0) {
            $(".fb-like").show();
            /*if (typeof (FB) != 'undefined') {
                FB.getLoginStatus(function(response) {
                    if (response.status === 'connected') {
                        $("#vk_groups").hide();
                        $(".fb-like").show();
                    } 
                });
            } */
            $("#social-contain").modal("show"); 
        }
    }, 3000);
    $('.full-page-ppp-navigation a[href^="#"]').bind('click.smoothscroll',function (e) {
      e.preventDefault();

      var target = this.hash,
      $target = $(target);

      $('html, body').stop().animate({
        'scrollTop': $target.offset().top
      }, 200, 'swing', function () {
        window.location.hash = target;
      });
    });
    $('.type-view').click(function() {
        var path = $(this).attr('href');
        $.ajax({
          url:path,
          method: "POST",
          data: [{'name' :'property_search[type_view]', 'value': $(this).attr('data')}],
          beforeSend: function( xhr ) {
            reloadApartment.loading();
          }
        }).done(function() {
            window.location.reload();
        });
        return false;
    });
    var $button = $('#filters-toggle');
    $button.on('click', function () {
        if($button.parent().hasClass('active')) {
            $button.parent().removeClass('active');
        } else {
            $button.parent().addClass('active');
        }
    });
})

var encrypt = function(form) {
    var base64Matcher = new RegExp("^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=|[A-Za-z0-9+/]{4})([=]{1,2})?$");
    $("form#"+form).on( "submit", function() {
        item = $('#'+form).find('input[type="password"]');
        item.attr('value', CryptoJS.AES.encrypt(item.val(), CryptoJS.enc.Hex.parse(CIPHERKEY), {iv : CryptoJS.enc.Hex.parse(CIPHERIV)}));
    }); 
}
   

var loadSidebar = function() {
        if($('#sidebar').length > 0) {
        var length = $('#left').height() - $('#sidebar').height() + $('#left').offset().top;
        var heightMap = $(window).height()-100;
        if($('#right') < $(window).height())
            heightMap = $('#right').height()-100;
        $('#googleMap').css({'height' : heightMap + 'px'});
        $(window).scroll(function () {
            var scroll = $(this).scrollTop();
            var height = $('#sidebar').height() + 'px';
            $('#googleMap').css({'height' :heightMap + 'px'});
            if (scroll < $('#left').offset().top) {

                $('#sidebar').css({
                    'position': 'absolute',
                    'top': '0'
                });

            } else if (scroll > length) {

                $('#sidebar').css({
                    'position': 'absolute',
                    'bottom': '0',
                    'top': 'auto'
                });

            } else {

                $('#sidebar').css({
                    'position': 'fixed',
                    'top': '0',
                    'height': height
                });
            }
        });
    }
}
loadSidebar();
$(function() {
    if ( $.browser.msie) {
        if(!$.support.placeholder) { 
            var active = document.activeElement;
            $(':text').focus(function () {
                if ($(this).attr('placeholder') != '' && $(this).val() == $(this).attr('placeholder')) {
                    $(this).val('').removeClass('hasPlaceholder');
                }
            }).blur(function () {
                if ($(this).attr('placeholder') != '' && ($(this).val() == '' || $(this).val() == $(this).attr('placeholder'))) {
                    $(this).val($(this).attr('placeholder')).addClass('hasPlaceholder');
                }
            });
            $(':text').blur();
            $(active).focus();
            $('form').submit(function () {
                $(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
            });
        }
    }
});
if ( $.browser.msie) {
    $(window).load(function() {    
        var theWindow        = $(window),
            $bg              = $("#bg-layout"),
            aspectRatio      = $bg.width()/ $bg.height();    
                 
        function resizeBg() {
            if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
                $bg
                    .removeClass()
                    .addClass('bgheight');
            } else {
                $bg
                    .removeClass()
                    .addClass('bgwidth');
            }    
            $bg.show();  
        }                           
        theWindow.resize(resizeBg).trigger("resize");
    });
}
function setcurrency(curr){
    $.get('/currencymanager/default/setcurrency/currency/'+curr, function(data) {
        window.location.reload();
    });

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
                compareList.deleteItem(apId);
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

    deleteItem: function() {
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


var placemarksYmap = [];
var mapGMap = [];

var widgetlist = {
    startItem: 0,
    circle:function(marker, radius) {
        var circle = new google.maps.Circle({
          map: mapGMap,
          radius: radius * 1610,
          fillColor: '#16BECF',
          fillOpacity: 0.2,
          strokeWeight:1,
          strokeColor: '#18819F'
        });
        circle.bindTo('center', marker, 'position');
    },
    newmarker: function(item, id, lat, lng, radius) {
        if(markersGMap[id] == undefined) {
            var latLng = new google.maps.LatLng(lat, lng);
            latLngList.push(latLng);
            markersGMap[id] = new google.maps.Marker({
                position: latLng,
                icon: "/images/house.png",
                map: mapGMap,
                draggable: false
            });
        }
        $('div.objects ul li').removeClass('select');
        $('div.objects .desc').html(item.find('div.description').html()).fadeIn();
        item.addClass('select');
        for(mark in markersGMap) {
            markersGMap[mark].setIcon("/images/house.png");
        }
        mapGMap.panTo(markersGMap[id].getPosition());
        markersGMap[id].setIcon("/images/house-hover.png");
    },
    markers: function(items) {
        if (typeof latLngList != 'undefined') {
        var i = 1000; 
            for(elem in items){
                var id = items[elem].getAttribute("ap_id");
                var latLng = new google.maps.LatLng(items[elem].getAttribute("lat"), items[elem].getAttribute("lng"));
                latLngList.push(latLng);
                markersGMap[id] = new google.maps.Marker({
                    position: latLng,
                    icon: "/images/house.png",
                    map: mapGMap
                });
                widgetlist.markerclick(markersGMap[id], id);
                widgetlist.markerhover(id);
                i--;
            }
        }
        
    },
    markerhover: function(id) {
        $(".blockApartments[ap_id="+id+"]").on('hover', function() {
            mapGMap.panTo(markersGMap[id].getPosition());
            for(mark in markersGMap) {
                $(".blockApartments[ap_id="+mark+"]").removeClass('active');
                markersGMap[mark].setIcon("/images/house.png");
            }
            markersGMap[id].setIcon("/images/house-hover.png");
            mapGMap.setZoom(14);
            $(this).addClass('active');
        })
    },
    markerclick: function(marker, id) {
        google.maps.event.addListener(marker, "click", function() {
                $("div.blockList").removeClass("active");
                for(mark in markersGMap) {
                    $(".blockApartments[ap_id="+mark+"]").removeClass('active');
                    markersGMap[mark].setIcon("/images/house.png");
                }
                target = $("div.blockApartments[ap_id="+id+"]");
                target.addClass("active");
                if (target.length) {
                    $("html,body").animate({
                      scrollTop: target.offset().top - 50
                    }, 1000);
                }
                mapGMap.panTo(marker.getPosition());
                marker.setIcon("/images/house-hover.png");
        });
    },
    apply: function() {
        var hash = window.location.hash.substring(1).split('.')[0];
        $("div.jcarousel ul li a, .property-image a img, .thumb ul li a").each(function() {
            if($(this).hasClass('lazyload')) {
                $(this).lazyload({effect : "fadeIn", load : function() {
                    var callback = function(item) {
                        item.parent().parent().find('.overlay .info').css('background', 'linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.75) 100%) repeat scroll 0 0 rgba(0, 0, 0, 0)');
                    }
                    setTimeout(callback, 500, $(this));
                  
                        
                    }
                });
                $(this).removeClass('lazyload');
            }
        });
        if(hash.length > 0 && $('li[data-item='+hash+']').length > 0 )
            widgetlist.startItem = $('li[data-item='+hash+']').index();

        if($('.jcarousel').length > 0) {
            $('.jcarousel').on('jcarousel:createend', function() {
                $(this).jcarousel('scroll', widgetlist.startItem, false);
            })
            .jcarousel();

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
                                data: {aprtment_id: ad.parents('.blockList, .block-grid').attr('ap_id')},
                                success: function(data){
                                    if(data) {
                                        title = ad.find('li:first a').attr('title');
                                        href = ad.find('li:first a').attr('href');
                                        $.each( data, function( key, val ) {
                                           $( "<li><a href='"+href+"' title='"+title+"' style='background:url(\""+val+"\");'></a></li>" ).insertAfter(ad.find('li:last'))
                                        }); 
                                        $('.jcarousel').jcarousel('reload', {
                                            animation: 'fast'
                                        });
                                    }
                                }
                        });
                    }
                });
            })
    }

        $("[data-toggle='tooltip']").tooltip(); 

        $('div.appartment_item').each(function(i){
            var item = $(this);
            /*$("div.blockList").removeClass("active");
            item.mouseover(function(){
               item.addClass("active");
            });*/
            
        });

        $('div.appartment_item').eq(0).trigger('mouseenter');
    }
}

var reloadApartment = {
    indicator: '/images/indicator.gif',
    bg_img: '/images/opacity.png',
    updateText: 'Loading ...',
    resultBlock: 'appartment_box',

    modalContainer: '#modal-booking',
    modalTmp: '.modal-tmp',
    modalCss: {'width':'310px'},

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
            

            $('body').append("<i id='update_img' style='position:absolute; color:#666; z-index:6; left: "+left_img+"px;top: "+top_img+"px;' class='fa fa-cog fa-spin fa-2x'></i>");
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
            complete: function() {
                $('html,body').animate({
                    scrollTop: $('#appartment_box').offset().top
                }, 500);
                var ret = window.location.search;
                if(Object.keys(args).length > 0) {
                    for(val in args){
                        if(($arg = args[val]['name'].match('type_view')) == null)
                            ret = modURLParam(ret, args[val]['name'], args[val]['value']);
                    }
                }
                window.history.pushState(args, '', path+ret)
                widgetlist.apply();
            }
        });
    },


    modal: function() {
        $(document).on('click', '[data-toggle="modal"], [data-toggle="modal"] a', function(e) {
            reloadApartment.loading();
            e.preventDefault();
            $this = $(this);
            $this.addClass('disabled');
            url = $(this).attr('href');
            $.get(url, function(data) {

                $(reloadApartment.modalTmp).html(data);
                if($this.attr('data-width') != undefined)
                    $.extend(reloadApartment.modalCss, {'width':$this.attr('data-width')+'px'});
                if($this.attr('data-height') != undefined) {
                    height = $this.attr('data-height');
                    $('.modal-body').css('max-height', height -50+'px');
                    $.extend(reloadApartment.modalCss, {'max-height': height+'px'});
                }
                $(reloadApartment.modalTmp).find(reloadApartment.modalContainer).modal().css(reloadApartment.modalCss).on('hidden', function(){
                    $('.modal-backdrop.in').each(function(i) {
                        $(this).remove();
                    });
                    var height = $(window).height() - 200;
                    $(this).find(".modal-body").css("max-height", height);
                });
            }).success(function() { 
                $this.removeClass('disabled'); 
                $('#update_div').remove();
                $('#update_img').remove();
            });
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
