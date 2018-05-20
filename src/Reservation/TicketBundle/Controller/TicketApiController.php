<?php
/**
 * Created by PhpStorm.
 * User: hir0w
 * Date: 5/3/2018
 * Time: 4:20 AM
 */

namespace Reservation\TicketBundle\Controller;


use Match\MatchBundle\Entity\Match;
use Reservation\TicketBundle\Entity\Ticket;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class TicketApiController extends Controller
{
    /**
     * @Route("/api/tickets/{id}/match", name="api_ticket")
     * @param Ticket $team
     * @return JsonResponse
     */
    public function ticketApiAction(Match $match)
    {
        $data[] = $this->serialize($match->getTicket());
        return new JsonResponse($data);
    }

    public function serialize(Ticket $ticket)
    {
        return array(
            "id" => $ticket->getId(),
            "quantity" => $ticket->getQuantity(),
            "price" => $ticket->getPrice(),
        );
    }
}