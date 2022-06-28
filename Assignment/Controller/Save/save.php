<?php
namespace Amila\Assignment\Controller\Save;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    /**
     * Core form key validator
     *
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;
    /**
     * Message Manager to display notices
     *
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    protected $scopeConfig;

    protected $configWriter;

    protected $cacheManager;


    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter,
        \Magento\Framework\App\Cache\Manager $cacheManager

    )
    {
        $this->_pageFactory         = $pageFactory;
        $this->formKeyValidator     = $formKeyValidator;
        $this->messageManager       = $messageManager;
        $this->scopeConfig          = $scopeConfig;
        $this->configWriter         = $configWriter;
        $this->cacheManager         = $cacheManager;

        return parent::__construct($context);
    }

    public function execute()
    {
        $request = $this->getRequest();

        //validating the request for a valid form key to prevent cross-site request forgery
        if (!$this->formKeyValidator->validate($request)) {

            $this->messageManager->addErrorMessage(__("Invalid Form Key, Please refresh and try again"));
            //Redirect to previous URL
            $this->getResponse()->setRedirect(
                $this->_redirect->getRefererUrl()
            );
            return;
        }


        //Retrieving post variables and setting defaults
        $livechat_license_number    =   $this->getRequest()->getPost('livechat_license_number','');
        $livechat_groups            =   $this->getRequest()->getPost('livechat_groups','0');
        $livechat_params            =   $this->getRequest()->getPost('livechat_params','');

        //validating required field
        if(trim($livechat_license_number) == '' ){
            $this->messageManager->addErrorMessage(__("License Number is a required field, Please enter license number and try again"));
            //Redirect to previous URL
            $this->getResponse()->setRedirect(
                $this->_redirect->getRefererUrl()
            );
            return;
        }

        //Since defaults are already set, overwriting is enough
        $this->configWriter->save("livechat/general/license", $livechat_license_number,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);
        $this->configWriter->save("livechat/advanced/group", $livechat_groups,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);
        $this->configWriter->save("livechat/advanced/params", $livechat_params,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);

        //Clean Cache - only config cache
        $this->cacheManager->clean(['config']);
        //Flush Cache - only config cache
        $this->cacheManager->flush(['config']);

        $this->messageManager->addSuccessMessage(__("License data saved successfully."));
        //Redirect to previous URL
        $this->getResponse()->setRedirect(
            $this->_redirect->getRefererUrl()
        );
        return;


    }




}
