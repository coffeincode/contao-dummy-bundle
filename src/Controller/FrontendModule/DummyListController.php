<?php

declare(strict_types=1);

namespace Coffeincode\ContaoDummyBundle\Controller\FrontendModule;

use Coffeincode\ContaoDummyBundle\Model\DummyArchiveModel;
use Coffeincode\ContaoDummyBundle\Model\DummyItemModel;
use Contao\CoreBundle\Controller\FrontendModule\AbstractFrontendModuleController;
use Contao\CoreBundle\DependencyInjection\Attribute\AsFrontendModule;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Contao\ModuleModel;
use Contao\StringUtil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[AsFrontendModule(type: 'dummy_list', category: 'dummy', template: 'frontend_module/dummy_list')]
class DummyListController extends AbstractFrontendModuleController
{
    protected function getResponse(FragmentTemplate $template, ModuleModel $model, Request $request): Response
    {
        $archive = null;
        $items = [];

        if ($model->dummy_archive) {
            $archive = DummyArchiveModel::findById($model->dummy_archive);
        }

        if ($archive !== null) {
            $collection = DummyItemModel::findBy('pid', $archive->id, ['order' => 'dummy_item_name']);

            if ($collection !== null) {
                foreach ($collection as $item) {
                    $headlineData = StringUtil::deserialize($item->headline, true);
                    $headline = (string) ($headlineData['value'] ?? $headlineData[0] ?? '');

                    $items[] = [
                        'id' => $item->id,
                        'name' => $item->dummy_item_name,
                        'headline' => $headline !== '' ? $headline : $item->dummy_item_name,
                    ];
                }
            }
        }

        $template->set('archive', $archive);
        $template->set('items', $items);

        return $template->getResponse();
    }
}
