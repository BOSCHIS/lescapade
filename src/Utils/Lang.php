<?php

namespace App\Utils;

class Lang
{
    private const AVAILABLE_LOCALES = ['fr', 'en', 'es'];
    private const DEFAULT_LOCALE = 'fr';

    public static function setLocale(?string $locale): void
    {
        if (!in_array($locale, self::AVAILABLE_LOCALES, true)) {
            $locale = self::DEFAULT_LOCALE;
        }

        $_SESSION['locale'] = $locale;
    }

    public static function getLocale(): string
    {
        $locale = $_SESSION['locale'] ?? self::DEFAULT_LOCALE;

        if (!in_array($locale, self::AVAILABLE_LOCALES, true)) {
            return self::DEFAULT_LOCALE;
        }

        return $locale;
    }

    public static function getAvailableLocales(): array
    {
        return self::AVAILABLE_LOCALES;
    }

    public static function loadTranslations(): array
    {
        $locale = self::getLocale();
        $file = dirname(__DIR__, 2) . '/translations/' . $locale . '.php';

        if (!is_file($file)) {
            $file = dirname(__DIR__, 2) . '/translations/' . self::DEFAULT_LOCALE . '.php';
        }

        $translations = require $file;

        return is_array($translations) ? $translations : [];
    }

    public static function translate(string $key, array $replacements = []): string
    {
        $translations = self::loadTranslations();
        $text = $translations[$key] ?? $key;

        foreach ($replacements as $search => $value) {
            $text = str_replace(':' . $search, (string) $value, $text);
        }

        return $text;
    }
}
