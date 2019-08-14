<?php 
class Wli_Wlislider_Block_Adminhtml_Wlislider_Renderer_Imagedisplay extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    } 
    protected function _getValue(Varien_Object $row)
    {
        $imageData = $row->getData();

        $url = Mage::getBaseUrl('media') . 'wlislider'.DS. $imageData['image'];
	$out = "<img src=". $url ." width='150px' height='150px'/></a>";
	return $out;
    }
}
