<?php
namespace AHT\Testimonials\Model\ResourceModel;

class Testimonial extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('aht_testimonials_testimonial','id');
    }
}