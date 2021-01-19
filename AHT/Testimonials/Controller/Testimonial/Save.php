<?php


namespace AHT\Testimonials\Controller\Testimonial;


use Magento\Framework\App\Action\Context;
use  Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \AHT\Testimonials\Model\TestimonialFactory
     */
    protected $_blogFactory;

    /**
     * @var \AHT\Testimonials\Model\ResourceModel\Testimonial
     */
    protected $_resource;

    protected $_pageFactory;

    protected $resultRedirect;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    private $_cacheTypeList;
    private $_cacheFrontendPool;

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

        /**
     * Media directory object (writable).
     *
     * @var WriteInterface
     */
    protected $mediaDirectory;

    /**
     * Save constructor.
     * @param Context $context
     * @param \AHT\Testimonials\Model\TestimonialFactory $blogFactory
     * @param \AHT\Testimonials\Model\ResourceModel\Testimonial $resource
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Controller\ResultFactory $result
     * @param \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool
     */
    public function __construct(
        Context $context,
        \AHT\Testimonials\Model\TestimonialFactory $blogFactory,
        \AHT\Testimonials\Model\ResourceModel\Testimonial $resource,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Controller\ResultFactory $result,
        \Magento\Framework\App\Cache\TypeListInterface $cacheTypeList,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\App\Cache\Frontend\Pool $cacheFrontendPool,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory
    )
    {
        $this->_blogFactory = $blogFactory;
        $this->_storeManager = $storeManager;
        $this->_resource = $resource;
        $this->resultRedirect = $result;
        $this->_filesystem = $filesystem;
        $this->_cacheTypeList = $cacheTypeList;
        $this->_cacheFrontendPool = $cacheFrontendPool;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->mediaDirectory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);

        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getPostValue();

        $blog = $this->_blogFactory->create();

        if (isset($_POST['createBtn'])) {
            $data = [
                'name' => $post['name'],
                'email' => $post['email'],
                'designation' => $post['designation'],
                'contact' => $post['contact'],
                'message' => $post['message'],
                'image' => $_FILES['image']['name'],
                'category_id' => $post['category_id']
            ];
            
            try{
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'image']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                /* start of validated image */
                $uploaderFactory->addValidateCallback('custom_image_upload',
                    $imageAdapter,'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(false);
                $destinationPath = $this->mediaDirectory->getAbsolutePath('pathtoyourimage');
                // var_dump($destinationPath);
                // die;
                $result = $uploaderFactory->save($destinationPath);
                // echo "<pre>";
                // var_dump($result);
                // echo "</pre>";
                // die;               
                if (!$result) {
                    throw new LocalizedException(
                        __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                /* you need yo save image 
                     $result['file'] at datbaseQQ 
                */
                $imagepath = $result['file'];
                //
            } catch (\Exception $e) {
            }

            $blog->setData($data);
        }

        $blog->save($data);

        $types = array('config','layout','block_html','collections','reflection','db_ddl','compiled_config','eav','config_integration','config_integration_api','full_page','translate','config_webservice','vertex');
        foreach ($types as $type) {
            $this->_cacheTypeList->cleanType($type);
        }
        foreach ($this->_cacheFrontendPool as $cacheFrontend) {
            $cacheFrontend->getBackend()->clean();
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('testimonials/testimonial/index');
        return $resultRedirect;
    }
}