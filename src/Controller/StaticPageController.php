<?php

namespace App\Controller;

class StaticPageController {

    public function aboutPage() {

        // Affichage du template
         $template = '../static/about';
         include TEMPLATE_DIR .'/patient/base.phtml';
    }

    public function faqPage() {

        // Affichage du template
         $template = '../static/faq';
         include TEMPLATE_DIR .'/patient/base.phtml';
    }

}