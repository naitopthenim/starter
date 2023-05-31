<?php

namespace App\Entity\Trait;

use ApiPlatform\Metadata\ApiProperty;
use Knp\DoctrineBehaviors\Model\Blameable\BlameableMethodsTrait;
use Symfony\Component\Serializer\Annotation\Groups;

trait BlameableTrait
{
    use BlameableMethodsTrait;

    /**
     * @var int|object|string
     */
    #[Groups([
        'blameable',
        'payment:collection', 'payment:item',
    ])]
    #[ApiProperty(readableLink: true, writableLink: false)]
    protected $createdBy;

    /**
     * @var int|object|string
     */
    #[Groups([
        'blameable',
    ])]
    #[ApiProperty(readableLink: false, writableLink: false)]
    protected $updatedBy;

    /**
     * @var int|object|string
     */
    #[Groups([
        'blameable',
    ])]
    #[ApiProperty(readableLink: false, writableLink: false)]
    protected $deletedBy;
}
