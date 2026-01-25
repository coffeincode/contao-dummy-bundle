<?php

declare(strict_types=1);

use Coffeincode\ContaoDummyBundle\Model\DummyArchiveModel;

$GLOBALS['TL_DCA']['tl_module']['palettes']['dummy_list'] = '{title_legend},name,headline,type;{config_legend},dummy_archive;{template_legend:hide},customTpl;{protected_legend:hide},protected;{expert_legend:hide},cssID';

$GLOBALS['TL_DCA']['tl_module']['fields']['dummy_archive'] = [
    'inputType' => 'select',
    'options_callback' => static function (): array {
        $options = [];
        $archives = DummyArchiveModel::findAll(['order' => 'dummy_archive_name']);

        if ($archives === null) {
            return $options;
        }

        foreach ($archives as $archive) {
            $options[$archive->id] = $archive->dummy_archive_name;
        }

        return $options;
    },
    'eval' => ['includeBlankOption' => true, 'chosen' => true, 'tl_class' => 'w50'],
    'sql' => "int(10) unsigned NOT NULL default 0",
    'relation' => ['table' => 'tl_dummy_archive', 'type' => 'belongsTo', 'load' => 'lazy'],
];
