<?php
namespace AHT\Testimonials\Controller\Adminhtml\Index;

use AHT\Testimonials\Model\ImageUploader;

class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Index';

    protected $resultPageFactory;
    protected $contactFactory;

    protected $imageUploader;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \AHT\Testimonials\Model\TestimonialFactory $contactFactory,
        \AHT\Testimonials\Model\ImageUploader $imageUploader
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->contactFactory = $contactFactory;
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if($data)
        {
            try{
                $id = $data['id'];

                $contact = $this->contactFactory->create()->load($id);

                if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
                    $data['image'] = $data['image'][0]['name'];
                    //$this->imageUploader->moveFileFromTmp($data['image']);
                } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
                    $data['image'] = $data['image'][0]['name'];
                } else {
                    $data['image'] = ' ';
                }

                $data = array_filter($data, function($value) {return $value !== ''; });

                $contact->setData($data);
                // echo "<pre>";
                // print_r($contact->getData());
                // echo "</pre>";
                // die(); 
                $contact->save();
                $this->messageManager->addSuccess(__('Successfully saved the testimonial.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                return $resultRedirect->setPath('*/*/');
            }
            catch(\Exception $d)
            {
                $this->messageManager->addError($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);
                return $resultRedirect->setPath('*/*/edit', ['id' => $contact->getId()]);
            }
        }

         return $resultRedirect->setPath('*/*/');
    }
}