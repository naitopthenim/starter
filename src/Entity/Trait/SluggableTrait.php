<?php

namespace App\Entity\Trait;

use Knp\DoctrineBehaviors\Model\Sluggable\SluggableMethodsTrait;
use Symfony\Component\Serializer\Annotation\Groups;

trait SluggableTrait
{
    use SluggableMethodsTrait;

    /**
     * @var string
     */
    #[Groups(['sluggable'])]
    protected $slug;
}
