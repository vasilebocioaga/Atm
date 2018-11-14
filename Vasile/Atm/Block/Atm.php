<?php
namespace Vasile\Atm\Block;

class Atm extends \Magento\Framework\View\Element\Template
{

    const URL_TO_CALL = 'atm/atm/withdraw';

    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $_jsonEncoder;

    /**
     * Atm constructor.
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->_jsonEncoder = $jsonEncoder;
        parent::__construct($context, $data);
    }

    /**
     * Get form action URL for POST withdraw request
     *
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl(self::URL_TO_CALL);
    }

}