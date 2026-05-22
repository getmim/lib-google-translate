<?php
/**
 * Translate
 * @package lib-google-translate
 * @version 0.0.1
 */

namespace LibGoogleTranslate\Library;

use LibCurl\Library\Curl;

class Translate
{
    protected static string $lastError = '';

    public static function translate(string $to, string $text): ?string
    {
        $apiKey = \Mim::$app->config->libGoogleTranslate->apiKey;
        $url = "https://translation.googleapis.com/language/translate/v2?key=" . $apiKey;

        $data = [
            'q' => $text,
            'target' => $to
        ];

        $res = Curl::fetch([
            'url' => $url,
            'method' => 'POST',
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $data
        ]);

        if (!$res) {
            self::$lastError = 'Failed on calling google translate api';
            return null;
        }

        if (isset($res->error)) {
            self::$lastError = $res->error->message;
            return null;
        }

        if (isset($res->data->translations[0]->translatedText)) {
            return $res->data->translations[0]->translatedText;
        }

        self::$lastError = 'Google API Response Invalid';
        return null;
    }

    public static function lastError()
    {
        return self::$lastError;
    }
}
