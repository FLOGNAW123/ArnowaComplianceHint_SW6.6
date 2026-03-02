<?php

declare(strict_types=1);

namespace Arnowa\ComplianceHint\Subscriber;

use Arnowa\ComplianceHint\Core\Content\ComplianceHint\ComplianceHintEntity;
use Shopware\Storefront\Page\Product\ProductPageCriteriaEvent;
use Shopware\Storefront\Page\Product\ProductPageLoadedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ProductPageSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            ProductPageCriteriaEvent::class => 'onProductCriteria',
            ProductPageLoadedEvent::class => 'onProductLoaded',
        ];
    }

    public function onProductCriteria(ProductPageCriteriaEvent $event): void
    {
        $event->getCriteria()->addAssociation('arnowaComplianceHint');
    }

    public function onProductLoaded(ProductPageLoadedEvent $event): void
    {
        $product = $event->getPage()->getProduct();

        $hint = $product->getExtension('arnowaComplianceHint');

        if (!$hint instanceof ComplianceHintEntity) {
            return;
        }

        if (!$hint->isHintRequired() || empty($hint->getHintText())) {
            return;
        }

        $event->getPage()->addExtension('arnowaComplianceHint', $hint);
    }
}
