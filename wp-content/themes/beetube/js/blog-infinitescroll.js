jQuery(window).load(function() {
    "use strict";
    //Blog 
    jQuery('.loop-content-m').each(function(i){
        var $currentPortfolio=jQuery(this);
        var $currentInfinite=$currentPortfolio.children('.jw-infinite-scroll');
        var $currentIsotopeContainer=$currentPortfolio.children('.loop-content').children('.nag');
        $currentIsotopeContainer=$currentIsotopeContainer.hasClass('nag')?$currentIsotopeContainer:$currentPortfolio;
        // Infinite
        $currentInfinite.find('a').unbind('click').bind('click',function(e){e.preventDefault();
            var $currentNextLink=jQuery(this);
            if($currentInfinite.attr('data-has-next')==='true'&&$currentNextLink.hasClass('next')){
                var $infiniteURL=$currentNextLink.attr('href');
                $currentInfinite.children('.next').hide();
                $currentInfinite.children('.loading').fadeIn();
                jQuery.ajax({
                    type: "POST",
                    url: $infiniteURL,
                    success: function(response){
                        var $newElements = jQuery(response).find('.loop-content-m').eq(i).children('.loop-content').children('.nag').hasClass('nag')?jQuery(response).find('.loop-content-m').eq(i).children('.loop-content').children('.nag').html():jQuery(response).find('.loop-content-m').eq(i).html();
                        var $newURL      = jQuery(response).find('.loop-content-m').eq(i).find('.jw-infinite-scroll>a.next').attr('href');
                        var $hasNext     = jQuery(response).find('.loop-content-m').eq(i).find('.jw-infinite-scroll').attr('data-has-next');
                        if($newElements){
                            //$newElements=jQuery('<div />').append($newElements).find('item').css('opacity','0');
                            if($currentIsotopeContainer.hasClass('nag')){
                                $currentIsotopeContainer.append($newElements);
								$currentIsotopeContainer.fitVids();
                            }else{
                                $currentInfinite.before($newElements);
                            }
                            if($hasNext==='false'){
                                $currentInfinite.attr('data-has-next','false');
                                $currentInfinite.children('.loading').hide();
                                $currentInfinite.children('.no-more').fadeIn();
                            }else{
                                $currentNextLink.attr('href',$newURL);
                                $currentInfinite.children('.loading').hide();
                                $currentInfinite.children('.next').fadeIn();
                            }
                        }else{
                            $currentInfinite.attr('data-has-next','false');
                            $currentInfinite.children('.loading').hide();
                            $currentInfinite.children('.no-more').fadeIn();
                        }
                        setTimeout(function(){
                            $currentIsotopeContainer.children('item').css('opacity','1');
                            
                        },1000);
                        setTimeout(function(){
                            $currentIsotopeContainer.children('item').css('opacity','1');
                            
                        },6000);
                    }
                });
            }
        });
    });
});