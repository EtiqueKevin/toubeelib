<?php

use Psr\Container\ContainerInterface;
use toubeelib\application\actions\GetPraticiensDisponibilitesAction;
use toubeelib\application\actions\GetRdvsByIdAction;
use toubeelib\application\actions\PostRdvsAction;
use toubeelib\application\actions\PutRdvsAnnulerAction;
use toubeelib\core\repositoryInterfaces\PraticienRepositoryInterface;
use toubeelib\core\repositoryInterfaces\RdvRepositoryInterface;
use toubeelib\core\services\praticien\ServicePraticien;
use toubeelib\core\services\praticien\ServicePraticienInterface;
use toubeelib\core\services\rdv\ServiceRdv;
use toubeelib\core\services\rdv\ServiceRDVInterface;
use toubeelib\infrastructure\repositories\ArrayPraticienRepository;
use toubeelib\infrastructure\repositories\ArrayRdvRepository;

return [

    RdvRepositoryInterface::class => function (ContainerInterface $c){
        return new ArrayRdvRepository();
    },

    PraticienRepositoryInterface::class => function (ContainerInterface $c){
        return new ArrayPraticienRepository();
    },

    ServicePraticienInterface::class => function (ContainerInterface $c) {
        return new ServicePraticien($c->get(PraticienRepositoryInterface::class),$c->get('logger'));

    },

    ServiceRDVInterface::class => function (ContainerInterface $c) {
        return new ServiceRdv($c->get(RdvRepositoryInterface::class),$c->get(ServicePraticienInterface::class),$c->get('logger'));
    },

    GetRdvsByIdAction::class => function(ContainerInterface $c){
        return new GetRdvsByIdAction($c->get(ServiceRDVInterface::class));
    },

    PostRdvsAction::class => function(ContainerInterface $c){
        return new PostRdvsAction($c->get(ServiceRDVInterface::class));
    },

    PutRdvsAnnulerAction::class => function(ContainerInterface $c){
        return new PutRdvsAnnulerAction($c->get(ServiceRDVInterface::class));
    },

    GetPraticiensDisponibilitesAction::class => function(ContainerInterface $c){
        return new GetPraticiensDisponibilitesAction($c->get(ServiceRDVInterface::class));
    }
];