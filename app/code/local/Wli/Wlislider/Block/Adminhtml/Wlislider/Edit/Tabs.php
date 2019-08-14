<?php
class Wli_Wlislider_Block_Adminhtml_Wlislider_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
	    parent::__construct();
	    $this->setId('wlislider_tabs');
	    $this->setDestElementId('edit_form');
	    $this->setTitle(Mage::helper('wlislider')->__('Item Information'));
	}

	protected function _beforeToHtml()
	{
	    $this->addTab('form_section', array(
		'label'     => Mage::helper('wlislider')->__('Item Information'),
		'title'     => Mage::helper('wlislider')->__('Item Information'),
		'content'   => $this->getLayout()->createBlock('wlislider/adminhtml_wlislider_edit_tab_form')->toHtml(),
	    ));
	   
	    return parent::_beforeToHtml();
	}
}
