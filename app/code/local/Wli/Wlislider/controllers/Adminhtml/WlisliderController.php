<?php
class Wli_Wlislider_Adminhtml_WlisliderController extends Mage_Adminhtml_Controller_Action
{

protected function _initAction()
{
    $this->loadLayout()
        ->_setActiveMenu('wlislider/items')
        ->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
    return $this;
}   

public function indexAction() {
    $this->_initAction();       
    $this->_addContent($this->getLayout()->createBlock('wlislider/adminhtml_wlislider'));
    $this->renderLayout();
}

public function editAction()
{
    $wlisliderId     = $this->getRequest()->getParam('id');
    
    $wlisliderModel  = Mage::getModel('wlislider/wlislider')->load($wlisliderId);

    if ($wlisliderModel->getId() || $wlisliderId == 0) {

        Mage::register('wlislider_data', $wlisliderModel);

        $this->loadLayout();
        $this->_setActiveMenu('wlislider/items');
       
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
       
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
       
        $this->_addContent($this->getLayout()->createBlock('wlislider/adminhtml_wlislider_edit'))
             ->_addLeft($this->getLayout()->createBlock('wlislider/adminhtml_wlislider_edit_tabs'));
           
        $this->renderLayout();
    } else {
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('wlislider')->__('Item does not exist'));
        $this->_redirect('*/*/');
    }
}

public function newAction()
{
    $this->_forward('edit');
}

public function saveAction()
{
    if ( $this->getRequest()->getPost() ) {
        try {
            $postData = $this->getRequest()->getPost();
            $wlisliderModel = Mage::getModel('wlislider/wlislider');
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '')
            {
                try
                {
                    if($this->getRequest()->getParam('id'))
                    {
                        $wlisliderModel->load($this->getRequest()->getParam('id'));
                        if($wlisliderModel->getImage())
                        {
                            $this->removeRequiredImages($wlisliderModel->getImage());
                        }
                    }
                    /* Upload Image Code Start */
                    $fileName 		= time()."_".$_FILES['image']['name'];
                    $fileExt        = strtolower(substr(strrchr($fileName, "."), 1));
                    $fileNamewoe    = rtrim($fileName, $fileExt);
                    $fileName       = str_replace(' ', '', $fileNamewoe) . $fileExt;
                    
                    $uploader       = new Varien_File_Uploader('image');
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); //allowed extensions
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $path = Mage::getBaseDir('media') . DS . 'wlislider';
                    
                    if(!is_dir($path))
                    {
                            mkdir($path, 0777, true);
                    }
                    
                    $uploader->save($path . DS, $fileName ); 
                    /* End code for image upload */
                    

                    
                    
                }catch (Exception $e)
                {
                        Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                        $this->_redirect('*/*/');
                        return;
                }
            }else
            {
                if(isset($postData['image']['delete']) && $postData['image']['delete'] == 1)
                {
                    $fileName = '';
                    $wlisliderModel->load($this->getRequest()->getParam('id'));
                    if($wlisliderModel->getImage())
                    {
                        $this->removeRequiredImages($wlisliderModel->getImage());
                    }
                } else
                {
                    unset($fileName);
            	}
            }
                
           
            $wlisliderModel->setId($this->getRequest()->getParam('id'))
                ->setTitle($postData['title'])
                 ->setImage($fileName)
				 ->setImageurl($postData['imageurl'])
                ->setStatus($postData['status'])
                ->save();
           
            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully saved'));
            Mage::getSingleton('adminhtml/session')->setWlisliderData(false);

            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setWlisliderData($this->getRequest()->getPost());
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }
    }
    $this->_redirect('*/*/');
}

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $wlisliderModel = Mage::getModel('wlislider/wlislider');
               
                $wlisliderModel->setId($this->getRequest()->getParam('id'))
                    ->delete();
                   
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }
    /**
     * Product grid for AJAX request.
     * Sort and filter result for example.
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
               $this->getLayout()->createBlock('wlislider/adminhtml_wlislider_grid')->toHtml()
        );
    }
    
    /**
     * Remove Required Images for edit/delete data.
     */
    public function removeRequiredImages($fileName)
    {
    	if(!($fileName)) return;
    	
    	$orignalImg = Mage::getBaseDir('media') . DS . 'wlislider'.DS. $fileName;
    	
    	if(file_exists($orignalImg)) {
    		unlink($orignalImg);
    	}
    }
}
