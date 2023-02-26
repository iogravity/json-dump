<?php

function getConfig(string $config, $needle = [])
{
    $configData = explode('.', $config);
    $fileName = $configData[0];
    $fileData = getConfigData($fileName);
    unset($configData[0]);
    if (empty($needle)) {
        $needle = $fileData;
    }

    if (isset($needle[$configData[array_key_first($configData)]]) && (count($configData) > 1)) {
        $key = array_key_first($configData);
        $temp = $configData;
        unset($configData[array_key_first($configData)]);
        if (! isset($needle[$temp[$key]])) {
            return null;
        }

        return getConfig($fileName . '.' . implode('.', $configData), $needle[$temp[$key]]);
    } elseif (count($configData) == 1) {
        $data = $needle[$configData[array_key_first($configData)]] ?? null;
    }

    return $data ?? null;
}
function getConfigData($fileName)
{
    $file = __DIR__ . '/config/' . $fileName . '.php';
    if (file_exists($file)) {
        return include $file;
    } else {
        throw new Exception('config ' . $configName . ' not found');
    }
}
