<?php
class Aleron75_Magehandles_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getSeason()
    {
        if ($this->_isWinter()) {
            return 'winter';
        }

        if ($this->_isSpring()) {
            return 'spring';
        }

        if ($this->_isSummer()) {
            return 'summer';
        }

        if ($this->_isAutumn()) {
            return 'autumn';
        }
    }

    private function _isWinter()
    {
        $currentYear = date("Y");
        return $this->_isDateInRange("{$currentYear}-12-01", "{$currentYear}-12-31")
        || $this->_isDateInRange("{$currentYear}-01-01", "{$currentYear}-02-29");
    }

    private function _isSpring()
    {
        $currentYear = date("Y");
        return $this->_isDateInRange("{$currentYear}-03-01", "{$currentYear}-05-31");
    }

    private function _isSummer()
    {
        $currentYear = date("Y");
        return $this->_isDateInRange("{$currentYear}-06-01", "{$currentYear}-08-31");
    }

    private function _isAutumn()
    {
        $currentYear = date("Y");
        return $this->_isDateInRange("{$currentYear}-09-01", "{$currentYear}-11-30");
    }

    private function _isDateInRange($startDate, $endDate, $dateToCheck = null)
    {
        if (is_null($dateToCheck)) {
            $dateToCheck = time();
        }

        if (is_string($dateToCheck)) {
            $dateToCheck = strtotime($dateToCheck);
        }

        $startTimestamp = strtotime($startDate);
        $endTimestamp = strtotime($endDate);

        return (($dateToCheck >= $startTimestamp) && ($dateToCheck <= $endTimestamp));
    }
}