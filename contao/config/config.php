<?php

declare(strict_types=1);
use Contao\ArrayUtil;
use Coffeincode\ContaoDummyBundle\Model\DummyArchiveModel;
use Coffeincode\ContaoDummyBundle\Model\DummyItemModel;


// Insert the Dummy group between Content and Layout (design).

ArrayUtil::arrayInsert($GLOBALS['BE_MOD'], 1, [
    'dummy' => [
        'dummy_archive' => [
            'tables' => ['tl_dummy_archive', 'tl_dummy_item'],
        ],
    ],
]);

$GLOBALS['TL_MODELS']['tl_dummy_archive'] = DummyArchiveModel::class;
$GLOBALS['TL_MODELS']['tl_dummy_item'] = DummyItemModel::class;
