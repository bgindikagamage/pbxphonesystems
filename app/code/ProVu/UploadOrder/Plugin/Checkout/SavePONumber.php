<?php

namespace ProVu\UploadOrder\Plugin\Checkout;

class SavePONumber
{
    protected $quoteRepository;
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }
    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();
		
		$shippingAddressExtensionAttributes = $shippingAddress->getExtensionAttributes();
		if ($shippingAddressExtensionAttributes) {
			$poNumber = $shippingAddressExtensionAttributes->getPoNumber();
			$shippingAddress->setPoNumber($poNumber);
		}
    }
}