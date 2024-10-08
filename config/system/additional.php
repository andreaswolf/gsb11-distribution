<?php

// SPDX-FileCopyrightText: 2024 Bundesrepublik Deutschland, vertreten durch das BMI/ITZBund
//
// SPDX-License-Identifier: GPL-3.0-or-later

// This is always the last place for configuration changes and must be in the end of this file!
$configReaderFactory = new \Helhum\ConfigLoader\ConfigurationReaderFactory(dirname(__DIR__));
$configLoader = new \Helhum\ConfigLoader\ConfigurationLoader(
    [
        $configReaderFactory->createReader('TYPO3', ['type' => 'env']),
    ],
    [
        new \Helhum\ConfigLoader\Processor\PlaceholderValue(),
    ]
);
$GLOBALS['TYPO3_CONF_VARS'] = array_replace_recursive(
    $GLOBALS['TYPO3_CONF_VARS'],
    $configLoader->load()
);
