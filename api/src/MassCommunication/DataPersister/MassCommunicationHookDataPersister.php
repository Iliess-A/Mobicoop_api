<?php
/**
 * Copyright (c) 2023, MOBICOOP. All rights reserved.
 * This project is dual licensed under AGPL and proprietary licence.
 ***************************
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU Affero General Public License as
 *    published by the Free Software Foundation, either version 3 of the
 *    License, or (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with this program.  If not, see <gnu.org/licenses>.
 ***************************
 *    Licence MOBICOOP described in the file
 *    LICENSE
 */

namespace App\MassCommunication\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\MassCommunication\Admin\Service\CampaignManager;
use App\MassCommunication\Ressource\MassCommunicationHook;
use Symfony\Component\HttpFoundation\RequestStack;

final class MassCommunicationHookDataPersister implements ContextAwareDataPersisterInterface
{
    private $request;
    private $campaignManager;

    public function __construct(RequestStack $requestStack, CampaignManager $campaignManager)
    {
        $this->request = $requestStack->getCurrentRequest();
        $this->campaignManager = $campaignManager;
    }

    public function supports($data, array $context = []): bool
    {
        return ($data instanceof MassCommunicationHook) && isset($context['collection_operation_name']) && 'unsubscribeHook' == $context['collection_operation_name'];
    }

    public function persist($data, array $context = [])
    {
        return $this->campaignManager->handleUnsubscribeHook($data, $this->request);
    }

    public function remove($data, array $context = [])
    {
    }
}