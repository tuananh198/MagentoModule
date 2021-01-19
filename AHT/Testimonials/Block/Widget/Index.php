<?php

namespace AHT\Testimonials\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface; 

class Index extends Template implements BlockInterface
{
    protected $_blog;
    protected $_template = "widget/index.phtml";

    public function __construct(
        Template\Context $context,
        \AHT\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory $blogFactory,
        array $data = []
    )
    {
        $this->_blog = $blogFactory;
        parent::__construct($context, $data);
        die();
    }

    /**
     * Preparing global layout
     *
     * @return $this
     */

    public function getAll() {
        $collecion = $this->_blog->create();
        return $collecion;
    }


    // public function getEdit() {
    //     return $this->getUrl('testimonial/blog/edit');
    // }
}