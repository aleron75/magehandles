<?php
class Aleron75_Magehandles_Model_Observer
{
    public function addCustomHandles(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Model_Layout_Update $updateManager */
        $updateManager = $observer->getLayout()->getUpdate();
        $this->_addCustomerGenderHandle($updateManager);
        $this->_addCustomerBirthdayHandle($updateManager);
        $this->_addSeasonHandle($updateManager);
    }


    private function _addCustomerGenderHandle(Mage_Core_Model_Layout_Update $updateManager)
    {
        $customerHelper = Mage::helper('customer');
        if ($customerHelper->isLoggedIn()) {
            /** @var Mage_Customer_Model_Customer $currentCustomer */
            $currentCustomer = $customerHelper->getCurrentCustomer();
            if ($genderOptionId = $currentCustomer->getGender()) {
                $gender = strtolower($currentCustomer->getResource()
                    ->getAttribute('gender')
                    ->getSource()
                    ->getOptionText($genderOptionId));
                $updateManager->addHandle("customer_gender_{$gender}");
            }
        }
    }

    private function _addCustomerBirthdayHandle(Mage_Core_Model_Layout_Update $updateManager)
    {
        $customerHelper = Mage::helper('customer');
        if ($customerHelper->isLoggedIn()) {
            /** @var Mage_Customer_Model_Customer $currentCustomer */
            $currentCustomer = $customerHelper->getCurrentCustomer();
            if ($birthDate = $currentCustomer->getDob()) {
                $helper = Mage::helper('aleron75_magehandles');
                if ($helper->isBirthday($birthDate)) {
                    $updateManager->addHandle("customer_birthday");
                }
            }
        }
    }

    private function _addSeasonHandle(Mage_Core_Model_Layout_Update $updateManager)
    {
        $helper = Mage::helper('aleron75_magehandles');
        $season = $helper->getSeason();
        $updateManager->addHandle("season_{$season}");
    }
}