<?php

return [
    ChantierModule::class =>\DI\autowire(),
    // value a garder en memoire
    'img.basePath'=>dirname(__DIR__, 3).DIRECTORY_SEPARATOR.'public'. DIRECTORY_SEPARATOR. 'assets' . DIRECTORY_SEPARATOR.'imgs'. DIRECTORY_SEPARATOR.'chantiers' . DIRECTORY_SEPARATOR
];