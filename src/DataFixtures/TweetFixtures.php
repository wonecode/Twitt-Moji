<?php

namespace App\DataFixtures;

use App\Entity\Tweet;
use DateTimeImmutable;
use App\DataFixtures\UserFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Generator;
use Faker\Factory;

class TweetFixtures extends Fixture implements DependentFixtureInterface
{
    private Generator $faker;

    private const TWEETS = [
        [
            'content' => '๐โพ๏ธ๐งจ๐๐ฅฝ'
        ],
        [
            'content' => '๐ฅผ๐ฉ ๐ ๐ฆ โธ'
        ],
        [
            'content' => '๐ฃ๏ธ๐จโ๐ฆฐ๐๐คก'
        ],
        [
            'content' => '๐โฟ๐๐ฟ๐ธ'
        ],
        [
            'content' => '๐ฅถ๐คฆโโ๏ธ๐ฅฅ๐ฅ๐๏ธ๐ฆง'
        ],
        [
            'content' => '๐๐๐ฆโฌ๏ธ๐๐งโ'
        ],
        [
            'content' => '๐โ๏ธ๐ฟ๐ธ๐ฅ๐ฒ๐'
        ],
        [
            'content' => '๐๐ฌ๐ฝ๐ฐโขโ๏ธ๐'
        ],
        [
            'content' => '๐ญ๐ฝ๐๐ฅ๐๐โ๏ธ๐๐'
        ],
        [
            'content' => '๐๐๐๐'
        ],
        [
            'content' => 'โโฃ๐๐ฟ๐ข๐๐ฅ'
        ],
        [
            'content' => '๐๐ฎ๐คโ๏ธ๐๐ฏ๐ท'
        ],
        [
            'content' => '๐๐ฆ๐๐ฆ๐๐ค๐น๐ฎโ๏ธ๐'
        ],
        [
            'content' => '๐ต๐ข๐ฒ๐๐๐ฌโก๏ธ๐ '
        ],
    ];

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        for ($i=0; $i < UserFixtures::USERS_NUMBER; $i++) {
            $tweets = self::TWEETS[array_rand(self::TWEETS)];
            $tweet = new Tweet();
            $tweet->setContent($tweets['content']);
            $tweet->setTweetedAt(DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-7 days', 'now')));
            $tweet->setUser($this->getReference('user_' . $i));
            $manager->persist($tweet);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}