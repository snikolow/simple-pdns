<?php

namespace Devzone\Twig\Extension;

use Devzone\Service\View\Sidebar;

/**
 * Class ViewExtension
 * @package Devzone\Twig\Extension
 */
class ViewExtension extends \Twig_Extension
{

    /**
     * @var Sidebar
     */
    private $sidebar;

    /**
     * ViewExtension constructor.
     * @param Sidebar $sidebar
     */
    public function __construct(Sidebar $sidebar)
    {
        $this->sidebar = $sidebar;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions(): array
    {
        return [
            'getSidebarItems' => new \Twig_SimpleFunction('getSidebarItems', [$this, 'getSidebarItems']),
        ];
    }

    /**
     * @return array
     */
    public function getSidebarItems(): array
    {
        return $this->sidebar->getItems();
    }

}
