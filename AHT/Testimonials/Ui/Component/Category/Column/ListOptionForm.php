<?php
namespace AHT\Testimonials\Ui\Component\Category\Column;

use AHT\Testimonials\Model\ResourceModel\Category\CollectionFactory;

class ListOptionForm implements \Magento\Framework\Option\ArrayInterface            
{
    protected $_categoryFactory;
    protected $_loadedData; 

    public function __construct(
        CollectionFactory $categoryCollectionFactory
    ){
        $this->_categoryFactory = $categoryCollectionFactory->create();
        // die;
    }
 
    public function toOptionArray()
    { 
        $categories = $this->_categoryFactory->getItems();
        $optionArray = [];
        foreach($categories as $category){
            $category = $category->getData();
            array_push($optionArray,[
                'value'  => $category['category_id'],
                'label'  => $category['category_name'],
            ]);
        }
    return $optionArray;
    }
}