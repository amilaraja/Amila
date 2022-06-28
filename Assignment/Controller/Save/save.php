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

        if ($this->formKeyValidator->validate($request)) {

            $this->messageManager->addErrorMessage(__("Invalid Form Key, Please refresh and try again"));

            $this->getResponse()->setRedirect(
                $this->_redirect->getRefererUrl()
            );
            return;

        }else{
            echo "Form Key Passed";

        }


        die("XSE");

    }




}
