<?php
namespace Amila\Assignment\Controller\Save;

class Save extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;

    /**
     * Core form key validator
     *
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;

    protected $messageManager;



    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\Message\ManagerInterface $messageManager,)
    {
        $this->_pageFactory = $pageFactory;
        $this->formKeyValidator = $formKeyValidator;
        $this->messageManager = $messageManager;

        return parent::__construct($context);
    }

    public function execute()
    {
        $request = $this->getRequest();

        if (!$this->formKeyValidator->validate($request)) {

            $this->messageManager->addErrorMessage(__("Invalid Form Key, Please refresh and try again"));
            $this->getResponse()->setRedirect(
                $this->_redirect->getRefererUrl()
            );
            return;
        }

        $livechat_license_number    =   $this->getRequest()->getPost('livechat_license_number','');
        $livechat_groups            =   $this->getRequest()->getPost('livechat_groups','0');
        $livechat_params            =   $this->getRequest()->getPost('livechat_params','');

        echo "<br>livechat_license_number : " . $livechat_license_number;
        echo "<br>livechat_groups : " . $livechat_groups;
        echo "<br>livechat_params : " . $livechat_params;

        die("XSE");

    }




}
