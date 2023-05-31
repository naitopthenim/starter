<?php

namespace App\Entity\Trait;

use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableMethodsTrait;
use Symfony\Component\Serializer\Annotation\Groups;

trait TimestampableTrait
{
    use TimestampableMethodsTrait;

    /**
     * @var DateTimeInterface
     */
    #[Groups([
        'timestampable',
        'itinerary:collection', 'itinerary:item',
        'inquiry:collection', 'inquiry:item',
        'travel_plan:collection', 'travel_plan:item',
        'customer:collection', 'customer:item',
        'hotel_contract_two:collection', 'hotel_contract_two:item',
    ])]
    protected $createdAt;

    /**
     * @var DateTimeInterface
     */
    #[Groups([
        'timestampable',
        'itinerary:collection', 'itinerary:item',
        'inquiry:collection',
        'inquiry:item',
        'travel_plan:item',
        'customer:item',
    ])]
    protected $updatedAt;
}
