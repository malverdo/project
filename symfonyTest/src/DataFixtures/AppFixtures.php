<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Post;
use Faker\Factory;
use Cocur\Slugify\Slugify;

class AppFixtures extends Fixture
{
    private $faker;

    private $slug;

    public function __construct(Slugify $slugify)
    {
        $this->faker = Factory::create('ru_RU');
        $this->slug = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadPosts($manager);
    }

    public function loadPosts(ObjectManager $manager)
    {
        for ($i = 1; $i < 500; $i++) {
            $post = new Post();
            $post->setTitle($this->faker->name);
            $post->setSlug($this->slug->slugify($post->getTitle()));
            $post->setBody($this->faker->text(1000));
            $post->setCreatedAt($this->faker->dateTime);

            $manager->persist($post);
        }
        $manager->flush();
    }
}
