<?php

namespace App\DataFixtures;
 
use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
 
class BrandFixtures extends Fixture
{
    public const BRAND_REFERENCE = 'Brand';
    
    public function load(ObjectManager $manager)
    {
        $nameBrands = [
            'Adidas',
            'Nike',
            'Puma',
            'Reebok',
            'Jack & Jones'
        ];

 
        foreach ($nameBrands as $key => $nameBrand) {
            $brand = new Brand();
            $brand->setName($nameBrand);
            $manager->persist($brand);
            echo($this->addReference(self::BRAND_REFERENCE . '_' . $key, $brand));
        }
 
        $manager->flush();
    }
}

?>