<?php
class Aleron75_Magehandles_Model_Observer
{
    public function addCustomHandles(Varien_Event_Observer $observer)
    {
        /** @var Mage_Core_Model_Layout_Update $updateManager */
        $updateManager = $observer->getLayout()->getUpdate();
        $this->_addSeasonHandles($updateManager);
    }


    private function _addSeasonHandles(Mage_Core_Model_Layout_Update $updateManager)
    {
        $helper = Mage::helper('aleron75_magehandles');
        $season = $helper->getSeason();
        $updateManager->addHandle("season_{$season}");
    }
}