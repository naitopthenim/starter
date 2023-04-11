<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    #[Route('/', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
                'version' => $this->getAppVersion(),
            ]);
    }

    public static function getAppVersion(): string
    {
        try {
            $tag = trim(exec('git describe --abbrev=0 --tags')) ?: '0.0.0';
            $branch = trim(exec('git rev-parse --abbrev-ref HEAD'));
            $hash = trim(exec('git log --pretty="%h" -n1 HEAD'));
            $date = new \DateTime(trim(exec('git log -n1 --pretty=%ci HEAD')));
            $date->setTimezone(new \DateTimeZone('UTC'));

            return sprintf(
                'v%s-%s.%s (%s)',
                $tag,
                $branch,
                $hash,
                $date->format('Y-m-d H:i:s'),
            );
        } catch (\Throwable $th) {
            return '0.0.0';
        }
    }
}
