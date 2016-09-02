<?php

namespace LongevoBundle\Controller;

use LongevoBundle\Entity\Customer;
use LongevoBundle\Entity\Order;
use LongevoBundle\Entity\Ticket;
use LongevoBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class TicketController
 * @package LongevoBundle\Controller
 * @Route("ticket", name="ticket")
 */
class TicketController extends Controller
{
    /**
     * @Route("/open", name="ticket_open")
     * @Method("GET")
     * @Template()
     */
    public function openAction()
    {
        return [];
    }

    /**
     * @Route("/save", name="ticket_open_save")
     * @Method("POST")
     */
    public function postOpenAction(Request $request)
    {
        $name           = $request->get('name');
        $order_id       = $request->get('order_id');
        $email          = $request->get('email');
        $title          = $request->get('title');
        $observation    = $request->get('observation');

        $em = $this->getDoctrine()->getManager();

        $order = $em->getRepository(Order::class)->find($order_id);

        if ( ! ($order instanceof Order) ) {
            $this->get('session')->getFlashBag()->set('error', 'Número do pedido inválido.');
            return $this->redirectToRoute('ticket_open');
        }

        $customer = $em->getRepository(Customer::class)->findBy(['email' => $email]);

        if ( ! count( $customer ) ) {
            $customer = (new Customer())
                ->setName($name)
                ->setEmail($email)
            ;
        } else {
            $customer = $customer[0];
        }

        try {
            $em->persist($customer);

            $ticket = (new Ticket())
                ->setCustomer($customer)
                ->setOrder($order)
                ->setTitle($title)
                ->setObservation($observation)
            ;
            $em->persist($ticket);
        } catch (\Exception $e) {
            $this->get('session')->getFlashBag()->set('error', $e->getMessage());
            return $this->redirectToRoute('ticket_open');
        }
        $em->flush();

        return $this->redirectToRoute('ticket_saved', ['ticketId' => $ticket->getId()]);
    }

    /**
     * @Route("/success/{ticketId}", name="ticket_saved")
     * @Template()
     */
    public function successAction(Request $request, $ticketId)
    {
        $ticket = $this->getDoctrine()->getManager()->getRepository(Ticket::class)->find($ticketId);

        if ( ! ( $ticket instanceof Ticket) ) {
            $this->get('session')->getFlashBag()->set('error', 'Ocorreu um erro ao criar a solicitação. Tente novamente por favor');
            return $this->redirectToRoute('ticket_open');
        }

        return [
            'title' => 'Solicitação realizada',
            'ticket' => $ticket
        ];
    }

    /**
     * @Route("/go-to-ticket", name="go-to-ticket")
     * @Template()
     * @return array
     */
    public function goToTicketAction(Request $request)
    {
        $params = [
            'showTicket' => false
        ];
        if ( $request->get('ticket_id', false) ) {
            $ticketId = (int) $request->get('ticket_id');
            $em = $this->getDoctrine()->getManager();
            $ticket = $em->getRepository(Ticket::class)->find($ticketId);

            if ( ! ( $ticket instanceof Ticket) ) {
                $ticket = false;
            }

            $params = [
                'ticket' => $ticket,
                'showTicket' => true,
            ];
        }
        return $params;
    }

}
