<?php

namespace AHT\Testimonials\Block\Category;


use Magento\Framework\View\Element\Template;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $_blog;

    public function __construct(
        Template\Context $context,
        \AHT\Testimonials\Model\ResourceModel\Category\CollectionFactory $blogFactory,
        array $data = []
    )
    {
        $this->_blog = $blogFactory;
        parent::__construct($context, $data);
    }

    /**
     * Preparing global layout
     *
     * @return $this
     */
    protected function _prepareLayout() {
        parent::_prepareLayout();
    }

    public function getAll() {
        $collecion = $this->_blog->create();
        return $collecion;
    }

    // public function getById($id) {
    //     $id = $this->getRequest()->getParams();
    //     $collection = $this->_blog->create();
    //     $collection->addFieldToFilter('id', $id);
    //     return $collection;
    // }

    // public function getCreate() {
    //         return $this->getUrl('testimonials/testimonial/create');
    // }

    // public function getEdit() {
    //     return $this->getUrl('testimonial/blog/edit');
    // }
}