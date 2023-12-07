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

        $nameClothings = [
            'Dri-FIT Trail',
            'JJELOGO Blocking Hood',
            'Sportswear Club Fleece',
            'Hoops 3.0 Mid Classic Vintage',
            'Essentials Big Logo Tee',
            'Hooded Box Quilt Puffer'
        ];

        $urlImages = [
            '../public/images/dri_fit_trail.png',
            '../public/images/jjelogo_blocking_hood.png',
            '../public/images/sportswear-club-fleece.png',
            null,
            '../public/images/adidas_essentials_big_logo.png',
            '../public/images/hooded_box_quilt_puffer.png'
        ];

        $nameBrands = [
            'Nike',
            'Jack & Jones',
            'Nike',
            'Adidas',
            'Adidas',
            'Superdry'
        ];

        $nameCategories = [
            'Tee-Shirt',
            'Hoodie',
            'Pants',
            'Shoes',
            'Tee-Shirt',
            'Jacket'
        ];

        $nameSizes = [
            'S',
            'M',
            'M',
            null,
            'L',
            'M'
        ];

        $descriptions = [
            'Help keep you dry and comfortable on your run.',
            'Made of a soft cotton blend',
            'Soft fleece fabric',
            null,
            'Made of cotton',
            'Made of polyester'
        ];

        $brandRepository = $manager->getRepository(Brand::class);
        $categoryRepository = $manager->getRepository(Category::class);
        $sizeRepository = $manager->getRepository(Size::class);

        for ($i = 0; $i < count($nameClothings); $i++) {
            if (!isset($nameBrands[$i]) || !isset($nameCategories[$i]) || !isset($nameSizes[$i])) {
                continue;
            }
        
            $brand = $brandRepository->findOneByName($nameBrands[$i]);
            if (!$brand) {
                $brand = new Brand();
                $brand->setName($nameBrands[$i]);
                $manager->persist($brand);
            }
        
            $category = $categoryRepository->findOneByName($nameCategories[$i]);
            if (!$category) {
                $category = new Category();
                $category->setName($nameCategories[$i]);
                $manager->persist($category);
            }
        
            $size = $sizeRepository->findOneByName($nameSizes[$i]);
            if (!$size) {
                $size = new Size();
                $size->setName($nameSizes[$i]);
                $manager->persist($size);
            }
        
            $clothing = new Clothing();
            $clothing->setName($nameClothings[$i]);
            $clothing->setUrlImage($urlImages[$i]);
            $clothing->setBrand($brand);
            $clothing->addCategory($category);
            $clothing->addSize($size);
            $clothing->setDescription($descriptions[$i]);
        
            $manager->persist($clothing);
            $this->addReference(self::CLOTHING_REFERENCE . '_' . $i, $clothing);
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