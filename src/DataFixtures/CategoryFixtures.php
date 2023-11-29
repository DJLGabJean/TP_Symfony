<?php

namespace App\DataFixtures;
 
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
 
class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCE = 'Category';
    
    public function load(ObjectManager $manager)
    {
        $nameCategories = [
            'Tee-Shirt',
            'Hoodie',
            'Pants',
            'Shoes',
        ];
 
        foreach ($nameCategories as $key => $nameCategory) {
            $category = new Category();
            $category->setName($nameCategory);
            $manager->persist($category);
            echo($this->addReference(self::CATEGORY_REFERENCE . '_' . $key, $category));
        }
 
        $manager->flush();
    }

}

?>