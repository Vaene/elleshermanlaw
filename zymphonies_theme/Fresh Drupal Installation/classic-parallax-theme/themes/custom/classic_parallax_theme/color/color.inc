<?php

/**
 * @file
 * Lists available colors and color schemes for the Bartik theme.
 */

$info = array(

  // Available colors and color labels used in theme.
  'fields' => array(
    'bodytxtcolor'=> t('Body content'),
    'bodybgcolor'=> t('Body background'),
    'websitenamecolor'=> t('Website name color'),
    'headerbg'=> t('Header background'),

    'primarycolor'=> t('Primary color'),
    'primarycolordark'=> t('Primary color dark'),
    'primarybtn'=> t('Primary button color'),
    'primarybtnbg'=> t('Primary button background'),

    'menucolor'=> t('Menu text'),
    'menuactivetxtcolor'=> t('Menu active'),
    'menubgcolor'=> t('Menu background'),

    'slidertitlecolor'=> t('Slider title'),
    'slidertxtcolor'=> t('Slider content'),

    'parallaxslide1title'=> t('Parallax slide-1 title'),
    'parallaxslide1content'=> t('Parallax slide-1 content'),
    'parallaxslide1bg'=> t('Parallax slide-1 background'),

    'parallaxslide2title'=> t('Parallax slide-2 title'),
    'parallaxslide2content'=> t('Parallax slide-2 content'),
    'parallaxslide2bg'=> t('Parallax slide-2 background'),

    'parallaxslide3title'=> t('Parallax slide-3 title'),
    'parallaxslide3content'=> t('Parallax slide-3 content'),
    'parallaxslide3bg'=> t('Parallax slide-3 background'),

    'parallaxslide4title'=> t('Parallax slide-4 title'),
    'parallaxslide4content'=> t('Parallax slide-4 content'),
    'parallaxslide4bg'=> t('Parallax slide-4 background'),

    'parallaxslide5title'=> t('Parallax slide-5 title'),
    'parallaxslide5content'=> t('Parallax slide-5 content'),
    'parallaxslide5bg'=> t('Parallax slide-5 background'),

    'parallaxslide6title' => t('Parallax slide-6 title'),
    'parallaxslide6content' => t('Parallax slide-6 content'),
    'parallaxslide6bg' => t('Parallax slide-6 background'),

    'teamcontent'=> t('Team content'),
    'teamdesignationcolor'=> t('Team designation color'), 
    'teamblockbg'=> t('Team block background'),
    'teambg'=> t('Team background'),

    'servicestitle' => t('Services title'),
    'servicescontent' => t('Services content'),
    'servicesfirstbg' => t('Services first background'),
    'servicessecondbg' => t('Services second background'),

    'services1title' => t('Service-1 title'),
    'services1content'  => t('Service-1 content'),
    'services1bg' => t('Service-1 background'),
    'services2title' => t('Service-2 title'),
    'services2content'  => t('Service-2 content'),
    'services2bg' => t('Service-2 background'),

    'pricetablecontent'=> t('Price table content'),
    'pricetableblockbg'=> t('Price table block background'),
    'pricetablepricecolor'=> t('Price table price color'),
    'pricetablebg'=> t('Price table background'),

    'block1title' => t('Block-1 title'),
    'block1content' => t('Block-1 content'),
    'block1bg' => t('Block-1 background'),
    'block2title' => t('Block-2 title'),
    'block2content' => t('Block-2 content'),
    'block2bg' => t('Block-2 background'),
    'block3title' => t('Block-3 title'),
    'block3content' => t('Block-3 content'),
    'block3bg' => t('Block-3 background'),

    'footer' => t('Footer'),
    'footertitle' => t('Footer title'),
    'footerbg' => t('Footer background'),

    'copyrightbg'=> t('Copyright background'),
    'copyrighttxt'=> t('Copyright content'),
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('Zymphonies (default)'),
      'colors' => array(
        'bodytxtcolor'=> '#0f0e0e',
        'bodybgcolor'=> '#f5f0f0',
        'websitenamecolor' => '#171515',
        'headerbg' => '#f9f9f9',

        'primarycolor'=> '#024671',
        'primarycolordark'=> '#1e6ea2',
        'primarybtn'=> '#fffffc',
        'primarybtnbg'=> '#ff0505',

        'menucolor' => '#fafafa',
        'menuactivetxtcolor' => '#f70000',
        'menubgcolor' => '#0d0d0f',

        'slidertitlecolor' => '#fffffd',
        'slidertxtcolor' => '#fffffe',

        'parallaxslide1title' => '#ececec',
        'parallaxslide1content' => '#a5a5a5',
        'parallaxslide1bg' => '#141414',

        'parallaxslide2title' => '#f0f0f1',
        'parallaxslide2content' => '#a9a9a9',
        'parallaxslide2bg' => '#141313',

        'parallaxslide3title' => '#f8f8f8',
        'parallaxslide3content' => '#b9b8b8',
        'parallaxslide3bg' => '#0f0e0e',

        'parallaxslide4title' => '#201f25',
        'parallaxslide4content' => '#e8e8e8',
        'parallaxslide4bg' => '#df2927',

        'parallaxslide5title' => '#f9f0f0',
        'parallaxslide5content' => '#f0efef',
        'parallaxslide5bg' => '#101010',

        'parallaxslide6title' => '#e3e2e2',
        'parallaxslide6content' => '#edecec',
        'parallaxslide6bg' => '#121212',

        'teamcontent'=> '#050505',
        'teamdesignationcolor'=> '#585858',
        'teamblockbg'=> '#f1f1f1',
        'teambg'=> '#808080',
        
        'services1title' => '#f7f7f7',
        'services1content' => '#f7f7f7',
        'services1bg' => '#121211',
        'services2title' => '#f2f2f2',
        'services2content' => '#f2f2f2',
        'services2bg' => '#fc0000',

        'pricetablecontent'=> '#0f0f0e',
        'pricetablepricecolor'=> '#ff0000',
        'pricetableblockbg'=> '#f1f1f2',
        'pricetablebg'=> '#d4d4d4',

        'block1title' => '#080807',
        'block1content' => '#080807',
        'block1bg' => '#ffff33',
        'block2title' => '#030302',
        'block2content' => '#030302',
        'block2bg' => '#6993fe',
        'block3title' => '#0d0d0c',
        'block3content' => '#0d0d0c',
        'block3bg' => '#66cc8d',

        'footer' => '#141413',
        'footertitle' => '#050506',
        'footerbg' => '#f5f5f5',

        'copyrighttxt'=> '#999999',
        'copyrightbg'=> '#08080a',
      ),
    ),
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'css/colors.css',
  ),

  // Files to copy.
  'copy' => array(
    'logo.svg',
  ),

  // Preview files.
  'preview_library' => 'classic_parallax_theme/color.preview',
  'preview_html' => 'color/preview.html',

  // Attachments.
  '#attached' => [
    'drupalSettings' => [
      'color' => [
        // Put the logo path into JavaScript for the live preview.
        'logo' => theme_get_setting('logo.url', 'classic_parallax_theme'),
      ],
    ],
  ],
  
);
