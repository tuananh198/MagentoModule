<?php

namespace AHT\Testimonials\Model\Category\Source;


use Magento\Framework\View\Element\Template;
use Magento\Framework\Data\OptionSourceInterface;


class Category extends \Magento\Framework\View\Element\Template implements OptionSourceInterface
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
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $a = [];
        $i = 0;
        $collecion = $this->_blog->create();
        $array[] = $collecion->getData();
        foreach ($array[0] as $key => $value) {
            foreach ($value as $k => $v) {
                $a[$i] = $v;
                $i++;
            }
        }
        // echo "<pre>";
        // var_dump($a);
        // echo "</pre>";
        // die();
        for ($i=0; $i < count($a); $i++) { 
            $options[] = [
                'value' => $a[$i],
                'label' => $a[++$i],
            ];
        }
        return $options;
    }
    

}