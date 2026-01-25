<?php

declare(strict_types=1);

namespace Coffeincode\ContaoDummyBundle\EventListener\DataContainer;

use Contao\DataContainer;
use Contao\StringUtil;

class DummyItemLabelCallback
{
    public function __invoke(array $row, string $label, DataContainer $dc, array $args = []): string
    {  
        $headline = '';
   
        if (isset($row['headline'])) {
            $headlineData = StringUtil::deserialize($row['headline'], true);

            if (is_array($headlineData)) {
                $headline = (string) ($headlineData['value'] ?? $headlineData[0] ?? '');
            } elseif (null !== $headlineData) {
                $headline = (string) $headlineData;
            }
        }

        $headline = trim($headline);

        if ($headline === '') {
            $headline = '-';
        }

        return sprintf('id %s - headline  %s', $row['id'] ?? '', $headline);
    }
}
