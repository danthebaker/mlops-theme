
// Tell our document that javascript is enabled
document.documentElement.className = 'js';

// Check to see if touchscreen and append body accordingly
// Note: This is not to be relied upon, it is intended as a
// general check for prototyping
if(window.matchMedia("(pointer: coarse)").matches) {
  document.querySelector('html').classList.add('touch');
} else {
  document.querySelector('html').classList.add('no-touch');
}

// --------------------------------------------------------------------
// Listen to tab events to enable outlines (accessibility improvement)
// --------------------------------------------------------------------
function handleFirstTab(e) {
  if (e.keyCode === 9) { // the "I am a keyboard user" key
      document.body.classList.add('user-is-tabbing');
      window.removeEventListener('keydown', handleFirstTab);
  }
}
window.addEventListener('keydown', handleFirstTab);


// --------------------------------------------------------------------
// Mobile menu 
// --------------------------------------------------------------------

var navToggle = document.querySelector('#nav-toggle');
var navMenu = document.querySelector('#nav-main');
var scrollBody = document.querySelector('body');

var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

navToggle.onclick = function() {
  navToggle.classList.toggle('active');
  navMenu.classList.toggle('active');
  scrollBody.classList.toggle('noscroll');
  let expanded = this.getAttribute('aria-expanded') === 'true' || false;
  this.setAttribute('aria-expanded', !expanded);
}

function mobile_submenus(){

  var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

  if(windowWidth < 600) {
    jQuery('.menu-item-has-children > button').unbind('click'); // reset

    jQuery('.menu-item-has-children > button').on('click', function(e){
      jQuery(this).parents('.menu-item-has-children').toggleClass('open');
      jQuery(this).parents('.menu-item-has-children').find('.sub-menu').slideToggle();
    });
  }
  else {
    jQuery('.menu-item-has-children .sub-menu').removeAttr('style');
    if(jQuery('.popup.displaying').length == 0){
      jQuery('body').removeClass('noscroll');
    }
    jQuery('#nav-toggle, #nav-main').removeClass('active');
    
  }
}




// --------------------------------------------------------------------
// Wrap last word in a span
// --------------------------------------------------------------------

Element.prototype.wrapLastWord = function (left, right) {
  var words = this.innerHTML.split(' ');
  var lastWord = words[words.length - 1];
  words[words.length - 1] = left + lastWord + right;
  this.innerHTML = words.join(' ');
}

// --------------------------------------------------------------------
// Set 100% view height for mobile in a nicer fashion
// --------------------------------------------------------------------

let vh = window.innerHeight * 0.01;
document.documentElement.style.setProperty('--vh', `${vh}px`);

// --------------------------------------------------------------------
// Cookie functions
// --------------------------------------------------------------------

function setCookie(cname, cvalue, exdays) {
  exdays = exdays || 0; // optional. if no expiry, cookies clear on browser exit
  
  var expires = "";
  if (exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      expires = "expires="+ d.toUTCString();
  }
  
 document.cookie = cname + "=" + encodeURIComponent(cvalue) + ";" + expires + ";path=/;SameSite=Strict";
}

