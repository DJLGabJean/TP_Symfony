<?php

namespace App\DataFixtures;
 
use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
 
class SizeFixtures extends Fixture
{
    public const SIZE_REFERENCE = 'Size';
    
    public function load(ObjectManager $manager)
    {
        $nameSizes = [
            'S',
            'M',
            'L',
        ];
 
        foreach ($nameSizes as $key => $nameSize) {
            $size = new Size();
            $size->setName($nameSize);
            $manager->persist($size);
            echo($this->addReference(self::SIZE_REFERENCE . '_' . $key, $size));
        }
 
        $manager->flush();
    }


}

?>