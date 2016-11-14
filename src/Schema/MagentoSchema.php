<?php

namespace graphan\Magento2GraphQL\Schema;

use Magento\Config\Model\Config\Backend\Admin\Custom;
use Youshido\GraphQL\Config\Schema\SchemaConfig;
use Youshido\GraphQL\Field\AbstractField;
use Youshido\GraphQL\Schema\AbstractSchema;

/**
 * @codeCoverageIgnore
 */
class MagentoSchema extends AbstractSchema
{
    // Category Fields
    private $addCategoryField;
    private $categoriesField;
    private $categoryField;
    private $deleteCategoryField;
    private $moveCategoryField;
    private $updateCategoryField;

    // Category Attribute Fields
    private $categoryAttributeField;
    private $categoryAttributesField;

    //Modules Field
    private $modulesField;

    // Product Attribute Fields
    private $addProductAttributeField;
    private $deleteProductAttributeField;
    private $productAttributeField;
    private $productAttributesField;

    // Product Fields
    private $addProductField;
    private $deleteProductField;
    private $productField;
    private $productsField;
    private $updateProductField;

    private $logger;

    public function __construct(AbstractField $addCategoryField,
                                AbstractField $addProductAttributeField,
                                AbstractField $addProductField,
                                AbstractField $categoriesField,
                                AbstractField $categoryAttributeField,
                                AbstractField $categoryAttributesField,
                                AbstractField $categoryField,
                                AbstractField $deleteCategoryField,
                                AbstractField $deleteProductAttributeField,
                                AbstractField $deleteProductField,
                                AbstractField $modulesField,
                                AbstractField $moveCategoryField,
                                AbstractField $productAttributeField,
                                AbstractField $productAttributesField,
                                AbstractField $productField,
                                AbstractField $productsField,
                                AbstractField $updateCategoryField,
                                AbstractField $updateProductField
    )
    {
        // Category
        $this->addCategoryField = $addCategoryField;
        $this->categoriesField = $categoriesField;
        $this->categoryField = $categoryField;
        $this->deleteCategoryField = $deleteCategoryField;
        $this->moveCategoryField = $moveCategoryField;
        $this->updateCategoryField = $updateCategoryField;
//
//        // Category Attribute
        $this->categoryAttributeField = $categoryAttributeField;
        $this->categoryAttributesField = $categoryAttributesField;
//
//        // Modules
        $this->modulesField = $modulesField;

        // Product Attribute
        $this->addProductAttributeField = $addProductAttributeField;
        $this->deleteProductAttributeField = $deleteProductAttributeField;
        $this->productAttributeField = $productAttributeField;
        $this->productAttributesField = $productAttributesField;

        // Product
        $this->addProductField = $addProductField;
        $this->deleteProductField = $deleteProductField;
        $this->productField = $productField;
        $this->productsField = $productsField;
        $this->updateProductField = $updateProductField;

        parent::__construct([]);
    }

    public function build(SchemaConfig $config)
    {
        $config->getQuery()
            ->addField($this->categoriesField)
            ->addField($this->categoryField)
            ->addField($this->categoryAttributesField)
            ->addField($this->categoryAttributeField)
            ->addField($this->modulesField)
            ->addField($this->productAttributesField)
            ->addField($this->productAttributeField)
            ->addField($this->productField)
            ->addField($this->productsField);

        $config->getMutation()
            ->addField($this->addCategoryField)
            ->addField($this->addProductAttributeField)
            ->addField($this->addProductField)
            ->addField($this->deleteCategoryField)
            ->addField($this->deleteProductAttributeField)
            ->addField($this->deleteProductField)
            ->addField($this->moveCategoryField)
            ->addField($this->updateCategoryField)
            ->addField($this->updateProductField);
    }
}

?>