function getCookie(cname) {
  var name = cname + "=";
  var ca = document.cookie.split(';');
  for(var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

function delete_cookie(cname) {
  document.cookie = cname + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};

// --------------------------------------------------------------------
// Feature Store Provider - add to compare button
// --------------------------------------------------------------------
const provider_category = jQuery(".compare-bar").data("provider_category");
const compare_cookie_name = "compare_providers_"+provider_category;

function compare_button_disable_toggle(clicksource){
  var source = clicksource || "";
  var curr_compare_cookie = getCookie(compare_cookie_name);
  if(curr_compare_cookie){
    jQuery('.compare').prop('disabled', false);

    new_compare_cookie = curr_compare_cookie.split('%2C');

    if(new_compare_cookie.length == 1 && source == '.add-to-compare'){
      jQuery('.compare-bar:not(.open)').toggleClass('open');
    }
  }
  else {
    jQuery('.compare').prop('disabled', true);
  }
}

// add to compare (from profile card/hero)
jQuery('.add-to-compare').on('click', function(){
  jQuery(this).toggleClass('added');
  var id = jQuery(this).data('provider-id');
  id = id.toString();

  if(jQuery(this).hasClass('added')){
    add_compare_item(id);
    compare_button_disable_toggle('.add-to-compare');
  }
  else {
    remove_compare_item(id);
    compare_button_disable_toggle();
  }

  
  
});

// remove from compare (from compare tab)
jQuery('.compare-list .remove').on('click', function(){
  var id = jQuery(this).parents('li').data('provider-id');
  remove_compare_item(id);
  compare_button_disable_toggle();
});

// compare button to launch compare popup
jQuery('.compare').on('click', function(){
  var curr_compare_cookie = getCookie(compare_cookie_name);
  if(curr_compare_cookie){
    jQuery('.compare-popup').addClass('displaying').show();
    jQuery('body').addClass('noscroll');

    // add similar/different classes for toggling with filters
    jQuery('.comparison-table tr').removeClass('similar different highlight'); // reset
    jQuery('.comparison-table:not(.demo_links) tr:not(.exc)').each(function(){

      var are_similar = true;
      var val = "";
      jQuery(this).find('td:not(:first-child)').each(function(index){
        if(index == 0){
          val = jQuery(this).text();
        }
        else {
          if(val != jQuery(this).text()){
            are_similar = false;
            return false;
          }
        }
      });

      if(are_similar === true){
        jQuery(this).addClass('similar');
      }
      else {
        jQuery(this).addClass('different');
      }
    });
  }

});

// filters
jQuery('.compare-popup input[name="filter"]').on('change', function(){
  var value = jQuery(this).val();
  
  if(value == "hide-similar"){
    jQuery('.comparison-table tr.different').removeClass('highlight');
    jQuery('.comparison-table tr.similar').hide();
  }
  else {
    jQuery('.comparison-table tr.similar').show();
    jQuery('.comparison-table tr.different').addClass('highlight');
  }
});

jQuery('.compare-tab-toggle').on('click', function(e){
  jQuery('.compare-bar').toggleClass('open');
  e.stopPropagation();
});

jQuery('.compare-providers, .compare-popup').on('click', function(e){
  e.stopPropagation();
});

jQuery(document).on('click', function(e){
  jQuery('.compare-bar').removeClass('open');
  e.stopPropagation();
});

// populate compare tab list item
function populate_compare_item(provider_id, img_src, name, item_index, logo_height){
  var height = 'style="max-height: '+logo_height+'px;"' || '';

  if(img_src){
    jQuery('.compare-list li:nth-child('+item_index+') div').append('<img src="'+img_src+'" class="provider-logo" '+height+'>');
  }
  else {
    jQuery('.compare-list li:nth-child('+item_index+') div').append('<p>'+name+'</p>');
  }
  jQuery('.compare-list li:nth-child('+item_index+')').attr('data-provider-id',provider_id).removeClass('empty');
}

function check_max_reached(){
  
}

function add_compare_item(id){

  jQuery('.add-to-compare[data-provider-id="'+id+'"]').text('Added to compare');

  var curr_compare_cookie = getCookie(compare_cookie_name);
  var new_compare_cookie = [];
  if(curr_compare_cookie){
    new_compare_cookie = curr_compare_cookie.split('%2C');
    //console.log(new_compare_cookie.length);
    if(new_compare_cookie.length > 4){
      new_compare_cookie = new_compare_cookie.slice(0,4);
    }
    
    if(new_compare_cookie.includes(id)){
      var i = new_compare_cookie.indexOf(id);
      new_compare_cookie.splice(i, 1);

      //remove. user might wanna be re-ordering
      jQuery('.compare-list li[data-provider-id="'+id+'"]').remove();
      jQuery('.compare-list').append('<li class="empty"><button class="remove"><span class="sr-only">remove</span></button><div></div></li>');
    }
  }

  // console.log(curr_compare_cookie.length + '====');
  // console.log(curr_compare_cookie);
  // console.log(curr_compare_cookie.length + '====');
  if(new_compare_cookie.length <= 3 ){

    new_compare_cookie.push(id);
    
    disable_enable_add_buttons(new_compare_cookie);

    new_compare_cookie.join(",");
    setCookie(compare_cookie_name, new_compare_cookie, 0);

    jQuery.ajax({
      type: "POST",
      url: mlops.ajaxurl,
      data: {
          action: 'mlops_add_to_compare',
          ids: id,
          category: provider_category
      },
      success: function(response){
        result = jQuery.parseJSON(response);

        if(result){
          result.forEach(function(item, index){
            //console.log(item);
            populate_compare_item(id, item.logo, item.name, (jQuery('.compare-list .empty').first().index() + 1));
            populate_table_item(item);
            var curnum = jQuery('.compare-content').attr('data-compare-num');
            if(curnum){
              jQuery('.compare-content, .compare-popup .content').attr('data-compare-num', parseInt(curnum) + 1);
            }
            else {
              jQuery('.compare-content, .compare-popup .content').attr('data-compare-num', 1);
            }
            
          });
        }
      }
    });  
  }
}

function disable_enable_add_buttons(curr_compare_cookie_arr){
  //console.log(curr_compare_cookie_arr);
  // disable add buttons if items in cookie have reached the limit
  if(curr_compare_cookie_arr.length == 4){
    jQuery('.add-to-compare:not(.added)').prop('disabled', true).append('<span class="tip">Max providers reached!</span>');
  }
  else {

    if(curr_compare_cookie_arr.length < 4){
      jQuery('.add-to-compare ').prop('disabled', false);
      jQuery('.add-to-compare .tip').remove();
    }
  }
}

function remove_compare_item(id){
  var id = id.toString();
  var curr_compare_cookie = getCookie(compare_cookie_name);
  var new_compare_cookie = [];
  if(curr_compare_cookie){
    new_compare_cookie = curr_compare_cookie.split('%2C');
    if(new_compare_cookie.includes(id)){
      var i = new_compare_cookie.indexOf(id);
      new_compare_cookie.splice(i, 1);

      disable_enable_add_buttons(new_compare_cookie);

      new_compare_cookie.join(",");
      setCookie(compare_cookie_name, new_compare_cookie, 0);

      // remove from compare list
      jQuery('.compare-list li[data-provider-id="'+id+'"]').remove();
      jQuery('.compare-list').append('<li class="empty"><button class="remove"><span class="sr-only">remove</span></button><div></div></li>');
    
      
    }
  }

  jQuery('.compare-list li[data-provider-id="'+id+'"]').addClass('empty');
  jQuery('.add-to-compare[data-provider-id="'+id+'"]').removeClass('added').text('Add to compare');
  jQuery('.compare-content, .compare-popup .content').attr('data-compare-num',(parseInt(jQuery('.compare-content').attr('data-compare-num')) - 1));

  // remove from popup
  var table_index = jQuery('.comparison-table.logos td[data-provider-id="'+id+'"]').index();
  jQuery('.comparison-table td:nth-child('+(table_index+1)+')').remove();
}
// populate compare tab from cookie. happens on load
function populate_compare_tab_from_cookie(){
  var curr_compare_cookie = getCookie(compare_cookie_name);
  var ids = curr_compare_cookie;
  if(curr_compare_cookie){
    new_compare_cookie = curr_compare_cookie.split('%2C');
    //console.log(new_compare_cookie);
    if(new_compare_cookie.length > 4){
      new_compare_cookie = new_compare_cookie.slice(0, 4);
      //console.log(new_compare_cookie);
      new_compare_cookie.join(",");
      ids = new_compare_cookie;
      setCookie(compare_cookie_name, new_compare_cookie, 0);
    }

    disable_enable_add_buttons(new_compare_cookie);
    
    jQuery.ajax({
      type: "POST",
      url: mlops.ajaxurl,
      data: {
          action: 'mlops_add_to_compare',
          ids: ids,
          category: provider_category
      },
      success: function(response){
          result = jQuery.parseJSON(response);

          if(result){
            jQuery('.compare-content, .compare-popup .content').attr('data-compare-num',result.length);
            result.forEach(function(item, index){
              populate_compare_item(item.ID, item.logo, item.name, (index+1), item.logo_height);
              populate_table_item(item);
            });

            video_popups();
          }
      }
    });
  }
}

function populate_table_item(item){
    console.log(item);
  var logo = "";
  var name = "";
  var vid_button = "";
  var iframe = "";
  var h = "";
  // var demo_button = "";

  // vendor name
  if(item.name){
    name = item.name;
  }
  jQuery('.comparison-table.overview tr[data-key="vendor_name"]').append('<td><p>'+item.name+'</p></td>');

  // theader
  if(item.logo != false){
    
    if (item.logo_height){
      h = 'style="height: '+item.logo_height+'px;"';
    }
    logo = '<img src="'+item.logo+'" '+h+'>';
  }
  else {
    if(item.name){
      logo = item.name;
    }
  }
  jQuery('.comparison-table.logos tr').append('<td data-provider-id="'+item.ID+'">'+logo+'</td>');

  // video
  if(item.video){
    vid_button = '<p><button type="button" class="open-video-popup in-comparison-table" data-id="profile-video-'+item.ID+'" data-video="'+item.video+'">Watch demo</button></p>';
  }
  jQuery('.comparison-table tr[data-key="video"]').append('<td>'+vid_button+iframe+'</td>');

  switch(provider_category){
    case "feature-store":
      if(item.overview){
        Object.keys(item.overview).forEach(function(key) {
          jQuery('.comparison-table tr[data-key="'+key+'"]').append('<td>'+item.overview[key]+'</td>');
        });
      }
    
      if(item.feature_store_capabilities){
        Object.keys(item.feature_store_capabilities).forEach(function(key) {
          jQuery('.comparison-table tr[data-key="'+key+'"]').append('<td>'+item.feature_store_capabilities[key]+'</td>');
        });
      }
      break;
    case "metadata-storage-and-management":
        if(item.overview){
          Object.keys(item.overview).forEach(function(key) {
            jQuery('.comparison-table tr[data-key="'+key+'"]').append('<td>'+item.overview[key]+'</td>');
          });
        }
      
        if(item.model_store_capabalities){
          Object.keys(item.model_store_capabalities).forEach(function(key) {
            jQuery('.comparison-table tr[data-key="'+key+'"]').append('<td>'+item.model_store_capabalities[key]+'</td>');
          });
        }
        break;
    case "monitoring":
      if(item.info){
        Object.keys(item.info).forEach(function(key) {
          jQuery('.comparison-table tr[data-key="'+key+'"]').append('<td>'+item.info[key]+'</td>');
        });
      }

    default:
  }

  

  video_popups();
}

var data_mh = [];
if(jQuery('.providers-list-ul > li').length){
  jQuery('.providers-list-ul > li:first-child li').each(function(){
    data_mh.push(jQuery(this).data('mh'));
  });
}
jQuery('.providers-list select').on('change', function(){
  var list = jQuery('.providers-list-ul');
  var listItems = list.children('li');
  // list.append(listItems.get().reverse());
  // jQuery.fn.matchHeight._update();
  if(this.value == "title-asc"){
    listItems.sort(sort_title_asc).appendTo(list);
  }
  else if(this.value == "title-dec"){
    listItems.sort(sort_title_dec).appendTo(list);
  }
  else {
    listItems.sort(sort_popularity_asc).appendTo(list);
  }
  listItems.find('li').matchHeight({ remove: true });
  jQuery.each(data_mh, function(i,v){
    listItems.find('li[data-mh="'+v+'"]').matchHeight();
  });
  
  //jQuery.fn.matchHeight._update();
  //jQuery.fn.matchHeight._rows(listItems.find('li'));
});
// accending sort
function sort_title_asc(a, b){
    return (jQuery(b).data("title")) < (jQuery(a).data("title")) ? 1 : -1;    
}
// decending sort
function sort_title_dec(a, b){
    return (jQuery(b).data("title")) > (jQuery(a).data("title")) ? 1 : -1;    
}
// accending sort
function sort_popularity_asc(a, b){
  return (jQuery(b).data("popularity")) < (jQuery(a).data("popularity")) ? 1 : -1;    
}

// accordion
jQuery('.accordion-toggle').on('click', function(){
  jQuery(this).parents('.compare-accordion').toggleClass('open');
  
  if(jQuery(this).parents('.compare-accordion').hasClass('open')){
    jQuery(this).next('.accordion-content').slideDown();
  }
  else {
    jQuery(this).next('.accordion-content').slideUp();
  }
});

// --------------------------------------------------------------------
// Feature Store Provider - popups
// --------------------------------------------------------------------
function video_popups(){
  var popup_closed = jQuery.Event( "popup_closed" );

  jQuery('.open-video-popup').on('click', function(){
    var vid_id = jQuery(this).data('video');
    var src = 'https://www.youtube.com/embed/' + vid_id;
    jQuery('.video-popup iframe').attr("src", src);
    jQuery('.video-popup').addClass('displaying').show();

    jQuery('body').addClass('noscroll');
    
  });
  
  jQuery('.popup .close').on('click', function(){
    jQuery(this).closest('.popup').removeClass('displaying').hide();
    jQuery( 'body' ).trigger("popup_closed", [jQuery(this).closest('.popup')]);
    
    if(!jQuery('.compare-popup').hasClass('displaying')){
      jQuery('body').removeClass('noscroll');
    }
  });
  
  jQuery( 'body' ).on("popup_closed", function(e, popup){
    if(popup){
      if(popup.find('iframe').length){ // if has iframe (basically, if video)
        popup.find('iframe').attr("src", popup.find('iframe').attr("src"));
      }
    }
  });
}

// --------------------------------------------------------------------
// Teams Page Popups
// --------------------------------------------------------------------

jQuery('.grid-item').on('click', function(){
  var id = jQuery(this).data("id");
  jQuery('body').addClass('noscroll');
  jQuery('#'+id).show();
});

jQuery('.modal .close').on('click', function(){
  jQuery(this).closest('.modal-background').hide();
  jQuery( 'body' ).removeClass('noscroll');
});


// --------------------------------------------------------------------
// Reviews
// --------------------------------------------------------------------

jQuery('.reviewer').each(function(){
  var reviewer = jQuery(this);
  var profile = reviewer.data('profile');
  var from = reviewer.data('from');

  if(profile && from){
    if(from == 'Github.com'){
      jQuery.getJSON(profile, function(data) {
        if(data && data.html_url){
          reviewer.find('span').wrap('<a href="'+data.html_url+'" target="_blank"></a>');
        }
        if(data && data.login){
            reviewer.find('.name').text(data.login);
          }
      });
    }
    else {
      reviewer.find('span').wrap('<a href="'+profile+'" target="_blank"></a>');
    }
  }
});
  


// --------------------------------------------------------------------
// On page load
// --------------------------------------------------------------------
jQuery(function(){

  // limit to pages where the compare bar exists
  if(jQuery('.compare-bar').length > 0 ){
    populate_compare_tab_from_cookie();
    video_popups();
    compare_button_disable_toggle();
  }

  mobile_submenus();
  
});

// --------------------------------------------------------------------
// On page resize
// --------------------------------------------------------------------
jQuery(window).on('resize', function(){
	mobile_submenus();
});