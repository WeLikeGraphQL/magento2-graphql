<?php

namespace graphan\Magento2GraphQL\Model\Attribute\Type;

use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Scalar\StringType;

/**
 * @codeCoverageIgnore
 */
trait AttributeTypeTrait
{
    public function addAttributeFields(ObjectTypeConfig $config)  // implementing an abstract function where you build your type
    {
        $config
            ->addField('attribute_id', new StringType())
            ->addField('attribute_code', new StringType())
            ->addField('is_wysiwyg_enabled', new StringType())
            ->addField('is_html_allowed_on_front', new StringType())
            ->addField('used_for_sort_by', new StringType())
            ->addField('is_filterable', new StringType())
            ->addField('is_filterable_in_search', new StringType())
            ->addField('is_used_in_grid', new StringType())
            ->addField('is_visible_in_grid', new StringType())
            ->addField('is_filterable_in_grid', new StringType())
            ->addField('position', new StringType())
            ->addField('apply_to', new StringType())
            ->addField('is_searchable', new StringType())
            ->addField('is_visible_in_advanced_search', new StringType())
            ->addField('is_comparable', new StringType())
            ->addField('is_used_for_promo_rules', new StringType())
            ->addField('is_visible_on_front', new StringType())
            ->addField('used_in_product_listing', new StringType())
            ->addField('is_visible', new StringType())
            ->addField('scope', new StringType())
            ->addField('frontend_input', new StringType())
            ->addField('entity_type_id', new StringType())
            ->addField('is_required', new StringType())
            ->addField('options', new StringType())
            ->addField('is_user_defined', new StringType())
            ->addField('default_frontend_label', new StringType())
            ->addField('frontend_labels', new StringType())
            ->addField('backend_type', new StringType())
            ->addField('is_unique', new StringType())
            ->addField('validation_rules', new StringType());
    }
}