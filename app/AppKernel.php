<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    /**
     * @return array
     */
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            /*
             * External Bundles
             */
            new blackknight467\StarRatingBundle\StarRatingBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
            new Sg\DatatablesBundle\SgDatatablesBundle(),
            new Knp\Bundle\TimeBundle\KnpTimeBundle(),
            new CMEN\GoogleChartsBundle\CMENGoogleChartsBundle(),
            new Nomaya\SocialBundle\NomayaSocialBundle(),

            /*
             * Created Bundles
             */
            new AppBundle\AppBundle(),
            new Front\FrontBundle\FrontBundle(),
            new Back\BackBundle\BackBundle(),
            new UserBundle\UserBundle(),
            new Forum\ForumBundle\ForumBundle(),
            new Team\TeamBundle\TeamBundle(),
            new Player\PlayerBundle\PlayerBundle(),
            new Reservation\HotelBundle\HotelBundle(),
            new Reservation\TicketBundle\TicketBundle(),
            new Group\GroupBundle\GroupBundle(),
            new Guide\GuideBundle\GuideBundle(),
            new Match\MatchBundle\MatchBundle(),
            new Common\LocationBundle\LocationBundle(),
            new Common\RegionBundle\RegionBundle(),
            new Common\UploadBundle\UploadBundle(),
            new Common\BookingBundle\BookingBundle(),
            new Reservation\CartBundle\CartBundle(),
            new News\NewsBundle\NewsBundle(),

            new ArticleBundle\ArticleBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();

            /**
             * External Bundle
             */
            $bundles[] = new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle();

            if ('dev' === $this->getEnvironment()) {
                $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
                $bundles[] = new Symfony\Bundle\WebServerBundle\WebServerBundle();
            }
        }

        return $bundles;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__) . '/var/cache/' . $this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__) . '/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    public function getRootDir()
    {
        return __DIR__;
    }
}
