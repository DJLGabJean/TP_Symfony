<?php

namespace App\DataFixtures;

use App\Entity\Clothing;
use App\Entity\Brand;
use App\Entity\Category;
use App\Entity\Size;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ClothingFixtures extends Fixture implements DependentFixtureInterface
{
    private const CLOTHING_REFERENCE = 'Clothing';
    
    public function load(ObjectManager $manager)
    {
        $brands = $manager->getRepository(Brand::class)->findAll();
        $categories = $manager->getRepository(Category::class)->findAll();
        $sizes = $manager->getRepository(Size::class)->findAll();

        $nameClothings = [
            'Hoodie',
            'T-Shirt',
            'Sweat-Shirt',
            'Pullover'
        ];
 
        foreach ($nameClothings as $key => $nameClothing) {
            if (!isset($brands[$key]) || !isset($categories[$key]) || !isset($sizes[$key])) {
                continue;
            }

            $clothing = new Clothing();
            $clothing->setName($nameClothing);
            $clothing->setCategory($categories[$key]);
            $clothing->addBrand($brands[$key]);
            
            foreach ($sizes as $size) {
                $clothing->addSize($size);
            }
            
            $manager->persist($clothing);
            echo($this->addReference(self::CLOTHING_REFERENCE . '_' . $key, $clothing));
        }
 
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BrandFixtures::class,
            CategoryFixtures::class,
            SizeFixtures::class
        ];
    }




}

?>