<?php

namespace InvolvedGroup\LaravelLangCountry\Tests\Services;

 use InvolvedGroup\LaravelLangCountry\Services\PreferedLanguage;
 use InvolvedGroup\LaravelLangCountry\Tests\TestCase;

 class PreferedLanguageTest extends TestCase
 {
     protected function setUp(): void
     {
         parent::setUp();

         // Set config variables
         $this->app['config']->set('lang-country.fallback', 'en-GB');
         $this->app['config']->set('lang-country.allowed', [
             'nl-NL',
             'nl-BE',
             'en-GB',
             'en-US',
         ]);
     }

     /**
      * @test
      */
     public function it_will_override_the_default_allowed_languages_from_the_config()
     {
         $override_allowed_languages = collect([
             'es-ES', 'es-CO', 'no-NO', 'cn-CN',
         ]);
         $override_fallback = 'cn-CN';

         $lang = new PreferedLanguage('es', $override_allowed_languages, $override_fallback);
         $this->assertEquals('es-ES', $lang->lang_country);
         $this->assertEquals('es', $lang->locale);

         $lang = new PreferedLanguage('nl', $override_allowed_languages, $override_fallback);
         $this->assertEquals('cn-CN', $lang->lang_country);
         $this->assertEquals('cn', $lang->locale);
     }
 }
