<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\MemberUserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: MemberUserRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => ['member_user:item']]),
        new GetCollection(normalizationContext: ['groups' => ['member_user:collection']], security: "is_granted('ROLE_ADMIN')"),
        new Put(security: 'is_granted("ROLE_USER")'),
        new Delete(security: 'is_granted("ROLE_USER")'),
        new Post(security: 'is_granted("ROLE_USER")'),
    ]
)]
class MemberUser extends BaseUser
{
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['member_user:item', 'member_user:collection'])]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['member_user:item', 'member_user:collection'])]
    private ?string $country = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['member_user:item', 'member_user:collection'])]
    private ?string $province = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['member_user:item', 'member_user:collection'])]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['member_user:item', 'member_user:collection'])]
    private ?string $district = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['member_user:item', 'member_user:collection'])]
    private ?string $zipCode = null;

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getProvince(): ?string
    {
        return $this->province;
    }

    public function setProvince(?string $province): self
    {
        $this->province = $province;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDistrict(): ?string
    {
        return $this->district;
    }

    public function setDistrict(?string $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(?string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }
}
