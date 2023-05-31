<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\AdminUserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminUserRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['admin_user:item', 'avatar:read', 'blameable']], security: 'is_granted("ROLE_ADMIN")'),
        new Put(security: 'is_granted("ROLE_ADMIN")'),
        new Delete(security: 'is_granted("ROLE_SUPER_ADMIN")'),
        new GetCollection(normalizationContext: ['groups' => ['admin_user:collection', 'avatar:read']], security: 'is_granted("ROLE_ADMIN")'),
        new Post(security: 'is_granted("ROLE_SUPER_ADMIN")'),
    ],
)]
class AdminUser extends BaseUser
{
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Returning a salt is only needed if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }
}
