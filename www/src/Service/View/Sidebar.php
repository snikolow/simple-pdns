<?php

namespace Devzone\Service\View;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class Sidebar
 * @package Devzone\Service\View
 */
class Sidebar
{

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * Sidebar constructor.
     * @param \Symfony\Component\Routing\RouterInterface $router
     * @param \Symfony\Component\Translation\TranslatorInterface $translator
     */
    public function __construct(RouterInterface $router, TranslatorInterface $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return [
            [
                'label' => $this->translator->trans('dashboard', [], 'sidebar'),
                'location' => $this->router->generate('action.dashboard.index'),
                'icon' => 'fa fa-plus-square',
            ],
            [
                'label' => $this->translator->trans('domains', [], 'sidebar'),
                'location' => $this->router->generate('action.domain.index'),
                'icon' => 'fa fa-plus-square',
            ],
            [
                'label' => $this->translator->trans('records', [], 'sidebar'),
                'location' => $this->router->generate('action.record.index'),
                'icon' => 'fa fa-plus-square',
            ],
        ];
    }

}