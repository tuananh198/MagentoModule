<?php 
namespace AHT\Testimonials\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface; 
 
class Posts extends Template implements BlockInterface {

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
    }

    public function getAll() {
        $collecion = $this->_blog->create();
        return $collecion;
    }

}