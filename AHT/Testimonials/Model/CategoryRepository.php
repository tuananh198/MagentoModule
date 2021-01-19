<?php


namespace AHT\Testimonials\Model;

use AHT\Testimonials\Api\CategoryRepositoryInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var ResourceModel\Category
     */
    protected $_resource;

    /**
     * @var Category
     */
    protected $_categoryFactory;

    /**
     * @var ResourceModel\Category\CollectionFactory
     */
    protected $_categoryCollectionFactory;

    /**
     * CategoryRepository constructor.
     * @param Category $categoryFactory
     * @param ResourceModel\category $resource
     * @param ResourceModel\Category\CollectionFactory $categoryCollectionFactory
     */
    public function __construct(
        \AHT\Testimonials\Model\CategoryFactory $categoryFactory,
        \AHT\Testimonials\Model\ResourceModel\Category $resource,
        \AHT\Testimonials\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory
    )
    {
        $this->_resource = $resource;
        $this->_categoryFactory = $categoryFactory;
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
    }


    /**
     * @param AHT\Testimonials\Api\Data\CategoryInterface|\AHT\Testimonials\Api\Data\CategoryInterface $category
     * @return \AHT\Testimonials\Api\Data\CategoryInterface|void
     */
    public function save($category)
    {
        try {
            $this->_resource->save($category);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the Post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $category;
    }

    /**
     * @return mixed|void
     */
    public function getList()
    {
        $collection = $this->_categoryCollectionFactory->create();
        return $collection->getData();
    }

    /**
     * @param int $id
     * @return AHT\Testimonials\Api\Data\CategoryInterface|void
     */
    public function getById($id)
    {
        $category = $this->_categoryFactory->create();
        $category->load($id);
        if (!$category->getId()) {
            throw new NoSuchEntityException(__('The CMS Post with the "%1" ID doesn\'t exist.', $id));
        }
        return $category->getData();
    }

    /**
     * @param \AHT\Testimonials\Api\Data\CategoryInterface $category
     * @return bool|void
     */
    public function delete($category)
    {
        $categoryModel = $this->_categoryFactory->create();
        $categoryModel->setData($category);
        try {
            $this->_resource->delete($categoryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Post: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param int $id
     * @return bool|void
     */
    public function deleteById($id)
    {
        return $this->delete($this->getById($id));
    }
}