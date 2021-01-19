<?php
namespace AHT\Testimonials\Model\ResourceModel\Category;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'category_id';

    protected function _construct()
    {
        $this->_init('AHT\Testimonials\Model\Category','AHT\Testimonials\Model\ResourceModel\Category');
    }
}