<?php


declare(strict_types=1);

use Contao\Config;
use Contao\System;
use Contao\DataContainer;
use Contao\DC_Table;

System::loadLanguageFile('tl_content');

$strtable = 'tl_dummy_archive';

$GLOBALS['TL_DCA'][$strtable] = [

    'config' => [
        'dataContainer' => DC_Table::class,
        'ctable' => ['tl_dummy_item'],

        'enableVersioning' => true,
        'sql' => [
            'keys' => [
                'id' => 'primary',
                'dummy_archive_name' => 'unique',
            ],
        ],
    ],

    'list' => [
        'sorting' => [
            'mode' => DataContainer::MODE_SORTABLE,
            'fields' => ['dummy_archive_name'],
            'panelLayout' => 'filter;sort,search,limit',
            'defaultSearchField' => 'dummy_archive_name',
            'disableGrouping' => true,
        ],
        'label' => [
            'fields' => ['dummy_archive_name'],

        ]
    ],

    'palettes' => [
        'default' => '{dummy_archive_name_legend},dummy_archive_name;{headline_legend},headline;{files_legend},multiSRC,sortBy;{publish_legend},published,start,stop;{access_legend},access_log',
    ],

    'fields' => [

        'id' => [
            'search' => false, // no effect -> why?
            'sql' => "int(10) unsigned NOT NULL auto_increment",
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

        'dummy_archive_name' => [
            'inputType' => 'text',
            'sorting' => true,
            'search' => true,
            'eval' => ['mandatory' => true, 'unique' => true, 'maxlength' => 64],
            'sql' => "varchar(64) NOT NULL default ''",
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
        ]

    ]

];