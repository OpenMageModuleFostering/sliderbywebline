<?php
class Wli_Wlislider_Block_Adminhtml_Wlislider extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = 'adminhtml_wlislider';
        $this->_blockGroup = 'wlislider';
        $this->_headerText = Mage::helper('wlislider')->__('Item Manager');
        $this->_addButtonLabel = Mage::helper('wlislider')->__('Add Item');
        parent::__construct();
    }
}
