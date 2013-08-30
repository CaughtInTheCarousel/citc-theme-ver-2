jQuery(document).ready(function($) {
    // Color Scheme Options - These array names should match
    // the values in options.php

    // default Color Options
    var defaultscheme = new Array();
    defaultscheme['first_theme_color']='#b1d960';
    defaultscheme['second_theme_color']='#7fc33c';
    defaultscheme['third_theme_color']='#69963b';
    defaultscheme['fourth_theme_color']='#527b29';

    // blue1 Color Options
    var blue1 = new Array();
    blue1['first_theme_color']='#46CAE8';
    blue1['second_theme_color']='#2CAADA';
    blue1['third_theme_color']='#2681A2';
    blue1['fourth_theme_color']='#17637e';
    
    // blue2 Color Options
    var blue2 = new Array();
    blue2['first_theme_color']='#14a7cf';
    blue2['second_theme_color']='#0c6fb1';
    blue2['third_theme_color']='#0d507a';
    blue2['fourth_theme_color']='#083856';

    // brown Color Options
    var brown = new Array();
    brown['first_theme_color']='#d88761';
    brown['second_theme_color']='#bb6a3f';
    brown['third_theme_color']='#a7492f';
    brown['fourth_theme_color']='#78301d';

    // green1 Color Options
    var green1 = new Array();
    green1['first_theme_color']='#83BF29';
    green1['second_theme_color']='#629c14';
    green1['third_theme_color']='#578c10';
    green1['fourth_theme_color']='#406909';

    // orange1 Color Options
    var orange1 = new Array();
    orange1['first_theme_color']='#ffaf38';
    orange1['second_theme_color']='#fe8100';
    orange1['third_theme_color']='#c77014';
    orange1['fourth_theme_color']='#b77202';

    // purple Color Options
    var purple = new Array();
    purple['first_theme_color']='#e3acdc';
    purple['second_theme_color']='#d17ac6';
    purple['third_theme_color']='#996192';
    purple['fourth_theme_color']='#7b4474';

    // red1 Color Options
    var red1 = new Array();
    red1['first_theme_color']='#ed7351';
    red1['second_theme_color']='#db472f';
    red1['third_theme_color']='#c22a19';
    red1['fourth_theme_color']='#85312b';

    // steel Color Options
    var steel = new Array();
    steel['first_theme_color']='#bed7e0';
    steel['second_theme_color']='#82a3b2';
    steel['third_theme_color']='#7495a4';
    steel['fourth_theme_color']='#526a75';
    
    // When the select box #base_color_scheme changes
    // it checks which value was selected and calls of_update_color
    $('#section-color_palette').click(function() {
        colorscheme = $(this).find('input[type=radio]:checked').val();
        if (colorscheme == 'default') { colorscheme = defaultscheme; }
        if (colorscheme == 'blue1') { colorscheme = blue1; }
        if (colorscheme == 'blue2') { colorscheme = blue2; }
        if (colorscheme == 'brown') { colorscheme = brown; }
        if (colorscheme == 'green1') { colorscheme = green1; }
        if (colorscheme == 'orange1') { colorscheme = orange1; }
        if (colorscheme == 'purple') { colorscheme = purple; }        
        if (colorscheme == 'red1') { colorscheme = red1; }
        if (colorscheme == 'steel') { colorscheme = steel; }
        for (id in colorscheme) {
            of_update_color(id,colorscheme[id]);
        }
    });
    // This does the heavy lifting of updating all the colorpickers and text
    function of_update_color(id,hex) {
        $('#section-' + id + ' .of-color').css({backgroundColor:hex});
        $('#section-' + id + ' .colorSelector').ColorPickerSetColor(hex);
        $('#section-' + id + ' .colorSelector').children('div').css('backgroundColor', hex);
        $('#section-' + id + ' .of-color').val(hex);
        $('#section-' + id + ' .of-color').animate({backgroundColor:'#ffffff'}, 600);
    }
});