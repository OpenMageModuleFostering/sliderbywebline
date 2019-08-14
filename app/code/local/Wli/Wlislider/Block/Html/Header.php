<?php
class Wli_Wlislider_Block_Html_Header extends Mage_Page_Block_Html_Header
{     
     public function _construct()
     {
          $collection = Mage::getModel('wlislider/wlislider')->getCollection()
          ->addFieldToFilter('status',1);
          $this->setCollection($collection);
          $this->setTemplate('wlislider/page/html/header.phtml');
     }
}