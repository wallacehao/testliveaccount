<?php

namespace Forix\LiveAccount\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Backend\Model\Auth\Session;

class Data extends AbstractHelper
{
    const CONFIG_PATH_ACTIVE  = "forix_account_live/general/enabled";
    const CONFIG_PATH_ACCOUNT = "forix_account_live/general/list_account";
    const CONFIG_LIST_MESSAGE = "forix_account_live/general/msg_text";

    protected $adminSession;

    public function __construct(
        Context $context,
        Session $session
    )
    {
        parent::__construct($context);
        $this->adminSession = $session;
    }

    public function getMessage() {
        $listAccount = $this->scopeConfig->getValue(self::CONFIG_PATH_ACCOUNT);
        $adminuser   = $this->adminSession->getUser();
        $username = $adminuser->getUserName();
        $listAccount = explode(",",$listAccount);
        if (in_array($username, $listAccount)) {
            $message = $this->scopeConfig->getValue(self::CONFIG_LIST_MESSAGE);
            return $message;
        }
        return null;
    }
}


