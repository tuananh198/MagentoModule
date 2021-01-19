<?php
namespace AHT\Testimonials\Model\ResourceModel\Testimonial;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('AHT\Testimonials\Model\Testimonial','AHT\Testimonials\Model\ResourceModel\Testimonial');
    }
}