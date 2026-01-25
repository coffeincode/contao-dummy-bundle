<?php


declare(strict_types=1);

use Contao\Config;
use Contao\System;
use Contao\DataContainer;
use Contao\DC_Table;

System::loadLanguageFile('tl_content');

$strtable = 'tl_dummy_item';

$GLOBALS['TL_DCA'][$strtable] = [

    'config' => [
        'dataContainer' => DC_Table::class,
        'ptable' => 'tl_dummy_archive',
        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'dummy_item_name' => 'unique',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_PARENT,
            'fields' => ['dummy_item_name'],
            'panelLayout' => 'filter;sort,search,limit',
            'defaultSearchField' => 'dummy_item_name',
            'disableGrouping' => true,
            'headerFields' => ['dummy_archive_name', 'headline'],
        ],

        'label' => [
            'fields' => ['dummy_item_name'],

        ]
    ],

    'palettes' => [
        'default' => '{dummy_name_legend},dummy_item_name;{headline_legend},headline;{files_legend},multiSRC,sortBy;{publish_legend},published,start,stop;{access_legend},access_log',
    ],

    'fields' => [

        'id' => [
            'search' => false, // no effect -> why?
            'sql' => "int(10) unsigned NOT NULL auto_increment",
        ],
        'pid' => [

            'sql' => "int(10) unsigned NOT NULL",
        ],

        'tstamp' => [
            'sql' => "int(10) unsigned NOT NULL default 0",
        ],

        'headline' => [
            'search' => true,
            'inputType' => 'inputUnit',
            'options' => ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
            'eval' => ['maxlength' => 200, 'basicEntities' => true, 'tl_class' => 'w50 clr'],
            'sql' => "varchar(255) NOT NULL default 'a:2:{s:5:\"value\";s:0:\"\";s:4:\"unit\";s:2:\"h2\";}'"
        ],

        'dummy_item_name' => [
            'inputType' => 'text',
            'sorting' => true,
            'search' => true,
            'eval' => ['mandatory' => true, 'unique' => true, 'maxlength' => 64],
            'sql' => "varchar(64) NOT NULL default ''",
        ],

        'multiSRC' => [
            'inputType' => 'fileTree',
            'eval' => ['multiple' => true, 'fieldType' => 'checkbox', 'isSortable' => true, 'files' => true, 'isDownloads' => true, 'extensions' => Config::get('allowedDownload'), 'mandatory' => true],
            'sql' => "blob NULL",
        ],

        'sortBy' => [
            'label' => &$GLOBALS['TL_LANG']['tl_content']['sortBy'],
            'inputType' => 'select',
            'options' => array('custom', 'name_asc', 'name_desc', 'date_asc', 'date_desc', 'random'),
            'reference' => &$GLOBALS['TL_LANG']['tl_content'],
            'eval' => array('tl_class' => 'w50 clr'),
            'sql' => "varchar(32) COLLATE ascii_bin NOT NULL default ''"
        ],

        'published' => [
            'inputType' => 'checkbox',
            'filter' => true,
            'toggle' => true,
            //'eval' => ['tl_class' => 'w50'],
            'sql' => "char(1) NOT NULL default ''",
        ],


        'start' => [
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => "varchar(10) NOT NULL default ''"
        ],

        'stop' => [
            'inputType' => 'text',
            'eval' => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql' => "varchar(10) NOT NULL default ''"
        ],



    ]

];
