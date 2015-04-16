<?php
class Aleron75_Magehandles_Model_Observer
{
    public function addCustomHandles(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Model_Layout_Update $updateManager */
        $updateManager = $observer->getLayout()->getUpdate();
        $this->_addCustomerGroupHandle($updateManager);
        $this->_addCustomerGenderHandle($updateManager);
        $this->_addCustomerBirthdayHandle($updateManager);
        $this->_addCustomerIsSubscribedHandle($updateManager);
        $this->_addSeasonHandle($updateManager);
    }

    private function _addCustomerGroupHandle(Mage_Core_Model_Layout_Update $updateManager)
    {
        $customerHelper = Mage::helper('customer');
        $currentCustomer = $customerHelper->getCurrentCustomer();
        if ($groupId = $currentCustomer->getGroupId()) {
            $customerGroup = Mage::getModel('customer/group')->load($groupId );
            $groupCode = strtolower(preg_replace("/[^-a-zA-Z0-9]+/", "", $customerGroup->getCode()));
            $updateManager->addHandle("customer_group_{$groupCode}");
        }
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

    private function _addCustomerIsSubscribedHandle(Mage_Core_Model_Layout_Update $updateManager)
    {
        $customerHelper = Mage::helper('customer');
        if ($customerHelper->isLoggedIn()) {
            /** @var Mage_Customer_Model_Customer $currentCustomer */
            $currentCustomer = $customerHelper->getCurrentCustomer();
            $subscriber = Mage::getModel('newsletter/subscriber')->loadByCustomer($currentCustomer);
            if ($subscriber->isSubscribed()) {
                $updateManager->addHandle("customer_subscribed");
                return;
            }
            $updateManager->addHandle("customer_not_subscribed");
        }
    }

    private function _addSeasonHandle(Mage_Core_Model_Layout_Update $updateManager)
    {
        $helper = Mage::helper('aleron75_magehandles');
        $season = $helper->getSeason();
        $updateManager->addHandle("season_{$season}");
    }
}