/**
 * @file
 * Preview for the CMS theme.
 */
 
(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.color = {
    logoChanged: false,
    callback: function (context, settings, $form) {

      // Change the logo to be the real one.
      if (!this.logoChanged) {
        $('.color-preview .color-preview-logo img').attr('src', drupalSettings.color.logo);
        this.logoChanged = true;
      }
      
      // Remove the logo if the setting is toggled off.
      if (drupalSettings.color.logo === null) {
        $('div').remove('.color-preview-logo');
      }

      var $colorPreview = $form.find('.color-preview');
      var $colorPalette = $form.find('.js-color-palette');

      // Global
      $colorPreview.css( 'color', $colorPalette.find('input[name="palette[bodytxtcolor]"]').val());
      $colorPreview.css( 'background-color', $colorPalette.find('input[name="palette[bodybgcolor]"]').val());
      $colorPreview.find('a').css('color', $colorPalette.find('input[name="palette[primarycolor]"]').val());
      $colorPreview.find('.logo-name').css('color', $colorPalette.find('input[name="palette[websitenamecolor]"]').val());
      $colorPreview.find('.main-header').css('background-color', $colorPalette.find('input[name="palette[headerbg]"]').val());
      
      // Button
      $colorPreview.find('.btn').css('color', $colorPalette.find('input[name="palette[primarybtn]"]').val());
      $colorPreview.find('.btn').css('background-color', $colorPalette.find('input[name="palette[primarybtnbg]"]').val());
      $colorPreview.find('.btn').css('border-color', $colorPalette.find('input[name="palette[primarybtnbg]"]').val());
  
      // Slider      
      $colorPreview.find('.slider-caption').css('color', $colorPalette.find('input[name="palette[slidertxtcolor]"]').val());
      $colorPreview.find('.slider-caption .slider-title').css('color', $colorPalette.find('input[name="palette[slidertitlecolor]"]').val());

      $colorPreview.find('.parallax-slides1 .parallax-title').css('color', $colorPalette.find('input[name="palette[parallaxslide1title]"]').val());
      $colorPreview.find('.parallax-slides1 .parallax-caption').css('color', $colorPalette.find('input[name="palette[parallaxslide1content]"]').val());
      $colorPreview.find('.parallax-slides1 .parallax-caption').css('background-color', $colorPalette.find('input[name="palette[parallaxslide1bg]"]').val());

      $colorPreview.find('.parallax-slides2 .parallax-title').css('color', $colorPalette.find('input[name="palette[parallaxslide2title]"]').val());
      $colorPreview.find('.parallax-slides2 .parallax-caption').css('color', $colorPalette.find('input[name="palette[parallaxslide2content]"]').val());
      $colorPreview.find('.parallax-slides2 .parallax-caption').css('background-color', $colorPalette.find('input[name="palette[parallaxslide2bg]"]').val());

      $colorPreview.find('.parallax-slides3 .parallax-title').css('color', $colorPalette.find('input[name="palette[parallaxslide3title]"]').val());
      $colorPreview.find('.parallax-slides3 .parallax-caption').css('color', $colorPalette.find('input[name="palette[parallaxslide3content]"]').val());
      $colorPreview.find('.parallax-slides3 .parallax-caption').css('background-color', $colorPalette.find('input[name="palette[parallaxslide3bg]"]').val());

      $colorPreview.find('.parallax-slides4 .parallax-title').css('color', $colorPalette.find('input[name="palette[parallaxslide4title]"]').val());
      $colorPreview.find('.parallax-slides4 .parallax-caption').css('color', $colorPalette.find('input[name="palette[parallaxslide4content]"]').val());
      $colorPreview.find('.parallax-slides4 .parallax-caption').css('background-color', $colorPalette.find('input[name="palette[parallaxslide4bg]"]').val());
      
      $colorPreview.find('.parallax-slides5 .parallax-title').css('color', $colorPalette.find('input[name="palette[parallaxslide5title]"]').val());
      $colorPreview.find('.parallax-slides5 .parallax-caption').css('color', $colorPalette.find('input[name="palette[parallaxslide5content]"]').val());
      $colorPreview.find('.parallax-slides5 .parallax-caption').css('background-color', $colorPalette.find('input[name="palette[parallaxslide5bg]"]').val());

      $colorPreview.find('.parallax-slides6 .parallax-title').css('color', $colorPalette.find('input[name="palette[parallaxslide6title]"]').val());
      $colorPreview.find('.parallax-slides6 .parallax-caption').css('color', $colorPalette.find('input[name="palette[parallaxslide6content]"]').val());
      $colorPreview.find('.parallax-slides6 .parallax-caption').css('background-color', $colorPalette.find('input[name="palette[parallaxslide6bg]"]').val());

      $colorPreview.find('.team-wrap').css('color', $colorPalette.find('input[name="palette[teamcontent]"]').val());
      $colorPreview.find('.team-wrap .designation').css('color', $colorPalette.find('input[name="palette[teamdesignationcolor]"]').val());
      $colorPreview.find('.team-wrap').css('background-color', $colorPalette.find('input[name="palette[teamblockbg]"]').val());
      $colorPreview.find('.our-team').css('background-color', $colorPalette.find('input[name="palette[teambg]"]').val());

      $colorPreview.find('.service-details').css('color', $colorPalette.find('input[name="palette[services1content]"]').val());
      $colorPreview.find('.service-details .title').css('color', $colorPalette.find('input[name="palette[services1title]"]').val());
      $colorPreview.find('.service-details').css('background-color', $colorPalette.find('input[name="palette[services1bg]"]').val());

      $colorPreview.find('.service-details2').css('color', $colorPalette.find('input[name="palette[services2content]"]').val());
      $colorPreview.find('.service-details2 .title').css('color', $colorPalette.find('input[name="palette[services2title]"]').val());
      $colorPreview.find('.service-details2').css('background-color', $colorPalette.find('input[name="palette[services2bg]"]').val());
      $colorPreview.find('.services').css('background-color', $colorPalette.find('input[name="palette[services2bg]"]').val());

      $colorPreview.find('.price-table').css('color', $colorPalette.find('input[name="palette[pricetablecontent]"]').val());
      $colorPreview.find('.price-table .pricing_price').css('color', $colorPalette.find('input[name="palette[pricetablepricecolor]"]').val());
      $colorPreview.find('.pricing_item').css('background-color', $colorPalette.find('input[name="palette[pricetableblockbg]"]').val());
      $colorPreview.find('.price-table').css('background-color', $colorPalette.find('input[name="palette[pricetablebg]"]').val());
 
      $colorPreview.find('.blocks .region .title').css('color', $colorPalette.find('input[name="palette[block1title]"]').val());
      $colorPreview.find('.blocks .region').css('color', $colorPalette.find('input[name="palette[block1content]"]').val());
      $colorPreview.find('.blocks .region').css('background-color', $colorPalette.find('input[name="palette[block1bg]"]').val());

      $colorPreview.find('.blocks .region.two .title').css('color', $colorPalette.find('input[name="palette[block2title]"]').val());
      $colorPreview.find('.blocks .region.two').css('color', $colorPalette.find('input[name="palette[block2content]"]').val());
      $colorPreview.find('.blocks .region.two').css('background-color', $colorPalette.find('input[name="palette[block2bg]"]').val());

      $colorPreview.find('.blocks .region.three .title').css('color', $colorPalette.find('input[name="palette[block3title]"]').val());
      $colorPreview.find('.blocks .region.three').css('color', $colorPalette.find('input[name="palette[block3content]"]').val());
      $colorPreview.find('.blocks .region.three').css('background-color', $colorPalette.find('input[name="palette[block3bg]"]').val());

      $colorPreview.find('.footerwidget .title').css('color', $colorPalette.find('input[name="palette[footertitle]"]').val());
      $colorPreview.find('.footerwidget').css('color', $colorPalette.find('input[name="palette[footer]"]').val());
      $colorPreview.find('.footerwidget').css('background-color', $colorPalette.find('input[name="palette[footerbg]"]').val());

      $colorPreview.find('.footerwidget .title').css('color', $colorPalette.find('input[name="palette[footertitle]"]').val());
      $colorPreview.find('.footerwidget').css('color', $colorPalette.find('input[name="palette[footer]"]').val());
      $colorPreview.find('.footerwidget').css('background-color', $colorPalette.find('input[name="palette[footerbg]"]').val());

      $colorPreview.find('.copyright').css('background-color', $colorPalette.find('input[name="palette[copyrightbg]"]').val());
      $colorPreview.find('.copyright').css('color', $colorPalette.find('input[name="palette[copyrighttxt]"]').val());

    }
    
  };

})(jQuery, Drupal, drupalSettings);
