<?php
class Wli_Wlislider_Block_Adminhtml_Wlislider_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
	    parent::__construct();
		   
	    $this->_objectId = 'id';
	    $this->_blockGroup = 'wlislider';
	    $this->_controller = 'adminhtml_wlislider';

	    $this->_updateButton('save', 'label', Mage::helper('wlislider')->__('Save Banner'));
	    $this->_updateButton('delete', 'label', Mage::helper('wlislider')->__('Delete Banner'));
	}

	public function getHeaderText()
	{
	    if( Mage::registry('wlislider_data') && Mage::registry('wlislider_data')->getId() ) {
		return Mage::helper('wlislider')->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry('wlislider_data')->getTitle()));
	    } else {
		return Mage::helper('wlislider')->__('Banner Item');
	    }
	}
}
