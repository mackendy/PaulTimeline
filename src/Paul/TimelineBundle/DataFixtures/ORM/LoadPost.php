<?php

/**
 * Created by PhpStorm.
 * User: mackendy
 * Date: 16/11/14
 * Time: 13:27
 */

namespace Paul\TimelineBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Paul\TimelineBundle\Entity\Post;
use Symfony\Component\Validator\Constraints\DateTime;


class LoadPost extends AbstractFixture implements FixtureInterface,OrderedFixtureInterface {

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $titles = array(
            'title 1',
            'title 2',
            'title 3',
            'title 4'
        );

        $type = array(
            'video-camera',
            'camera',
            'pencil',
            'quote-right'
        );

        foreach($titles as $title)
        {
            $post = new Post();
            $post->setTitle($title);
            $post->setDate(new \DateTime("now"));
            $post->setContent('Plusieurs variations de Lorem Ipsum peuvent être trouvées ici ou là, mais la majeure partie ians fin, ce qui fait de lipsum.com le seul vrai générateur de Lorem Ipsum. Iil utilise un dictionnaire de plus de 200 mots latins, en combinaison de plusieurs structures de phrases, pour générer un Lorem Ipsum irréprochable. Le Lorem Ipsum ainsi obtenu ne contient aucune répétition, ni ne contient des mots farfelus, ou des touches ');
            $post->setAuthor($this->getReference('user'));

            $post->setType($type[array_rand($type,1)]);
            $post->setPublished('1');
            $manager->persist($post);

        }

        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }

} 