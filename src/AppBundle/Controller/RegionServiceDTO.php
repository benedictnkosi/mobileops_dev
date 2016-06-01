<?php

/**
 * Created by PhpStorm.
 * User: sibusiso87rn
 * Date: 2016/05/12
 * Time: 10:37 PM
 */
class RegionServiceDTO
{

    private $regionString;
    private $serviceString;
    private $createdBy;

    public function getRegionString(){
        return $this->regionString;
    }

    public function setRegionString($regionString){
        $this->regionString = $regionString;
    }

    public function getServiceString(){
        return $this->serviceString;
    }

    public function setServiceString($serviceString){
        $this->serviceString = $serviceString;
    }

    public function getCreatedBy(){
        return $this->createdBy;
    }

    public function setCreatedBy($createdBy){
        $this->createdBy = $createdBy;
    }

}