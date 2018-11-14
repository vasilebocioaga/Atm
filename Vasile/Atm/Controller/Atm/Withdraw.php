<?php
namespace Vasile\Atm\Controller\Atm;

use Magento\Setup\Exception;
use Vasile\Atm\Exception\NoteUnavailableException;

class Withdraw extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var \Vasile\Atm\Helper\Data
     */
    protected $localHelper;

    /**
     * Withdraw constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Vasile\Atm\Helper\Data $localHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Vasile\Atm\Helper\Data $localHelper
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->localHelper = $localHelper;
        return parent::__construct($context);

    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws NoteUnavailableException
     */
    public function execute()
    {

        if($this->getRequest()->isAjax()) {
            $ammount = $this->getRequest()->getParam('ammount');
            if ($ammount < 0) {
                throw new \InvalidArgumentException(" Negative value");
            }

            $resultArray = array();

            $bills = $this->localHelper->getBills();
            // sort bills
            arsort($bills);

            foreach ($bills as $bill) {
                if ($bill <= $ammount) {
                    $nrOfBills = floor($ammount / $bill);
                    $resultArray[] = array($bill => floor($ammount / $bill));
                    $ammount = $ammount - ($nrOfBills * $bill);
                }
            }

            if ($ammount != 0) {
                throw new NoteUnavailableException('Only Multiple of 10');
            }

            $result = $this->resultJsonFactory->create();
            return $result->setData($resultArray);
        }
    }
}