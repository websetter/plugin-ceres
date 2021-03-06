<?php

namespace Ceres\Widgets\Item;

use Ceres\Widgets\Helper\BaseWidget;
use Ceres\Widgets\Helper\Factories\WidgetSettingsFactory;
use Ceres\Widgets\Helper\WidgetCategories;
use Ceres\Widgets\Helper\Factories\WidgetDataFactory;
use Ceres\Widgets\Helper\WidgetTypes;

class GraduatedPriceWidget extends BaseWidget
{
    protected $template = "Ceres::Widgets.Item.GraduatedPriceWidget";

    public function getData()
    {
        return WidgetDataFactory::make("Ceres::GraduatedPriceWidget")
            ->withLabel("Widget.graduatedPriceLabel")
            ->withPreviewImageUrl("/images/widgets/graduated-price.svg")
            ->withType(WidgetTypes::SINGLE_ITEM)
            ->withCategory(WidgetCategories::ITEM)
            ->withPosition(500)
            ->toArray();
    }

    public function getSettings()
    {
        /** @var WidgetSettingsFactory $settingsFactory */
        $settingsFactory = pluginApp(WidgetSettingsFactory::class);

        $settingsFactory->createCustomClass();
        $settingsFactory->createAppearance()
            ->withDefaultValue("success");
        $settingsFactory->createSpacing();

        return $settingsFactory->toArray();
    }
}
