<?php
/**
 * Translate
 * @package lib-google-translate
 * @version 0.0.1
 */

namespace LibGoogleTranslate\Library;

class Translate
{
    protected static string $lastError = '';

    public static function translate(string $to, string $text, ?string $from = null): ?string
    {
        $apiKey = \Mim::$app->config->libGoogleTranslate->apiKey;
        $url = "https://translation.googleapis.com/v3/projects/v3:translateText?key=" . $apiKey;

        $data = [
            'contents' => [$text],
            'targetLanguageCode' => $to
        ];
        if ($from) {
            $data['sourceLanguageCode'] = $from;
        }

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

        if (isset($res['error'])) {
            self::$lastError = $res['error'];
            return null;
        }

        if (isset($responseData['translations'][0]['translatedText'])) {
            return $responseData['translations'][0]['translatedText'];
        }

        self::$lastError = 'Google API Response Invalid';
        return null;
    }

    public static function lastError()
    {
        return self::$lastError;
    }
}
