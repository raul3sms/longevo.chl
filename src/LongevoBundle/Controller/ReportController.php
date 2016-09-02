<?php

namespace LongevoBundle\Controller;

use LongevoBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ReportController extends Controller
{
    /**
     * @Route("/report")
     * @Template()
     */
    public function reportAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $dql = "
            SELECT t.id as ticket_id, cus.name, cus.email, t.title, o.id as order_id 
            FROM LongevoBundle:Ticket as t
            LEFT JOIN LongevoBundle:Customer as cus
            WITH t.customer = cus.id
            LEFT JOIN LongevoBundle:Order as o
            WITH t.order = o.id
            WHERE 1=1";

        $email = $request->get('email', false);
        $orderId = $request->get('order_id', false);

        if ( $email ) {$dql .= " AND cus.email = :email ";}
        if ( $orderId ) {$dql .= " AND o.id = :orderId ";}

        $dql .= ' ORDER BY t.id ASC ';

        $query = $em->createQuery( $dql );

        if ( $email ) {
            $query->setParameter( 'email', $email );
        }
        if ( $orderId ) {
            $query->setParameter( 'orderId', $orderId );
        }

        $paginator  = $this->get( 'knp_paginator' );

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );

        return [
            'pagination' => $pagination
        ];
    }

}
