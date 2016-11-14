<?php

namespace graphan\Magento2GraphQL\Model\Product\Type;

use Youshido\GraphQL\Type\InputObject\InputObjectType;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQL\Type\Object\ObjectType;
use Youshido\GraphQL\Type\Scalar\BooleanType;
use Youshido\GraphQL\Type\Scalar\IntType;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
trait ProductTypeTrait
{
    private $isInput;

    public function getProductFields($config, $isInput = false)
    {
        $this->isInput = $isInput;

        $config
            ->addField('id', new StringType())
            ->addField('sku', new StringType())
            ->addField('name', new StringType())
            ->addField('attribute_set_id', new StringType())
            ->addField('status', new StringType())
            ->addField('type_id', new StringType())
            ->addField('created_at', new StringType())
            ->addField('updated_at', new StringType())
            ->addField('image', new StringType())
            ->addField('small_image', new StringType())
            ->addField('gender', new StringType())
            ->addField('description', new StringType())
            ->addField('thumbnail', new StringType())
            ->addField('required_options', new StringType())
            ->addField('has_options', new StringType())
            ->addField('url_key', new StringType())
            ->addField('special_price', new StringType())
            ->addField('special_from_date', new StringType())
            ->addField('news_from_date', new StringType())
            ->addField('custom_design_from', new StringType())
            ->addField('options_container', new StringType())
            ->addField('tax_class_id', new StringType())
            ->addField('activity', new StringType())
            ->addField('style_bags', new StringType())
            ->addField('material', new StringType())
            ->addField('strap_bags', new StringType())
            ->addField('features_bags', new StringType())
            ->addField('erin_recommends', new StringType())
            ->addField('sale', new StringType())
            ->addField('new', new StringType())
            ->addField('performance_fabric', new StringType())
            ->addField('category_gear', new StringType())
            ->addField('short_description', new StringType())
            ->addField('special_to_date', new StringType())
            ->addField('cost', new StringType())
            ->addField('weight', new StringType())
            ->addField('manufacturer', new StringType())
            ->addField('meta_title', new StringType())
            ->addField('meta_keyword', new StringType())
            ->addField('meta_description', new StringType())
            ->addField('media_gallery', new StringType())
            ->addField('old_id', new StringType())
            ->addField('tier_price', new StringType())
            ->addField('color', new StringType())
            ->addField('news_to_date', new StringType())
            ->addField('gallery', new StringType())
            ->addField('minimal_price', new StringType())
            ->addField('custom_design', new StringType())
            ->addField('custom_design_from', new StringType())
            ->addField('custom_design_to', new StringType())
            ->addField('custom_layout_update', new StringType())
            ->addField('page_layout', new StringType())
            ->addField('options_container', new StringType())
            ->addField('image_label', new StringType())
            ->addField('small_image_label', new StringType())
            ->addField('thumbnail_label', new StringType())
            ->addField('country_of_manufacture', new StringType())
            ->addField('quantity_and_stock_status', new StringType())
            ->addField('custom_layout', new StringType())
            ->addField('msrp', new StringType())
            ->addField('msrp_display_actual_price_type', new StringType())
            ->addField('price_type', new StringType())
            ->addField('sku_type', new StringType())
            ->addField('weight_type', new StringType())
            ->addField('price_view', new StringType())
            ->addField('shipment_type', new StringType())
            ->addField('url_path', new StringType())
            ->addField('links_purchased_separately', new StringType())
            ->addField('samples_title', new StringType())
            ->addField('links_title', new StringType())
            ->addField('links_exist', new StringType())
            ->addField('gift_message_available', new StringType())
            ->addField('tax_class_id', new StringType())
            ->addField('category_gear', new StringType())
            ->addField('size', new StringType())
            ->addField('eco_collection', new StringType())
            ->addField('format', new StringType())
            ->addField('style_bottom', new StringType())
            ->addField('style_general', new StringType())
            ->addField('sleeve', new StringType())
            ->addField('collar', new StringType())
            ->addField('pattern', new StringType())
            ->addField('climate', new StringType())
            ->addField('swatch_image', new StringType())
            ->addField('price', new StringType())
            ->addField('extension_attributes', $this->returnType([
                'name' => "ExtensionAttributes".$this->returnText(),
                'fields' => [
                    'stock_item' => $this->returnType([
                        'name' => 'StockItem'.$this->returnText(),
                        'fields' => [
                            'item_id' => new IntType(),
                            'product_id' => new IntType(),
                            'stock_id' => new IntType(),
                            'qty' => new IntType(),
                            'is_in_stock' => new BooleanType(),
                            'is_qty_decimal' => new BooleanType(),
                            'show_default_notification_message' => new BooleanType(),
                            'use_config_min_qty' => new BooleanType(),
                            'min_qty' => new IntType(),
                            'use_config_min_sale_qty' => new IntType(),
                            'min_sale_qty' => new IntType(),
                            'use_config_max_sale_qty' => new BooleanType(),
                            'max_sale_qty' => new IntType(),
                            'use_config_backorders' => new BooleanType(),
                            'backorders' => new IntType(),
                            'use_config_notify_stock_qty' => new BooleanType(),
                            'notify_stock_qty' => new IntType(),
                            'use_config_qty_increments' => new BooleanType(),
                            'qty_increments' => new IntType(),
                            'use_config_enable_qty_inc' => new BooleanType(),
                            'enable_qty_increments' => new BooleanType(),
                            'use_config_manage_stock' => new BooleanType(),
                            'manage_stock' => new BooleanType(),
                            'low_stock_date' => new StringType(),
                            'is_decimal_divided' => new BooleanType(),
                            'stock_status_changed_auto' => new IntType()
                        ]
                    ])
                ]
            ]))
            ->addField('media_gallery_entries', new ListType($this->returnType([
                'name' => 'MediaGallery'.$this->returnText(),
                'fields' => [
                    'id' => new IntType(),
                    'media_type' => new StringType(),
                    'label' => new StringType(),
                    'position' => new IntType(),
                    'disabled' => new BooleanType(),
                    'types' => new ListType(new StringType()),
                    'file' => new StringType()
                ]
            ])))
            ->addField('tier_prices', new ListType($this->returnType([
                'name' => 'TierPrice'.$this->returnText(),
                'fields' => [
                    'customer_group_id' => new IntType(),
                    'qty' => new StringType(),
                    'value' => new StringType()
                ]
            ])));
    }

    private function returnType($data)
    {
        if($this->isInput) {
            return new InputObjectType($data);
        }
        return new ObjectType($data);
    }

    private function returnText()
    {
        return $this->isInput ? 'Input' : 'Output';
    }
}