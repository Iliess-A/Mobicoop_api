<?php

namespace App\Incentive\Controller\Subscription;

use App\Incentive\Service\Manager\JourneyManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class SubscriptionUpdate
{
    /**
     * @var EntityManagerInterface
     */
    protected $_em;

    /**
     * @var Request
     */
    protected $_request;

    /**
     * @var JourneyManager
     */
    protected $_journeyManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em, JourneyManager $journeyManager)
    {
        $this->_request = $requestStack->getCurrentRequest();
        $this->_em = $em;

        $this->_journeyManager = $journeyManager;
    }
}