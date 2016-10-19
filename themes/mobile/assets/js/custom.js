(function($) {
    $('.js a.mask').click(function() {
        $('.contacts-list.js').hide('fast', function() {
            $('.contacts-list.no-js').slideDown('fast');
        })
    })
    search = {
        houseProperty: {},
        hashurl: '',
        initializeItems: function() {
            var moreLink = $('.more-link');
            var clickableButton = $('.filter-btn');
            var applyButton= $('.apply-search-options');
            moreLink.bind('click', function() {
                for(item in search.houseProperty) {
                     for(value in search.houseProperty[item])
                        $('div[data-type='+item+']').find('a[data-id="'+search.houseProperty[item][value]+'"]').addClass('active');
                }
                $(this).toggleClass('opened');
                if($(this).hasClass('opened')) 
                    $('.more-search-options-container').slideDown();
                else 
                    $('.more-search-options-container').slideUp();
            });

            clickableButton.bind('click', function() {
                ptype = $(this).parents('.buttons-container').attr('data-type');
                if(search.houseProperty[ptype] == undefined)
                    search.houseProperty[ptype] = [];

                if($(this).parents(".buttons-container").hasClass("single")) {
                    $(this).parents(".single").find("a").removeClass("active");
                    search.houseProperty[ptype] = [];
                }

                $(this).toggleClass('active').promise().done(function(){
                    id = $(this).attr('data-id');
                    if($(this).hasClass('active')) {
                        search.houseProperty[ptype].push(id);
                    } else {
                        search.houseProperty[ptype].splice( search.houseProperty[ptype][id], 0 );
                    }
                }); 
                searchDecoded = decodeURIComponent( $.param( search.houseProperty ) );
                history.pushState(null, null, '?' + searchDecoded);
            });

            applyButton.bind('click', function() {
                window.location.reload();                
            })

        },
        filteredOptions: function() {console.log(search.houseProperty);
        	if(search.houseProperty.length > 0) {
	        	for(item in search.houseProperty) {
	        		console.log(item);
	        	}
	        }
        },
        apply: function() {
            search.initializeItems();
            search.filteredOptions();
        }
   }
   search.apply();

   // JavaScript Document

$(document).ready(function(){
    
    $('.close-nav, .close-sidebar, .sidebar-close').click(function(){
        snapper.close();
        return false;
    });

    $('.dropdown-nav').click(function(){
        $(this).parent().find('.nav-item-submenu').toggle(200);
        $(this).parent().find('.dropdown-nav').toggleClass('dropdown-nav-inactive');
    });
    
    $('.wide-image').click(function(){
        $(this).parent().find('.wide-item-content').toggle(50);
        return false;
    });
        
    var snapper = new Snap({
      element: document.getElementById('content')
    });


    $('.deploy-sidebar').click(function(){
        //$(this).toggleClass('remove-sidebar');
        if( snapper.state().state=="left" ){
            snapper.close();
        } else {
            snapper.open('left');
        }
        return false;
    });

    
});
}(jQuery));


