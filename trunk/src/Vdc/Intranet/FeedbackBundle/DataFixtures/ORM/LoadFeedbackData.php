<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Vdc\Intranet\FeedbackBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Vdc\Intranet\FeedbackBundle\Entity\Feedback;


class LoadUserData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $feedBack = new Feedback();
        $feedBack->setTypeId('2');
        $feedBack->setStatus('obdelava');
        $feedBack->setQuestion('Računalnik se nole zagnati');
        $feedBack->setAnswerproced('naredil sem marsika, če te pa zanima kaj pa malo prebrskaj po google');
        $feedBack->setAnswer('Hvala lepa, zdaj je popravljeno');
        $feedBack->setModifiedBy('3');
        $feedBack->setModifiedAt(new \DateTime('now'));
        $feedBack->setCreatedAt(new \DateTime('yesterday noon'));
      
        $feedBack2 = new Feedback();
        $feedBack2->setTypeId('1');
        $feedBack2->setStatus('cakanje');
        $feedBack2->setQuestion('Računalnik me čudno gleda');
        $feedBack2->setAnswerproced('polal sem ga v maloro');
        $feedBack2->setAnswer('Hvala vam lepa za zaupanje, vendar ni čisto nič narobe');
        $feedBack2->setModifiedBy('5');
        $feedBack2->setModifiedAt(new \DateTime('tomorrow noon'));
        $feedBack2->setCreatedAt(new \DateTime('now'));

        $manager->persist($feedBack);
        $manager->persist($feedBack2);
        $manager->flush();
    }
}

