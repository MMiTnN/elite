$(function () {
    shirnk_body();

    $('button.navbar-toggle').click(function (e) {
        $('body').toggleClass('out');
        $('.collapse-menu').toggleClass('in');
        $(".collapse-menu .dropdown.menu-item-depth-0 > a span").removeClass('glyphicon-minus').addClass('glyphicon-plus');
        if ($('body').hasClass('out')) {
            $(this).focus();
        } else {
            $(this).blur();
        }
    });

    $('body').click(function (e) {
        if (!$(e.target).closest('.navbar-collapse, button.navbar-toggle').length && $('body').hasClass('out')) {
            e.preventDefault();
            $('button.navbar-toggle').trigger('click');
        }
    }).keyup(function (e) {
        if (e.keyCode == 27 && $('body').hasClass('out')) {
            $('button.navbar-toggle').trigger('click');
        }
    });


    $(window).scroll(function () {
        shirnk_body();
    });

    if ($(window).width() < 768)
    {
        $('.dropdown ').click(function () {
            if ($(this).hasClass('open')) {
                $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
                $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                $(this).parent().siblings().find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            }
        });

        // Footer
        $("footer #accordion .accordion").click(function () {
            if ($(this).hasClass('collapsed')) {
                $(this).find('span').removeClass('glyphicon-plus').addClass('glyphicon-minus');
                $(this).parents(".panel-default").siblings().find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            } else {
                $(this).find('span').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            }
        });
    }

    /* When click search button */
    $('.btn-mobile-search').click(function () {
        var elm = $('.mobile-search-container');
        var search_input = $('.sb-search-input');
        if (elm.hasClass('hidden')) {
            elm.removeClass('hidden').addClass('visible-xs');
            search_input.focus();
        } else {
            elm.removeClass('visible-xs').addClass('hidden');
        }
    });


    var submitIcon = $('.searchbox-icon');
    var inputBox = $('.searchbox-input');
    var searchBox = $('.searchbox');
    var isOpen = false;
    submitIcon.click(function () {
        if (isOpen == false) {
            searchBox.addClass('searchbox-open');
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass('searchbox-open');
            inputBox.focusout();
            isOpen = false;
        }
    });
    submitIcon.mouseup(function () {
        return false;
    });
    searchBox.mouseup(function () {
        return false;
    });
    $(document).mouseup(function () {
        if (isOpen == true) {
            $('.searchbox-icon').css('display', 'block');
            submitIcon.click();
        }
    });
});

function buttonUp() {
    var inputVal = $('.searchbox-input').val();
    inputVal = $.trim(inputVal).length;
    if (inputVal !== 0) {
        $('.searchbox-icon').css('display', 'none');
    } else {
        $('.searchbox-input').val('');
        $('.searchbox-icon').css('display', 'block');
    }
}


function shirnk_body()
{
    if ($(document).scrollTop() > 0) {
        $('nav').addClass('shrink');
    } else {
        $('nav').removeClass('shrink');
    }
}