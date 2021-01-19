<?php
namespace AHT\Testimonials\Model;
class Category extends \Magento\Framework\Model\AbstractModel implements  \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'aht_category';

    protected function _construct()
    {
        $this->_init('AHT\Testimonials\Model\ResourceModel\Category');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
    /**
     * get category name
     * @return string
     */
    public function getCategoryName() {
        return $this->getData('category_name');
    }

    /**
     * set category name
     *
     * @param $name
     * @return string
     */
    public function setCategoryName($name) {
        return $this->setData('category_name', $name);
    }

        /**
     * set Category Id
     *
     * @param $categoryId
     * @return integer
     */
    public function setCategoryId($categoryId) {
        return $this->setData('category_id', $categoryId);
    }
}