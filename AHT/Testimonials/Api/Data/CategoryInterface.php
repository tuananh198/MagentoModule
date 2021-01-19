<?php

namespace AHT\Testimonials\Api\Data;


interface CategoryInterface
{
    /**
     * get category name
     * @return string
     */
    public function getCategoryName();


    /**
     * set category name
     * @param $name
     * @return string
     */
    public function setCategoryName($name);


    /**
     * get category id
     *
     * @return integer
     */
    public function getCategoryId();

    /**
     * set Category Id
     *
     * @param $categoryId
     * @return integer
     */
    public function setCategoryId($categoryId);    
}