<?php

namespace App\Controller;

use App\Entity\MemberUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Vich\UploaderBundle\Storage\StorageInterface;

class AuthController extends AbstractController
{
    public function __construct(
        private StorageInterface $storage,
        private UrlGeneratorInterface $router,
        private NormalizerInterface $normalizer,
    ) {
    }

    #[Route('/api/profile', name: 'api_profile')]
    public function apiProfile(): JsonResponse
    {
        /** @var BaseUser */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['message' => 'Unauthorized'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $response = [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'roles' => $user->getRoles(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'language' => $user->getLanguage(),
        ];

        $avatar = $user->getAvatar();

        if ($avatar) {
            $uri = $this->storage->resolveUri($avatar, 'file');
            $contentUrl = $this->router->generate(
                'api_media',
                ['filePath' => ltrim($uri, '/')],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            $avatar = $this->normalizer->normalize($avatar, 'jsonld', [
                'groups' => ['avatar:read'],
            ]);
            $avatar['contentUrl'] = $contentUrl;
            $avatar['@id'] = '/api/avatars/'.$avatar['id'];
            $avatar['@type'] = 'Avatar';

            $response['avatar'] = $avatar;
        }

        // if ($user instanceof MemberUser) {
        //     $response['bio'] = $user->getBio();

        //     $agency = $user->getAgency();

        //     if ($agency instanceof \App\Entity\Agency) {
        //         $response['agency'] = $this->normalizer->normalize($agency, 'jsonld', [
        //             'groups' => ['agency:item', 'media_object:read'],
        //         ]);
        //     }
        // }

        return new JsonResponse($response, JsonResponse::HTTP_OK);
    }
}
