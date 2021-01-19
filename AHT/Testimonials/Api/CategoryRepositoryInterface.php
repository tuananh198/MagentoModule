<?php

namespace AHT\Testimonials\Api;

interface CategoryRepositoryInterface
{
    /**
     * Save category
     *
     * @param AHT\Testimonials\Api\Data\CategoryInterface $category
     * @return \AHT\Testimonials\Api\Data\CategoryInterface
     */
    public function save(\AHT\Testimonials\Api\Data\CategoryInterface $category);

    /**
     * get all category
     *
     * @return \AHT\Testimonials\Api\Data\CategoryInterface
     */
    public function getList();

    /**
     * Retrieve category
     *
     * @param int $id
     * @return AHT\Testimonials\Api\Data\CategoryInterface
     */
    public function getById($id);

    /**
     * @param \AHT\Testimonials\Api\Data\CategoryInterface $category
     * @return bool true on success
     */
    public function delete(\AHT\Testimonials\Api\Data\CategoryInterface $category);


    /**
     * @param int $id
     * @return bool true on success
     */
    public function deleteById($id);

}