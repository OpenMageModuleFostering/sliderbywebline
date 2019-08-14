<?php
class Wli_Wlislider_Block_Adminhtml_Wlislider_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
protected function _prepareForm()
{

	$UrlData=$this->getRequest()->getParams();
	$CheckEdit=$UrlData['id'];
    $form = new Varien_Data_Form();
    $this->setForm($form);
    $fieldset = $form->addFieldset('wlislider_form', array('legend'=>Mage::helper('wlislider')->__('Item information')));
    $URLID=$this->getRequest()->getParam('id');
    $_edited_banner = Mage::getModel('wlislider/wlislider')->load($URLID);
    $_edited_banner = ($_edited_banner->getdata());
    
    $fieldset->addField('title', 'text', array(
        'label'     => Mage::helper('wlislider')->__('Title'),
        'class'     => 'required-entry validate-alpha',
        'required'  => true,
        'name'      => 'title',
    ));
    
    if(isset($CheckEdit))
	{
	    $fieldset->addField('image', 'image', array(
        'label'     => Mage::helper('wlislider')->__('Banner'),
        'class'     => 'required-entry required-file',
        'src' => Mage::getBaseUrl('media') . 'wlislider'.DS.$_edited_banner['image'],
        'required'  => true,
        'name'      => 'image',
        'after_element_html' => '<div style="padding-top:5px;padding-bottom:5px" id="imagetag"><img src="'.Mage::getBaseUrl('media') . 'wlislider'.DS.$_edited_banner['image'].'" width=250px height=250/></div> ',
    ));
	}
	else
	{
 		$fieldset->addField('image', 'image', array(
        'label'     => Mage::helper('wlislider')->__('Banner'),
        'class'     => 'required-entry required-file',
        'src' => Mage::getBaseUrl('media') . 'wlislider'.DS.$_edited_banner['image'],
        'required'  => true,
        'name'      => 'image',
		'after_element_html' => '<small><br>File Type: <i>*.jpg,*.png,*.gif,*.jpeg</i></small>',
    	));
	}

    $fieldset->addField('imageurl', 'text', array(
        'label'     => Mage::helper('wlislider')->__('Image Url:'),
        'class'     => 'required-entry',
        'required'  => true,
        'name'      => 'imageurl',
    ));
    
    $fieldset->addField('status', 'select', array(
        'label'     => Mage::helper('wlislider')->__('Status'),
        'name'      => 'status',
        'values'    => array(

            array(
                'value'     => 1,
                'label'     => Mage::helper('wlislider')->__('Active'),
            ),

            array(
                'value'     => 0,
                'label'     => Mage::helper('wlislider')->__('Inactive'),
            ),
        ),
    ));
   
   
    if ( Mage::getSingleton('adminhtml/session')->getWlisliderData() )
    {
        $form->setValues(Mage::getSingleton('adminhtml/session')->getWlisliderData());
        Mage::getSingleton('adminhtml/session')->setWlisliderData(null);
    } elseif ( Mage::registry('wlislider_data') ) {
        $form->setValues(Mage::registry('wlislider_data')->getData());
    }
    return parent::_prepareForm();
}
}
