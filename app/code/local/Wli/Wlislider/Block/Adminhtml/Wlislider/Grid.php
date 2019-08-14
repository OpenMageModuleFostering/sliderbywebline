<?php
class Wli_Wlislider_Block_Adminhtml_Wlislider_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
public function __construct()
{
    parent::__construct();
    $this->setId('wlisliderGrid');
    // This is the primary key of the database
    $this->setDefaultSort('wlislider_id');
    $this->setDefaultDir('ASC');
    $this->setSaveParametersInSession(true);
    $this->setUseAjax(true);
}

protected function _prepareCollection()
{
    $collection = Mage::getModel('wlislider/wlislider')->getCollection();
    $this->setCollection($collection);
    return parent::_prepareCollection();
}

protected function _prepareColumns()
{
    $this->addColumn('wlislider_id', array(
        'header'    => Mage::helper('wlislider')->__('ID'),
        'align'     =>'right',
        'width'     => '10px',
        'index'     => 'wlislider_id',
    ));

    $this->addColumn('title', array(
        'header'    => Mage::helper('wlislider')->__('Title'),
        'align'     =>'left',
       'width'     => '50px',
        'index'     => 'title',
    ));

    
    $this->addColumn('image', array(
				'header'    => Mage::helper('wlislider')->__('Image'),
				'filter' => false,
				'sortable' => false,
				'align'     =>'center',
				'width'	    =>'150px',
				'index'     => 'image',
				'renderer'  =>'Wli_Wlislider_Block_Adminhtml_Wlislider_Renderer_Imagedisplay',
    ));

    $this->addColumn('imageurl', array(
        'header'    => Mage::helper('wlislider')->__('Image Url'),
        'align'     =>'left',
       'width'     => '100px',
        'index'     => 'imageurl',
    ));

    $this->addColumn('status', array(

        'header'    => Mage::helper('wlislider')->__('Status'),
        'align'     => 'left',
        'width'     => '80px',
        'index'     => 'status',
        'type'      => 'options',
        'options'   => array(
            1 => 'Active',
            0 => 'Inactive',
        ),
    ));

    return parent::_prepareColumns();
}

public function getRowUrl($row)
{
    return $this->getUrl('*/*/edit', array('id' => $row->getId()));
}

public function getGridUrl()
{
  return $this->getUrl('*/*/grid', array('_current'=>true));
}


}
