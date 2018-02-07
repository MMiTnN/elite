/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function init_editor(id, number) {
    var fullId = id + number;
    // this is need for the tabs to work
    quicktags({id: fullId});

    // use wordpress settings
    tinymce.init({
        selector: fullId,
        theme: "modern",
        skin: "lightgray",
        language: "en",
        formats: {
            alignleft: [
                {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'left'}},
                {selector: 'img,table,dl.wp-caption', classes: 'alignleft'}
            ],
            aligncenter: [
                {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'center'}},
                {selector: 'img,table,dl.wp-caption', classes: 'aligncenter'}
            ],
            alignright: [
                {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign: 'right'}},
                {selector: 'img,table,dl.wp-caption', classes: 'alignright'}
            ],
            strikethrough: {inline: 'del'}
        },
        relative_urls: false,
        remove_script_host: false,
        convert_urls: false,
        browser_spellcheck: true,
        fix_list_elements: true,
        entities: "38,amp,60,lt,62,gt",
        entity_encoding: "raw",
        keep_styles: false,
        paste_webkit_styles: "font-weight font-style color",
        preview_styles: "font-family font-size font-weight font-style text-decoration text-transform",
        wpeditimage_disable_captions: false,
        wpeditimage_html5_captions: true,
        plugins: "charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview,lists",
        selector: "#" + fullId,
        resize: "vertical",
        menubar: false,
        wpautop: true,
        indent: false,
        toolbar1: "bold,italic,bullist,numlist,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv", toolbar2: "formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
        toolbar3: "",
        toolbar4: "",
        tabfocus_elements: ":prev,:next",
        body_class: "id post-type-post post-status-publish post-format-standard",
        content_css: ''
    });

    // this is needed for the editor to initiate
    tinyMCE.execCommand('mceAddEditor', false, fullId);
}
function toggle_content(btnObj, parent) {

    //get collapse content selector
    var collapse_content_selector;
    if(parent !== undefined){
        collapse_content_selector = jQuery(btnObj).parents(parent).find('.collapsable:first');
    }else{
        collapse_content_selector = jQuery(btnObj).parent().parent().find('.collapsable:first');
    }

    //make the collapse content to be shown or hide
    var toggle_switch = jQuery(btnObj);
    jQuery(collapse_content_selector).toggle(function () {
        if (jQuery(this).css('display') == 'none') {
            toggle_switch.find('span').addClass('collapsed');//change the button label to be 'Show'
        } else {
            toggle_switch.find('span').removeClass('collapsed');//change the button label to be 'Hide'
        }
    });
}
(function( $ ) {
    
    
})(jQuery);