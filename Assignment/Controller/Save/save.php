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

    private $scopeConfig;

    private $configWriter;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\Config\Storage\WriterInterface $configWriter
    )
    {
        $this->_pageFactory     = $pageFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->messageManager   = $messageManager;
        $this->scopeConfig      = $scopeConfig;
        $this->configWriter     = $configWriter;

        return parent::__construct($context);
    }

    public function execute()
    {
        $request = $this->getRequest();

        //validating the request for a valid form key to prevent cross-site request forgery
        if (!$this->formKeyValidator->validate($request)) {

            $this->messageManager->addErrorMessage(__("Invalid Form Key, Please refresh and try again"));
            $this->getResponse()->setRedirect(
                $this->_redirect->getRefererUrl()
            );
            return;
        }

        //Retrieving post variables and setting defaults
        $livechat_license_number    =   $this->getRequest()->getPost('livechat_license_number','');
        $livechat_groups            =   $this->getRequest()->getPost('livechat_groups','0');
        $livechat_params            =   $this->getRequest()->getPost('livechat_params','');

        //Since defaults are already set, overwriting is enough
        $this->configWriter->save("livechat/general/license", $livechat_license_number,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);
        $this->configWriter->save("livechat/advanced/group", $livechat_groups,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);
        $this->configWriter->save("livechat/advanced/params", $livechat_params,ScopeConfigInterface::SCOPE_TYPE_DEFAULT,0);

        $this->messageManager->addSuccessMessage(__("License data saved successfully."));
        $this->getResponse()->setRedirect(
            $this->_redirect->getRefererUrl()
        );
        return;


    }




}
