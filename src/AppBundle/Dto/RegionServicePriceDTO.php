<?php

/**
 * Enter description here ...
 * @author sibusiso87rn
 *
 */
class RegionServicePriceDTO {

	/**
     * @var string
     */
	private $region;

	/**
     * @var string
     */
	private $serviceName;

	/**
     * @var string
     */
	private $serviceAmount;

	/**
     * @var string
     */
	private $discountPercentage;

	/**
     * @var string
     */
	private $regionServiceId;
	
	/**
     * @var string
     */
	private $regionServicePriceId;

	/**
	 * Set region
	 *
	 * @param string region
	 *
	 * @return RegionServicePriceDTO
	 */
	public function setRegion($region)
	{
		$this->region = $region;

		return $this;
	}

	/**
	 * Get region
	 *
	 * @return string
	 */
	public function getRegion()
	{
		return $this->region;
	}

	/**
	 * Set serviceName
	 *
	 * @param string serviceName
	 *
	 * @return RegionServicePriceDTO
	 */
	public function setServiceName($serviceName)
	{
		$this->serviceName = $serviceName;

		return $this;
	}

	/**
	 * Get serviceName
	 *
	 * @return string
	 */
	public function getServiceName()
	{
		return $this->serviceName;
	}

	/**
	 * Set serviceAmount
	 *
	 * @param string serviceAmount
	 *
	 * @return RegionServicePriceDTO
	 */
	public function setServiceAmount($serviceAmount)
	{
		$this->serviceAmount = $serviceAmount;

		return $this;
	}
	/**
	 * Get serviceAmount
	 *
	 * @return string
	 */
	public function getServiceAmount()
	{
		return $this->serviceAmount;
	}

		
	/**
	 * Set discountPercentage
	 *
	 * @param string discountPercentage
	 *
	 * @return RegionServicePriceDTO
	 */
	public function setDiscountPercentage($discountPercentage)
	{
		$this->discountPercentage = $discountPercentage;

		return $this;
	}
		
	/**
	 * Get discountPercentage
	 *
	 * @return string
	 */
	
	public function getDiscountPercentage()
	{
		return $this->discountPercentage;
	}
	
	/**
	 * Set serviceAmount
	 *
	 * @param string regionServiceId
	 *
	 * @return regionServiceId
	 */
	public function setRegionServiceId($regionServiceId)
	{
		$this->regionServiceId = $regionServiceId;

		return $this;
	}
	/**
	 * Get regionServiceId
	 *
	 * @return string
	 */
	public function getRegionServiceId()
	{
		return $this->regionServiceId;
	}
	
	/**
	 * Set regionServicePriceId
	 *
	 * @param string regionServicePriceId
	 *
	 * @return regionServicePriceId
	 */
	public function setRegionServicePriceId($regionServicePriceId)
	{
		$this->regionServicePriceId = $regionServicePriceId;

		return $this;
	}
	/**
	 * Get regionServicePriceId
	 *
	 * @return string
	 */
	public function getRegionServicePriceId()
	{
		return $this->regionServicePriceId;
	}

	public function getAmountToPay(){
		$amountToPay = $this->getServiceAmount() - $this->getDiscountPercentage()*$this->getServiceAmount();
		return $amountToPay;
	}
	
	function equals($region,$serviceName){
		return ($this->getRegion()==$region)&&($this->getServiceName()==$serviceName);
	}

	function getPriceString(){
		return "SERVICE;".$this->getServiceName().";".$this->getAmountToPay();
	}
	
	function toString(){
		return "ServiceName  \t ".$this->getServiceName()."; \t AmountToPay \t ".$this->getAmountToPay()." \t Region \t ".$this->getRegion()."; \t DiscountPercentage \t ".$this->getDiscountPercentage()." \t RegionServicePriceId \t ".$this->getRegionServicePriceId()."; \t RegionServiceId \t ".$this->getRegionServiceId();
	}
}