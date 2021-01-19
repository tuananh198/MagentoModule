<?php
namespace AHT\Testimonials\Model;
class Testimonial extends \Magento\Framework\Model\AbstractModel implements  \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'aht_testimonials_testimonial';

    protected function _construct()
    {
        $this->_init('AHT\Testimonials\Model\ResourceModel\Testimonial');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}