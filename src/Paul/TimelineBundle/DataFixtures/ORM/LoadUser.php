<?php
/**
 * Created by PhpStorm.
 * User: mackendy
 * Date: 16/11/14
 * Time: 13:47
 */

namespace Paul\TimelineBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class LoadUser extends AbstractFixture implements FixtureInterface,OrderedFixtureInterface,ContainerAwareInterface{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $userManager->createUser();

        $user->setUsername('mack');
        $user->setEmail('mack@gmail.com');
        $user->setPlainPassword('1234');
        $user->setEnabled(true);

        $manager->persist($user);
        $manager->flush();

        $this->addReference('user', $user);
    }

    /*
     *
     */
    public function getOrder()
    {
        return 1;
    }
}